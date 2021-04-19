<?php

class Database
{
    public function __construct(\PDO $pdo)
    {
        $this->dirver = $pdo;
    }
}

$ioc = [];
$ioc['db'] = function () {
    $pdo = new \PDO('dsn', 'user', '123');
    return new Database($pdo);
};

$ioc['db']();
