<?php

    require_once __DIR__ . '/../Models/ItemModel.php';
    require_once __DIR__ . '/../Views/ItemView.phtml';    

    class ItemController {

        private $model;
        private $view;

        public function __construct() {
            $this->model= new ItemModel();
            $this->view= new ItemView();
        }

        public function GetItems($request) {
            $items= $this->model->GetElements();
            $this->view->DisplayItems($items,$request);
        }

        public function GetItem($request) {
            $item= $this->model->GetItem($request);
            $this->view->DisplayItem($item,$request);
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

            $id= $this->model->AddItem($name,$age,$race,$color,$weight,$observation);
        
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

            $this->view->DisplayItemEdit($item,$request);
        }

        public function UpdateItem($request) {
            $name=$_POST['name'];
            $age=$_POST['age'];
            $race=$_POST['race'];
            $color=$_POST['color'];
            $weight=$_POST['weight'];
            $observation=$_POST['observations'];

            $id= $this->model->EditItem($name,$age,$race,$color,$weight,$observation,$request->id);
        
            if (!$id) {
                return $this->view->showError('Error al insertar datos del gato');
            } 

            header('Location: ' . BASE_URL);
        }
    }