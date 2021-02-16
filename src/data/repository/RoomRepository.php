<?php

namespace src\data\repository;

use src\data\repository\Connection;
use app\models\Room;

class RoomRepository
{

    private $conn;

    public function __construct()
    {
        $this->conn = new Connection();
    }

    public function register($type)
    {
        try {
            $sql = "INSERT INTO room (type) VALUES (:type)";

            $stmt = $this->conn->getConnection()->prepare($sql);

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
        } finally {

            $this->conn->disconnect();
        }
    }

    public function update($room)
    {
        try {
            $sql = "UPDATE room SET type = :type, status = :status WHERE id = :id";

            $stmt = $this->conn->getConnection()->prepare($sql);

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
        } finally {

            $this->conn->disconnect();
        }
    }

    public function allRooms()
    {
        try {
            $sql = "SELECT * FROM room";

            $stmt = $this->conn->getConnection()->prepare($sql);

            $stmt->execute();

            $result = $stmt->fetchAll();

            if ($result != null) {
                $list = [];

                foreach ($result as $row) {
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

                return $list;
            }

            $response = "Não foi possível trazer a lista de salas";
            return $response;
        } catch (\Exception $e) {

            return "Exception: $e";
        } finally {

            $this->conn->disconnect();
        }
    }


    public function fetchRoom($id)
    {
        try {
            $sql = "SELECT * FROM room WHERE id = :id";

            $stmt = $this->conn->getConnection()->prepare($sql);

            $stmt->execute(array(
                ':id' => $id,
            ));

            $result = $stmt->fetchAll();

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
        } finally {

            $this->conn->disconnect();
        }
    }
}
