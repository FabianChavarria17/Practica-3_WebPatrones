<?php require_once BASE_PATH . '/views/layout/header.php'; ?>

<section class="auth-section">
  <div class="auth-card">
    <h2>Crear Cuenta</h2>

    <?php if (!empty($error)): ?>
      <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
      <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST" action="/src/main/index.php?action=register" id="registerForm" novalidate>
      <div class="form-group">
        <label for="username">Usuario <span class="required">*</span></label>
        <input type="text" id="username" name="username" placeholder="Elegí un nombre de usuario" />
        <span class="error-msg" id="error-username"></span>
      </div>
      <div class="form-group">
        <label for="password">Contraseña <span class="required">*</span></label>
        <input type="password" id="password" name="password" placeholder="Mínimo 6 caracteres" />
        <span class="error-msg" id="error-password"></span>
      </div>
      <div class="form-group">
        <label for="confirm">Confirmar contraseña <span class="required">*</span></label>
        <input type="password" id="confirm" name="confirm" placeholder="Repetí tu contraseña" />
        <span class="error-msg" id="error-confirm"></span>
      </div>
      <button type="submit" class="btn-submit">Registrarse</button>
    </form>

    <p class="auth-link">¿Ya tenés cuenta? <a href="index.php?action=login">Iniciá sesión</a></p>
  </div>
</section>

<?php require_once BASE_PATH . '/views/layout/footer.php'; ?>