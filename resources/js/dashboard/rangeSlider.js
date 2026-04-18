document.querySelectorAll(".slider-container").forEach((container) => {
    const sliderEl = container.querySelector(".slider");

    const isSingle = container.dataset.single === "true";
    const step = parseInt(container.dataset.step);
    const min = parseInt(container.dataset.min);
    const max = parseInt(container.dataset.max);

    let start;
    if (isSingle) {
        start = parseInt(container.dataset.start);
    } else {
        start = [
            parseInt(container.dataset.startMin),
            parseInt(container.dataset.startMax),
        ];
    }

    // Create slider
    noUiSlider.create(sliderEl, {
        start: start,
        connect: isSingle ? [true, false] : true,
        step: step,
        range: {
            min: min,
            max: max,
        },
        tooltips: isSingle ? true : [true, true],
        format: {
            to: function (value) {
                return parseInt(value);
            },
            from: function (value) {
                return Number(value);
            },
        },
    });

    if (isSingle) {
        const input = document.querySelector(container.dataset.input);
        const hidden = document.querySelector(container.dataset.hidden);

        // Sync slider -> input
        sliderEl.noUiSlider.on("update", function (values) {
            const val = parseInt(values[0]);
            input.value = val;
            hidden.value = val;
        });

        // Sync input -> slider
        input.addEventListener("change", function () {
            let val = parseInt(this.value);
            if (val < min) val = min;
            if (val > max) val = max;
            sliderEl.noUiSlider.set(val);
        });
    } else {
        const inputMin = document.querySelector(container.dataset.inputMin);
        const inputMax = document.querySelector(container.dataset.inputMax);
        const hiddenMin = document.querySelector(container.dataset.hiddenMin);
        const hiddenMax = document.querySelector(container.dataset.hiddenMax);

        // Sync slider -> inputs
        sliderEl.noUiSlider.on("update", function (values) {
            const valMin = parseInt(values[0]);
            const valMax = parseInt(values[1]);
            inputMin.value = valMin;
            inputMax.value = valMax;
            hiddenMin.value = valMin;
            hiddenMax.value = valMax;
        });

        // Sync inputs -> slider
        inputMin.addEventListener("change", function () {
            let val = parseInt(this.value);
            if (val < min) val = min;
            if (val > max) val = max;
            sliderEl.noUiSlider.set([val, null]);
        });
        inputMax.addEventListener("change", function () {
            let val = parseInt(this.value);
            if (val < min) val = min;
            if (val > max) val = max;
            sliderEl.noUiSlider.set([null, val]);
        });
    }
});
