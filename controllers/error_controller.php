<?php

class ErrorController
{
    public function error()
    {
        require_once('views/error/error.php');
    }

    public function unauthorized()
    {
        require_once('views/error/unauthorized.php');
    }
}
