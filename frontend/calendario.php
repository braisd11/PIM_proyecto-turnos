<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Calendario</title>

  <link rel="stylesheet" href="./css/styles.css">
  <script src="./js-daypilot/daypilot-all.min.js"></script>
</head>

<body>

  <div class="container">

    <?php include 'layout.php'; ?>

    <main>
      <div class="card">
        <h2>Calendario de turnos</h2>
        <div class="toolbar">
          <button id="previous" class="nav-btn">⬅️</button>
          <button id="today" class="nav-btn today-btn">Hoy</button>
          <button id="next" class="nav-btn">➡️</button>

          <!-- NUEVO -->
          <div class="zoom-control">
            <span>Zoom:</span>
            <input type="range" id="cellWidth" min="20" max="100" value="40" />
            <span id="cellWidthLabel">40</span>
          </div>
        </div>
        <div class="calendar-container">
          <!-- Scheduler -->
          <div id="scheduler"></div>
          <!-- Navigator -->
          <div id="nav"></div>
        </div>

        <script src="js/dateUtils.js"></script>
        <script src="js/calendar.js"></script>
        <script src="js/main.js"></script>
        <script src="js/navigation.js"></script>

      </div>
    </main>

  </div>

  <!-- <script>
    const dp = new DayPilot.Scheduler("scheduler");

    dp.startDate = DayPilot.Date.today();
    dp.days = 30;
    dp.scale = "Day";

    dp.cellWidth = 120;      // ancho de días
    dp.rowMinHeight = 60;    // alto de empleados

    dp.treeEnabled = false;


    // EMPLEADOS (filas)
    dp.resources = [
      { name: "Empleado 1", id: "e1" },
      { name: "Empleado 2", id: "e2" },
      { name: "Empleado 3", id: "e3" }
    ];

    // EVENTOS (turnos)
    const eventos = [];

    for (let i = 0; i < 30; i++) {

      let dia = DayPilot.Date.today().addDays(i);

      eventos.push(
        {
          id: i + "-m",
          text: "Mañana",
          start: dia,
          end: dia.addDays(1),
          resource: "e1",
          backColor: "#3498db"
        },
        {
          id: i + "-t",
          text: "Tarde",
          start: dia,
          end: dia.addDays(1),
          resource: "e2",
          backColor: "#2ecc71"
        },
        {
          id: i + "-n",
          text: "Noche",
          start: dia,
          end: dia.addDays(1),
          resource: "e3",
          backColor: "#9b59b6"
        }
      );
    }

    dp.events.list = eventos;

    dp.init();
  </script> -->

</body>

</html>