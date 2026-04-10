document.addEventListener("DOMContentLoaded", () => {
  const prevBtn = document.getElementById("previous");
  const todayBtn = document.getElementById("today");
  const nextBtn = document.getElementById("next");

  prevBtn.addEventListener("click", (e) => {
    e.preventDefault();

    const newDate = dp.startDate.addMonths(-1);
    updateCalendar(newDate);
  });

  todayBtn.addEventListener("click", (e) => {
    e.preventDefault();

    updateCalendar(DayPilot.Date.today());
  });

  nextBtn.addEventListener("click", (e) => {
    e.preventDefault();

    const newDate = dp.startDate.addMonths(1);
    updateCalendar(newDate);
  });
});
