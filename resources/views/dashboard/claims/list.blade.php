@extends('dashboard.layout.main')
@section('title', 'Company Claims')

@section('content')
    <div class="dashboard-table-container">
        <div class="dashboard-table-header">
            <h3 class="dashboard-table-title">Company Claim Requests</h3>
        </div>

        <table class="dashboard-table">
            <thead>
                <tr>
                    <th>Company</th>
                    <th>Submitted By</th>
                    <th>Corporate Email</th>
                    <th>Job Title</th>
                    <th>Status</th>
                    <th class="text-center!">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($claims as $claim)
                    <tr class="text-sm">
                        <td>
                            <div class="table-title-cell">
                                <div class="col-icon">
                                    <img src="{{ $claim->company?->logo
                                        ? (!Str::startsWith($claim->company->logo, 'http')
                                            ? asset('storage/' . $claim->company->logo)
                                            : $claim->company->logo)
                                        : asset('images/dummy.jpg') }}"
                                        class="w-full h-full rounded-full">
                                </div>

                                <div class="col-info">
                                    <div class="col-title-text">
                                        {{ $claim->company->name }}
                                    </div>
                                    <div class="col-meta-text">
                                        Requested by system user:
                                        {{ $claim->user->email }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>{{ $claim->submitted_name }}</td>
                        <td>{{ $claim->submitted_email }}</td>
                        <td>{{ $claim->job_title ?? '-' }}</td>

                        <td>
                            <span
                                class="status-badge 
                            {{ $claim->status == 'approved' ? 'success' : ($claim->status == 'rejected' ? 'danger' : 'warning') }}">
                                {{ ucfirst($claim->status) }}
                            </span>
                        </td>

                        <td>
                            <div class="flex gap-2 justify-center">
                                @if ($claim->status === 'pending')
                                    <button class="btn btn-success approve-btn"
                                        data-id="{{ $claim->id }}">Approve</button>
                                    <button class="btn btn-danger reject-btn" data-id="{{ $claim->id }}"><i
                                            class="fa-solid fa-x"></i></button>
                                @else
                                    <span class="text-gray-400 text-xs">Processed</span>
                                @endif

                            </div>


                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            No claim requests found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $claims->onEachSide(2)->links() }}
    </div>
@endsection

@push('scripts')
    <script>
        $(document).on('click', '.approve-btn', function() {
            let id = $(this).data('id');
            const approveRoute = "{{ route('admin.claims.approve', ':id') }}";
            let approveUrl = approveRoute.replace(':id', id);
            Swal.fire({
                title: "Approve this claim?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, approve it"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: approveUrl,
                        type: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function() {
                            Swal.fire("Approved!", "Claim has been approved.", "success")
                                .then(() => location.reload());
                        }
                    });
                }
            });
        });

        $(document).on('click', '.reject-btn', function() {
            let id = $(this).data('id');
            const rejectRoute = "{{ route('admin.claims.reject', ':id') }}";
            let rejectUrl = rejectRoute.replace(':id', id);
            Swal.fire({
                title: "Reject this claim?",
                icon: "error",
                showCancelButton: true,
                confirmButtonText: "Yes, reject it"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: rejectUrl,
                        type: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function() {
                            Swal.fire("Rejected!", "Claim has been rejected.", "success")
                                .then(() => location.reload());
                        }
                    });
                }
            });
        });
    </script>
@endpush
