<?php
    namespace app\models;
    class MedicalAppointment{
	    private $id;
        private $patient_cpf;
        private $id_doctor;
        private $time;
        private $arrival_time;
        private $date;
        private $realized;


        public function getId() {
            return $this->id;
        }

        public function getPatientCpf (){
            return $this->patient_cpf;
        }

        public function getIdDoctor (){
            return $this->id_doctor;
        }

        public function getDate (){
            return $this->date;
        }

        public function getTime (){
            return $this->time;
        }

        public function getArrivalTime (){
            return $this->arrival_time;
        }

        public function getRealized (){
            return $this->realized;
        }
        
        public function __construct ($id, $patient_cpf, $id_doctor, $date, 
        $time, $arrival_time, $realized){
		    $this->id = $id;
            $this->patient_cpf = $patient_cpf;
            $this->id_doctor = $id_doctor;
            $this->date = $date;
            $this->time = $time;
            $this->arrival_time = $arrival_time;
            $this->realized = $realized;
	    }
    }
?>
