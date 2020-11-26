<?php
    namespace src\services;
    use src\data\Facade;
    
    class PatientService{

        private $facade;

        public function __construct()
        {
            $this->facade =  new Facade();
        }

        public function registrationService($cpf, $full_name, $genre, $date_of_birth, 
        $mother_name, $companion, $address, $naturalness){

            $result = $this->facade->register($cpf, $full_name, $genre, $date_of_birth, 
            $mother_name, $companion, $address, $naturalness);

            return $result;
        }
    }
?>
