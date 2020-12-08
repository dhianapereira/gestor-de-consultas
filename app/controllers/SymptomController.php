<?php
    namespace app\controllers;
    use src\services\SymptomService;
    
    class SymptomController{
        private $symptom_service;

        public function __construct()
        {
            $this->symptom_service =  new SymptomService();
        }
        
        public function addSymptoms($patient_cpf, $symptoms, $start_date){
            
            $result = $this->symptom_service->addSymptoms($patient_cpf, $symptoms, $start_date);
            
            return $result;
        }

        public function fetchSymptoms($cpf){
            
            $result = $this->symptom_service->fetchSymptoms($cpf);
            
            return $result;
        }
    }
?>