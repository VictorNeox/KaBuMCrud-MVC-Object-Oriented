<?php

namespace App\Models;

class Validator {
    private $errors = [];

    public function __construct() {

    }

    public function validateEmail($email) {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->setError('E-mail inválido ou inexistente.');
        }
    }

    public function validateName($name) {
        if(!isset($name) || empty($name)) {
            $this->setError('Nome é obrigatório.');
        }
    }

    public function validateLogin($login) {
        if(!isset($login) || empty($login) || strlen($login) < 4) {
            $this->setError('Login precisa ter ao menos 4 caractéres.');
        }
    }
    public function validatePassword($password) {
        if(!isset($password) || empty($password)) {
            $this->setError('A senha é obrigatória.');
        }
    }

    private function setError($error) {
        array_push($this->errors, $error);
    }

    public function getErrors() {
        return $this->errors;
    }
}