<?php
require_once __DIR__ . '/../models/ReservationModel.php';

class ReservationController {

    private $model;

    public function __construct() {
        $this->model = new ReservationModel();
    }

    public function form() {
        $error   = '';
        $success = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name     = trim($_POST['nombre']       ?? '');
            $contact  = trim($_POST['contacto']     ?? '');
            $date     = $_POST['fecha']             ?? '';
            $people   = intval($_POST['personas']   ?? 0);
            $comments = trim($_POST['comentarios']  ?? '');
            $today    = date('Y-m-d');

            if ($name === '' || $contact === '' || $date === '' || $people <= 0) {
                $error = 'Completá todos los campos obligatorios correctamente.';
            } elseif ($date < $today) {
                $error = 'La fecha no puede ser anterior a hoy.';
            } else {
                $ok = $this->model->create(
                    $_SESSION['user_id'], $name, $contact, $date, $people, $comments
                );
                if ($ok) {
                    $success = 'Reservación registrada correctamente.';
                } else {
                    $error = 'Error al guardar la reservación.';
                }
            }
        }
        require_once __DIR__ . '/../views/reservations/form.php';
    }

    public function list() {
        $reservations = $this->model->getByUser($_SESSION['user_id']);
        require_once __DIR__ . '/../views/reservations/list.php';
    }

    public function delete() {
        $id = intval($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->model->delete($id, $_SESSION['user_id']);
        }
        header('Location: index.php?action=list');
        exit;
    }
}