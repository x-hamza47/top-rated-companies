const faqsData = [
    {
        question: "Lightning-Fast Performance",
        answer: "Built with speed — minimal load times and optimized rendering.",
    },
    {
        question: "Fully Customizable Components",
        answer: "Easily adjust styles, structure, and behavior to match your project needs.",
    },
    {
        question: "Responsive by Default",
        answer: "Every component is responsive by default — no extra CSS required.",
    },
    {
        question: "Tailwind CSS Powered",
        answer: "Built using Tailwind utility classes — no extra CSS or frameworks required.",
    },
    {
        question: "Dark Mode Support",
        answer: "All components come ready with light and dark theme support out of the box.",
    },
];

const faqContainer = document.getElementById("faqContainer");

faqContainer.innerHTML = faqsData
    .map(
        (faq, index) => `
                <div class="faq-item flex flex-col items-start w-full" data-index="${index}">
                    <div class="faq-header flex items-center justify-between w-full cursor-pointer bg-linear-to-r from-lime-50 to-white border border-lime-200 p-4 rounded transition-all">
                        <h2 class="text-sm">${faq.question}</h2>
                        <svg
                            class="faq-icon transition-all duration-500 ease-in-out"
                            width="18"
                            height="18"
                            viewBox="0 0 18 18"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="m4.5 7.2 3.793 3.793a1 1 0 0 0 1.414 0L13.5 7.2"
                                stroke="#1D293D"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </div>
                    <p class="faq-answer text-sm text-slate-500 px-4 overflow-hidden max-h-0 opacity-0 -translate-y-2 transition-all duration-500 ease-in-out">
                        ${faq.answer}
                    </p>
                </div>
    `
    )
    .join("");

let openIndex = null;

document.querySelectorAll(".faq-header").forEach((header, index) => {
    header.addEventListener("click", () => {
        const allAnswers = document.querySelectorAll(".faq-answer");
        const allIcons = document.querySelectorAll(".faq-icon");

        allAnswers.forEach((el, i) => {
            if (i === index) {
                const isOpen = el.classList.contains("opacity-100");
                el.classList.toggle("opacity-100", !isOpen);
                el.classList.toggle("max-h-[300px]", !isOpen);
                el.classList.toggle("translate-y-0", !isOpen);
                el.classList.toggle("pt-4", !isOpen);
                el.classList.toggle("max-h-0", isOpen);
                el.classList.toggle("-translate-y-2", isOpen);
                allIcons[i].classList.toggle("rotate-180", !isOpen);
            } else {
                el.classList.remove(
                    "opacity-100",
                    "max-h-[300px]",
                    "translate-y-0",
                    "pt-4"
                );
                el.classList.add("max-h-0", "-translate-y-2");
                allIcons[i].classList.remove("rotate-180");
            }
        });
    });
});
