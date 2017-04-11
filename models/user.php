<?php
require_once('connection.php');

// todo: this is not a model, convert this to service or sth
class User
{
    public $login;
    public $label;
    private static $instance = NULL;

    private function __construct($login, $label)
    {
        $this->login = $login;
        $this->label = $label;
    }

    private function __clone()
    {
    }

    public static function getCurrentUser()
    {
        if (!isset(self::$instance)) {
            $query = Db::getInstance()->prepare("SELECT login, label FROM Users WHERE session = :session");
            $query->bindParam(":session", session_id(), PDO::PARAM_STR, 64);
            $query->execute();
            $currentUser = $query->fetch();

            if (isset($currentUser['login']) && isset($currentUser['label'])) {
                self::$instance = new User($currentUser['login'], $currentUser['label']);
            }
        }

        return self::$instance;
    }
}
