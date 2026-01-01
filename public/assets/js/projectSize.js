document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".project-size-wrapper button");
    const priceRangeEl = document.querySelector(".priceRange");
    const serviceName = document.querySelector(".service-name");

    buttons.forEach((button) => {
        button.addEventListener("click", (e) => {
            buttons.forEach((b) => b.classList.remove("active"));
            button.classList.add("active");
            if (e.target.textContent != "All") {
                serviceName.textContent = ": "+e.target.textContent;
            } else {
                serviceName.textContent = "";
            }

            const service = button.getAttribute("data-service");
            const companyId = priceRangeEl.getAttribute("data-company");

            fetch(`/profile/${companyId}/project-sizes?service=${service}`)
                .then((res) => res.json())
                .then((data) => {
                    priceRangeEl.innerHTML = `$${data.min.toLocaleString()} - $${data.max.toLocaleString()} <span class="font-semibold">Based on ${
                        data.count
                    } Reviews</span>`;
                })
                .catch((err) => {
                    console.error("Error fetching project size:", err);
                    priceRangeEl.innerHTML = "Data not available";
                });
        });
    });
});
