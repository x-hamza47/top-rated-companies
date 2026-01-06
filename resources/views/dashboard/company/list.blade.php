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
        {{-- <pre> {{ print_r($companies->toArray(), true) }}</pre> --}}
        <div class="dashboard-table-header">
            <h3 class="dashboard-table-title">Companies & Details</h3>
            {{-- <a href="#" class="btn btn-secondary">Add New</a> --}}
        </div>
        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>Company</th>
                    <th>Hourly Rate</th>
                    <th>Employees</th>
                    <th>Verified</th>
                    <th>Location</th>
                    <th class="text-center!">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($companies as $company)
                    <tr class="text-sm">
                        <td class="w-max">
                            <div class="table-title-cell max-w-max">
                                <div class="col-icon">
                                    <img src="{{ $company?->logo ? (!Str::startsWith($company->logo, 'http') ? asset('storage/' . $company->logo) : $company->logo) : asset('images/dummy.jpg') }}" alt="" class="w-full h-full rounded-full">
                                </div>
                                <div class="col-info relative">
                                    <div class="col-title-text"><a href="#"
                                            class="sm:text-wrap text-nowrap">{{ $company->name }}</a>
                                    </div>
                                    <div class="col-meta-text peer">{{ Str::limit($company->tagline, 20) }} •
                                        {{ $company->services_count }} service{{ $company->services_count > 1 ? 's' : '' }}
                                    </div>
                                    <div
                                        class="absolute bottom-3.5 right-0 transform translate-y-2  mt-2  bg-(--color-background) text-white text-xs rounded-xl border border-(--color-border) px-8 py-4 transition opacity-0 peer-hover:translate-y-0 duration-200 z-50 pointer-events-none peer-hover:opacity-100 flex flex-col gap-2">
                                        <span class="text-(--color-muted) ">Services</span>
                                        <ul class="list-disc space-y-3 text-gray-300 w-max">
                                            @foreach ($company->services as $index => $service)
                                                <li>{{ $service->name }} - <b
                                                        class="{{ $colors[$index % count($colors)] }}">{{ $service->pivot->expertise_percentage }}%</b>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $company->details->hourlyRate }}</td>
                        <td>{{ $company->details->employees }}</td>
                        <td><span
                                class="status-badge {{ $company->verified ? 'success' : 'danger' }}">{{ $company->verified ? 'Verified' : 'Unverified' }}</span>
                        </td>
                        <td>{{ $company->details->locations }}</td>
                        <td>
                            <a href="{{ route('companies.edit', $company->id) }}" class="mr-2 bg-blue-700 hover:bg-blue-500 text-white p-2 rounded-md text-base transition" title="Edit">
                                <i class="fas fa-edit "></i>
                            </a>

                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="delete-company-form inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-md text-base btn-danger transition" title="Delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr> 


                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No companies found.</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $companies->onEachSide(2)->links() }}
    </div>
@endsection

@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete-company-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "This company will be deleted permanently!",
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
