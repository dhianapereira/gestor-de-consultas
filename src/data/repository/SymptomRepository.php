<?php
namespace src\data\repository;
use src\data\repository\Connection;
use app\models\Symptom;
class SymptomRepository {

    private $conn;

    public function __construct() {
        $this->conn = new Connection();
    }

    public function addSymptoms( $patient_cpf, $symptoms) {
        try {

            foreach($symptoms as $symptom){
                $sql = 'INSERT INTO symptom (cpf_patient_fk, symptom_name) 
                        VALUES (:cpf_patient_fk, :symptom_name)';

                $stmt = $this->conn->connect()->prepare( $sql );

                $stmt->execute( array(
                    ':cpf_patient_fk' => $patient_cpf,
                    ':symptom_name' => $symptom,
                ) );
            }

            return true;
        } catch(Exception $e){
            return "Exception: $e";
        }
        finally {
            $this->conn  = null;
        }
    }
}
?>
