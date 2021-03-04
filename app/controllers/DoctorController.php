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

    public static function update()
    {
        $id = $_POST["id"];
        $specialty = $_POST["specialty"];
        $genre = $_POST["genre"];
        $name = $_POST["name"];
        $active = $_POST["active"];

        if (isset($id) && isset($specialty) && isset($genre) && isset($name) && isset($active)) {
            $doctor = new Doctor($id, $name, $genre, $specialty, $active);

            $result = DoctorService::update($doctor);

            if ($result == null || !is_bool($result)) {
                $_SESSION['errorMessage'] = $result;
                require_once "app/pages/doctor/update/index.php";
            } else {
                $_SESSION['successMessage'] = "As atualizações foram realizadas com sucesso!";
                require_once "app/pages/doctor/update/index.php";
            }
        } else {
            $_SESSION['errorMessage'] = "Você precisa alterar alguma informação para que a operação seja realizada.";
            require_once "app/pages/doctor/update/index.php";
        }
    }

    public static function allDoctors($start, $total_records)
    {
        $result = DoctorService::allDoctors($start, $total_records);

        return $result;
    }

    public static function fetchDoctor()
    {
        $id = $_POST["id"];

        if (isset($id)) {
            $doctor = DoctorService::fetchDoctor($id);
            if ($doctor == null || !is_object($doctor)) {
                $_SESSION['errorMessage'] = "Não há nenhum médico com o ID: $id";
                require_once "app/pages/doctor/search/index.php";
            } else {
                require_once "app/pages/doctor/update/index.php";
            }
        } else {
            $_SESSION['errorMessage'] = "Você precisa inserir um ID!";
            require_once "app/pages/doctor/search/index.php";
        }
    }

    public static function listOfSpecialties()
    {
        $result = DoctorService::listOfSpecialties();

        return $result;
    }
}
