<?php
namespace src\data\repository;
use src\data\repository\Connection;
use app\models\MedicalAppointment;

class MedicalAppointmentRepository {

    private $conn;

    public function __construct() {
        $this->conn = new Connection();
    }

    public function makeAnAppointment($patient_cpf, $genre, $specialty, $date, $time) {
        try {

            $select = 'SELECT id FROM doctor WHERE genre = :genre AND specialty = :specialty';

            $stmt = $this->conn->connect()->prepare( $select );

            $stmt->execute(array(
                ':genre' => $genre,
                ':specialty' => $specialty,
            ));

            $doctor = $stmt->fetchAll();

            if($doctor!=null){
                $id_doctor = $doctor[0]['id'];

                $sql = 'INSERT INTO medical_appointment (cpf_patient_fk, id_doctor_fk, time, 
                date, realized) 
                    VALUES (:cpf_patient_fk, :id_doctor_fk, :time, :date, :realized)';

                                
                $stmt2 = $this->conn->connect()->prepare( $sql );

                $success = $stmt2->execute( array(
                    ':cpf_patient_fk' => $patient_cpf,
                    ':id_doctor_fk' => $id_doctor,
                    ':time' => $time,
                    ':date' => $date,
                    ':realized' => 0,
                ) );

                if ( $success ) {
                    return $success;
                }

                $response = "Não foi possível marcar a consulta. Tente mais tarde.";

                return $response;
            }

            return "Não há nenhum médico com essa descrição, por isso não foi possível marcar a consulta.";
        } catch(Exception $e){
            return "Exception: $e";
        }
        finally {
            $this->conn  = null;
        }
    }
}
?>
