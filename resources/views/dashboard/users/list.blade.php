@extends('dashboard.layout.main')
@section('title', 'Users')

@section('content')
    <div class="dashboard-table-container">

        <div class="dashboard-table-header">
            <h3 class="dashboard-table-title">All Users</h3>
        </div>

        {{-- FILTERS --}}
        <form method="GET" action="{{ route('dev.users') }}"
            class="flex flex-wrap gap-3 items-center px-6 py-4 border-b border-(--color-border)">

            {{-- Search --}}
            <div class="relative flex-1 min-w-[200px]">
                <i
                    class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-(--color-text-muted) text-sm pointer-events-none"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email..."
                    class="w-full pl-9 pr-4 py-2 text-sm rounded-xl bg-(--color-surface) border border-(--color-border) text-(--color-text) placeholder:text-(--color-text-muted) focus:outline-none focus:border-(--color-primary) focus:ring-2 focus:ring-(--color-primary-100) transition" />
            </div>

            {{-- Role Filter --}}
            <select name="role"
                class="px-3 py-2 text-sm rounded-xl bg-(--color-surface) border border-(--color-border) text-(--color-text) focus:outline-none focus:border-(--color-primary) focus:ring-2 focus:ring-(--color-primary-100) transition min-w-[130px]">
                <option value="">All Roles</option>
                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="company" {{ request('role') === 'company' ? 'selected' : '' }}>Company</option>
                <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
            </select>

            {{-- Actions --}}
            <div class="flex gap-2 ml-auto">
                <button type="submit" class="btn btn-secondary text-sm">
                    <i class="fas fa-filter text-xs"></i> Filter
                </button>
                @if (request()->hasAny(['search', 'role']))
                    <a href="{{ route('dev.users') }}"
                        class="btn text-sm text-(--color-text-muted) border border-(--color-border) hover:bg-(--color-surface-hover)">
                        <i class="fas fa-xmark text-xs"></i> Clear
                    </a>
                @endif
            </div>
        </form>

        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Joined</th>
                    <th class="text-center!">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="text-sm">

                        {{-- User Info --}}
                        <td>
                            <div class="table-title-cell max-w-max">
                                <div class="col-icon">
                                    @if ($user->profile_image)
                                        <img src="{{ Str::startsWith($user->profile_image, 'http') ? $user->profile_image : asset('storage/' . $user->profile_image) }}"
                                            alt="{{ $user->firstName }}" class="w-full h-full rounded-full object-cover">
                                    @else
                                        <div
                                            class="w-full h-full rounded-full bg-gray-100 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-400 text-sm"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-info">
                                    <div class="col-title-text">
                                        {{ $user->firstName }} {{ $user->lastName }}
                                    </div>
                                    <div class="col-meta-text">
                                        <a href="mailto:{{ $user->email }}" class="text-blue-500">
                                            {{ Str::limit($user->email, 25) }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>


                        {{-- Phone --}}
                        <td>{{ $user->phone ?? '-' }}</td>

                        {{-- Role --}}
                        <td>
                            @php
                                $roleClass = match ($user->role) {
                                    'admin' => 'warning',
                                    'company' => 'info',
                                    'user' => 'success',
                                    default => 'danger',
                                };
                            @endphp
                            <span class="status-badge {{ $roleClass }}">{{ ucfirst($user->role) }}</span>
                        </td>
                        {{-- Online Status --}}
                        <td>
                            @if ($user->isOnline())
                                <span class="status-badge success  gap-1">
                                    <span class="w-2 h-2 rounded-full bg-green-400 inline-block animate-pulse"></span>
                                    Online
                                </span>
                            @else
                                <span class="status-badge danger  gap-1">
                                    <span class="w-2 h-2 rounded-full bg-red-400 inline-block"></span>
                                    {{ $user->lastSeen() ? $user->lastSeen()->diffForHumans() : 'Never' }}
                                </span>
                            @endif
                        </td>
                        {{-- Joined --}}
                        <td>{{ $user->created_at->format('M d, Y') }}</td>

                        {{-- Actions --}}
                        <td>
                            <div class="flex justify-center gap-2">
                                {{-- Edit --}}
                                <a href="#"
                                    class="bg-blue-700 hover:bg-blue-500 text-white p-2 rounded-md text-base transition"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Force Logout --}}
                                <form action="{{ route('dev.users.force-logout', $user->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="bg-yellow-600 hover:bg-yellow-500 text-white p-2 rounded-md text-base transition"
                                        title="Force Logout">
                                        <i class="fa-solid fa-power-off""></i>
                                    </button>
                                </form>

                                {{-- Delete --}}
                                <form action="#" method="POST" class="inline delete-user-form">
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
                        <td colspan="6" class="text-center py-4">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->onEachSide(2)->links() }}
    </div>
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-user-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This user will be deleted permanently!",
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
