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

    public function __construct($id, $login, $password, $name, $access, $email) {
        $this->login = $login;
        $this->password = sha1($password);
        $this->name = $name;
        $this->email = $email;
        echo 'instanciado';
    }

    public function store() {
        $db = Db::connect();
        $query = "INSERT INTO 
                    users (login, password, name, email)
                VALUES 
                    (?, ?, ?, ?)
                ";
        $sth = $db->prepare($query);
        $rows = $sth->execute(array(
            $this->login,
            $this->password,
            $this->name,
            $this->email
        ));

        return ($rows) ? json_encode("Usuário inserido com sucesso.") : json_encode("Ocorreu um erro durante a inserção no banco.");
    }

    public function listAll() {
        $db = Db::connect();
        $query = 
                "SELECT    
                        id,
                        login,
                        password,
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
}