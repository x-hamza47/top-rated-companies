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

    function openServiceSlider(tagName, currentPercent, callback) {
        const popup = $(`
        <div id="serviceSliderPopup" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 px-3">
            <div class="bg-(--color-background) p-6 rounded-xl shadow-lg relative w-2/6 min-w-2xs">
                <h3 class="text-lg text font-semibold text-center mb-7">Set expertise for ${tagName}</h3>
                <div class="slider" id="serviceSlider"></div>
                <div class="mt-4 flex justify-between items-center">
                    <span id="sliderValue">${currentPercent}%</span>
                    <button id="saveServiceSlider" class="bg-(--color-primary) text-white px-4 py-1 rounded">Save</button>
                </div>
                <button id="closeServiceSlider" class="absolute top-2 right-2 text-(--color-error) hover:text-gray-700 w-5 h-5 pb-0.5 flex items-center justify-center  rounded-full bg-(--color-error-100)">&times;</button>
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

        //? Save
        $("#saveServiceSlider").on("click", function () {
            const val = parseInt(sliderEl.noUiSlider.get());
            callback(val);
            $("#serviceSliderPopup").remove();
            updateTotal();
        });

        //? Close
        $("#closeServiceSlider").on("click", function () {
            $("#serviceSliderPopup").remove();
        });
    }

    //! Add new service
    $(document).on("click", ".add-service-btn", function () {
        console.log("hello");

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
                "info"
            );
            return;
        }

        const remaining = 100 - totalExpertise;
        if (remaining <= 0) {
            Swal.fire(
                "Limit Reached",
                "You already used 100% expertise.",
                "info"
            );
            return;
        }

        openServiceSlider(name, 0, function (percent) {
            const tagHtml = `
            <div class="service-tag flex items-center justify-between bg-(--color-surface) rounded-xl px-4 py-2 my-1" data-id="${id}" data-percent="${percent}">
                <span>${name} — <span class="tag-percent text-blue-500">${percent}</span>%</span>
                <input type="hidden" name="services[${id}]" class="service-input" value="${percent}">
                <button type="button" class="remove-service text-red-500 ml-4"><i class="fa-solid fa-x"></i></button>
            </div>`;
            $("#serviceTags").append(tagHtml);
            updateTotal();
        });
    });

    $(document).on("click", ".service-tag", function (e) {
        if ($(e.target).hasClass("remove-service")) return;

        const tag = $(this);
        // const id = tag.data("id");
        const name = tag.data("name");
        const currentPercent = tag.data("percent") || 0;

        openServiceSlider(name, currentPercent, function (newPercent) {
            tag.data("percent", newPercent);
            tag.find(".tag-percent").text(newPercent);
            tag.find(".service-input").val(newPercent);
            updateTotal();
        });
    });
});
