<?php
require_once "src/data/repository/Connection.php";
require_once "app/models/Room.php";

class RoomRepository
{
    public static function register($type)
    {
        try {
            $sql = "INSERT INTO room (type) VALUES (:type)";

            $stmt = Connection::connect()->prepare($sql);

            $success = $stmt->execute(array(
                ':type' => $type,
            ));

            if ($success) {
                return $success;
            }

            $response = "Não foi possível realizar o cadastro da sala.
            Verifique sua conexão com a internet ou tente mais tarde.";

            return $response;
        } catch (\Exception $e) {
            return "Exception: $e";
        }
    }

    public static function update($room)
    {
        try {
            $sql = "UPDATE room SET type = :type, status = :status WHERE id = :id";

            $stmt = Connection::connect()->prepare($sql);

            $success = $stmt->execute(array(
                ':id' => $room->getId(),
                ':type' => $room->getType(),
                ':status' => $room->getStatus(),
            ));

            if ($success) {
                return $success;
            }

            $response = "Não foi possível realizar as alterações desejadas.
            Verifique sua conexão com a internet ou tente mais tarde.";

            return $response;
        } catch (\Exception $e) {
            return "Exception: $e";
        }
    }

    public static function allRooms($start, $total_records)
    {
        try {
            $sql = "SELECT * FROM room";

            $stmt = Connection::connect()->prepare($sql);

            $stmt->execute();

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if ($result != null) {
                $size = count($result);

                $stmt = Connection::connect()->prepare("$sql LIMIT $start, $total_records");

                $stmt->execute();

                $fetchAll = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                $list = [];

                foreach ($fetchAll as $row) {
                    $id = $row['id'];
                    $type = $row['type'];

                    if ($row['status']) {
                        $status = "Ocupada";
                    } else {
                        $status = "Liberada";
                    }

                    $room = new Room($id, $type, $status);

                    array_push($list, $room);
                }

                return [$size, $list];
            }

            $response = "Não foi possível trazer a lista de salas";
            return $response;
        } catch (\Exception $e) {

            return "Exception: $e";
        }
    }


    public static function fetchRoom($id)
    {
        try {
            $sql = "SELECT * FROM room WHERE id = :id";

            $stmt = Connection::connect()->prepare($sql);

            $stmt->execute(array(
                ':id' => $id,
            ));

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if ($result != null) {
                $type = $result[0]['type'];
                $status = $result[0]['status'];

                $room = new Room($id, $type, $status);

                return $room;
            }

            $response = "Não foi possível trazer a sala escolhido.";
            return $response;
        } catch (\Exception $e) {

            return "Exception: $e";
        }
    }

    public static function listOfTypes()
    {
        try {
            $sql = "SELECT type, id FROM room WHERE status = :status";

            $stmt = Connection::connect()->prepare($sql);

            $stmt->execute(array(
                ':status' => 0,
            ));

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if ($result != null) {
                return $result;
            }

            $response = "Não foi possível trazer a lista de tipos de sala";
            return $response;
        } catch (\Exception $e) {

            return "Exception: $e";
        }
    }
}
