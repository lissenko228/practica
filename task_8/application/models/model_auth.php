<?php

class Model_Auth extends Model
{
    function __construct()
    {
        $this -> model = new Model();
    }

    // получение пользователя
    public function get_user($login, $pass)
    {
        $sth = $this -> model -> get_data() -> prepare("SELECT * FROM `users` WHERE `login` = :login AND `password` = :pass");
        $sth -> bindParam(':login', $login);
        $sth -> bindParam(':pass', $pass);
        $sth -> execute();
        $result = $sth -> fetch(PDO::FETCH_ASSOC);
       

        return $result;
    }

    // регистрация
    public function reg_user($login,$pass)
    {
        $stmt = $this -> model -> get_data() -> prepare("INSERT INTO users (login, password) VALUES (:login, :pass)");
        $stmt -> bindParam(':login', $login);
        $stmt -> bindParam(':pass', $pass);
        $result = $stmt->execute();

        return $result;
    }
}