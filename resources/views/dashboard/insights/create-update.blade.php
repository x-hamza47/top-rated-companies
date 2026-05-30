@extends('dashboard.layout.main')

@section('content')
    <div class="dashboard-form-container pb-20">

        <div class="dashboard-form-header bg-(--color-background)">
            <h3 class="dashboard-form-title">{{ isset($insight) ? 'Edit Insight' : 'Add Insight' }}</h3>
            <a href="{{ route('insights.index') }}" class="btn btn-secondary">Go Back</a>
        </div>

        <form method="POST" id="post-form"
            action="{{ isset($insight) ? route('insights.update', $insight->id) : route('insights.store') }}"
            enctype="multipart/form-data">

            @csrf
            @isset($insight)
                @method('PUT')
            @endisset

            <div class="grid grid-cols-1 lg:grid-cols-3 ">
                <div class="lg:col-span-2 bg-(--color-background) rounded-bl-2xl p-6">

                    <input type="text" name="title" value="{{ old('title', $insight->title ?? '') }}"
                        placeholder="Post Title..."
                        class="w-full text-2xl text-(--color-primary) placeholder:text-(--color-text-muted) font-semibold border-none outline-none mb-2 focus:ring-0 @error('title') border-b-2 border-red-400 @enderror">

                    @error('title')
                        <span class="error">
                            <i class="fa-solid fa-circle-exclamation error-icon"></i>
                            <p class="error-text">{{ $message }}</p>
                        </span>
                    @enderror

                    <div id="editorjs"
                        class="min-h-[500px] border border-(--color-border) rounded-md p-4 @error('content_json') invalid-input @enderror">
                    </div>

                    @error('content_json')
                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                    @enderror

                    <input type="hidden" name="content_json" id="content_json">

                </div>

                <div class="bg-(--color-background) rounded-br-2xl p-6 shadow space-y-4">

                    <p class="text-xs font-black uppercase text-gray-400 tracking-widest">
                        {{ isset($insight) ? 'Edit Post' : 'New Post' }}
                    </p>

                    {{-- Service --}}
                    <div>
                        <select name="service_id"
                            class="rounded-md w-full border text-sm placeholder:text-(--color-text-muted) border-(--color-border) focus:border-(--color-primary) outline-none p-3 @error('service_id') invalid-input @enderror">
                            <option value="">— No Service —</option>
                            @foreach ($services as $id => $name)
                                <option value="{{ $id }}"
                                    {{ old('service_id', $insight->service_id ?? '') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('service_id')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    {{-- Author --}}
                    <div>
                        <select name="author_id"
                            class="rounded-md w-full border text-sm placeholder:text-(--color-text-muted) border-(--color-border) focus:border-(--color-primary) outline-none p-3 @error('author_id') invalid-input @enderror">
                            <option value="">— No Author —</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}"
                                    {{ old('author_id', $insight->author_id ?? '') == $author->id ? 'selected' : '' }}>
                                    {{ $author->name }}
                                    @if ($author->designation)
                                        · {{ $author->designation }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('author_id')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    @can('admin')
                        <div>
                            <label class="text-xs font-black uppercase text-gray-400 block mb-1">Slug</label>
                            <input type="text" name="slug" value="{{ old('slug', $insight->slug ?? '') }}"
                                placeholder="post-slug"
                                class="rounded-md w-full border text-sm placeholder:text-(--color-text-muted) border-(--color-border) focus:border-(--color-primary) outline-none p-3 font-mono @error('slug') invalid-input @enderror">
                            @error('slug')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-[10px] text-gray-400 mt-1">Leave blank to auto-generate from title.</p>
                        </div>
                    @endcan

                    {{-- Excerpt --}}
                    <div>
                        <input type="text" name="excerpt" value="{{ old('excerpt', $insight->excerpt ?? '') }}"
                            placeholder="Short excerpt..."
                            class="rounded-md w-full border text-sm placeholder:text-(--color-text-muted) border-(--color-border) focus:border-(--color-primary) outline-none p-3 @error('title') invalid-input @enderror">
                        @error('excerpt')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- Read time --}}
                    <div>
                        <input type="number" name="read_time" value="{{ old('read_time', $insight->read_time ?? '') }}"
                            placeholder="Read time (mins)"
                            class="rounded-md w-full border text-sm placeholder:text-(--color-text-muted) border-(--color-border) focus:border-(--color-primary) outline-none p-3 @error('read_time') invalid-input @enderror">
                        @error('read_time')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Thumbnail --}}
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase block mb-2">Thumbnail</label>

                        {{-- Current thumbnail preview --}}
                        @isset($insight->thumbnail_url)
                            <img id="thumb-preview" src="{{ asset($insight->thumbnail_url) }}"
                                class="w-full h-32 object-cover rounded-xl mb-2">
                        @else
                            <img id="thumb-preview" src="" class="w-full h-32 object-cover rounded-xl mb-2 hidden">
                        @endisset

                        {{-- Custom file picker --}}
                        <label for="thumbnail"
                            class="flex items-center gap-3 w-full border-2 border-dashed border-gray-200 hover:border-lime-400 rounded-md p-3 cursor-pointer transition group @error('thumbnail') invalid-input @endif">
                            <div class="w-9 h-9 rounded-lg bg-gray-100 group-hover:bg-indigo-50 flex items-center justify-center shrink-0 transition">
                                <i data-lucide="image-plus" class="w-4 h-4 text-gray-400 group-hover:text-indigo-500 transition"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p id="thumb-label" class="text-xs font-bold text-gray-500 truncate">
                                    {{ isset($insight->thumbnail_url) ? 'Replace image' : 'Choose image' }}
                                </p>
                                <p class="text-[10px] text-gray-400">JPG, PNG, WEBP · max 4 MB</p>
                            </div>
                            <input id="thumbnail" type="file" name="thumbnail" accept="image/*" class="hidden">
                        </label>

                        @error('thumbnail')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Meta title --}}
                    <div>
                        <input type="text"
                            name="meta_title" value="{{ old('meta_title', $insight->meta_title ?? '') }}"
                            placeholder="Meta title"
                            class="rounded-md w-full border text-sm placeholder:text-(--color-text-muted) border-(--color-border) focus:border-(--color-primary) outline-none p-3 @error('meta_title') invalid-input @enderror">
                            @error('meta_title')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                    </div>

                    {{-- Meta description --}}
                    <div>
                        <textarea name="meta_description" placeholder="Meta description"
                            class="rounded-md w-full border text-sm placeholder:text-(--color-text-muted) border-(--color-border) focus:border-(--color-primary) outline-none p-3 @error('meta_description') invalid-input @enderror">{{ old('meta_description', $insight->meta_description ?? '') }}</textarea>
                        @error('meta_description')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    @can('admin')
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_published" value="1"
                                {{ old('is_published', $insight->is_published ?? false) ? 'checked' : '' }}
                                class="w-4 h-4 rounded">
                            <span class="text-sm font-bold">Publish</span>
                        </label>
                    @endcan

                    <button type="button" onclick="submitPost()"
                        class="w-full btn btn-primary text-white py-3 rounded-xl font-bold text-sm">
                        {{ isset($insight) ? 'Update Post' : 'Save Post' }}
                    </button>

                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/image@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/code@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/delimiter@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/table@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/inline-code@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/warning@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/raw@latest"></script>

    <script>
        window.__insightEditorConfig = {
            uploadImageRoute: '{{ route('insights.upload-image') }}',
            deleteTempImageRoute: '{{ route('insights.temp-image.delete') }}',
            getSlugRoute: '{{ route('getSlug') }}',
            existingData: @json(old('content_json') ? json_decode(old('content_json')) : $insight->content_json ?? null),
            isAdmin: @json(auth()->user()?->can('admin')),
        };
    </script>
@endpush

@push('styles')
    @vite('resources/css/editor.css')
@endpush
