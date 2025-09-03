document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".sidebar-menu-item");

    // Restaurar active guardado
    const lastActive = localStorage.getItem("activeMenu");
    if (lastActive) {
        menuItems.forEach(item => {
            item.classList.remove("active");
            if (item.dataset.title === lastActive) {
                item.classList.add("active");
            }
        });
    }

    // Guardar active al hacer clic en items principales
    menuItems.forEach(item => {
        const link = item.querySelector("a.sidebar-menu-button");
        if (!link) return;

        link.addEventListener("click", function () {
            // Si es un colapsable, solo mantener el active, no borrarlo
            const submenu = link.getAttribute("data-toggle") === "collapse";
            if (!submenu) {
                menuItems.forEach(el => el.classList.remove("active"));
                item.classList.add("active");
                if (item.dataset.title) {
                    localStorage.setItem("activeMenu", item.dataset.title);
                }
            }
        });
    });

    // Mantener activo mientras submenu esté abierto
    document.querySelectorAll(".sidebar-submenu").forEach(sub => {
        sub.addEventListener("show.bs.collapse", function () {
            const parent = sub.closest(".sidebar-menu-item");
            if (parent) parent.classList.add("active");
        });

        sub.addEventListener("hide.bs.collapse", function () {
            const parent = sub.closest(".sidebar-menu-item");
            if (parent) parent.classList.remove("active");
        });
    });
});


document.addEventListener("DOMContentLoaded", function () {
  const sidebarLinks = document.querySelectorAll(".js-sidebar-mini-tabs [data-toggle='tab']");

  sidebarLinks.forEach(link => {
    link.addEventListener("click", function (e) {
      // Si está en modo mini, forzar abrir + activar tab
      const drawer = document.querySelector(".mdk-drawer");
      if (drawer && drawer.classList.contains("layout-mini__drawer")) {
        // Forzar mostrar tab sin esperar doble clic
        const tabId = this.getAttribute("href");
        if (tabId && tabId.startsWith("#")) {
          const tabPane = document.querySelector(tabId);
          if (tabPane) {
            document.querySelectorAll(".tab-pane").forEach(pane => {
              pane.classList.remove("active", "show");
            });
            tabPane.classList.add("active", "show");
          }
        }
      }
    });
  });
});