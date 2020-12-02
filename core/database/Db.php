<?php

class Db {
    private $connection;


    public static function connect($dbConfig) {
        $dbConfig = parse_ini_file('config/database.ini');
        $dns = $dbConfig['driver'] . ":dbname=" . $dbConfig['dbname'] . ";host=" . $dbConfig['host'];
        try {
            $connection = new PDO($dns, $dbConfig['user'], $dbConfig['pass']);
            echo "Connection Established";
            return $connection;
        } catch (PDOException $i) {
            die("ERROR: " . $i->getMessage() . "!");
        }
    }
}