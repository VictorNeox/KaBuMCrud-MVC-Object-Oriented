<?php

namespace App\Controllers;
use App\Models\{User, Validator};

class UsersController {
    public function store() {

        $data = json_decode(file_get_contents('php://input'), true);
        $validate = new Validator();

        $validate->validateEmail($data['email']);
        $validate->validateLogin($data['login']);
        $validate->validateName($data['name']);
        $validate->validatePassword($data['password']);

        $errors = $validate->getErrors();

        if(!empty($errors)) {
            http_response_code(400);
            echo json_encode($errors);
            die();
        }

        $user = new User($data['login'], $data['password'], $data['name'], $data['email']);

        $response = $user->store();

        echo $response;
    }

    // public function authenticate() {
    //     $data = json_decode(file_get_contents('php://input'), true);

    //     $validate = new Validator();

    //     $validate->validateLogin($data['login']);
    //     $validate->validatePassword($data['password']);

    //     $errors = $validate->getErrors();

    //     if(!empty($errors)) {
    //         http_response_code(400);
    //         echo json_encode($errors);
    //         die();
    //     }

    //     $response = User::authenticate($data['login'], $data['password']);

    //     if(!$response) 
    // }

    public function listAll() {
        $users = User::listAll();

        return view('users', compact('users'));
    }
}