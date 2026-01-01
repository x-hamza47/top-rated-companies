@php
    $hasPasswordErrors = $errors->hasAny(['current_password', 'new_password', 'new_password_confirmation']);
@endphp
<div id="passwordFields" 
    class="overflow-hidden transition-all duration-500 ease-in-out mt-4 space-y-5 {{ $hasPasswordErrors ? '' : 'max-h-0' }}">
    <h3 class="sm:text-3xl text-2xl font-semibold ">Security Settings</h3>
    <form action="{{ route('user.change.password') }}" method="POST" class="flex flex-col gap-4">
        @csrf
        @method('PUT')
        {{-- Current Password --}}
        <div>
            <div class="inp-field w-full">
                <label class="block mb-2 text-sm text-(--color-text)">Current Password</label>
                <span class="relative h-11">
                    <input type="password" placeholder="Current Password" name="current_password"
                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-3 @error('current_password') invalid-input @enderror">
                    <i class="fa-solid fa-eye text-lg text-gray-400 cursor-pointer show-icon"></i>
                    <i class="fa-solid fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </span>
                @error('current_password')
                    <span class="error">
                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                        <p class="error-text">{{ $message }}</p>
                    </span>
                @enderror
            </div>
        </div>

        {{-- New Password --}}
        <div>
            <div class="inp-field w-full">
                <label class="block mb-2 text-sm text-(--color-text)">New Password</label>
                <span class="relative h-11">
                    <input type="password" placeholder="New Password" name="new_password"
                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-3 @error('new_password') invalid-input @enderror">
                    <i class="fa-solid fa-eye text-lg text-gray-400 cursor-pointer show-icon"></i>
                    <i class="fa-solid fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </span>
                @error('new_password')
                    <span class="error">
                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                        <p class="error-text">{{ $message }}</p>
                    </span>
                @enderror
            </div>
        </div>

        {{-- Confirm Password --}}
        <div>
            <div class="inp-field w-full">
                <label class="block mb-2 text-sm text-(--color-text)">Confirm Password</label>
                <span class="relative h-11">
                    <input type="password" placeholder="Confirm Password" name="new_password_confirmation"
                        class="rounded-md w-full h-full border-2 border-gray-400/40 focus:border-(--color-primary) outline-none placeholder:text-gray-400 pl-10 pr-9 py-3 @error('new_password_confirmation') invalid-input @enderror">
                    <i class="fa-solid fa-eye text-lg text-gray-400 cursor-pointer show-icon"></i>
                    <i class="fa-solid fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </span>
                @error('new_password_confirmation')
                    <span class="error">
                        <i class="fa-solid fa-circle-exclamation error-icon"></i>
                        <p class="error-text">{{ $message }}</p>
                    </span>
                @enderror
            </div>
        </div>

        <button type="submit"
            class="bg-(--color-secondary) cursor-pointer text-white w-max text-wrap px-6 text-center rounded-md py-2 hover:bg-(--color-primary) font-semibold peer-has-not-checked:hidden peer-has-checked:block">Update
            Password</button>
    </form>
</div>
