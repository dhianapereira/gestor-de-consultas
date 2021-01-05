<?php
    namespace app\models;
    class Doctor{
	    private $id;
        private $name;
        private $genre;
        private $specialty;
        private $active;


        public function getId (){
            return $this->id;
        }
    
        public function getName() {
            return $this->name;
        }

        public function getGenre (){
            return $this->genre;
        }
        
        public function getSpecialty(){
            return $this->specialty;
        }

        public function getActive(){
            return $this->active;
        }

        public function __construct ($id, $name, $genre, $specialty, $active){
		    $this->id = $id;
            $this->name = $name;
            $this->genre = $genre;
            $this->specialty = $specialty;
            $this->active = $active;
        }
    }
?>
