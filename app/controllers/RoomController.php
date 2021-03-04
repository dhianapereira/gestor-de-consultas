<?php
require_once "src/services/RoomService.php";

class RoomController
{
    public static function register()
    {
        $type = $_POST["type"];

        if (!isset($type)) {
            $_SESSION['errorMessage'] =  "Você precisa preencher todos os campos para realizar esta operação!";
            require_once "app/pages/room/menu/index.php";
        } else {
            $result = RoomService::register($type);

            if (!is_bool($result)) {
                $_SESSION['errorMessage'] = $result;
                require_once "app/pages/room/menu/index.php";
            } else {
                $_SESSION['successMessage'] = "O cadastro da sala foi realizado com sucesso!";
                require_once "app/pages/room/menu/index.php";
            }
        }
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
