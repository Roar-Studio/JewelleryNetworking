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
                        <h2 class="content-header-title float-start mb-0">Transaction Management</h2>
                        <!-- <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('manage.transaction.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Services
                                </li>
                            </ol>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex align-item-center justify-content-end action-box">
                <!-- <div class="mobile-responsive-button">
                    <button type="button" class="btn common-btn btn-warning waves-effect waves-float waves-light add-event">
                        <i class="me-25 font-small-4" data-feather='plus'></i>
                        Add Event
                    </button>
                </div> -->
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
                                        <input type="text" id="search_key" class="form-control" placeholder="Search with Customer name, Payment ID, Mobile no, order ID, amount" aria-label="Search..." maxlength="100">
                                    </div>
                                    <div class="dropdown-wrapper select-wrapper" data-dropdown="ServiceType">
                                        <select class="form-select select2" id="service_name" data-placeholder="Service Type">
                                            <option></option>
                                            <option value="MembershipPlan">Membership</option>
                                            <option value="Event">Event</option>
                                        </select>
                                    </div>
                                    <div class="dropdown-wrapper select-wrapper" data-dropdown="Status">
                                        <select class="form-select select2" id="status" data-placeholder="Payment Status">
                                            <option></option>
                                            <option value="pending">Pending</option>
                                            <option value="completed">Completed</option>
                                            <option value="failed">Failed</option>
                                            <option value="refunded">Refunded</option>
                                        </select>
                                    </div>
                                    <div class="dropdown-wrapper position-relative" data-dropdown="DateFrom">
                                        <input type="text" name="date_from" id="date_from" class="form-control pickrdate dropdown-date-picker" placeholder="Date From" aria-label="MM/DD/YYYY" />
                                    </div>
                                    <div class="dropdown-wrapper position-relative" data-dropdown="DateTo">
                                        <input type="text" name="date_to" id="date_to" class="form-control pickrdate dropdown-date-picker" placeholder="Date to" aria-label="MM/DD/YYYY" />
                                    </div>
                                    <div>
                                        <button type="button" class="btn common-btn waves-effect waves-float waves-light custom-reset-btn" id="resetFilters" disabled>
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
                            <table id="transaction-list-table" class="table">
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="modal modal-slide-in fade" id="transaction-detail-modals">
        <div class="modal-dialog employe-directory-modal-dialog sidebar-md">
            <div class="modal-content employe-directory-modal-content pt-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-eye me-1"></i>View Transaction</h5>
                </div>
                <div class="modal-body flex-grow-1">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mt-2">
                            <h5 class="mb-0">Customer Name:</h5>
                            <p class="card-text cust_name"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-2">
                            <h5 class="mb-0">Membership ID:</h5>
                            <p class="card-text membership_id"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-2">
                            <h5 class="mb-0">Order ID:</h5>
                            <p class="card-text order_id"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-2">
                            <h5 class="mb-0">Mobile Number:</h5>
                            <p class="card-text cust_mobile"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-2">
                            <h5 class="mb-0">Email ID:</h5>
                            <p class="card-text email"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-2">
                            <h5 class="mb-0">Payment Status:</h5>
                            <p class="card-text status"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-2">
                            <h5 class="mb-0">Amount:</h5>
                            <p class="card-text amount"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-2">
                            <h5 class="mb-0">Transaction ID:</h5>
                            <p class="card-text transaction_id"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-2">
                            <h5 class="mb-0">Payment Mode:</h5>
                            <p class="card-text payment_mode"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-2">
                            <h5 class="mb-0">Transaction Date and Time:</h5>
                            <p class="card-text transaction_date"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-2">
                            <h5 class="mb-0">Discount Applied:</h5>
                            <p class="card-text discount"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-2">
                            <h5 class="mb-0">Coupon Details:</h5>
                            <p class="card-text coupon"></p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mt-2">
                            <h5 class="mb-0">Payment Summary:</h5>
                            <p class="card-text payment_summary"></p>
                        </div>
                    </div>
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
<script src="{{ asset('new_ui/assets/js/admin/transaction/index.js') }}?v={{ time() }}"></script>

@endsection