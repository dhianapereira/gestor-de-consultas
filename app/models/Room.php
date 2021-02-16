<?php
    namespace app\models;
    class Room{
	    private $id;
        private $type;
        private $status;


        public function getId (){
            return $this->id;
        }
    
        public function getType() {
            return $this->type;
        }

        public function getStatus(){
            return $this->status;
        }

        public function __construct ($id, $type, $status){
		    $this->id = $id;
            $this->type = $type;
            $this->status = $status;
        }
    }
?>
