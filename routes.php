<?php
function call($controller, $action)
{
    // require the file that matches the controller name
    require_once('controllers/' . $controller . '_controller.php');

    // create a new instance of the needed controller
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

    // call the action
    $controller->{$action}();
}

// a list of the controllers we have and their actions
// we consider those "allowed" values
$controllers = array(
        'auth' => ['login', 'logout'],
        'tables' => ['index', 'details', 'insert', 'update', 'delete']
    );

// check that the requested controller and action are both allowed
// if someone tries to access something else he will be redirected to the error action of the home controller
if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('tables', 'index');
    }
} else {
    call('tables', 'index');
}
