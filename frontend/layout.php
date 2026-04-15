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
  <link rel="stylesheet" href="./css/styles.css">
</head>
<body>

<div class="container">
  <aside>
    <h3>Menú</h3>
    <ul>
        <li><a href="menu.php">Inicio</a></li>
        <li><a href="calendario.php">Calendario</a></li>

        <li class="dropdown">
          <button class="dropdown-btn" type="button">Solicitudes ▾</button>
          <div class="dropdown-links">
            <a href="solicitud_cambio.php">Solicitud de cambio</a>
            <a href="solicitud_vacaciones.php">Solicitud de vacaciones</a>
            <a href="mis_solicitudes.php">Mis solicitudes</a>
          </div>
        </li>

        <li><a href="perfil.php">Mi perfil</a></li>
      </ul>


  </aside>