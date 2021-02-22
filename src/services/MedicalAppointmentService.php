<?php
    namespace src\services;
    use src\data\Facade;
    
    class MedicalAppointmentService{

        private $facade;

        public function __construct()
        {
            $this->facade =  new Facade();
        }

        public function makeAnAppointment($patient_cpf, $genre, $specialty, $date, $time, $room){

            $result = $this->facade->makeAnAppointment($patient_cpf, $genre, $specialty,
             $date, $time, $room);

            return $result;
        }

        public function allMedicalAppointments($start, $total_records){
            $result = $this->facade->allMedicalAppointments($start, $total_records);

            return $result;
        }

        public function fetchMedicalAppointment($id){
            $result = $this->facade->fetchMedicalAppointment($id);

            return $result;
        }

        public function update($medical_appointment){
            
            $result = $this->facade->updateMedicalAppointment($medical_appointment);
              
            return $result;
        }

    }
