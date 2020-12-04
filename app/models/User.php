<?php

namespace App\Models;
use Db;
use PDO;

class User {
    public $id;
    public $login; 
    public $password;
    public $name;
    public $access; 
    public $email;

    public function __construct($login, $password, $name, $email) {
        $this->login = $login;
        $this->password = sha1($password);
        $this->name = $name;
        $this->email = $email;
    }

    public function store() {
        $db = Db::connect();
        $query = "INSERT INTO 
                    users (login, password, name, email)
                VALUES 
                    (?, ?, ?, ?)
                ";
        $sth = $db->prepare($query);
        $sth->execute(array(
            $this->login,
            $this->password,
            $this->name,
            $this->email
        ));


        $rows = $sth->rowCount();
        if($rows) {
            $response = array("status" => "success", "message" => "Usuário inserido com sucesso");
        } else {
            $response = array("status" => "error", "message" => "Ocorreu um erro, tente novamente.");
            http_response_code(400);
        }
        
        return $response;
    }

    public function loadAll() {
        $db = Db::connect();
        $query = 
                "SELECT    
                        id,
                        name,
                        access,
                        email
                    FROM
                        users
                ";
        $sth = $db->prepare($query);
        $sth->execute();
        
        return $sth->fetchAll(PDO::FETCH_OBJ);
    }

    public function toogleAccess($iddsadsa) {
        $db = Db::connect();
        $query = 
            "UPDATE
                users
            SET access = NOT access
            WHERE id = ?
        ";
        $sth = $db->prepare($query);
        $sth->execute(array($id));

        $rows = $sth->rowCount();

        if($rows) {
            $response = array("status" => "success", "message" => "O nível de acesso do usuário foi alterado.");
        } else {
            $response = array("status" => "error", "message" => "Ocorreu um erro, tente novamente.");
            http_response_code(400);
        }
        
        return $response;
    }
}