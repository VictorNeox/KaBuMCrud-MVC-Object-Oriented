<?php

namespace App\Models;
use Db;
use PDO;

class Address {
    private $street;
    private $number;
    private $neighbourhood;
    private $zipcode;
    private $city;
    private $uf;
    private $client_id;
    private $complement;

    public function __construct($street, $neighbourhood, $zipcode, $number, $city, $uf, $client_id, $complement) {
        $this->street = $street;
        $this->neighbourhood = $neighbourhood;
        $this->zipcode = $zipcode;
        $this->number = $number;
        $this->city = $city;
        $this->uf = $uf;
        $this->client_id = $client_id;
        $this->complement = $complement;
    }


    public function store() {
        $db = Db::connect();
        $query = 
                "INSERT INTO 
                    addresses (street, number, neighbourhood, zipcode, city, uf, client_id, complement)
                VALUES 
                    (?, ?, ?, ?, ?, ?, ?, ?)
                ";

        $sth = $db->prepare($query);
        $sth->execute(array(
            $this->street,
            $this->number,
            $this->neighbourhood,
            $this->zipcode,
            $this->city,
            $this->uf,
            $this->client_id,
            $this->complement
        ));

        $rows = $sth->rowCount();
        if($rows) {
            $response = array("status" => "success", "message" => "Endereço registrado com sucesso");
        } else {
            $response = array("status" => "error", "message" => "Ocorreu um erro, tente novamente.");
            http_response_code(400);
        }

        return $response;
    }
}