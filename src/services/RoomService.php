<?php

namespace src\services;

use src\data\Facade;

class RoomService
{

    private $facade;

    public function __construct()
    {
        $this->facade =  new Facade();
    }

    public function register($type)
    {

        $result = $this->facade->registerRoom($type);

        return $result;
    }

    public function update($room)
    {

        $result = $this->facade->updateRoom($room);

        return $result;
    }

    public function allRooms()
    {
        $result = $this->facade->allRooms();

        return $result;
    }

    public function fetchRoom($id)
    {
        $result = $this->facade->fetchRoom($id);

        return $result;
    }

    public function listOfTypes()
    {
        $result = $this->facade->listOfTypes();

        return $result;
    }
}
