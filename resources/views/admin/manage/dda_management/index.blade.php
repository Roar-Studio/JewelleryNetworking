@extends('admin.auth_layouts.master')

@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card content-wrapper">
        <div class="card-header content-header">
            <div class="content-header-left col-md-12">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Deities Design Awards &mdash; Submissions</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('manage.dda.index') }}">DDA</a>
                                </li>
                                <li class="breadcrumb-item active">All Submissions
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body content-body">

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Basic table -->
            <div class="row">
                <div class="col-12">
                    <div class="card basic-table-container">

                        <div class="table-container">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Entry ID</th>
                                        <th>Participant</th>
                                        <th>Email</th>
                                        <th>Country</th>
                                        <th>Participant Type</th>
                                        <th>Status</th>
                                        <th>Submitted Date</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($submissions as $submission)
                                        <tr>
                                            <td>
                                                <span class="fw-bolder">{{ $submission->entry_id }}</span>
                                            </td>
                                            <td>{{ $submission->first_name }} {{ $submission->last_name }}</td>
                                            <td>{{ $submission->email }}</td>
                                            <td>{{ $submission->country }}</td>
                                            <td>{{ ucfirst($submission->participant_type) }}</td>
                                            <td>
                                                @php
                                                    $statusClass = match ($submission->status) {
                                                        'Approved' => 'bg-light-success',
                                                        'Rejected' => 'bg-light-danger',
                                                        'Under Review' => 'bg-light-info',
                                                        default => 'bg-light-warning',
                                                    };
                                                @endphp
                                                <span class="badge {{ $statusClass }}">{{ $submission->status }}</span>
                                            </td>
                                            <td>{{ optional($submission->created_at)->format('d M Y, h:i A') }}</td>
                                            <td class="text-center text-nowrap">
                                                <a href="{{ route('manage.dda.show', $submission->id) }}"
                                                    class="btn btn-sm common-btn btn-outline-primary me-50">
                                                    <i data-feather="eye" class="font-small-4"></i> View
                                                </a>
                                                <a href="{{ route('manage.dda.edit', $submission->id) }}"
                                                    class="btn btn-sm common-btn btn-outline-warning">
                                                    <i data-feather="edit-2" class="font-small-4"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                No submissions found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- END: Content-->
@endsection