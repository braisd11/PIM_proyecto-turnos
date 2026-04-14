<?php
session_start();
if(!isset($_SESSION['usuario'])){
  header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>App Turnos</title>
  <link rel="stylesheet" href="/PIM_proyecto-turnos/propuesta_nayra/css/styles.css">
</head>
<body>

<div class="container">
  <aside>
    <h3>Menú</h3>
    <ul>
      <li><a href="menu.php">Inicio</a></li>
      <li><a href="calendario.php">Calendario</a></li>
      <li><a href="solicitudes.php">Solicitudes</a></li>
      <li><a href="perfil.php">Mi perfil</a></li>
    </ul>
  </aside>