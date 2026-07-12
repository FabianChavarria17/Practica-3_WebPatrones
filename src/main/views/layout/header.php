<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Le Blanc</title>
  <link rel="stylesheet" href="/src/main/styles.css" />
</head>
<body>
<header>
  <nav class="navbar">
    <div class="logo">Le Blanc</div>
    <ul class="nav-links">
      <?php if (isset($_SESSION['user_id'])): ?>
        <li><a href="/src/main/index.php?action=form">Reservar</a></li>
        <li><a href="/src/main/index.php?action=list">Mis Reservas</a></li>
        <li><span class="nav-user">👤 <?= htmlspecialchars($_SESSION['username']) ?></span></li>
        <li><a href="/src/main/index.php?action=logout">Cerrar sesión</a></li>
      <?php else: ?>
        <li><a href="/src/main/index.php?action=login">Iniciar sesión</a></li>
        <li><a href="/src/main/index.php?action=register">Registrarse</a></li>
      <?php endif; ?>
    </ul>
  </nav>
</header>
<main>