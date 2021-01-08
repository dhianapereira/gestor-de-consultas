<?php
    namespace app\controllers;
    use src\services\MedicalAppointmentService;
    
    class MedicalAppointmentController{
        private $medical_appointment_service;

        public function __construct()
        {
            $this->medical_appointment_service =  new MedicalAppointmentService();
        }
        
        public function makeAnAppointment($patient_cpf, 
        $genre, $specialty, $date, $time){
            
            $result = $this->medical_appointment_service->makeAnAppointment($patient_cpf, 
            $genre, $specialty, $date, $time);
              
            return $result;
        }

        public function allMedicalAppointments(){
            $result = $this->medical_appointment_service->allMedicalAppointments();
                
            return $result;
        }

        public function fetchMedicalAppointment($id){
            
            $result = $this->medical_appointment_service->fetchMedicalAppointment($id);
            
            return $result;
        }

        public function update($medical_appointment){
            
            $result = $this->medical_appointment_service->update($medical_appointment);
              
            return $result;
        }
    }
?>