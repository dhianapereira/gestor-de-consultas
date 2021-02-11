<?php
    namespace app\controllers;
    use src\services\DoctorService;
    
    class DoctorController{
        private $doctor_service;

        public function __construct()
        {
            $this->doctor_service =  new DoctorService();
        }
        
        public function register($name, $genre, $specialty){
            
            $result = $this->doctor_service->register($name, $genre, $specialty);
              
            return $result;
        }

        public function update($doctor){
            
            $result = $this->doctor_service->update($doctor);
              
            return $result;
        }

        public function allDoctors(){
            $result = $this->doctor_service->allDoctors();
                
            return $result;
        }

        public function fetchDoctor($id){
            
            $result = $this->doctor_service->fetchDoctor($id);
            
            return $result;
        }

        public function listOfSpecialties(){
            $result = $this->doctor_service->listOfSpecialties();
                
            return $result;
        }
    }
?>