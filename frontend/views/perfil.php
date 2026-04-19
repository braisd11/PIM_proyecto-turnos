<?php include '../components/header.php'; ?>
<?php include '../components/layout.php'; ?>

<?php
require_once '../../backend/config/db.php';

$db = getDB();

$idEmpleado = $_SESSION['id_empleado'];

$mensaje = '';
$error = '';

// Si el usuario pulsa "Guardar cambios", actualizamos la base de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = trim($_POST['nombre'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $telefono = trim($_POST['telefono'] ?? '');

  if ($nombre === '' || $email === '' || $telefono === '') {
    $error = 'Por favor completa todos los campos.';
  } else {
    $stmt = $db->prepare("
      UPDATE EMPLEADO
      SET nombre = :nombre,
          email = :email,
          telefono = :telefono
      WHERE id_empleado = :id_empleado
    ");

    $stmt->execute([
      ':nombre' => $nombre,
      ':email' => $email,
      ':telefono' => $telefono,
      ':id_empleado' => $idEmpleado
    ]);

    $mensaje = 'Datos actualizados correctamente.';
  }
}

// Después cargamos los datos actuales desde la base de datos
$stmt = $db->prepare("
  SELECT nombre, email, telefono
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
$fotoUrl = '';
?>


<main>
  <div class="card profile-card">
    <h2>Mi perfil</h2>

    <?php if ($mensaje): ?>
      <p class="message"><?php echo htmlspecialchars($mensaje); ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
      <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <div class="profile-row">
      <div class="profile-image-container">
        <?php if ($fotoUrl): ?>
          <img src="<?php echo $fotoUrl; ?>" alt="Foto de perfil" class="profile-image">
        <?php else: ?>
          <div class="profile-image placeholder">Sin foto</div>
        <?php endif; ?>
      </div>

      <div class="profile-info">
        <form method="POST" enctype="multipart/form-data">
          <label for="nombre">Nombre completo</label>
          <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">

          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">

          <label for="telefono">Teléfono</label>
          <input type="tel" id="telefono" name="telefono" value="<?php echo htmlspecialchars($telefono); ?>">

          <label for="foto">Foto de perfil</label>
          <input type="file" id="foto" name="foto" accept="image/*">

          <button class="primary" type="submit">Guardar cambios</button>
        </form>
        <br/><br/><hr/>
        <a href="mis_solicitudes.php">Mis solicitudes</a>
      </div>
    </div>
  </div>
</main>

<?php include '../components/footer.php'; ?>
