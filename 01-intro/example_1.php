<?php

class Database
{
    public function __construct()
    {
        $this->dirver = new \PDO('dsn', 'user', '123');
    }
}

$dbNoDI = new Database();
