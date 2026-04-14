<!-- ================= Menu ================= -->
<?php include 'layout.php'; ?>

<?php
$nombre = $_SESSION['perfil_nombre'] ?? 'Empleado Demo';
$email = $_SESSION['perfil_email'] ?? 'empleado@empresa.com';
$telefono = $_SESSION['perfil_telefono'] ?? '600 123 456';
$foto = $_SESSION['perfil_foto'] ?? '';
$fotoUrl = $foto ? 'uploads/' . htmlspecialchars($foto) : '';
$inicial = strtoupper(substr(trim($nombre), 0, 1));
?>

<main>
  <div class="dashboard">

    <!-- Bienvenida -->
    <div class="card bienvenida card-split">
      <div class="welcome-copy">
        <span class="badge">Empleado</span>
        <h1>Bienvenido, <?php echo htmlspecialchars($nombre); ?></h1>
        <p class="welcome-text">Aquí puedes revisar tu información personal y acceder rápidamente a tu perfil.</p>
        <div class="welcome-meta">
          <div>
            <strong>Usuario</strong>
            <p><?php echo htmlspecialchars($_SESSION['usuario']); ?></p>
          </div>
          <div>
            <strong>Rol</strong>
            <p>Empleado</p>
          </div>
        </div>
      </div>
      <div class="welcome-avatar">
        <?php if ($fotoUrl): ?>
          <img src="<?php echo $fotoUrl; ?>" alt="Foto de perfil">
        <?php else: ?>
          <span class="avatar-placeholder"><?php echo htmlspecialchars($inicial); ?></span>
        <?php endif; ?>
      </div>
    </div>

    <!-- Perfil -->
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