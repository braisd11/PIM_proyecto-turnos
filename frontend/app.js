const dp = new DayPilot.Scheduler("scheduler");

// Conectar con el backend
// dp.events.load("/backend/get_turnos.php");

dp.startDate = "2026-04-01";
dp.days = 7;
dp.scale = "Day";

// Recursos (empleados)
dp.resources = [
  { name: "Juan", id: "1" },
  { name: "Ana", id: "2" },
  { name: "Luis", id: "3" },
  { name: "Luis", id: "4" },
  { name: "Luis", id: "5" },
  { name: "Luis", id: "6" },
  { name: "Luis", id: "7" },
  { name: "Luis", id: "8" },
  { name: "Luis", id: "9" },
];

// Eventos (turnos)
dp.events.list = [
  {
    id: 1,
    text: "Mañana",
    start: "2026-04-01",
    end: "2026-04-02",
    resource: "1",
    backColor: "green",
  },
  {
    id: 2,
    text: "Noche",
    start: "2026-04-02",
    end: "2026-04-03",
    resource: "2",
    backColor: "blue",
  },
  {
    id: 3,
    text: "Noche",
    start: "2026-04-02",
    end: "2026-04-03",
    resource: "8",
    backColor: "blue",
  },
];

dp.onTimeRangeSelected = function (args) {
  const nombre = prompt("Nombre del turno:");

  if (!nombre) return;

  dp.events.add({
    id: DayPilot.guid(),
    text: nombre,
    start: args.start,
    end: args.end,
    resource: args.resource,
  });

  dp.clearSelection();
};

dp.onEventResized = function (args) {
  console.log("Redimensionado:", args.e.id());
};

dp.onEventMoved = function (args) {
  console.log("Movido:", args.e.id());
};




dp.init();
