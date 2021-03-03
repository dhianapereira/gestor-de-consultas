<?php

require_once "src/data/repository/UserRepository.php";
require_once "src/data/repository/MedicalAppointmentRepository.php";

class Facade
{

    public static function makeAnAppointment($patient_cpf, $genre, $specialty, $date, $time, $room)
    {

        $result = MedicalAppointmentRepository::makeAnAppointment(
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
        $result = MedicalAppointmentRepository::allMedicalAppointments($start, $total_records);

        return $result;
    }

    public static function fetchMedicalAppointment($id)
    {
        $result = MedicalAppointmentRepository::fetchMedicalAppointment($id);

        return $result;
    }

    public static function updateMedicalAppointment($medical_appointment)
    {
        $result = MedicalAppointmentRepository::update($medical_appointment);

        return $result;
    }

    // User operations

    public static function registerUser(
        $cpf,
        $name,
        $genre,
        $date_of_birth,
        $naturalness,
        $address,
        $responsibility
    ) {

        $result = UserRepository::register(
            $cpf,
            $name,
            $genre,
            $date_of_birth,
            $naturalness,
            $address,
            $responsibility
        );

        return $result;
    }

    public static function updateUser($user)
    {
        $result = UserRepository::update($user);

        return $result;
    }

    public static function allUsers($start, $total_records)
    {
        $result = UserRepository::allUsers($start, $total_records);

        return $result;
    }

    public static function fetchUser($cpf)
    {
        $result = UserRepository::fetchUser($cpf);

        return $result;
    }

    public static function signIn($username, $password)
    {
        $result = UserRepository::signIn($username, $password);

        return $result;
    }

    public static function save($cpf, $username, $password)
    {
        $result = UserRepository::save($cpf, $username, $password);

        return $result;
    }
}
