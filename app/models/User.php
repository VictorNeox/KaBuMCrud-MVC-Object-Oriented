<?php

namespace App\Models;
use Db;
use PDO;
use App\Core\Token;

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
            $response = array("status" => "success", "message" => "Usuário registrado com sucesso");
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

    public function toogleAccess($id) {
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

    public static function authenticate($login, $password) {
        $password = sha1($password);

        $db = Db::connect();
        $query = 
            "SELECT
                id, 
                access, 
                name
            FROM
                users
            WHERE
                login = ?
            AND
                password = ?
        ";
        $sth = $db->prepare($query);
        $sth->execute(array($login, $password));

        $rows = $sth->rowCount();

        if($rows) {
            $response = array("status" => "success", "message" => "Login realizado.");
            $token = Token::generateToken($sth->fetch(PDO::FETCH_OBJ));
            setcookie('token', $token, time() + (10 * 365 * 24 * 60 * 60), '/');
        } else {
            $response = array("status" => "error", "message" => "Login e/ou senha incorretos.");
            http_response_code(400);
        }
        
        return $response;
    }
}