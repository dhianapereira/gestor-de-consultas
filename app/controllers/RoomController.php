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

    public static function update()
    {
        $id = $_POST["id"];
        $type = $_POST["type"];
        $status = $_POST["active"];

        if (isset($id) && isset($type) && isset($status)) {
            $room = new Room($id, $type, $status);

            $result = RoomService::update($room);

            if ($result == null || !is_bool($result)) {
                $_SESSION['errorMessage'] =   $result;
                require_once "app/pages/room/update/index.php";
            } else {
                $_SESSION['successMessage'] =   "As atualizações foram realizadas com sucesso!";
                require_once "app/pages/room/update/index.php";
            }
        } else {
            $_SESSION['errorMessage'] =  "Você precisa alterar alguma informação para que a operação seja realizada.";
            require_once "app/pages/room/update/index.php";
        }
    }

    public static function allRooms($start, $total_records)
    {
        $result = RoomService::allRooms($start, $total_records);

        return $result;
    }

    public static function fetchRoom()
    {
        $id = $_POST["id"];

        if (isset($id)) {
            $room = RoomService::fetchRoom($id);

            if ($room == null || !is_object($room)) {
                $_SESSION['errorMessage'] =   "Não há nenhuma sala com o ID: $id";
                require_once "app/pages/room/search/index.php";
            } else {
                require_once "app/pages/room/update/index.php";
            }
        } else {
            $_SESSION['errorMessage'] =   "Você precisa inserir um ID!";
            require_once "app/pages/room/search/index.php";
        }
    }

    public static function listOfTypes()
    {
        $result = RoomService::listOfTypes();

        return $result;
    }
}
