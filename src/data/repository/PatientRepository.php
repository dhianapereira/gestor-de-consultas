<?php
namespace src\data\repository;
use src\data\repository\Connection;
use app\models\Patient;
class PatientRepository {

    private $conn;

    public function __construct() {
        $this->conn = new Connection();
    }

    public function register( $cpf, $full_name, $genre, $date_of_birth, 
    $mother_name, $companion, $address, $naturalness ) {
        try {
            $sql = "INSERT INTO patient (
                    cpf, full_name, genre, date_of_birth, 
                    mother_name, companion, address, naturalness
                ) VALUES (
                    :cpf, :full_name, :genre, :date_of_birth, 
                    :mother_name, :companion, :address, :naturalness
                )";

            $stmt = $this->conn->connect()->prepare( $sql );

            $success = $stmt->execute( array(
                ':cpf' => $cpf,
                ':full_name' => $full_name,
                ':genre' => $genre,
                ':date_of_birth' => $date_of_birth,
                ':mother_name' => $mother_name,
                ':companion' => $companion,
                ':address' => $address,
                ':naturalness' => $naturalness,
            ) );

            if ( $success ) {
                $patient = new Patient( $cpf, $full_name, $genre, $date_of_birth, 
                $mother_name, $companion, $address, $naturalness);


                return $patient;
            }

            $response = "Não foi possível realizar o cadastro do paciente.
            Verifique sua conexão com a internet ou tente mais tarde.";
            
            return $response;
        } catch(Exception $e){
            return "Exception: $e";
        }
        finally {
            $this->conn  = null;
        }
    }

    public function allPatients() {
        try {
            $sql = "SELECT * FROM patient";

            $stmt = $this->conn->connect()->prepare( $sql );

            $stmt->execute();

            $result = $stmt->fetchAll();

            if ( $result!=null ) {
                $list = [];

                foreach($result as $row){
                    $cpf = $row['cpf'];
                    $full_name = $row['full_name'];
                    $genre = $row['genre'];
                    $date_of_birth = $row['date_of_birth'];
                    $mother_name = $row['mother_name'];
                    $companion = $row['companion'];
                    $address = $row['address'];
                    $naturalness = $row['naturalness'];
    
                    $patient = new Patient($cpf, $full_name, $genre, $date_of_birth,
                    $mother_name, $companion, $address, $naturalness);

                    array_push($list, $patient);
                }

                return $list;
            }

            $response = "Não foi possível trazer a lista de pacientes";
            return $response;
        } catch(Exception $e){

            return "Exception: $e";
        }
        finally {
            $this->conn  = null;
        }
    }

    public function fetchPatient($cpf) {
        try {
            $sql = "SELECT * FROM patient WHERE cpf = :cpf";

            $stmt = $this->conn->connect()->prepare( $sql );

            $stmt->execute(array(
                ':cpf' => $cpf,
            ));

            $result = $stmt->fetchAll();

            if ( $result!=null ) {
                $full_name = $result[0]['full_name'];
                $genre = $result[0]['genre'];
                $date_of_birth = $result[0]['date_of_birth'];
                $mother_name = $result[0]['mother_name'];
                $companion = $result[0]['companion'];
                $address = $result[0]['address'];
                $naturalness = $result[0]['naturalness'];


                $patient = new Patient($cpf, $full_name, $genre, $date_of_birth,
                $mother_name, $companion, $address, $naturalness);

                return $patient;
            }

            $response = "Não foi possível trazer o paciente escolhido.";
            return $response;
        } catch(Exception $e){

            return "Exception: $e";
        }
        finally {
            $this->conn  = null;
        }
    }
}
?>
