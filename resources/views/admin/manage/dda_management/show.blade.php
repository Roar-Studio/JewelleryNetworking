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
                        <h2 class="content-header-title float-start mb-0">Submission &mdash; {{ $submission->entry_id }}</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('manage.dda.index') }}">DDA</a>
                                </li>
                                <li class="breadcrumb-item active">{{ $submission->entry_id }}
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

            <!-- ============================================================
                 SECTION 1: PARTICIPANT DETAILS
            ============================================================ -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Participant Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <label class="form-label text-muted mb-0">Entry ID</label>
                                    <p class="fw-bolder mb-0">{{ $submission->entry_id }}</p>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <label class="form-label text-muted mb-0">First Name</label>
                                    <p class="fw-bolder mb-0">{{ $submission->first_name }}</p>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <label class="form-label text-muted mb-0">Last Name</label>
                                    <p class="fw-bolder mb-0">{{ $submission->last_name }}</p>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <label class="form-label text-muted mb-0">Email</label>
                                    <p class="fw-bolder mb-0">{{ $submission->email }}</p>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <label class="form-label text-muted mb-0">Phone</label>
                                    <p class="fw-bolder mb-0">{{ $submission->phone ?: '—' }}</p>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <label class="form-label text-muted mb-0">City</label>
                                    <p class="fw-bolder mb-0">{{ $submission->city }}</p>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <label class="form-label text-muted mb-0">Country</label>
                                    <p class="fw-bolder mb-0">{{ $submission->country }}</p>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <label class="form-label text-muted mb-0">Organisation</label>
                                    <p class="fw-bolder mb-0">{{ $submission->organisation ?: '—' }}</p>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <label class="form-label text-muted mb-0">Participant Type</label>
                                    <p class="fw-bolder mb-0">{{ ucfirst($submission->participant_type) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============================================================
                 SECTION 2: ENTRY A
            ============================================================ -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Entry A</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <label class="form-label text-muted mb-0">Deity Category</label>
                                    <p class="fw-bolder mb-0">{{ $submission->deity_category_a }}</p>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <label class="form-label text-muted mb-0">Jewellery Piece</label>
                                    <p class="fw-bolder mb-0">{{ $submission->jewellery_piece_a }}</p>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-2">
                                    <label class="form-label text-muted mb-0">Material</label>
                                    <p class="fw-bolder mb-0">{{ $submission->material_a }}</p>
                                </div>
                                <div class="col-12 mb-2">
                                    <label class="form-label text-muted mb-0">Statement</label>
                                    <p class="mb-0">{{ $submission->statement_a }}</p>
                                </div>
                            </div>

                            <hr>

                            <label class="form-label text-muted mb-1">Images</label>
                            <div class="row">
                                @forelse (($submission->images_a ?? []) as $image)
                                    <div class="col-md-2 col-sm-4 col-6 mb-3">
                                        <div class="card border h-100 mb-0">
                                            <a href="{{ $image }}" target="_blank" rel="noopener">
                                                <img src="{{ $image }}" alt="Entry A image" class="card-img-top" style="height:120px;object-fit:cover;">
                                            </a>
                                            <div class="card-body p-1 text-center">
                                                <a href="{{ $image }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary me-25 px-1">
                                                    Preview
                                                </a>
                                                <a href="{{ $image }}" download class="btn btn-sm btn-outline-secondary px-1">
                                                    Download
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <p class="text-muted mb-0">No images uploaded for Entry A.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============================================================
                 SECTION 3: ENTRY B (only if it exists)
            ============================================================ -->
            @if (!empty($submission->deity_category_b))
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Entry B</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label text-muted mb-0">Deity Category</label>
                                        <p class="fw-bolder mb-0">{{ $submission->deity_category_b }}</p>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label text-muted mb-0">Jewellery Piece</label>
                                        <p class="fw-bolder mb-0">{{ $submission->jewellery_piece_b }}</p>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label text-muted mb-0">Material</label>
                                        <p class="fw-bolder mb-0">{{ $submission->material_b }}</p>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label text-muted mb-0">Statement</label>
                                        <p class="mb-0">{{ $submission->statement_b }}</p>
                                    </div>
                                </div>

                                <hr>

                                <label class="form-label text-muted mb-1">Images</label>
                                <div class="row">
                                    @forelse (($submission->images_b ?? []) as $image)
                                        <div class="col-md-2 col-sm-4 col-6 mb-3">
                                            <div class="card border h-100 mb-0">
                                                <a href="{{ $image }}" target="_blank" rel="noopener">
                                                    <img src="{{ $image }}" alt="Entry B image" class="card-img-top" style="height:120px;object-fit:cover;">
                                                </a>
                                                <div class="card-body p-1 text-center">
                                                    <a href="{{ $image }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary me-25 px-1">
                                                        Preview
                                                    </a>
                                                    <a href="{{ $image }}" download class="btn btn-sm btn-outline-secondary px-1">
                                                        Download
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <p class="text-muted mb-0">No images uploaded for Entry B.</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- ============================================================
                 SECTION 4: PAYMENT DETAILS
            ============================================================ -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Payment Details</h4>
                        </div>
                        <div class="card-body">
                            @if ($transaction)
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label text-muted mb-0">Gateway</label>
                                        <p class="fw-bolder mb-0">{{ ucfirst($transaction->gateway) }}</p>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label text-muted mb-0">Transaction ID</label>
                                        <p class="fw-bolder mb-0">{{ $transaction->transaction_no }}</p>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label text-muted mb-0">Amount</label>
                                        <p class="fw-bolder mb-0">{{ $transaction->currency }} {{ number_format($transaction->amount, 2) }}</p>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label text-muted mb-0">Payment Status</label>
                                        <p class="mb-0">
                                            @php
                                                $txnStatusClass = match ($transaction->status) {
                                                    'Completed' => 'bg-light-success',
                                                    'Failed' => 'bg-light-danger',
                                                    default => 'bg-light-warning',
                                                };
                                            @endphp
                                            <span class="badge {{ $txnStatusClass }}">{{ $transaction->status }}</span>
                                        </p>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label text-muted mb-0">Payment Date</label>
                                        <p class="fw-bolder mb-0">{{ optional($transaction->created_at)->format('d M Y, h:i A') }}</p>
                                    </div>
                                </div>
                            @else
                                <p class="text-muted mb-0">No payment record found for this submission.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============================================================
                 SECTION 5: REVIEW STATUS
            ============================================================ -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Review Status</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('manage.dda.status.update', $submission->id) }}" method="POST">
                                @csrf
                                

                                <div class="row align-items-end">
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label required" for="status">Status</label>
                                        <select name="status" id="status" class="form-select">
                                            @foreach (['Pending', 'Under Review', 'Approved', 'Rejected'] as $statusOption)
                                                <option value="{{ $statusOption }}" {{ $submission->status === $statusOption ? 'selected' : '' }}>
                                                    {{ $statusOption }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <button type="submit" class="btn common-btn btn-primary">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- END: Content-->
@endsection