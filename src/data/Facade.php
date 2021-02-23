<?php

namespace src\data;

use src\data\repository\PatientRepository;
use src\data\repository\SymptomRepository;
use src\data\repository\MedicalRecordsRepository;
use src\data\repository\MedicalAppointmentRepository;
use src\data\repository\DoctorRepository;
use src\data\repository\UserRepository;
use src\data\repository\RoomRepository;
use src\data\repository\StatusRepository;

class Facade
{

    private $patient_repository;
    private $symptom_repository;
    private $medical_records_repository;
    private $medical_appointment_repository;
    private $doctor_repository;
    private $user_repository;
    private $room_repository;
    private $status_repository;

    public function __construct()
    {
        $this->patient_repository = new PatientRepository();
        $this->symptom_repository = new SymptomRepository();
        $this->medical_records_repository = new MedicalRecordsRepository();
        $this->medical_appointment_repository = new MedicalAppointmentRepository();
        $this->doctor_repository = new DoctorRepository();
        $this->user_repository = new UserRepository();
        $this->room_repository = new RoomRepository();
        $this->status_repository = new StatusRepository();
    }

    // Patient operations

    public function registerPatient(
        $cpf,
        $full_name,
        $genre,
        $date_of_birth,
        $mother_name,
        $companion,
        $address,
        $naturalness
    ) {

        $result = $this->patient_repository->register(
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

    public function updatePatient($patient)
    {
        $result = $this->patient_repository->update($patient);

        return $result;
    }

    public function allPatients($start, $total_records)
    {
        $result = $this->patient_repository->allPatients($start, $total_records);

        return $result;
    }

    public function fetchPatient($cpf)
    {
        $result = $this->patient_repository->fetchPatient($cpf);

        return $result;
    }

    // Medical Records operations

    public function addSymptoms($patient_cpf, $symptoms, $start_date)
    {

        $result = $this->symptom_repository->addSymptoms($patient_cpf, $symptoms);

        if (is_bool($result)) {
            $response = $this->medical_records_repository->addMedicalRecords(
                $patient_cpf,
                count($symptoms),
                $start_date
            );

            return $response;
        } else {
            return $result;
        }
    }

    public function allMedicalRecords($start, $total_records)
    {
        $result = $this->medical_records_repository->allMedicalRecords($start, $total_records);

        return $result;
    }


    public function fetchMedicalRecords($cpf)
    {
        $result = $this->medical_records_repository->fetchMedicalRecords($cpf);

        return $result;
    }

    public function fetchSymptoms($cpf)
    {
        $result = $this->symptom_repository->fetchSymptoms($cpf);

        return $result;
    }

    // Doctor operations

    public function registerDoctor($name, $genre, $specialty)
    {

        $result = $this->doctor_repository->register($name, $genre, $specialty);

        return $result;
    }

    public function updateDoctor($doctor)
    {

        $result = $this->doctor_repository->update($doctor);

        return $result;
    }

    public function allDoctors($start, $total_records)
    {
        $result = $this->doctor_repository->allDoctors($start, $total_records);

        return $result;
    }

    public function listOfSpecialties()
    {
        $result = $this->doctor_repository->listOfSpecialties();

        return $result;
    }

    public function fetchDoctor($id)
    {
        $result = $this->doctor_repository->fetchDoctor($id);

        return $result;
    }


    // Medical Appointment operations

    public function makeAnAppointment($patient_cpf, $genre, $specialty, $date, $time, $room)
    {

        $result = $this->medical_appointment_repository->makeAnAppointment(
            $patient_cpf,
            $genre,
            $specialty,
            $date,
            $time,
            $room
        );

        return $result;
    }

    public function allMedicalAppointments($start, $total_records)
    {
        $result = $this->medical_appointment_repository->allMedicalAppointments($start, $total_records);

        return $result;
    }

    public function fetchMedicalAppointment($id)
    {
        $result = $this->medical_appointment_repository->fetchMedicalAppointment($id);

        return $result;
    }

    public function updateMedicalAppointment($medical_appointment)
    {

        $result = $this->medical_appointment_repository->update($medical_appointment);

        return $result;
    }

    // User operations

    public function registerUser(
        $cpf,
        $name,
        $genre,
        $date_of_birth,
        $naturalness,
        $address,
        $responsibility
    ) {

        $result = $this->user_repository->register(
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

    public function updateUser($user)
    {

        $result = $this->user_repository->update($user);

        return $result;
    }

    public function allUsers($start, $total_records)
    {
        $result = $this->user_repository->allUsers($start, $total_records);

        return $result;
    }

    public function fetchUser($cpf)
    {
        $result = $this->user_repository->fetchUser($cpf);

        return $result;
    }

    public function signIn($username, $password)
    {
        $result = $this->user_repository->signIn($username, $password);

        return $result;
    }

    public function save($cpf, $username, $password)
    {
        $result = $this->user_repository->save($cpf, $username, $password);

        return $result;
    }

    // Room operations

    public function registerRoom($type)
    {

        $result = $this->room_repository->register($type);

        return $result;
    }

    public function updateRoom($room)
    {

        $result = $this->room_repository->update($room);

        return $result;
    }

    public function allRooms($start, $total_records)
    {
        $result = $this->room_repository->allRooms($start, $total_records);

        return $result;
    }

    public function fetchRoom($id)
    {
        $result = $this->room_repository->fetchRoom($id);

        return $result;
    }

    public function listOfTypes()
    {
        $result = $this->room_repository->listOfTypes();

        return $result;
    }

    public function allStatus()
    {
        $result = $this->status_repository->allStatus();

        return $result;
    }
}
