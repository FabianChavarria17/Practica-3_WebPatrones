<?php
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {

    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function login() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($username === '' || $password === '') {
                $error = 'Completá todos los campos.';
            } else {
                $user = $this->model->findByUsername($username);
                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user_id']  = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['rol']      = $user['rol'];
                    header('Location: index.php?action=reservations');
                    exit;
                } else {
                    $error = 'Usuario o contraseña incorrectos.';
                }
            }
        }
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function register() {
        $error = '';
        $success = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm  = $_POST['confirm']  ?? '';

            if ($username === '' || $password === '' || $confirm === '') {
                $error = 'Completá todos los campos.';
            } elseif (strlen($password) < 6) {
                $error = 'La contraseña debe tener al menos 6 caracteres.';
            } elseif ($password !== $confirm) {
                $error = 'Las contraseñas no coinciden.';
            } elseif ($this->model->findByUsername($username)) {
                $error = 'Ese nombre de usuario ya está en uso.';
            } else {
                if ($this->model->create($username, $password)) {
                    $success = 'Cuenta creada. Ya podés iniciar sesión.';
                } else {
                    $error = 'Error al crear la cuenta. Intentá de nuevo.';
                }
            }
        }
        require_once __DIR__ . '/../views/auth/register.php';
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }
}