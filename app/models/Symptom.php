<?php
class Symptom
{
    private $id;
    private $patient_cpf;
    private $name;


    public function getPatientCpf()
    {
        return $this->patient_cpf;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function __construct($id, $patient_cpf, $name)
    {
        $this->id = $id;
        $this->patient_cpf = $patient_cpf;
        $this->name = $name;
    }
}
