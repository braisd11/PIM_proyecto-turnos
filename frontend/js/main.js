document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".dropdown-btn").forEach(btn => {
    btn.addEventListener("click", () => {
      const links = btn.nextElementSibling;
      links.classList.toggle("active");
    });
  });
});