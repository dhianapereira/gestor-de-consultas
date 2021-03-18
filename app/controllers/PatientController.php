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
        $photograph = md5(time()) . strtolower(substr($_FILES['photograph']['name'], -4));

        move_uploaded_file($_FILES['photograph']['tmp_name'], 'temp/patient_image/' . $photograph);

        if (
            !isset($cpf) || !isset($full_name)
            || !isset($genre) || !isset($date_of_birth)
            || !isset($mother_name) || !isset($companion)
            || !isset($address) || !isset($naturalness)
            || !isset($photograph)
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
                $naturalness,
                $photograph
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

    public static function update()
    {
        $cpf = $_POST["cpf"];
        $full_name = $_POST["full_name"];
        $date_of_birth = $_POST["date_of_birth"];
        $mother_name = $_POST["mother_name"];
        $genre = $_POST["genre"];
        $companion = $_POST["companion"];
        $address = $_POST["address"];
        $naturalness = $_POST["naturalness"];
        $active = $_POST["active"];
        $photograph = $_POST["photograph"];
        if (
            isset($cpf) && isset($full_name) && isset($genre) && isset($date_of_birth) && isset($mother_name)
            && isset($companion) && isset($address) && isset($naturalness)  && isset($active)
        ) {
            $patient = new Patient($cpf, $full_name, $genre, $date_of_birth, $mother_name, $companion, $address, $naturalness, $active, $photograph);

            $result = PatientService::update($patient);

            if ($result == null || !is_bool($result)) {
                $_SESSION["errorMessage"]  = $result;
                require_once "app/pages/patient/update/index.php";
            } else {
                $_SESSION["successMessage"]  =  "As atualizações foram realizadas com sucesso!";
                require_once "app/pages/patient/update/index.php";
            }
        } else {
            $_SESSION["errorMessage"]  = "Você precisa alterar alguma informação para que a operação seja realizada.";
            require_once "app/pages/patient/update/index.php";
        }
    }


    public static function allPatients($start, $total_records)
    {
        $result = PatientService::allPatients($start, $total_records);

        return $result;
    }

    public static function fetchPatient()
    {
        $cpf = $_POST["cpf"];

        if (isset($cpf)) {
            $patient = PatientService::fetchPatient($cpf);
            if ($patient == null || !is_object($patient)) {

                $_SESSION["errorMessage"]  = "Nenhum Paciente com o CPF: $cpf";
                require_once "app/pages/patient/search/index.php";
            } else {
                require_once "app/pages/patient/update/index.php";
            }
        } else {
            $_SESSION["errorMessage"]  = "Você precisa inserir um CPF!";
            require_once "app/pages/patient/search/index.php";
        }
    }
}
