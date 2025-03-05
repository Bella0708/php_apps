<?php
require_once 'db.php';

class Student {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Создать новую запись
    public function create($data) {
        $query = "INSERT INTO students (name, surname, email, phone, course) VALUES (:name, :surname, :email, :phone, :course)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':surname', $data['surname']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':course', $data['course']);
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Прочитать все записи
    public function readAll() {
        $query = "SELECT * FROM students";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Прочитать одну запись
    public function readOne($id) {
        $query = "SELECT * FROM students WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Обновить запись
    public function update($id, $data) {
        $query = "UPDATE students SET name = :name, surname = :surname, email = :email, phone = :phone, course = :course WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':surname', $data['surname']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':course', $data['course']);
        $stmt->bindParam(':id', $id);
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Удалить запись
    public function delete($id) {
        $query = "DELETE FROM students WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}

