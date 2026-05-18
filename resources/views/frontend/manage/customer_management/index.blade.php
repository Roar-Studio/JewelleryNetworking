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
                    <div class="card basic-table-container">
                        <form>
                            <div class="d-flex align-items-start justify-content-between mx-0 mb-xxl-0 filter-container">          
                                <div class="dropdown-btn-container">
                                    <div class="input-group input-group-merge table-header-search">
                                        <span class="input-group-text" id="basic-addon-search2">
                                            <svg class="feather me-25 font-small-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M9.13406 0.204102C11.5566 0.204102 13.8798 1.16644 15.5928 2.87941C17.3058 4.59237 18.2681 6.91566 18.2681 9.33816C18.2681 11.6006 17.439 13.6804 16.0759 15.2823L16.4554 15.6617H17.5655L24.5917 22.6879L22.4838 24.7958L15.4576 17.7696V16.6595L15.0782 16.28C13.4206 17.6944 11.3131 18.4716 9.13406 18.4722C6.71156 18.4722 4.38827 17.5099 2.6753 15.7969C0.962335 14.084 0 11.7607 0 9.33816C0 6.91566 0.962335 4.59237 2.6753 2.87941C4.38827 1.16644 6.71156 0.204102 9.13406 0.204102ZM9.13406 3.01458C5.62096 3.01458 2.81048 5.82506 2.81048 9.33816C2.81048 12.8513 5.62096 15.6617 9.13406 15.6617C12.6472 15.6617 15.4576 12.8513 15.4576 9.33816C15.4576 5.82506 12.6472 3.01458 9.13406 3.01458Z"
                                                    fill="#677181" />
                                            </svg>
                                        </span>
                                        <span class="clear-btn">&times;</span>
                                        <input type="text" id="search_key" class="form-control" placeholder="Search with Customer Name/Mobile No/Location/Email ID" aria-label="Search..." maxlength="100">
                                    </div>
                                    <div class="dropdown-wrapper select-wrapper"> 
                                        <select class="form-select select2" id="plan_type" data-placeholder="Membership Type">
                                            <option></option>
                                            <option value="1">Free</option>
                                            <option value="2">Standard</option>
                                            <option value="3">Premium</option>
                                        </select>
                                    </div>
                                    <div class="dropdown-wrapper select-wrapper" data-dropdown="OperatingType">
                                        <select class="form-select select2" id="is_active" data-placeholder="Status">
                                            <option></option>
                                            <option value="1">Active</option>
                                            <option value="0">InActive</option>
                                        </select>
                                    </div>
                                    <div>
                                        <button type="button" class="btn common-btn waves-effect waves-float waves-light custom-reset-btn" id="resetFilters">
                                            Reset
                                        </button>
                                    </div>
                                    <!-- <div class="dropdown-wrapper position-relative" data-dropdown="JoiningFrom">
                                        <input type="text" name="joining_date" id="joining_date" class="form-control pickrdate dropdown-date-picker" placeholder="Joining From" aria-label="MM/DD/YYYY" />
                                    </div>
                                    <div class="dropdown-wrapper position-relative" data-dropdown="JoiningTill">
                                        <input type="text" name="separation_date" id="separation_date" class="form-control pickrdate dropdown-date-picker" placeholder="Joining Till" aria-label="MM/DD/YYYY" />
                                    </div> -->
                                </div>
                                <div class="d-flex">
                                    <!-- <button type="button" class="btn common-btn waves-effect waves-float waves-light custom-apply-btn" id="resetFilters">
                                        Reset
                                    </button> -->
                                    <!-- <button type="button" class="btn common-btn waves-effect waves-float waves-light custom-apply-btn">
                                        Apply
                                    </button> -->
                                </div>
                            </div>
                        </form>

                        <div class="table-container">
                            <table id="customer-list-table" class="table">
                                
                            </table>
                        </div>
                    </div>
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