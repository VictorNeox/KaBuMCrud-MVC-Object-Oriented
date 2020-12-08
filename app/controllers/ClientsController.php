<?php
namespace App\Controllers;
use App\Models\{Client, Validator};
use App\Core\Token;

class ClientsController {
    public function store() {
        $userData = Token::validateToken();
        $data = json_decode(file_get_contents('php://input'), true);
        
        $validate = new Validator();
        $errors = $validate->validateClient($data);

        if(!empty($errors)) {
            http_response_code(400);
            echo json_encode(array("status" => "error", "message" => $errors));
            die();
        }


        $client = new Client($data['name'], $data['cpf'], $data['rg'], $data['telephone1'], 
                            $data['telephone2'], $data['birth'], $data['email'], $userData['id']
                );

        $response = $client->store();
        echo json_encode($response);
    }

    public function update() {
        $userData = Token::validateToken();
        $data = json_decode(file_get_contents('php://input'), true);

        $validate = new Validator();
        $errors = $validate->validateClient($data);

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

        $client = new Client($data['name'], $data['cpf'], $data['rg'], $data['telephone1'], 
                            $data['telephone2'], $data['birth'], $data['email'], $userData['id']
                );

        $response = $client->update($data['id'], $userData);
        echo json_encode($response);
    }

    // Na verdade, essa irá INATIVAR o cadastro.
    public function delete() {
        $userData = Token::validateToken();

        $data = json_decode(file_get_contents('php://input'), true);

        if(!isset($data['id']) || empty($data['id'])) {
            http_response_code(400);
            $response = array("status" => "error", "message" => "O ID do cliente é obrigatório.");
            echo json_encode($response);
            die();
        }

        $response = Client::delete($data['id'], $userData);

        echo json_encode($response);
    }

    public function getInfo() {
        $id = $_GET['id'];


        if(!isset($id) || empty($id)) {
            http_response_code(400);
            $response = array("status" => "error", "message" => "O ID do cliente é obrigatório.");
            echo json_encode($response);
            die();
        }

        $response = Client::getInfo($id);

        echo json_encode($response);
    }

    public function loadAll() {
        $userData = Token::validateToken();

        $clients = Client::loadAll($userData);

        return view('clients', compact('clients'));
    }
}