<?php
    namespace app\controllers;
    use src\services\RoomService;
    
    class RoomController{
        private $room_service;

        public function __construct()
        {
            $this->room_service =  new RoomService();
        }
        
        public function register($type){
            
            $result = $this->room_service->register($type);
              
            return $result;
        }

        public function update($room){
            
            $result = $this->room_service->update($room);
              
            return $result;
        }

        public function allRooms(){
            $result = $this->room_service->allRooms();
                
            return $result;
        }

        public function fetchRoom($id){
            
            $result = $this->room_service->fetchRoom($id);
            
            return $result;
        }

        public function listOfTypes(){
            $result = $this->room_service->listOfTypes();
                
            return $result;
        }
    }
