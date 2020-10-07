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

                $sql = "INSERT INTO patient (cpf, full_name, genre, date_of_birth, 
                mother_name, naturalness) VALUES (?, ?, ?, ?, ?, ?)";

                $stmt = mysqli_prepare($this->link, $sql);

                if($stmt){
                    mysqli_stmt_bind_param($stmt, "ssssss", $cpf, $full_name, $genre, $date_of_birth, $mother_name, $naturalness);
                    
                    if (!mysqli_stmt_execute($stmt)){
                        echo "erro 1";
                        $response = "Não foi possível realizar o cadastro do paciente. Tente mais tarde.";
                        return $response;
                    }

                    mysqli_stmt_close($stmt);

                    $patient = new Patient($cpf, $full_name, $genre, $date_of_birth, $mother_name, $naturalness);
                    return $patient;
                }else{
                    $response = "Não foi possível realizar o cadastro do paciente. Tente mais tarde.";
                    return $response;
                }
            } catch (Exception $e) {
                return "Não foi possível realizar o cadastro do paciente. Tente mais tarde.";
            }finally{
                $this->connection->getClose();
            }
        }
    }
?>