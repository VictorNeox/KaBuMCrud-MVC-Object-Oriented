<?php

namespace App\Models;
use Db;
use PDO;

class Client {
    private $name;
    private $cpf;
    private $rg;
    private $telephone1;
    private $telephone2;
    private $birth;
    private $email;
    private $user_id;

    public function __construct($name, $cpf, $rg, $telephone1, $telephone2, $birth, $email, $user_id) {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->rg = $rg;
        $this->telephone1 = $telephone1;
        $this->telephone2 = $telephone2;

        $this->birth = implode('-', array_reverse(explode("/",$birth)));

        $this->email = $email;
        $this->user_id = $user_id;
    }


    public function store() {
        $db = Db::connect();
        $query = 
                "INSERT INTO 
                    clients (name, cpf, rg, telephone1, telephone2, birth, email, user_id)
                VALUES 
                    (?, ?, ?, ?, ?, ?, ?, ?)
                ";

        $sth = $db->prepare($query);
        $rows = $sth->execute(array(
            $this->name,
            $this->cpf,
            $this->rg,
            $this->telephone1,
            $this->telephone2,
            $this->birth,
            $this->email,
            $this->user_id
        ));

        return ($rows) ? json_encode("Cliente inserido com sucesso.") : json_encode("Ocorreu um erro durante a inserção no banco.");
    }

    public function update($clientId) {
        $db = Db::connect();
        $query = 
                "UPDATE
                    clients
                SET 
                    name = ?,
                    cpf = ?,
                    rg = ?,
                    telephone1 = ?,
                    telephone2 = ?,
                    birth = ?,
                    email = ?
                WHERE
                    id = ?";
        $sth = $db->prepare($query);
        $rows = $sth->execute(array(
            $this->name,
            $this->cpf,
            $this->rg,
            $this->telephone1,
            $this->telephone2,
            $this->birth,
            $this->email,
            $clientId
        ));

        return ($rows) ? json_encode("Cliente atualizado com sucesso.") : json_encode("Ocorreu um erro durante a atualização no banco.");
    }

    public function delete($clientId) {
        $db = Db::connect();
        $query = 
                "UPDATE
                    clients
                SET 
                    isActive = not isActive
                WHERE
                    id = ?";
        $sth = $db->prepare($query);
        $rows = $sth->execute(array(
            $clientId
        ));

        return ($rows) ? json_encode("Status do Cliente atualizado com sucesso.") : json_encode("Ocorreu um erro durante a atualização no banco.");
    }

    public static function loadAll() {
        $db = Db::connect();

        $query = 
                "SELECT    
                        id,
                        name,
                        rg,
                        cpf,
                        telephone1,
                        telephone2,
                        birth,
                        email,
                        isActive
                    FROM
                        clients
                ";
        $sth = $db->prepare($query);
        $sth->execute();
        $clients = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $clients;

    }
}