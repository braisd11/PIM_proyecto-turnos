// document.addEventListener("DOMContentLoaded", function () {
//   updateCalendar(DayPilot.Date.today());
// });

document.addEventListener("DOMContentLoaded", () => {
  window.dp = new DayPilot.Scheduler("scheduler");
  
  
  dp.scale = "Day";
  dp.cellWidthSpec = 40;
  dp.cellMinWidth = 25;
  dp.rowHeaderWidth = 80;
  dp.progressiveRowRendering = true;
  dp.locale = "es-es";

  dp.timeHeaders = [
    { groupBy: "Month" },
    { groupBy: "Week" },
    { groupBy: "Day", format: "d" },
  ];

  dp.resources = [
    { name: "Juan", id: "1" },
    { name: "Carla", id: "2" },
    { name: "Luis", id: "3" },
  ];

  dp.startDate = formatDate(
    currentDate.getFullYear(),
    currentDate.getMonth() + 1,
  );
  dp.days = getDaysInMonth(
    currentDate.getFullYear(),
    currentDate.getMonth() + 1,
  );

  //=============================================== CONTEXT MENU ===============================================
  //#region CONTEXT MENU

  dp.contextMenu = new DayPilot.Menu({
    items: [
      {
        text: "Eliminar",
        onClick: (args) => dp.events.remove(args.source),
      },
      { text: "-" },
      {
        text: "Cambiar color",
        onClick: (args) => {
          args.source.data.barColor = "#cc0000";
          args.source.data.barBackColor = "#e06666";
          dp.events.update(args.source);
        },
      },
      { text: "-" },
      {
        text: "Más opciones",
        items: [
          {
            text: "Eliminar",
            onClick: (args) => dp.events.remove(args.source),
          },
        ],
      },
      {
        text: "Deshabilitado",
        onClick: () => alert("disabled"),
        disabled: true,
      },
    ],
  });

  // #endregion

  //=============================================== EVENTOS ===============================================
  //#region EVENTOS

  dp.onTimeRangeSelected = async (args) => {
    const modal = await DayPilot.Modal.prompt("Nombre del turno:", "Turno");
    dp.clearSelection();
    if (modal.canceled) return;
    dp.events.add({
      start: args.start,
      end: args.end,
      id: DayPilot.guid(),
      resource: args.resource,
      text: modal.result || "Turno",
    });
  };

  dp.onBeforeTimeHeaderRender = (args) => {
    if (args.header.level === 1) {
      args.header.html = "Week " + args.header.text;
    }
    if (args.header.level === 2) {
      const date = args.header.start;
      if (date.getDayOfWeek() === 0 || date.getDayOfWeek() === 6) {
        args.header.areas = [
          {
            left: 0,
            top: 0,
            right: 0,
            height: 4,
            backColor: "#68c334",
          },
        ];
      }
    }
  };

  //#endregion EVENTOS

  dp.init();

  // --- Navigator ---
  const nav = new DayPilot.Navigator("nav", {
    showMonths: 3,
    selectMode: "month",
    locale: "es-es",
    onTimeRangeSelected: (args) => {
      currentDate = args.start;
      updateCalendar(currentDate);
    },
  });
  nav.init();
  nav.select(currentDate);

  // --- Función para actualizar Scheduler ---
  window.updateCalendar = function (date) {
    // Convertir si es Date normal
    if (!(date instanceof DayPilot.Date)) {
      date = new DayPilot.Date(date);
    }

    dp.startDate = date.firstDayOfMonth();
    dp.days = date.daysInMonth();

    dp.update({
      startDate: date.firstDayOfMonth(),
      days: date.daysInMonth(),
      scrollTo: date,
    });
    nav.select(date);
  };

  // --- CONTROL ZOOM CELDAS ---
  const cellWidthInput = document.getElementById("cellWidth");
  const cellWidthLabel = document.getElementById("cellWidthLabel");

  cellWidthInput.addEventListener("input", () => {
    const cellWidth = parseInt(cellWidthInput.value);

    // guardar posición actual
    const viewport = dp.getViewport();
    const start = viewport.start;

    dp.update({
      cellWidth: cellWidth,
      scrollTo: start,
    });

    cellWidthLabel.textContent = cellWidth;
  });
});
