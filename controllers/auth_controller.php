<?php

class AuthController
{
    public function login()
    {
        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            $q = Db::getInstance()->prepare("UPDATE Users SET session = :session WHERE login = :login AND password = MD5( :password )");
            $q->bindParam(":session", session_id(), PDO::PARAM_STR, 64);
            $q->bindParam(":login", $_POST['login'], PDO::PARAM_STR, 50);
            $q->bindParam(":password", $_POST['password'], PDO::PARAM_STR, 128);
            $q->execute();

            header("Location: /pg-bsk/index.php");
            die();
        }
    }

    public function logout()
    {
        $q = Db::getInstance()->prepare("UPDATE Users SET session = '' WHERE session = :session");
        $q->bindParam(":session", session_id(), PDO::PARAM_STR, 64);
        $q->execute();

        header("Location: /pg-bsk/index.php");
        die();
    }
}
