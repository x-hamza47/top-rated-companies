export function initTheme() {
    const themeToggle = document.getElementById("theme-toggle");
    const savedTheme = localStorage.getItem("dashboard-theme") || "light";
    document.documentElement.setAttribute("data-theme", savedTheme);
    updateThemeToggleUI(themeToggle, savedTheme);
}

export function initThemeToggle() {
    const themeToggle = document.getElementById("theme-toggle");
    if (!themeToggle) return;

    themeToggle.querySelectorAll(".theme-option").forEach((option) => {
        option.addEventListener("click", (e) => {
            e.stopPropagation();
            const theme = option.getAttribute("data-theme");
            setTheme(theme, themeToggle);
        });
    });
}

function setTheme(theme, themeToggle) {
    document.documentElement.setAttribute("data-theme", theme);
    localStorage.setItem("dashboard-theme", theme);
    updateThemeToggleUI(themeToggle, theme);
}

function updateThemeToggleUI(themeToggle, theme) {
    themeToggle.querySelectorAll(".theme-option").forEach((option) => {
        option.classList.toggle(
            "active",
            option.getAttribute("data-theme") === theme,
        );
    });
}

// ! ===================================
// ! DROP MENU FUNCTIONALITY
// !===================================

export function initDropdowns(selector = ".dropdown") {
    const dropDowns = document.querySelectorAll(selector);

    if (!dropDowns.length) return;

    dropDowns.forEach((dropdown) => {
        const toggle = dropdown.querySelector(".dropdown-toggle");
        const menu = dropdown.querySelector(".dropdown-menu");

        if (!toggle || !menu) return;

        toggle.addEventListener("click", (e) => {
            e.stopPropagation();

            closeAllDropdowns(selector);
            dropdown.classList.toggle("active");
        });
    });

    document.addEventListener("click", (e) => {
        dropDowns.forEach((dropdown) => {
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove("active");
            }
        });
    });

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") closeAllDropdowns(selector);
    });
}

function closeAllDropdowns(selector) {
    document.querySelectorAll(selector).forEach((d) => {
        d.classList.remove("active");
    });
}

// ! ===================================
// ! Faq FUNCTIONALITY
// !===================================
export function initFaqAccordion() {
    const headers = document.querySelectorAll(".faq-header");

    headers.forEach((header, index) => {
        header.addEventListener("click", () => {
            const allAnswers = document.querySelectorAll(".faq-answer");
            const allIcons = document.querySelectorAll(".faq-icon");

            allAnswers.forEach((el, i) => {
                if (i === index) {
                    const isOpen = el.classList.contains("opacity-100");

                    el.classList.toggle("opacity-100", !isOpen);
                    el.classList.toggle("max-h-[300px]", !isOpen);
                    el.classList.toggle("translate-y-0", !isOpen);
                    el.classList.toggle("pt-4", !isOpen);

                    el.classList.toggle("max-h-0", isOpen);
                    el.classList.toggle("-translate-y-2", isOpen);

                    allIcons[i].classList.toggle("rotate-180", !isOpen);
                } else {
                    el.classList.remove(
                        "opacity-100",
                        "max-h-[300px]",
                        "translate-y-0",
                        "pt-4",
                    );
                    el.classList.add("max-h-0", "-translate-y-2");
                    allIcons[i].classList.remove("rotate-180");
                }
            });
        });
    });
}
