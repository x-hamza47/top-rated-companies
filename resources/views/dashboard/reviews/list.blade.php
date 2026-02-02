@extends('dashboard.layout.main')
@section('title', 'Reviews')

@section('content')
    <div class="dashboard-table-container">

        <div class="dashboard-table-header">
            <h3 class="dashboard-table-title">Reviews</h3>
            {{-- @can('admin')
                <a href="{{ route('reviews.create') }}" class="btn btn-secondary">Add New</a>
            @endcan --}}
        </div>
        {{-- <pre> {{ print_r($reviews->toArray(), true) }}</pre> --}}
        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>Reviewer</th>
                    <th>Service</th>
                    <th>Company</th>
                    @can('admin')
                        <th>Rating</th>
                    @endcan
                    <th>Project</th>
                    <th>Submitted</th>
                    <th class="text-center!">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reviews as $review)
                    <tr class="text-sm">
                        <td class="w-max">
                            <div class="table-title-cell max-w-max">
                                <div class="col-info relative">
                                    <div class="col-title-text">
                                        <a href="#" class="sm:text-wrap text-nowrap">{{ $review->reviewer_name }}</a>
                                    </div>
                                    <div class="col-meta-text peer">
                                        <a href="mailto:{{ $review->reviewer_email }}" class="text-blue-500">
                                            {{ Str::limit($review->reviewer_email, 25) }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>{{ $review->service?->name ?? 'N/A' }}</td>


                        @can('admin')
                            <td class="w-max">
                                <div class="table-title-cell max-w-max">
                                    <div class="col-info relative">
                                        <div class="col-title-text">
                                            <a href="#"
                                                class="sm:text-wrap text-nowrap">{{ $review->reviewer_company }}</a>
                                        </div>
                                        <div class="col-meta-text peer">
                                            <a href="mailto:{{ $review->company->user->email }}" class="text-blue-500">
                                                {{ Str::limit($review->company->user->email, 25) }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        @endcan
                        <td>{{ $review->rating }}/5</td>

                        <td>{{ $review->project_title ?? 'N/A' }}</td>

                        <td>
                            @php
                                $diffInDays = $review->created_at->diffInDays(now());
                            @endphp
                            {{ $diffInDays < 7 ? $review->created_at->diffForHumans(['parts' => 2, 'short' => true]) : $review->created_at->format('d M Y') }}
                        </td>

                        <td>
                            <div class="flex justify-center gap-2">

                                {{-- <a href="{{ route('reviews.edit', $review->id) }}"
                                    class="bg-blue-700 hover:bg-blue-500 text-white p-2 rounded-md text-base transition"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a> --}}



                                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST"
                                    class="inline delete-review-form">
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
                        <td colspan="8" class="text-center py-4">No Reviews found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $reviews->onEachSide(2)->links() }}
    </div>
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-review-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This review will be deleted permanently!",
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
