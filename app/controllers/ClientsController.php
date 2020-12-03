<?php
namespace App\Controllers;
use App\Models\{Client, Validator};

class ClientsController {
    public function store() {
        $data = json_decode(file_get_contents('php://input'), true);
        
        /*$validate = new Validator();
        $validate->validateName($data['name']);
        $validate->validateEmail($data['email']);
        $validate->validateCPF($data['login']);
        $validate->validateRG($data['login']);
        $validate->validateTelephone($data['telephone1']);
        $validate->validateTelephone($data['telephone2']);
        $validate->validateDate($data['birth']);*/

        $client = new Client($data['name'], $data['cpf'], $data['rg'], $data['telephone1'], 
                            $data['telephone2'], $data['birth'], $data['email'], $data['user_id']
                );

        $response = $client->store();

        echo json_encode($response);
    }
}