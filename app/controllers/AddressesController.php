<?php

namespace App\Controllers;
use App\Models\{User, Validator};
use App\Core\Token;

class UsersController {
    public function store() {
        $userData = Token::validateToken();
        $data = json_decode(file_get_contents('php://input'), true);

        $validate = new Validator();
        $errors = $validate->validateAddress($data);

        if(!empty($errors)) {
            http_response_code(400);
            echo json_encode($errors);
            die();
        }

        if(!isset($data['id']) || empty($data['id'])) {
            http_response_code(400);
            $response = array("status" => "error", "message" => "O ID do cliente é obrigatório.");
            echo json_encode($response);
            die();
        }

        $address = new Address($data['street'], $data['neighbourhood'], $data['zipcode'], $data['number'], 
                        $data['city'], $data['uf'], $data['client_id'], $userData['complement']);

        $response = $address->store();

        return json_encode($response);
    }
}