<?php
require_once "src/services/RoomService.php";

class RoomController
{
    public static function register($type)
    {
        $result = RoomService::register($type);

        return $result;
    }

    public static function update($room)
    {
        $result = RoomService::update($room);

        return $result;
    }

    public static function allRooms($start, $total_records)
    {
        $result = RoomService::allRooms($start, $total_records);

        return $result;
    }

    public static function fetchRoom($id)
    {
        $result = RoomService::fetchRoom($id);

        return $result;
    }

    public static function listOfTypes()
    {
        $result = RoomService::listOfTypes();

        return $result;
    }
}
