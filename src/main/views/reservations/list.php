<?php require_once BASE_PATH . '/views/layout/header.php'; ?>

<section class="list-section">
  <h2 class="section-title">Mis Reservaciones</h2>
  <p class="section-subtitle">Estas son las reservas asociadas a tu cuenta.</p>

  <div class="list-actions">
    <a href="/src/main/index.php?action=form" class="btn-primary">+ Nueva Reservación</a>
  </div>

  <?php if (empty($reservations)): ?>
    <div class="empty-state">
      <p>No tenés reservaciones registradas aún.</p>
      <a href="/src/main/index.php?action=form" class="btn-primary">Hacer mi primera reserva</a>
    </div>
  <?php else: ?>
    <div class="table-wrapper">
      <table class="reservations-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Contacto</th>
            <th>Fecha</th>
            <th>Personas</th>
            <th>Comentarios</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($reservations as $i => $r): ?>
            <tr>
              <td><?= $i + 1 ?></td>
              <td><?= htmlspecialchars($r['name']) ?></td>
              <td><?= htmlspecialchars($r['contact']) ?></td>
              <td><?= date('d/m/Y', strtotime($r['reservation_date'])) ?></td>
              <td><?= $r['people'] ?></td>
              <td><?= htmlspecialchars($r['comments'] ?? '—') ?></td>
              <td>
                <a href="/src/main/index.php?action=delete&id=<?= $r['id'] ?>"
                   class="btn-delete"
                   onclick="return confirm('¿Eliminar esta reservación?')">Eliminar</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</section>

<?php require_once BASE_PATH . '/views/layout/footer.php'; ?>