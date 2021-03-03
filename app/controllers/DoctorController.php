<?php
require_once "src/services/DoctorService.php";

class DoctorController
{
    public static function register($name, $genre, $specialty)
    {
        $result = DoctorService::register($name, $genre, $specialty);

        return $result;
    }

    public static function update($doctor)
    {
        $result = DoctorService::update($doctor);

        return $result;
    }

    public static function allDoctors($start, $total_records)
    {
        $result = DoctorService::allDoctors($start, $total_records);

        return $result;
    }

    public static function fetchDoctor($id)
    {

        $result = DoctorService::fetchDoctor($id);

        return $result;
    }

    public static function listOfSpecialties()
    {
        $result = DoctorService::listOfSpecialties();

        return $result;
    }
}
