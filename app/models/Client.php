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

    public function update($clientId, $userData) {
        $access = $userData['access'];
        $user_id = $userData['id'];
        $db = Db::connect();
        $where = ($access < 1) ? "AND user_id = '$user_id'" : "";
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
                    id = ?
                    $where";
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

    public static function getFullInfo($clientId)  {
        $db = Db::connect();
        $query = 
                "SELECT
                    clt.name,
                    clt.cpf,
                    clt.rg,
                    clt.birth,
                    clt.email,
                    clt.telephone1,
                    clt.telephone2,
                    adr.street, 
                    adr.number, 
                    adr.neighbourhood, 
                    adr.city, 
                    adr.uf, 
                    adr.zipcode, 
                    adr.complement
                FROM 
                    clients clt
                LEFT JOIN 
                    addresses adr
                ON 
                    clt.id = adr.client_id 
                    AND adr.main_address = 1
                WHERE
                    clt.id = ?";
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

    public static function delete($clientId, $userData) {

        $access = $userData['access'];
        
        if($access < 1) {
            $response = array("status" => "error", "message" => "Você não tem permissão para isso.");
            http_response_code(403);
            return $response;
        }
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

    public static function loadAll($userData) {

        $access = $userData['access'];
        $user_id = $userData['id'];

        $db = Db::connect();
        $filter = (isset($_GET['filter'])) ? $_GET['filter'] : '';
        $search = (isset($_GET['search'])) ? $_GET['search'] : '';
        $where = '';
        $whereId = '';

        if((isset($filter) && !empty($filter)) && (isset($search) && !empty($search))) {
            $where = "WHERE clt.$filter LIKE '%$search%'";
        }

        if($access < 1) {
            $where = (empty($where)) ? "WHERE clt.user_id = '$user_id'" : $where . " AND clt.user_id = '$user_id'";
        }
        
        $query = 
                "SELECT    
                        clt.id,
                        clt.name,
                        clt.rg,
                        clt.cpf,
                        clt.telephone1,
                        clt.telephone2,
                        clt.birth,
                        clt.email,
                        clt.isActive,
                        usr.name responsible
                    FROM
                        clients clt
                    LEFT JOIN
                        users usr
                    ON 
                        clt.user_id = usr.id
                    $where
                    ORDER BY
                        isActive DESC
                ";
        $sth = $db->prepare($query);
        $sth->execute();

        return array('user' => $userData, 'clients' => $sth->fetchAll(PDO::FETCH_OBJ));

    }
}