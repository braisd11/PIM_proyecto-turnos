<!-- ================= login.php ================= -->
<?php
session_start();

$usuario_valido = "admin";
$password_valido = "1234";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if($_POST['usuario'] == $usuario_valido && $_POST['password'] == $password_valido){
    $_SESSION['usuario'] = $usuario_valido;
    header("Location: menu.php");
  } else {
    $error = "Credenciales incorrectas";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="/pim_prueba/css/styles.css">
</head>
<body>
<div class="card center">
  <h2>Login</h2>
  <form method="POST">
    <input type="text" name="usuario" placeholder="Usuario">
    <input type="password" name="password" placeholder="Contraseña">
    <button class="primary">Entrar</button>
  </form>
  <?php if(isset($error)) echo "<p>$error</p>"; ?>
</div>
</body>
</html>