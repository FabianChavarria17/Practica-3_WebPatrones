<?php require_once BASE_PATH . '/views/layout/header.php'; ?>

<section class="form-section">
  <h2 class="section-title">Reservar Mesa</h2>
  <p class="section-subtitle">Completá el formulario y confirmamos tu reservación.</p>

  <?php if (!empty($error)): ?>
    <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
  <?php if (!empty($success)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
  <?php endif; ?>

  <form method="POST" action="/src/main/index.php?action=form" id="reservationForm" novalidate>
    <div class="form-group">
      <label for="nombre">Nombre completo <span class="required">*</span></label>
      <input type="text" id="nombre" name="nombre" placeholder="Ej: Juan Pérez" />
      <span class="error-msg" id="error-nombre"></span>
    </div>

    <div class="form-group">
      <label for="contacto">Correo o teléfono <span class="required">*</span></label>
      <input type="text" id="contacto" name="contacto" placeholder="Ej: juan@correo.com o 88887777" />
      <span class="error-msg" id="error-contacto"></span>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="fecha">Fecha de reservación <span class="required">*</span></label>
        <input type="date" id="fecha" name="fecha" />
        <span class="error-msg" id="error-fecha"></span>
      </div>
      <div class="form-group">
        <label for="personas">Número de personas <span class="required">*</span></label>
        <input type="number" id="personas" name="personas" min="1" placeholder="Ej: 4" />
        <span class="error-msg" id="error-personas"></span>
      </div>
    </div>

    <div class="form-group">
      <label for="comentarios">Comentarios adicionales</label>
      <textarea id="comentarios" name="comentarios" rows="4" placeholder="Alergias, ocasión especial..."></textarea>
    </div>

    <button type="submit" class="btn-submit">Confirmar Reservación</button>
  </form>
</section>

<?php require_once BASE_PATH . '/views/layout/footer.php'; ?>