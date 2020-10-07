<?php
    namespace data\repository;
    
    class Connection{

        private $localname;
        private $user;
        private $password;
        private $database;
        private $link;

        public function __construct()
        {
            $this->localname = "localhost";
            $this->user = "root";
            $this->password = "";
            $this->database = "health_unit";
            $this->link = mysqli_connect($this->localname, $this->user, $this->password, $this->database);
        }
        
        public function getLink (){
            return $this->link;
        }

        public function getClose (){
            return mysqli_close($this->link);
        }
    
    }
?>
