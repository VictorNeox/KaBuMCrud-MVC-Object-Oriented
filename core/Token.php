<?php

namespace App\Core;
use Db;
use PDO;

class Token {
    public static function generateToken($user) {

        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT'
        ];
        $payload = [
            'uid' => $user->id,
            'access' => $user->access,
            'name' => $user->name
        ];
         
        $header = json_encode($header);
        $header = base64_encode($header);
         
        $payload = json_encode($payload);
        $payload = base64_encode($payload);
         
        $signature = hash_hmac('sha256',"$header.$payload",'KaBuMCRUD',true);
        $signature = base64_encode($signature);

        return "$header.$payload.$signature";
    }

    public static function validateToken() {

        $token = $_COOKIE['token'];

        if((!isset($_COOKIE['token']) || empty($_COOKIE['token'])))  {
            header('Location: login');
            die();
        }

        $part = explode(".",$token);
        $header = $part[0];
        $payload = $part[1];
        $signature = $part[2];
        
        
        $valid = hash_hmac('sha256',"$header.$payload",'KaBuMCRUD',true);
        $valid = base64_encode($valid);
        
        if($signature != $valid){
            setcookie('token', '', time() - 3000, '/');
            header('Location: login');
            exit();
        }

        $payload = base64_decode($payload);
        $payload = json_decode($payload);


        $db = Db::connect();
        $query = 
            "SELECT
                id, 
                access, 
                name
            FROM
                users
            WHERE
                id = ?
        ";
        $sth = $db->prepare($query);
        $sth->execute(array($payload->uid));

        $user = $sth->fetch(PDO::FETCH_OBJ);

        $userData = [
            'id' => $payload->uid,
            'access' => $user->access,
            'name' => $payload->name
        ];

        return $userData;
    }

}