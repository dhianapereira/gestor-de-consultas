<?php
    namespace app\models;
    class Status{
	    private $id;
        private $name;
    
        public function getName() {
            return $this->name;
        }

        public function getId (){
            return $this->id;
        }
        
        public function __construct ($id, $name){
		    $this->id = $id;
            $this->name = $name;
	    }
    }
?>
