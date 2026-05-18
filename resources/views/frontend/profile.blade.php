@extends('frontend.layouts.master')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('new_ui/assets/css/profile.css') }}?v={{ time() }}">
<style>
    .iti{
        display: block !important;
    }
    .iti * {
        /* font-family: 'Lato'; */
        font-family: "Playfair Display", sans-serif;
    }
    .accordion-header h1{
        font-weight: 700;
        font-size: 27px;
        line-height: 100%;
        color: #000;
    }
    .accordion-header h1 span{
        /* font-family: Lato; */
        font-family: "Playfair Display", sans-serif;
        font-weight: 400;
        font-size: 17px;
        leading-trim: Cap height;
        line-height: 100%;
        letter-spacing: 0%;
        vertical-align: middle;
        color: #666666;
    }
    .change-password-link{
        /* font-family: Lato; */
        font-family: "Playfair Display", sans-serif;
        font-weight: 700;
        /* color: #0099ff; */
        color: #244c5a;
        font-size: 17px;
    }
    .select2-selection{
        border: unset !important;
        border-bottom: 1.4px solid #c6b682 !important;
        border-radius: 0 !important;
        height: 42px !important;
    }
    .select2-container .select2-selection:focus {
        box-shadow: unset !important;
    }
    .select2-container{
        box-shadow: unset !important;
    }
    .edit-profile-img-btn{
        position: absolute;
        bottom: 13px;
        right: 19px;
        padding: 5px;
        border: 1px solid #c8b986;
        background: #fff;
        border-radius: 50px;
        width: 32px;
        height: 33px;
        cursor: pointer;
    }
    .edit-profile-img-btn svg {
        width: 22px;
        height: 18px;
    }
    .accordion-button{
      align-items: flex-start;
    }
    .edit-link{
      margin-left: 10px;
      margin-bottom: 10px;
      width: 25px;
      border: unset;
      background: unset;
    }
    .edit-link:disabled {
        opacity: .3;
    }
    input[type="file"]:disabled + .remove-image-btn, input[type="file"]:disabled + .remove-video-btn {
        display: none !important;
    }
    .plan_status{
      border-bottom: 1px solid;
      padding-bottom: 10px;
    }
    .plan_status span {
        /* font-family: 'Lato'; */
        font-family: "Playfair Display", sans-serif;
        font-size: 17px;
        padding: 8px 10px;
    }
    #transactionTable * {
        font-size: 14px;
        /* font-family: 'Lato'; */
        font-family: "Playfair Display", sans-serif;
        text-transform: capitalize;
    }
    #transactionTable tr td:last-child, #transactionTable tr th:last-child {
        text-align: center;
    }
    .accordion-body form{
        border: 1px solid #c6b682;
        padding: 20px;
    }
    
    
</style>
@endsection

@section('content')
<!-- BEGIN: Content-->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('new_ui/assets/images/profile_header.webp') }}" class="d-block w-100 desktop_view" alt="carousel image">
            <img src="{{ asset('new_ui/assets/images/profile_mobile_banner.svg') }}" class="d-block w-100 mobile_view" alt="carousel image">
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <article class="profile-card mx-auto">
            <div class="profile-image-wrapper position-relative">
                <img
                  src="{{ asset('new_ui/assets/images/dummy-user.webp') }}"
                  alt="Profile picture of Prernaa Makhariaa"
                  class="profile-image img-fluid"
                />
                <div class="edit-profile-img-btn" data-bs-toggle="modal" data-bs-target="#changeProfileImageModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="26" viewBox="0 0 25 26" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.6894 11.9261L8.20418 23.4123C7.74919 23.8673 7.15782 24.1623 6.52059 24.254L1.18485 25.0165C0.876147 25.0611 0.56374 24.957 0.343068 24.7363C0.122392 24.5156 0.0182642 24.2032 0.0628843 23.8945L0.825319 18.5588C0.915823 17.9215 1.21214 17.3314 1.6671 16.8752L13.1523 5.38898L19.6894 11.9261ZM14.5555 3.98656L16.9111 1.63101C18.0727 0.46935 19.9572 0.46935 21.1189 1.63101L23.4483 3.9605C24.61 5.12216 24.61 7.00659 23.4483 8.16829L21.0928 10.5238L14.5555 3.98656Z" fill="#C6B682"/>
                    </svg>
                </div>
            </div>
            <section class="profile-details">
                <div class="profile-info">
                    <h2 class="profile-name"></h2>
                    <p class="profile-phone"></p>
                    <a class="mt-2 change-password-link" href="javascript:;" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</a>
                </div>
                <div class="row mt-2">
                    <div class="col-md-10"></div>
                    <div class="col-md-2" align="right">
                        <a href="https://youtu.be/BUBN8gHRfWk?si=AVCLR5VnYTpKw_F5" target="_blank" class="change-password-link">
                            <p style="margin-bottom: 0;font-size: 14px;">
                                <u>How to Edit Profile</u> 
                                 <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0 0 50 50">
                                    <path id="youtube-vector" d="M 44.898438 14.5 C 44.5 12.300781 42.601563 10.699219 40.398438 10.199219 C 37.101563 9.5 31 9 24.398438 9 C 17.800781 9 11.601563 9.5 8.300781 10.199219 C 6.101563 10.699219 4.199219 12.199219 3.800781 14.5 C 3.398438 17 3 20.5 3 25 C 3 29.5 3.398438 33 3.898438 35.5 C 4.300781 37.699219 6.199219 39.300781 8.398438 39.800781 C 11.898438 40.5 17.898438 41 24.5 41 C 31.101563 41 37.101563 40.5 40.601563 39.800781 C 42.800781 39.300781 44.699219 37.800781 45.101563 35.5 C 45.5 33 46 29.398438 46.101563 25 C 45.898438 20.5 45.398438 17 44.898438 14.5 Z M 19 32 L 19 18 L 31.199219 25 Z" fill="#264C5A"></path>
                                </svg>
                            </p>                           
                        </a>
                    </div>
                </div>

            </section>
        </article>
      </div>
    </div>
  </div>

<section class="container profile-container">

    <div class="accordion accordion-flush" id="jewelleryNetworkingFAQ">
        <div class="accordion-item">
            <h2 class="accordion-header" id="faq1">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-ans-1" aria-expanded="false" aria-controls="faq-ans-1">
                    <h1>My Profile<br/>
                        <span class="profile-username"></span><br/>
                        <span>Membership Id : <span class="profile-membership-id"></span></span>
                    </h1>
                </button>
            </h2>
            <div id="faq-ans-1" class="accordion-collapse collapse" aria-labelledby="faq1" data-bs-parent="#jewelleryNetworkingFAQ">
                <div class="accordion-body">
                  <div class="row">
                        <div class="col-md-12 text-end">
                          <button href="javascript:;" class="edit-link">
                              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="26" viewBox="0 0 25 26" fill="none">
                                  <path fill-rule="evenodd" clip-rule="evenodd" d="M19.6894 11.9261L8.20418 23.4123C7.74919 23.8673 7.15782 24.1623 6.52059 24.254L1.18485 25.0165C0.876147 25.0611 0.56374 24.957 0.343068 24.7363C0.122392 24.5156 0.0182642 24.2032 0.0628843 23.8945L0.825319 18.5588C0.915823 17.9215 1.21214 17.3314 1.6671 16.8752L13.1523 5.38898L19.6894 11.9261ZM14.5555 3.98656L16.9111 1.63101C18.0727 0.46935 19.9572 0.46935 21.1189 1.63101L23.4483 3.9605C24.61 5.12216 24.61 7.00659 23.4483 8.16829L21.0928 10.5238L14.5555 3.98656Z" fill="#C6B682"/>
                              </svg>
                          </button>
                        </div>
                  </div>
                  <form class="" id="basicForm">
                    <div class="row">
                            <div class="col-md-6 mb-1">
                                <label class="form-label required">First Name</label>
                                <input type="text" class="form-control" name="first_name" placeholder="Enter first name" readonly>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label required">Last Name</label>
                                <input type="text" class="form-control" name="last_name" placeholder="Enter last name" readonly>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label required">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Enter your username" readonly>
                                <label class="username_feedback"></label>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label required">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter your email" readonly>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label required">Mobile Number</label>
                                <input type="text" class="form-control mobile" name="mobile_no" placeholder="Enter your mobile number" readonly>
                            </div>
                            <div class="col-md-6 mb-1">
                            </div>
                            <div class="col-md-6 mb-1">
                                <button type="submit" class="btn btn-secondary custom-btn mt-2 w-100" style="display: none;">
                                    Submit
                                    <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="col-md-6 mb-1">
                                <button type="button" class="btn btn-outline-secondary custom-btn mt-2 w-100 cancel-btn" style="display: none;">
                                    Cancel
                                </button>
                            </div>
                            <!-- <div class="col-md-6 mb-1 d-flex align-items-center">
                                <a class="mt-2 change-password-link" href="javascript:;" class="">Change Password</a>
                            </div> -->
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faq2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-ans-2" aria-expanded="false" aria-controls="faq-ans-2">
                    <h1>My Subscription<br/>
                        <span class="plan_name"></span>
                    </h1>
                </button>
            </h2>
            <div id="faq-ans-2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#jewelleryNetworkingFAQ">
                <div class="accordion-body">
                    <form class="" id="subscriptionForm" style="display: none;">
                        <div class="row">
                            <div class="col-md-6 mb-1">
                                <label class="form-label required">Items</label>
                                <input type="text" class="form-control" name="plan_name" readonly>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label required">Valid Upto</label>
                                <input type="text" class="form-control" name="valid_upto" readonly>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label required">Amount</label>
                                <input type="text" class="form-control" name="amount" readonly>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label required">Status</label>
                                <div class="plan_status">
                                    
                                </div>
                            </div>
                            <div class="col-md-5 mb-1">
                                <h4 style="color: #000;">Membership Details</h4>
                                <div class="benefits">
                                    
                                </div>
                                <a href="/membership" class="btn btn-secondary custom-btn w-100 upgrade-plan-btn">Upgrade Plan
                                    <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faq3">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-ans-3" aria-expanded="false" aria-controls="faq-ans-3">
                    <h1>Company Details</h1>
                </button>
            </h2>
            <div id="faq-ans-3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#jewelleryNetworkingFAQ">
                <div class="accordion-body">
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button href="javascript:;" class="edit-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="26" viewBox="0 0 25 26" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M19.6894 11.9261L8.20418 23.4123C7.74919 23.8673 7.15782 24.1623 6.52059 24.254L1.18485 25.0165C0.876147 25.0611 0.56374 24.957 0.343068 24.7363C0.122392 24.5156 0.0182642 24.2032 0.0628843 23.8945L0.825319 18.5588C0.915823 17.9215 1.21214 17.3314 1.6671 16.8752L13.1523 5.38898L19.6894 11.9261ZM14.5555 3.98656L16.9111 1.63101C18.0727 0.46935 19.9572 0.46935 21.1189 1.63101L23.4483 3.9605C24.61 5.12216 24.61 7.00659 23.4483 8.16829L21.0928 10.5238L14.5555 3.98656Z" fill="#C6B682"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <form class="" id="companyForm">
                        <div class="row">
                            <div class="col-md-6 mb-1">
                                <label class="form-label required">Company Name</label>
                                <input type="text" class="form-control" name="company_name" placeholder="Enter company name" readonly>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label required">Industry</label>
                                <select class="form-select select2" id="category_id" name="category_id" tabindex="5" data-placeholder="Category Type" disabled>
                                    <option></option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label required">Company Address</label>
                                <input type="text" class="form-control" name="company_address" placeholder="Enter address here" readonly>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label required">Tax Id</label>
                                <input type="text" class="form-control" name="trn_no" placeholder="Enter Tax Id here" readonly>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label">Google map link</label>
                                <input type="text" class="form-control" name="google_map_link" placeholder="Enter link" readonly>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label">Specialization</label>
                                <input type="text" class="form-control" name="specialization" placeholder="Enter your specialization" readonly>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label">Business Description</label>
                                <input type="text" class="form-control" name="business_description" placeholder="Enter description here" readonly>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label">Website link</label>
                                <input type="text" class="form-control" name="website" placeholder="Enter website" readonly>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label">Linkedin link</label>
                                <input type="text" class="form-control" name="linkedin_link" placeholder="Enter linkedin link" readonly>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label">Instagram link</label>
                                <input type="text" class="form-control" name="instagram_link" placeholder="Enter instagram link" readonly>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label">Facebook link</label>
                                <input type="text" class="form-control" name="facebook_link" placeholder="Enter facebook link" readonly>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label">Twitter link</label>
                                <input type="text" class="form-control" name="x_link" placeholder="Enter twitter link" readonly>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label">Youtube link</label>
                                <input type="text" class="form-control" name="youtube_link" placeholder="Enter youtube link" readonly>
                            </div>
                            <div class="col-md-12 mb-1">
                                <h4 class="mt-3">Media</h4>
                            </div>
                            <div class="form-group mb-2 col-md-4">
                                <label class="form-label">Company Logo</label>
                                
                                <div class="company_logo-wrapper wrapper">
                                    <!-- Only one upload box -->
                                    <div class="upload-box" data-name="company_logo">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/3/3f/Placeholder_view_vector.svg" class="upload-trigger mb-25" alt="Click or Drop">
                                        <input type="file" name="company_logo" accept="image/*" readonly disabled>
                                        <p class="remove-image-btn" style="display: none;">×</p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-2 col-md-8">
                                <label class="form-label">
                                    Media Images
                                    <button type="button" class="btn btn-primary btn-sm add-btn ms-50 addmediaBtn" data-type="media[]" style="display: none;">+ Add Images</button>
                                </label>
                                <div class="media-wrapper wrapper">
                                </div>
                            </div>
                            <div class="form-group mb-2 col-md-12">
                                <label class="form-label">Company Video</label>

                                <div class="company_video-wrapper wrapper">
                                    <div class="upload-box" data-name="company_video">
                                        <video class="upload-video-trigger mb-25" controls style="display: none; width: 100%; max-height: 300px;"></video>
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/3/3f/Placeholder_view_vector.svg" class="upload-placeholder mb-25" alt="Click or Drop">
                                        <input type="file" name="company_video" accept="video/*" readonly disabled>
                                        <p class="remove-video-btn" style="display: none;">×</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-1">
                                <button type="submit" class="btn btn-secondary custom-btn mt-2 w-100" style="display: none;">
                                    Save
                                    <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="col-md-6 mb-1">
                                <button type="button" class="btn btn-outline-secondary custom-btn mt-2 w-100 cancel-btn" style="display: none;">
                                    Cancel
                                </button>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="faq4">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-ans-4" aria-expanded="false" aria-controls="faq-ans-4">
                    <h1>Payment History</h1>
                </button>
            </h2>
            <div id="faq-ans-4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#jewelleryNetworkingFAQ">
                <div class="accordion-body overflow-x-scroll">
                    <table id="transactionTable" class="table table-striped">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">Order Id</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="auth-login-form mt-2" id="resetPasswordForm" autocomplete="off">
            <h3 class="text-center form-heading">Set Password</h3>
            <p class="text-center">Please enter your new password</p>
            <input type="hidden" name="customer_id" value="" autocomplete="off">
            <input type="hidden" name="token" value="" autocomplete="off">
            <div class="mb-1">
                <div class="d-flex justify-content-between">
                    <label class="form-label required" for="login-password">Enter Old Password</label>
                </div>
                <div class="input-group input-group-merge form-password-toggle">
                    <input type="password" class="form-control form-control-merge" name="old_password" id="old_password" tabindex="10" placeholder="Enter old password" maxlength="20"/>
                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                </div>
            </div>
            <div class="mb-1">
                <div class="d-flex justify-content-between">
                    <label class="form-label required" for="login-password">Enter New Password</label>
                </div>
                <div class="input-group input-group-merge form-password-toggle">
                    <input type="password" class="form-control form-control-merge" name="password" id="password" tabindex="11" placeholder="Enter password" aria-describedby="login-password" maxlength="20" autocomplete="new-password"/>
                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                </div>
            </div>
            <div class="mb-2">
                <div class="d-flex justify-content-between">
                    <label class="form-label required" for="login-password">Confirm New Password</label>
                </div>
                <div class="input-group input-group-merge form-password-toggle">
                    <input type="password" class="form-control form-control-merge" name="confirm_password" tabindex="12" placeholder="Enter password" aria-describedby="login-password" maxlength="20" autocomplete="new-password"/>
                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary custom-btn w-100" tabindex="13">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="changeProfileImageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="changeProfileImageForm" class="modal-content" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Change Profile Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img id="profileImagePreview" src="/new_ui/assets/images/dummy-user.webp" alt="Preview" class="rounded-circle mb-3" width="150" height="150" style="object-fit: cover;">
        <div class="mb-3">
          <input type="file" class="form-control" name="profile_photo" accept="image/*" required>
          <div class="form-text text-danger small d-none" id="fileError"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary w-100">Upload</button>
      </div>
    </form>
  </div>
</div>
<!-- END: Content-->
@endsection

@section('script')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="{{ asset('new_ui/assets/js/frontend/profile.js') }}?v={{ time() }}"></script>
<script src="{{ asset('new_ui/assets/js/admin/custom-image-uploader.js') }}?v={{ time() }}"></script>


<script>
    // var myCarousel = document.querySelector('#carouselExampleCaptions')
    // // var carousel = new bootstrap.Carousel(myCarousel, {
    // // interval: 3000,
    // // pause: true,
    // // })
</script>
@endsection