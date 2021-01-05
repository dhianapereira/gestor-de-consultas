<?php
namespace src\data\repository;
use src\data\repository\Connection;
use app\models\Doctor;
class DoctorRepository {

    private $conn;

    public function __construct() {
        $this->conn = new Connection();
    }

    public function register($name, $genre, $specialty) {
        try {
            $sql = 'INSERT INTO doctor (name, genre, specialty, active) 
                VALUES (:name, :genre, :specialty, :active)';

            $stmt = $this->conn->connect()->prepare( $sql );

            $success = $stmt->execute( array(
                ':name' => $name,
                ':genre' => $genre,
                ':specialty' => $specialty,
                ':active' => 1,
            ) );

            if ( $success ) {
                return $success;
            }

            $response = "Não foi possível realizar o cadastro do médico(a).
            Verifique sua conexão com a internet ou tente mais tarde.";
            
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
