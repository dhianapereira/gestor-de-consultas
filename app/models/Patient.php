<?php
    namespace app\models;
    class Patient{
	    private $cpf;
        private $full_name;
        private $genre;
        private $date_of_birth;
        private $mother_name;
        private $naturalness;


        public function getCpf (){
            return $this->cpf;
        }
    
        public function getName() {
            return $this->full_name;
        }

        public function getGenre (){
            return $this->genre;
        }
        
        public function getDateOfBirth (){
            return $this->date_of_birth;
        }

        public function getMotherName (){
            return $this->mother_name;
        }

        public function getNaturalness (){
            return $this->naturalness;
        }
        
	    public function __construct ($cpf, $full_name, $genre, $date_of_birth, $mother_name, $naturalness){
		    $this->cpf = $cpf;
            $this->full_name = $full_name;
            $this->genre = $genre;
            $this->date_of_birth = $date_of_birth;
		    $this->mother_name = $mother_name;
		    $this->naturalness = $naturalness;
	    }
    }
?>
