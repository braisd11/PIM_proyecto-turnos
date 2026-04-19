<!-- ================= Menu ================= -->
<?php include '../components/header.php'; ?>
<?php include '../components/layout.php'; ?>

<?php
require_once '../../backend/config/db.php';

$db = getDB();

$idEmpleado = $_SESSION['id_empleado'];

$mensaje = '';
$error = '';

$turnosPermitidos = ['mañana', 'tarde', 'noche'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $fechaTurnoActual = trim($_POST['turno_dia_actual'] ?? '');
  $turnoActual = trim($_POST['turno_actual'] ?? '');
  $fechaTurnoNuevo = trim($_POST['turno_dia_nuevo'] ?? '');
  $turnoNuevo = trim($_POST['turno_nuevo'] ?? '');
  $observaciones = trim($_POST['observaciones_turno'] ?? '');

  if ($fechaTurnoActual === '' || $fechaTurnoNuevo === '') {
    $error = 'Debes indicar el día actual y el nuevo día deseado.';
  } elseif (!in_array($turnoActual, $turnosPermitidos, true) || !in_array($turnoNuevo, $turnosPermitidos, true)) {
    $error = 'El turno seleccionado no es válido.';
  } elseif ($fechaTurnoActual === $fechaTurnoNuevo && $turnoActual === $turnoNuevo) {
    $error = 'El nuevo turno no puede ser igual al turno actual.';
  } else {
    $stmt = $db->prepare("
      INSERT INTO SOLICITUD (
        tipo,
        motivo,
        estado,
        fecha_solicitud,
        fecha_turno_actual,
        turno_actual,
        fecha_turno_nuevo,
        turno_nuevo,
        id_empleado
      )
      VALUES (
        :tipo,
        :motivo,
        :estado,
        :fecha_solicitud,
        :fecha_turno_actual,
        :turno_actual,
        :fecha_turno_nuevo,
        :turno_nuevo,
        :id_empleado
      )
    ");

    $stmt->execute([
      ':tipo' => 'cambio_turno',
      ':motivo' => $observaciones,
      ':estado' => 'pendiente',
      ':fecha_solicitud' => date('Y-m-d'),
      ':fecha_turno_actual' => $fechaTurnoActual,
      ':turno_actual' => $turnoActual,
      ':fecha_turno_nuevo' => $fechaTurnoNuevo,
      ':turno_nuevo' => $turnoNuevo,
      ':id_empleado' => $idEmpleado
    ]);

    $mensaje = 'Solicitud de cambio de turno enviada correctamente.';
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
      <h3>Cambio de turno</h3>

      <form method="POST">
        <div class="form-group">
          <label for="turno_dia_actual">Día del turno actual</label>
          <input type="date" id="turno_dia_actual" name="turno_dia_actual">
        </div>

        <div class="form-group">
          <label for="turno_actual">Turno actual</label>
          <select id="turno_actual" name="turno_actual">
            <option value="mañana">Mañana</option>
            <option value="tarde">Tarde</option>
            <option value="noche">Noche</option>
          </select>
        </div>

        <div class="form-group">
          <label for="turno_dia_nuevo">Nuevo día deseado</label>
          <input type="date" id="turno_dia_nuevo" name="turno_dia_nuevo">
        </div>

        <div class="form-group">
          <label for="turno_nuevo">Turno deseado</label>
          <select id="turno_nuevo" name="turno_nuevo">
            <option value="mañana">Mañana</option>
            <option value="tarde">Tarde</option>
            <option value="noche">Noche</option>
          </select>
        </div>

        <div class="form-group">
          <label for="observaciones_turno">Observaciones</label>
          <textarea id="observaciones_turno" name="observaciones_turno" placeholder="Explica aquí tu solicitud..."></textarea>
        </div>

        <button class="primary" type="submit">Enviar cambio de turno</button>
      </form>
    </section>
  </div>
</main>

<?php include '../components/footer.php'; ?>
