@extends('dashboard.layout.main')
@section('title', 'Company')
@php
    $colors = [
        'text-lime-600',
        'text-purple-500',
        'text-blue-400',
        'text-pink-400',
        'text-yellow-400',
        'text-indigo-500',
    ];
@endphp

@section('content')
    <div class="dashboard-table-container">
        {{-- <pre> {{ print_r($packages->toArray(), true) }}</pre> --}}
        <div class="dashboard-table-header">
            <h3 class="dashboard-table-title">
                Packages

                @can('company')
                    <span class="text-sm text-gray-400">
                        ({{ $packageCount }} / 5)
                    </span>
                @endcan
            </h3>
            @can('company')
                @if ($packageCount < 5)
                    <a href="{{ route('packages.create') }}" class="btn btn-secondary">
                        Add Package
                    </a>
                @endif
            @endcan
        </div>
        <table class="dashboard-table">
            <thead>
                <tr class="align-middle">
                    @can('admin')
                        <th rowspan="2">Company</th>
                        <th rowspan="2">Total Packages</th>
                    @endcan


                    @can('company')
                        <th rowspan="2">Service</th>
                        <th colspan="3" class="text-center! border-b">Price</th>
                        <th rowspan="2">Type</th>
                    @endcan


                    <th rowspan="2" class="text-center">Action</th>
                </tr>
                @can('company')
                    <tr class="[&>th]:text-center!">
                        <th>Small</th>
                        <th>Medium</th>
                        <th>Large</th>
                    </tr>
                @endcan
            </thead>

            <tbody>
                @forelse ($packages as $item)
                    <tr class="text-sm">
                        {{-- ADMIN ROW --}}
                        @can('admin')
                            <td class="w-max">
                                <div class="table-title-cell max-w-max">

                                    <div class="col-info">
                                        <div class="col-title-text"><a href="#"
                                                class="sm:text-wrap text-nowrap">{{ $item->name }}</a>
                                        </div>
                                        <div class="col-meta-text "><a class="text-xs text-blue-500 text-nowrap"
                                                href="mailto:{{ $item->user->email }}">{{ Str::limit($item->user->email, 35) }}</a>
                                        </div>

                                    </div>
                                </div>

                            </td>
                            <td>{{ $item->packages_count }}</td>
                        @endcan

                        {{-- COMPANY ROW --}}
                        @can('company')
                            <td  class="w-max">{{ $item->service->name }}</td>
                            <td class="text-center"> <span class="status-badge success">${{ $item->small_price }}</span>  </td>
                            <td class="text-center"> <span class="status-badge info">${{ $item->medium_price }}</span>  </td>
                            <td class="text-center"> <span class="status-badge warning">${{ $item->large_price }}</span>  </td>
   


                            <td class="capitalize">{{ $item->price_type }}</td>
                        @endcan

                        {{-- ACTIONS --}}
                        <td class="text-center">
                            @can('admin')
                                <a href="" {{-- <a href="{{ route('admin.company.packages', $item->id) }}" --}} class="btn btn-secondary">
                                    View
                                </a>
                            @endcan

                            @can('company')
                                <a href="{{ route('packages.edit', $item->id) }}"
                                    class="mr-2 bg-blue-700 hover:bg-blue-500 text-white p-2 rounded-md text-base transition"
                                    title="Edit">
                                    <i class="fas fa-edit "></i>
                                </a>

                                <form action="{{ route('packages.destroy', $item->id) }}" method="POST"
                                    class="inline delete-package-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-md text-base btn-danger transition"
                                        title="Delete">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            No data found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @can('admin')
        <div class="mt-4">
            {{ $packages->onEachSide(2)->links() }}
        </div>
    @endcan
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-package-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This package will be deleted permanently!",
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
