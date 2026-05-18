@extends('admin.auth_layouts.master')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endsection

@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="card content-wrapper">
        <div class="card-header content-header">
            <div class="content-header-left col-md-6">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Customer Management</h2>
                        <!-- <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('manage.customer.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Services
                                </li>
                            </ol>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex align-item-center justify-content-end action-box">
            </div>
        </div>
        
        <div class="card-body content-body">
            <!-- Basic table -->
            <div class="row">
                <div class="col-12">
                    <form method="POST" action="{{ url('/api/admin/import') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="csv_file" accept=".csv" required>
                        <button type="submit">Import</button>
                    </form>

                </div>
            </div>
            
        </div>
    </div>

    <div class="modal modal-slide-in fade" tabindex="-1" id="customer-membership-modals">
        <div class="modal-dialog employe-directory-modal-dialog sidebar-md">
            <div class="modal-content employe-directory-modal-content pt-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-cash-coin me-1"></i>Subscription Details</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <ul class="nav nav-tabs m-0 d-flex" id="myTab" role="tablist">
                        <button class="nav-link active" id="upgrade-tab" data-bs-toggle="tab" data-bs-target="#upgrade" type="button" role="tab" onclick="selectTab(event)">Membership Details</button>
                        <button class="nav-link" id="activity-tab" data-bs-toggle="tab" data-bs-target="#activity" type="button" role="tab" onclick="selectTab(event)">Purchase History</button> 
                    </ul>
                    <div class="detail-modal-container rounded-0">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="upgrade" role="tabpanel">
                                <form id="updateMembershipForm">
                            
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            <div class="mt-2">
                                                <h5 class="">Current Membership:</h5>
                                                <span class="badge bg-light-success cust_plan_type"></span>
                                                <!-- <p class="card-text cust_plan_type "></p> -->
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mt-2">
                                                <h5 class="">Membership Status:</h5>
                                                <h5 class="fw-bolder days-left">25 Days Left</h5>    
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mt-2">
                                                <h5 class="">Start date:</h5>
                                                <p class="card-text cust_start_date"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mt-2">
                                                <h5 class="">End Date:</h5>
                                                <p class="card-text cust_end_date"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="form-group mb-2 col-md-12">
                                            <label class="form-label required">Renew/Upgrade Membership Plan</label>
                                            <input type="hidden" name="customer_id">
                                            <input type="hidden" name="old_plan_id">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 standard-radio-box">
                                            <label for="standardOpt" class="d-flex mb-2 standardRadio">
                                                <span class="avatar avatar-tag bg-light-info me-1">
                                                    <img width="28px" src="{{ asset('new_ui/assets/images/silver-daimond.png') }}">
                                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase font-medium-5"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg> -->
                                                </span>
                                                <span class="d-flex align-items-center justify-content-between flex-grow-1">
                                                    <span class="me-1">
                                                        <span class="h5 d-block fw-bolder mb-0">Standard</span>
                                                        <span>&#8377;5,999<span class="small">/1 Year</span></span>
                                                    </span>
                                                    <span>
                                                        <input class="form-check-input" id="standardOpt" type="radio" name="plan_type" value="2">
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="col-md-6 premium-radio-box">
                                            <label for="PremiumOpt" class="d-flex mb-2 premiumRadio">
                                                <span class="avatar avatar-tag bg-light-info me-1">
                                                    <img width="28px" src="{{ asset('new_ui/assets/images/gold-daimond.png') }}">
                                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase font-medium-5"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg> -->
                                                </span>
                                                <span class="d-flex align-items-center justify-content-between flex-grow-1">
                                                    <span class="me-1">
                                                    <span class="h5 d-block fw-bolder mb-0">Premium</span>
                                                    <span>&#8377;9,999<span class="small">/1 Year</span></span>
                                                    </span>
                                                    <span>
                                                        <input class="form-check-input" id="PremiumOpt" type="radio" name="plan_type" value="3">
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row plan_transaction_container" style="display:none;">
                                        <div class="form-group mb-2 col-md-6">
                                            <label class="form-label required">Transaction ID</label>
                                            <input type="text" name="payment_id" class="form-control" placeholder="eg: PaAxF1cvsB76Ambke"/>
                                        </div>
                                        <div class="form-group mb-2 col-md-6">
                                            <label class="form-label required">Payment Mode</label>
                                            <select class="select2InModal select2 form-select payment_mode" name="payment_mode" data-placeholder="Select A Payment type">
                                                <option></option>
                                                <option value="online">Online</option>
                                                <option value="offline">Offline</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-2 col-md-6">
                                            <label class="form-label">Fees Received</label>
                                            <div class="input-group">
                                                <select class="form-select currency_type" name="currency_type">
                                                    <option value="INR">&#8377;</option>
                                                    <option value="USD">$</option>
                                                </select>

                                                <input type="number" class="form-control" name="amount" placeholder="Enter Amount"/>
                                            </div>
                                        </div>
                                        <div class="form-group mb-2 col-md-6">
                                            <label class="form-label">Transaction date</label>
                                            <div class="input-group position-relative">
                                                <input type="text" name="transaction_date" class="form-control pickrdate dropdown-date-picker required" placeholder="DD/MM/YYYY" />
                                            </div>
                                        </div>
                                        <div class="form-group mb-2 col-md-6">
                                            <label class="form-label">Note(optional)</label>
                                            <input type="text" class="form-control" name="note" placeholder="Enter note here" maxlength="20"/>
                                        </div>
                                        <div class="d-flex justify-content-end modal-btn-container">
                                            <button id="close-btn" type="reset" class="btn common-btn btn-outline-secondary me-50" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn common-btn btn-primary">Update Membership</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="activity" role="tabpanel">
                                <table id="customer-transactions-table" class="display">
                                    <thead>
                                        <tr>
                                            <th>Plan Type</th>
                                            <th>Start Date</th>
                                            <th>Expire Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-slide-in fade" id="customer-detail-modals">
        <div class="modal-dialog employe-directory-modal-dialog sidebar-md">
            <div class="modal-content employe-directory-modal-content pt-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-header">
                        <h5 class="modal-title"><i class="bi bi-pencil-square me-1"></i>Update Customer</h5>
                </div>
                <div class="modal-body flex-grow-1">
                
                    <!-- <ul class="nav nav-tabs m-0 d-flex" id="myTab" role="tablist">
                        <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab" onclick="selectTab(event)">Personal Details</button>
                        <button class="nav-link" id="membership-tab" data-bs-toggle="tab" data-bs-target="#membership" type="button" role="tab" onclick="selectTab(event)">Membership History</button>
                        
                    </ul> -->

                    <div class="detail-modal-container rounded-0">
                        @include('admin.manage.customer_management.profile')
                        <!-- <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="personal" role="tabpanel">
                            </div>
                            <div class="tab-pane fade" id="membership" role="tabpanel">
                                <p></p>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- END: Content-->
@endsection

@section('script')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="{{ asset('new_ui/assets/js/admin/customer/index.js') }}?v={{ time() }}"></script>
<script src="{{ asset('new_ui/assets/js/admin/custom-image-uploader.js') }}?v={{ time() }}"></script>


@endsection