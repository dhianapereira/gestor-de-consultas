<?php

require_once "src/data/Facade.php";

class MedicalAppointmentService
{
    public static function makeAnAppointment($patient_cpf, $genre, $specialty, $date, $time, $room)
    {

        $result = Facade::makeAnAppointment(
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
        $result = Facade::allMedicalAppointments($start, $total_records);

        return $result;
    }

    public static function fetchMedicalAppointment($id)
    {
        $result = Facade::fetchMedicalAppointment($id);

        return $result;
    }

    public static function update($medical_appointment)
    {

        $result = Facade::updateMedicalAppointment($medical_appointment);

        return $result;
    }

    public static function listOfReportsByMonth($total_days, $month_in_number)
    {

        $result = Facade::listOfReportsByMonth($total_days, $month_in_number);

        return $result;
    }
}
