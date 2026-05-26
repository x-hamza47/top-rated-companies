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

        {{-- FILTERS --}}
        <div class="dashboard-table-header">
            <h3 class="dashboard-table-title">Companies & Details</h3>
            @can('admin')
                <a href="{{ route('companies.edit') }}" class="btn btn-secondary">
                    <i class="fas fa-plus text-xs"></i> Add New
                </a>
            @endcan
        </div>
        {{-- FILTERS --}}
        <form method="GET" action="{{ route('companies.index') }}"
            class="flex flex-wrap gap-3 items-center px-6 py-4 border-b border-(--color-border)">

            {{-- Search --}}
            <div class="relative flex-1 min-w-[200px]">
                <i
                    class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-(--color-text-muted) text-sm pointer-events-none"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search by name or location..."
                    class="w-full pl-9 pr-4 py-2 text-sm rounded-xl bg-(--color-surface) border border-(--color-border) text-(--color-text) placeholder:text-(--color-text-muted) focus:outline-none focus:border-(--color-primary) focus:ring-2 focus:ring-(--color-primary-100) transition" />
            </div>

            {{-- Verified --}}
            <select name="verified"
                class="px-3 py-2 text-sm rounded-xl bg-(--color-surface) border border-(--color-border) text-(--color-text) focus:outline-none focus:border-(--color-primary) focus:ring-2 focus:ring-(--color-primary-100) transition min-w-[130px]">
                <option value="">All Verified</option>
                <option value="1" {{ request('verified') === '1' ? 'selected' : '' }}>✓ Verified</option>
                <option value="0" {{ request('verified') === '0' ? 'selected' : '' }}>✗ Unverified</option>
            </select>

            {{-- Listed --}}
            <select name="is_listed"
                class="px-3 py-2 text-sm rounded-xl bg-(--color-surface) border border-(--color-border) text-(--color-text) focus:outline-none focus:border-(--color-primary) focus:ring-2 focus:ring-(--color-primary-100) transition min-w-[130px]">
                <option value="">All Listed</option>
                <option value="1" {{ request('is_listed') === '1' ? 'selected' : '' }}>● Listed</option>
                <option value="0" {{ request('is_listed') === '0' ? 'selected' : '' }}>○ Unlisted</option>
            </select>

            {{-- Actions --}}
            <div class="flex gap-2 ml-auto">
                <button type="submit" class="btn btn-secondary text-sm">
                    <i class="fas fa-filter text-xs"></i> Filter
                </button>
                @if (request()->hasAny(['search', 'location', 'verified', 'is_listed']))
                    <a href="{{ route('companies.index') }}"
                        class="btn text-sm text-(--color-text-muted) border border-(--color-border) hover:bg-(--color-surface-hover)">
                        <i class="fas fa-xmark text-xs"></i> Clear
                    </a>
                @endif
            </div>
        </form>
        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>Company</th>
                    <th>Hourly Rate</th>
                    <th>Employees</th>
                    <th>Verified</th>
                    <th>Location</th>
                    <th>Joined Date</th>
                    <th class="text-center!">Status</th>
                    <th class="text-center!">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($companies as $company)
                    <tr class="text-sm">
                        <td class="w-max">
                            <div class="table-title-cell max-w-max">
                                <div class="col-icon">
                                    <img src="{{ $company->logo && !Str::startsWith($company->logo, 'http') ? asset('storage/' . $company->logo) : ($company->logo ?: asset('images/dummy.jpg')) }}"
                                        alt="" class="w-full h-full rounded-full">
                                </div>
                                <div class="col-info relative">
                                    <div class="col-title-text">
                                        <a href="#" class="sm:text-wrap text-nowrap">{{ $company->name }}</a>
                                    </div>
                                    <div class="col-meta-text peer">
                                        {{ Str::limit($company->tagline, 20) }} •
                                        {{ $company->services_count }}
                                        service{{ $company->services_count > 1 ? 's' : '' }}
                                    </div>
                                    {{-- Services Tooltip --}}
                                    <div
                                        class="absolute bottom-3.5 right-0 transform translate-y-2 mt-2 bg-(--color-background) text-white text-xs rounded-xl border border-(--color-border) px-8 py-4 transition opacity-0 peer-hover:translate-y-0 duration-200 z-50 pointer-events-none peer-hover:opacity-100 flex flex-col gap-2">
                                        <span class="text-(--color-muted)">Services</span>
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
                        <td>${{ str_replace('-', ' - $', $company->details?->hourly_rate) }}</td>
                        <td>{{ $company->details?->is_freelancer ? 'Freelancer' : $company->details?->employees_range }}
                        </td>
                        <td>

                            <label class="cursor-pointer inline-flex">
                                <input type="checkbox" class="sr-only toggle-verified"
                                    data-url="{{ route('companies.toggleVerified', $company->id) }}"
                                    {{ $company->verified ? 'checked' : '' }}>
                                <span
                                    class="toggle-label select-none status-badge {{ $company->verified ? 'success' : 'warning' }}">
                                    {{ $company->verified ? 'Verified' : 'Unverified' }}
                                </span>
                            </label>

                        </td>
                        <td>{{ $company->details?->locations }}</td>
                        <td>
                            {{ $company->created_at->format('d M Y') }}
                        </td>

                        {{-- IS LISTED TOGGLE --}}
                        <td class="text-center">
                            <label class="cursor-pointer inline-flex">
                                <input type="checkbox" class="sr-only toggle-listed"
                                    data-url="{{ route('companies.toggleListed', $company->id) }}"
                                    {{ $company->is_listed ? 'checked' : '' }}>
                                <span
                                    class="toggle-label select-none status-badge {{ $company->is_listed ? 'info' : 'danger' }}">
                                    {{ $company->is_listed ? 'Listed' : 'Unlisted' }}
                                </span>
                            </label>
                        </td>

                        <td>
                            <div class="flex justify-center items-center gap-1">
                                <a href="{{ route('companies.edit', $company->id) }}"
                                    class="mr-2 bg-blue-700 hover:bg-blue-500 text-white p-2 rounded-md text-base transition"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                                    class="delete-company-form inline">
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
                        <td colspan="7" class="text-center py-4">No companies found.</td>
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
    <script>
        // Delete confirm
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
                    if (result.isConfirmed) form.submit();
                });
            });
        });

        // Toggle is_listed
        function debounce(fn, delay = 400) {
            let timer;
            return function(...args) {
                clearTimeout(timer);
                timer = setTimeout(() => fn.apply(this, args), delay);
            };
        }

        function handleToggle(selector, onText, offText, onClass = 'success', offClass = 'danger') {
            document.querySelectorAll(selector).forEach(checkbox => {
                checkbox.addEventListener('change', debounce(async function() {
                    const url = this.dataset.url;
                    const badge = this.closest('label').querySelector('.toggle-label');
                    const originalChecked = !this.checked;

                    try {
                        const res = await fetch(url, {
                            method: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            }
                        });
                        const data = await res.json();

                        if (data.success) {
                            const isActive = data.is_listed ?? data.verified;
                            badge.textContent = isActive ? onText : offText;
                            badge.classList.toggle(onClass, isActive);
                            badge.classList.toggle(offClass, !isActive);
                        } else {
                            this.checked = originalChecked;
                        }
                    } catch (err) {
                        console.error('Toggle failed', err);
                        this.checked = originalChecked;
                    }
                }, 400));
            });
        }
        handleToggle('.toggle-listed', 'Listed', 'Unlisted', 'info', 'danger');
        handleToggle('.toggle-verified', 'Verified', 'Unverified', 'success', 'warning');
    </script>
@endpush
