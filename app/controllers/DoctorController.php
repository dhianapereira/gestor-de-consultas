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
    }
?>