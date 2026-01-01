@extends('dashboard.layout.main')
@section('title', 'Company')

@php
    $colors = ['#84cc16', '#a78bfa', '#60a5fa', '#f472b6', '#facc15', '#6366f1', '#f87171', '#34d399'];
@endphp
@section('content')
    <div class="dashboard-form-container">
        {{-- <pre> {{ print_r($company->toArray(), true) }}</pre> --}}
        <div class="dashboard-form-header bg-(--color-background)">
            <h3 class="dashboard-form-title">Edit Company Details</h3>
            <a href="{{ route('companies.index') }}" class="btn btn-secondary">Go Back</a>
        </div>

        <form action="#" class="flex items-start px-6 py-4 gap-4 bg-(--color-background)">
            @csrf
            {{-- ! Logo  --}}
            <div>
                <div class="image profile-wrapper">
                    <img src="{{ $company->logo }}" id="preview" class="profile-image" alt="Profile" />
                    <label for="fileInput" class="edit-icon" title="Upload Pic">
                        <i class="fa-solid fa-pencil"></i>
                    </label>
                </div>
                <input type="file" id="fileInput" accept="image/*" name="logo" />
            </div>

            <button
                class="btn btn-primary cursor-pointer text-white  text-center rounded-md py-2 hover:bg-(--light-primary) font-semibold">Update
                Logo</button>
        </form>
        <form class="flex flex-col gap-10" action="" method="post">
            @csrf
            {{-- ! Step 1 --}}
            @include('dashboard.company.partials.step1')
            {{-- ? Step 1 End --}}
            {{-- ! Step 2 --}}
            @include('dashboard.company.partials.step2')
            {{-- ? Step 2 End --}}
            {{-- ! Step 3 --}}
            <div class="step-3 sm:px-6 sm:py-6 px-3 py-3 bg-(--color-background) rounded-2xl">
                <h2 class="sm:text-3xl text-2xl font-semibold ">Company Services </h2>
                <div class="mt-5 text-center">
                    Total Expertise: <span id="total-expertise" class="text-(--color-primary) font-bold">0</span>
                </div>
                <div class="flex flex-wrap justify-center gap-10 my-5">
                    @foreach ($company->services as $index => $service)
                        <div
                            class="service-card bg-(--color-surface) max-w-96 flex-1 flex flex-col items-center gap-5 sm:px-5 sm:pt-4 pb-10 px-2 pt-3 rounded-2xl sm:min-w-72 min-w-64">
                            <div class="flex justify-between items-center w-full">
                                <h4 class="service-name font-semibold text-xl">{{ $service->name }}</h4>
                                <button type="button"
                                    class="remove-service text-(--color-error) text-xs bg-(--color-error-100) w-8 h-8 rounded-full flex items-center justify-center font-bold cursor-pointer"><i
                                        class="fa-solid fa-x"></i></button>
                            </div>
                            <div class="service-box w-max relative">
                                <input type="text" value="{{ $service->pivot->expertise_percentage ?? 0 }}"
                                    class="dial top-1/2 left-1/2 -translate-1/2 z-50"
                                    data-color="{{ $colors[$index % count($colors)] }}">
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="text-center mt-6">
                    <button type="button" id="addServiceBtn"
                        class="bg-(--color-primary) text-white px-5 py-2 rounded-lg font-semibold hover:bg-(--color-secondary)">
                        + Add Service
                    </button>
                </div>
            </div>
            <select id="serviceSelect" class="hidden">
                @foreach ($allServices as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>

            {{-- ? Step 3 End --}}

            {{-- <button type="submit"
                class="bg-(--color-secondary) cursor-pointer text-white w-full text-center rounded-md py-2 hover:bg-(--color-primary) font-semibold peer-has-not-checked:hidden peer-has-checked:block">Sign
                Up</button> --}}



        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.js"></script>
    <script src="{{ asset('dashboard-assets/js/rangeSlider.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.35.4/tagify.min.js"
        integrity="sha512-sKkyJJpMbq+xZRQwXCksuVx5g4JuYQK7c3+65dF3CAx3Gcn67+BPC2PyJkJEugtRRAeDBLPfcsULXbEZ5iqYjg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <script src="{{ asset('dashboard-assets/js/summernote.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"></script>
    <script>
        // REMOVE SERVICE
        $(document).on("click", ".remove-service", function() {
            $(this).closest(".service-card").remove();
            updateTotal();
        });


        // ADD SERVICE POPUP
        $("#addServiceBtn").on("click", function() {
            // Max 15 services check
            if ($(".step-3 .service-card").length >= 15) {
                alert("You can add a maximum of 15 services");
                return;
            }

            let options = "";

            $("#serviceSelect option").each(function() {
                let id = $(this).val();
                let name = $(this).text();

                // skip already added
                if ($(".dial[data-id='" + id + "']").length === 0) {
                    options += `<option value="${id}" class="bg-(--color-surface)">${name}</option>`;
                }
            });

            if (options === "") {
                alert("All services already added");
                return;
            }

            let popup = `
            <div id="selectPopup"
                style="position:fixed;inset:0;background:#0007;display:flex;align-items:center;justify-content:center;z-index:9999;" class="px-2">
                <div style="background:var(--color-surface);padding:20px;border-radius:10px;"
                class="rounded-xl w-[500px] min-w-72">
                    <h3 class="mb-3 text-xl font-bold">Select Service</h3>
                    <select id="popupService" class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none placeholder:text-gray-400  px-5 py-3">
                        ${options}
                    </select>

                    <div class="flex justify-end gap-3 mt-4">
                        <button id="cancelPopup" class="px-3 py-1 bg-(--color-muted-100) hover:bg-red-400/40 text-white rounded">Cancel</button>
                        <button id="confirmAdd" class="px-3 py-1 bg-(--color-primary) text-white rounded">Add</button>
                    </div>
                </div>
            </div>
            `;

            $("body").append(popup);
        });


        // CLOSE POPUP
        $(document).on("click", "#cancelPopup", function() {
            $("#selectPopup").remove();
        });


        // CONFIRM ADD
        $(document).on("click", "#confirmAdd", function() {
            let id = $("#popupService").val();
            let name = $("#popupService option:selected").text();

            $("#selectPopup").remove();

            // Create HTML
            let html = `
                <div class="service-card bg-(--color-surface) max-w-96 flex-1 flex flex-col items-center gap-5 sm:px-5 sm:py-4 px-2 py-3 rounded-2xl sm:min-w-72 min-w-64">
                    <div class="flex justify-between items-center w-full mb-3">
                        <h4 class="service-name font-semibold text-xl">${name}</h4>
                        <button type="button" class="remove-service text-(--color-error) text-xs bg-(--color-error-100) w-8 h-8 rounded-full flex items-center justify-center font-bold cursor-pointer"><i
                                class="fa-solid fa-x"></i></button>
                    </div>
                    <div class="service-box w-max relative">
                        <input type="text" value="0" class="dial top-1/2 left-1/2 -translate-1/2 z-50"
                            data-color="#${Math.floor(Math.random()*16777215).toString(16)}" data-id="${id}">
                    </div>
                </div>
                `;

            $(".step-3 .flex.flex-wrap").append(html);

            // Initialize knob for new input (reuse your knob init function)
            initKnob($(".dial").last());

            updateTotal();
        });

        function initKnob($input) {
            let color = $input.data('color') || '#007bff';
            let $container = $input.closest(".service-box");

            $input.on('input', function() {
                let typedVal = parseInt($input.val()) || 0;

                // Sum of other dials
                let othersTotal = 0;
                $(".dial").not($input).each(function() {
                    othersTotal += parseInt($(this).val()) || 0;
                });

                let maxAllowed = 100 - othersTotal;
                if (typedVal > maxAllowed) typedVal = maxAllowed;
                if (typedVal < 0) typedVal = 0;

                $input.val(typedVal).trigger('change');
                updateTotal();
            });

            $input.knob({
                fgColor: color,
                width: 120,
                height: 120,
                thickness: 0.25,
                min: 0,
                max: 100,
                step: 1,
                change: function(newVal) {
                    let othersTotal = 0;
                    $(".dial").not($input).each(function() {
                        othersTotal += parseInt($(this).val()) || 0;
                    });

                    let maxAllowed = 100 - othersTotal;
                    if (newVal > maxAllowed) {
                        setTimeout(() => {
                            $input.val(maxAllowed).trigger('change');
                        }, 0);
                    }

                    updateTotal();
                },
                release: function() {
                    updateTotal();
                },
                draw: function() {
                    updateTotal();
                }
            });

            $container.off('wheel').on('wheel', function(e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();

                let currentVal = parseInt($input.val()) || 0;
                let delta = e.originalEvent.deltaY < 0 ? 1 : -1;

                let othersTotal = 0;
                $(".dial").not($input).each(function() {
                    othersTotal += parseInt($(this).val()) || 0;
                });

                let maxAllowed = 100 - othersTotal;
                let newVal = currentVal + delta;

                if (newVal < 0) newVal = 0;
                if (newVal > maxAllowed) newVal = maxAllowed;

                $input.val(newVal).trigger('change');
                updateTotal();
            });

            $input.off('wheel mousewheel DOMMouseScroll');
        }

        $("form").on("submit", function(e) {
            if (totalExpertise > 100) {
                alert("Total cannot exceed 100%");
                e.preventDefault();
            }
        });
    </script>
    <script>
        let totalExpertise;

        function updateTotal() {
            totalExpertise = 0;
            $(".dial").each(function() {
                totalExpertise += parseInt($(this).val()) || 0;
            });
            $("#total-expertise").text(totalExpertise + "%");
        }


        $(".dial").each(function() {
            let $input = $(this);
            let color = $(this).data('color') || '#007bff';
            let $container = $input.closest(".service-box");

            $input.on('input', function() {

                let typedVal = parseInt($input.val()) || 0;

                // Sum of all other dials
                let othersTotal = 0;
                $(".dial").not($input).each(function() {
                    othersTotal += parseInt($(this).val()) || 0;
                });

                // Max allowed for this dial
                let maxAllowed = 100 - othersTotal;

                // Clamp
                if (typedVal > maxAllowed) typedVal = maxAllowed;
                if (typedVal < 0) typedVal = 0;

                // Set back to knob + update UI
                $input.val(typedVal).trigger('change');
                updateTotal();
            });
            $input.knob({
                fgColor: color,
                width: 120,
                height: 120,
                thickness: 0.25,
                min: 0,
                max: 100,
                // angleArc: 270, 
                // angleOffset: -135,
                step: 1,
                change: function(newVal) {

                    let othersTotal = 0;
                    $(".dial").not($input).each(function() {
                        othersTotal += parseInt($(this).val()) || 0;
                    });

                    let maxAllowed = 100 - othersTotal;

                    if (newVal > maxAllowed) {
                        setTimeout(() => {
                            $input.val(maxAllowed).trigger('change');
                        }, 0);
                    }

                    updateTotal();
                },
                release: function() {
                    updateTotal();
                },
                draw: function() {
                    updateTotal();
                }
            });
            $container.off('wheel').on('wheel', function(e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();

                let currentVal = parseInt($input.val()) || 0;
                let delta = e.originalEvent.deltaY < 0 ? 1 : -1;

                let othersTotal = 0;
                $(".dial").not($input).each(function() {
                    othersTotal += parseInt($(this).val()) || 0;
                });

                let maxAllowed = 100 - othersTotal;
                let newVal = currentVal + delta;

                if (newVal < 0) newVal = 0;
                if (newVal > maxAllowed) newVal = maxAllowed;

                $input.val(newVal).trigger('change');
                updateTotal();
            });
            $input.off('wheel mousewheel DOMMouseScroll');

        });
        updateTotal();
    </script>
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
