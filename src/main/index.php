<?php
session_start();
define('BASE_PATH', __DIR__);

require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/ReservationController.php';

$action = $_GET['action'] ?? 'login';

// Rutas protegidas — requieren sesión activa
$protected = ['form', 'list', 'delete', 'reservations'];

if (in_array($action, $protected) && !isset($_SESSION['user_id'])) {
    header('Location: index.php?action=login');
    exit;
}

// Si ya está logueado y va a login/register, redirigir
if (in_array($action, ['login', 'register']) && isset($_SESSION['user_id'])) {
    header('Location: index.php?action=list');
    exit;
}

$auth        = new AuthController();
$reservation = new ReservationController();

switch ($action) {
    case 'login':
        $auth->login();
        break;
    case 'register':
        $auth->register();
        break;
    case 'logout':
        $auth->logout();
        break;
    case 'form':
    case 'reservations':
        $reservation->form();
        break;
    case 'list':
        $reservation->list();
        break;
    case 'delete':
        $reservation->delete();
        break;
    default:
        $auth->login();
        break;
}