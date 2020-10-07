<?php
    namespace services;
    use data\Facade;
    
    class PatientService{

        private $facade;

        public function __construct()
        {
            $this->facade =  new Facade();
        }

        public function registrationService($cpf, $full_name, $genre, $date_of_birth, $mother_name, $naturalness){
            $result = $this->facade->register($cpf, $full_name, $genre, $date_of_birth, $mother_name, $naturalness);

            return $result;
        }
    }
?>
