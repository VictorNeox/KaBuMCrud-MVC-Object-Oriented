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

        echo $client->store();
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
            echo json_encode(["O ID do client é obrigatório."]);
            die();
        }

        $client = new Client($data['name'], $data['cpf'], $data['rg'], $data['telephone1'], 
                            $data['telephone2'], $data['birth'], $data['email'], $data['user_id']
                );

        echo $client->update($data['id']);
    }

    // Na verdade, essa irá INATIVAR o cadastro.
    public function delete() {
        $data = json_decode(file_get_contents('php://input'), true);

        if(!isset($data['id']) || empty($data['id'])) {
            http_response_code(400);
            echo json_encode(["O ID do client é obrigatório."]);
            die();
        }

        echo Client::delete($data['id']);
    }

    public function loadAll() {
        $clients = Client::loadAll();

        return view('clients', compact('clients'));
    }
}