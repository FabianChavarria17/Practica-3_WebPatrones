<?php require_once BASE_PATH . '/views/layout/header.php'; ?>

<section class="auth-section">
  <div class="auth-card">
    <h2>Iniciar Sesión</h2>

    <?php if (!empty($error)): ?>
      <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="/src/main/index.php?action=login" id="loginForm" novalidate>
      <div class="form-group">
        <label for="username">Usuario <span class="required">*</span></label>
        <input type="text" id="username" name="username" placeholder="Tu nombre de usuario" />
        <span class="error-msg" id="error-username"></span>
      </div>
      <div class="form-group">
        <label for="password">Contraseña <span class="required">*</span></label>
        <input type="password" id="password" name="password" placeholder="Tu contraseña" />
        <span class="error-msg" id="error-password"></span>
      </div>
      <button type="submit" class="btn-submit">Entrar</button>
    </form>

    <p class="auth-link">¿No tenés cuenta? <a href="index.php?action=register">Registrate aquí</a></p>
  </div>
</section>

<?php require_once BASE_PATH . '/views/layout/footer.php'; ?>