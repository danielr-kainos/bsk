<?php

function call($controller, $action)
{
    require_once('controllers/' . $controller . '_controller.php');

    switch ($controller) {
        case 'auth':
            $controller = new AuthController();
            break;
        case 'error':
            $controller = new ErrorController();
            break;
        case 'tables':
            $controller = new TablesController();
            break;
    }

    $controller->{$action}();
}

$controllers = array(
        'auth' => ['login', 'logout'],
        'tables' => ['index', 'details', 'insert', 'update', 'delete']
    );

if (array_key_exists($controller, $controllers) && in_array($action, $controllers[$controller])) {
    call($controller, $action);
} else {
    call('tables', 'index');
}
