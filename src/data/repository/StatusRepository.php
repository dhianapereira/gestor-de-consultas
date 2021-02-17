<?php

namespace src\data\repository;

use src\data\repository\Connection;
use app\models\Status;

class StatusRepository
{

    private $conn;

    public function __construct()
    {
        $this->conn = new Connection();
    }


    public function allStatus()
    {
        try {
            $sql = "SELECT * FROM status";

            $stmt = $this->conn->getConnection()->prepare($sql);

            $stmt->execute();

            $result = $stmt->fetchAll();

            if ($result != null) {
                $list = [];

                foreach ($result as $row) {
                    $id = $row['id'];
                    $name = $row['name'];

                    $status = new Status($id, $name);

                    array_push($list, $status);
                }

                return $list;
            }

            $response = "Não foi possível trazer a lista de status.";
            return $response;
        } catch (\Exception $e) {

            return "Exception: $e";
        } finally {
            $this->conn->disconnect();
        }
    }
}
