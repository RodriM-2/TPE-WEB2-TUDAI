<?php

    require_once __DIR__ . '/../Models/ItemModel.php';
    require_once __DIR__ . '/../Views/ItemView.phtml';    
    //Me traigo el Model de Categorias (Peluqueros) porque necesito ver las claves foraneas
    require_once __DIR__ . '/../Models/CategoryModel.php';

    class ItemController {

        private $model;
        private $FKmodel;
        private $view;

        public function __construct() {
            $this->model= new ItemModel();
            $this->view= new ItemView();
            $this->FKmodel= new CategoryModel();
        }

        public function GetItems($request) {
            $items= $this->model->GetElements();
            $FK= $this->FKmodel->GetElements();
            $this->view->DisplayItems($items,$FK,$request);
        }

        public function GetItem($request) {
            $item= $this->model->GetItem($request);
            if ($item->id_peluquero) {
                $FK= $this->FKmodel->GetCategoryByID($item);
            } else {
                $FK='';
            }
            $this->view->DisplayItem($item,$FK,$request);
        }

        public function AddItem() {
            if (!isset($_POST['name']) || empty($_POST['name'])) {
                return $this->view->showError('Error: falta completar el nombre');
            }

            if (!isset($_POST['age']) || empty($_POST['age'])) {
                return $this->view->showError('Error: falta completar la edad');
            }

            if (!isset($_POST['race']) || empty($_POST['race'])) {
                return $this->view->showError('Error: falta completar la raza');
            }

            if (!isset($_POST['weight']) || empty($_POST['weight'])) {
                return $this->view->showError('Error: falta completar el peso');
            }

            $name=$_POST['name'];
            $age=$_POST['age'];
            $race=$_POST['race'];
            $color=$_POST['color'];
            $weight=$_POST['weight'];
            $observation=$_POST['observations'];
            $peluquero= empty($_POST['peluquero']) ? NULL : $_POST['peluquero'];

            $id= $this->model->AddItem($name,$age,$race,$color,$weight,$observation,$peluquero);
        
            if (!$id) {
                return $this->view->showError('Error al insertar datos del gato');
            } 

            header('Location: ' . BASE_URL);
        }

        public function DeleteItem($request) {
            $task = $this->model->GetItem($request);

            if (!$task) {
                return $this->view->showError("No existe el gato con el id=$request->id");
            }

            $this->model->RemoveItem($request->id);

            header('Location: ' . BASE_URL);
        }

        public function EditItem($request) {
            $item= $this->model->GetItem($request);

            if (!$item) {
                return $this->view->showError("No existe el gato con el id=$request->id");
            }

            $FK= $this->FKmodel->GetElements();

            $this->view->DisplayItemEdit($item,$FK,$request);
        }

        public function UpdateItem($request) {
            $name=$_POST['name'];
            $age=$_POST['age'];
            $race=$_POST['race'];
            $color=$_POST['color'];
            $weight=$_POST['weight'];
            $observation=$_POST['observations'];
            $peluquero= empty($_POST['peluquero']) ? NULL : $_POST['peluquero'];

            $id= $this->model->EditItem($name,$age,$race,$color,$weight,$observation,$peluquero,$request->id);
        
            if (!$id) {
                return $this->view->showError('Error al insertar datos del gato');
            } 

            header('Location: ' . BASE_URL);
        }

        public function ShowItemsByCategory($request) {
            $items= $this->model->GetItemsByCategory($request);
            $this->view->DisplayItems($items,'',$request);
        }
    }