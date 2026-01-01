<div class="step-1 px-6 py-4 bg-(--color-background) rounded-b-2xl">
                <h2 class="sm:text-3xl text-2xl font-semibold">Company Info</h2>
                <div class="grid sm:grid-cols-2 gap-4 my-5 transition-all duration-500 ease-in-out ">
                    <div>
                        <div class="inp-field w-full ">
                            <label class="block mb-2 text-sm text-(--color-text)">Company Name</label>
                            <span class="relative h-11">
                                <input type="text" placeholder="John" name="name"
                                    class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none  placeholder:text-gray-400 pl-10 pr-9 py-3 @error('name') invalid-input @enderror"
                                    id="name" value="{{ old('name', $company->name ?? '') }}">
                                <i class="fa-solid fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </span>
                            {{-- @error('firstName')
                                            <span class="error">
                                                <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                                <p class="error-text">{{ $message }}</p>
                                            </span>
                                        @enderror --}}
                        </div>
                    </div>
                    <div>
                        <div class="inp-field w-full ">
                            <label class="block mb-2 text-sm text-(--color-text)">Tagline</label>
                            <span class="relative h-11">
                                <input type="text" placeholder="We build great products" name="tagline"
                                    class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-3 @error('tagline') invalid-input @enderror"
                                    value="{{ old('name', $company->tagline ?? '') }}">
                                <i
                                    class="fa-solid fa-comment-dots absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </span>
                            {{-- @error('tagline')
                                            <span class="error">
                                                <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                                <p class="error-text">{{ $message }}</p>
                                            </span>
                                        @enderror --}}
                        </div>
                    </div>
                    <div>
                        <div class="inp-field w-full ">
                            <label class="block mb-2 text-sm text-(--color-text)">Slug</label>
                            <span class="relative">
                                <input type="text" placeholder="https://company.com" name="slug"
                                    class="rounded-md text-(--color-muted) w-full h-full border-2 border-gray-400/40  outline-none placeholder:text-gray-400 pl-10 pr-9 py-3 @error('tagline') invalid-input @enderror"
                                    id="slug" value="{{ old('slug', $company->slug ?? '') }}" readonly>
                                <i class="fa-solid fa-link absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </span>
                            {{-- @error('tagline')
                                            <span class="error">
                                                <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                                <p class="error-text">{{ $message }}</p>
                                            </span>
                                        @enderror --}}
                        </div>
                    </div>
                    <div>
                        <div class="inp-field w-full ">
                            <label class="block mb-2 text-sm text-(--color-text)">Founded Year</label>
                            <span class="relative">
                                <input type="number" placeholder="2018" name="founded"
                                    class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-3 @error('tagline') invalid-input @enderror"
                                    value="{{ old('founded', $company->details->founded ?? '') }}">
                                <i class="fa-solid fa-calendar absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </span>
                            {{-- @error('tagline')
                                            <span class="error">
                                                <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                                <p class="error-text">{{ $message }}</p>
                                            </span>
                                        @enderror --}}
                        </div>
                    </div>
                </div>
                <div>
                    <div class="inp-field w-full ">
                        <label class="block mb-2 text-sm text-(--color-text)">About</label>
                        <textarea name="about" class="summernote text-red-700">{{ old('about', $company->about ?? '') }}</textarea>
                        {{-- @error('tagline')
                                        <span class="error">
                                            <i class="fa-solid fa-circle-exclamation error-icon"></i>
                                            <p class="error-text">{{ $message }}</p>
                                        </span>
                                    @enderror --}}
                    </div>
                </div>
            </div>