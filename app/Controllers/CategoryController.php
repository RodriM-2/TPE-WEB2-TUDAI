<?php

    require_once __DIR__ . '/../Models/CategoryModel.php';
    require_once __DIR__ . '/../Views/CategoryView.phtml';

    class CategoryController {
        private $model;
        private $view;

        public function __construct() {
            $this->model= new CategoryModel();
            $this->view= new CategoryView();
        }

        public function GetCategorias() {
            $categorias= $this->model->GetElements();
            $this->view->DisplayCategorias($categorias);
        }

        public function AddCategory() {
            if (!isset($_POST['name']) || empty($_POST['name'])) {
                return $this->view->showError('Error: falta completar el nombre');
            }

            if (!isset($_POST['phoneNumber']) || empty($_POST['phoneNumber'])) {
                return $this->view->showError('Error: falta completar el numero de telefono');
            }

            if (!isset($_POST['age']) || empty($_POST['age'])) {
                return $this->view->showError('Error: falta completar la edad');
            }

            $name= $_POST['name'];
            $phoneNumber= $_POST['phoneNumber'];
            $schedule= $_POST['schedule'];
            $age= $_POST['age'];
            $specialty= $_POST['specialty'];

            $id= $this->model->AddCategory($name,$phoneNumber,$age,$schedule,$specialty);
        
            if (!$id) {
                return $this->view->showError('Error al insertar datos del peluquero');
            } 

            header('Location: ' . BASE_URL);
        }

        public function DeleteCategoria($id) {
            $task = $this->model->GetCategoryByID($id);

            if (!$task) {
                return $this->view->showError("No existe la tarea con el id=$id");
            }

            $this->model->RemoveCategory($id);

            header('Location: ' . BASE_URL);
        }

        public function EditCategoria($id) {
            $item= $this->model->GetCategoryByID($id);

            if (!$item) {
                return $this->view->showError("No existe el peluquero con el id=$id");
            }

            $this->view->DisplayCategoriaEdit($item);
        }

        public function UpdateCategory($id_peluquero) {
            $name=$_POST['name'];
            $phoneNumber=$_POST['phoneNumber'];
            $schedule=$_POST['schedule'];
            $age=$_POST['age'];
            $specialty=$_POST['specialty'];

            $id= $this->model->EditCategory($name,$phoneNumber,$age,$schedule,$specialty,$id_peluquero);
        
            if (!$id) {
                return $this->view->showError('Error al actualizar peluquero');
            } 

            header('Location: ' . BASE_URL);
        }
    }