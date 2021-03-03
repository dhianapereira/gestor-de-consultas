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

    public static function listOfSymptomsByMonth($total_days, $month_in_number)
    {
        $result = MedicalRecordsService::listOfSymptomsByMonth($total_days, $month_in_number);

        return $result;
    }
}
