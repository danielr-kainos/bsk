<?php

class Db
{
    private static $instance = NULL;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instance = new PDO("pgsql:host=localhost; dbname=bsk2017", 'postgres', '', $pdo_options);
        }
        return self::$instance;
    }
}
