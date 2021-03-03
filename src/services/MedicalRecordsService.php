<?php
require_once "src/data/Facade.php";

class MedicalRecordsService
{
    public static function fetchMedicalRecords($cpf)
    {
        $result = Facade::fetchMedicalRecords($cpf);

        return $result;
    }

    public static function allMedicalRecords($start, $total_records)
    {
        $result = Facade::allMedicalRecords($start, $total_records);

        return $result;
    }

    public static function listOfSymptomsByMonth($total_days, $month_in_number)
    {
        $result = Facade::listOfSymptomsByMonth($total_days, $month_in_number);

        return $result;
    }
}
