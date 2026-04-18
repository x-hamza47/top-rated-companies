import "./bootstrap";
import { initDropdowns, initTheme, initThemeToggle } from "./shared";

// *===================================
// * INITIALIZATION
// *===================================

document.addEventListener("DOMContentLoaded", function () {
    initDropdowns();
    initTheme();
    initThemeToggle();
});

document.querySelectorAll(".alert").forEach(function (alert) {
    setTimeout(() => {
        alert.classList.add("opacity-0", "transition", "duration-500");
        setTimeout(() => alert.remove(), 1500);
    }, 4000);
});
document.querySelectorAll(".close-alert").forEach(function (btn) {
    btn.addEventListener("click", function () {
        const alert = btn.closest(".alert");
        alert.classList.add("opacity-0", "transition", "duration-500");
        setTimeout(() => alert.remove(), 500);
    });
});

// Info: Navbar js
const menuItems = document.querySelectorAll(".menu-item");

menuItems.forEach((item) => {
    const btn = item.querySelector(".nav-link");
    const dropdown = item.querySelector(".menu-dropdown");
    const chevron = btn.querySelector(".fa-chevron-down");
    btn.addEventListener("click", (e) => {
        e.preventDefault();
        menuItems.forEach((other) => {
            const otherDropdown = other.querySelector(".menu-dropdown");
            const otherBtn = other.querySelector(".nav-link");
            const otherChevron = otherBtn.querySelector(".fa-chevron-down");
            if (otherDropdown !== dropdown) {
                otherChevron.classList.remove("rotate-180");
                otherDropdown.classList.remove("active");
                otherBtn.classList.remove("active");
            }
        });

        const isOpen = !dropdown.classList.contains("active");
        dropdown.classList.toggle("active");
        btn.classList.toggle("active", isOpen);
        if (chevron) {
            chevron.classList.toggle("rotate-180", isOpen);
        }
    });
});

$("#mobile-menu-btn").on("click", function () {
    $(".navbar").toggleClass("active");
    $("#menu-icon").toggleClass("fa-bars fa-xmark");
});

document.addEventListener("click", (e) => {
    const isClickInside = [...menuItems].some((item) =>
        item.contains(e.target),
    );
    if (!isClickInside) {
        menuItems.forEach((item) => {
            const dropdown = item.querySelector(".menu-dropdown");
            const btn = item.querySelector(".nav-link");
            const chevron = btn.querySelector(".fa-chevron-down");
            chevron.classList.remove("rotate-180");
            dropdown.classList.remove("active");
            btn.classList.remove("active");
        });
    }
});
