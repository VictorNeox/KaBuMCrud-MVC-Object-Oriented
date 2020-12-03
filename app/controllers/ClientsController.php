<?php
namespace App\Controllers;
use App\Models\{Client, Validator};

class ClientsController {
    public function store() {
        $data = json_decode(file_get_contents('php://input'), true);
        
        $validate = new Validator();
        $validate->validateName($data['name']);
        $validate->validateEmail($data['email']);
        $validate->validateCPF($data['cpf']);
        $validate->validateRG($data['rg']);
        $validate->validateTelephone($data['telephone1']);
        $validate->validateTelephone($data['telephone2']);
        // $validate->validateDate($data['birth']);

        $errors = $validate->getErrors();

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
}