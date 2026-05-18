@extends('admin.auth_layouts.master')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
<style>
    .dropzone{
        border: 1px dashed #1b84ff;
        background: #e9f3ff;
        border-radius: 13px;
    }
    .dropzone .bi-download{
        font-size: 50px;
        color: #4ea0ff;
    }
    .dropzone .dz-preview .dz-image img {
        display: block;
        width: 90px;
        object-fit: cover;
        object-position: center;
        height: 90px;
    }
    .dropzone .dz-preview .dz-image{
        height: 90px;
        width: 90px;
    }
    .dropzone .dz-preview.dz-image-preview{
        background: transparent;
    }
    .dropzone .dz-preview .dz-details .dz-size {
        margin-bottom: .5em;
        font-size: 13px;
    }
    .video-input-row .error {
        display: block;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
    }
    .video-input-row .is-invalid {
        border-color: #dc3545;
    }
    .video-input-row .is-valid {
        border-color: #28a745;
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
                        <h2 class="content-header-title float-start mb-0">Gallery Management</h2>
                        <!-- <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('manage.gallery.index') }}">Home</a>
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
                    <button type="button" class="btn common-btn btn-warning waves-effect waves-float waves-light add-gallery">
                        <i class="me-25 font-small-4" data-feather='plus'></i>
                        Add Folder
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
                                        <input type="text" id="search_key" class="form-control" placeholder="Search with Gallery Name" aria-label="Search..." maxlength="100">
                                    </div>
                                    <div class="dropdown-wrapper select-wrapper" data-dropdown="OperatingType">
                                        <select class="form-select select2" id="is_active" data-placeholder="Status">
                                            <option></option>
                                            <option value="1">Active</option>
                                            <option value="0">InActive</option>
                                        </select>
                                    </div>
                                    <!-- <div class="dropdown-wrapper position-relative" data-dropdown="DateFrom">
                                        <input type="text" name="date_from" id="date_from" class="form-control pickrdate dropdown-date-picker" placeholder="Date From" aria-label="MM/DD/YYYY" />
                                    </div>
                                    <div class="dropdown-wrapper position-relative" data-dropdown="DateTo">
                                        <input type="text" name="date_to" id="date_to" class="form-control pickrdate dropdown-date-picker" placeholder="Date to" aria-label="MM/DD/YYYY" />
                                    </div> -->
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
                            <table id="gallery-list-table" class="table">
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="modal modal-slide-in fade" id="add-gallery-modals">
        <div class="modal-dialog employe-directory-modal-dialog sidebar-md">
            <div class="modal-content employe-directory-modal-content pt-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil-square me-1"></i>Add Folder</h5>
                </div>
                <div class="modal-body flex-grow-1">
                
                    <!-- <ul class="nav nav-tabs m-0 d-flex" id="myTab" role="tablist">
                        <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab" onclick="selectTab(event)">Personal Details</button>
                        <button class="nav-link" id="event-tab" data-bs-toggle="tab" data-bs-target="#gallery" type="button" role="tab" onclick="selectTab(event)">Gallery History</button>
                        
                    </ul> -->

                    <div class="detail-modal-container rounded-0">
                        
                        <form id="addGalleryForm">
                            <div class="row">
                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Gallery Type</label>
                                    <div class="form-group mt-50">
                                        <input type="radio" class="form-check-input me-25" name="gallery_type" value="event" checked />Events
                                        <input type="radio" class="form-check-input ms-2 me-25" name="gallery_type" value="media" />Media
                                    </div>
                                    
                                </div>

                                <div class="form-group mb-2 col-md-6">
                                    <label class="form-label required">Gallery Name</label>
                                    <input type="text" class="form-control" name="gallery_name" placeholder="Enter Gallery Name" required />
                                    <div class="gallery_name_feedback text-end"></div>
                                </div>
                                <div class="form-group mb-2 col-md-6">
                                    <label class="form-label">Location</label>
                                    <input type="text" class="form-control" name="location" placeholder="Enter Location" />
                                </div>

                                <div class="form-group mb-2 col-6">
                                    <label class="form-label">Gallery Date</label>
                                    <div class="input-group position-relative">
                                        <input type="text" name="gallery_date" class="form-control pickrdate dropdown-date-picker" placeholder="DD/MM/YYYY" />
                                    </div>
                                </div>

                                
                                <div class="form-group mb-2 col-md-6">
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
                                    <button type="submit" class="btn common-btn btn-primary">Add Category</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-slide-in fade" id="gallery-detail-modals">
        <div class="modal-dialog employe-directory-modal-dialog sidebar-md">
            <div class="modal-content employe-directory-modal-content pt-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil-square me-1"></i>Update Gallery</h5>
                </div>
                <div class="modal-body flex-grow-1">


                    <div class="detail-modal-container rounded-0">
                        
                        <form id="editGalleryForm">
                            <input type="hidden" name="gallery_id" value="">
                            <div class="row">
                                <div class="form-group mb-2 col-md-12">
                                    <label class="form-label required">Gallery Type</label>
                                    <div class="form-group mt-50">
                                        <input type="radio" class="form-check-input me-25" name="gallery_type" value="event" />Events
                                        <input type="radio" class="form-check-input ms-2 me-25" name="gallery_type" value="media" />Media
                                    </div>
                                    
                                </div>

                                <div class="form-group mb-2 col-md-6">
                                    <label class="form-label required">Gallery Name</label>
                                    <input type="text" class="form-control" name="gallery_name" placeholder="Enter Gallery Name" required />
                                    <div class="gallery_name_feedback text-end"></div>
                                </div>

                                <div class="form-group mb-2 col-md-6">
                                    <label class="form-label">Location</label>
                                    <input type="text" class="form-control" name="location" placeholder="Enter Location" />
                                </div>

                                <div class="form-group mb-2 col-6">
                                    <label class="form-label">Gallery Date</label>
                                    <div class="input-group position-relative">
                                        <input type="text" name="gallery_date" class="form-control pickrdate dropdown-date-picker" placeholder="DD/MM/YYYY" />
                                    </div>
                                </div>

                                
                                <div class="form-group mb-2 col-md-6">
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
                                    <button type="submit" class="btn common-btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal modal-slide-in fade" id="upload-files-modals">
        <div class="modal-dialog employe-directory-modal-dialog sidebar-md">
            <div class="modal-content employe-directory-modal-content pt-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil-square me-1"></i>Update Gallery</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="detail-modal-container rounded-0">
                        <h3 class="folder_name text-center"></h3>
                        <hr/>
                        <form class="form" action="#" method="post">
                            <div class="fv-row">
                                <label class="fs-10 fw-semibold text-gray-500 mb-1"><b>Note:</b>(Max Filesize: 20MB)<br/>Only .jpg, .jpeg, .png, .gif, .mp4, .mov, .mpeg1, .mpeg2, .mpeg4, .mpg, files are allowed.</label>
                                <div class="dropzone" id="kt_dropzonejs_example_1">
                                    <div class="dz-message needsclick">
                                        <i class="ki-duotone ki-file-up fs-3x text-primary"><span class="path1"></span><span class="path2"></span></i>

                                        <div class="">
                                            <i class="bi bi-download"></i>
                                            <h3 class="fs-5 fw-bold text-gray-900 mb-25">Drop files here or click to upload.</h3>
                                            <!-- <span class="fs-7 fw-semibold text-gray-500">Upload up to 10 files</span> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal modal-slide-in fade" id="upload-videos-modals">
        <div class="modal-dialog employe-directory-modal-dialog sidebar-md">
            <div class="modal-content employe-directory-modal-content pt-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil-square me-1"></i>Add Videos</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="detail-modal-container rounded-0">
                        <form id="addVideoForm">
                            <input type="hidden" name="gallery_id" value="">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label required">YouTube URLs</label>
                                    <div class="add-btn-row mb-2">
                                        <button type="button" class="btn btn-primary btn-md add-video-input w-100" style="width: 20% !important;">
                                            <i class="bi bi-plus"></i> Add Video
                                        </button>
                                    </div>
                                    <div id="video-inputs-container">
                                        <!-- existing video rows append here -->
                                    </div>
                                    <!-- <div id="video-inputs-container">
                                        <div class="video-input-row mb-2">
                                            <div class="row align-items-start">
                                                <div class="col-10">
                                                    <input type="url" class="form-control" name="youtube_urls[]" placeholder="Enter YouTube URL" required />
                                                </div>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary btn-md add-video-input w-100">
                                                        <i class="bi bi-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-3">
                                <label></label>
                                <div>
                                    <button type="reset" class="btn common-btn btn-outline-secondary me-50" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn common-btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="crop-image-modal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crop Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="crop-image" style="max-width: 100%;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop-and-upload">Crop & Upload</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@section('script')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script src="{{ asset('new_ui/assets/js/admin/gallery/index.js') }}?v={{ time() }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
    
</script>

@endsection