<?php
    namespace src\services;
    use src\data\Facade;
    
    class SymptomService{

        private $facade;

        public function __construct()
        {
            $this->facade =  new Facade();
        }

        public function addSymptoms($patient_cpf, $symptoms, $start_date){

            $result = $this->facade->addSymptoms($patient_cpf, $symptoms, $start_date);

            return $result;
        }
    }
?>
