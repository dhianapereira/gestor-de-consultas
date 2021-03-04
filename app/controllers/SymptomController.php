<?php
require_once "src/services/SymptomService.php";

class SymptomController
{

    public static function addSymptoms()
    {
        $patient_cpf = $_POST["patient_cpf"];
        $start_date = $_POST["start_date"];
        $symptoms = $_POST["symptom"];

        if (!isset($patient_cpf) || !isset($start_date)) {
            $_SESSION['errorMessage'] = "Você precisa preencher os campos de CPF e data de início dos sintomas";
            require_once "app/pages/symptom/index.php";
        } else {
            require_once "app/controllers/PatientController.php";

            $patient = PatientController::fetchPatient($patient_cpf);

            if (is_object($patient)) {
                $result = SymptomService::addSymptoms($patient_cpf, $symptoms, $start_date);

                if (!is_bool($result)) {
                    $_SESSION['errorMessage'] = $result;
                    require_once "app/pages/symptom/index.php";
                } else {
                    $_SESSION['successMessage'] = "O prontuário médico do paciente de CPF: $patient_cpf está pronto!";
                    require_once "app/pages/symptom/index.php";
                }
            } else {
                $_SESSION['errorMessage'] = "O paciente de CPF: $patient_cpf não existe!";
                require_once "app/pages/symptom/index.php";
            }
        }
    }

    public static function fetchSymptoms($cpf)
    {
        $result = SymptomService::fetchSymptoms($cpf);

        return $result;
    }
}
