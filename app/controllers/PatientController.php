<?php
require_once "src/services/PatientService.php";

class PatientController
{
    public static function register()
    {
        $cpf = $_POST["cpf"];
        $full_name = $_POST["full_name"];
        $genre = $_POST["genre"];
        $date_of_birth = $_POST["date_of_birth"];
        $mother_name = $_POST["mother_name"];
        $companion = $_POST["companion"];
        $address = $_POST["address"];
        $naturalness = $_POST["naturalness"];

        if (
            !isset($cpf) || !isset($full_name)
            || !isset($genre) || !isset($date_of_birth)
            || !isset($mother_name) || !isset($companion)
            || !isset($address) || !isset($naturalness)
        ) {
            $_SESSION["errorMessage"]  = "Você precisa preencher todos os campos para realizar esta operação!";
            require_once "app/pages/patient/register/index.php";
        } else {

            $result = PatientService::register(
                $cpf,
                $full_name,
                $genre,
                $date_of_birth,
                $mother_name,
                $companion,
                $address,
                $naturalness
            );

            if (!is_bool($result)) {
                $_SESSION["errorMessage"]  = $result;
                require_once "app/pages/patient/register/index.php";
            } else {
                $_SESSION["successMessage"]  =  "O cadastro do paciente foi realizado com sucesso!";
                require_once "app/pages/patient/register/index.php";
            }
        }
    }

    public static function update($patient)
    {
        $result = PatientService::update($patient);

        return $result;
    }


    public static function allPatients($start, $total_records)
    {
        $result = PatientService::allPatients($start, $total_records);

        return $result;
    }

    public static function fetchPatient($cpf)
    {
        $result = PatientService::fetchPatient($cpf);

        return $result;
    }
}
