<?php

class DatabaseConnector {
    const SERVERNAME = "localhost";
    const USERNAME = "username";
    const PASSWORD = "password";
    const DBNAME = "reversia";

    private $conn = null;

    public function __construct() {
        try {
        $conn = new PDO("mysql:host=".self::SERVERNAME.";dbname=".self::DBNAME, self::USERNAME, self::PASSWORD);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
        } catch(PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}