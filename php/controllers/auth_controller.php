<?php

class AuthController
{
    public function login()
    {
        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            $q = Db::getInstance()->prepare("UPDATE Users SET session = :session WHERE login = :login AND password = crypt( :password, password )");
            $q->bindParam(":session", session_id(), PDO::PARAM_STR, 64);
            $q->bindParam(":login", $_POST['login'], PDO::PARAM_STR, 50);
            $q->bindParam(":password", $_POST['password'], PDO::PARAM_STR, 128);
            $q->execute();

            if ($q->rowCount()) {
                header("Location: index.php");
                die();
            }
        }

        return call('error', 'login_error');
    }

    public function logout()
    {
        $q = Db::getInstance()->prepare("UPDATE Users SET session = '' WHERE session = :session");
        $q->bindParam(":session", session_id(), PDO::PARAM_STR, 64);
        $q->execute();

        header("Location: index.php");
        die();
    }
}
