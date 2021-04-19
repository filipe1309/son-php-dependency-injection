<?php

class Database
{
    public function __construct()
    {
        $this->driver = new \PDO('dsn', 'user', '123');
    }
}

$dbNoDI = new Database();
