
<!-- ================= Menu ================= -->
<?php include '../components/header.php'; ?>
<?php include '../components/layout.php'; ?>

<!-- ================= solicitudes.php ================= -->

<main>
  <div class="card">
    <h2>Solicitudes</h2>
    <section class="request-section">
      <h3>Vacaciones</h3>
      <div class="form-group">
        <label for="vacaciones_inicio">Inicio</label>
        <input type="date" id="vacaciones_inicio" name="vacaciones_inicio">
      </div>
      <div class="form-group">
        <label for="vacaciones_fin">Fin</label>
        <input type="date" id="vacaciones_fin" name="vacaciones_fin">
      </div>
      <div class="form-group">
        <label for="observaciones_vacaciones">Observaciones</label>
        <textarea id="observaciones_vacaciones" name="observaciones_vacaciones" placeholder="Puedes explicar el motivo o los días preferidos..."></textarea>
      </div>
      <button class="primary">Solicitar vacaciones</button>
    </section>
  </div>
</main>

<?php include '../components/footer.php'; ?>