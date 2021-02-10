<?php

namespace src\data\repository;

define('HOST', "localhost");
define('USER', "root");
define('PASS', "");
define('DBNAME', "health_unit");

class Connection
{
    private $connection;

    public function getConnection()
    {

        if ($this->connection === NULL) {
            $this->connect();
        }

        return $this->connection;
    }

    public function connect()
    {
        $this->connection = new \PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USER, PASS);
    }

    public function disconnect()
    {
        $this->connection = NULL;
    }
}
