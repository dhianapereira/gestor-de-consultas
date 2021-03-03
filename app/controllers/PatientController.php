<?php
require_once "src/services/PatientService.php";

class PatientController
{
    public static function register(
        $cpf,
        $full_name,
        $genre,
        $date_of_birth,
        $mother_name,
        $companion,
        $address,
        $naturalness
    ) {

        $result = PatientService::register(
            $cpf,
            $full_name,
            $genre,
            $date_of_birth,
            $mother_name,
            $companion,
            $address,
            $naturalness
        );

        return $result;
    }

    public static function update($patient)
    {
        $result = PatientService::update($patient);

        return $result;
    }


    public static function allPatients($start, $total_records)
    {
        $result = PatientService::allPatients($start, $total_records);

        return $result;
    }

    public static function fetchPatient($cpf)
    {
        $result = PatientService::fetchPatient($cpf);

        return $result;
    }
}
