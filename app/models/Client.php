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

        $this->birth = $birth;

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
        $sth->execute(array(
            $this->name,
            $this->cpf,
            $this->rg,
            $this->telephone1,
            $this->telephone2,
            $this->birth,
            $this->email,
            $this->user_id
        ));

        $rows = $sth->rowCount();
        if($rows) {
            $response = array("status" => "success", "message" => "Cliente registrado com sucesso");
        } else {
            $response = array("status" => "error", "message" => "Ocorreu um erro, tente novamente.");
            http_response_code(400);
        }

        return $response;
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
        $sth->execute(array(
            $this->name,
            $this->cpf,
            $this->rg,
            $this->telephone1,
            $this->telephone2,
            $this->birth,
            $this->email,
            $clientId
        ));

        $rows = $sth->rowCount();
        if($rows) {
            $response = array("status" => "success", "message" => "Informações alteradas com sucesso");
        } else {
            $response = array("status" => "error", "message" => "Ocorreu um erro, tente novamente.");
            http_response_code(400);
        }

        return $response;
    }

    public static function delete($clientId) {

        $db = Db::connect();
        $query = 
                "UPDATE
                    clients
                SET 
                    isActive = not isActive
                WHERE
                    id = ?";
        $sth = $db->prepare($query);
        $sth->execute(array(
            $clientId
        ));

        $rows = $sth->rowCount();
        if($rows) {
            $response = array("status" => "success", "message" => "O status do cliente foi alterado.");
        } else {
            $response = array("status" => "error", "message" => "Ocorreu um erro, tente novamente.");
            http_response_code(400);
        }

        return $response;
    }

    public static function getInfo($clientId) {
        $db = Db::connect();
        $query = 
                "SELECT
                    name,
                    email,
                    birth,
                    cpf,
                    rg,
                    cpf,
                    telephone1,
                    telephone2
                FROM 
                    clients
                WHERE 
                    id = ?";
        $sth = $db->prepare($query);
        $sth->execute(array($clientId));

        $rows = $sth->rowCount();

        if($rows) {
            $response = array("status" => "success", "message" => "Informações encontradas.", "data" => $sth->fetch(PDO::FETCH_OBJ));
        } else {
            $response = array("status" => "error", "message" => "Ocorreu um erro, tente novamente.");
            http_response_code(400);
        }
        return $response;
    }

    public static function loadAll() {
        $db = Db::connect();
        $filter = (isset($_GET['filter'])) ? $_GET['filter'] : '';
        $search = (isset($_GET['search'])) ? $_GET['search'] : '';
        $where = '';

        if((isset($filter) && !empty($filter)) && (isset($search) && !empty($search))) {
            $where = "WHERE $filter LIKE '%$search%'";
        }
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
                    $where
                    ORDER BY
                        isActive DESC
                ";
        $sth = $db->prepare($query);
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_OBJ);

    }
}