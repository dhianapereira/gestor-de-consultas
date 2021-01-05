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
                $sql = 'INSERT INTO symptom (cpf_patient_fk, name) 
                        VALUES (:cpf_patient_fk, :name)';

                $stmt = $this->conn->connect()->prepare( $sql );

                $stmt->execute( array(
                    ':cpf_patient_fk' => $patient_cpf,
                    ':name' => $symptom,
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

    public function fetchSymptoms($cpf) {
        try {
            $sql = 'SELECT * FROM symptom WHERE cpf_patient_fk = :cpf_patient_fk';

            $stmt = $this->conn->connect()->prepare( $sql );

            $stmt->execute(array(
                ':cpf_patient_fk' => $cpf,
            ));

            $result = $stmt->fetchAll();

            if ( $result!=null ) {
                $list = [];

                foreach($result as $row){
                    $id = $row['id'];
                    $cpf_patient_fk = $row['cpf_patient_fk'];
                    $name = $row['name'];
    
                    $symptom = new Symptom($id, $cpf_patient_fk, $name);

                    array_push($list, $symptom);
                }

                return $list;
            }

            $response = "Não foi possível trazer a lista de sintomas do paciente escolhido.";
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
