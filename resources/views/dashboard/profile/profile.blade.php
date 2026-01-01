@extends('dashboard.layout.main')
@section('title', 'Profile')
@push('styles')
    @vite('resources/css/dashboard-css/form.css')
@endpush

@section('content')
    <div class="dashboard-form-container  bg-(--color-background)">
        <div class="dashboard-form-header">
            <h2 class="dashboard-form-title">Personal Info</h2>
        </div>

        <div class="px-6 py-4">
            <form action="{{ route('user.profile.image.update') }}" class="flex items-start gap-5 mt-8 "
                enctype="multipart/form-data" method="POST">
                @csrf
                {{-- ! Profile-pic  --}}
                <div>
                    <div class=" image profile-wrapper">
                        <img src="{{ $user->profile_image
                            ? (Str::startsWith($user->profile_image, 'http')
                                ? $user->profile_image
                                : asset('storage/' . $user->profile_image))
                            : asset('images/dummy.jpg') }}"
                            id="preview" class="profile-image" alt="Profile" />
                        <label for="fileInput" class="edit-icon" title="Upload Pic">
                            <i class="fa-solid fa-pencil"></i>
                        </label>
                    </div>
                    <input type="file" id="fileInput" accept="image/*" name="image" />
                </div>

                <button
                    class="btn btn-primary cursor-pointer text-white  text-center rounded-md py-2 hover:bg-(--light-primary) font-semibold">Upload
                    Profile</button>
                @error('image')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </form>
            <form class="flex flex-col gap-2 mt-4" action="{{ route('user.profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <h3 class="sm:text-3xl text-2xl font-semibold">Account Settings</h3>
                <div class="grid sm:grid-cols-2 gap-4 my-5 transition-all duration-500 ease-in-out">

                    {{-- ! First Name --}}
                    <div>
                        <div class="inp-field w-full">
                            <label class="block mb-2 text-sm text-(--color-text)">First Name</label>
                            <span class="relative h-11">
                                <input type="text" name="firstName" id="firstName" placeholder="John"
                                    value="{{ old('firstName', $user->firstName) }}"
                                    class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-3 @error('firstName') invalid-input @enderror"
                                    data-original="{{ $user->firstName }}">
                                <i class="fa-solid fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </span>
                            @error('firstName')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- ! Last Name --}}
                    <div>
                        <div class="inp-field w-full">
                            <label class="block mb-2 text-sm text-(--color-text)">Last Name</label>
                            <span class="relative h-11">
                                <input type="text" name="lastName" id="lastName" placeholder="Doe"
                                    value="{{ old('lastName', $user->lastName) }}"
                                    class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-3 @error('lastName') invalid-input @enderror"
                                    data-original="{{ $user->lastName }}">
                                <i class="fa-solid fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </span>
                            @error('lastName')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- ! Phone --}}
                    <div>
                        <div class="inp-field w-full">
                            <label class="block mb-2 text-sm text-(--color-text)">Phone</label>
                            <span class="relative h-11">
                                <input type="text" name="phone" placeholder="+92 300 1234567"
                                    value="{{ old('phone', $user->phone) }}"
                                    class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-3"
                                    data-original="{{ $user->phone }}">
                                <i class="fa-solid fa-phone absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </span>
                            @error('phone')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- ! Email --}}
                    <div>
                        <div class="inp-field w-full">
                            <label class="block mb-2 text-sm text-(--color-text)">Email</label>
                            <span class="relative h-11">
                                <input type="email" name="email" placeholder="example@mail.com"
                                    value="{{ old('email', $user->email) }}"
                                    class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-3"
                                    data-original="{{ $user->email }}">
                                <i class="fa-solid fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </span>
                            @error('email')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                </div>

                <div class="flex gap-2.5 flex-wrap">

                    <button type="submit"
                        class="bg-(--color-secondary) cursor-pointer text-white w-max px-6 text-center rounded-md py-2 hover:bg-(--color-primary) font-semibold peer-has-not-checked:hidden peer-has-checked:block text-nowrap" id="user-submit">Save
                        Changes</button>
                    <a
                        class="outline flex items-center justify-center outline-(--color-muted) cursor-pointer text-gray-400 w-max text-wrap px-6 text-center rounded-md py-1 hover:bg-(--color-muted-100) font-semibold peer-has-not-checked:hidden peer-has-checked:block">Cancel</a>
                    <button type="button" class="btn btn-primary mt-2 sm:ml-auto" id="togglePasswordFields">
                        Change Password
                    </button>
                </div>


            </form>

            {{-- ? Hidden Password Fields --}}
            @include('dashboard.profile.changePassword')


        </div>

    </div>

@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="{{ asset('assets/js/password.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#togglePasswordFields').click(function() {
                const $fields = $('#passwordFields');

                if ($fields.hasClass('max-h-0')) {
                    const scrollHeight = $fields.prop('scrollHeight') + "px";
                    $fields.css('max-height', scrollHeight).removeClass('max-h-0');
                } else {
                    $fields.css('max-height', '0').addClass('max-h-0');
                }
            });

            // ! Prevent form submission
            const $form = $('form[action="{{ route('user.profile.update') }}"]');
            if ($form.length) {
                const $inputs = $form.find('input[name]');

      
                $inputs.each(function() {
                    const $input = $(this);
                    if (!$input.data('original')) {
                        $input.data('original', $input.val());
                    }
                });

                $form.on('submit', function(e) {
                    let changed = false;

                    $inputs.each(function() {
                        const $input = $(this);
                        if ($input.val() !== $input.data('original')) {
                            changed = true;
                            return false; 
                        }
                    });

                    if (!changed) {
                        e.preventDefault();
                        
                        alert('No changes detected.');
                    }
                });
            }

        });
    </script>

    <script>
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
    </script>
@endpush
