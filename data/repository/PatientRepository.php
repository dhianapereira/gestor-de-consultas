<?php
    namespace data\repository;
    use data\repository\Connection;
    use core\models\Patient;
    
    class PatientRepository{
        private $connection;
        private $link;

        public function __construct()
        {
            $this->connection = new Connection();
            $this->link = $this->connection->getLink();
        }

        public function registerPatient($cpf, $full_name, $genre, $date_of_birth, $mother_name, $naturalness){
            try {
                if(!$this->link){
                    die("ERROR: Falha na conexão" . mysqli_connect_error());
                }

                $sql = "INSERT INTO patient (cpf, full_name, 
                genre, date_of_birth, mother_name, naturalness
                ) VALUES ('$cpf', '$full_name','$genre', 
                '$date_of_birth', '$mother_name', '$naturalness');";

                if (!mysqli_query($this->link, $sql)){
                    $response = "Não foi possível realizar o cadastro do paciente. Verifique se os campos foram inseridos corretamente ou tente mais tarde.";
                    return $response;
                } 

                $patient = new Patient($cpf, $full_name, $genre, $date_of_birth, $mother_name, $naturalness);
                return $patient;
            } catch (Exception $e) {
                return "Não foi possível realizar o cadastro do paciente. Tente mais tarde.";
            }finally{
                $this->connection->getClose();
            }
        }
    }
?>