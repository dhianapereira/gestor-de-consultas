<?php
namespace data\repository;

class Connection {

    private $connection;

    public function __construct() {
        $this->connection = new PDO('mysql:host=localhost;dbname=health_unit', 'root', '' );
    }

    public function connect () {
        return $this->connection;
    }

    public function close () {
        $this->connection = null;
    }

}
?>