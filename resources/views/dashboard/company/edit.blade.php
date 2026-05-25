@extends('dashboard.layout.main')
@section('title', 'Company')

@php
    $colors = [
        'text-red-500',
        'text-blue-500',
        'text-green-500',
        'text-yellow-500',
        'text-purple-500',
        'text-pink-500',
        'text-indigo-500',
        'text-teal-500',
        'text-orange-500',
        'text-cyan-500',
        'text-emerald-500',
        'text-rose-500',
        'text-sky-500',
        'text-violet-500',
        'text-lime-500',
        'text-amber-500',
        'text-fuchsia-500',
        'text-stone-500',
    ];
@endphp
@section('content')
    <div class="dashboard-form-container pb-20">
        <div class="dashboard-form-header bg-(--color-background)">
            <h3 class="dashboard-form-title">Edit Company Details</h3>
            <a href="{{ route('companies.index') }}" class="btn btn-secondary">Go Back</a>
        </div>
        <form class="flex flex-col gap-10" action="{{ route('companies.update', $company->id ?? null) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @if ($company->id)
                @method('PUT')
            @endif

            {{-- Logo Upload --}}
            <div>


                <div class="flex items-start px-6 py-4 gap-4 bg-(--color-background)">
                    <div class="image profile-wrapper">
                        <img src="{{ $company->logo
                            ? (Str::startsWith($company->logo, 'http')
                                ? $company->logo
                                : asset('storage/' . $company->logo))
                            : asset('images/dummy.jpg') }}"
                            id="preview" class="profile-image" alt="Profile" />
                        <label for="fileInput" class="edit-icon" title="Upload Pic">
                            <i class="fa-solid fa-pencil"></i>
                        </label>
                    </div>
                    <input type="file" id="fileInput" accept="image/*" name="logo" />
                </div>
                {{-- ! Step 1 --}}
                @include('dashboard.company.partials.step1')
            </div>
            {{-- ? Step 1 End --}}
            {{-- ! Step 2 --}}
            @include('dashboard.company.partials.step2')
            {{-- ? Step 2 End --}}
            {{-- ! Step 3 --}}
            <div class="step-3 sm:px-6 sm:py-6 px-3 py-5 bg-(--color-background) rounded-2xl">
                <h2 class="sm:text-3xl text-2xl font-semibold">Company Services </h2>
                <div class="mt-5 text-center">
                    Total Expertise: <span id="total-expertise" class="text-(--color-primary) font-bold">0</span>
                </div>
                @error('services')
                    <div class="bg-red-500 text-white px-4 py-3 rounded-md mb-4 flex items-start gap-2 fixed top-20 right-3.5"
                        onclick="setTimeout(() => this.remove(), 3000)">
                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                        <p class="text-sm">{{ $message }}</p>

                    </div>
                @enderror

                @php
                    $oldServices = old('services');
                @endphp
                <div class="flex flex-wrap justify-center gap-4 my-5" id="serviceTags">


                    @if ($oldServices)
                        {{-- Restore from old() after validation failure --}}
                        @foreach ($oldServices as $serviceId => $serviceData)
                            @php
                                $svc = $allServices->firstWhere('id', $serviceId);
                                $pivot_percent = $serviceData['expertise_percentage'] ?? 0;
                                $pivot_desc = $serviceData['description'] ?? '';
                                $index = $loop->index;
                            @endphp
                            @if ($svc)
                                <div class="service-tag sm:px-4 sm:py-2 px-2 py-1 bg-(--color-surface) rounded-xl cursor-pointer flex items-center justify-center outline outline-transparent hover:outline-(--color-primary) hover:scale-[1.01] transition"
                                    data-id="{{ $svc->id }}" data-name="{{ $svc->name }}"
                                    data-percent="{{ $pivot_percent }}" data-description="{{ $pivot_desc }}">

                                    {{ $svc->name }} — <span
                                        class="tag-percent ml-1 {{ $colors[$index % count($colors)] }}">{{ $pivot_percent }}%</span>

                                    <button type="button"
                                        class="remove-service text-(--color-error) text-[8px] sm:text-xs bg-(--color-error-100) hover:bg-(--color-error) hover:text-(--color-text) active:text-(--color-text) transition sm:w-8 sm:h-8 w-5 h-5 rounded-full flex items-center justify-center font-bold cursor-pointer ml-4">
                                        <i class="fa-solid fa-x"></i>
                                    </button>

                                    <input type="hidden" name="services[{{ $svc->id }}][expertise_percentage]"
                                        value="{{ $pivot_percent }}" class="service-input-percent">
                                    <input type="hidden" name="services[{{ $svc->id }}][description]"
                                        value="{{ $pivot_desc }}" class="service-input-description">
                                </div>
                            @endif
                        @endforeach
                    @else
                        {{-- Normal load from DB --}}
                        @foreach ($company->services as $index => $service)
                            <div class="service-tag sm:px-4 sm:py-2 px-2 py-1 bg-(--color-surface) rounded-xl cursor-pointer flex items-center justify-center outline outline-transparent hover:outline-(--color-primary) hover:scale-[1.01] transition"
                                data-id="{{ $service->id }}" data-name="{{ $service->name }}"
                                data-percent="{{ $service->pivot->expertise_percentage ?? 0 }}"
                                data-description="{{ $service->pivot->description ?? '' }}">

                                {{ $service->name }} — <span
                                    class="tag-percent ml-1 {{ $colors[$index % count($colors)] }}">{{ $service->pivot->expertise_percentage ?? 0 }}%</span>

                                <button type="button"
                                    class="remove-service text-(--color-error) text-[8px] sm:text-xs bg-(--color-error-100) hover:bg-(--color-error) hover:text-(--color-text) active:text-(--color-text) transition sm:w-8 sm:h-8 w-5 h-5 rounded-full flex items-center justify-center font-bold cursor-pointer ml-4">
                                    <i class="fa-solid fa-x"></i>
                                </button>

                                <input type="hidden" name="services[{{ $service->id }}][expertise_percentage]"
                                    value="{{ $service->pivot->expertise_percentage }}" class="service-input-percent">
                                <input type="hidden" name="services[{{ $service->id }}][description]"
                                    value="{{ $service->pivot->description }}" class="service-input-description">
                            </div>
                        @endforeach
                    @endif

                </div>
                <div class="text-center mt-6 px-5">
                    <button type="button" id="addServiceBtn"
                        class="btn btn-outline-primary">
                        + Add Service
                    </button>
                </div>

                {{-- ! Submit Button --}}
                <div class="sm:px-6 sm:py-6 px-3 py-3 border-t mt-6">
                    <button type="submit"
                        class="btn btn-primary">
                        {{ $company->id ? 'Save Changes' : 'Create Company' }}</button>
                    <a href="{{ route('companies.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
            {{-- ! Service Selector --}}
            @include('dashboard.company.partials.serviceSelector')
            {{-- ? Step 3 End --}}
        </form>

    </div>
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.35.4/tagify.min.js"
        integrity="sha512-sKkyJJpMbq+xZRQwXCksuVx5g4JuYQK7c3+65dF3CAx3Gcn67+BPC2PyJkJEugtRRAeDBLPfcsULXbEZ5iqYjg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    @vite(['resources/js/dashboard/company-details.js', 'resources/js/dashboard/summernote.js', 'resources/js/dashboard/rangeSlider.js'])
    @php
        $oldLanguages = old('languages', $company->details->languages ?? []);
        if (is_string($oldLanguages)) {
            $decoded = json_decode($oldLanguages, true);
            if (is_array($decoded)) {
                $oldLanguages = array_map(fn($tag) => $tag['value'], $decoded);
            }
        }
    @endphp
    <script>
        const input = document.querySelector('#languages');

        fetch('https://raw.githubusercontent.com/x-hamza47/languages/main/languages.json')
            .then(res => res.json())
            .then(languages => {
                const tagify = new Tagify(input, {
                    whitelist: languages,
                    enforceWhitelist: true,
                    maxTags: 10,
                    dropdown: {
                        closeOnSelect: false,
                        classname: "tags-look",
                        enabled: 1
                    }
                });
                let oldLanguages = @json($oldLanguages);
                tagify.addTags(oldLanguages);
            })
            .catch(err => console.error("Failed to load languages JSON:", err));

        // !live Image File Preview
        const fileInput = document.getElementById('fileInput');
        const preview = document.getElementById('preview');

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
        // ! Get Slug
        $("#name").change(function() {
            let ele = $(this);

            $("button[type=submit]").prop('disabled', true);
            $.ajax({
                url: '{{ route('getSlug') }}',
                type: 'get',
                data: {
                    name: ele.val()
                },
                dataType: 'json',
                success: function(response) {
                    $("button[type=submit]").prop('disabled', false);

                    if (response['status'] == true) {
                        $('#slug').val(response['slug']);
                    }
                }
            });
        });
    </script>
@endpush
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.35.4/tagify.css"
        integrity="sha512-BIjLsaXLHhpnoOzfTzEfOEVUDEqi/5RP9RbUYGfPkZUo+raxRUOiJb7AybUxV075aWNNGglvr5Lbjeo6Ww0HCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">

    @vite('resources/css/dashboard-css/form.css')
@endpush
