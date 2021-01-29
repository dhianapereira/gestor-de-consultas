<?php
namespace src\data\repository;
use src\data\repository\Connection;
use app\models\MedicalRecords;

include_once('../../utils/gravity_calculation.php');
class MedicalRecordsRepository {

    private $conn;

    public function __construct() {
        $this->conn = new Connection();
    }

    public function addMedicalRecords( $patient_cpf, $symptoms, $start_date) {
        try {

            $result = ($symptoms/15)*100;
            $gravity = gravityCalculation($result);

            $sql = "INSERT INTO medical_records (cpf_patient_fk, result, gravity, start_date) 
                        VALUES (:cpf_patient_fk, :result, :gravity, :start_date)";

            $stmt = $this->conn->connect()->prepare( $sql );

            $success = $stmt->execute( array(
               ':cpf_patient_fk' => $patient_cpf,
                ':result' => $result,
                ':gravity' => $gravity,
                ':start_date' => $start_date,
            ) );

            if ( $success ) {
                return $success;
            }

            $response = "Ocorreu um erro que impossibilitou a criação do prontuário médico.";

            return $response;
        } catch(\Exception $e){
            return "Exception: $e";
        }
        finally {
            $this->conn  = null;
        }
    }

    public function fetchMedicalRecords($cpf) {
        try {
            $sql = "SELECT * FROM medical_records WHERE cpf_patient_fk = :cpf_patient_fk";

            $stmt = $this->conn->connect()->prepare( $sql );

            $stmt->execute(array(
                ':cpf_patient_fk' => $cpf,
            ));

            $result = $stmt->fetchAll();

            if ( $result!=null ) {
                $id = $result[0]['id'];
                $patient_cpf = $result[0]['cpf_patient_fk'];
                $percentage = $result[0]['result'];
                $gravity = $result[0]['gravity'];
                $start_date = $result[0]['start_date'];

                $medical_records = new MedicalRecords($id, $patient_cpf, $percentage, $gravity, $start_date);

                return $medical_records;
            }

            $response = "Não foi possível trazer o prontuário escolhido.";
            return $response;
        } catch(\Exception $e){

            return "Exception: $e";
        }
        finally {
            $this->conn  = null;
        }
    }
}
?>
