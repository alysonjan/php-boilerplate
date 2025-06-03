<?php
class Database {
    private $host = "localhost";
    private $db_name = "phpdb"; 
    private $username = "root";     
    private $password = "admin";        
    public $conn;

    public function getConnection(): PDO {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name}",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            die("Connection error: " . $exception->getMessage());
        }
        return $this->conn;
    }
}
