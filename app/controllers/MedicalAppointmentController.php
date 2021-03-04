<?php

require_once "src/services/MedicalAppointmentService.php";

class MedicalAppointmentController
{
    public static function makeAnAppointment()
    {

        $patient_cpf = $_POST["patient_cpf"];
        $specialty = $_POST["specialty"];
        $genre = $_POST["genre"];
        $date = $_POST["date"];
        $time = $_POST["time"];
        $room = $_POST["room"];

        if (
            !isset($specialty) || !isset($patient_cpf) || !isset($genre)
            || !isset($date) || !isset($time) || !isset($room)
        ) {
            $_SESSION['errorMessage'] = "Você precisa preencher todos os campos para realizar esta operação!";
            require_once "app/pages/medical_appointment/register/index.php";
        } else {

            $result = MedicalAppointmentService::makeAnAppointment(
                $patient_cpf,
                $genre,
                $specialty,
                $date,
                $time,
                $room
            );

            if (!is_bool($result)) {
                $_SESSION['errorMessage'] = $result;
                require_once "app/pages/medical_appointment/register/index.php";
            } else {
                $_SESSION['successMessage'] = "A consulta foi marcada com sucesso!";
                require_once "app/pages/medical_appointment/register/index.php";
            }
        }
    }

    public static function allMedicalAppointments($start, $total_records)
    {
        $result = MedicalAppointmentService::allMedicalAppointments($start, $total_records);

        return $result;
    }

    public static function fetchMedicalAppointment($id)
    {

        $result = MedicalAppointmentService::fetchMedicalAppointment($id);

        return $result;
    }

    public static function update($medical_appointment)
    {

        $result = MedicalAppointmentService::update($medical_appointment);

        return $result;
    }
}
