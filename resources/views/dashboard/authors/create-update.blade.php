@extends('dashboard.layout.main')
@section('title', isset($author) ? 'Edit Author' : 'Add Author')

@section('content')
    <div class="dashboard-form-container pb-20">

        <div class="dashboard-form-header bg-(--color-background)">
            <h3 class="dashboard-form-title">{{ isset($author) ? 'Edit Author' : 'Add Author' }}</h3>
            <a href="{{ route('authors.index') }}" class="btn btn-secondary">Go Back</a>
        </div>

        <form method="POST" id="author-form"
            action="{{ isset($author) ? route('authors.update', $author->id) : route('authors.store') }}"
            enctype="multipart/form-data">

            @csrf
            @isset($author)
                @method('PUT')
            @endisset

            <div class="grid grid-cols-1 lg:grid-cols-3">

                {{-- Left: Main fields --}}
                <div class="lg:col-span-2 bg-(--color-background) rounded-bl-2xl p-6 space-y-4">

                    {{-- Name --}}
                    <div>
                        <label class="text-xs font-black uppercase text-gray-400 block mb-1">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="author-name"
                            value="{{ old('name', $author->name ?? '') }}"
                            placeholder="e.g. John Doe"
                            class="rounded-md w-full border text-sm placeholder:text-(--color-text-muted) border-(--color-border) focus:border-(--color-primary) outline-none p-3 @error('name') invalid-input @enderror">
                        @error('name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div>
                        <label class="text-xs font-black uppercase text-gray-400 block mb-1">Slug <span class="text-red-500">*</span></label>
                        <input type="text" name="slug" id="author-slug"
                            value="{{ old('slug', $author->slug ?? '') }}"
                            placeholder="e.g. john-doe"
                            class="rounded-md w-full border text-sm placeholder:text-(--color-text-muted) border-(--color-border) focus:border-(--color-primary) outline-none p-3 @error('slug') invalid-input @enderror">
                        @error('slug')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Designation --}}
                    <div>
                        <label class="text-xs font-black uppercase text-gray-400 block mb-1">Designation</label>
                        <input type="text" name="designation"
                            value="{{ old('designation', $author->designation ?? '') }}"
                            placeholder="e.g. Senior Editor"
                            class="rounded-md w-full border text-sm placeholder:text-(--color-text-muted) border-(--color-border) focus:border-(--color-primary) outline-none p-3 @error('designation') invalid-input @enderror">
                        @error('designation')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Company --}}
                    <div>
                        <label class="text-xs font-black uppercase text-gray-400 block mb-1">Company</label>
                        <input type="text" name="company"
                            value="{{ old('company', $author->company ?? '') }}"
                            placeholder="e.g. TopFirms"
                            class="rounded-md w-full border text-sm placeholder:text-(--color-text-muted) border-(--color-border) focus:border-(--color-primary) outline-none p-3 @error('company') invalid-input @enderror">
                        @error('company')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Bio --}}
                    <div>
                        <label class="text-xs font-black uppercase text-gray-400 block mb-1">Bio</label>
                        <textarea name="bio" rows="4"
                            placeholder="Short bio (max 300 chars)..."
                            
                            class="rounded-md w-full border text-sm placeholder:text-(--color-text-muted) border-(--color-border) focus:border-(--color-primary) outline-none p-3 resize-none @error('bio') invalid-input @enderror">{{ old('bio', $author->bio ?? '') }}</textarea>
                        @error('bio')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Social Links --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-black uppercase text-gray-400 block mb-1">LinkedIn URL</label>
                            <input type="url" name="linkedin_url"
                                value="{{ old('linkedin_url', $author->linkedin_url ?? '') }}"
                                placeholder="https://linkedin.com/in/..."
                                class="rounded-md w-full border text-sm placeholder:text-(--color-text-muted) border-(--color-border) focus:border-(--color-primary) outline-none p-3 @error('linkedin_url') invalid-input @enderror">
                            @error('linkedin_url')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="text-xs font-black uppercase text-gray-400 block mb-1">Twitter / X URL</label>
                            <input type="url" name="twitter_url"
                                value="{{ old('twitter_url', $author->twitter_url ?? '') }}"
                                placeholder="https://x.com/..."
                                class="rounded-md w-full border text-sm placeholder:text-(--color-text-muted) border-(--color-border) focus:border-(--color-primary) outline-none p-3 @error('twitter_url') invalid-input @enderror">
                            @error('twitter_url')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                </div>

                {{-- Right: Sidebar --}}
                <div class="bg-(--color-background) rounded-br-2xl p-6 shadow space-y-4">

                    <p class="text-xs font-black uppercase text-gray-400 tracking-widest">
                        {{ isset($author) ? 'Edit Author' : 'New Author' }}
                    </p>

                    {{-- Avatar --}}
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase block mb-2">Profile Photo</label>

                        {{-- Preview --}}
                        @isset($author->image)
                            <img id="avatar-preview" src="{{ asset('storage/' . $author->image) }}"
                                class="w-24 h-24 object-cover rounded-full mx-auto mb-3">
                        @else
                            <img id="avatar-preview" src=""
                                class="w-24 h-24 object-cover rounded-full mx-auto mb-3 hidden">
                        @endisset

                        {{-- File picker --}}
                        <label for="image"
                            class="flex items-center gap-3 w-full border-2 border-dashed border-gray-200 hover:border-lime-400 rounded-md p-3 cursor-pointer transition group @error('image') invalid-input @enderror">
                            <div class="w-9 h-9 rounded-lg bg-gray-100 group-hover:bg-indigo-50 flex items-center justify-center shrink-0 transition">
                                <i class="fas fa-image text-gray-400 group-hover:text-indigo-500 transition text-sm"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p id="avatar-label" class="text-xs font-bold text-gray-500 truncate">
                                    {{ isset($author->image) ? 'Replace photo' : 'Choose photo' }}
                                </p>
                                <p class="text-[10px] text-gray-400">JPG, PNG, WEBP · max 4 MB</p>
                            </div>
                            <input id="image" type="file" name="image" accept="image/*" class="hidden">
                        </label>

                        @error('image')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $author->is_active ?? true) ? 'checked' : '' }}
                                class="w-4 h-4 rounded">
                            <span class="text-sm font-bold">Active (visible on site)</span>
                        </label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full btn btn-primary text-white py-3 rounded-xl font-bold text-sm">
                        {{ isset($author) ? 'Update Author' : 'Save Author' }}
                    </button>

                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @unless(isset($author))
        $("#author-name").on('change', function () {
            const name = $(this).val();
            if (!name) return;

            $("button[type=submit]").prop('disabled', true);

            $.ajax({
                url: '{{ route('getSlug') }}',
                type: 'GET',
                data: { name: name },
                dataType: 'json',
                success: function (response) {
                    $("button[type=submit]").prop('disabled', false);
                    if (response.status === true) {
                        $('#author-slug').val(response.slug);
                    }
                },
                error: function () {
                    $("button[type=submit]").prop('disabled', false);
                }
            });
        });
        @endunless

        document.getElementById('image').addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;
            document.getElementById('avatar-label').textContent = file.name;
            const reader = new FileReader();
            reader.onload = e => {
                const preview = document.getElementById('avatar-preview');
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        });

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
            });
        @endif

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Done!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                timer: 2000,
                showConfirmButton: false,
            });
        @endif
    </script>
@endpush