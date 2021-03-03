<?php

require_once "src/services/MedicalAppointmentService.php";

class MedicalAppointmentController
{
    public static function makeAnAppointment(
        $patient_cpf,
        $genre,
        $specialty,
        $date,
        $time,
        $room
    ) {

        $result = MedicalAppointmentService::makeAnAppointment(
            $patient_cpf,
            $genre,
            $specialty,
            $date,
            $time,
            $room
        );

        return $result;
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
