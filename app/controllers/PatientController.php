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
        $mother_name, $companion, $address, $naturalness){
            try {
              $result = $this->patient_service->registrationService($cpf, $full_name, $genre, 
              $date_of_birth, $mother_name, $companion, $address, $naturalness);
                
              return $result;
            } catch (Exception $e) {
                return "Não foi possível realizar o cadastro do paciente. Tente mais tarde.";
            }
        }
    }
?>
