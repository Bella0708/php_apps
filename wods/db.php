<?php
class Database {
    private $host = 'localhost';
    private $dbname = 'crossapp';
    private $user = 'root';
    private $password = '0000';

    public function connect() {
        $conn = null;
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return $conn;
    }
}

