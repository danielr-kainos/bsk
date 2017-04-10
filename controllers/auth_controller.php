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

            $this->forceRedirectTo("/pg-bsk/index.php");
        }
    }

    public function logout()
    {
        $q = Db::getInstance()->prepare("UPDATE Users SET session = '' WHERE session = :session");
        $q->bindParam(":session", session_id(), PDO::PARAM_STR, 64);
        $q->execute();

        $this->forceRedirectTo("/pg-bsk/index.php");
    }

    // todo: replace this hack with a proper solution
    private function forceRedirectTo($url)
    {
        echo '<script type="text/javascript">
           window.location = "' . $url . '"</script>';
    }
}
