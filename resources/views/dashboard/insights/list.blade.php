@extends('dashboard.layout.main')
@section('title', 'Insights')

@section('content')
    <div class="dashboard-table-container">
        <div class="dashboard-table-header">
            <h3 class="dashboard-table-title">Insights & Articles</h3>
            <a href="{{ route('insights.create') }}" class="btn btn-secondary">Add New</a>
        </div>
        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Service</th>
                    @can('admin')
                        <th>Author</th>
                    @endcan
                    <th>Description</th>
                    <th>Published</th>
                    <th class="text-center!">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($insights as $insight)
                    <tr class="text-sm">

                        {{-- Title --}}
                        <td class="w-max">
                            <div class="table-title-cell max-w-max">
                                <div class="col-info relative">
                                    <div class="col-title-text">
                                        <a href="{{ route('insights.showInsight', $insight->slug) }}"
                                            class="sm:text-wrap text-nowrap" target="_blank">
                                            {{ Str::limit($insight->title, 30) }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>

                        {{-- Service --}}
                        <td>
                            <span class="status-badge success">
                                {{ $insight->service?->name ?? 'N/A' }}
                            </span>
                        </td>

                        {{-- Author (admin only) --}}
                        @can('admin')
                            <td>
                                <div class="flex items-center gap-2">
                                    <div class="col-icon">
                                        <img src="{{ $insight->author?->profile_image
                                            ? (!Str::startsWith($insight->author->profile_image, 'http')
                                                ? asset('storage/' . $insight->author->profile_image)
                                                : $insight->author->profile_image)
                                            : asset('images/dummy.jpg') }}"
                                            alt="" class="w-full h-full rounded-full">
                                    </div>
                                    <span class="flex flex-col">
                                        {{ $insight->author?->name ?? 'N/A' }}
                                        <span class="text-xs text-gray-400">{{ $insight->author?->designation }}</span>
                                    </span>
                                </div>
                            </td>
                        @endcan

                        {{-- Description --}}
                        <td>
                            {{ Str::limit($insight->excerpt, 40) }}
                        </td>
                        {{-- Published --}}
                        <td>
                            @php
                                $diffInDays = $insight->created_at->diffInDays(now());
                            @endphp
                            {{ $diffInDays < 7
                                ? $insight->created_at->diffForHumans(['parts' => 2, 'short' => true])
                                : $insight->created_at->format('d M Y') }}
                        </td>

                        {{-- Actions --}}
                        <td>
                            <div class="flex">
                                <a href="{{ route('insights.edit', $insight->id) }}"
                                    class="mr-2 bg-blue-700 hover:bg-blue-500 text-white p-2 rounded-md text-base transition"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('insights.destroy', $insight->id) }}" method="POST"
                                    class="inline delete-insight-form">
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
                    <td colspan="{{ auth()->user()->can('admin') ? 6 : 5 }}" class="text-center py-4">
                        No Insight found.
                    </td>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $insights->onEachSide(2)->links() }}
    </div>
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-insight-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This insight will be deleted permanently!",
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
