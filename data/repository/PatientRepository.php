<?php
namespace data\repository;
use data\repository\Connection;
use core\models\Patient;

class PatientRepository {
    private $connection;

    public function __construct() {
        $this->connection = new Connection();
    }

    public function registerPatient( $cpf, $full_name, $genre, $date_of_birth, $mother_name, $naturalness ) {
        try {
            $conn = $this->connection->connect();
            if ( !$conn ) {
                die( 'ERROR: Falha na conexão' . mysqli_connect_error() );
            }

            $sql = "INSERT INTO patient (cpf, full_name, genre, date_of_birth, 
                mother_name, naturalness) VALUES (:cpf, :full_name, :genre, :date_of_birth, :mother_name, :naturalness)";

            $stmt = $conn->prepare( $sql );

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
        } catch ( Exception $e ) {
            return 'Não foi possível realizar o cadastro do paciente. Tente mais tarde.';
        }
        finally {
            $this->connection->close();
        }
    }
}
?>