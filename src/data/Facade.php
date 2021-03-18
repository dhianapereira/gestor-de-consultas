<?php

require_once "src/data/repository/UserRepository.php";
require_once "src/data/repository/MedicalAppointmentRepository.php";
require_once "src/data/repository/PatientRepository.php";
require_once "src/data/repository/DoctorRepository.php";
require_once "src/data/repository/MedicalRecordsRepository.php";
require_once "src/data/repository/SymptomRepository.php";
require_once "src/data/repository/RoomRepository.php";

class Facade
{

    //Patient Operations

    public static function registerPatient(
        $cpf,
        $full_name,
        $genre,
        $date_of_birth,
        $mother_name,
        $companion,
        $address,
        $naturalness,
        $photograph
    ) {

        $result = PatientRepository::register(
            $cpf,
            $full_name,
            $genre,
            $date_of_birth,
            $mother_name,
            $companion,
            $address,
            $naturalness,
            $photograph
        );

        return $result;
    }

    public static function updatePatient($patient)
    {
        $result = PatientRepository::update($patient);

        return $result;
    }

    public static function allPatients($start, $total_records)
    {
        $result = PatientRepository::allPatients($start, $total_records);

        return $result;
    }

    public static function fetchPatient($cpf)
    {
        $result = PatientRepository::fetchPatient($cpf);

        return $result;
    }

    // Doctor Operations

    public static function registerDoctor($name, $genre, $specialty)
    {
        $result = DoctorRepository::register($name, $genre, $specialty);

        return $result;
    }

    public static function updateDoctor($doctor)
    {
        $result = DoctorRepository::update($doctor);

        return $result;
    }

    public static function allDoctors($start, $total_records)
    {
        $result = DoctorRepository::allDoctors($start, $total_records);

        return $result;
    }

    public static function listOfSpecialties()
    {
        $result = DoctorRepository::listOfSpecialties();

        return $result;
    }

    public static function fetchDoctor($id)
    {
        $result = DoctorRepository::fetchDoctor($id);

        return $result;
    }

    // Medical Records operations

    public static function addSymptoms($patient_cpf, $symptoms, $start_date)
    {
        $result = SymptomRepository::addSymptoms($patient_cpf, $symptoms);

        if (is_bool($result)) {
            $response = MedicalRecordsRepository::addMedicalRecords(
                $patient_cpf,
                count($symptoms),
                $start_date
            );

            return $response;
        } else {
            return $result;
        }
    }

    public static function allMedicalRecords($start, $total_records)
    {
        $result = MedicalRecordsRepository::allMedicalRecords($start, $total_records);

        return $result;
    }


    public static function fetchMedicalRecords($cpf)
    {
        $result = MedicalRecordsRepository::fetchMedicalRecords($cpf);

        return $result;
    }


    public static function listOfSymptomsByMonth($total_days, $month_in_number)
    {
        $result = MedicalRecordsRepository::listOfSymptomsByMonth($total_days, $month_in_number);

        return $result;
    }

    public static function fetchSymptoms($cpf)
    {
        $result = SymptomRepository::fetchSymptoms($cpf);

        return $result;
    }

    // Medical Appointment Operations

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

    public static function listOfReportsByMonth($total_days, $month_in_number)
    {
        $result = MedicalAppointmentRepository::listOfReportsByMonth($total_days, $month_in_number);

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

    // Room operations

    public static function registerRoom($type)
    {
        $result = RoomRepository::register($type);

        return $result;
    }

    public static function updateRoom($room)
    {
        $result = RoomRepository::update($room);

        return $result;
    }

    public static function allRooms($start, $total_records)
    {
        $result = RoomRepository::allRooms($start, $total_records);

        return $result;
    }

    public static function fetchRoom($id)
    {
        $result = RoomRepository::fetchRoom($id);

        return $result;
    }

    public static function listOfTypes()
    {
        $result = RoomRepository::listOfTypes();

        return $result;
    }
}
