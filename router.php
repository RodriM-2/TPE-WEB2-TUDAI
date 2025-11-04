<?php
//Por "Item" se hace referencia a la entidad N de la relacion (En este caso 'Gatos')
//Por "Categoria" se refiere a la entidad 1 ('Peluqueros')

require_once 'app/Controllers/ItemController.php';
require_once 'app/Controllers/CategoryController.php';
require_once 'app/Controllers/AuthController.php';

require_once 'app/Middleware/RedirectMiddleware.php';
require_once 'app/Middleware/SessionMiddleware.php';

session_start();

define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home';
}


$params = explode('/', $action);

$request = new StdClass();
$request = (new SessionMiddleware())->run($request);

switch ($params[0]) {
    case 'home':
        //Esto en realidad no va, pero es mas para que no aparezca un fondo blanco al inicio
        require_once __DIR__ . '/template/layout/home.phtml';
        break;
    case 'getItems':
        $Itemcontroller= new ItemController();
        $Itemcontroller->GetItems($request);
        break;
    case 'GetItem':
        $Itemcontroller= new ItemController();
        $request->id= $params[1];
        $Itemcontroller->GetItem($request);
        break;
    case 'addItem':
        $request= (new RedirectMiddleware())->run($request);
        $Itemcontroller= new ItemController();
        $Itemcontroller->AddItem();
        break;
    case 'deleteItem':
        $request= (new RedirectMiddleware())->run($request);
        $Itemcontroller= new ItemController();
        $request->id= $params[1];
        $Itemcontroller->DeleteItem($request);
        break;
    case 'editItem':
        $request= (new RedirectMiddleware())->run($request);
        $Itemcontroller= new ItemController();
        $request->id= $params[1];
        $Itemcontroller->EditItem($request);
        break;
    case 'UpdateItem':
        $request= (new RedirectMiddleware())->run($request);
        $Itemcontroller= new ItemController();
        $request->id= $params[1];
        $Itemcontroller->UpdateItem($request);
        break;
    case 'getCategorias':
        $CategoryController= new CategoryController();
        $CategoryController->GetCategorias($request);
        break;
    case 'addCategoria':
        $request= (new RedirectMiddleware())->run($request);
        $CategoryController= New CategoryController();
        $CategoryController->AddCategory();
        break;
    case 'deleteCategoria':
        $request= (new RedirectMiddleware())->run($request);
        $CategoryController= new CategoryController();
        $request->id= $params[1];
        $CategoryController->DeleteCategoria($request);
        break;
    case 'editCategoria':
        //Pushea el formulario para editar
        $request= (new RedirectMiddleware())->run($request);
        $CategoryController= new CategoryController();
        $request->id_peluquero= $params[1];
        $CategoryController->EditCategoria($request);
        break;
    case 'updateCategoria':
        //Actualmente envia los cambios a la BDD
        $request= (new RedirectMiddleware())->run($request);
        $CategoryController= new CategoryController();
        $request->id= $params[1];
        $CategoryController->UpdateCategory($request);
        break;
    case 'search':
        $request= (new RedirectMiddleware())->run($request);
        $CategoryController= new CategoryController();
        $CategoryController->ShowBusqueda($request);
        break;
    case 'doSearch':
        //Busqueda en la BDD basado en un form
        $request= (new RedirectMiddleware())->run($request);
        $Itemcontroller= new ItemController();
        if (isset($_POST['peluquero_id'])) {
            $request->id = $_POST['peluquero_id']; 
        } else {
            $request->id = null;
        }
        $Itemcontroller->ShowItemsByCategory($request);
        break;
    case 'login':
        $AuthController= new AuthController();
        $AuthController->showLogin($request);
        break;
    case 'Dologin':
        $AuthController= new AuthController();
        $AuthController->doLogin($request);
        break;
    case 'logout':
        $AuthController= new AuthController();
        $AuthController->logout($request);
    default:
        echo "Oops! Algo salio mal al cargar";
        break;
}