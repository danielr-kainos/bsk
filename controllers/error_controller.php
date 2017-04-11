<?php

class ErrorController
{
    public function error()
    {
        $viewPath = 'views/error/error.php';
        require_once('views/layout.php');
    }

    public function unauthorized()
    {
        $viewPath = 'views/error/unauthorized.php';
        require_once('views/layout.php');
    }
}
