// Load JSON file
async function loadCategories() {
    const res = await fetch("/services.json"); // Laravel public folder
    if (!res.ok) {
        console.error("Failed to load JSON:", res.statusText);
        return { categories: [] };
    }
    return res.json();
}

document.addEventListener("DOMContentLoaded", async () => {
    const data = await loadCategories();

    if (!data.categories?.length) {
        console.error("No categories found.");
        return;
    }

    const badgeContainer = document.querySelector(".category-badges-container");
    const linkContainer = document.querySelector(".links-container");
    const currentCategoryLabel = document.querySelector("#currentCategory");

    let activeCategory = data.categories[0].category;

    // Render badges
    function renderBadges() {
        badgeContainer.innerHTML = data.categories
            .map((cat) =>
                renderBadge(cat.category, cat.category === activeCategory)
            )
            .join("");
    }

    // Click listener
    badgeContainer.addEventListener("click", (e) => {
        const badge = e.target.closest("[data-category]");
        if (!badge) return;

        activeCategory = badge.dataset.category;

        const selectedCategory = data.categories.find(
            (c) => c.category === activeCategory
        );
        if (!selectedCategory) return;

        renderBadges();
        renderLinks(selectedCategory.links);
        currentCategoryLabel.textContent = selectedCategory.category;
    });

    // Render single badge
    function renderBadge(name, isActive) {
        return `
      <span data-category="${name}"
        class="${
            isActive
                ? "bg-lime-700 text-white"
                : "bg-transparent outline-1 outline-lime-700 text-lime-700 hover:bg-lime-800 hover:text-white"
        } max-[550px]:grow flex justify-center items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer transition-colors duration-300">
        ${name}
        <svg width="12" height="12" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M24 10V38M24 38L38 24M24 38L10 24" class="${
              isActive ? "stroke-white" : "stroke-lime-700 hover:stroke-white"
          }" stroke-width="4"
            stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </span>
    `;
    }

    // Render links with fade-in + slide-up animation
    function renderLinks(links) {
        linkContainer.innerHTML = "";
        links.forEach((link, index) => {
            const span = document.createElement("span");
            span.className =
                "bg-lime-800 max-[550px]:grow text-white flex justify-between hover:bg-lime-800 items-center gap-2 text-md px-2 py-2 font-medium rounded-md cursor-pointer opacity-0 translate-y-3 transition-all duration-500";
            span.innerHTML = `
        ${link}
        <svg width="18" height="18" viewBox="0 0 48 48" fill="none"
          xmlns="http://www.w3.org/2000/svg">
          <path d="M14 34L34 14M34 14H14M34 14V34" class="stroke-white" stroke-width="4"
            stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      `;
            linkContainer.appendChild(span);

            // Animate with a stagger effect
            setTimeout(() => {
                span.classList.remove("opacity-0", "translate-y-3");
                span.classList.add("opacity-100", "translate-y-0");
            }, 50 + index * 50);
        });
    }

    // Initialize
    renderBadges();
    renderLinks(data.categories[0].links);
    currentCategoryLabel.textContent = data.categories[0].category;
});
