const dashboardSidebar = document.getElementById("dashboardSidebar");
const dropDowns = document.querySelectorAll(".dropdown");
const themeToggle = document.getElementById("theme-toggle");
const dashboardViews = document.querySelectorAll(".dashboard-view");
const dashboardNavItems = document.querySelectorAll(".dashboard-nav-item");
const dashboardTitle = document.getElementById("dashboardTitle");
const dashboardSidebarOverlay = document.getElementById("dashboardSidebarOverlay");
// ! Search
const searchContainer = document.getElementById("searchContainer");
const searchInput = document.getElementById("searchInput");
const searchClose = document.getElementById("searchClose");
const mobileSearchBtn = document.getElementById("mobileSearchBtn");

// ! State
let sidebarCollapsed = false;
let currentView = "overview";

// *===================================
// * INITIALIZATION
// *===================================

document.addEventListener("DOMContentLoaded", function () {
  initSidebar();
  initDropDown();
  initTheme();
  initThemeToggle();
  initSearch();
  categoryChart.render();
  progressChart.render();
});

// ?===================================
// ? SIDEBAR FUNCTIONALITY
// ?===================================

const initSidebar = () => {
  //Hack: Load Initial Sidebar State from local Storage
  sidebarCollapsed =
    localStorage.getItem("dashboard-sidebar-collapsed") === "true";
  dashboardSidebar.classList.toggle("collapsed", sidebarCollapsed);

  //Hack: Sidebar functionality
  document.querySelectorAll(".dashboard-sidebar-toggle").forEach((toggler) => {
    toggler.addEventListener("click", toggleSidebar);
  });

  //bug: Sidebar overlay functionality
  dashboardSidebarOverlay?.addEventListener("click", closeSidebar);
  if (dashboardSidebar.classList.contains("collapsed")) {
    dashboardSidebarOverlay?.classList.add("active");
  }
};
// Info: sidebar toggle function
const toggleSidebar = () => {
  sidebarCollapsed = !sidebarCollapsed;
   const isMobile = window.innerWidth <= 1024;

   if (isMobile) {
     const isOpen = dashboardSidebar.classList.contains("collapsed");
     dashboardSidebar.classList.toggle("collapsed", !isOpen);
     dashboardSidebarOverlay?.classList.toggle("active", !isOpen);
   } else {
     dashboardSidebar.classList.toggle("collapsed", sidebarCollapsed);
   }

  localStorage.setItem(
    "dashboard-sidebar-collapsed",
    sidebarCollapsed.toString()
  );
};

function closeSidebar() {
  if (window.innerWidth <= 1024) {
    dashboardSidebar.classList.remove("collapsed");
    dashboardSidebarOverlay?.classList.remove("active");

    localStorage.setItem(
      "dashboard-sidebar-collapsed",
      "false"
    );
  }
}
// ! ===================================
// ! DROP MENU FUNCTIONALITY
// !===================================

const initDropDown = () => {
  if (!dropDowns.length) return;
  dropDowns.forEach((dropdown) => {
    const toggle = dropdown.querySelector(".dropdown-toggle");
    const menu = dropdown.querySelector(".dropdown-menu");

    if (!toggle || !menu) return;

    toggle.addEventListener("click", (e) => {
      e.stopPropagation();
      closeAllDropdowns();
      dropdown.classList.toggle("active");
    });
  });

  document.addEventListener("click", (e) => {
    dropDowns.forEach(dropdown => {
        if (!dropdown.contains(e.target)) {
            dropdown.classList.remove("active");
        }
    })
  });


  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") closeAllDropdowns();
  });
};

function closeAllDropdowns() {
  dropDowns.forEach((d) => d.classList.remove("active"));
}

// *:===================================
// *:THEME FUNCTIONALITY
// *:===================================

const initTheme = () => {
    // Info: Load saved theme
    const savedTheme = localStorage.getItem("dashboard-theme") || "light";
    document.documentElement.setAttribute("data-theme", savedTheme);
    // hack: Update UI theme
    updateThemeToggleUI(savedTheme);
}

const initThemeToggle = () => {
    if (!themeToggle) return;
    themeToggle.querySelectorAll(".theme-option").forEach( option => {
        option.addEventListener("click", e => {
            e.stopPropagation();
            setTheme(option.getAttribute("data-theme"));
        })
    });
}

function setTheme(theme){
    document.documentElement.setAttribute("data-theme", theme);
    localStorage.setItem("dashboard-theme", theme);
    updateThemeToggleUI(theme);
}

function updateThemeToggleUI(theme){
    if (!themeToggle) return;
    themeToggle.querySelectorAll(".theme-option").forEach( option => {
        option.classList.toggle("active", option.getAttribute("data-theme") === theme);
    });

}

// ?===================================
// ? SEARCH FUNCTIONALITY
// ?===================================
function initSearch() {
  mobileSearchBtn?.addEventListener("click", () => {
    searchContainer.classList.add("mobile-active");
    searchInput.focus();
  });
  searchClose?.addEventListener("click", () => {
    searchContainer.classList.remove("mobile-active");
    searchInput.value = "";
  });
}

