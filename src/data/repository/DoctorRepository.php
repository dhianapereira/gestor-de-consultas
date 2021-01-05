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



    public function allDoctors() {
        try {
            $sql = 'SELECT * FROM doctor';

            $stmt = $this->conn->connect()->prepare( $sql );

            $stmt->execute();

            $result = $stmt->fetchAll();

            if ( $result!=null ) {
                $list = [];

                foreach($result as $row){
                    $id = $row['id'];
                    $name = $row['name'];
                    $genre = $row['genre'];
                    $specialty = $row['specialty'];
                    
                    if($row['active']){
                        $active = "Ativo";
                    }else{
                        $active = "Inativo";    
                    }

                    $doctor = new Doctor($id, $name, $genre, $specialty, $active);

                    array_push($list, $doctor);
                }

                return $list;
            }

            $response = "Não foi possível trazer a lista de médicos";
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
