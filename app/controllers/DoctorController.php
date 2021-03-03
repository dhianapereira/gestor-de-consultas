<?php
require_once "src/services/DoctorService.php";

class DoctorController
{
    public static function register()
    {
        $name = $_POST["name"];
        $genre = $_POST["genre"];
        $specialty = $_POST["specialty"];

        if (!isset($specialty) || !isset($name) || !isset($genre)) {
            $_SESSION['errorMessage'] = "Você precisa preencher todos os campos para realizar esta operação!";
            require_once "app/pages/doctor/register/index.php";
        } else {
            $result = DoctorService::register($name, $genre, $specialty);

            if (!is_bool($result)) {

                $_SESSION['errorMessage'] = $result;
                require_once "app/pages/doctor/register/index.php";
            } else {
                $_SESSION['successMessage'] = "O cadastro do médico foi realizado com sucesso!";
                require_once "app/pages/doctor/register/index.php";
            }
        }
    }

    public static function update($doctor)
    {
        $result = DoctorService::update($doctor);

        return $result;
    }

    public static function allDoctors($start, $total_records)
    {
        $result = DoctorService::allDoctors($start, $total_records);

        return $result;
    }

    public static function fetchDoctor($id)
    {

        $result = DoctorService::fetchDoctor($id);

        return $result;
    }

    public static function listOfSpecialties()
    {
        $result = DoctorService::listOfSpecialties();

        return $result;
    }
}
