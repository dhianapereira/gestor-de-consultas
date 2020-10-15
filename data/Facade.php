<?php
namespace data;
use data\repository\PatientRepository;

class Facade {

    private $patient_repository;

    public function __construct() {
        $this->patient_repository = new PatientRepository();
    }

    public function register( $cpf, $full_name, $genre, $date_of_birth, $mother_name, $naturalness ) {
        $result = $this->patient_repository->registerPatient( $cpf, $full_name, $genre, $date_of_birth, $mother_name, $naturalness );

        return $result;
    }

}
?>
