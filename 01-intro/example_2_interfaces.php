<?php

interface DatabaseDriver
{
    public function connect();
}

class PdoDriver implements DatabaseDriver
{
    public function configure(array $config)
    {
        $this->config = $config;
    }

    public function connect()
    {
        $pdo = new \PDO($this->config['dsn'], $this->config['user'], $this->config['passwd']);
    }
}

class MongoDbDriver implements DatabaseDriver
{
    public function configure(array $config)
    {
        $this->config = $config;
    }

    public function connect()
    {
        $mongo = new \MongoClient($this->config['server']);
    }
}

class Database
{
    public function __construct(DatabaseDriver $driver)
    {
        $this->driver = $driver;
    }
}

$ioc = [];
$ioc['db'] = function () {
    $pdoDriver = new PdoDriver();
    $pdoDriver->configure([]);
    return new Database($pdoDriver);
};

$ioc['db_mongo'] = function () {
    $mongoDriver = new MongoDbDriver();
    $mongoDriver->configure([]);
    return new Database($mongoDriver);
};

$ioc['db']();
$ioc['db_mongo']();
