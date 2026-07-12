<?php
require_once __DIR__ . '/../config/database.php';

class ReservationModel {

    public function create($user_id, $name, $contact, $date, $people, $comments) {
        $conn = getConnection();
        $stmt = $conn->prepare(
            "INSERT INTO reservations (user_id, name, contact, reservation_date, people, comments)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("isssis", $user_id, $name, $contact, $date, $people, $comments);
        $ok = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $ok;
    }

    public function getByUser($user_id) {
        $conn = getConnection();
        $stmt = $conn->prepare(
            "SELECT * FROM reservations WHERE user_id = ? ORDER BY reservation_date ASC"
        );
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $conn->close();
        return $rows;
    }

    public function delete($id, $user_id) {
        $conn = getConnection();
        $stmt = $conn->prepare("DELETE FROM reservations WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $id, $user_id);
        $ok = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $ok;
    }
}