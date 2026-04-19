<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>App Turnos</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>

    <div class="container">
