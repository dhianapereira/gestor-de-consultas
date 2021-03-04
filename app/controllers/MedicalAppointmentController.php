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

    public static function fetchMedicalAppointment()
    {
        $id = $_POST["id"];

        if (isset($id)) {
            $medical_appointment = MedicalAppointmentService::fetchMedicalAppointment($id);
            if ($medical_appointment == null || !is_object($medical_appointment)) {
                $_SESSION['errorMessage'] =  "Não há nenhuma consulta com o ID: $id";
                require_once "app/pages/medical_appointment/search/index.php";
            } else {
                require_once "app/pages/medical_appointment/update/index.php";
            }
        } else {
            $_SESSION['errorMessage'] =  "Você precisa inserir o ID da consulta!";
            require_once "app/pages/medical_appointment/search/index.php";
        }
    }

    public static function update()
    {
        $id = $_POST["id"];
        $specialty = $_POST["specialty"];
        $genre = $_POST["genre"];
        $room = $_POST["room"];
        $patient_cpf = $_POST["patient_cpf"];
        $date = $_POST["date"];
        $time = $_POST["time"];
        $arrival_time = $_POST["arrival_time"];
        $status = $_POST["status"];

        if (
            isset($id) && isset($specialty) && isset($genre)
            && isset($patient_cpf) && isset($status) && isset($date)
            && isset($time) && isset($arrival_time)
        ) {

            $medical_appointment = new MedicalAppointment(
                $id,
                $patient_cpf,
                [$specialty, $genre],
                $room,
                $date,
                $time,
                $arrival_time,
                $status
            );

            $result = MedicalAppointmentService::update($medical_appointment);

            if ($result == null || !is_bool($result)) {
                $_SESSION['errorMessage'] =  $result;
                require_once "app/pages/medical_appointment/update/index.php";
            } else {
                $_SESSION['successMessage'] =  "As atualizações foram realizadas com sucesso!";
                require_once "app/pages/medical_appointment/update/index.php";
            }
        } else {
            $_SESSION['errorMessage'] =  "Você precisa alterar alguma informação da consulta para que a operação seja realizada.";
            require_once "app/pages/medical_appointment/update/index.php";
        }
    }
}
