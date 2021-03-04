<?php
require_once "src/services/MedicalRecordsService.php";

class MedicalRecordsController
{

    public static function fetchMedicalRecords($cpf)
    {
        $result = MedicalRecordsService::fetchMedicalRecords($cpf);

        return $result;
    }

    public static function allMedicalRecords($start, $total_records)
    {
        $result = MedicalRecordsService::allMedicalRecords($start, $total_records);

        return $result;
    }

    public static function listOfSymptomsByMonth()
    {
        if (isset($_POST["months"])) {

            $month = explode(' ', $_POST["months"]);

            $total_days = intval($month[0]);

            $month_in_number = strlen($month[1]) < 2 ? "0$month[1]" : $month[1];

            $month_name = $month[2];

            $result = MedicalRecordsService::listOfSymptomsByMonth($total_days, $month_in_number);

            if ($result != null && !is_string($result)) {
                $_SESSION['successMessage'] = "O sintoma mais recorrente no mês de $month_name ($result[1]%) foi: $result[0]";
                require_once "app/pages/medical_records/most_recurrent_symptom/index.php";
            } else {
                $_SESSION['errorMessage'] = "Não há nenhum sintoma recorrente no mês de $month_name.";
                require_once "app/pages/medical_records/most_recurrent_symptom/index.php";
            }
        } else {
            $_SESSION['errorMessage'] = "Você precisa escolher um mês para visualizar o sintoma mais recorrente.";
            require_once "app/pages/medical_records/most_recurrent_symptom/index.php";
        }
    }
}
