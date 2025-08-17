document.addEventListener("DOMContentLoaded", () => {
    const btn = document.getElementById("logoDropdownBtn");
    const menu = document.getElementById("logoDropdownMenu");

    // Logo tıklayınca aç/kapat
    btn.addEventListener("click", (e) => {
        e.stopPropagation();
        if (menu.classList.contains("scale-0")) {
            menu.classList.remove("scale-0");
            menu.classList.add("scale-100");
        } else {
            menu.classList.remove("scale-100");
            menu.classList.add("scale-0");
        }
    });

    // Menü dışında tıklanınca kapan
    document.addEventListener("click", (e) => {
        if (!menu.contains(e.target)) {
            menu.classList.remove("scale-100");
            menu.classList.add("scale-0");
        }
    });
});
