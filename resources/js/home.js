$(document).ready(function () {
    const workSwiper = new Swiper(".works-swipper", {
        slidesPerView: 1,
        spaceBetween: 40,
        loop: false,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".main-next",
            prevEl: ".main-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });

    var insightsSwiper = new Swiper(".insights-swiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 5000,
        },
        pagination: {
            el: ".insights-swiper .swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
            },
            1024: {
                slidesPerView: 2,
            },
            1400: {
                slidesPerView: 2,
            },
        },
    });

    // ! Hero Section js
        const input = document.getElementById("serviceInput");
        const dropdown = document.getElementById("serviceDropdown");
        const results = document.getElementById("searchResults");
        const loading = document.getElementById("searchLoading");
        const empty = document.getElementById("searchEmpty");
        const placeholder = document.getElementById("searchPlaceholder");
        let debounceTimer = null;

        input.addEventListener("focus", () => {
            if (input.value.trim().length < 2) {
                dropdown.classList.remove("hidden");
                placeholder.classList.remove("hidden");
                results.innerHTML = "";
                empty.classList.add("hidden");
                loading.classList.add("hidden");
            }
        });
        document.addEventListener("click", (e) => {
            if (!dropdown.contains(e.target) && e.target !== input) {
                dropdown.classList.add("hidden");
            }
        });

        input.addEventListener("input", function () {
            const q = this.value.trim();
            clearTimeout(debounceTimer);

            if (q.length < 2) {
                results.innerHTML = "";
                loading.classList.add("hidden");
                empty.classList.add("hidden");
                placeholder.classList.remove("hidden");
                dropdown.classList.remove("hidden");
                return;
            }

            placeholder.classList.add("hidden");
            loading.classList.remove("hidden");
            empty.classList.add("hidden");
            results.innerHTML = "";
            dropdown.classList.remove("hidden");

            debounceTimer = setTimeout(() => {
                fetch(`/search/live?q=${encodeURIComponent(q)}`)
                    .then((res) => res.json())
                    .then((data) => {
                        loading.classList.add("hidden");
                        renderResults(data, q);
                    })
                    .catch(() => {
                        loading.classList.add("hidden");
                        empty.classList.remove("hidden");
                    });
            }, 300);
        });

        document
            .getElementById("serviceSearchForm")
            .addEventListener("submit", (e) => {
                const q = input.value.trim();
                if (q.length < 2) {
                    e.preventDefault();
                    return;
                }
            });

        function renderResults(data, q) {
            const { companies, services, insights } = data;
            const hasResults =
                companies.length || services.length || insights.length;

            if (!hasResults) {
                empty.classList.remove("hidden");
                return;
            }

            let html = "";

            // --- Services FIRST ---
            if (services.length) {
                html += `<p class="text-xs text-gray-400/80 px-4 pt-2 pb-1 uppercase tracking-wider">Services</p>`;
                services.forEach((s) => {
                    html += `
            <a href="/companies/${escapeHtml(s.slug)}"
                class="flex items-center gap-3 px-4 py-2 hover:bg-(--color-primary-hover)/80 border-b border-gray-500/20">
                <i class="fa-solid fa-tag text-lime-600 text-xs w-7 text-center shrink-0"></i>
                <p class="text-sm text-(--color-text)">${highlight(s.name, q)}</p>
            </a>`;
                });
            }

            // --- Companies SECOND ---
            if (companies.length) {
                html += `<p class="text-xs text-gray-400/80 px-4 pt-3 pb-1 uppercase tracking-wider">Companies</p>`;
                companies.forEach((c) => {
                    const logo = c.logo_url
                        ? `<img src="${escapeHtml(c.logo_url)}" class="w-7 h-7 rounded-full object-cover shrink-0" alt="${escapeHtml(c.name ?? "")}"
                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">`
                        : "";
                    const avatar = `<div class="w-7 h-7 rounded-full bg-lime-700/30 flex items-center justify-center text-lime-500 text-xs font-bold shrink-0 ${c.logo_url ? "hidden" : ""}">${escapeHtml((c.name ?? "?")[0].toUpperCase())}</div>`;

                    html += `
            <a href="/profile/${escapeHtml(c.slug)}"
                class="flex items-center gap-3 px-4 py-2 hover:bg-(--color-primary-hover)/80 border-b border-gray-500/20">
                ${logo}${avatar}
                <div class="flex-1 min-w-0">
                    <p class="text-sm text-(--color-text) truncate font-medium">${highlight(c.name, q)}</p>
                    ${c.tagline ? `<p class="text-xs text-gray-400 truncate">${highlight(c.tagline, q)}</p>` : ""}
                </div>
                <i class="fa-solid fa-arrow-right text-lime-600 text-xs"></i>
            </a>`;
                });
            }

            // --- Insights LAST ---
            if (insights.length) {
                html += `<p class="text-xs text-gray-400/80 px-4 pt-3 pb-1 uppercase tracking-wider">Insights / Blogs</p>`;
                insights.forEach((i) => {
                    html += `
            <a href="/blogs/${escapeHtml(i.slug)}"
                class="flex items-center gap-3 px-4 py-2 hover:bg-(--color-primary-hover)/80 cursor-pointer">
                <i class="fa-solid fa-newspaper text-lime-600 text-xs w-7 text-center shrink-0"></i>
                <div class="flex-1 min-w-0">
                    <p class="text-sm text-(--color-text) truncate">${highlight(i.title, q)}</p>
                    ${i.excerpt ? `<p class="text-xs text-gray-400 truncate">${escapeHtml(i.excerpt)}</p>` : ""}
                </div>
            </a>`;
                });
            }

            results.innerHTML = html;
        }

        function highlight(text, query) {
            if (!text) return "";
            const escaped = query.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
            return escapeHtml(text).replace(
                new RegExp(`(${escaped})`, "gi"),
                '<mark class="bg-amber-700/30 text-(--color-secondary) rounded px-0.5">$1</mark>',
            );
        }

        function escapeHtml(str) {
            return String(str)
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;");
        }


    // ! Service Section js
    const cards = document.querySelectorAll(".mobile-cards .card");

    cards.forEach((card) => {
        const closeBtn = card.querySelector(".close-btn");
        card.addEventListener("click", (e) => {
            if (window.innerWidth < 769) {
                if (card.classList.contains("active")) return;
                cards.forEach((c) => c.classList.remove("active"));
                card.classList.toggle("active");

                e.stopPropagation();
            }

            closeBtn.addEventListener("click", (e) => {
                e.stopPropagation();
                card.classList.remove("active");
            });
        });
    });
    document.addEventListener("click", (e) => {
        const activeCard = document.querySelector(".mobile-cards .card.active");
        if (!activeCard) return;

        if (!e.target.closest(".card")) {
            activeCard.classList.remove("active");
        }
    });
});
