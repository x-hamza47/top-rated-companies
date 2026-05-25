@extends('dashboard.layout.main')
@section('title', 'Authors')

@section('content')
    <div class="dashboard-table-container">
        <div class="dashboard-table-header">
            <h3 class="dashboard-table-title">Authors</h3>
            <a href="{{ route('authors.create') }}" class="btn btn-secondary">Add New</a>
        </div>

        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>Author</th>
                    <th>Designation</th>
                    <th>Company</th>
                    <th>Status</th>
                    <th class="text-center!">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($authors as $author)
                    <tr class="text-sm">

                        {{-- Author Info --}}
                        <td>
                            <div class="table-title-cell max-w-max">
                                <div class="col-icon">
                                    @if ($author->image)
                                        <img src="{{ asset('storage/' . $author->image) }}"
                                            alt="{{ $author->name }}"
                                            class="w-full h-full rounded-full object-cover">
                                    @else
                                        <div class="w-full h-full rounded-full bg-gray-100 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-400 text-sm"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-info">
                                    <div class="col-title-text">
                                        <a href="#" class="sm:text-wrap text-nowrap">{{ $author->name }}</a>
                                    </div>
                                    <div class="col-meta-text">{{ $author->slug }}</div>
                                </div>
                            </div>
                        </td>

                        {{-- Designation --}}
                        <td>
                            {{ $author->designation ?? '—' }}
                        </td>

                        {{-- Company --}}
                        <td>
                            @if ($author->company)
                                <span class="status-badge success">{{ $author->company }}</span>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>

                        {{-- Status --}}
                        <td>
                            @if ($author->is_active)
                                <span class="status-badge success">Active</span>
                            @else
                                <span class="status-badge danger">Hidden</span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td>
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('authors.edit', $author->id) }}"
                                    class="bg-blue-700 hover:bg-blue-500 text-white p-2 rounded-md text-base transition"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('authors.destroy', $author->id) }}" method="POST"
                                    class="inline delete-author-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-md text-base btn-danger transition"
                                        title="Delete">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No authors found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $authors->onEachSide(2)->links() }}
    </div>
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-author-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This author will be deleted permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });
    </script>
@endpush