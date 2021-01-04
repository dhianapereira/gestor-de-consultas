<?php
    namespace app\models;
    class Doctor{
	    private $id;
        private $name;
        private $genre;
        private $specialty;


        public function getId (){
            return $this->id;
        }
    
        public function getName() {
            return $this->full_name;
        }

        public function getGenre (){
            return $this->genre;
        }
        
        public function getSpecialty(){
            return $this->specialty;
        }

        public function __construct ($id, $name, $genre, $specialty){
		    $this->id = $id;
            $this->name = $name;
            $this->genre = $genre;
            $this->specialty = $specialty;
        }
    }
?>
