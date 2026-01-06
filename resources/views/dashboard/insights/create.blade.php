@extends('dashboard.layout.main')
@section('title', 'Insight-create')

@section('content')
    <div class="dashboard-form-container pb-20">
        <div class="dashboard-form-header bg-(--color-background)">
            <h3 class="dashboard-form-title">Add Insight</h3>
            <a href="{{ route('insights.index') }}" class="btn btn-secondary">Go Back</a>
        </div>

        <form class="flex flex-col gap-10" action="{{ route('insights.store') }}" method="post">
            @csrf

            <div class="px-6 py-4 bg-(--color-background) rounded-b-2xl">
                <h2 class="sm:text-3xl text-2xl font-semibold">Create Insight</h2>
                <div class="grid sm:grid-cols-2 gap-4 my-5 transition-all duration-500 ease-in-out ">
                    {{-- Title --}}
                    <div>
                        <div class="inp-field w-full">
                            <label class="block mb-2 text-sm text-(--color-text)">Title</label>
                            <span class="relative h-11">
                                <input type="text" placeholder="Insight Title" name="title"
                                    class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none pl-10 pr-9 py-3 @error('title') invalid-input @enderror"
                                    id="title" value="{{ old('title') }}">
                                <i class="fa-solid fa-heading absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </span>
                            @error('title')
                                <span class="error">
                                    <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                    <p class="error-text">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Slug (readonly) --}}
                    <div>
                        <div class="inp-field w-full">
                            <label class="block mb-2 text-sm text-(--color-text)">Slug</label>
                            <span class="relative h-11">
                                <input type="text" name="slug" id="slug" readonly
                                    class="rounded-md w-full h-full border-2 border-gray-400/40 outline-none pl-10 pr-9 py-3 text-(--color-muted) @error('slug') invalid-input @enderror"
                                    value="{{ old('slug') }}">
                                <i class="fa-solid fa-link absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </span>
                            @error('slug')
                                <span class="error">
                                    <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                    <p class="error-text">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Service Dropdown --}}
                    <div>
                        <div class="inp-field w-full">
                            <label class="block mb-2 text-sm text-(--color-text)">Service</label>
                            <span class="relative h-11">
                                <select name="service_id"
                                    class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none pl-10  py-3 @error('service_id') invalid-input @enderror">
                                    <option class="bg-black " value="">Select Service</option>
                                    @foreach ($services as $id => $name)
                                        <option value="{{ $id }}" class="bg-(--color-surface)"
                                            {{ old('service_id') == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                <i class="fa-solid fa-briefcase absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </span>
                            @error('service_id')
                                <span class="error">
                                    <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                    <p class="error-text">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="sm:col-span-2">
                        <div class="inp-field w-full">
                            <label class="block mb-2 text-sm text-(--color-text)">Description</label>
                            <textarea name="description"
                                class="rounded-md w-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none pl-3 pr-3 py-3 h-32 @error('description') invalid-input @enderror"
                                placeholder="Short description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="error">
                                    <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                    <p class="error-text">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Article (Summernote) --}}
                    <div class="sm:col-span-2">
                        <div class="inp-field w-full">
                            <label class="block mb-2 text-sm text-(--color-text)">Article</label>
                            <textarea name="article" class="summernote">{{ old('article') }}</textarea>
                            @error('article')
                                <span class="error">
                                    <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                    <p class="error-text">{{ $message }}</p>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- ! Submit Button --}}
                <div class="sm:px-6 sm:py-6 px-3 py-3 border-t mt-6">
                    <button type="submit"
                        class="bg-(--color-secondary) cursor-pointer px-5 text-white text-center rounded-md py-2 hover:bg-(--color-primary) font-semibold peer-has-not-checked:hidden peer-has-checked:block mr-3">Create Insight</button>
                    <a href="">Cancel</a>
                </div>

        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <script src="{{ asset('dashboard-assets/js/summernote.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // ! Get Slug
        $("#title").change(function() {
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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    @vite('resources/css/dashboard-css/form.css')
@endpush
