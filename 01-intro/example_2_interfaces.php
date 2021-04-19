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

$ioc['db']();
