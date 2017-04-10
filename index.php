<?php
require_once('connection.php');
require_once('models/user.php');

// todo: setup SSL
// todo: serve only index.php, css/ and scripts/

session_start();

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
} else {
    $controller = 'tables';
    $action = 'index';
}

require_once('views/layout.php');

/*
// todo: create a controller for those
if ($action) {
    switch ($action) {
        case 'add' :
            if ($userLabel <= $tables[$table])
                include("ajax/add.php");
            break;
        case 'edit' :
            if ($userLabel == $tables[$table])
                include("ajax/edit.php");
            break;
        case 'delete' :
            if ($userLabel == $tables[$table])
                include("ajax/delete.php");
            break;
    }
} else {
    include("views/home.php");
}
*/
