<?php
class Doctor
{
    private int $id;
    private string $name;
    private string $genre;
    private string $specialty;
    private bool $active;


    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getGenre()
    {
        return $this->genre;
    }

    public function getSpecialty()
    {
        return $this->specialty;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function __construct($id, $name, $genre, $specialty, $active)
    {
        $this->id = $id;
        $this->name = $name;
        $this->genre = $genre;
        $this->specialty = $specialty;
        $this->active = $active;
    }
}
