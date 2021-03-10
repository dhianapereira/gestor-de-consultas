<?php
require_once "src/data/repository/Connection.php";
require_once "app/models/MedicalAppointment.php";

class MedicalAppointmentRepository
{
    public static function makeAnAppointment($patient_cpf, $genre, $specialty, $date, $time, $room)
    {
        try {
            require_once "app/utils/constants.php";

            $select = "SELECT id FROM doctor WHERE genre = :genre AND specialty = :specialty AND active = :active";

            $stmt = Connection::connect()->prepare($select);

            $stmt->execute(array(
                ':genre' => $genre,
                ':specialty' => $specialty,
                ':active' => 1,
            ));

            $doctor = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if ($doctor != null) {
                $id_doctor = $doctor[0]['id'];

                $sql = "INSERT INTO medical_appointment (cpf_patient_fk, id_doctor_fk, 
                        id_room_fk, time, date, status) 
                        VALUES (:cpf_patient_fk, :id_doctor_fk,:id_room_fk, :time, :date, :status)";


                $stmt = Connection::connect()->prepare($sql);

                $success = $stmt->execute(array(
                    ':cpf_patient_fk' => $patient_cpf,
                    ':id_doctor_fk' => $id_doctor,
                    ':id_room_fk' => $room,
                    ':time' => $time,
                    ':date' => $date,
                    ':status' => $allStatus[0]
                ));

                if ($success) {
                    return $success;
                }

                $response = "Não foi possível marcar a consulta. Tente mais tarde.";

                return $response;
            }

            return "Não há nenhum médico com essa descrição, por isso não foi possível marcar a consulta.";
        } catch (\Exception $e) {
            return "Exception: $e";
        }
    }

    public static function allMedicalAppointments($start, $total_records)
    {
        try {
            require_once "app/utils/constants.php";

            $sql = "SELECT MA.id, P.full_name, D.name, MA.time, 
                    MA.date, MA.arrival_time, MA.id_room_fk, R.type,
                    MA.status
                    FROM medical_appointment AS MA
                        INNER JOIN patient AS P 
                            ON (MA.cpf_patient_fk = P.cpf)
                        INNER JOIN doctor AS D 
                            ON (MA.id_doctor_fk = D.id)
                        INNER JOIN room AS R
                            ON (MA.id_room_fk = R.id)
                    WHERE MA.status NOT IN (:status)
                    ORDER BY MA.arrival_time IS NULL, MA.arrival_time ASC, MA.time ASC";

            $stmt = Connection::connect()->prepare($sql);

            $stmt->execute(array(
                ':status' => $allStatus[1],
            ));

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if ($result != null) {
                $size = count($result);

                $stmt = Connection::connect()->prepare("$sql LIMIT $start, $total_records");

                $stmt->execute(array(
                    ':status' => $allStatus[1],
                ));

                $fetchAll = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                $list = [];

                foreach ($fetchAll as $row) {
                    $id = $row['id'];
                    $patient = $row['full_name'];
                    $doctor = $row['name'];
                    $time = $row['time'];
                    $date = $row['date'];
                    $type = $row['type'];
                    $id_room = $row['id_room_fk'];
                    $status = $row['status'];

                    if ($row['arrival_time'] != null) {
                        $arrival_time = $row['arrival_time'];
                    } else {
                        $arrival_time = "-----";
                    }

                    $medical_appointment = new MedicalAppointment(
                        $id,
                        $patient,
                        $doctor,
                        [$id_room, $type],
                        $date,
                        $time,
                        $arrival_time,
                        $status
                    );

                    array_push($list, $medical_appointment);
                }

                return [$size, $list];
            }

            $response = "Não foi possível trazer a lista de consultas";

            return $response;
        } catch (\Exception $e) {

            return "Exception: $e";
        }
    }

    public static function fetchMedicalAppointment($id)
    {
        try {
            $sql = "SELECT D.specialty, D.genre, D.name, MA.id,
                    MA.date, MA.cpf_patient_fk ,MA.time, MA.arrival_time,
                    MA.id_room_fk, R.type, MA.status
                    FROM medical_appointment AS MA
                        INNER JOIN doctor AS D 
                            ON (MA.id_doctor_fk = D.id)
                        INNER JOIN room AS R
                            ON (MA.id_room_fk = R.id)
                    WHERE MA.id = :id
                    GROUP BY D.specialty, D.genre, D.name, MA.id,
                        MA.date, MA.cpf_patient_fk , MA.time, 
                        MA.arrival_time, MA.id_room_fk, R.type,
                        MA.status";

            $stmt = Connection::connect()->prepare($sql);

            $stmt->execute(array(
                ':id' => $id,
            ));

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if ($result != null) {
                $name = $result[0]['name'];
                $genre = $result[0]['genre'];
                $specialty = $result[0]['specialty'];
                $status = $result[0]['status'];
                $date = $result[0]['date'];
                $time = $result[0]['time'];
                $patient_cpf = $result[0]['cpf_patient_fk'];
                $type = $result[0]['type'];
                $id_room = $result[0]['id_room_fk'];

                if ($result[0]['arrival_time'] != null) {
                    $arrival_time = $result[0]['arrival_time'];
                } else {
                    $arrival_time = "-----";
                }

                $medical_appointment = new MedicalAppointment(
                    $id,
                    $patient_cpf,
                    [$name, $specialty, $genre],
                    [$id_room, $type],
                    $date,
                    $time,
                    $arrival_time,
                    $status
                );

                return $medical_appointment;
            }

            $response = "Não foi possível trazer a consulta escolhida.";
            return $response;
        } catch (\Exception $e) {

            return "Exception: $e";
        }
    }

    public static function update($medical_appointment)
    {
        try {

            $select = "SELECT id FROM doctor WHERE genre = :genre AND specialty = :specialty AND active = :active";

            $stmt = Connection::connect()->prepare($select);

            $stmt->execute(array(
                ':specialty' => $medical_appointment->getIdDoctor()[0],
                ':genre' => $medical_appointment->getIdDoctor()[1],
                ':active' => 1,
            ));

            $doctor = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if ($doctor != null) {
                $id_doctor = $doctor[0]['id'];

                $sql = "UPDATE medical_appointment SET cpf_patient_fk = :cpf_patient_fk,
                id_doctor_fk = :id_doctor_fk, id_room_fk = :id_room_fk, time = :time, 
                date = :date, arrival_time = :arrival_time, status = :status 
                WHERE id = :id";

                $stmt = Connection::connect()->prepare($sql);

                $success = $stmt->execute(array(
                    ':id' => $medical_appointment->getId(),
                    ':cpf_patient_fk' => $medical_appointment->getPatientCpf(),
                    ':id_doctor_fk' => $id_doctor,
                    ':id_room_fk' => $medical_appointment->getIdRoom(),
                    ':time' => $medical_appointment->getTime(),
                    ':date' => $medical_appointment->getDate(),
                    ':arrival_time' => $medical_appointment->getArrivalTime(),
                    ':status' => $medical_appointment->getStatus(),
                ));

                if ($success) {
                    $sql = "UPDATE room SET status = :status WHERE id = :id";

                    $stmt = Connection::connect()->prepare($sql);

                    if ($medical_appointment->getStatus() != "Em Andamento") {
                        $status = 0;
                    } else {
                        $status = 1;
                    }

                    $success = $stmt->execute(array(
                        ':id' => $medical_appointment->getIdRoom(),
                        ':status' => $status
                    ));

                    if ($success) {
                        return $success;
                    }

                    $response = "Não foi possível realizar as alterações desejadas na consulta. Tente mais tarde";

                    return $response;
                }

                $response = "Não foi possível realizar as alterações desejadas na consulta. Tente mais tarde";

                return $response;
            }

            return "Não há nenhum médico com essa descrição, por isso não foi possível realizar a alteração.";
        } catch (\Exception $e) {
            return "Exception: $e";
        }
    }

    public static function listOfReportsByMonth($total_days, $month_in_number)
    {
        try {
            $initial_date = "2021" . $month_in_number . "01";
            $final_date = "2021" . $month_in_number . $total_days;

            $sql = "SELECT  MA.id, P.full_name, D.name, MA.time, 
                    MA.date, MA.arrival_time, MA.id_room_fk, R.type, MA.status
                    FROM medical_appointment AS MA
                        INNER JOIN patient AS P 
                            ON (MA.cpf_patient_fk = P.cpf)
                        INNER JOIN doctor AS D 
                            ON (MA.id_doctor_fk = D.id)
                        INNER JOIN room AS R
                            ON (MA.id_room_fk = R.id)
                    WHERE MR.date BETWEEN ? AND ?  
                    GROUP BY MA.id, P.full_name, D.name, MA.time, 
                    MA.date, MA.arrival_time, MA.id_room_fk, R.type, MA.status";

            $stmt = Connection::connect()->prepare($sql);

            $stmt->bindParam(1, $initial_date);
            $stmt->bindParam(2, $final_date);

            $stmt->execute();

            $stmt->setFetchMode(\PDO::FETCH_ASSOC);

            $reports = $stmt->fetch();

            if ($reports != null) {
                $list = [];

                foreach ($reports as $row) {
                    $id = $row['id'];
                    $patient = $row['full_name'];
                    $doctor = $row['name'];
                    $time = $row['time'];
                    $date = $row['date'];
                    $type = $row['type'];
                    $id_room = $row['id_room_fk'];
                    $status = $row['status'];

                    if ($row['arrival_time'] != null) {
                        $arrival_time = $row['arrival_time'];
                    } else {
                        $arrival_time = "-----";
                    }

                    $medical_appointment = new MedicalAppointment(
                        $id,
                        $patient,
                        $doctor,
                        [$id_room, $type],
                        $date,
                        $time,
                        $arrival_time,
                        $status
                    );

                    array_push($list, $medical_appointment);
                }

                return $list;
            }
            $response = "Não foi possível realizar esta operação";
            return $response;
        } catch (\Exception $e) {

            return "Exception: $e";
        }
    }
}
