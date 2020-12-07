<?php
namespace src\data;
use src\data\repository\PatientRepository;
use src\data\repository\SymptomRepository;

class Facade {

    private $patient_repository;
    private $symptom_repository;

    public function __construct() {
        $this->patient_repository = new PatientRepository();
        $this->symptom_repository = new SymptomRepository();
    }

    public function registerPatient( $cpf, $full_name, $genre, $date_of_birth, 
    $mother_name, $companion, $patient_address, $naturalness ) {
        
        $result = $this->patient_repository->registerPatient( $cpf, $full_name, $genre, 
        $date_of_birth, $mother_name, $companion, $patient_address, $naturalness );

        return $result;
    }

    public function allPatients() {
        $result = $this->patient_repository->allPatients();

        return $result;
    }

    public function addSymptoms($patient_cpf, $symptoms){

        $result = $this->symptom_repository->addSymptoms($patient_cpf, $symptoms);

        return $result;
    }

}
?>
