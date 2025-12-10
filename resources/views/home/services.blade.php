<div class="section flex flex-col">
    {{-- Header --}}
    <div class="text-center mb-2">
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold">Browse <span class="text-(--primary)">Services</span></h2>
        <p class=" w-11/12 text-sm md:text-base font-semibold mt-3 mx-auto">Unfold a broad range of professional services
            that
            are tailored to different business needs. Each
            category
            highlights companies with proven capabilities, which helps you compare options and shortlist partners with
            confidence.
            Start exploring –your ideal team may be just a click away.
        </p>
    </div>
    {{-- Info: Cards --}}
    <div
        class="card-wrapper  my-4 lg:gap-x-20 md:gap-x-15 gap-x-5 gap-y-10 [&>div]:hover:border-lime-700 mobile-cards grid grid-cols-2 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-3 justify-items-center items-center relative">
        @foreach ($categories as $category)
            <div
                class="card relative rounded-md border-2 border-gray-500/40 flex flex-col sm:px-5 sm:py-4 px-3 py-2 gap-2 shadow-2xl w-full h-full">
                <button class="close-btn absolute top-2 right-2 text-xl font-bold hidden"><i
                        class="fa-solid fa-xmark  text-gray-500"></i></button>
                <div class="card-title flex items-center gap-2 ">
                    <span class="bg-(--primary) px-1 py-1.5 rounded-md flex items-center justify-center">
                        <i class="fa-solid {{ $category->icon }} text-white text-3xl"></i>
                    </span>
                    <h3 class="text-2xl font-bold text-(--secondary) text-center">{{ $category->name }}</h3>
                </div>
                <div class="card-links mt-4 flex flex-col text-gray-600 font-bold gap-1">
                    <ul
                        class="[&>li]:list-disc [&>li]:list-inside  [&>li]:mb-2 [&>li]:hover:text-(--light-primary) [&>li>*]:hover:text-(--light-primary)">
                        @foreach ($category->subCategories as $sub)
                            <li><a href="{{ route('services.companies', $sub->slug) }}">{{ $sub->name }}</a></li>
                        @endforeach
                    </ul>

                </div>
                <a href=""
                    class="bg-(--secondary) cursor-pointer text-white w-full text-center rounded-md py-2 hover:bg-(--light-primary) font-semibold ">
                    View More
                </a>
            </div>
        @endforeach
    </div>
</div>

@push('script')
    <script>
        const cards = document.querySelectorAll(".mobile-cards .card");

        cards.forEach(card => {
            const closeBtn = card.querySelector(".close-btn");
            card.addEventListener("click", () => {
                if (window.innerWidth < 769) {

                    if (card.classList.contains("active")) return;
                    cards.forEach(c => c.classList.remove("active"));
                    card.classList.toggle("active");

                    e.stopPropagation();
                }

                closeBtn.addEventListener("click", (e) => {
                    e.stopPropagation();
                    card.classList.remove("active");
                });

            })
        });
        document.addEventListener("click", (e) => {
            const activeCard = document.querySelector(".mobile-cards .card.active");
            if (!activeCard) return;

            if (!e.target.closest(".card")) {
                activeCard.classList.remove("active");
            }
        });
    </script>
@endpush
