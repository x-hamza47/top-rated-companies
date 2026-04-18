import { initFaqAccordion } from "./shared";

const faqsData = [
    {
        question: "How to Pick the Perfect Software Development Partner?",
        answer: "Finding the right development team can transform your project from good to exceptional. This guide highlights what to look for, that is, experience, proven results, and smooth collaboration, so you are able to collaborate with confidence and achieve your goals faster.",
    },
    {
        question: "What are IT Outsourcing Trends You Can’t Ignore in 2026?",
        answer: "The outsourcing landscape is evolving at lightning speed. From flexible team models to cost-efficient solutions, this article uncovers the latest trends that are helping businesses expand smartly and remain a step ahead of the competition.",
    },
    {
        question: "How to Get the Most Value from Your Software Projects?",
        answer: "Software is an investment, and every investment should deliver results. This piece shares practical tips to maximize ROI, from setting clear objectives to choosing the right partners, making sure that every project drives real business impact.",
    },
];

const faqContainer = document.getElementById("faqContainer");

faqContainer.innerHTML = faqsData
    .map(
        (faq, index) => `
                <div class="faq-item flex flex-col items-start w-full" data-index="${index}">
                    <div class="faq-header flex items-center justify-between w-full cursor-pointer bg-linear-to-r from-(--color-primary-50) to-(--color-background) border border-lime-200 p-4 rounded transition-all">
                        <p class="text-sm">${faq.question}</p>
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
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </div>
                    <p class="faq-answer text-sm text-(--color-text)/70 px-4 overflow-hidden max-h-0 opacity-0 -translate-y-2 transition-all duration-500 ease-in-out">
                        ${faq.answer}
                    </p>
                </div>
    `,
    )
    .join("");

let openIndex = null;
initFaqAccordion();
