// Variable global compartida
let currentDate = new Date();

function getDaysInMonth(year, month) {
  return new Date(year, month, 0).getDate();
}

function formatDate(year, month, day = 1) {
  return `${year}-${String(month).padStart(2, "0")}-${String(day).padStart(2, "0")}`;
}

function getMonthName(date) {
  return date.toLocaleDateString("es-ES", {
    month: "long",
    year: "numeric",
  });
}
