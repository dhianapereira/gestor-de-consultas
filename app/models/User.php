<?php
class User
{
    private $cpf;
    private $name;
    private $genre;
    private $date_of_birth;
    private $address;
    private $naturalness;
    private $responsibility;
    private $username;
    private $password;
    private $active;


    public function getCpf()
    {
        return $this->cpf;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getGenre()
    {
        return $this->genre;
    }

    public function getDateOfBirth()
    {
        return $this->date_of_birth;
    }

    public function getNaturalness()
    {
        return $this->naturalness;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getResponsibility()
    {
        return $this->responsibility;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function __construct(
        $cpf,
        $name,
        $genre,
        $date_of_birth,
        $naturalness,
        $address,
        $responsibility,
        $username,
        $password,
        $active
    ) {
        $this->cpf = $cpf;
        $this->name = $name;
        $this->genre = $genre;
        $this->date_of_birth = $date_of_birth;
        $this->naturalness = $naturalness;
        $this->address = $address;
        $this->responsibility = $responsibility;
        $this->username = $username;
        $this->password = $password;
        $this->active = $active;
    }
}
