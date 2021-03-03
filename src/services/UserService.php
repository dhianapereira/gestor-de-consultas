<?php
require_once "src/data/Facade.php";

class UserService
{

    public static function register(
        $cpf,
        $name,
        $genre,
        $date_of_birth,
        $naturalness,
        $address,
        $responsibility
    ) {

        $result = Facade::registerUser(
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

    public static function update($user)
    {

        $result = Facade::updateUser($user);

        return $result;
    }

    public static function allUsers($start, $total_records)
    {
        $result = Facade::allUsers($start, $total_records);

        return $result;
    }

    public static function fetchUser($cpf)
    {
        $result = Facade::fetchUser($cpf);

        return $result;
    }

    public static function signIn($username, $password)
    {
        $result = Facade::signIn($username, $password);

        return $result;
    }

    public static function save($cpf, $username, $password)
    {
        $result = Facade::save($cpf, $username, $password);

        return $result;
    }
}
