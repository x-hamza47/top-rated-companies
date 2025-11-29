document.addEventListener("DOMContentLoaded", () => {
    const faqContainer = document.querySelector(".faq-container");
    const questions = faqContainer.querySelectorAll(".question");
    const answers = faqContainer.querySelectorAll(".answer");

    // Open first FAQ by default
    if (answers[0]) {
        answers[0].classList.add("open");
        // answers[0].style.maxHeight = answers[0].scrollHeight + "px";
        toggleIcon(questions[0], true);
    }

    questions.forEach((q, idx) => {
        q.addEventListener("click", () => {
            const answer = answers[idx];
            const isOpen = answer.classList.contains("open");

            // Close all others (optional: remove this block for multi-open)
            answers.forEach((a, i) => {
                if (i !== idx && a.classList.contains("open")) {
                    a.classList.remove("open");
                    // a.style.maxHeight = "0px";
                    toggleIcon(questions[i], false);
                }
            });

            // Toggle current
            if (isOpen) {
                answer.classList.remove("open");
                // answer.style.maxHeight = "0px";
                toggleIcon(q, false);
            } else {
                answer.classList.add("open");
                // answer.style.maxHeight = answer.scrollHeight + "px";
                toggleIcon(q, true);

                // Update max-height on content change (images, etc.)
                const updateHeight = () => {
                    if (answer.classList.contains("open")) {
                        // answer.style.maxHeight = answer.scrollHeight + "px";
                    }
                };

                // Handle dynamic content (like images loading)
                const images = answer.querySelectorAll("img");
                images.forEach((img) => {
                    if (img.complete) {
                        updateHeight();
                    } else {
                        img.addEventListener("load", updateHeight);
                    }
                });
            }
        });
    });

    function toggleIcon(question, isOpen) {
        const svg = question.querySelector(".accordian-action");
        if (!svg) return;

        const rotation = isOpen ? "rotate-0" : "rotate-90";
        svg.classList.toggle("rotate-90", !isOpen);

        if (isOpen) {
            // Minus icon
            svg.innerHTML = `<svg width="26" height="26" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                            class="icon transition-transform duration-300">
                            <path d="M19,13H5a1,1,0,0,1,0-2H19a1,1,0,0,1,0,2Z" class="stroke-lime-700" stroke-width="2"
                                stroke-linecap="round"></path>
                        </svg>`;
        } else {
            // Plus icon
            svg.innerHTML = ` <svg width="26" height="26" viewBox="0 0 48 48" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="icon transition-transform duration-300">
                            <path d="M24 10V38M10 24H38" class="stroke-lime-700" stroke-width="6" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>`;
        }
    }

    // Optional: Adjust height if window resizes
    window.addEventListener("resize", () => {
        answers.forEach((answer, idx) => {
            if (answer.classList.contains("open")) {
                // answer.style.maxHeight = answer.scrollHeight + "px";
            }
        });
    });
});
