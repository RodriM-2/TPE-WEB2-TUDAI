<?php

require_once 'app/Controllers/ItemController.php';
require_once 'app/Controllers/CategoryController.php';
require_once 'app/Controllers/UserController.php';

define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

require_once __DIR__ . '/template/layout/header.phtml';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home';
}
$ejemplo= new ItemController();

$params = explode('/', $action);

// determina que camino seguir según la acción
switch ($params[0]) {
    case 'home':
        $ejemplo->GetItems();
        break;
    case 'GetItem':
        $ejemplo->GetItem($params[1]);
        break;
    default:
        echo "Hola!";
        break;
}

require_once __DIR__ . '/template/layout/footer.phtml';