<?php
require_once __DIR__ . '/../config/database.php';

class UserModel {

    public function findByUsername($username) {
        $conn = getConnection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $user;
    }

    public function create($username, $password, $rol = 'user') {
        $conn = getConnection();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, password, rol) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hash, $rol);
        $ok = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $ok;
    }
}