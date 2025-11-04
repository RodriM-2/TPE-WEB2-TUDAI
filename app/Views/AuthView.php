<?php

class AuthView {
    public function DisplayLogin($error, $request) {
        require_once __DIR__ . '/../../template/Auth/form_login.phtml';
    }

    public function showError($error, $user) {
        require_once __DIR__ . '/../../template/error.phtml';
    }
}