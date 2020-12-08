<?php
namespace src\data;
use src\data\repository\PatientRepository;
use src\data\repository\SymptomRepository;
use src\data\repository\MedicalRecordsRepository;

class Facade {

    private $patient_repository;
    private $symptom_repository;
    private $medical_records_repository;

    public function __construct() {
        $this->patient_repository = new PatientRepository();
        $this->symptom_repository = new SymptomRepository();
        $this->medical_records_repository = new MedicalRecordsRepository();
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

    public function addSymptoms($patient_cpf, $symptoms, $start_date){

        $result = $this->symptom_repository->addSymptoms($patient_cpf, $symptoms);

        if(is_bool($result)){
            $response = $this->medical_records_repository->addMedicalRecords($patient_cpf, 
            count($symptoms), $start_date);

            return $response;
        }else{
            return $result;
        }
    }

    public function fetchMedicalRecords($cpf) {
        $result = $this->medical_records_repository->fetchMedicalRecords($cpf);

        return $result;
    }

}
?>
