<?php
namespace data\repository;

define( 'HOST', 'localhost' );
define( 'USER', 'root' );
define( 'PASS', '' );
define( 'DBNAME', 'health_unit' );

class Connection{
    private $connection;
    public function __construct() {
        $this->connection = new \PDO( 'mysql:host=' . HOST . ';dbname=' . DBNAME, USER, PASS);
    }
    
    public function connect(){
        return $this->connection;
    }
}
?>