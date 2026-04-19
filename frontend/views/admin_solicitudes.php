<?php include '../components/header.php'; ?>
<?php include '../components/layout.php'; ?>

<?php
require_once '../../backend/config/db.php';

$db = getDB();

if ($_SESSION['rol'] !== 'admin') {
  header("Location: menu.php");
  exit;
}

$mensaje = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idSolicitud = $_POST['id_solicitud'] ?? '';
  $accion = $_POST['accion'] ?? '';
  $respuestaAdmin = trim($_POST['respuesta_admin'] ?? '');

  if ($idSolicitud === '' || !in_array($accion, ['aprobada', 'rechazada'], true)) {
    $error = 'Acción no válida.';
  } else {
    $stmt = $db->prepare("
      UPDATE SOLICITUD
      SET estado = :estado,
          respuesta_admin = :respuesta_admin
      WHERE id_solicitud = :id_solicitud
    ");

    $stmt->execute([
      ':estado' => $accion,
      ':respuesta_admin' => $respuestaAdmin,
      ':id_solicitud' => $idSolicitud
    ]);

    $mensaje = 'Solicitud actualizada correctamente.';
  }
}

$stmt = $db->prepare("
  SELECT
    s.id_solicitud,
    s.tipo,
    s.motivo,
    s.estado,
    s.fecha_solicitud,
    s.fecha_inicio,
    s.fecha_fin,
    s.fecha_turno_actual,
    s.turno_actual,
    s.fecha_turno_nuevo,
    s.turno_nuevo,
    s.respuesta_admin,
    e.nombre,
    e.usuario,
    e.email
  FROM SOLICITUD s
  INNER JOIN EMPLEADO e ON s.id_empleado = e.id_empleado
  ORDER BY
    CASE s.estado
      WHEN 'pendiente' THEN 1
      WHEN 'aprobada' THEN 2
      WHEN 'rechazada' THEN 3
      ELSE 4
    END,
    s.fecha_solicitud DESC,
    s.id_solicitud DESC
");

$stmt->execute();

$solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);

function mostrarTipoSolicitud($tipo)
{
  $tipos = [
    'vacaciones' => 'Vacaciones',
    'cambio_turno' => 'Cambio de turno'
  ];

  return $tipos[$tipo] ?? $tipo;
}

function mostrarEstadoSolicitud($estado)
{
  $estados = [
    'pendiente' => 'Pendiente',
    'aprobada' => 'Aprobada',
    'rechazada' => 'Rechazada'
  ];

  return $estados[$estado] ?? $estado;
}
?>

<main>
  <div class="card">
    <h2>Solicitudes de empleados</h2>

    <?php if ($mensaje): ?>
      <p class="message"><?php echo htmlspecialchars($mensaje); ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
      <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <?php if (count($solicitudes) === 0): ?>
      <p>No hay solicitudes registradas.</p>
    <?php else: ?>
      <table class="requests-table admin-requests-table">
        <thead>
          <tr>
            <th>Empleado</th>
            <th>Tipo</th>
            <th>Estado</th>
            <th>Fecha solicitud</th>
            <th>Detalle</th>
            <th>Motivo</th>
            <th>Respuesta admin</th>
            <th>Acciones</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($solicitudes as $solicitud): ?>
            <tr>
              <td>
                <strong><?php echo htmlspecialchars($solicitud['nombre']); ?></strong>
                <br>
                <span><?php echo htmlspecialchars($solicitud['usuario']); ?></span>
              </td>

              <td><?php echo htmlspecialchars(mostrarTipoSolicitud($solicitud['tipo'])); ?></td>

              <td>
                <span class="status status-<?php echo htmlspecialchars($solicitud['estado']); ?>">
                  <?php echo htmlspecialchars(mostrarEstadoSolicitud($solicitud['estado'])); ?>
                </span>
              </td>

              <td><?php echo htmlspecialchars($solicitud['fecha_solicitud']); ?></td>

              <td>
                <?php if ($solicitud['tipo'] === 'vacaciones'): ?>
                  <div class="request-detail">
                    <div>
                      <span>Inicio</span>
                      <strong><?php echo htmlspecialchars($solicitud['fecha_inicio'] ?? ''); ?></strong>
                    </div>
                    <div>
                      <span>Fin</span>
                      <strong><?php echo htmlspecialchars($solicitud['fecha_fin'] ?? ''); ?></strong>
                    </div>
                  </div>
                <?php elseif ($solicitud['tipo'] === 'cambio_turno'): ?>
                  <div class="shift-change">
                    <div class="shift-change-row">
                      <span>Actual</span>
                      <strong><?php echo htmlspecialchars($solicitud['fecha_turno_actual'] ?? ''); ?></strong>
                      <em><?php echo htmlspecialchars($solicitud['turno_actual'] ?? ''); ?></em>
                    </div>
                    <div class="shift-change-row">
                      <span>Nuevo</span>
                      <strong><?php echo htmlspecialchars($solicitud['fecha_turno_nuevo'] ?? ''); ?></strong>
                      <em><?php echo htmlspecialchars($solicitud['turno_nuevo'] ?? ''); ?></em>
                    </div>
                  </div>
                <?php else: ?>
                  -
                <?php endif; ?>
              </td>

              <td><?php echo nl2br(htmlspecialchars($solicitud['motivo'] ?? '')); ?></td>

              <td>
                <?php echo nl2br(htmlspecialchars($solicitud['respuesta_admin'] ?? '-')); ?>
              </td>

              <td>
                <?php if ($solicitud['estado'] === 'pendiente'): ?>
                  <form method="POST" class="admin-action-form">
                    <input type="hidden" name="id_solicitud" value="<?php echo htmlspecialchars($solicitud['id_solicitud']); ?>">

                    <textarea name="respuesta_admin" placeholder="Respuesta opcional"></textarea>

                    <div class="admin-action-buttons">
                      <button class="primary approve-btn" type="submit" name="accion" value="aprobada">Aprobar</button>
                      <button class="primary reject-btn" type="submit" name="accion" value="rechazada">Rechazar</button>
                    </div>
                  </form>
                <?php else: ?>
                  -
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
</main>

<?php include '../components/footer.php'; ?>
