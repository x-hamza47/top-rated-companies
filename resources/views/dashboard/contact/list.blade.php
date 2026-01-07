@extends('dashboard.layout.main')
@section('title', 'Messages')

@section('content')
    <div class="dashboard-table-container">
        {{-- <pre> {{ print_r($insights->toArray(), true) }}</pre> --}}
        <div class="dashboard-table-header">
            <h3 class="dashboard-table-title">Contact Messages</h3>
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
                @forelse ($messages as $message)
                    <tr class="text-sm {{ in_array($message->id, $unreadNotificationIds) ? 'bg-lime-950/20 font-bold' : '' }}"
                        onclick="window.location='{{ route('contact.show', $message->id) }}';"
                        style="cursor: pointer;">
                        <td class="w-max">
                            <div class="table-title-cell max-w-max">

                                <div class="col-info relative">
                                    <div class="col-title-text"><a href=""
                                            class="sm:text-wrap text-nowrap">{{ $message->name }}</a>
                                    </div>
                                    <div class="col-meta-text peer">
                                        <a href="mailto:{{ $message->email }}" class="text-blue-500">
                                            {{ Str::limit($message->email, 25) }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            {{ Str::limit($message->subject, 40) }}
                        </td>
                        <td>
                            <span class="status-badge {{ $message->status === 'resolved' ? 'success' : 'warning' }}">
                                {{ ucfirst($message->status) }}
                            </span>
                        </td>
                        <td>
                            @php
                                $diffInDays = $message->created_at->diffInDays(now());
                            @endphp

                            {{ $diffInDays < 7 ? $message->created_at->diffForHumans(['parts' => 2, 'short' => true]) : $message->created_at->format('d M Y') }}
                        </td>
                        <td>
                            <div class="flex">
                                @if (in_array($message->id, $unreadNotificationIds))
                                    <form action="{{ route('contact.markRead', $message->id) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button onclick="event.stopPropagation()"
                                            class="mr-2 bg-blue-700 hover:bg-blue-500 text-white p-2 rounded-md text-base transition"
                                            title="Mark Read">
                                            <i class="fas fa-envelope-open"></i>
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('contact.destroy', $message->id) }}" method="POST"
                                    class="inline delete-message">
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
                        <td colspan="6" class="text-center py-4">No Messages found.</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $messages->onEachSide(2)->links() }}
    </div>
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-message').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This message will be deleted permanently!",
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
