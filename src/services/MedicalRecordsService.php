<?php
    namespace src\services;
    use src\data\Facade;
    
    class MedicalRecordsService{

        private $facade;

        public function __construct()
        {
            $this->facade =  new Facade();
        }

        public function fetchMedicalRecords($cpf){

            $result = $this->facade->fetchMedicalRecords($cpf);

            return $result;
        }

        public function allMedicalRecords($start, $total_records){
            $result = $this->facade->allMedicalRecords($start, $total_records);

            return $result;
        }
    }
?>
