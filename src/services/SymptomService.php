<?php
require_once "src/data/Facade.php";
class SymptomService
{
    public static function addSymptoms($patient_cpf, $symptoms, $start_date)
    {
        $result = Facade::addSymptoms($patient_cpf, $symptoms, $start_date);

        return $result;
    }

    public static function fetchSymptoms($cpf)
    {
        $result = Facade::fetchSymptoms($cpf);

        return $result;
    }
}
