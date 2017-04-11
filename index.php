<?php
require_once('connection.php');
require_once('models/user.php');
require_once('utils/view_generator.php');

session_start();

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
} else {
    $controller = 'tables';
    $action = 'index';
}

require_once('routes.php');
