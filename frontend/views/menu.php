<?php include '../components/header.php'; ?>
<?php include '../components/layout.php'; ?>

<?php
require_once '../../backend/config/db.php';

$db = getDB();

$idEmpleado = $_SESSION['id_empleado'];

$stmt = $db->prepare("
  SELECT nombre, email, telefono, usuario, rol
  FROM EMPLEADO
  WHERE id_empleado = :id_empleado
");

$stmt->execute([
  ':id_empleado' => $idEmpleado
]);

$empleado = $stmt->fetch(PDO::FETCH_ASSOC);

$nombre = $empleado['nombre'] ?? '';
$email = $empleado['email'] ?? '';
$telefono = $empleado['telefono'] ?? '';
$usuario = $empleado['usuario'] ?? ($_SESSION['usuario'] ?? '');
$rol = $empleado['rol'] ?? ($_SESSION['rol'] ?? '');
$rolTexto = $rol === 'admin' ? 'Administrador' : 'Empleado';
$nombreAvatar = $nombre !== '' ? $nombre : $usuario;
$inicial = strtoupper(substr(trim($nombreAvatar), 0, 1));
?>

<main>
  <div class="dashboard">

    <div class="card bienvenida card-split">
      <div class="welcome-copy">
        <span class="badge"><?php echo htmlspecialchars($rolTexto); ?></span>
        <h1>Bienvenido, <?php echo htmlspecialchars($nombre); ?></h1>
        <p class="welcome-text">Aquí puedes revisar tu información personal y acceder rápidamente a tu perfil.</p>

        <div class="welcome-meta">
          <div>
            <strong>Usuario</strong>
            <p><?php echo htmlspecialchars($usuario); ?></p>
          </div>

          <div>
            <strong>Rol</strong>
            <p><?php echo htmlspecialchars($rolTexto); ?></p>
          </div>
        </div>
      </div>

      <div class="welcome-avatar">
        <span class="avatar-placeholder"><?php echo htmlspecialchars($inicial); ?></span>
      </div>
    </div>

    <div class="card perfil card-split profile-summary-card">
      <div>
        <h2>Datos personales</h2>

        <div class="profile-summary-item">
          <span>Nombre</span>
          <strong><?php echo htmlspecialchars($nombre); ?></strong>
        </div>

        <div class="profile-summary-item">
          <span>Email</span>
          <strong><?php echo htmlspecialchars($email); ?></strong>
        </div>

        <div class="profile-summary-item">
          <span>Teléfono</span>
          <strong><?php echo htmlspecialchars($telefono); ?></strong>
        </div>
      </div>

      <a href="perfil.php" class="primary">Editar perfil</a>
    </div>

  </div>
</main>

<?php include '../components/footer.php'; ?>
