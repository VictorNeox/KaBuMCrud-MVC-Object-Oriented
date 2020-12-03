<?php

namespace App\Models;
use Db;

class User {
    private $login; 
    private $password;
    private $name;
    private $access; 
    private $email;

    public function __construct($login, $password, $name, $email) {
        $this->login = $login;
        $this->password = $password;
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

        echo json_encode(array("result" => "Usuário Inserido com sucesso!"));
    }
}