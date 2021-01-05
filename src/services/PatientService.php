<?php
    namespace src\services;
    use src\data\Facade;
    
    class PatientService{

        private $facade;

        public function __construct()
        {
            $this->facade =  new Facade();
        }

        public function register($cpf, $full_name, $genre, $date_of_birth, 
        $mother_name, $companion, $address, $naturalness){

            $result = $this->facade->registerPatient($cpf, $full_name, $genre, $date_of_birth, 
            $mother_name, $companion, $address, $naturalness);

            return $result;
        }


        public function allPatients(){
            $result = $this->facade->allPatients();

            return $result;
        }

        public function fetchPatient($cpf){
            $result = $this->facade->fetchPatient($cpf);

            return $result;
        }
    }
?>
