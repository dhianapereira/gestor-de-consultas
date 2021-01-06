<?php
    namespace src\services;
    use src\data\Facade;
    
    class MedicalAppointmentService{

        private $facade;

        public function __construct()
        {
            $this->facade =  new Facade();
        }

        public function makeAnAppointment($patient_cpf, $genre, $specialty, $date, $time){

            $result = $this->facade->makeAnAppointment($patient_cpf, $genre, $specialty,
             $date, $time);

            return $result;
        }

        public function allMedicalAppointments(){
            $result = $this->facade->allMedicalAppointments();

            return $result;
        }

    }
?>
