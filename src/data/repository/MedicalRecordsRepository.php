<?php

namespace src\data\repository;

use src\data\repository\Connection;
use app\models\MedicalRecords;

class MedicalRecordsRepository
{

    private $conn;

    public function __construct()
    {
        $this->conn = new Connection();
    }

    private function gravityCalculation($percentage)
    {
        if ($percentage == 0) {
            return "Inexistente";
        } else if ($percentage <= 25 && $percentage > 0) {
            return "Baixa";
        } else if ($percentage > 25 && $percentage <= 50) {
            return "Média";
        } else if ($percentage > 50 && $percentage <= 75) {
            return "Alta";
        } else {
            return "Muito alta";
        }
    }

    public function addMedicalRecords($patient_cpf, $symptoms, $start_date)
    {
        try {

            $result = ($symptoms / 15) * 100;
            $gravity = $this->gravityCalculation($result);

            $sql = "INSERT INTO medical_records (cpf_patient_fk, result, gravity, start_date) 
                        VALUES (:cpf_patient_fk, :result, :gravity, :start_date)";

            $stmt = $this->conn->getConnection()->prepare($sql);

            $success = $stmt->execute(array(
                ':cpf_patient_fk' => $patient_cpf,
                ':result' => $result,
                ':gravity' => $gravity,
                ':start_date' => $start_date,
            ));

            if ($success) {
                return $success;
            }

            $response = "Ocorreu um erro que impossibilitou a criação do prontuário médico.";

            return $response;
        } catch (\Exception $e) {
            return "Exception: $e";
        } finally {
            $this->conn->disconnect();
        }
    }

    public function fetchMedicalRecords($cpf)
    {
        try {
            $sql = "SELECT * FROM medical_records WHERE cpf_patient_fk = :cpf_patient_fk";

            $stmt = $this->conn->getConnection()->prepare($sql);

            $stmt->execute(array(
                ':cpf_patient_fk' => $cpf,
            ));

            $result = $stmt->fetchAll();

            if ($result != null) {
                $id = $result[0]['id'];
                $patient_cpf = $result[0]['cpf_patient_fk'];
                $percentage = $result[0]['result'];
                $gravity = $result[0]['gravity'];
                $start_date = $result[0]['start_date'];

                $medical_records = new MedicalRecords($id, $patient_cpf, $percentage, $gravity, $start_date);

                return $medical_records;
            }

            $response = "Não foi possível trazer o prontuário escolhido.";
            return $response;
        } catch (\Exception $e) {

            return "Exception: $e";
        } finally {
            $this->conn->disconnect();
        }
    }

    public function allMedicalRecords($start, $total_records)
    {
        try {
            $sql = "SELECT * FROM medical_records";

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
                    $patient_cpf = $row['cpf_patient_fk'];
                    $result = $row['result'];
                    $gravity = $row['gravity'];
                    $start_date = $row['start_date'];

                    $medical_records = new MedicalRecords($id, $patient_cpf, $result, $gravity, $start_date);

                    array_push($list, $medical_records);
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
    public function listOfSymptomsByMonth($total_days, $month_in_number)
    {
        try {
            $initial_date = "2021" . $month_in_number . "01";
            $final_date = "2021" . $month_in_number . $total_days;

            $sql = "SELECT MAX(amount) as larger 
                FROM (
                    SELECT count(S.name) as amount 
                    FROM patient as P 
                    INNER JOIN medical_records as MR on (P.cpf = MR.cpf_patient_fk) 
                    INNER JOIN symptom as S on (S.cpf_patient_fk = P.cpf) 
                    WHERE MR.start_date between ? and ? 
                    GROUP BY S.name
                ) as repeated";

            $stmt = $this->conn->getConnection()->prepare($sql);

            $stmt->bindParam(1, $initial_date);
            $stmt->bindParam(2, $final_date);

            $stmt->execute();
            $stmt->setFetchMode(\PDO::FETCH_ASSOC);

            $larger = $stmt->fetch();

            if ($larger != null) {
                $sql = "SELECT symptom FROM (
                            SELECT count(S.name) as amount, S.name as symptom 
                            FROM patient as P 
                                INNER JOIN medical_records as MR on (P.cpf = MR.cpf_patient_fk) 
                                INNER JOIN symptom as S on (S.cpf_patient_fk = P.cpf) 
                            WHERE MR.start_date between ? and ?
                            GROUP BY S.name) as larger
                            WHERE amount = ?";

                $stmt = $this->conn->getConnection()->prepare($sql);

                $stmt->bindParam(1, $initial_date);
                $stmt->bindParam(2, $final_date);
                $stmt->bindParam(3, $larger['larger']);

                $stmt->execute();

                $stmt->setFetchMode(\PDO::FETCH_ASSOC);

                $symptom = $stmt->fetch();

                if ($symptom != null) {
                    $percentage =  intval($larger['larger']) * 100 / 15;

                    return [$symptom['symptom'], number_format($percentage, 2)];
                }

                $response = "Não foi possível 333realizar esta operação";

                return $response;
            }

            $response = "Não foi possível realizar esta operação";

            return $response;
        } catch (\Exception $e) {

            return "Exception: $e";
        } finally {
            $this->conn->disconnect();
        }
    }
}
