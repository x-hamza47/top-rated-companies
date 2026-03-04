@extends('dashboard.layout.main')
@section('title', 'Inquiries')

@section('content')
    <div class="dashboard-table-container">
        <div class="dashboard-table-header">
            <h3 class="dashboard-table-title">Your Inquiries</h3>
        </div>
        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Received</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($inquiries as $inquiry)
                    <tr class="text-sm {{ is_null($inquiry->read_at) ? 'bg-lime-950/20 font-bold' : '' }}"
                        onclick="window.location='{{ route('company.inquiries.show', $inquiry->id) }}';"
                        style="cursor: pointer;">
                        <td class="w-max">
                            <div class="table-title-cell max-w-max">
                                <div class="col-info relative">
                                    <div class="col-title-text">
                                        <a href="#" class="sm:text-wrap text-nowrap">{{ $inquiry->name }}</a>
                                    </div>
                                    <div class="col-meta-text peer">
                                        <a href="mailto:{{ $inquiry->email }}" class="text-blue-500">
                                            {{ Str::limit($inquiry->email, 25) }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            {{ Str::limit($inquiry->subject, 40) }}
                        </td>
                        <td>
                            <span class="status-badge {{ $inquiry->status === 'resolved' ? 'success' : 'warning' }}">
                                {{ ucfirst($inquiry->status) }}
                            </span>
                        </td>
                        <td>
                            @php
                                $diffInDays = $inquiry->created_at->diffInDays(now());
                            @endphp
                            {{ $diffInDays < 7 
                                ? $inquiry->created_at->diffForHumans(['parts' => 2, 'short' => true]) 
                                : $inquiry->created_at->format('d M Y') }}
                        </td>
                        <td>
                            <div class="flex justify-center">
                                @if (is_null($inquiry->read_at))
                                    <form action="{{ route('company.inquiries.markRead', $inquiry->id) }}" method="POST" class="inline mr-2">
                                        @csrf
                                        @method('PATCH')
                                        <button onclick="event.stopPropagation()"
                                            class="bg-blue-700 hover:bg-blue-500 text-white p-2 rounded-md text-base transition"
                                            title="Mark Read">
                                            <i class="fas fa-envelope-open"></i>
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('company.inquiries.destroy', $inquiry->id) }}" method="POST"
                                    class="inline delete-inquiry">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="event.stopPropagation()"
                                        class="p-2 rounded-md text-base btn-danger transition" title="Delete">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No inquiries found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $inquiries->onEachSide(2)->links() }}
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.delete-inquiry').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This inquiry will be deleted permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
