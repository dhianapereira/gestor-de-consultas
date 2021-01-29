<?php
    namespace app\controllers;
    use src\services\MedicalRecordsService;
    
    class MedicalRecordsController{
        private $medical_records_service;

        public function __construct()
        {
            $this->medical_records_service =  new MedicalRecordsService();
        }
        
        public function fetchMedicalRecords($cpf){
            
            $result = $this->medical_records_service->fetchMedicalRecords($cpf);
            
            return $result;
        }

        public function allMedicalRecords(){
            $result = $this->medical_records_service->allMedicalRecords();
                
            return $result;
        }
    }
?>