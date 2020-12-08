<?php

namespace App\Controllers;
use App\Models\{Address, Validator};
use App\Core\Token;

class AddressesController {
    public function store() {
        $userData = Token::validateToken();
        $data = json_decode(file_get_contents('php://input'), true);

        $validate = new Validator();
        $errors = $validate->validateAddress($data);

        if(!empty($errors)) {
            http_response_code(400);
            echo json_encode(array("status" => "error", "message" => $errors));
            die();
        }

        if(!isset($data['id']) || empty($data['id'])) {
            http_response_code(400);
            $response = array("status" => "error", "message" => "O ID do cliente é obrigatório.");
            echo json_encode($response);
            die();
        }

        $address = new Address($data['street'], $data['neighbourhood'], $data['zipcode'], $data['number'], 
                        $data['city'], $data['uf'], $data['id'], $data['complement']);

        $response = $address->store();

        echo json_encode($response);
    }

    public function update() {
        $userData = Token::validateToken();
        $data = json_decode(file_get_contents('php://input'), true);

        $validate = new Validator();
        $errors = $validate->validateAddress($data);

        if(!empty($errors)) {
            http_response_code(400);
            echo json_encode(array("status" => "error", "message" => $errors));
            die();
        }

        if(!isset($data['id']) || empty($data['id'])) {
            http_response_code(400);
            $response = array("status" => "error", "message" => "O ID do endereço é obrigatório.");
            echo json_encode($response);
            die();
        }

        $address = new Address($data['street'], $data['neighbourhood'], $data['zipcode'], $data['number'], 
                        $data['city'], $data['uf'], $data['id'], $data['complement']);

        $response = $address->update($data['id']);
        echo json_encode($response);
    }

    public function toogleMainAddress() {
        $userData = Token::validateToken();
        $data = json_decode(file_get_contents('php://input'), true);

        if(!isset($data['id']) || empty($data['id'])) {
            http_response_code(400);
            $response = array("status" => "error", "message" => "O ID do endereço é obrigatório.");
            echo json_encode($response);
            die();
        }
        
        $response = Address::toogleMainAddress($data['id']);

        echo json_encode($response);
    }

    public function delete() {
        $userData = Token::validateToken();
        $data = json_decode(file_get_contents('php://input'), true);

        if(!isset($data['id']) || empty($data['id'])) {
            http_response_code(400);
            $response = array("status" => "error", "message" => "O ID do endereço é obrigatório.");
            echo json_encode($response);
            die();
        }
        
        $response = Address::delete($data['id']);

        echo json_encode($response);
    }


    public function getInfo() {
        $id = $_GET['id'];


        if(!isset($id) || empty($id)) {
            http_response_code(400);
            $response = array("status" => "error", "message" => "O ID do endereço é obrigatório.");
            echo json_encode($response);
            die();
        }

        $response = Address::getInfo($id);

        echo json_encode($response);
    }

    public function loadAllById() {
        $userData = Token::validateToken();
        if(!isset($_GET['id']) || empty($_GET['id'])) {
            header("Location: clients");
            die();
        }
        $clientId = $_GET['id'];
        
        $data = Address::loadAllById($clientId);

        return view('addresses', compact('data'));
    }
}