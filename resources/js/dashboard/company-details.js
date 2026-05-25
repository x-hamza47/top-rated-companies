$(document).ready(function () {
    const MAX_SERVICES = 15;
    let totalExpertise = 0;

    // !Update Total expertise method
    function updateTotal() {
        totalExpertise = 0;
        $("#serviceTags .service-tag").each(function () {
            totalExpertise += $(this).data("percent") || 0;
        });
        $("#total-expertise").text(totalExpertise + "%");
        //* Hide Add Service Button
        if ($("#serviceTags .service-tag").length >= 15) {
            $("#addServiceBtn").fadeOut();
        } else {
            $("#addServiceBtn").fadeIn();
        }
    }

    // ============================
    // ? Add Service Functionality
    // ============================
    $("#addServiceBtn").on("click", function () {
        $("#serviceSelectorOverlay").fadeIn();
    });
    $("#closeServiceSelector").on("click", function () {
        $("#serviceSelectorOverlay").fadeOut();
    });

    // ! Services Search And Accordion
    $(document).on("click", ".accordion-header", function () {
        let content = $(this).next(".accordion-content");
        content.slideToggle(200);
        let icon = $(this).find(".accordion-icon");
        icon.text(icon.text() === "+" ? "−" : "+");
    });
    $("#serviceSearch").on("input", function () {
        let val = $(this).val().toLowerCase();

        $(".service-item").each(function () {
            let name = $(this).data("name");
            if (!name) return;
            name = name.toLowerCase();

            $(this).toggle(name.includes(val));
        });
    });

    $(document).on("click", ".remove-service", function (e) {
        e.stopPropagation();
        let serviceTag = $(this).closest(".service-tag");

        Swal.fire({
            title: "Are you sure?",
            text: "Do you really want to delete this service? This action cannot be undone.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc2626",
            cancelButtonColor: "#6b7280",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                serviceTag.remove();
                updateTotal();
            }
        });
    });
    // ! Initial Load Percentage
    updateTotal();

    function openServiceSlider(
        tagName,
        currentPercent,
        currentDescription,
        callback,
    ) {
        const popup = $(`
        <div id="serviceSliderPopup" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 px-3">
            <div class="bg-(--color-background) p-6 rounded-xl shadow-lg relative w-2xl min-w-2xs">
                <h3 class="text-lg font-semibold text-center mb-7">Set expertise for <span class="text-(--color-primary)">${tagName}</span></h3>
                <div class="slider" id="serviceSlider"></div>
                <div class="mt-4 flex justify-between items-center">
                    <span id="sliderValue">${currentPercent}%</span>
                    <button id="saveServiceSlider" class="bg-(--color-primary) text-white px-4 py-1 rounded">Save</button>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium mb-1">Description <span class="text-(--color-muted) font-normal">(optional)</span></label>
                    <textarea id="serviceDescription" rows="6"
                        class="w-full p-2 border border-(--color-border) rounded-lg outline-none focus:ring-2 focus:ring-(--color-primary) resize-none text-sm"
                        placeholder="Describe your expertise in this service..."
                    >${currentDescription}</textarea>
                </div>
                <button id="closeServiceSlider" class="absolute top-2 right-2 text-(--color-error) hover:text-gray-700 w-5 h-5 pb-0.5 flex items-center justify-center rounded-full bg-(--color-error-100)">&times;</button>
            </div>
        </div>
    `);

        $("body").append(popup);

        const sliderEl = document.getElementById("serviceSlider");
        const remaining = 100 - (totalExpertise - currentPercent);

        noUiSlider.create(sliderEl, {
            start: currentPercent,
            step: 1,
            range: { min: 0, max: remaining },
            tooltips: true,
            connect: [true, false],
            format: { to: (v) => parseInt(v), from: (v) => Number(v) },
        });

        sliderEl.noUiSlider.on("update", function (values) {
            let val = parseInt(values[0]);
            const maxAllowed = 100 - (totalExpertise - currentPercent);
            if (val > maxAllowed) {
                sliderEl.noUiSlider.set(maxAllowed);
                val = maxAllowed;
            }
            $("#sliderValue").text(val + "%");
        });

        // Save
        $("#saveServiceSlider").on("click", function () {
            const val = parseInt(sliderEl.noUiSlider.get());
            const desc = $("#serviceDescription").val();
            callback(val, desc);
            $("#serviceSliderPopup").remove();
            updateTotal();
        });

        // Close
        $("#closeServiceSlider").on("click", function () {
            $("#serviceSliderPopup").remove();
        });
    }

    //! Add new service
    $(document).on("click", ".add-service-btn", function () {
        const serviceItem = $(this).closest(".service-item");
        const id = serviceItem.data("id");
        const name = serviceItem.data("name");

        if ($("#serviceTags .service-tag[data-id='" + id + "']").length > 0) {
            Swal.fire("Oops!", "This service is already added.", "info");
            return;
        }
        if ($("#serviceTags .service-tag").length >= MAX_SERVICES) {
            Swal.fire(
                "Limit Reached",
                `You can only add up to ${MAX_SERVICES} services.`,
                "info",
            );
            return;
        }
        const remaining = 100 - totalExpertise;
        if (remaining <= 0) {
            Swal.fire(
                "Limit Reached",
                "You already used 100% expertise.",
                "info",
            );
            return;
        }

        openServiceSlider(name, 0, "", function (percent, description) {
            const tagHtml = `
        <div class="service-tag sm:px-4 sm:py-2 px-2 py-1 bg-(--color-surface) rounded-xl cursor-pointer flex items-center justify-center outline outline-transparent hover:outline-(--color-primary) hover:scale-[1.01] transition"
            data-id="${id}" data-name="${name}" data-percent="${percent}" data-description="${description}">
            ${name} — <span class="tag-percent ml-1 text-blue-500">${percent}%</span>
            <button type="button"
                class="remove-service text-(--color-error) text-[8px] sm:text-xs bg-(--color-error-100) hover:bg-(--color-error) hover:text-(--color-text) active:text-(--color-text) transition sm:w-8 sm:h-8 w-5 h-5 rounded-full flex items-center justify-center font-bold cursor-pointer ml-4">
                <i class="fa-solid fa-x"></i>
            </button>
            <input type="hidden" name="services[${id}][expertise_percentage]" class="service-input-percent" value="${percent}">
            <input type="hidden" name="services[${id}][description]" class="service-input-description" value="${description}">
        </div>`;
            $("#serviceTags").append(tagHtml);
            updateTotal();
        });
    });

    $(document).on("click", ".service-tag", function (e) {
        if ($(e.target).closest(".remove-service").length) return;

        const tag = $(this);
        const name = tag.data("name");
        const currentPercent = tag.data("percent") || 0;
        const currentDescription = tag.data("description") || "";

        openServiceSlider(
            name,
            currentPercent,
            currentDescription,
            function (newPercent, newDescription) {
                tag.data("percent", newPercent);
                tag.data("description", newDescription);
                tag.find(".tag-percent").text(newPercent);
                tag.find(".service-input-percent").val(newPercent);
                tag.find(".service-input-description").val(newDescription);
                updateTotal();
            },
        );
    });
});
