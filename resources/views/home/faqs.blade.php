<div class="section w-full max-w-[1920px] flex flex-col gap-4 p-[50px] max-[720px]:p-5">
        <h1 class="text-4xl text-black font-black">Frequently asked <span class="text-lime-700">Questions</span></h1>
        <div class="flex flex-col faq-container">
            <!-- FAQ Item 1 -->
            <span
                class="question text-xl font-medium p-3 rounded-md hover:bg-lime-900/50 text-black flex justify-between items-center cursor-pointer">
                What is an accordion in web design?
                <span class="accordian-action">
                    <svg width="26" height="26" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                        class="icon transition-transform duration-300">
                        <path d="M19,13H5a1,1,0,0,1,0-2H19a1,1,0,0,1,0,2Z" class="stroke-lime-700" stroke-width="2"
                            stroke-linecap="round"></path>
                    </svg>
                </span>
            </span>
            <span class="answer text-lg font-semibold text-lime-700 bg-lime-900/50 p-3 rounded-md overflow-hidden max-h-0">
                An accordion is a UI component that allows users to expand and collapse sections of content, saving
                space and improving readability.
            </span>

            <!-- FAQ Item 2 -->
            <span
                class="question text-xl font-medium p-3 rounded-md hover:bg-lime-900/50 text-black flex justify-between items-center cursor-pointer">
                How does JavaScript toggle the FAQ?
                <span class="accordian-action">
                    <svg width="26" height="26" viewBox="0 0 48 48" fill="none"
                        xmlns="http://www.w3.org/2000/svg" class="icon transition-transform duration-300">
                        <path d="M24 10V38M10 24H38" class="stroke-lime-700" stroke-width="6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg></span>
            </span>
            <span class="answer text-lg font-semibold text-lime-700 bg-lime-900/50 p-3 rounded-md overflow-hidden max-h-0">
                JavaScript listens for click events on question elements and toggles the <code>max-height</code> of the
                black corresponding answer, while updating the icon.
            </span>

            <!-- FAQ Item 3 -->
            <span
                class="question text-xl font-medium p-3 rounded-md hover:bg-lime-900/50 text-black flex justify-between items-center cursor-pointer">
                Can I use Tailwind CSS for animations?
                <span class="accordian-action">
                    <svg width="26" height="26" viewBox="0 0 48 48" fill="none"
                        xmlns="http://www.w3.org/2000/svg" class="icon transition-transform duration-300">
                        <path d="M24 10V38M10 24H38" class="stroke-lime-700" stroke-width="6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg></span>
            </span>
            <span class="answer text-lg font-semibold text-lime-700 bg-lime-900/50 p-3 rounded-md overflow-hidden max-h-0">
                Yes! Tailwind supports transitions via utility classes. We use <code>transition-[max-height]</code> and
                <code>duration-500</code> for smooth effects.
            </span>

            <!-- FAQ Item 4 -->
            <span
                class="question text-xl font-medium p-3 rounded-md hover:bg-lime-900/50 text-black flex justify-between items-center cursor-pointer">
                Why use scrollHeight instead of fixed height?
                <span class="accordian-action">
                    <svg width="26" height="26" viewBox="0 0 48 48" fill="none"
                        xmlns="http://www.w3.org/2000/svg" class="icon transition-transform duration-300">
                        <path d="M24 10V38M10 24H38" class="stroke-lime-700" stroke-width="6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg></span>
            </span>
            <span class="answer text-lg font-semibold text-lime-700 bg-lime-900/50 p-3 rounded-md overflow-hidden max-h-0">
                <code>scrollHeight</code> dynamically calculates the full height of content, making the accordion
                responsive to any text length.
            </span>

            <!-- FAQ Item 5 -->
            <span
                class="question text-xl font-medium p-3 rounded-md hover:bg-lime-900/50 text-black flex justify-between items-center cursor-pointer">
                Is this FAQ mobile-friendly?
                <span class="accordian-action">
                    <svg width="26" height="26" viewBox="0 0 48 48" fill="none"
                        xmlns="http://www.w3.org/2000/svg" class="icon transition-transform duration-300">
                        <path d="M24 10V38M10 24H38" class="stroke-lime-700" stroke-width="6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg></span>
            </span>
            <span class="answer text-lg font-semibold text-lime-700 bg-lime-900/50 p-3 rounded-md overflow-hidden max-h-0">
                Absolutely! Built with Tailwind's responsive classes and flexible layout, it works perfectly on phones,
                tablets, and desktops.
            </span>

            <!-- FAQ Item 6 -->
            <span
                class="question text-xl font-medium p-3 rounded-md hover:bg-lime-900/50 text-black flex justify-between items-center cursor-pointer">
                Can I add images or code blocks inside answers?
                <span class="accordian-action">
                    <svg width="26" height="26" viewBox="0 0 48 48" fill="none"
                        xmlns="http://www.w3.org/2000/svg" class="icon transition-transform duration-300">
                        <path d="M24 10V38M10 24H38" class="stroke-lime-700" stroke-width="6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg></span>
            </span>
            <span class="answer text-lg font-semibold text-lime-700 bg-lime-900/50 p-3 rounded-md overflow-hidden max-h-0">
                Yes! You can include or code
            </span>

            <!-- FAQ Item 7 -->
            <span
                class="question text-xl font-medium p-3 rounded-md hover:bg-lime-900/50 text-black flex justify-between items-center cursor-pointer">
                How do I customize the colors and speed?
                <span class="accordian-action">
                    <svg width="26" height="26" viewBox="0 0 48 48" fill="none"
                        xmlns="http://www.w3.org/2000/svg" class="icon transition-transform duration-300">
                        <path d="M24 10V38M10 24H38" class="stroke-lime-700" stroke-width="6" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg></span>
            </span>
            <span class="answer text-lg font-medium text-lime-700 bg-lime-900/50 p-3 rounded-md overflow-hidden max-h-0">
                Change <code>text-lime-400</code>, <code>bg-lime-900/50</code>, and <code>duration-500</code> in
                Tailwind classes. For JS speed, adjust <code>setTimeout</code> delay if needed.
            </span>
        </div>

    </div>