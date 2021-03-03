<?php
use src\services\UserService;
use app\components\MessageContainer;

class UserController
{
    private $user_service;

    public function __construct()
    {
        $this->user_service =  new UserService();
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

        $result = $this->user_service->register(
            $cpf,
            $name,
            $genre,
            $date_of_birth,
            $naturalness,
            $address,
            $responsibility
        );

        return $result;
    }

    public function update($user)
    {

        $result = $this->user_service->update($user);

        return $result;
    }

    public function allUsers($start, $total_records)
    {
        $result = $this->user_service->allUsers($start, $total_records);

        return $result;
    }

    public function fetchUser($cpf)
    {

        $result = $this->user_service->fetchUser($cpf);

        return $result;
    }

    public function signIn()
    {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if (isset($username) && isset($password)) {
            $result = $this->user_service->signIn($username, $password);

            if ($result == null || !is_object($result)) {

                MessageContainer::errorMessage("Erro ao tentar acessar a plataforma", "../../../../public/styles/img/error.svg", "O usuário inserido não possui permissão para acessar a plataforma.");
            } else {
                $_SESSION["loggedUser"] = serialize($result);
                $_SESSION['responsibility'] = $result->getResponsibility();

                header("Location: ./");
            }
        } else {
            MessageContainer::errorMessage("Não foi possível realizar esta operação", "../../../../public/styles/img/error.svg", "Você precisa inserir o username e a senha para acessar a plataforma!");
        }
        require_once "app/pages/index.php";
    }

    public function save($cpf, $username, $password)
    {

        $result = $this->user_service->save($cpf, $username, $password);

        return $result;
    }

    public function logout()
    {
        $_SESSION["loggedUser"] = null;

        header("Location: ./");
    }
}
