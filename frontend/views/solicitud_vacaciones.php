<!-- ================= Menu ================= -->
<?php include '../components/header.php'; ?>
<?php include '../components/layout.php'; ?>

<?php
require_once '../../backend/config/db.php';

$db = getDB();

$idEmpleado = $_SESSION['id_empleado'];

$mensaje = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $fechaInicio = trim($_POST['vacaciones_inicio'] ?? '');
  $fechaFin = trim($_POST['vacaciones_fin'] ?? '');
  $observaciones = trim($_POST['observaciones_vacaciones'] ?? '');

  if ($fechaInicio === '' || $fechaFin === '') {
    $error = 'Debes indicar la fecha de inicio y la fecha de fin.';
  } elseif ($fechaInicio > $fechaFin) {
    $error = 'La fecha de inicio no puede ser posterior a la fecha de fin.';
  } else {
    $stmt = $db->prepare("
      INSERT INTO SOLICITUD (
        tipo,
        motivo,
        estado,
        fecha_solicitud,
        fecha_inicio,
        fecha_fin,
        id_empleado
      )
      VALUES (
        :tipo,
        :motivo,
        :estado,
        :fecha_solicitud,
        :fecha_inicio,
        :fecha_fin,
        :id_empleado
      )
    ");

    $stmt->execute([
      ':tipo' => 'vacaciones',
      ':motivo' => $observaciones,
      ':estado' => 'pendiente',
      ':fecha_solicitud' => date('Y-m-d'),
      ':fecha_inicio' => $fechaInicio,
      ':fecha_fin' => $fechaFin,
      ':id_empleado' => $idEmpleado
    ]);

    $mensaje = 'Solicitud de vacaciones enviada correctamente.';
  }
}
?>

<!-- ================= solicitudes.php ================= -->

<main>
  <div class="card">
    <h2>Solicitudes</h2>

    <?php if ($mensaje): ?>
      <p class="message"><?php echo htmlspecialchars($mensaje); ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
      <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <section class="request-section">
      <h3>Vacaciones</h3>

      <form method="POST">
        <div class="form-group">
          <label for="vacaciones_inicio">Inicio</label>
          <input type="date" id="vacaciones_inicio" name="vacaciones_inicio">
        </div>

        <div class="form-group">
          <label for="vacaciones_fin">Fin</label>
          <input type="date" id="vacaciones_fin" name="vacaciones_fin">
        </div>

        <div class="form-group">
          <label for="observaciones_vacaciones">Observaciones</label>
          <textarea id="observaciones_vacaciones" name="observaciones_vacaciones" placeholder="Puedes explicar el motivo o los días preferidos..."></textarea>
        </div>

        <button class="primary" type="submit">Solicitar vacaciones</button>
      </form>
    </section>
  </div>
</main>

<?php include '../components/footer.php'; ?>
