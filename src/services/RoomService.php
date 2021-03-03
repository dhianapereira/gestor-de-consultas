<?php
require_once "src/data/Facade.php";

class RoomService
{
    public static function register($type)
    {
        $result = Facade::registerRoom($type);

        return $result;
    }

    public static function update($room)
    {
        $result = Facade::updateRoom($room);

        return $result;
    }

    public static function allRooms($start, $total_records)
    {
        $result = Facade::allRooms($start, $total_records);

        return $result;
    }

    public static function fetchRoom($id)
    {
        $result = Facade::fetchRoom($id);

        return $result;
    }

    public static function listOfTypes()
    {
        $result = Facade::listOfTypes();

        return $result;
    }
}
