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

        public function allMedicalRecords($start, $total_records){
            $result = $this->medical_records_service->allMedicalRecords($start, $total_records);
                
            return $result;
        }
    }
?>