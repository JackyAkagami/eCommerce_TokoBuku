document.addEventListener("DOMContentLoaded", () => {
  console.log("JS Loaded OK");

  const dropdowns = document.querySelectorAll(".dropdown");

  dropdowns.forEach(drop => {
    const button = drop.querySelector("button.icon");
    const menu = drop.querySelector(".dropdown-content");

    button.addEventListener("click", (e) => {
      e.stopPropagation();

      // tutup semua dropdown lain
      document.querySelectorAll(".dropdown-content.show").forEach(open => {
        if (open !== menu) open.classList.remove("show");
      });

      // toggle dropdown ini
      menu.classList.toggle("show");
    });
  });

  // klik di luar => tutup semua
  document.addEventListener("click", () => {
    document.querySelectorAll(".dropdown-content.show").forEach(open => {
      open.classList.remove("show");
    });
  });
});
