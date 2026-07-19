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
                        <h2 class="content-header-title float-start mb-0">Edit Submission &mdash; {{ $submission->entry_id }}</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('manage.dda.index') }}">DDA</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('manage.dda.show', $submission->id) }}">{{ $submission->entry_id }}</a>
                                </li>
                                <li class="breadcrumb-item active">Edit
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

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('manage.dda.update', $submission->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

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
                                        <label class="form-label" for="first_name">First Name</label>
                                        <input type="text" name="first_name" id="first_name"
                                               class="form-control @error('first_name') is-invalid @enderror"
                                               value="{{ old('first_name', $submission->first_name) }}">
                                        @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label" for="last_name">Last Name</label>
                                        <input type="text" name="last_name" id="last_name"
                                               class="form-control @error('last_name') is-invalid @enderror"
                                               value="{{ old('last_name', $submission->last_name) }}">
                                        @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" name="email" id="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email', $submission->email) }}">
                                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label" for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               value="{{ old('phone', $submission->phone) }}">
                                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label" for="city">City</label>
                                        <input type="text" name="city" id="city"
                                               class="form-control @error('city') is-invalid @enderror"
                                               value="{{ old('city', $submission->city) }}">
                                        @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label" for="country">Country</label>
                                        <input type="text" name="country" id="country"
                                               class="form-control @error('country') is-invalid @enderror"
                                               value="{{ old('country', $submission->country) }}">
                                        @error('country') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label" for="organisation">Organisation</label>
                                        <input type="text" name="organisation" id="organisation"
                                               class="form-control @error('organisation') is-invalid @enderror"
                                               value="{{ old('organisation', $submission->organisation) }}">
                                        @error('organisation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label" for="participant_type">Participant Type</label>
                                        <input type="text" name="participant_type" id="participant_type"
                                               class="form-control @error('participant_type') is-invalid @enderror"
                                               value="{{ old('participant_type', $submission->participant_type) }}">
                                        @error('participant_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                                        <label class="form-label" for="deity_category_a">Deity Category</label>
                                        <input type="text" name="deity_category_a" id="deity_category_a"
                                               class="form-control @error('deity_category_a') is-invalid @enderror"
                                               value="{{ old('deity_category_a', $submission->deity_category_a) }}">
                                        @error('deity_category_a') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label" for="jewellery_piece_a">Jewellery Piece</label>
                                        <input type="text" name="jewellery_piece_a" id="jewellery_piece_a"
                                               class="form-control @error('jewellery_piece_a') is-invalid @enderror"
                                               value="{{ old('jewellery_piece_a', $submission->jewellery_piece_a) }}">
                                        @error('jewellery_piece_a') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label" for="material_a">Material</label>
                                        <input type="text" name="material_a" id="material_a"
                                               class="form-control @error('material_a') is-invalid @enderror"
                                               value="{{ old('material_a', $submission->material_a) }}">
                                        @error('material_a') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label" for="statement_a">Statement</label>
                                        <textarea name="statement_a" id="statement_a" rows="4"
                                                  class="form-control @error('statement_a') is-invalid @enderror">{{ old('statement_a', $submission->statement_a) }}</textarea>
                                        @error('statement_a') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <hr>

                                <label class="form-label text-muted mb-1">Existing Images</label>
                                <div class="row">
                                    @forelse (($submission->images_a ?? []) as $index => $image)
                                        <div class="col-md-3 col-sm-4 col-6 mb-3" id="img-a-wrapper-{{ $index }}">
                                            <input type="hidden" name="existing_images_a[{{ $index }}]" value="{{ $image }}">
                                            <div class="card border h-100 mb-0">
                                                <a href="{{ $image }}" target="_blank" rel="noopener">
                                                    <img src="{{ $image }}" alt="Entry A image" class="card-img-top" style="height:120px;object-fit:cover;">
                                                </a>
                                                <div class="card-body p-2">
                                                    <div class="d-flex justify-content-between mb-1">
                                                        <a href="{{ $image }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary px-1">
                                                            Preview
                                                        </a>
                                                        <button type="button"
                                                                class="btn btn-sm btn-outline-danger px-1 btn-delete-image"
                                                                data-target="img-a-wrapper-{{ $index }}"
                                                                data-checkbox="delete-a-{{ $index }}">
                                                            Delete
                                                        </button>
                                                    </div>
                                                    <label class="form-label text-muted mb-0" style="font-size:11px;">Replace</label>
                                                    <input type="file" name="replace_images_a[{{ $index }}]"
                                                           class="form-control form-control-sm @error('replace_images_a.' . $index) is-invalid @enderror"
                                                           accept="image/jpeg,image/png,image/jpg">
                                                    @error('replace_images_a.' . $index) <div class="invalid-feedback">{{ $message }}</div> @enderror

                                                    <div class="form-check mt-1">
                                                        <input class="form-check-input" type="checkbox"
                                                               id="delete-a-{{ $index }}"
                                                               name="delete_images_a[]"
                                                               value="{{ $index }}"
                                                               style="display:none;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <p class="text-muted mb-0">No images uploaded for Entry A.</p>
                                        </div>
                                    @endforelse
                                </div>

                                <div class="mt-2">
                                    <label class="form-label" for="new_images_a">Upload New Images</label>
                                    <input type="file" name="new_images_a[]" id="new_images_a" multiple
                                           class="form-control @error('new_images_a.*') is-invalid @enderror"
                                           accept="image/jpeg,image/png,image/jpg">
                                    @error('new_images_a.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================================
                     SECTION 3: ENTRY B
                ============================================================ -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Entry B</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label" for="deity_category_b">Deity Category</label>
                                        <input type="text" name="deity_category_b" id="deity_category_b"
                                               class="form-control @error('deity_category_b') is-invalid @enderror"
                                               value="{{ old('deity_category_b', $submission->deity_category_b) }}">
                                        @error('deity_category_b') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label" for="jewellery_piece_b">Jewellery Piece</label>
                                        <input type="text" name="jewellery_piece_b" id="jewellery_piece_b"
                                               class="form-control @error('jewellery_piece_b') is-invalid @enderror"
                                               value="{{ old('jewellery_piece_b', $submission->jewellery_piece_b) }}">
                                        @error('jewellery_piece_b') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label" for="material_b">Material</label>
                                        <input type="text" name="material_b" id="material_b"
                                               class="form-control @error('material_b') is-invalid @enderror"
                                               value="{{ old('material_b', $submission->material_b) }}">
                                        @error('material_b') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label" for="statement_b">Statement</label>
                                        <textarea name="statement_b" id="statement_b" rows="4"
                                                  class="form-control @error('statement_b') is-invalid @enderror">{{ old('statement_b', $submission->statement_b) }}</textarea>
                                        @error('statement_b') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <hr>

                                <label class="form-label text-muted mb-1">Existing Images</label>
                                <div class="row">
                                    @forelse (($submission->images_b ?? []) as $index => $image)
                                        <div class="col-md-3 col-sm-4 col-6 mb-3" id="img-b-wrapper-{{ $index }}">
                                            <input type="hidden" name="existing_images_b[{{ $index }}]" value="{{ $image }}">
                                            <div class="card border h-100 mb-0">
                                                <a href="{{ $image }}" target="_blank" rel="noopener">
                                                    <img src="{{ $image }}" alt="Entry B image" class="card-img-top" style="height:120px;object-fit:cover;">
                                                </a>
                                                <div class="card-body p-2">
                                                    <div class="d-flex justify-content-between mb-1">
                                                        <a href="{{ $image }}" target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary px-1">
                                                            Preview
                                                        </a>
                                                        <button type="button"
                                                                class="btn btn-sm btn-outline-danger px-1 btn-delete-image"
                                                                data-target="img-b-wrapper-{{ $index }}"
                                                                data-checkbox="delete-b-{{ $index }}">
                                                            Delete
                                                        </button>
                                                    </div>
                                                    <label class="form-label text-muted mb-0" style="font-size:11px;">Replace</label>
                                                    <input type="file" name="replace_images_b[{{ $index }}]"
                                                           class="form-control form-control-sm @error('replace_images_b.' . $index) is-invalid @enderror"
                                                           accept="image/jpeg,image/png,image/jpg">
                                                    @error('replace_images_b.' . $index) <div class="invalid-feedback">{{ $message }}</div> @enderror

                                                    <div class="form-check mt-1">
                                                        <input class="form-check-input" type="checkbox"
                                                               id="delete-b-{{ $index }}"
                                                               name="delete_images_b[]"
                                                               value="{{ $index }}"
                                                               style="display:none;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <p class="text-muted mb-0">No images uploaded for Entry B.</p>
                                        </div>
                                    @endforelse
                                </div>

                                <div class="mt-2">
                                    <label class="form-label" for="new_images_b">Upload New Images</label>
                                    <input type="file" name="new_images_b[]" id="new_images_b" multiple
                                           class="form-control @error('new_images_b.*') is-invalid @enderror"
                                           accept="image/jpeg,image/png,image/jpg">
                                    @error('new_images_b.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================================
                     SECTION 4: PAYMENT DETAILS (READ ONLY)
                ============================================================ -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Payment Details</h4>
                                <span class="badge bg-light-secondary">Read Only</span>
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
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <label class="form-label required" for="status">Status</label>
                                        <select name="status" id="status" class="form-select">
                                            @foreach (['Pending', 'Under Review', 'Approved', 'Rejected'] as $statusOption)
                                                <option value="{{ $statusOption }}" {{ old('status', $submission->status) === $statusOption ? 'selected' : '' }}>
                                                    {{ $statusOption }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================================
                     SUBMIT / CANCEL
                ============================================================ -->
                <div class="row">
                    <div class="col-12 mb-3">
                        <button type="submit" class="btn common-btn btn-primary">
                            Save Changes
                        </button>
                        <a href="{{ route('manage.dda.show', $submission->id) }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
<!-- END: Content-->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-delete-image').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var targetId = btn.getAttribute('data-target');
                var checkboxId = btn.getAttribute('data-checkbox');

                var wrapper = document.getElementById(targetId);
                var checkbox = document.getElementById(checkboxId);

                if (checkbox) {
                    checkbox.checked = true;
                }

                if (wrapper) {
                    wrapper.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection