import { initFaqAccordion } from "./shared";

$(document).ready(function () {
    initFaqAccordion();
    $(".filter-btn").on("click", function (e) {
        e.stopPropagation();
        const $dropdown = $(this).next(".filter-dropdown");
        $dropdown.toggleClass("hidden");
        $(".filter-dropdown").not($dropdown).addClass("hidden");
    });

    $(document).on("click", function (e) {
        if (!$(e.target).closest(".filter-dropdown, .filter-btn").length) {
            $(".filter-dropdown").addClass("hidden");
        }
    });

    $(".service-search").on("input", function () {
        const val = $(this).val().toLowerCase().trim();
        const $labels = $(this)
            .closest(".filter-dropdown")
            .find("label.service-option");
        $labels.each(function () {
            const text = $(this).data("label")?.toLowerCase() || "";
            $(this).toggle(text.includes(val));
        });
    });

    $(document).on("click", ".remove-chip", function () {
        const $chip = $(this).closest(".filter-chip");
        const name = $chip.find(".remove-chip").data("name");
        const value = $chip.find(".remove-chip").data("value");

        $chip.fadeOut(150, function () {
            $(this).remove();
            updateMoreLink();
        });

        const selector = `input[name="${name}[]"][value="${value}"], input[name="${name}"][value="${value}"]`;
        $(selector).prop("checked", false);

        $chip.closest("form").submit();
    });

    function updateMoreLink() {
        const $extra = $(".extra-chip");
        const $toggle = $("#toggle-chips");

        if ($extra.length === 0) {
            $toggle.remove();
            return;
        }

        if ($extra.is(":visible")) {
            $toggle.text("Show Less");
        } else {
            $toggle.text(`+${$extra.length} more`);
        }
    }

    // Toggle extra chips
    $(document).on("click", "#toggle-chips", function () {
        const $extra = $(".extra-chip");
        if ($extra.is(":visible")) {
            $extra.addClass("hidden");
            $(this).text(`+${$extra.length} more`);
        } else {
            $extra.removeClass("hidden");
            $(this).text("Show Less");
        }
    });

    // Initialize more link state
    updateMoreLink();
});


//! Filters
    const filters = document.querySelector(".filters");
    const overlay = document.querySelector(".filter-overlay");
    const openBtn = document.getElementById("openFilters");
    const closeBtn = document.getElementById("closeFilters");

    openBtn.addEventListener('click', () => {
        filters.classList.add('active');
        overlay.classList.add('active');
    });

    closeBtn.addEventListener("click", () => {
        filters.classList.remove("active");
        overlay.classList.remove("active");
    });
    overlay.addEventListener("click", () => {
        filters.classList.remove("active");
        overlay.classList.remove("active");
    });


// ! Counter Animation
const element = document.getElementById("companyCount");
const target = +element.getAttribute("data-target");
const duration = 3000;
let start = null;

function easeOutQuad(t) {
    return t * (2 - t);
}

function animateCount(timestamp) {
    if (!start) start = timestamp;
    const progress = (timestamp - start) / duration;
    const easedProgress = easeOutQuad(Math.min(progress, 1));
    element.innerText = Math.ceil(easedProgress * target) + "+ Companies";
    if (progress < 1) {
        requestAnimationFrame(animateCount);
    }
}

requestAnimationFrame(animateCount);

const sticky = document.getElementById("stickyFilters");
const trigger = document.getElementById("stickyTrigger");

const observer = new IntersectionObserver(
    ([entry]) => {
        if (!entry.isIntersecting) {
            sticky.classList.add("border-b", "border-(--color-border)");
        } else {
            sticky.classList.remove("border-b", "border-(--color-border)");
        }
    },
    {
        rootMargin: "-80px 0px 0px 0px", 
    },
);

observer.observe(trigger);
