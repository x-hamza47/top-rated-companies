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
    function searchableDropdown(inputId, dropdownId, itemClass) {
        const $input = $(inputId);
        const $dropdown = $(dropdownId);
        const $items = $dropdown.find(itemClass);
        const $form = $("#serviceSearchForm");

        $input.on("focus", function () {
            $(".search-dropdown").not($dropdown).hide();
            $dropdown.stop(true, true).slideDown(150);
        });

        $input.on("keyup", function () {
            const value = $(this).val().toLowerCase();
            let visible = 0;

            $items.each(function () {
                const text = $(this).text().toLowerCase();
                if (text.includes(value)) {
                    $(this).show();
                    visible++;
                } else {
                    $(this).hide();
                }
            });

            visible ? $dropdown.show() : $dropdown.hide();
        });

        $items.on("click", function () {
            const text = $(this).text().trim();
            const slug = $(this).data("slug");
            $input.val(text);

            $("#serviceInput").val(slug);

            $dropdown.slideUp(150);
        });

        $form.on("submit", function (e) {
            const value = $input.val().trim();
            if (value === "") {
                e.preventDefault();
                alert("Please select a service.");
                $input.focus();
            }
        });
    }

    searchableDropdown("#serviceInput", "#serviceDropdown", ".service-item");

    $(document).on("click", function (e) {
        if (!$(e.target).closest("input, .search-dropdown").length) {
            $(".search-dropdown").slideUp(150);
        }
    });

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
