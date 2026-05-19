document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".project-size-wrapper button");
    const priceRangeEl = document.querySelector(".priceRange");
    const reviewCountEl = priceRangeEl?.nextElementSibling; 

    buttons.forEach((button) => {
        button.addEventListener("click", (e) => {
            buttons.forEach((b) => b.classList.remove("active"));
            button.classList.add("active");

            const service = button.getAttribute("data-service");
            const companyId = priceRangeEl.getAttribute("data-company");

            fetch(`/profile/${companyId}/project-sizes?service=${service}`)
                .then((res) => res.json())
                .then((data) => {
                    priceRangeEl.textContent = `$${data.min.toLocaleString()} – $${data.max.toLocaleString()}`;
                    if (reviewCountEl) {
                        reviewCountEl.textContent = `Based on ${data.count} Reviews`;
                    }
                })
                .catch((err) => {
                    console.error("Error fetching project size:", err);
                    priceRangeEl.textContent = "Data not available";
                });
        });
    });
});
