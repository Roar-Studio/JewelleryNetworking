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
                        <h2 class="content-header-title float-start mb-0">Coupon Management</h2>
                        <!-- <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('manage.coupon.index') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Services
                                </li>
                            </ol>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex align-item-center justify-content-end action-box">
                <div class="mobile-responsive-button">
                    <button type="button" class="btn common-btn btn-warning waves-effect waves-float waves-light add-coupon">
                        <i class="me-25 font-small-4" data-feather='plus'></i>
                        Add Coupon
                    </button>
                </div>
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
                                        <input type="text" id="search_key" class="form-control" placeholder="Search with Coupon Name" aria-label="Search..." maxlength="100">
                                    </div>
                                    <div class="dropdown-wrapper select-wrapper" data-dropdown="OperatingType">
                                        <select class="form-select select2" id="is_active" data-placeholder="Status">
                                            <option></option>
                                            <option value="1">Active</option>
                                            <option value="0">InActive</option>
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
                            <table id="coupon-list-table" class="table">
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="modal modal-slide-in fade" id="add-coupon-modals">
        <div class="modal-dialog employe-directory-modal-dialog sidebar-md">
            <div class="modal-content employe-directory-modal-content pt-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil-square me-1"></i>Add Coupon</h5>
                </div>
                <div class="modal-body flex-grow-1">
                
                    <!-- <ul class="nav nav-tabs m-0 d-flex" id="myTab" role="tablist">
                        <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab" onclick="selectTab(event)">Personal Details</button>
                        <button class="nav-link" id="event-tab" data-bs-toggle="tab" data-bs-target="#coupon" type="button" role="tab" onclick="selectTab(event)">Coupon History</button>
                        
                    </ul> -->

                    <div class="detail-modal-container rounded-0">
                        
                        <form id="addCouponForm">
                            <div class="row">
                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Coupon Name</label>
                                    <input type="text" class="form-control" name="coupon_name" placeholder="Enter Coupon Name" required />
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Coupon Code</label>
                                    <input type="text" class="form-control" name="coupon_code" placeholder="Enter Coupon Code" required />
                                    <div class="coupon_code_feedback text-end"></div>

                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Marketing Text</label>
                                    <input type="text" class="form-control" name="marketing_text" placeholder="Enter Marketing Text" required />
                                </div>

                                <div class="form-group mb-2 col-6">
                                    <label class="form-label">Start Date</label>
                                    <div class="input-group position-relative">
                                        <input type="text" name="start_date" class="form-control pickrdate dropdown-date-picker required" placeholder="DD/MM/YYYY" />
                                    </div>
                                </div>

                                <div class="form-group mb-2 col-6">
                                    <label class="form-label">End Date</label>
                                    <div class="input-group position-relative">
                                        <input type="text" name="end_date" class="form-control pickrdate dropdown-date-picker required" placeholder="DD/MM/YYYY" />
                                    </div>
                                </div>

                                <div class="form-group mb-2 col-md-6">
                                    <label class="form-label required">Coupon Type</label>
                                    <select class="select2InModal select2 form-select coupon_type" name="coupon_type" data-placeholder="Select coupon type">
                                        <option></option>
                                        <option value="generic">Generic</option>
                                        <option value="membership">Membership</option>
                                        <option value="event">Event</option>
                                        <option value="user_specific">User Specific</option>
                                    </select>
                                </div>

                                <div class="form-group mb-2 col-md-6">
                                    <label class="form-label required">Membership Type</label>
                                    <select class="select2InModal select2 form-select membership_type" name="membership_type" data-placeholder="Select membership type">
                                        <option value="all">All</option>
                                        <option value="free">Free</option>
                                        <option value="standard">Standard</option>
                                        <option value="premium">Premium</option>
                                    </select>
                                </div>

                                <div class="form-group mb-2 col-md-6">
                                    <label class="form-label required">Event</label>
                                    <select class="select2InModal select2 form-select event_type" name="event_type" data-placeholder="Select event">
                                        <option value="all">All</option>
                                    </select>
                                </div>

                                <div class="form-group mb-2 col-md-6">
                                    <label class="form-label required">Select Users</label>
                                    <select name="user_specific" class="select2InModal select2 form-select user_specific" data-placeholder="Select Users" multiple>
                                    </select>
                                </div>

                                <div class="form-group mb-2 col-md-6">
                                    <label class="form-label required">Discount Type</label>
                                    <select class="select2InModal select2 form-select discount_type" name="discount_type" data-placeholder="Select discount type">
                                        <option></option>
                                        <option value="flat">Flat</option>
                                        <option value="percent">Percent</option>
                                    </select>
                                </div>
                                
                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Flat Discount</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="input-group">
                                                <span class="input-group-text">&#8377;</span>
                                                <input type="text" class="form-control" name="discount_flat_inr" placeholder="Enter Amount in (&#8377;)"/>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="text" class="form-control" name="discount_flat_usd" placeholder="Enter Amount in ($)"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Discount in %</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="input-group">
                                                <span class="input-group-text">&#8377;(%)</span>
                                                <input type="number" class="form-control" name="discount_percent_inr" placeholder="Enter Amount in (&#8377;)"/>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group">
                                                <span class="input-group-text">$(%)</span>
                                                <input type="number" class="form-control" name="discount_percent_usd" placeholder="Enter Amount in ($)"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Maximum Discount</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="input-group">
                                                <span class="input-group-text">&#8377;</span>
                                                <input type="text" class="form-control" name="maximum_discount_inr" placeholder="Enter Amount in (&#8377;)"/>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="text" class="form-control" name="maximum_discount_usd" placeholder="Enter Amount in ($)"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Max Use Per User</label>
                                    <input type="text" class="form-control" name="max_use_per_user" placeholder="Enter Max Use Per User" required />
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-check-label mb-50">Is Active?</label>
                                    <div class="form-check form-check-primary form-switch">
                                        <input type="checkbox" class="form-check-input" name="is_active" value="1" checked/>
                                        <input type="hidden" name="is_active" value="1">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <label></label>
                                <div>
                                    <button type="reset" class="btn common-btn btn-outline-secondary me-50" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn common-btn btn-primary">Add</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal modal-slide-in fade" id="coupon-detail-modals">
        <div class="modal-dialog employe-directory-modal-dialog sidebar-md">
            <div class="modal-content employe-directory-modal-content pt-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil-square me-1"></i>Update Coupon</h5>
                </div>
                <div class="modal-body flex-grow-1">
                
                    <!-- <ul class="nav nav-tabs m-0 d-flex" id="myTab" role="tablist">
                        <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab" onclick="selectTab(event)">Personal Details</button>
                        <button class="nav-link" id="event-tab" data-bs-toggle="tab" data-bs-target="#coupon" type="button" role="tab" onclick="selectTab(event)">Coupon History</button>
                        
                    </ul> -->

                    <div class="detail-modal-container rounded-0">
                        <!-- <div class="d-flex justify-content-end mb-1">
                            <button class="btn common-btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Coming Soon...."><i class="bi bi-clock-history me-25"></i>Activity History</button>
                        </div> -->
                        <form id="editCouponForm">
                            <input type="hidden" name="coupon_id" value="">
                            <div class="row">
                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Coupon Name</label>
                                    <input type="text" class="form-control" name="coupon_name" placeholder="Enter Coupon Name" required />
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Coupon Code</label>
                                    <input type="text" class="form-control" name="coupon_code" placeholder="Enter Coupon Code" required readonly/>
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Marketing Text</label>
                                    <input type="text" class="form-control" name="marketing_text" placeholder="Enter Marketing Text" required />
                                </div>

                                <div class="form-group mb-2 col-6">
                                    <label class="form-label">Start Date</label>
                                    <div class="input-group position-relative">
                                        <input type="text" name="start_date" class="form-control pickrdate dropdown-date-picker required" placeholder="DD/MM/YYYY" />
                                    </div>
                                </div>

                                <div class="form-group mb-2 col-6">
                                    <label class="form-label">End Date</label>
                                    <div class="input-group position-relative">
                                        <input type="text" name="end_date" class="form-control pickrdate dropdown-date-picker required" placeholder="DD/MM/YYYY" />
                                    </div>
                                </div>

                                <div class="form-group mb-2 col-md-6">
                                    <label class="form-label required">Coupon Type</label>
                                    <select class="select2InModal select2 form-select coupon_type" name="coupon_type" data-placeholder="Select coupon type">
                                        <option></option>
                                        <option value="generic">Generic</option>
                                        <option value="membership">Membership</option>
                                        <option value="event">Event</option>
                                        <option value="user_specific">User Specific</option>
                                    </select>
                                </div>

                                <div class="form-group mb-2 col-md-6">
                                    <label class="form-label required">Membership Type</label>
                                    <select class="select2InModal select2 form-select membership_type" name="membership_type" data-placeholder="Select membership type">
                                        <option value="all">All</option>
                                        <option value="free">Free</option>
                                        <option value="standard">Standard</option>
                                        <option value="premium">Premium</option>
                                    </select>
                                </div>

                                <div class="form-group mb-2 col-md-6">
                                    <label class="form-label required">Event</label>
                                    <select class="select2InModal select2 form-select event_type" name="event_type" data-placeholder="Select event">
                                        <option value="all">All</option>
                                    </select>
                                </div>
                                
                                <div class="form-group mb-2 col-md-6">
                                    <label class="form-label required">Select Users</label>
                                    <select name="user_specific" class="select2InModal select2 form-select user_specific" data-placeholder="Select Users" multiple>
                                    </select>
                                </div>

                                <div class="form-group mb-2 col-md-6">
                                    <label class="form-label required">Discount Type</label>
                                    <select class="select2InModal select2 form-select discount_type" name="discount_type" data-placeholder="Select discount type">
                                        <option></option>
                                        <option value="flat">Flat</option>
                                        <option value="percent">Percent</option>
                                    </select>
                                </div>
                                
                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Flat Discount</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="input-group">
                                                <span class="input-group-text">&#8377;</span>
                                                <input type="number" class="form-control" name="discount_flat_inr" placeholder="Enter Amount in (&#8377;)"/>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control" name="discount_flat_usd" placeholder="Enter Amount in ($)"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Discount in %</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="input-group">
                                                <span class="input-group-text">&#8377;(%)</span>
                                                <input type="number" class="form-control" name="discount_percent_inr" placeholder="Enter Amount in (&#8377;)"/>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group">
                                                <span class="input-group-text">$(%)</span>
                                                <input type="number" class="form-control" name="discount_percent_usd" placeholder="Enter Amount in ($)"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Maximum Discount</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="input-group">
                                                <span class="input-group-text">&#8377;</span>
                                                <input type="number" class="form-control" name="maximum_discount_inr" placeholder="Enter Amount in (&#8377;)"/>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control" name="maximum_discount_usd" placeholder="Enter Amount in ($)"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Max Use Per User</label>
                                    <input type="number" class="form-control" name="max_use_per_user" placeholder="Enter Max Use Per User" required />
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-check-label mb-50">Is Active?</label>
                                    <div class="form-check form-check-primary form-switch">
                                        <input type="checkbox" class="form-check-input" name="is_active" value="1" checked/>
                                        <input type="hidden" name="is_active" value="1">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <label></label>
                                <div>
                                    <button type="reset" class="btn common-btn btn-outline-secondary me-50" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn common-btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
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
<script src="{{ asset('new_ui/assets/js/admin/coupon/index.js') }}?v={{ time() }}"></script>

@endsection