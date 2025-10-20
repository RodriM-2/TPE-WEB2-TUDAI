<?php

    require_once __DIR__ . '/../Models/UserModel.php';
    require_once __DIR__ . '/../Views/AuthView.php';

    class AuthController {
        private $model;
        private $view;

        public function __construct() {
            $this->model= new UserModel();
            $this->view= new AuthView();
        }

        public function showLogin($request) {
            $this->view->DisplayLogin("", $request);
        }

        public function doLogin($request) {
            if(empty($_POST['username']) || empty($_POST['password'])) {
                return $this->view->DisplayLogin("Error! Falta completar datos", $request);
            }
            $User= $_POST['username'];
            $Password= $_POST['password'];

            $UserDB= $this->model->getByUsername($User);

            if($UserDB && password_verify($Password, $UserDB->password)) {
                $_SESSION['username_id'] = $UserDB->id;
                $_SESSION['user_name'] = $UserDB->username;
                header("Location: ".BASE_URL."home");
                return;
            } else {
                return $this->view->DisplayLogin("Error! Usuario y/o contraseña incorrectos", $request);
            }
        }

        public function logout($request) {
            session_destroy();
            header("Location: ".BASE_URL."login");
        return;
        }
    }