<?php

namespace src\data\repository;

use src\data\repository\Connection;
use app\models\User;

class UserRepository
{

    private $conn;

    public function __construct()
    {
        $this->conn = new Connection();
    }

    public function register(
        $cpf,
        $name,
        $genre,
        $date_of_birth,
        $naturalness,
        $address,
        $responsibility
    ) {
        try {
            $sql = "INSERT INTO user (cpf, name, genre, date_of_birth, naturalness,
                    address, responsibility) 
                    VALUES (:cpf, :name, :genre, :date_of_birth, :naturalness, :address, :responsibility)";

            $stmt = $this->conn->getConnection()->prepare($sql);

            $success = $stmt->execute(array(
                ':cpf' => $cpf,
                ':name' => $name,
                ':genre' => $genre,
                ':date_of_birth' => $date_of_birth,
                ':naturalness' => $naturalness,
                ':address' => $address,
                ':responsibility' => $responsibility,
            ));

            if ($success) {
                return $success;
            }

            $response = "Não foi possível realizar o cadastro do funcionário(a).
            Verifique sua conexão com a internet ou tente mais tarde.";

            return $response;
        } catch (\Exception $e) {
            return "Exception: $e";
        } finally {
            $this->conn->disconnect();
        }
    }

    public function update($doctor)
    {
        try {
            $sql = "UPDATE doctor SET name = :name, genre = :genre, specialty = :specialty,
                    active = :active WHERE id = :id";

            $stmt = $this->conn->getConnection()->prepare($sql);

            $success = $stmt->execute(array(
                ':id' => $doctor->getId(),
                ':name' => $doctor->getName(),
                ':genre' => $doctor->getGenre(),
                ':specialty' => $doctor->getSpecialty(),
                ':active' => $doctor->getActive(),
            ));

            if ($success) {
                return $success;
            }

            $response = "Não foi possível realizar as alterações desejadas.
            Verifique sua conexão com a internet ou tente mais tarde.";

            return $response;
        } catch (\Exception $e) {
            return "Exception: $e";
        } finally {
            $this->conn->disconnect();
        }
    }

    public function allUsers()
    {
        try {
            $sql = "SELECT * FROM user";

            $stmt = $this->conn->getConnection()->prepare($sql);

            $stmt->execute();

            $result = $stmt->fetchAll();

            if ($result != null) {
                $list = [];

                foreach ($result as $row) {
                    $cpf = $row['cpf'];
                    $name = $row['name'];
                    $genre = $row['genre'];
                    $date_of_birth = $row['date_of_birth'];
                    $naturalness = $row['naturalness'];
                    $address = $row['address'];
                    $responsibility = $row['responsibility'];
                    $username = $row['username'];
                    $password = $row['password'];

                    if ($row['active']) {
                        $active = "Ativo";
                    } else {
                        $active = "Inativo";
                    }

                    $user = new User(
                        $cpf,
                        $name,
                        $genre,
                        $date_of_birth,
                        $naturalness,
                        $address,
                        $responsibility,
                        $username,
                        $password,
                        $active
                    );

                    array_push($list, $user);
                }

                return $list;
            }

            $response = "Não foi possível trazer a lista de funcionários";
            return $response;
        } catch (\Exception $e) {
            return "Exception: $e";
        } finally {
            $this->conn->disconnect();
        }
    }

    public function fetchUser($cpf)
    {
        try {
            $sql = "SELECT * FROM user WHERE cpf = :cpf";

            $stmt = $this->conn->getConnection()->prepare($sql);

            $stmt->execute(array(
                ':cpf' => $cpf
            ));

            $result = $stmt->fetchAll();

            if ($result != null) {
                $name = $result[0]['name'];
                $genre = $result[0]['genre'];
                $date_of_birth = $result[0]['date_of_birth'];
                $naturalness = $result[0]['naturalness'];
                $address = $result[0]['address'];
                $responsibility = $result[0]['responsibility'];
                $username = $result[0]['username'];
                $password = $result[0]['password'];
                $active = $result[0]['active'];

                $user = new User(
                    $cpf,
                    $name,
                    $genre,
                    $date_of_birth,
                    $naturalness,
                    $address,
                    $responsibility,
                    $username,
                    $password,
                    $active
                );

                return $user;
            }

            $response = "Não foi possível trazer o funcionário(a) escolhido.";
            return $response;
        } catch (\Exception $e) {
            return "Exception: $e";
        } finally {
            $this->conn->disconnect();
        }
    }

    public function signIn($username, $password)
    {
        try {

            $sql = 'SELECT * FROM user WHERE username = :username 
            AND password = :password';

            $stmt = $this->conn->getConnection()->prepare($sql);

            $stmt->execute(array(
                ':username' => $username,
                ':password' => $password,
            ));

            $result = $stmt->fetchAll();

            if ($result != null) {
                $cpf = $result[0]['cpf'];
                $name = $result[0]['name'];
                $genre = $result[0]['genre'];
                $date_of_birth = $result[0]['date_of_birth'];
                $naturalness = $result[0]['naturalness'];
                $address = $result[0]['address'];
                $responsibility = $result[0]['responsibility'];
                $active = $result[0]['active'];

                $user = new User(
                    $cpf,
                    $name,
                    $genre,
                    $date_of_birth,
                    $naturalness,
                    $address,
                    $responsibility,
                    $username,
                    $password,
                    $active
                );

                return $user;
            }

            $response = "Não foi possível realizar o login.";
            return $response;
        } catch (\Exception $e) {
            return "Exception: $e";
        } finally {
            $this->conn->disconnect();
        }
    }

    public function save($cpf, $username, $password)
    {
        try {
            $sql = "UPDATE user SET username = :username, password = :password WHERE cpf = :cpf";

            $stmt = $this->conn->getConnection()->prepare($sql);

            $success = $stmt->execute(array(
                ':cpf' => $cpf,
                ':username' => $username,
                ':password' => $password,
            ));

            if ($success) {
                return $success;
            }

            $response = "Não foi possível realizar o cadastro do usuário na plataforma";

            return $response;
        } catch (\Exception $e) {
            return "Exception: $e";
        } finally {
            $this->conn->disconnect();
        }
    }
}
