<?php

namespace App\Controllers;
use App\Models\User;

class UsersController {
    public function store() {
        $data = json_decode(file_get_contents('php://input'), true);

        $user = new User($data['login'], $data['password'], $data['name'], $data['email']);

        $user->store();
        echo json_encode(array("result" => "Usuário Inserido com sucesso!"));
    }
}