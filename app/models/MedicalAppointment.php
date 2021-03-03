<?php
class MedicalAppointment
{
    private $id;
    private $patient_cpf;
    private $id_doctor;
    private $time;
    private $arrival_time;
    private $date;
    private $status;
    private $id_room;


    public function getId()
    {
        return $this->id;
    }

    public function getPatientCpf()
    {
        return $this->patient_cpf;
    }

    public function getIdDoctor()
    {
        return $this->id_doctor;
    }

    public function getIdRoom()
    {
        return $this->id_room;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getArrivalTime()
    {
        return $this->arrival_time;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function __construct(
        $id,
        $patient_cpf,
        $id_doctor,
        $id_room,
        $date,
        $time,
        $arrival_time,
        $status
    ) {
        $this->id = $id;
        $this->patient_cpf = $patient_cpf;
        $this->id_doctor = $id_doctor;
        $this->id_room = $id_room;
        $this->date = $date;
        $this->time = $time;
        $this->arrival_time = $arrival_time;
        $this->status = $status;
    }
}
