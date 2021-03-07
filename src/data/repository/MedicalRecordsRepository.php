<?php
require_once "src/data/repository/Connection.php";
require_once "app/models/MedicalRecords.php";
require_once "app/utils/functions.php";

class MedicalRecordsRepository
{
    public static function addMedicalRecords($patient_cpf, $symptoms, $start_date)
    {
        try {

            $result = ($symptoms / 15) * 100;
            $gravity = gravityCalculation($result);

            $sql = "INSERT INTO medical_records (cpf_patient_fk, result, gravity, start_date) 
                        VALUES (:cpf_patient_fk, :result, :gravity, :start_date)";

            $stmt = Connection::connect()->prepare($sql);

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
        }
    }

    public static function fetchMedicalRecords($cpf)
    {
        try {
            $sql = "SELECT P.full_name, P.date_of_birth, P.genre, P.naturalness,
                    P.mother_name, P.companion, P.address, 
                    MA.start_date, MA.result, MA.gravity
                    FROM patient as P
                    INNER JOIN medical_records as MA ON (P.cpf = MA.cpf_patient_fk)
                    WHERE MA.cpf_patient_fk = :cpf_patient_fk";

            $stmt = Connection::connect()->prepare($sql);

            $stmt->execute(array(
                ':cpf_patient_fk' => $cpf,
            ));

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if ($result != null) {
                $sql = "SELECT S.name
                FROM symptom as S
                INNER JOIN patient as P ON (P.cpf = S.cpf_patient_fk)
                WHERE S.cpf_patient_fk = :cpf_patient_fk";

                $stmt = Connection::connect()->prepare($sql);

                $stmt->execute(array(
                    ':cpf_patient_fk' => $cpf,
                ));

                $symptoms = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                $id = $result[0]['id'];
                $patient_name = $result[0]['full_name'];
                $date_of_birth = $result[0]['date_of_birth'];
                $genre = $result[0]['genre'];
                $naturalness = $result[0]['naturalness'];
                $companion = $result[0]['companion'];
                $mother_name = $result[0]['mother_name'];
                $address = $result[0]['address'];
                $percentage = $result[0]['result'];
                $gravity = $result[0]['gravity'];
                $start_date = $result[0]['start_date'];

                $medical_records = new MedicalRecords(
                    $id,
                    [
                        $cpf, $patient_name,
                        $date_of_birth, $genre, $naturalness,
                        $address, $mother_name, $companion, $symptoms
                    ],
                    $percentage,
                    $gravity,
                    $start_date
                );

                return $medical_records;
            }

            $response = "Não foi possível trazer o prontuário escolhido.";
            return $response;
        } catch (\Exception $e) {

            return "Exception: $e";
        }
    }

    public static function allMedicalRecords($start, $total_records)
    {
        try {
            $sql = "SELECT * FROM medical_records";

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
        }
    }

    public static function listOfSymptomsByMonth($total_days, $month_in_number)
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

            $stmt = Connection::connect()->prepare($sql);

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

                $stmt = Connection::connect()->prepare($sql);

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
        }
    }
}
