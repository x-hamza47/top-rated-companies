@extends('dashboard.layout.main')
@section('title', 'Insights')

@section('content')
    <div class="dashboard-table-container">
        {{-- <pre> {{ print_r($insights->toArray(), true) }}</pre> --}}
        <div class="dashboard-table-header">
            <h3 class="dashboard-table-title">Insights & Articles</h3>
            <a href="{{ route('insights.create') }}" class="btn btn-secondary">Add New</a>
        </div>
        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Service</th>
                    <th>Author</th>
                    <th>Description</th>
                    <th>Published</th>
                    <th class="text-center!">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($insights as $insight)
                    <tr class="text-sm">
                        <td class="w-max">
                            <div class="table-title-cell max-w-max">

                                <div class="col-info relative">
                                    <div class="col-title-text">
                                        <a href="#"
                                            class="sm:text-wrap text-nowrap">{{ Str::limit($insight->title, 30) }}</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge success">
                                {{ $insight->service?->name ?? 'N/A' }}
                            </span>
                        </td>
                        {{-- Author --}}
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="col-icon">
                                    <img src="{{ $insight->user->profile_image ? (!Str::startsWith($insight->user->profile_image, 'http') ? asset('storage/' . $insight->user->profile_image) : $insight->user->profile_image) : asset('images/dummy.jpg') }}"
                                        alt="" class="w-full h-full rounded-full">
                                </div>
                                <span class="flex flex-col">
                                    {{ $insight->user->firstName }}{{ $insight->user->lastName }}

                                    <a class="text-xs text-blue-500 text-nowrap"
                                        href="mailto:{{ $insight->user->email }}">{{ Str::limit($insight->user->email, 25) }}</a>

                                </span>
                            </div>
                        </td>
                        <td>
                            {{ Str::limit($insight->description, 40) }}
                        </td>
                        <td>
                            @php
                                $diffInDays = $insight->created_at->diffInDays(now());
                            @endphp

                            {{ $diffInDays < 7 ? $insight->created_at->diffForHumans(['parts' => 2, 'short' => true]) : $insight->created_at->format('d M Y') }}
                        </td>

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
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No Insight found.</td>
                    </tr>
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
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
    
@endpush
