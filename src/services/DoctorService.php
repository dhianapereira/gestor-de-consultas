<?php
    namespace src\services;
    use src\data\Facade;
    
    class DoctorService{

        private $facade;

        public function __construct()
        {
            $this->facade =  new Facade();
        }

        public function register($name, $genre, $specialty){

            $result = $this->facade->registerDoctor($name, $genre, $specialty);

            return $result;
        }

    }
?>
