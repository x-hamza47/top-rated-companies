import { initDropdowns, initTheme, initThemeToggle } from "../shared";

const dashboardSidebar = document.getElementById("dashboardSidebar");
const dashboardSidebarOverlay = document.getElementById(
    "dashboardSidebarOverlay",
);
// ! Search
const searchContainer = document.getElementById("searchContainer");
const searchInput = document.getElementById("searchInput");
const searchClose = document.getElementById("searchClose");
const mobileSearchBtn = document.getElementById("mobileSearchBtn");

// ! State
let sidebarCollapsed = false;

// *===================================
// * INITIALIZATION
// *===================================

document.addEventListener("DOMContentLoaded", function () {
    initSidebar();
    initDropdowns();
    initTheme();
    initThemeToggle();
    initSearch();
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
    document
        .querySelectorAll(".dashboard-sidebar-toggle")
        .forEach((toggler) => {
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
        sidebarCollapsed.toString(),
    );
};

function closeSidebar() {
    if (window.innerWidth <= 1024) {
        dashboardSidebar.classList.remove("collapsed");
        dashboardSidebarOverlay?.classList.remove("active");

        localStorage.setItem("dashboard-sidebar-collapsed", "false");
    }
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
// ?===================================
// ? Alert FUNCTIONALITY
// ?===================================
document.querySelectorAll(".alert").forEach(function (alert) {
    setTimeout(() => {
        alert.classList.add("opacity-0", "transition", "duration-500");
        setTimeout(() => alert.remove(), 1500);
    }, 4000);
});

// Manual close
document.querySelectorAll(".close-alert").forEach(function (btn) {
    btn.addEventListener("click", function () {
        const alert = btn.closest(".alert");
        alert.classList.add("opacity-0", "transition", "duration-500");
        setTimeout(() => alert.remove(), 500);
    });
});
