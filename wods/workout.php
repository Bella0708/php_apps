<?php
require_once 'db.php';

class Workout {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Создать новую запись
    public function create($data) {
        $query = "INSERT INTO workouts (date, exercise, sets, reps, weight) VALUES (:date, :exercise, :sets, :reps, :weight)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':date', $data['date']);
        $stmt->bindParam(':exercise', $data['exercise']);
        $stmt->bindParam(':sets', $data['sets']);
        $stmt->bindParam(':reps', $data['reps']);
        $stmt->bindParam(':weight', $data['weight']);
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Прочитать все записи
    public function readAll() {
        $query = "SELECT * FROM workouts";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Прочитать одну запись
    public function readOne($id) {
        $query = "SELECT * FROM workouts WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Обновить запись
    public function update($id, $data) {
        $query = "UPDATE workouts SET date = :date, exercise = :exercise, sets = :sets, reps = :reps, weight = :weight WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':date', $data['date']);
        $stmt->bindParam(':exercise', $data['exercise']);
        $stmt->bindParam(':sets', $data['sets']);
        $stmt->bindParam(':reps', $data['reps']);
        $stmt->bindParam(':weight', $data['weight']);
        $stmt->bindParam(':id', $id);
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Удалить запись
    public function delete($id) {
        $query = "DELETE FROM workouts WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}

