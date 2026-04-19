<?php include '../components/header.php'; ?>
<?php include '../components/layout.php'; ?>

<?php
require_once '../../backend/config/db.php';

$db = getDB();

$idEmpleado = $_SESSION['id_empleado'];

$stmt = $db->prepare("
  SELECT
    id_solicitud,
    tipo,
    motivo,
    estado,
    fecha_solicitud,
    fecha_inicio,
    fecha_fin,
    fecha_turno_actual,
    turno_actual,
    fecha_turno_nuevo,
    turno_nuevo,
    respuesta_admin
  FROM SOLICITUD
  WHERE id_empleado = :id_empleado
  ORDER BY fecha_solicitud DESC, id_solicitud DESC
");

$stmt->execute([
  ':id_empleado' => $idEmpleado
]);

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
    <h2>Mis solicitudes</h2>

    <?php if (count($solicitudes) === 0): ?>
      <p>Todavía no has enviado ninguna solicitud.</p>
    <?php else: ?>
      <table class="requests-table">
        <thead>
          <tr>
            <th>Tipo</th>
            <th>Estado</th>
            <th>Fecha solicitud</th>
            <th>Fechas</th>
            <th>Turno</th>
            <th>Motivo</th>
            <th>Respuesta admin</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($solicitudes as $solicitud): ?>
            <tr>
              <td><?php echo htmlspecialchars(mostrarTipoSolicitud($solicitud['tipo'])); ?></td>

              <td>
                <span class="status status-<?php echo htmlspecialchars($solicitud['estado']); ?>">
                  <?php echo htmlspecialchars(mostrarEstadoSolicitud($solicitud['estado'])); ?>
                </span>
              </td>

              <td><?php echo htmlspecialchars($solicitud['fecha_solicitud']); ?></td>

              <td>
                <?php if ($solicitud['tipo'] === 'vacaciones'): ?>
                  <?php echo htmlspecialchars($solicitud['fecha_inicio'] ?? ''); ?>
                  -
                  <?php echo htmlspecialchars($solicitud['fecha_fin'] ?? ''); ?>
                <?php else: ?>
                  -
                <?php endif; ?>
              </td>

              <td>
                <?php if ($solicitud['tipo'] === 'cambio_turno'): ?>
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
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
</main>

<?php include '../components/footer.php'; ?>
