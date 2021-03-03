<?php
require_once "src/data/Facade.php";

class PatientService
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

        $result = Facade::registerPatient(
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
        $result = Facade::updatePatient($patient);

        return $result;
    }


    public static function allPatients($start, $total_records)
    {
        $result = Facade::allPatients($start, $total_records);

        return $result;
    }

    public static function fetchPatient($cpf)
    {
        $result = Facade::fetchPatient($cpf);

        return $result;
    }
}
