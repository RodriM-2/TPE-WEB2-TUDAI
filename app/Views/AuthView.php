<?php

class AuthView {
        public function DisplayLogin($error, $request) {
        require_once __DIR__ . '/../../template/form_login.phtml';
    }

    public function showError($error, $user) {
        echo "<h1>$error</h1>";
    }
}