<?php
require_once "src/data/repository/Connection.php";
require_once "app/models/Patient.php";

class PatientRepository
{
    public static function register(
        $cpf,
        $full_name,
        $genre,
        $date_of_birth,
        $mother_name,
        $companion,
        $address,
        $naturalness,
        $photograph
    ) {
        try {
            $sql = "INSERT INTO patient (
                    cpf, full_name, genre, date_of_birth, 
                    mother_name, companion, address, naturalness, photograph,  
                ) VALUES (
                    :cpf, :full_name, :genre, :date_of_birth, 
                    :mother_name, :companion, :address ,:naturalness, :photograph
                )";

            $stmt = Connection::connect()->prepare($sql);

            $success = $stmt->execute(array(
                ':cpf' => $cpf,
                ':full_name' => $full_name,
                ':genre' => $genre,
                ':date_of_birth' => $date_of_birth,
                ':mother_name' => $mother_name,
                ':companion' => $companion,
                ':address' => $address,
                ':naturalness' => $naturalness,
                ':photograph' => $photograph
                
            ));


            if ($success) {
                return $success;
            }


            $response = "Não foi possível realizar o cadastro do paciente.
            Verifique sua conexão com a internet ou tente mais tarde.";

            return $response;
        } catch (\Exception $e) {
            return "Exception: $e";
        }
    }

    public static function update($patient)
    {
        try {
            $sql = "UPDATE patient SET full_name = :full_name, date_of_birth = :date_of_birth, 
                    mother_name = :mother_name, genre = :genre, companion = :companion,
                    address = :address, naturalness = :naturalness, active = :active
                    WHERE cpf = :cpf";

            $stmt = Connection::connect()->prepare($sql);

            $success = $stmt->execute(array(
                ':cpf' => $patient->getCpf(),
                ':full_name' => $patient->getName(),
                ':date_of_birth' => $patient->getDateOfBirth(),
                ':mother_name' => $patient->getMotherName(),
                ':genre' => $patient->getGenre(),
                ':companion' => $patient->getCompanion(),
                ':address' => $patient->getAddress(),
                ':naturalness' => $patient->getNaturalness(),
                ':active' =>  $patient->getActive()
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

    public static function allPatients($start, $total_records)
    {
        try {
            $sql = "SELECT * FROM patient";

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
                    $cpf = $row['cpf'];
                    $full_name = $row['full_name'];
                    $genre = $row['genre'];
                    $date_of_birth = $row['date_of_birth'];
                    $mother_name = $row['mother_name'];
                    $companion = $row['companion'];
                    $address = $row['address'];
                    $naturalness = $row['naturalness'];
                    $photograph = $row['photograph'];

                    if ($row['active']) {
                        $active = "Ativo";
                    } else {
                        $active = "Inativo";
                    }

                    $patient = new Patient(
                        $cpf,
                        $full_name,
                        $genre,
                        $date_of_birth,
                        $mother_name,
                        $companion,
                        $address,
                        $naturalness,
                        $active,
                        $photograph
                    );

                    array_push($list, $patient);
                }

                return [$size, $list];
            }

            $response = "Não foi possível trazer a lista de pacientes";
            return $response;
        } catch (\Exception $e) {

            return "Exception: $e";
        }
    }

    public static function fetchPatient($cpf)
    {
        try {
            $sql = "SELECT * FROM patient WHERE cpf = :cpf";

            $stmt = Connection::connect()->prepare($sql);

            $stmt->execute(array(
                ':cpf' => $cpf,
            ));

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if ($result != null) {
                $full_name = $result[0]['full_name'];
                $genre = $result[0]['genre'];
                $date_of_birth = $result[0]['date_of_birth'];
                $mother_name = $result[0]['mother_name'];
                $companion = $result[0]['companion'];
                $address = $result[0]['address'];
                $naturalness = $result[0]['naturalness'];
                $active = $result[0]['active'];
                $photograph = $result[0]['photograph'];

                $patient = new Patient(
                    $cpf,
                    $full_name,
                    $genre,
                    $date_of_birth,
                    $mother_name,
                    $companion,
                    $address,
                    $naturalness,
                    $active,
                    $photograph
                );

                return $patient;
            }

            $response = "Não foi possível trazer o paciente escolhido.";
            return $response;
        } catch (\Exception $e) {

            return "Exception: $e";
        }
    }
}
