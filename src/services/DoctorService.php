<?php
require_once "src/data/Facade.php";

class DoctorService
{
    public static function register($name, $genre, $specialty)
    {

        $result = Facade::registerDoctor($name, $genre, $specialty);

        return $result;
    }

    public static function update($doctor)
    {
        $result = Facade::updateDoctor($doctor);

        return $result;
    }

    public static function allDoctors($start, $total_records)
    {
        $result = Facade::allDoctors($start, $total_records);

        return $result;
    }

    public static function fetchDoctor($id)
    {
        $result = Facade::fetchDoctor($id);

        return $result;
    }

    public static function listOfSpecialties()
    {
        $result = Facade::listOfSpecialties();

        return $result;
    }
}
