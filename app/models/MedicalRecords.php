<?php
    namespace app\models;
    class MedicalRecords{
	    private $id;
        private $patient_cpf;
        private $result;
        private $gravity;
        private $start_date;


        public function getPatientCpf (){
            return $this->patient_cpf;
        }
    
        public function getResult() {
            return $this->result;
        }

        public function getId (){
            return $this->id;
        }

        public function getStartDate (){
            return $this->start_date;
        }

        public function getGravity (){
            return $this->gravity;
        }
        
        public function __construct ($id, $patient_cpf, $result, $gravity, $start_date){
		    $this->id = $id;
            $this->patient_cpf = $patient_cpf;
            $this->result = $result;
            $this->gravity = $gravity;
            $this->start_date = $start_date;
	    }
    }
?>
