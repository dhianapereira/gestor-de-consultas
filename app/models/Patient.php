<?php
class Patient
{
    private $cpf;
    private $full_name;
    private $genre;
    private $date_of_birth;
    private $mother_name;
    private $naturalness;
    private $companion;
    private $address;
    private $active;
    private $photograph;


    public function getCpf()
    {
        return $this->cpf;
    }

    public function getName()
    {
        return $this->full_name;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function getDateOfBirth()
    {
        return $this->date_of_birth;
    }

    public function getMotherName()
    {
        return $this->mother_name;
    }

    public function getCompanion()
    {
        return $this->companion;
    }

    public function getNaturalness()
    {
        return $this->naturalness;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function getPhotograph()
    {
        return $this->photograph;
    }


    public function __construct(
        $cpf,
        $full_name,
        $genre,
        $date_of_birth,
        $mother_name,
        $companion,
        $address,
        $naturalness,
        $active,
        $photograph
    ) {
        $this->cpf = $cpf;
        $this->full_name = $full_name;
        $this->genre = $genre;
        $this->date_of_birth = $date_of_birth;
        $this->mother_name = $mother_name;
        $this->companion = $companion;
        $this->address = $address;
        $this->naturalness = $naturalness;
        $this->active = $active;
        $this->photograph = $photograph;
    }
}
