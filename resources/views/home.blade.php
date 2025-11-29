@extends('shared.main')
@section('content')
    {{-- ! Hero Section --}}
    <div class="section w-full max-w-[1920px] flex flex-col gap-4 p-[50px] mt-32 max-[720px]:p-5">
        <h1 class="text-4xl sm:text-4xl md:text-5xl lg:text-6xl max-w-[900px] 
           text-black font-black">
            Where <span class="text-lime-700">Businesses</span>
            Meet Their Ideal Development
            <span class="text-lime-700">Partners</span>
        </h1>

        <p class="text-black w-full leading-4 max-w-[900px] font-semibold">At topratedcompanies, we cut through market noise
            and simplify
            your
            search with curating
            credible, experienced, and dependable companies.
            Explore comprehensive profiles and choose your next partner with clarity and confidence.
        </p>
        <p class="text-black w-full max-w-[900px] font-semibold">Explore comprehensive profiles and choose your next partner
            with
            clarity and confidence.
        </p>
        <div class="flex items-start gap-2">
            <span class="flex gap-2 flex-wrap">
                <input type="text"
                    class="bg-transparent outline-1 max-[720px]:grow py-4 focus:placeholder:text-lime-500/20 font-semibold text-lime-700 placeholder:font-semibold outline-lime-700 placeholder:text-lime-700 border-0 px-3 rounded-md"
                    placeholder="Service your need">
                <input type="text"
                    class="bg-transparent outline-1 max-[720px]:grow py-4 focus:placeholder:text-lime-500/20 font-semibold text-lime-700 placeholder:font-semibold outline-lime-700 placeholder:text-lime-700 border-0 px-3 rounded-md"
                    placeholder="Where do you live">
            </span>
            <span class="bg-lime-700 px-3 hover:bg-lime-500 py-3 font-black text-lime-900 rounded-md scale-x-[-1]"><svg
                    width="30" height="30" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M37.5667 40.25L25.4917 28.175C24.5333 28.9417 23.4312 29.5486 22.1854 29.9958C20.9396 30.4431 19.6139 30.6667 18.2083 30.6667C14.7264 30.6667 11.7795 29.4608 9.36771 27.049C6.9559 24.6372 5.75 21.6903 5.75 18.2083C5.75 14.7264 6.9559 11.7795 9.36771 9.36771C11.7795 6.9559 14.7264 5.75 18.2083 5.75C21.6903 5.75 24.6372 6.9559 27.049 9.36771C29.4608 11.7795 30.6667 14.7264 30.6667 18.2083C30.6667 19.6139 30.4431 20.9396 29.9958 22.1854C29.5486 23.4312 28.9417 24.5333 28.175 25.4917L40.25 37.5667L37.5667 40.25ZM18.2083 26.8333C20.6042 26.8333 22.6406 25.9948 24.3177 24.3177C25.9948 22.6406 26.8333 20.6042 26.8333 18.2083C26.8333 15.8125 25.9948 13.776 24.3177 12.099C22.6406 10.4219 20.6042 9.58333 18.2083 9.58333C15.8125 9.58333 13.776 10.4219 12.099 12.099C10.4219 13.776 9.58333 15.8125 9.58333 18.2083C9.58333 20.6042 10.4219 22.6406 12.099 24.3177C13.776 25.9948 15.8125 26.8333 18.2083 26.8333Z"
                        class="fill-lime-200" />
                </svg>
            </span>
        </div>
        <div class="flex gap-2 flex-wrap">
            <span
                class="bg-lime-950 text-lime-500 flex justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                Graphic Designs

                <svg width="12" height="12" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 34L34 14M34 14H14M34 14V34" class="stroke-lime-500" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

            </span>
            <span
                class="bg-lime-950 text-lime-500 flex justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                Web Development

                <svg width="12" height="12" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 34L34 14M34 14H14M34 14V34" class="stroke-lime-500" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

            </span>
            <span
                class="bg-lime-950 text-lime-500 flex justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                SEO

                <svg width="12" height="12" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 34L34 14M34 14H14M34 14V34" class="stroke-lime-500" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

            </span>
            <span
                class="bg-lime-950 text-lime-500 flex justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                Video Editing

                <svg width="12" height="12" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 34L34 14M34 14H14M34 14V34" class="stroke-lime-500" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

            </span>
            <span
                class="bg-lime-950 text-lime-500 flex justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                Website Designing

                <svg width="12" height="12" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 34L34 14M34 14H14M34 14V34" class="stroke-lime-500" stroke-width="4" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

            </span>
        </div>
    </div>
    {{-- ! Services Section --}}
    <div class="section w-full max-w-[1920px] flex flex-col gap-4 p-[50px] mt-20 max-[720px]:p-5">
        <h1 class="text-4xl text-gray-950 font-black">Expand <span class="text-lime-700"> Technology</span> Services Directory
        </h1>
        <div class="flex flex-wrap gap-2 category-badges-container"></div>
        <div class="bg-lime-950/20 text-lime-500 flex flex-col gap-2 w-full p-3 rounded-md">
            <h1 id="currentCategory" class="text-2xl font-black text-gray-950">Software Development</h1>
            <div class="flex flex-wrap gap-2 links-container"></div>
        </div>
    </div>
    {{-- ! How it works --}}
    <div
        class="section w-full max-w-[1920px] flex justify-between max-[910px]:justify-center gap-2 items-center flex-wrap p-[50px] max-[720px]:p-5 max-[720px]:flex-col">
        <div class="card flex flex-col gap-2 w-full max-w-[400px] p-2 rounded-md">
            <h1 class="text-5xl font-bold text-lime-700">
                How It Works
            </h1>
            <p class="text-gray-950 font-semibold">
                We connect buyers and vendors by providing them with the most trusted, reliable, and insightful content
                available, helping both sides make confident and informed decisions.
            </p>
            <button class="bg-lime-700 p-2 text-center font-bold text-white rounded-md">Watch Top Companies</button>
            <button class="outline-lime-700 outline-2 p-2 text-center font-bold text-lime-700 rounded-md">Get Help</button>
        </div>
        <div class="card relative flex flex-col gap-2 w-full max-w-[400px] hover:bg-lime-700/50 p-2 rounded-md">
            <img class="w-[400px] aspect-video object-cover rounded"
                src="https://img.freepik.com/free-photo/colleagues-working-project-discussing-details_114579-2817.jpg?t=st=1763479584~exp=1763483184~hmac=7af7a3602e294d4a89844615ea69929bfca37051b00c55f0a03b88aa2e794cb1&w=1060"
                alt="">
            <h1 class="text-xl font-bold text-lime-700">
                Define important parameters
            </h1>
            <p class="text-gray-950 font-semibold">
                Start by identifying the key parameters and requirements for your project
            </p>
            <span
                class="bg-lime-700 aspect-square absolute w-[50px] flex items-center justify-center font-bold text-white rounded-md m-2 top-0 left-0 p-2">1</span>
        </div>
        <div class="card relative flex flex-col gap-2 w-full max-w-[400px] hover:bg-lime-700/50 p-2 rounded-md">
            <img class="w-[400px] aspect-video object-cover rounded"
                src="https://img.freepik.com/free-photo/female-hand-typing-keyboard-laptop_1150-15742.jpg?t=st=1763480073~exp=1763483673~hmac=685bef002edd1687dd7b588d41c71d42eefee740df9863ed2b2bbd59aa93db89&w=740"
                alt="">
            <h1 class="text-xl font-bold text-lime-700">
                Study the options
            </h1>
            <p class="text-black font-semibold">
                Review top companies their case studies, services, and capabilities
            </p>
            <span
                class="bg-lime-700 aspect-square absolute w-[50px] flex items-center justify-center font-bold text-white rounded-md m-2 top-0 left-0 p-2">2</span>
        </div>
        <div class="card relative flex flex-col gap-2 w-full max-w-[400px] hover:bg-lime-700/50 p-2 rounded-md">
            <img class="w-[400px] aspect-video object-cover rounded"
                src="https://img.freepik.com/free-photo/front-view-business-man-holding-tablet_23-2150103598.jpg?t=st=1763480258~exp=1763483858~hmac=22477c833b9e10cb60d895f4a7227ad6c983d5e53dd6db0992037a41b6109d25&w=740"
                alt="">
            <h1 class="text-xl font-bold text-lime-700">
                Study a company’s details
            </h1>
            <p class="text-black font-semibold">
                Review each company's profile to ensure they meet your expectations and needs
            </p>
            <span
                class="bg-lime-700 aspect-square absolute w-[50px] flex items-center justify-center font-bold text-white rounded-md m-2 top-0 left-0 p-2">3</span>
        </div>
        <div class="card relative flex flex-col gap-2 w-full max-w-[400px] hover:bg-lime-700/50 p-2 rounded-md">
            <img class="w-[400px] aspect-video object-cover rounded"
                src="https://img.freepik.com/free-photo/business-women-signature-document_1388-90.jpg?t=st=1763480323~exp=1763483923~hmac=915ac3828db4b8560409aa372425116d7c8e1e9f43794d84e567b0d77ce15a2c&w=740"
                alt="">
            <h1 class="text-xl font-bold text-lime-700">
                Shortlist companies
            </h1>
            <p class="text-black font-semibold">
                Shortlist companies that fit your needs and project easily
            </p>
            <span
                class="bg-lime-700 aspect-square absolute w-[50px] flex items-center justify-center font-bold text-white rounded-md m-2 top-0 left-0 p-2">4</span>
        </div>
        <div class="card relative flex flex-col gap-2 w-full max-w-[400px] hover:bg-lime-700/50 p-2 rounded-md">
            <img class="w-[400px] aspect-video object-cover rounded"
                src="https://img.freepik.com/free-photo/businessman-handshaking-businesswoman-showing-respect-closeup-view-hands-shaking_1163-4679.jpg?t=st=1763480429~exp=1763484029~hmac=ac218bd01b5112f29e3aaf87f469044eb877d28328455877b031290e8dbada71&w=740"
                alt="">
            <h1 class="text-xl font-bold text-lime-700">
                Partner with the Best
            </h1>
            <p class="text-black font-semibold">
                Select the top company from your shortlist and start building your partnership
            </p>
            <span
                class="bg-lime-700 aspect-square absolute w-[50px] flex items-center justify-center font-bold text-white rounded-md m-2 top-0 left-0 p-2">5</span>
        </div>
    </div>
    {{-- ! Insight Section --}}
    <div class="section w-full max-w-[1920px] flex flex-col gap-4 p-[50px] max-[720px]:p-5">
        <h1 class="text-4xl text-black font-black">Insights & <span class="text-lime-700">Advice</span></h1>
        <div class="flex w-full flex-wrap gap-2">
            <div class="flex flex-col justify-between grow gap-1 w-[300px] hover:bg-lime-700/50 p-2 rounded-md">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRiCNVtAT_eenIcH3kok4iNFaywR8dCmmIqqg&s"
                    class="w-full h-[250px] object-cover rounded-md" alt="">
                <h2 class="text-xl text-black font-bold">How AI Reshaping Development Workflows in 2025</h2>
                <p class="text-sm font-semibold text-black">In the era of AI-driven development, Techreviewer conducts
                    online
                    surveys to track real-world trends in software engineering. We leverage our global network of top
                    software development companies to assess the impact of AI on the development workflow.</p>
                <div class="flex justify-between items-center">
                    <span
                        class="bg-lime-700 text-white flex w-fit justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                        Research


                    </span>
                    <span
                        class="bg-lime-700 text-white flex w-fit justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                        17/11/2025 by TRC
                    </span>
                </div>
            </div>
            <div class="flex flex-col justify-between grow gap-1 w-[300px] hover:bg-lime-700/50 p-2 rounded-md">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJklFQ7Zh3wQN0KEZbTz_g1iNFUD3PlqmyuA&s"
                    class="w-full h-[250px] object-cover rounded-md" alt="">
                <h2 class="text-xl text-black font-bold">Key Challenges in Medical Software Development: Navigating
                    Regulatory
                    Compliance and Data Privacy</h2>
                <p class="text-sm font-semibold text-black">Software has quietly become the foundation of modern
                    healthcare.
                    From
                    electronic medical records (EMR) systems and telemedicine apps to artificial intelligence tools that
                    now aid in diagnostics, digital technologies are changing the way healthcare is delivered and
                    managed.</p>
                <div class="flex justify-between items-center">
                    <span
                        class="bg-lime-700 text-white flex w-fit justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                        Research


                    </span>
                    <span
                        class="bg-lime-700 text-white flex w-fit justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                        17/11/2025 by TRC
                    </span>
                </div>
            </div>
            <div class="flex flex-col justify-between grow gap-1 w-[300px] hover:bg-lime-700/50 p-2 rounded-md">
                <img src="https://res.cloudinary.com/dthpnue1d/image/upload/v1736932887/How_Much_Does_AI_Software_Development_Cost_A_Budgeting_Blueprint_for_Businesses_Banner_9ae66f6c89.webp"
                    class="w-full h-[250px] object-cover rounded-md" alt="">
                <h2 class="text-xl text-black font-bold">AI in Software Development 2025: From Exploration to
                    Accountability –
                    Survey-Based Analysis</h2>
                <p class="text-sm font-semibold text-black">For the second year in a row, Techreviewer conducts an online
                    survey on
                    the role of AI in software development. We leverage our global network of software development
                    providers to capture how Artificial Intelligence adoption is evolving across teams, geographies, and
                    company sizes. </p>
                <div class="flex justify-between items-center">
                    <span
                        class="bg-lime-700 text-white flex w-fit justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                        Research


                    </span>
                    <span
                        class="bg-lime-700 text-white flex w-fit justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                        17/11/2025 by TRC
                    </span>
                </div>
            </div>
            <div class="flex flex-col justify-between grow gap-1 w-[300px] hover:bg-lime-700/50 p-2 rounded-md">
                <img src="https://img.freepik.com/free-photo/futuristic-ai-chip-circuit-board_23-2151977487.jpg?t=st=1763474986~exp=1763478586~hmac=4243c7c6de6755b36439260d4f10abb08794a89db6f46ea661771f8555bc8b74&w=1060"
                    class="w-full h-[250px] object-cover rounded-md" alt="">
                <h2 class="text-xl text-black font-bold">AI in Software Development 2025: From Exploration to
                    Accountability –
                    Survey-Based Analysis</h2>
                <p class="text-sm font-semibold text-black">For the second year in a row, Techreviewer conducts an online
                    survey on
                    the role of AI in software development. We leverage our global network of software development
                    providers to capture how Artificial Intelligence adoption is evolving across teams, geographies, and
                    company sizes. </p>
                <div class="flex justify-between items-center">
                    <span
                        class="bg-lime-700 text-white flex w-fit justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                        Research


                    </span>
                    <span
                        class="bg-lime-700 text-white flex w-fit justify-center hover:bg-lime-900 items-center gap-2 text-xs px-2 py-2 font-medium rounded-md cursor-pointer">
                        17/11/2025 by TRC
                    </span>
                </div>
            </div>
        </div>

    </div>
    {{-- ! Ready --}}
    <div
        class="section w-full max-w-[1920px] items-center bg-lime-700 flex gap-4 p-[50px] max-[720px]:p-5 max-[720px]:flex-col">
        <img class="w-[150px] h-[150px] object-cover rounded-md"
            src="https://s3.amazonaws.com/cdn.designcrowd.com/blog/40-Brand-Logos-for-Creative-and-Cool-Companies/orange-electronics-company-by-ions-brandcrowd.png"
            alt="">
        <div class="flex flex-col max-[720px]:items-center">
            <h1 class="text-6xl text-white w-fit text-center font-bold">Ready to start?</h1>
            <h1 class="text-4xl text-white w-fit text-center font-bold">Create your company profile for free</h1>
            <button
                class="flex justify-center gap-2 items-center w-fit bg-lime-900 p-3 text-center font-semibold text-white rounded-md">
                Watch Top Companies
                <svg width="22" height="22" viewBox="0 0 48 48" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 34L34 14M34 14H14M34 14V34" class="stroke-white" stroke-width="5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>
    {{-- ! Faq Section --}}
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
    {{-- <div class="w-full mb-[13000px] text-white"></div> --}}
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/services.js') }}"></script>
    <script src="{{ asset('assets/js/accordian.js') }}"></script>
@endpush
