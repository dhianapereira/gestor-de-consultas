<?php

require_once "src/data/repository/UserRepository.php";

class Facade
{
    // User operations

    public static function registerUser(
        $cpf,
        $name,
        $genre,
        $date_of_birth,
        $naturalness,
        $address,
        $responsibility
    ) {

        $result = UserRepository::register(
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

    public static function updateUser($user)
    {
        $result = UserRepository::update($user);

        return $result;
    }

    public static function allUsers($start, $total_records)
    {
        $result = UserRepository::allUsers($start, $total_records);

        return $result;
    }

    public static function fetchUser($cpf)
    {
        $result = UserRepository::fetchUser($cpf);

        return $result;
    }

    public static function signIn($username, $password)
    {
        $result = UserRepository::signIn($username, $password);

        return $result;
    }

    public static function save($cpf, $username, $password)
    {
        $result = UserRepository::save($cpf, $username, $password);

        return $result;
    }
}
