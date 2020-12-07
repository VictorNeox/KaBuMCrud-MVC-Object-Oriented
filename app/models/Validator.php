<?php

namespace App\Models;

class Validator {
    private $errors = [];

    public function __construct() {

    }


    public function validateClient(array $data) {
        $this->validateName($data['name']);
        $this->validateEmail($data['email']);
        $this->validateCPF($data['cpf']);
        $this->validateRG($data['rg']);
        $this->validateTelephone($data['telephone1']);
        $this->validateTelephone($data['telephone2']);

        return $this->getErrors();
    }

    public function validateUser(array $data) {
        $this->validateEmail($data['email']);
        $this->validateLogin($data['login']);
        $this->validateName($data['name']);
        $this->validatePassword($data['password']);

        return $this->getErrors();
    }


    public function validateAddress(array $address) {
        $this->validateStreet($data['street']);
        $this->validateNeighbourhood($data['neighbourhood']);
        $this->validateZipcode($data['zipcode']);
        $this->validateNumber($data['number']);
        $this->validateCity($data['city']);
        $this->validateUf($data['uf']);
    }


    //---------------------------------------------------------------//


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
        if(!isset($telephone) || empty($telephone) || strlen($telephone) != 9 || !preg_match('/^[0-9]*$/', $telephone)) {
            $this->setError("O Telefone é obrigatório e precisa ter exatamente 9 caractéres (Apenas números).");
        }
    }

    public function validateStreet($street) {
        if(!isset($street) || empty($street)) {
            $this->setError("A rua é obrigatória.");
        }
    }

    public function validateNeighbourhood($neighbourhood) {
        if(!isset($neighbourhood) || empty($neighbourhood)) {
            $this->setError("O bairro é obrigatório.");
        }
    }

    public function validateZipcode($zipcode) {
        if(!isset($zipcode) || empty($zipcode) || strlen($zipcode) != 8 || !preg_match('/^[0-9]*$/', $zipcode)) {
            $this->setError("O cep é obrigatório e precisa ter 9 caractéres (apenas numeros).");
        }
    }

    public function validateNumber($number) {
        if(!isset($number) || empty($number)) {
            $this->setError("O número é obrigatório.");
        }
    }

    public function validateCity($city) {
        if(!isset($city) || empty($city)) {
            $this->setError("A cidade é obrigatória.");
        }
    }

    public function validateUf($city) {
        if(!isset($city) || empty($city)) {
            $this->setError("O UF é obrigatório e precisa ter apenas 2 caractéres.");
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