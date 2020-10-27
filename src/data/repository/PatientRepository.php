<?php
namespace src\data\repository;
use src\data\repository\Connection;
use app\models\Patient;
class PatientRepository {

    private $conn;

    public function __construct() {
        $this->conn = new Connection();
    }

    public function registerPatient( $cpf, $full_name, $genre, $date_of_birth, $mother_name, $naturalness ) {
        try {
            $sql = "INSERT INTO patient (cpf, full_name, genre, date_of_birth, 
                mother_name, naturalness) VALUES (:cpf, :full_name, :genre, :date_of_birth, :mother_name, :naturalness)";

            $stmt = $this->conn->connect()->prepare( $sql );

            $success = $stmt->execute( array(
                ':cpf' => $cpf,
                ':full_name' => $full_name,
                ':genre' => $genre,
                ':date_of_birth' => $date_of_birth,
                ':mother_name' => $mother_name,
                ':naturalness' => $naturalness,

            ) );

            if ( $success ) {
                $patient = new Patient( $cpf, $full_name, $genre, $date_of_birth, $mother_name, $naturalness );
                return $patient;
            }
            $response = 'Não foi possível realizar o cadastro do paciente. Tente mais tarde.';
            return $response;
        } catch(Exception $e){
            return 'Não foi possível realizar o cadastro do paciente. Tente mais tarde.';
        }
        finally {
            $this->conn  = null;
        }
    }
}
?>