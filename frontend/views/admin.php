<?php
session_start();

if (isset($_SESSION['usuario'])) {
  header("Location: menu.php");
  exit;
}

require_once '../../backend/config/db.php';

$db = getDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $usuario = $_POST['usuario'];
  $password = $_POST['password'];

  // Buscar usuario en BD
  $stmt = $db->prepare("SELECT * FROM EMPLEADO WHERE usuario = :usuario LIMIT 1");
  $stmt->bindParam(':usuario', $usuario);
  $stmt->execute();

  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // Validación
if ($user && password_verify($password, $user['contrasena']) && ($user['rol']  === 'admin')) {

    $_SESSION['usuario'] = $user['usuario'];
    $_SESSION['id_empleado'] = $user['id_empleado'];
    $_SESSION['rol'] = $user['rol'];

    header("Location: menu.php");
    exit;

  } else {
    $error = "Credenciales incorrectas";
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Login Admin - App Turnos</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
  <div class="container">

<main>
  <div class="card center">
    <h2>Login Admin</h2>
    <form method="POST">
      <input type="text" name="usuario" placeholder="Usuario">
      <input type="password" name="password" placeholder="Contraseña">
      <button class="primary">Entrar</button>
    </form>
    <?php if (isset($error))
      echo "<p>$error</p>"; ?>
  </div>
</main>

<?php include '../components/footer.php'; ?>
