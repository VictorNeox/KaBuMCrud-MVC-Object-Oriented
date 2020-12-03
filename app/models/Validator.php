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

    public function validateCPF($cpf) {
        if(!isset($cpf) || empty($cpf) || strlen($cpf) != 11 || !preg_match('/^[0-9]*$/', $cpf)) {
            $this->setError("O CPF é obrigatório e precisa ter exatamente 11 caractéres (Apenas números).");
        }
    }

    public function validateRG($rg) {
        if(!isset($rg) || empty($rg) || strlen($rg) != 9 || !preg_match('/^[0-9]*$/', $rg)) {
            $this->setError("O RG é obrigatório e precisa ter exatamente 9 caractéres (Apenas números).");
        }
    }

    public function validateTelephone($telephone) {
        if(!isset($telephone) || empty($telephone) || strlen($telephone) != 9 || !preg_match('/^[0-9]*$/', $rg)) {
            $this->setError("O Telefone é obrigatório e precisa ter exatamente 9 caractéres (Apenas números).");
        }
    }

    // public function validateDate($date) {
    //     if(!isset($date) || empty($date) || checkdate($date)) {
    //         $this->setError("Data inválida.");
    //     }
    // }

    private function setError($error) {
        array_push($this->errors, $error);
    }

    public function getErrors() {
        return $this->errors;
    }
}