<?php
require_once 'Database.php';

class Person {
    private PDO $conn;
    public string $firstname;
    public string $lastname;
    public string $birthdate;
    public string $gender;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    public function create(): int {
        $sql = "INSERT INTO persons (firstname, lastname, birthdate, gender) 
                VALUES (:firstname, :lastname, :birthdate, :gender)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':firstname' => $this->firstname,
            ':lastname' => $this->lastname,
            ':birthdate' => $this->birthdate,
            ':gender' => $this->gender,
        ]);
        return (int)$this->conn->lastInsertId();
    }

    public function read(int $id): ?array {
        $stmt = $this->conn->prepare("SELECT * FROM persons WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function update(int $id): bool {
        $sql = "UPDATE persons SET firstname = :firstname, lastname = :lastname,
                birthdate = :birthdate, gender = :gender WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':firstname' => $this->firstname,
            ':lastname' => $this->lastname,
            ':birthdate' => $this->birthdate,
            ':gender' => $this->gender,
            ':id' => $id,
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM persons WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
