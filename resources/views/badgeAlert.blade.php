@if (session('success'))
<div class="flex items-center space-x-2.5 border border-green-500/30 rounded-full bg-green-500/10 p-1 text-sm text-green-500 mb-4 alert">
    <div class="flex items-center space-x-1 bg-green-500 text-white border border-green-500/30 rounded-2xl px-3 py-1">
        <svg width="18" height="16" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 6.5v3.334m0 3.333h.008M8.575 2.217 1.516 14a1.666 1.666 0 0 0 1.425 2.5h14.117a1.667 1.667 0 0 0 1.425-2.5L11.425 2.217a1.667 1.667 0 0 0-2.85 0" stroke="#fff" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <p>Success!</p>
    </div>
    <p class="pr-3">{{ session('success') }}</p>
    <button class="ml-auto text-green-500 hover:text-green-700 close-alert">&times;</button>
</div>
@endif

@if (session('error'))
<div class="flex items-center space-x-2.5 border border-red-500/30 rounded-full bg-red-500/10 p-1 text-sm text-red-500 mb-4 alert">
    <div class="flex items-center space-x-1 bg-red-500 text-white border border-red-500/30 rounded-2xl px-3 py-1">
        <svg width="18" height="16" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10 6.5v3.334m0 3.333h.008M8.575 2.217 1.516 14a1.666 1.666 0 0 0 1.425 2.5h14.117a1.667 1.667 0 0 0 1.425-2.5L11.425 2.217a1.667 1.667 0 0 0-2.85 0" stroke="#fff" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <p>Error!</p>
    </div>
    <p class="pr-3">{{ session('error') }}</p>
    <button class="ml-auto text-red-500 hover:text-red-700 close-alert text-2xl">&times;</button>
</div>
@endif