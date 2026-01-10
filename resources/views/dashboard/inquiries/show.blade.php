@extends('dashboard.layout.main')
@section('title', 'View Inquiry')

@section('content')
    <div class="dashboard-form-container pb-20">
        <div class="dashboard-form-header bg-(--color-background)">
            <h3 class="dashboard-form-title">View Inquiry</h3>
            <a href="{{ route('company.inquiries.index') }}" class="btn btn-secondary">Go Back</a>
        </div>

        <div class="bg-(--color-background) rounded-b-2xl shadow-md overflow-hidden">
            <div class="px-6 py-6 space-y-4">

                {{-- Name / Email / Phone --}}
                <div class="grid sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Name</label>
                        <p class="mt-1 px-3 py-2 border border-(--color-border) rounded-md">
                            {{ $inquiry->name }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Email</label>
                        <a href="mailto:{{ $inquiry->email }}"
                           class="mt-1 block px-3 py-2 border rounded-md text-blue-600 hover:underline">
                            {{ $inquiry->email }}
                        </a>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Phone</label>
                        <p class="mt-1 px-3 py-2 border border-(--color-border) rounded-md">
                            {{ $inquiry->phone ?? '-' }}
                        </p>
                    </div>
                </div>

                {{-- Subject --}}
                <div>
                    <label class="block text-sm font-medium text-gray-500">Subject</label>
                    <p class="mt-1 px-3 py-2 border border-(--color-border) rounded-md font-semibold">
                        {{ $inquiry->subject }}
                    </p>
                </div>

                {{-- Message --}}
                <div>
                    <label class="block text-sm font-medium text-gray-500">Message</label>
                    <div
                        class="mt-1 px-4 py-3 border border-(--color-border) rounded-md whitespace-pre-line leading-relaxed">
                        {{ $inquiry->message }}
                    </div>
                </div>

                {{-- Status / IP / Created --}}
                <div class="grid sm:grid-cols-3 gap-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-500">IP Address</label>
                        <p class="mt-1 px-3 py-2 border border-(--color-border) rounded-md">
                            {{ $inquiry->ip_address }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Status</label>
                        <span
                            class="mt-1 inline-block px-3 py-1 rounded-full text-sm font-medium
                            {{ $inquiry->status === 'resolved'
                                ? 'bg-green-100 text-green-800'
                                : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($inquiry->status) }}
                        </span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Received</label>
                        <p class="mt-1 px-3 py-2 border border-(--color-border) rounded-md">
                            {{ $inquiry->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex gap-2 justify-end">

                    {{-- Mark as Resolved --}}
                    @if($inquiry->status !== 'resolved')
                        <form action="{{ route('company.inquiries.update', $inquiry->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="resolved">
                            <button class="btn btn-primary">
                                Mark as Resolved
                            </button>
                        </form>
                    @endif

                </div>

            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <script src="{{ asset('dashboard-assets/js/summernote.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endpush
{{-- @push('styles')
    @vite('resources/css/dashboard-css/form.css')
@endpush --}}
