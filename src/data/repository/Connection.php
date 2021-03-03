<?php
define('HOST', "localhost");
define('USER', "root");
define('PASS', "");
define('DBNAME', "health_unit");

class Connection
{
    public static function connect()
    {
        $connection = new \PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USER, PASS);

        $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);

        return $connection;
    }
}
