<?php

require_once 'Controllers/ItemController.php';
require_once 'Controllers/CategoryController.php';
require_once 'Controllers/UserController.php';
require_once 'Models/ItemModel.php';

define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $ejemplo= new ItemModel();
    $ejemplo->GetElements();

    foreach (($ejemplo->GetElements()) as $lista) {
        echo "
        <li> nombre: {$lista->nombre} <br> edad: {$lista->edad_meses} <br>
        ";
    }    
}