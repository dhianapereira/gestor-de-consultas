<?php

namespace app\controllers;

use src\services\UserService;

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

    public function allUsers()
    {
        $result = $this->user_service->allUsers();

        return $result;
    }

    public function fetchUser($cpf)
    {

        $result = $this->user_service->fetchUser($cpf);

        return $result;
    }

    public function signIn($username, $password)
    {

        $result = $this->user_service->signIn($username, $password);

        return $result;
    }

    public function save($cpf, $username, $password)
    {

        $result = $this->user_service->save($cpf, $username, $password);

        return $result;
    }
}
