<?php
namespace App\Controllers;
use App\Models\{Client, Validator};

class ClientsController {
    public function store() {
        $data = json_decode(file_get_contents('php://input'), true);
        
        $validate = new Validator();
        $errors = $validate->validateClient($data);

        if(!empty($errors)) {
            http_response_code(400);
            echo json_encode($errors);
            die();
        }

        $client = new Client($data['name'], $data['cpf'], $data['rg'], $data['telephone1'], 
                            $data['telephone2'], $data['birth'], $data['email'], $data['user_id']
                );

        $response = $client->store();
        echo json_encode($response);
    }

    public function update() {
        $data = json_decode(file_get_contents('php://input'), true);

        $validate = new Validator();
        $errors = $validate->validateClient($data);

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

        $client = new Client($data['name'], $data['cpf'], $data['rg'], $data['telephone1'], 
                            $data['telephone2'], $data['birth'], $data['email'], $data['user_id']
                );

        $response = $client->update($data['id']);
        echo json_encode($response);
    }

    // Na verdade, essa irá INATIVAR o cadastro.
    public function delete() {


        $data = json_decode(file_get_contents('php://input'), true);

        if(!isset($data['id']) || empty($data['id'])) {
            http_response_code(400);
            $response = array("status" => "error", "message" => "O ID do cliente é obrigatório.");
            echo json_encode($response);
            die();
        }

        $response = Client::delete($data['id']);

        echo json_encode($response);
    }

    public function getInfo() {
        $data = json_decode(file_get_contents('php://input'), true);

        echo json_encode($data);

        // if(!isset($data['id']) || empty($data['id'])) {
        //     http_response_code(400);
        //     $response = array("status" => "error", "message" => "O ID do cliente é obrigatório.");
        //     echo json_encode($response);
        //     die();
        // }

        // $response = Client::delete($data['id']);

        // echo json_encode($response);
    }

    public function loadAll() {
        $clients = Client::loadAll();

        return view('clients', compact('clients'));
    }
}