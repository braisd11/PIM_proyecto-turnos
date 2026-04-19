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

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const btn = document.querySelector(".dropdown-btn");
    const menu = document.querySelector(".dropdown-links");

    btn.addEventListener("click", function () {
      menu.classList.toggle("active");
    });
  });
</script>