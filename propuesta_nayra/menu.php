<!-- ================= Menu ================= -->
<?php include 'layout.php'; ?>

<main>
  <div class="dashboard">

    <!-- Bienvenida -->
    <div class="card bienvenida">
      <h2>Bienvenido</h2>
      <p>Usuario: <?php echo $_SESSION['usuario']; ?></p>
      <p>Rol: Empleado</p>
    </div>

    <!-- Perfil -->
    <div class="card perfil">
      <h2>Datos personales</h2>
      <p>Nombre: Usuario Demo</p>
      <p>Email: usuario@email.com</p>
      <p>DNI: 12345678A</p>
    </div>

  </div>
</main>