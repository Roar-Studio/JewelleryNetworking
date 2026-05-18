@extends('admin.auth_layouts.master')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('new_ui/assets/css/events.css') }}?v={{ time() }}">
<style>
    .event-preview .custom-btn{
        font-weight: 700;
        text-align: center;
        padding: 20px 60px;
        border-radius: unset;
        border: unset;
        font-size: 23px;
        /* min-width: 400px; */
        position: relative;
    }
    .event-preview .btn-secondary {
        border-color: #c6b682 !important;
        background-color: #c6b682 !important;
        color: #000 !important;
    }
</style>
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
                        <h2 class="content-header-title float-start mb-0">Event Management</h2>
                        <!-- <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('manage.event.index') }}">Home</a>
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
                    <button type="button" class="btn common-btn btn-warning waves-effect waves-float waves-light add-event">
                        <i class="me-25 font-small-4" data-feather='plus'></i>
                        Add Event
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
                                        <input type="text" id="search_key" class="form-control" placeholder="Search with Event Name, Venue" aria-label="Search..." maxlength="100">
                                    </div>
                                    <div class="dropdown-wrapper select-wrapper" data-dropdown="eventType">
                                        <select class="form-select select2" id="event_type" data-placeholder="Event Type">
                                            <option></option>
                                            <option value="free">Free</option>
                                            <option value="paid">Paid</option>
                                        </select>
                                    </div>
                                    <div class="dropdown-wrapper select-wrapper" data-dropdown="isActive">
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
                            <table id="event-list-table" class="table">
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="modal modal-slide-in fade" id="add-event-modals">
        <div class="modal-dialog employe-directory-modal-dialog sidebar-md">
            <div class="modal-content employe-directory-modal-content pt-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil-square me-1"></i>Add Event</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="detail-modal-container rounded-0">
                        <form id="addEventForm">
                            <div class="row">
                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Event Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Event Name" required />
                                </div>

                                <div class="form-group mb-2 col-md-6">
                                    <label class="form-label required">Event Type</label>
                                    <select class="select2InModal select2 form-select event_type" name="event_type" data-placeholder="Select A event type">
                                        <option></option>
                                        <option value="free">Free</option>
                                        <option value="paid">Paid</option>
                                    </select>
                                </div>

                                <div class="form-group mb-2 col-md-6">
                                    <label class="form-label required">Event Mode</label>
                                    <select class="select2InModal select2 form-select event_mode" name="event_mode" data-placeholder="Select A event mode">
                                        <option></option>
                                        <option value="online">Online</option>
                                        <option value="offline">Offline</option>
                                    </select>
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Description</label>
                                    <textarea class="form-control" name="description" placeholder="Enter description" rows="4"></textarea>
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Event Start Date & Time</label>
                                    <div class="row">
                                        <div class="col-6 pe-25">
                                            <div class="input-group position-relative">
                                                <input type="text" name="event_start_date" class="form-control pickrdate dropdown-date-picker required" placeholder="DD/MM/YYYY" />
                                            </div>
                                        </div>
                                        <div class="col-6 ps-25">
                                            <div class="input-group position-relative">
                                                <input type="text" name="event_start_time" class="form-control pickatime time-picker required" placeholder="HH:MM" />
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="event_start_datetime" value=""/>
                                </div>
                                <div class="from-group mb-2 col-md-12">
                                    <div class="form-check form-check-primary">
                                        <input type="checkbox" class="form-check-input" id="eventEndsOnNext">
                                        <label class="form-check-label" for="eventEndsOnNext">My Event ends next day or later</label>
                                    </div>
                                </div>
                                <div class="form-group mb-2 col-md-12" style="display: none;">
                                    <label class="form-label required">Event End Date & Time</label>
                                    <div class="row">
                                        <div class="col-6 pe-25">
                                            <div class="input-group position-relative">
                                                <input type="text" name="event_end_date" class="form-control pickrdate dropdown-date-picker required" placeholder="DD/MM/YYYY" />
                                            </div>
                                        </div>
                                        <div class="col-6 ps-25">
                                            <div class="input-group position-relative">
                                                <input type="text" name="event_end_time" class="form-control pickatime time-picker required" placeholder="HH:MM" />
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="event_end_datetime" value=""/>
                                </div>
                                <div class="form-group mb-2 col-md-12" style="display:none;">
                                    <label class="form-label required">Event Fees</label>
                                    <div class="row">
                                        <div class="col-6 pe-25">
                                            <div class="input-group">
                                                <span class="input-group-text">&#8377;</span>
                                                <input type="number" class="form-control" name="amount_in_inr" placeholder="Enter Amount in (&#8377;)"/>
                                            </div>
                                        </div>
                                        <div class="col-6 ps-25">
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control" name="amount_in_usd" placeholder="Enter Amount in ($)"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Venue Address</label>
                                    <input type="text" class="form-control" name="venue_address" placeholder="Enter Venue Address" />
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label">Google Maps Link</label>
                                    <input type="text" class="form-control" name="google_maps_link" placeholder="Paste Google Maps URL" />
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label">Google Meet Link</label>
                                    <input type="url" class="form-control" name="google_meet_link" placeholder="Paste Google Meet URL" />
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Total Slots</label>
                                    <input type="number" class="form-control" name="total_seats" min="1" max="999999" placeholder="Enter total slots"/>
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Event Banner</label>
                                    
                                    <div class="banner-wrapper wrapper">
                                        <!-- Only one upload box -->
                                        <div class="upload-box" data-name="banner">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/3/3f/Placeholder_view_vector.svg" class="upload-trigger mb-25" alt="Click or Drop">
                                            <input type="file" name="banner" accept="image/*">
                                            <p class="remove-image-btn" style="display: none;">×</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4 col-md-12">
                                    <label class="form-label">
                                        Event sponsor
                                        <button type="button" class="btn btn-primary btn-sm add-btn ms-50 addsponsorBtn" data-type="sponsor[]">+ Add Sponsors</button>
                                    </label>
                                    <div class="sponsor-wrapper wrapper">
                                    </div>
                                </div>


                                <div class="form-group mb-2 pe-25 col-6">
                                    <label class="form-label required">Registration Start Date</label>
                                    <div class="input-group position-relative">
                                        <input type="text" name="display_start_date" class="form-control pickrdate dropdown-date-picker required" placeholder="DD/MM/YYYY" />
                                    </div>
                                </div>

                                <div class="form-group mb-2 ps-25 col-6">
                                    <label class="form-label required">Registration End Date</label>
                                    <div class="input-group position-relative">
                                        <input type="text" name="display_end_date" class="form-control pickrdate dropdown-date-picker required" placeholder="DD/MM/YYYY" />
                                    </div>
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
                                <div>
                                    <button type="button" class="btn common-btn btn-warning preview-btn"><i class="bi bi-eye me-50"></i>Preview</button>
                                </div>
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

    <div class="modal modal-slide-in fade" id="event-detail-modals">
        <div class="modal-dialog employe-directory-modal-dialog sidebar-md">
            <div class="modal-content employe-directory-modal-content pt-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil-square me-1"></i>Update Event</h5>
                </div>
                <div class="modal-body flex-grow-1">
                
                    <!-- <ul class="nav nav-tabs m-0 d-flex" id="myTab" role="tablist">
                        <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab" onclick="selectTab(event)">Personal Details</button>
                        <button class="nav-link" id="event-tab" data-bs-toggle="tab" data-bs-target="#event" type="button" role="tab" onclick="selectTab(event)">Event History</button>
                        
                    </ul> -->

                    <div class="detail-modal-container rounded-0">
                        <!-- <div class="d-flex justify-content-end mb-1">
                            <button class="btn common-btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Coming Soon...."><i class="bi bi-clock-history me-25"></i>Activity History</button>
                        </div> -->
                        <form id="editEventForm">
                            <input type="hidden" name="event_id" value="">
                            <div class="row">
                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Event Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Event Name" required />
                                </div>

                                <div class="form-group mb-2 col-md-6">
                                    <label class="form-label required">Event Type</label>
                                    <select class="select2InModal select2 form-select event_type" name="event_type" data-placeholder="Select A event type">
                                        <option></option>
                                        <option value="free">Free</option>
                                        <option value="paid">Paid</option>
                                    </select>
                                </div>

                                <div class="form-group mb-2 col-md-6">
                                    <label class="form-label required">Event Mode</label>
                                    <select class="select2InModal select2 form-select event_mode" name="event_mode" data-placeholder="Select A event mode">
                                        <option></option>
                                        <option value="online">Online</option>
                                        <option value="offline">Offline</option>
                                    </select>
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Description</label>
                                    <textarea class="form-control" name="description" placeholder="Enter description" rows="4"></textarea>
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Event Start Date & Time</label>
                                    <div class="row">
                                        <div class="col-6 pe-25">
                                            <div class="input-group position-relative">
                                                <input type="text" name="event_start_date" class="form-control pickrdate dropdown-date-picker required" placeholder="DD/MM/YYYY" />
                                            </div>
                                        </div>
                                        <div class="col-6 ps-25">
                                            <div class="input-group position-relative">
                                                <input type="text" name="event_start_time" class="form-control pickatime time-picker required" placeholder="HH:MM" />
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="event_start_datetime" value=""/>
                                </div>
                                <div class="from-group mb-2 col-md-12">
                                    <div class="form-check form-check-primary">
                                        <input type="checkbox" class="form-check-input" id="eventEndsOnNexte">
                                        <label class="form-check-label" for="eventEndsOnNexte">My Event ends next day or later</label>
                                    </div>
                                </div>
                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Event End Date & Time</label>
                                    <div class="row">
                                        <div class="col-6 pe-25">
                                            <div class="input-group position-relative">
                                                <input type="text" name="event_end_date" class="form-control pickrdate dropdown-date-picker required" placeholder="DD/MM/YYYY" />
                                            </div>
                                        </div>
                                        <div class="col-6 ps-25">
                                            <div class="input-group position-relative">
                                                <input type="text" name="event_end_time" class="form-control pickatime time-picker required" placeholder="HH:MM" />
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="event_end_datetime" value=""/>
                                </div>
                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Event Fees</label>
                                    <div class="row">
                                        <div class="col-6 pe-25">
                                            <div class="input-group">
                                                <span class="input-group-text">&#8377;</span>
                                                <input type="number" class="form-control" name="amount_in_inr" placeholder="Enter Amount in (&#8377;)"/>
                                            </div>
                                        </div>
                                        <div class="col-6 ps-25">
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control" name="amount_in_usd" placeholder="Enter Amount in ($)"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Venue Address</label>
                                    <input type="text" class="form-control" name="venue_address" placeholder="Enter Venue Address" />
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label">Google Maps Link</label>
                                    <input type="text" class="form-control" name="google_maps_link" placeholder="Paste Google Maps URL" />
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label">Google Meet Link</label>
                                    <input type="url" class="form-control" name="google_meet_link" placeholder="Paste Google Meet URL" />
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Total Slots</label>
                                    <input type="number" class="form-control" name="total_seats" min="0" max="999999" placeholder="Enter total slots"/>
                                </div>

                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Event Banner</label>
                                    
                                    <div class="banner-wrapper wrapper">
                                        <!-- Only one upload box -->
                                        <div class="upload-box" data-name="banner">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/3/3f/Placeholder_view_vector.svg" class="upload-trigger mb-25" alt="Click or Drop">
                                            <input type="file" name="banner" accept="image/*">
                                            <p class="remove-image-btn" style="display: none;">×</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4 col-md-12">
                                    <label class="form-label">
                                        Event sponsor
                                        <button type="button" class="btn btn-primary btn-sm add-btn ms-50 addsponsorBtn" data-type="sponsor[]">+ Add Sponsors</button>
                                    </label>
                                    <div class="sponsor-wrapper wrapper">
                                    </div>
                                </div>

                                <div class="form-group mb-2 pe-25 col-6">
                                    <label class="form-label required">Registration Start Date</label>
                                    <div class="input-group position-relative">
                                        <input type="text" name="display_start_date" class="form-control pickrdate dropdown-date-picker required" placeholder="DD/MM/YYYY" />
                                    </div>
                                </div>

                                <div class="form-group mb-2 ps-25 col-6">
                                    <label class="form-label required">Registration End Date</label>
                                    <div class="input-group position-relative">
                                        <input type="text" name="display_end_date" class="form-control pickrdate dropdown-date-picker required" placeholder="DD/MM/YYYY" />
                                    </div>
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
                                <div>
                                    <button type="button" class="btn common-btn btn-warning preview-btn"><i class="bi bi-eye me-50"></i>Preview</button>
                                </div>
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

    <div class="modal modal-slide-in fade" id="register-list-modals">
        <div class="modal-dialog employe-directory-modal-dialog sidebar-lg">
            <div class="modal-content employe-directory-modal-content pt-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-card-list me-1"></i>List of Registered Persons</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="detail-modal-container rounded-0">
                        <table class="RegisterListTable table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Payment Method</th>
                                    <th>Order ID</th>
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

    <div class="modal modal-slide-in fade" id="preview-modal">
        <div class="modal-dialog employe-directory-modal-dialog w-100">
            <div class="modal-content employe-directory-modal-content pt-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-eye me-1"></i>Preview</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="detail-modal-container rounded-0">
                        <div class="container event-preview">
                            
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
<script src="{{ asset('new_ui/assets/js/admin/event/index.js') }}?v={{ time() }}"></script>
<script src="{{ asset('new_ui/assets/js/admin/custom-image-uploader.js') }}?v={{ time() }}"></script>

@endsection