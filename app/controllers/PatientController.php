<?php
    namespace app\controllers;
    use src\services\PatientService;
    
    class PatientController{
        private $patient_service;

        public function __construct()
        {
            $this->patient_service =  new PatientService();
        }
        
        public function registerPatient($cpf, $full_name, $genre, $date_of_birth, 
        $mother_name, $companion, $patient_address, $naturalness){
            
            $result = $this->patient_service->registerPatient($cpf, $full_name, $genre, 
            $date_of_birth, $mother_name, $companion, $patient_address, $naturalness);
              
            return $result;
        }

        public function allPatients(){
            $result = $this->patient_service->allPatients();
                
            return $result;
        }

        public function fetchPatient($cpf){
            
            $result = $this->patient_service->fetchPatient($cpf);
            
            return $result;
        }
    }
?>