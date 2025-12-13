@extends('shared.main')

@push('styles')
    @vite('resources/css/listicle.css')
@endpush

@section('content')
    {{-- ! Hero Section --}}
    @include('profile.hero')

    {{-- <pre> {{ print_r($reviews->toArray(), true)  }}</pre> --}}
    {{-- ! Sub-Section --}}
    @include('profile.details')
    <div class="section flex gap-x-4">
        <div class="sub-section flex flex-col flex-1 px-4 py-2.5 gap-4 border-2 border-gray-500/20 rounded-md bg-lime-700/10">
            <h3 class="md:text-3xl text-2xl font-bold text-(--secondary)">Pricing Snapshot</h3>
            <div class="tag-wrapper w-full flex flex-wrap justify-center items-center gap-2">
                <div class="tag flex grow flex-col gap-2 p-3 rounded-md border-2 border-lime-950/70">
                    <small class="md:text-base font-medium text-gray-800/80">Min. Project Size</small>
                    <span class="flex gap-2 items-center">
                        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                            clip-rule="evenodd" >
                            <path fill="currentColor"
                                d="M14.101 24l-14.101-14.105v-9.895h9.855l14.145 14.101c-3.3 3.299-6.6 6.599-9.899 9.899zm-4.659-23h-8.442v8.481l13.101 13.105 8.484-8.484c-4.381-4.368-8.762-8.735-13.143-13.102zm-1.702 3.204c.975.976.975 2.56 0 3.536-.976.975-2.56.975-3.536 0-.976-.976-.976-2.56 0-3.536s2.56-.976 3.536 0zm-.708.707c.586.586.586 1.536 0 2.121-.585.586-1.535.586-2.121 0-.585-.585-.585-1.535 0-2.121.586-.585 1.536-.585 2.121 0z" />
                        </svg>
                        <p class="font-bold md:text-xl text-base lg:text-2xl">{{ $company->details->min_project_size }} </p>
                    </span>
                </div>
                <div class="tag flex grow flex-col gap-2 p-3 border-2 border-lime-950/70 rounded-md">
                    <small class="md:text-base font-medium text-gray-800/80">Avg. hourly rate</small>
                    <span class="flex gap-2 items-center">
                        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                            clip-rule="evenodd">
                            <path fill="currentColor"
                                d="M12 0c6.623 0 12 5.377 12 12s-5.377 12-12 12-12-5.377-12-12 5.377-12 12-12zm0 1c6.071 0 11 4.929 11 11s-4.929 11-11 11-11-4.929-11-11 4.929-11 11-11zm0 11h6v1h-7v-9h1v8z" />
                        </svg>
                        <p class="font-bold md:text-xl text-base lg:text-2xl">{{ $company->details->hourly_rate }} </p>
                    </span>
                </div>
                <div class="tag flex grow flex-col gap-2 p-3 border-2 border-lime-950/70 rounded-md">
                    <small class="md:text-base font-medium text-gray-800/80">Rating for cost</small>
                    <span class="flex gap-2 items-center">
                        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                            clip-rule="evenodd">
                            <path
                                d="M22 3c.53 0 1.039.211 1.414.586s.586.884.586 1.414v14c0 .53-.211 1.039-.586 1.414s-.884.586-1.414.586h-20c-.53 0-1.039-.211-1.414-.586s-.586-.884-.586-1.414v-14c0-.53.211-1.039.586-1.414s.884-.586 1.414-.586h20zm1 8h-22v8c0 .552.448 1 1 1h20c.552 0 1-.448 1-1v-8zm-15 5v1h-5v-1h5zm13-2v1h-3v-1h3zm-10 0v1h-8v-1h8zm-10-6v2h22v-2h-22zm22-1v-2c0-.552-.448-1-1-1h-20c-.552 0-1 .448-1 1v2h22z" />
                        </svg>
                        <p class="font-bold md:text-xl text-base lg:text-2xl">
                            {{ intval($reviews->avg('cost')) }}/5
                        </p>

                    </span>
                </div>
            </div>
            <h4 class="text-xl font-bold">What Client have Said</h4>
                <p>
                    {{ optional($reviews->sortByDesc('rating')->first())->review }}
                </p>

        </div>
        <div
            class="sub-section flex flex-col gap-2 max-[1000px]:w-full w-1/2 outline-1 outline-(--accent) p-4 rounded-md bg-(--accent)/10">
            <h1 class="text-xl font-bold text-(--accent)">Most Common Project Size<span class="service-name"></span></h1>
            <h1 class="priceRange text-xl font-bold text-(--black)" data-company="id">
                {{ '$' . number_format($reviews->pluck('project_size')->map(fn($v) => (int) str_replace(['$', ','], '', $v))->min()) }}
                -
                {{ '$' . number_format($reviews->pluck('project_size')->map(fn($v) => (int) str_replace(['$', ','], '', $v))->max()) }}
                <span class="font-semibold">Based on {{ $reviews->count()}} Reviews</span>
            </h1>

            <div class="project-size-wrapper flex gap-2 flex-wrap">
                <button data-service="all"
                    class="tag max-[600px]:grow bg-(--accent)/10 outline-(--accent) outline-2 text-(--accent) rounded-md py-1 px-2 active">All</button>
                @foreach ($reviews->unique('service_id') as $review)
                <button data-service="{{ $review->service_id }}"
                {{-- <button --}}
                    class="tag max-[600px]:grow bg-(--accent)/10 outline-(--accent) outline-2 text-(--accent) rounded-md py-1 px-2">
                    {{ $review->service->service }}
                </button>
                @endforeach

            </div>

        </div>
    </div>

    <div id="review"
        class="section w-full max-w-[1920px] justify-between flex flex-col gap-2 p-[50px] max-[720px]:p-5 max-[1000px]:flex-col">
        {{-- @foreach ($reviews as $review) --}}
        <div class="review flex flex-col p-2 gap-4 outline-2 outline-(--accent) rounded-md bg-(--outline)/20 w-full">
            <div class="flex items-center justify-between pt-2">
                <h1 class="text-2xl font-bold">review->projectTitle </h1>
                <span class="flex text-(--accent) gap-2"><svg class="fill-(--accent)" width="24" height="24"
                        xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                        <path
                            d="M16.272 5.451c-.176-.45-.272-.939-.272-1.451 0-2.208 1.792-4 4-4s4 1.792 4 4-1.792 4-4 4c-1.339 0-2.525-.659-3.251-1.67l-7.131 3.751c.246.591.382 1.239.382 1.919 0 .681-.136 1.33-.384 1.922l7.131 3.751c.726-1.013 1.913-1.673 3.253-1.673 2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4c0-.51.096-.999.27-1.447l-7.129-3.751c-.9 1.326-2.419 2.198-4.141 2.198-2.76 0-5-2.24-5-5s2.24-5 5-5c1.723 0 3.243.873 4.143 2.201l7.129-3.75zm3.728 11.549c1.656 0 3 1.344 3 3s-1.344 3-3 3-3-1.344-3-3 1.344-3 3-3zm-15-9c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm15-7c1.656 0 3 1.344 3 3s-1.344 3-3 3-3-1.344-3-3 1.344-3 3-3z" />
                    </svg>Share</span>
            </div>
            <div class="review-container py-3 border-t-(--accent) border-t flex w-full gap-2 max-[850px]:flex-col">
                <div class="review-project gap-5 w-[600px] max-[850px]:w-full flex flex-col">
                    <div class="flex flex-col gap-2">
                        <strong class="uppercase text-(--accent)">The project</strong>
                        <span class="flex gap-2 items-center">
                            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                clip-rule="evenodd">
                                <path
                                    d="M12 2h2v2h2v3.702l7 2.618v12.68h1v1h-24v-1h1v-11h6v-8h2v-2h2v-2h1v2zm3 3h-7v18h1v-2h5v2h1v-18zm-2 17h-3v1h3v-1zm8 1h1v-11.987l-6-2.243v14.23h1v-2h4v2zm-14-10h-5v10h1v-2h3v2h1v-10zm-2 9h-1v1h1v-1zm15 0h-2v1h2v-1zm-16-5v2h-1v-2h1zm2 0v2h-1v-2h1zm5-10v12h-1v-12h1zm10 11v1h-4v-1h4zm-8-11v12h-1v-12h1zm8 9v1h-4v-1h4zm-17-2v2h-1v-2h1zm2 0v2h-1v-2h1zm15 0v1h-4v-1h4zm0-2v1h-4v-1h4zm-8-9h-3v1h3v-1z" />
                            </svg>
                            <small>
                                review->service->service </small>
                        </span>
                        <span class="flex gap-2 items-center">
                            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                clip-rule="evenodd">
                                <path
                                    d="M14.101 24l-14.101-14.105v-9.895h9.855l14.145 14.101c-3.3 3.299-6.6 6.599-9.899 9.899zm-4.659-23h-8.442v8.481l13.101 13.105 8.484-8.484c-4.381-4.368-8.762-8.735-13.143-13.102zm-1.702 3.204c.975.976.975 2.56 0 3.536-.976.975-2.56.975-3.536 0-.976-.976-.976-2.56 0-3.536s2.56-.976 3.536 0zm-.708.707c.586.586.586 1.536 0 2.121-.585.586-1.535.586-2.121 0-.585-.585-.585-1.535 0-2.121.586-.585 1.536-.585 2.121 0z" />
                            </svg>
                            <small>review->projectSize </small>
                        </span>
                        <span class="flex gap-2 items-center">

                            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                clip-rule="evenodd">
                                <path
                                    d="M24 23h-24v-19h4v-3h4v3h8v-3h4v3h4v19zm-1-15h-22v14h22v-14zm-16.501 8.794l1.032-.128c.201.93.693 1.538 1.644 1.538.957 0 1.731-.686 1.731-1.634 0-.989-.849-1.789-2.373-1.415l.115-.843c.91.09 1.88-.348 1.88-1.298 0-.674-.528-1.224-1.376-1.224-.791 0-1.364.459-1.518 1.41l-1.032-.171c.258-1.319 1.227-2.029 2.527-2.029 1.411 0 2.459.893 2.459 2.035 0 .646-.363 1.245-1.158 1.586.993.213 1.57.914 1.57 1.928 0 1.46-1.294 2.451-2.831 2.451-1.531 0-2.537-.945-2.67-2.206zm9.501 2.206h-1.031v-6.265c-.519.461-1.354.947-1.969 1.159v-.929c1.316-.576 2.036-1.402 2.336-1.965h.664v8zm7-14h-22v2h22v-2zm-16-3h-2v2h2v-2zm12 0h-2v2h2v-2z" />
                            </svg>
                            <small>review->projectDuration </small>
                        </span>
                    </div>
                    <div class="flex flex-col max-[850px]:hidden">

                        <strong class="uppercase text-(--accent)">Project Summary</strong>
                        <small>
                            review->projectSummary
                        </small>
                    </div>

                </div>
                <div class="review-rating h-fit border-(--accent) border-2 bg-(--accent)/20 rounded-md flex flex-col">
                    <span class="flex flex-col max-[850px]:flex-row gap-3 items-center justify-center py-6 px-10">
                        <h1 class="text-4xl font-bold">review->rating</h1>
                        <div class="flex justify-center">
                            <svg width="20" height="20" class="fill-(--accent)" clip-rule="evenodd"
                                fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                    fill-rule="nonzero" />
                            </svg>
                            <svg width="20" height="20" class="fill-(--accent)" clip-rule="evenodd"
                                fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                    fill-rule="nonzero" />
                            </svg>
                            <svg width="20" height="20" class="fill-(--accent)" clip-rule="evenodd"
                                fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                    fill-rule="nonzero" />
                            </svg>
                            <svg width="20" height="20" class="fill-(--accent)" clip-rule="evenodd"
                                fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                    fill-rule="nonzero" />
                            </svg>
                            <svg width="20" height="20" class="fill-(--accent)" clip-rule="evenodd"
                                fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m11.322 2.923c.126-.259.39-.423.678-.423.289 0 .552.164.678.423.974 1.998 2.65 5.44 2.65 5.44s3.811.524 6.022.829c.403.055.65.396.65.747 0 .19-.072.383-.231.536-1.61 1.538-4.382 4.191-4.382 4.191s.677 3.767 1.069 5.952c.083.462-.275.882-.742.882-.122 0-.244-.029-.355-.089-1.968-1.048-5.359-2.851-5.359-2.851s-3.391 1.803-5.359 2.851c-.111.06-.234.089-.356.089-.465 0-.825-.421-.741-.882.393-2.185 1.07-5.952 1.07-5.952s-2.773-2.653-4.382-4.191c-.16-.153-.232-.346-.232-.535 0-.352.249-.694.651-.748 2.211-.305 6.021-.829 6.021-.829s1.677-3.442 2.65-5.44z"
                                    fill-rule="nonzero" />
                            </svg>
                        </div>
                    </span>
                    <div class="flex flex-col p-2">
                        <span class="flex justify-between border-t border-(--accent) pt-3 pb-2">
                            <strong>Quality</strong>
                            <p>review->quality </p>
                        </span>
                        <span class="flex justify-between border-t border-(--accent) pt-3 pb-2">
                            <strong>Schedule</strong>
                            <p>review->schedule </p>
                        </span>
                        <span class="flex justify-between border-t border-(--accent) pt-3 pb-2">
                            <strong>Cost</strong>
                            <p>review->cost </p>
                        </span>
                        <span class="flex justify-between border-t border-(--accent) pt-3 pb-2">
                            <strong>Willing to Refer</strong>
                            <p>review->willingToRefer </p>
                        </span>
                    </div>
                </div>
                <div class="review-subject flex gap-2 flex-col">
                    <strong class="uppercase text-(--accent)">The Review</strong>
                    <p class="text-xl">"review->review "</p>
                    <small>review->created_at </small>
                    <strong class="uppercase text-(--accent) ">Feedback Summary</strong>
                    <small class="">review->summary </small>
                </div>
                <div class="review-reviewer w-[600px] flex flex-col">
                    <div class="flex flex-col gap-3">
                        <strong class="uppercase text-(--accent)">The reviewer</strong>
                        <span>
                            <p>
                                review->reviewer->category->category </p>
                        </span>
                        <span class="flex gap-2 items-center">
                            <img class="w-10 h-10 aspect-square object-cover rounded-full" src="" alt="">
                            <small>review->reviewer->name </small>
                        </span>
                        <span class="flex gap-2 items-center">
                            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                clip-rule="evenodd">
                                <path
                                    d="M12 2h2v2h2v3.702l7 2.618v12.68h1v1h-24v-1h1v-11h6v-8h2v-2h2v-2h1v2zm3 3h-7v18h1v-2h5v2h1v-18zm-2 17h-3v1h3v-1zm8 1h1v-11.987l-6-2.243v14.23h1v-2h4v2zm-14-10h-5v10h1v-2h3v2h1v-10zm-2 9h-1v1h1v-1zm15 0h-2v1h2v-1zm-16-5v2h-1v-2h1zm2 0v2h-1v-2h1zm5-10v12h-1v-12h1zm10 11v1h-4v-1h4zm-8-11v12h-1v-12h1zm8 9v1h-4v-1h4zm-17-2v2h-1v-2h1zm2 0v2h-1v-2h1zm15 0v1h-4v-1h4zm0-2v1h-4v-1h4zm-8-9h-3v1h3v-1z" />
                            </svg>
                            <small>
                                {{-- {{ $review->reviewer->industry->industry }} --}}
                            </small>
                        </span>
                        <span class="flex gap-2 items-center">
                            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                clip-rule="evenodd">
                                <path
                                    d="M12 10c-1.104 0-2-.896-2-2s.896-2 2-2 2 .896 2 2-.896 2-2 2m0-5c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3m-7 2.602c0-3.517 3.271-6.602 7-6.602s7 3.085 7 6.602c0 3.455-2.563 7.543-7 14.527-4.489-7.073-7-11.072-7-14.527m7-7.602c-4.198 0-8 3.403-8 7.602 0 4.198 3.469 9.21 8 16.398 4.531-7.188 8-12.2 8-16.398 0-4.199-3.801-7.602-8-7.602" />
                            </svg>
                            <small>
                                {{-- {{ $review->reviewer->detail->locations }} --}}
                            </small>
                        </span>
                        <span class="flex gap-2 items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M10.119 16.064c2.293-.53 4.427-.994 3.394-2.946-3.147-5.941-.835-9.118 2.488-9.118 3.388 0 5.643 3.299 2.488 9.119-1.065 1.964 1.149 2.427 3.393 2.946 1.985.458 2.118 1.428 2.118 3.107l-.003.828h-1.329c0-2.089.083-2.367-1.226-2.669-1.901-.438-3.695-.852-4.351-2.304-.239-.53-.395-1.402.226-2.543 1.372-2.532 1.719-4.726.949-6.017-.902-1.517-3.617-1.509-4.512-.022-.768 1.273-.426 3.479.936 6.05.607 1.146.447 2.016.206 2.543-.66 1.445-2.472 1.863-4.39 2.305-1.252.29-1.172.588-1.172 2.657h-1.331c0-2.196-.176-3.406 2.116-3.936zm-10.117 3.936h1.329c0-1.918-.186-1.385 1.824-1.973 1.014-.295 1.91-.723 2.316-1.612.212-.463.355-1.22-.162-2.197-.952-1.798-1.219-3.374-.712-4.215.547-.909 2.27-.908 2.819.015.935 1.567-.793 3.982-1.02 4.982h1.396c.44-1 1.206-2.208 1.206-3.9 0-2.01-1.312-3.1-2.998-3.1-2.493 0-4.227 2.383-1.866 6.839.774 1.464-.826 1.812-2.545 2.209-1.49.345-1.589 1.072-1.589 2.334l.002.618z" />
                            </svg>
                            <small>
                                {{-- {{ $review->reviewer->detail->employees }} --}}
                            </small>
                        </span>
                        {{-- @if ($review->reviewer->verified) --}}
                        <span class="flex gap-2 items-center">
                            <svg class="fill-(--accent)" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.959 17l-4.5-4.319 1.395-1.435 3.08 2.937 7.021-7.183 1.422 1.409-8.418 8.591z" />
                            </svg>
                            <small>
                                Verified
                            </small>
                        </span>
                        {{-- @else --}}
                        {{-- @endif --}}

                    </div>
                </div>
            </div>
            {{-- <div class="full-review-{{ $review->id }} hidden flex-col gap-2"> --}}
            <div class="full-review hidden flex-col gap-2">
                {{-- @foreach ($review->faqs as $faq) --}}
                <span class="flex flex-col">
                    <small><strong> faq->question['text'] </strong></small>
                    <small> faq->answer['text']</small>
                </span>
                {{-- @endforeach --}}
            </div>
            <button {{-- <button data-review="{{ $review->id }}" --}}
                class="review-btn flex gap-1 bg-(--secondary) self-center p-3 rounded-md text-(--primary) w-fit">Read
                Full
                Review <svg class="fill-(--primary)" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M0 7.33l2.829-2.83 9.175 9.339 9.167-9.339 2.829 2.83-11.996 12.17z" />
                </svg></button>
        </div>
        {{-- @endforeach --}}
        <div class="mt-6 flex justify-center">
            {{-- {{ $reviews->withQueryString()->fragment('review')->links() }} --}}
        </div>

    </div>

    <div
        class="section bg-(--accent)/40 w-full max-w-[1920px] justify-between flex flex-col gap-2 p-[50px] max-[720px]:p-5 max-[1000px]:flex-col">
        <h2 class="text-2xl font-semibold">Connect with company->name on Social</h2>
        <div class="flex gap-2">
            {{-- @foreach ($company->detail->links as $platform => $url) --}}
            <a href="" target="_blank" class="btn btn-secondary flex gap-2 items-center">
                {{-- <i class="fa fa-{{ $platform }}"></i> --}}
                {{-- {{ ucfirst($platform) }} --}}
            </a>
            {{-- @endforeach --}}

        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('assets/js/projectSize.js') }}"></script>
        {{-- <script src="{{ asset('assets/js/reviewFaq.js') }}"></script> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="{{ asset('assets/js/chart.js') }}"></script>
        <script>
            window.chartData = {
                labels: @json($company->services->pluck('name')->toArray()),
                data: @json($company->services->pluck('pivot.expertise_percentage')->toArray())
            };
        </script>
    @endpush
@endsection
