<?php include 'layout.php'; ?>

<?php
$nombre = $_SESSION['perfil_nombre'] ?? 'Empleado Demo';
$email = $_SESSION['perfil_email'] ?? 'empleado@empresa.com';
$telefono = $_SESSION['perfil_telefono'] ?? '600123456';
$foto = $_SESSION['perfil_foto'] ?? '';
$mensaje = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = trim($_POST['nombre'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $telefono = trim($_POST['telefono'] ?? '');

  if ($nombre === '' || $email === '' || $telefono === '') {
    $error = 'Por favor completa todos los campos.';
  } else {
    $_SESSION['perfil_nombre'] = $nombre;
    $_SESSION['perfil_email'] = $email;
    $_SESSION['perfil_telefono'] = $telefono;
    $mensaje = 'Datos actualizados correctamente.';
  }

  if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $validTypes = ['jpg', 'jpeg', 'png', 'gif'];
    $info = pathinfo($_FILES['foto']['name']);
    $ext = strtolower($info['extension'] ?? '');

    if (!in_array($ext, $validTypes, true)) {
      $error = 'Solo se permiten imágenes JPG, PNG o GIF.';
    } else {
      $uploadDir = __DIR__ . '/uploads/';
      $newName = 'perfil_' . uniqid() . '.' . $ext;
      $uploadPath = $uploadDir . $newName;

      if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadPath)) {
        $_SESSION['perfil_foto'] = $newName;
        $foto = $newName;
        if ($mensaje === '') {
          $mensaje = 'Foto de perfil subida correctamente.';
        }
      } else {
        $error = 'Error al subir la imagen. Intenta de nuevo.';
      }
    }
  }
}

$fotoUrl = $foto ? 'uploads/' . htmlspecialchars($foto) : '';
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
      </div>
    </div>
  </div>
</main>

</div>
</body>
</html>
