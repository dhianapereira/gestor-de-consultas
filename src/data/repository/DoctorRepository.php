<?php

namespace src\data\repository;

use src\data\repository\Connection;
use app\models\Doctor;

class DoctorRepository
{

    private $conn;

    public function __construct()
    {
        $this->conn = new Connection();
    }

    public function register($name, $genre, $specialty)
    {
        try {
            $sql = "INSERT INTO doctor (name, genre, specialty) 
                VALUES (:name, :genre, :specialty)";

            $stmt = $this->conn->getConnection()->prepare($sql);

            $success = $stmt->execute(array(
                ':name' => $name,
                ':genre' => $genre,
                ':specialty' => $specialty,
            ));

            if ($success) {
                return $success;
            }

            $response = "Não foi possível realizar o cadastro do médico(a).
            Verifique sua conexão com a internet ou tente mais tarde.";

            return $response;
        } catch (\Exception $e) {
            return "Exception: $e";
        } finally {

            $this->conn->disconnect();
        }
    }

    public function update($doctor)
    {
        try {
            $sql = "UPDATE doctor SET name = :name, genre = :genre, specialty = :specialty,
                    active = :active WHERE id = :id";

            $stmt = $this->conn->getConnection()->prepare($sql);

            $success = $stmt->execute(array(
                ':id' => $doctor->getId(),
                ':name' => $doctor->getName(),
                ':genre' => $doctor->getGenre(),
                ':specialty' => $doctor->getSpecialty(),
                ':active' => $doctor->getActive(),
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

    public function allDoctors($start, $total_records)
    {
        try {
            $sql = "SELECT * FROM doctor";

            $stmt = $this->conn->getConnection()->prepare($sql);

            $stmt->execute();

            $result = $stmt->fetchAll();

            if ($result != null) {
                $size = count($result);
                $stmt = $this->conn->getConnection()->prepare("$sql LIMIT $start, $total_records");

                $stmt->execute();

                $fetchAll = $stmt->fetchAll();

                $list = [];

                foreach ($fetchAll as $row) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $genre = $row['genre'];
                    $specialty = $row['specialty'];

                    if ($row['active']) {
                        $active = "Ativo";
                    } else {
                        $active = "Inativo";
                    }

                    $doctor = new Doctor($id, $name, $genre, $specialty, $active);

                    array_push($list, $doctor);
                }

                return [$size, $list];
            }

            $response = "Não foi possível trazer a lista de médicos";
            return $response;
        } catch (\Exception $e) {

            return "Exception: $e";
        } finally {

            $this->conn->disconnect();
        }
    }

    public function listOfSpecialties()
    {
        try {
            $sql = "SELECT specialty FROM doctor";

            $stmt = $this->conn->getConnection()->prepare($sql);

            $stmt->execute();

            $result = $stmt->fetchAll();

            if ($result != null) {
                return $result;
            }

            $response = "Não foi possível trazer a lista de especialidades";
            return $response;
        } catch (\Exception $e) {

            return "Exception: $e";
        } finally {

            $this->conn->disconnect();
        }
    }

    public function fetchDoctor($id)
    {
        try {
            $sql = "SELECT * FROM doctor WHERE id = :id";

            $stmt = $this->conn->getConnection()->prepare($sql);

            $stmt->execute(array(
                ':id' => $id,
            ));

            $result = $stmt->fetchAll();

            if ($result != null) {
                $name = $result[0]['name'];
                $genre = $result[0]['genre'];
                $specialty = $result[0]['specialty'];
                $active = $result[0]['active'];

                $doctor = new Doctor($id, $name, $genre, $specialty, $active);

                return $doctor;
            }

            $response = "Não foi possível trazer o médico(a) escolhido.";
            return $response;
        } catch (\Exception $e) {

            return "Exception: $e";
        } finally {

            $this->conn->disconnect();
        }
    }
}
