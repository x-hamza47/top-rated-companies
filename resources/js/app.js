import "./bootstrap";

// window.addEventListener("mousemove", (e) => {
//     document.querySelector(".mouse-trail").style.top = e.clientY + "px";
//     document.querySelector(".mouse-trail").style.left = e.clientX + "px";
//     setTimeout(() => {
//         document.querySelector(".mouse").style.left = e.clientX + "px";
//         document.querySelector(".mouse").style.top = e.clientY + "px";
//     }, 100);
// });
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
     const dropdown = item.querySelector(".dropdown");
     btn.addEventListener("click", (e) => {
         e.preventDefault();
         menuItems.forEach((other) => {
             const otherDropdown = other.querySelector(".dropdown");
             const otherBtn = other.querySelector(".nav-link");
             if (otherDropdown !== dropdown) {
                 otherDropdown.classList.add("hidden");
                 otherDropdown.classList.remove("opacity-100", "translate-y-0");
                 otherBtn.classList.remove("active");
             }
         });

         const isOpen = !dropdown.classList.contains("hidden");
         dropdown.classList.toggle("hidden");
         dropdown.classList.toggle("opacity-100");
         dropdown.classList.toggle("translate-y-0");
         btn.classList.toggle("active", !isOpen);
     });
 });

 const mobileBtn = document.getElementById("mobile-menu-btn");
 const mobileMenu = document.getElementById("mobile-menu");
 const mobileClose = document.getElementById("mobile-menu-close");

 mobileBtn.addEventListener("click", () => {
     mobileMenu.classList.remove("translate-x-full");
 });

 mobileClose.addEventListener("click", () => {
     mobileMenu.classList.add("translate-x-full");
 });

 const mobileItems = document.querySelectorAll(".mobile-menu-item");
 mobileItems.forEach((item) => {
     const btn = item.querySelector(".mobile-drop");
     const submenu = item.querySelector(".mobile-submenu");
     const arrow = btn.querySelector("span");

     btn.addEventListener("click", () => {
         mobileItems.forEach((other) => {
             if (other !== item) {
                 const otherSub = other.querySelector(".mobile-submenu");
                 const otherArrow = other.querySelector("span");
                 const otherBtn = other.querySelector(".mobile-drop");

                 otherSub.style.maxHeight = null;
                 otherArrow.classList.remove("rotate-180");
                 otherBtn.classList.remove("active");
             }
         });

         if (submenu.style.maxHeight && submenu.style.maxHeight !== "0px") {
             submenu.style.maxHeight = null;
             arrow.classList.remove("rotate-180");
             btn.classList.remove("active");
         } else {
             submenu.style.maxHeight = submenu.scrollHeight + "px";
             arrow.classList.add("rotate-180");
             btn.classList.add("active");
         }
     });
 });

 document.addEventListener("click", (e) => {
     const isClickInside = [...menuItems].some((item) =>
         item.contains(e.target)
     );
     if (!isClickInside) {
         menuItems.forEach((item) => {
             const dropdown = item.querySelector(".dropdown");
             const btn = item.querySelector(".nav-link");
             dropdown.classList.add("hidden");
             dropdown.classList.remove("opacity-100", "translate-y-0");
             btn.classList.remove("active");
         });
     }
 });
