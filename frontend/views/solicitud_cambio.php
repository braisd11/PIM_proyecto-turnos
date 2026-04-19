<!-- ================= Menu ================= -->
<?php include '../components/header.php'; ?>
<?php include '../components/layout.php'; ?>

<!-- ================= solicitudes.php ================= -->

<main>
  <div class="card">
    <h2>Solicitudes</h2>

    <section class="request-section">
      <h3>Cambio de turno</h3>
      <div class="form-group">
        <label for="turno_dia_actual">Día del turno actual</label>
        <input type="date" id="turno_dia_actual" name="turno_dia_actual">
      </div>
      <div class="form-group">
        <label for="turno_actual">Turno actual</label>
        <select id="turno_actual" name="turno_actual">
          <option value="mañana">Mañana</option>
          <option value="tarde">Tarde</option>
          <option value="noche">Noche</option>
        </select>
      </div>
      <div class="form-group">
        <label for="turno_dia_nuevo">Nuevo día deseado</label>
        <input type="date" id="turno_dia_nuevo" name="turno_dia_nuevo">
      </div>
      <div class="form-group">
        <label for="turno_nuevo">Turno deseado</label>
        <select id="turno_nuevo" name="turno_nuevo">
          <option value="mañana">Mañana</option>
          <option value="tarde">Tarde</option>
          <option value="noche">Noche</option>
        </select>
      </div>
      <div class="form-group">
        <label for="observaciones_turno">Observaciones</label>
        <textarea id="observaciones_turno" name="observaciones_turno"
          placeholder="Explica aquí tu solicitud..."></textarea>
      </div>
      <button class="primary">Enviar cambio de turno</button>
    </section>
  </div>
</main>

<?php include '../components/footer.php'; ?>