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


$params = explode('/', $action);

// determina que camino seguir según la acción
switch ($params[0]) {
    case 'home':
        require_once __DIR__ . '/template/layout/home.phtml';
        break;
    case 'getItems':
        $Itemcontroller= new ItemController();
        $Itemcontroller->GetItems();
        break;
    case 'GetItem':
        $Itemcontroller= new ItemController();
        //$Categorycontroller = new $Categorycontroller();
        $Itemcontroller->GetItem($params[1]);
        break;
    case 'addItem':
        $Itemcontroller= new ItemController();
        //$Categorycontroller = new $Categorycontroller();
        $Itemcontroller->AddItem();
        break;
    case 'deleteItem':
        $Itemcontroller= new ItemController();
        $Itemcontroller->DeleteItem($params[1]);
        break;
    case 'editItem':
        $Itemcontroller= new ItemController();
        $Itemcontroller->EditItem($params[1]);
        break;
    case 'UpdateItem':
        $Itemcontroller= new ItemController();
        $Itemcontroller->UpdateItem($params[1]);
        break;
    case 'getCategorias':
        $CategoryController= new CategoryController();
        $CategoryController->GetCategorias();
        break;
    case 'addCategoria':
        $CategoryController= New CategoryController();
        $CategoryController->AddCategory();
        break;
    case 'deleteCategoria':
        $CategoryController= new CategoryController();
        $CategoryController->DeleteCategoria($params[1]);
        break;
    case 'editCategoria':
        $CategoryController= new CategoryController();
        $CategoryController->EditCategoria($params[1]);
        break;
    case 'updateCategoria':
        $CategoryController= new CategoryController();
        $CategoryController->UpdateCategory($params[1]);
        break;
    default:
        echo "Oops! Algo salio mal al cargar";
        break;
}

require_once __DIR__ . '/template/layout/footer.phtml';