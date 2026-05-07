// document.addEventListener("DOMContentLoaded", function () {
//   updateCalendar(DayPilot.Date.today());
// });

document.addEventListener("DOMContentLoaded", () => {
  window.dp = new DayPilot.Scheduler("scheduler");
  
  
  dp.scale = "Day";
  dp.cellWidthSpec = 40;
  dp.cellMinWidth = 25;
  dp.rowMinHeight = 20;
  dp.rowHeaderWidth = 80;
  dp.progressiveRowRendering = true;
  dp.heightSpec = "Fixed";
  dp.locale = "es-es";

  dp.timeHeaders = [
    { groupBy: "Month" },
    { groupBy: "Week" },
    { groupBy: "Day", format: "d" },
  ];

  dp.resources = [
    // resources will be loaded from backend
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
        onClick: async (args) => {
          const id = args.source.id();
          const res = await fetch(API_BASE + '/turnos.php?id=' + encodeURIComponent(id), { method: 'DELETE' });
          const data = await res.json();
          if (data.ok) {
            dp.events.remove(args.source);
          } else {
            alert('Error al eliminar turno');
          }
        },
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
            onClick: async (args) => {
              const id = args.source.id();
              const res = await fetch(API_BASE + '/turnos.php?id=' + encodeURIComponent(id), { method: 'DELETE' });
              const data = await res.json();
              if (data.ok) {
                dp.events.remove(args.source);
              } else {
                alert('Error al eliminar turno');
              }
            },
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

    const payload = {
      start: args.start.toString(),
      end: args.end.toString(),
      resource: args.resource,
      text: modal.result || 'Turno'
    };

    const res = await fetch(API_BASE + '/turnos.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });
    const data = await res.json();
    if (data.id) {
      dp.events.add({
        start: args.start,
        end: args.end,
        id: data.id.toString(),
        resource: args.resource,
        text: payload.text
      });
    } else {
      alert('Error al crear turno');
    }
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

  // event moved (drag/drop)
  dp.onEventMoved = async (args) => {
    const e = args.e;
    const payload = {
      id: e.id(),
      start: e.start().toString(),
      end: e.end().toString(),
      resource: e.resource(),
      text: e.text()
    };

    await fetch(API_BASE + '/turnos.php', {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });
  };

  dp.onEventResized = async (args) => {
    const e = args.e;
    const payload = {
      id: e.id(),
      start: e.start().toString(),
      end: e.end().toString(),
      resource: e.resource(),
      text: e.text()
    };
    await fetch(API_BASE + '/turnos.php', {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });
  };

  // API base (ruta absoluta desde la raíz del proyecto)
  const API_BASE = '/PIM_proyecto-turnos/backend/api';

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
  
  async function loadData() {
    // cargar empleados
    try {
      let desiredHeight = null;
      const respEmp = await fetch(API_BASE + '/empleados.php');
      const empleados = await respEmp.json();
      dp.resources = empleados.map(e => ({ id: e.id.toString(), name: e.nombre }));

      // ajustar altura del scheduler según cantidad de empleados
      try {
        const rowHeight = dp.rowMinHeight || 60;
        const headerExtra = 180; // espacio para encabezados y margen
        const maxHeight = Math.round(window.innerHeight * 0.8);
        const desired = Math.min(maxHeight, Math.max(empleados.length * rowHeight + headerExtra, 400));
        const schedulerEl = document.getElementById('scheduler');
        if (schedulerEl) {
          schedulerEl.style.height = desired + 'px';
          const cont = document.querySelector('.calendar-container');
          if (cont) cont.style.height = desired + 'px';
          dp.height = desired;
          desiredHeight = desired;
        }
      } catch (e) {
        console.warn('No se pudo ajustar altura del scheduler', e);
      }

      // cargar turnos
      const respEv = await fetch(API_BASE + '/turnos.php');
      const evs = await respEv.json();
      dp.events.list = evs.map(e => ({ id: e.id.toString(), start: e.start, end: e.end, resource: e.resource.toString(), text: e.text }));

      dp.init();
      // aplicar altura definitivamente después de inicializar
      if (desiredHeight) dp.update({ height: desiredHeight, heightSpec: 'Fixed' });

      nav.init();
      nav.select(currentDate);
    } catch (err) {
      console.error('Error cargando datos:', err);
      dp.init();
      nav.init();
      nav.select(currentDate);
    }
  }

  loadData();

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
