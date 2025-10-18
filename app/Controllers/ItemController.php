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

        public function GetItems() {
            $items= $this->model->GetElements();
            $this->view->DisplayItems($items);
        }

        public function GetItem($id) {
            $item= $this->model->GetItem($id);
            $this->view->DisplayItem($item);
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

        public function DeleteItem($id) {
            $task = $this->model->GetItem($id);

            if (!$task) {
                return $this->view->showError("No existe el gato con el id=$id");
            }

            $this->model->RemoveItem($id);

            header('Location: ' . BASE_URL);
        }

        public function EditItem($id) {
            $item= $this->model->GetItem($id);

            if (!$item) {
                return $this->view->showError("No existe el gato con el id=$id");
            }

            $this->view->DisplayItemEdit($item);
        }

        public function UpdateItem($id_gato) {
            $name=$_POST['name'];
            $age=$_POST['age'];
            $race=$_POST['race'];
            $color=$_POST['color'];
            $weight=$_POST['weight'];
            $observation=$_POST['observations'];

            $id= $this->model->EditItem($name,$age,$race,$color,$weight,$observation,$id_gato);
        
            if (!$id) {
                return $this->view->showError('Error al insertar datos del gato');
            } 

            header('Location: ' . BASE_URL);
        }
    }