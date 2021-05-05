<?php
class Patient
{
    private string $cpf;
    private string $full_name;
    private string $genre;
    private string $date_of_birth;
    private string $mother_name;
    private string $naturalness;
    private string $companion;
    private string $address;
    private bool $active;


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

    public function __construct(
        $cpf,
        $full_name,
        $genre,
        $date_of_birth,
        $mother_name,
        $companion,
        $address,
        $naturalness,
        $active
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
    }
}
