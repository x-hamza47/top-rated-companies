@extends('dashboard.layout.main')
@section('title', 'View Message')

@section('content')
    <div class="dashboard-form-container pb-20">
        <div class="dashboard-form-header bg-(--color-background)">
            <h3 class="dashboard-form-title">View Contact Message</h3>
            <a href="{{ route('contact.index') }}" class="btn btn-secondary">Go Back</a>
        </div>
        {{-- <pre> {{ print_r($contact, true) }}</pre> --}}

    <div class="bg-(--color-background) rounded-b-2xl shadow-md overflow-hidden">
        <div class="px-6 py-6 space-y-4">
            <!-- From / Email / Phone -->
            <div class="grid sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500">Name</label>
                    <p class="mt-1 px-3 py-2 border border-(--color-border) rounded-md  ">{{ $contact->name }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Email</label>
                    <a href="mailto:{{ $contact->email }}" class="mt-1 block px-3 py-2 border rounded-md  text-blue-600 hover:underline">
                        {{ $contact->email }}
                    </a>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Phone</label>
                    <p class="mt-1 px-3 py-2 border border-(--color-border) rounded-md  ">{{ $contact->phone ?? '-' }}</p>
                </div>
            </div>

            <!-- Subject -->
            <div>
                <label class="block text-sm font-medium text-gray-500">Subject</label>
                <p class="mt-1 px-3 py-2 border border-(--color-border) rounded-md   font-semibold">{{ $contact->subject }}</p>
            </div>

            <!-- Message Body -->
            <div>
                <label class="block text-sm font-medium text-gray-500">Message</label>
                <div class="mt-1 px-4 py-3 border border-(--color-border) rounded-md   whitespace-pre-line leading-relaxed">
                    {{ $contact->message }}
                </div>
            </div>

            <!-- IP, Status, Created At -->
            <div class="grid sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500">IP Address</label>
                    <p class="mt-1 px-3 py-2 border border-(--color-border) rounded-md  ">{{ $contact->ip_address }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Status</label>
                    <span class="mt-1 inline-block px-3 py-1 rounded-full text-sm font-medium
                        {{ $contact->status === 'resolved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ ucfirst($contact->status) }}
                    </span>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Created At</label>
                    <p class="mt-1 px-3 py-2 border border-(--color-border) rounded-md  ">{{ $contact->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-6 flex gap-2 justify-end">
                @if ($contact->status !== 'resolved')
                    <form action="{{ route('contact.resolve', $contact->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-primary cursor-pointer text-white  text-center rounded-md py-2 hover:bg-(--light-primary) font-semibold px-4 ">Mark as Resolved</button>
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
