<?php

namespace App\Controllers;
use App\Models\{User, Validator};
use App\Core\Token;

class UsersController {
    public function store() {

        $data = json_decode(file_get_contents('php://input'), true);
        $validate = new Validator();
        
        $errors = $validate->validateUser($data);

        if(!empty($errors)) {
            http_response_code(400);
            echo json_encode(array("status" => "error", "message" => $errors));
            die();
        }

        $user = new User($data['login'], $data['password'], $data['name'], $data['email']);

        $response = $user->store();

        echo json_encode($response);
    }

    public function authenticate() {
        $data = json_decode(file_get_contents('php://input'), true);

        $validate = new Validator();

        $validate->validateLogin($data['login']);
        $validate->validatePassword($data['password']);

        $errors = $validate->getErrors();

        if(!empty($errors)) {
            http_response_code(400);
            echo json_encode(array("status" => "error", "message" => $errors));
            die();
        }

        $response = User::authenticate($data['login'], $data['password']);

        echo json_encode($response);
    }

    public function loadAll() {

        $userData = Token::validateToken();

        if($userData['access'] < 1) {
            header('Location: clients');
            exit();
        }

        $users = User::loadAll();

        return view('users', compact('users'));
    }

    public function toogleAccess() {
        $data = json_decode(file_get_contents('php://input'), true);

        $response = User::toogleAccess($data['id']);

        echo json_encode($response);
    }
}