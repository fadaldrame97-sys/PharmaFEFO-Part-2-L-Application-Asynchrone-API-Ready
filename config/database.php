<?php
// config/database.php

class Database {
    private static $connection = null;

    public static function getConnection() {
        if (self::$connection === null) {
            try {
                $host = 'localhost';
                $dbname = 'pharmafefo';
                $username = 'root';
                $password = ''; 

                self::$connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
                
               
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        return self::$connection;
    }
}