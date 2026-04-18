 <a href="{{ route('services.companies', ['serviceSlug' => $slug]) }}"
     class="bg-lime-950 text-gray-300 flex justify-center hover:bg-lime-900 items-center gap-1 text-sm px-2.5 py-1.5 font-medium rounded-md cursor-pointer">
     <i class="fa-solid {{ $icon }}"></i>
     <small>{{ $label }}</small>
 </a>
