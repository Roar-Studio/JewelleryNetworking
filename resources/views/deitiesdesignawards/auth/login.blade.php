@extends('frontend.guest_layouts.master')

@section('css')
<style>
    img.brand-logo{
        height: 100px;
        margin: 0 auto;
        display: block;
    }
    .toggle-auth-btns{
        display: flex;
        align-items: center;
        justify-content: center;
        border: 0.5px solid #C6B682;
        background: #FFF;
        margin: 30px auto 0;
        padding: 2px;
    }
    .toggle-auth-btns .btn{
        flex: 1;
        color: #999;
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: normal;
    }
    .toggle-auth-btns .btn.active{
        background: #264C5A;
        border-radius: 0;
        color: #fff;
        font-weight: bold;
    }
    .auth-inner{
        display:flex;
    }
    .form-control{
        padding: 8px 30px 8px 12px;
    }
    .auth-inner > img{
        width: 53%;
        height: calc(100vh - 2px);
        object-fit: cover;
        object-position:top;
    }
    .auth-inner .card{
        width: 47%;
        display: flex;
        /* flex-direction: row;
        justify-content: center; */
        align-items: center;
        background: #FDF6ED;
        box-shadow: 0px 0px 100px 25px rgba(0, 0, 0, 0.20);
        height: 99.5vh;
        overflow-y: auto;
    }
    .auth-inner .card .card-body {
        max-width: 445px;
        width: 100%;
        padding: 30px 20px;
        z-index: 1;
    }
    .auth-inner input, .auth-inner select, .auth-inner .input-group{
        border: 0.5px solid #C6B682;
        background: #FFF;
        color: #000;
        border-radius: 0 !important;
    }
    .auth-inner input.is-invalid, .auth-inner select.is-invalid, .auth-inner .input-group.is-invalid{
        border: 0.5px solid #ff0000;
        
    }
    .auth-inner input, .auth-inner input:focus{
        color: #000;
    }
    .input-group input, .auth-inner .input-group-text{
        border:unset;
    }

    .auth-inner form .btn{
        background: #C6B682;
        color: #000;
        border-radius: 0;
        font-size: 15px;
        font-weight: 700;
        height: 45px;
    }
    .form-check-input:checked[type="checkbox"] {
        background-repeat: no-repeat;
        background-position: center;
    }
    .forgot-password-btn{
        color: #264C5A;
    }
    .form-label.required:after {
        content: "*";
        color: red;
    }
    .form-label{
        color: #264C5A;
        font-style: normal;
        font-weight: 600;
        line-height: normal;
    }
    .abs-daimond{
        position: fixed;
        bottom: 0;
        right: 0;
        width: 225px;
        height: 225px;
    }

    /* otp form css */
    #otp{
        justify-content: space-between;
        border: unset;
        background: unset;
    }
    #otp input {
        padding: 5px;
        width: 50px;
        height: 50px;
        flex: unset;
        border: 0.5px solid #C6B682;

    }
    #resendOTPBtn, #timer{
        color: #1058FF;
        border: 0;
        background: 0;
    }
    #resendOTPBtn{
        float: right;
    }
    #resendOTPBtn:disabled{
        color: #ddd;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow b{
        border-color: unset;
        border-style: unset;
        border-width: unset;
        height: 20px;
        left: unset;
        margin-left: unset;
        margin-top: unset;
        position: absolute;
        top: 45%;
        width: 20px;
    }
    .form-heading{
        color: #000000;
        text-align: center;
        font-size: 26px;
        font-family: "Playfair Display";
        font-weight: 800;
    }
    .select2-container--default .select2-selection--single{
        border: 0.5px solid #C6B682 !important;
        border-radius: 0;
    }
    .input-svg svg{
        position: absolute;
        top: 12px;
        right: 12px;
        height: 15px;
        width: 15px;
    }
    .input-svg img{
        position: absolute;
        top: 12px;
        right: 12px;
        height: 15px;
        width: 15px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow{
        right: 40px;
    }
    .input-group.input-group-merge.form-password-toggle {
        position: relative;
    }

    .input-group.input-group-merge.form-password-toggle img {
        position: absolute;
        right: 10px; /* Adjust based on padding */
        top: 50%;
        transform: translateY(-50%);
        z-index: 5;
        cursor: pointer;
    }
    @media screen and (max-width: 768px) {
        .auth-inner > img{
            display: none;
        }
        .auth-inner .card{
            width: 100%;
            height: 100vh;
        }
        .abs-daimond{
            width: 100px;
            height: 100px;
        }
        #custRegisterForm .col-md-6{
            padding: 0 15px !important;
        }   
        
    }
</style>
@endsection

@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <div class="auth-inner">
                <!-- Login basic -->
                <img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Indias+first+awards+platform+dedicated+to+jewellery+created+for+the+divine.png') }}"/>
                <div class="card mb-0">
                    <div class="card-body">
                        <img class="brand-logo" src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}">
                        <div class="toggle-auth-btns">
                            <button class="btn active">Login</button>
                            <button class="btn">Sign up</button>
                        </div>
                        <form class="auth-login-form mt-2" id="custLoginForm" autocomplete="off">
                            <div class="mb-1">
                                <label for="login-email" class="form-label required">Email ID / Username / Mobile Number</label>
                                <input type="text" class="form-control" id="login-email" name="email" placeholder="Enter Username/Email/Mobile Number" aria-describedby="login-email" tabindex="1" autofocus maxlength="50" autocomplete="off"/>
                            </div>

                            <div class="mb-1">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label required" for="login-password">Password</label>
                                    <a href="{{ route('forgotPassword') }}" class="forgot-password-btn" tabindex="2">
                                        <small>Forgot Password?</small>
                                    </a>
                                </div>
                                <div class="input-group input-group-merge form-password-toggle">
                                    <input type="password" class="form-control form-control-merge" id="login-password" name="password" tabindex="2" placeholder="Enter password" aria-describedby="login-password" maxlength="50" autocomplete="off"/>
                                    {{-- <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span> --}}
                                    <img width="14" height="14" src="{{ asset('new_ui/assets/images/show-password.webp') }}" id="show-password" onclick="togglePassword('login')">
                                    <img width="14" height="14" src="{{ asset('new_ui/assets/images/hide-password.webp') }}" id="hide-password" onclick="togglePassword('login')" style="display:none;">
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="form-check">
                                    <input class="form-check-input" name="remember_me" type="checkbox" id="remember_me" tabindex="3" autocomplete="off"/>
                                    <label class="form-check-label" for="remember_me"> Remember Me </label>
                                </div>
                            </div>
                            <button type="submit" class="btn w-100" tabindex="4">Login</button>
                        </form>

                        <form class="auth-login-form mt-2" id="custRegisterForm" style="display: none" autocomplete="off">
                            <div class="row">
                                <div class="col-md-6 pe-25  mb-1">
                                    <label class="form-label required">First name</label>
                                    <div class="input-svg position-relative">
                                        <input type="text" class="form-control" name="first_name" placeholder="Enter first name" tabindex="1" autofocus maxlength="50" autocomplete="off"/>
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 19 20" fill="none">
                                            <path d="M9.5 0.242188C10.7598 0.242188 11.968 0.742632 12.8588 1.63343C13.7496 2.52423 14.25 3.73241 14.25 4.99219C14.25 6.25197 13.7496 7.46015 12.8588 8.35094C11.968 9.24174 10.7598 9.74219 9.5 9.74219C8.24022 9.74219 7.03204 9.24174 6.14124 8.35094C5.25044 7.46015 4.75 6.25197 4.75 4.99219C4.75 3.73241 5.25044 2.52423 6.14124 1.63343C7.03204 0.742632 8.24022 0.242188 9.5 0.242188ZM9.5 12.1172C14.7487 12.1172 19 14.2428 19 16.8672V19.2422H0V16.8672C0 14.2428 4.25125 12.1172 9.5 12.1172Z" fill="#999999"/>
                                        </svg> --}}
                                        <img src="{{ asset('new_ui/assets/images/user-icon.webp') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 ps-25  mb-1">
                                    <label class="form-label required">Last Name</label>
                                    <div class="input-svg position-relative">
                                        <input type="text" class="form-control" name="last_name" placeholder="Enter last name" tabindex="2" autofocus maxlength="50" autocomplete="off"/>
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 19 20" fill="none">
                                            <path d="M9.5 0.242188C10.7598 0.242188 11.968 0.742632 12.8588 1.63343C13.7496 2.52423 14.25 3.73241 14.25 4.99219C14.25 6.25197 13.7496 7.46015 12.8588 8.35094C11.968 9.24174 10.7598 9.74219 9.5 9.74219C8.24022 9.74219 7.03204 9.24174 6.14124 8.35094C5.25044 7.46015 4.75 6.25197 4.75 4.99219C4.75 3.73241 5.25044 2.52423 6.14124 1.63343C7.03204 0.742632 8.24022 0.242188 9.5 0.242188ZM9.5 12.1172C14.7487 12.1172 19 14.2428 19 16.8672V19.2422H0V16.8672C0 14.2428 4.25125 12.1172 9.5 12.1172Z" fill="#999999"/>
                                        </svg> --}}
                                        <img src="{{ asset('new_ui/assets/images/user-icon.webp') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-1">
                                <label class="form-label required">Email ID</label>
                                <div class="input-svg position-relative">
                                    <input type="text" class="form-control" name="email" placeholder="Enter email id" aria-describedby="login-email" tabindex="3" autofocus maxlength="50" autocomplete="off"/>
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                        <path d="M19.7285 4.03601H3.72852C2.62852 4.03601 1.73852 4.93601 1.73852 6.03601L1.72852 18.036C1.72852 19.136 2.62852 20.036 3.72852 20.036H19.7285C20.8285 20.036 21.7285 19.136 21.7285 18.036V6.03601C21.7285 4.93601 20.8285 4.03601 19.7285 4.03601ZM19.7285 8.03601L11.7285 13.036L3.72852 8.03601V6.03601L11.7285 11.036L19.7285 6.03601V8.03601Z" fill="#999999"/>
                                    </svg> --}}
                                    <img src="{{ asset('new_ui/assets/images/email_logo.svg') }}">
                                </div>
                                <label class="custom-email-error text-danger small" style="display: none;"><i class="bi bi-info-circle-fill me-25"></i><span></span></label>
                            </div>
                            <div class="form-group mb-1">
                                <label class="form-label">Mobile Number</label>
                                <div class="input-svg position-relative">
                                    <input type="text" class="form-control mobile" name="mobile_no" placeholder="Enter Mobile Number" tabindex="4" autocomplete="off"/>
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" viewBox="0 0 21 22" fill="none">
                                        <path d="M21 8.20173C21 4.15951 17.7185 0.878052 13.6763 0.878052H7.32368C3.28145 0.878052 0 4.15951 0 8.20173V14.5544C0 18.5966 3.28145 21.8781 7.32368 21.8781H13.6763C17.7185 21.8781 21 18.5966 21 14.5544V8.20173ZM15.5916 15.5522C14.5682 16.7602 13.0977 16.4187 13.0977 16.4187C10.9709 16.1039 9.08097 14.4765 9.08097 14.4765C5.58924 11.4053 5.537 9.38421 5.537 9.38421C5.09093 7.44201 6.4558 6.31303 6.4558 6.31303C7.03313 5.81467 7.58483 6.23407 7.58483 6.23407L9.15993 7.80917C9.86852 8.54443 9.15993 9.17405 9.15993 9.17405L8.42468 9.9093C9.47474 12.2453 12.0731 13.5845 12.0731 13.5845L13.0186 12.6657C13.6482 12.272 14.0164 12.718 14.0164 12.718L15.6182 14.2931C16.2478 15.1073 15.5659 15.6057 15.5659 15.6057L15.5916 15.5522Z" fill="#999999"/>
                                    </svg> --}}
                                    <img src="{{ asset('new_ui/assets/images/Phone.svg') }}">
                                </div>
                                <label class="custom-mobile-error text-danger small" style="display: none;"><i class="bi bi-info-circle-fill me-25"></i><span></span></label>
                            </div>
                            <div class="mb-1">
                                <label class="form-label required">Industry</label>
                                <!-- <select class="form-control select2 form-select category" name="category" data-placeholder="Select A Industry">
                                    <option></option>
                                    <option value="online">Online</option>
                                    <option value="offline">Offline</option>
                                </select> -->
                                <div class="input-svg position-relative dropdown-wrapper select-wrapper"> 
                                    <select class="form-select select2" id="category_id" name="category_id" tabindex="5" data-placeholder="Category Type">
                                        <option></option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M16.9875 4.3625C16.8937 4.3625 16.8 4.36562 16.7062 4.375C15.975 4.45312 15.2937 4.78438 14.7812 5.3125L13.6156 6.47812C13.1906 5.12187 11.875 4.24687 10.4594 4.375C9.725 4.45312 9.04375 4.78438 8.52813 5.3125L7.5 6.35625V1.25C7.5 0.559375 6.94063 0 6.25 0H1.25C0.559375 0 0 0.559375 0 1.25V17.5C0 18.8813 1.11875 20 2.5 20H17.5C18.8813 20 20 18.8813 20 17.5V7.39375C20.0063 5.725 18.6562 4.36875 16.9875 4.3625ZM2.5 2.5H5V7.77188L2.5 10.1906V2.5Z" fill="#999999"/>
                                    </svg> --}}
                                    <img width="20" height="20" src="{{ asset('new_ui/assets/images/industry.webp') }}">
                                </div>
                            </div>
                            <div class="mb-1">
                                <label class="form-label required">Username</label>
                                <div class="input-svg position-relative">
                                    <input type="text" class="form-control" name="username" placeholder="Enter username" tabindex="6" autofocus maxlength="50" autocomplete="off"/>
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="19" height="20" viewBox="0 0 19 20" fill="none">
                                        <path d="M9.5 0.242188C10.7598 0.242188 11.968 0.742632 12.8588 1.63343C13.7496 2.52423 14.25 3.73241 14.25 4.99219C14.25 6.25197 13.7496 7.46015 12.8588 8.35094C11.968 9.24174 10.7598 9.74219 9.5 9.74219C8.24022 9.74219 7.03204 9.24174 6.14124 8.35094C5.25044 7.46015 4.75 6.25197 4.75 4.99219C4.75 3.73241 5.25044 2.52423 6.14124 1.63343C7.03204 0.742632 8.24022 0.242188 9.5 0.242188ZM9.5 12.1172C14.7487 12.1172 19 14.2428 19 16.8672V19.2422H0V16.8672C0 14.2428 4.25125 12.1172 9.5 12.1172Z" fill="#999999"/>
                                    </svg> --}}
                                    <img src="{{ asset('new_ui/assets/images/user-icon.webp') }}">
                                </div>
                                <label class="custom-username-error text-danger small" style="display: none;"><i class="bi bi-info-circle-fill me-25"></i><span></span></label>
                            </div>

                            <div class="mb-1">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label required" for="login-password">Password</label>
                                </div>
                                <div class="input-group input-group-merge form-password-toggle">
                                    <input type="password" class="form-control form-control-merge" name="password" id="password" tabindex="7" placeholder="Enter password" aria-describedby="login-password" maxlength="50" autocomplete="new-password"/>
                                    {{-- <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span> --}}
                                    <img width="15" height="15" src="{{ asset('new_ui/assets/images/show-password.webp') }}" id="show-password-register" onclick="togglePassword('register')">
                                    <img width="15" height="15" src="{{ asset('new_ui/assets/images/hide-password.webp') }}" id="hide-password-register" onclick="togglePassword('register')" style="display:none;">
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label required" for="login-password">Confirm Password</label>
                                </div>
                                <div class="input-group input-group-merge form-password-toggle">
                                    <input type="password" class="form-control form-control-merge" name="confirm_password" tabindex="8" placeholder="Enter password" aria-describedby="login-password" maxlength="50" autocomplete="new-password" id="confirm-password"/>
                                    {{-- <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span> --}}
                                    <img width="15" height="15" src="{{ asset('new_ui/assets/images/show-password.webp') }}" id="show-password-confirm" onclick="togglePassword('confirm')">
                                    <img width="15" height="15" src="{{ asset('new_ui/assets/images/hide-password.webp') }}" id="hide-password-confirm" onclick="togglePassword('confirm')" style="display:none;">
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="form-check">
                                    <input class="form-check-input" name="accept_consent" id="accept_consent" type="checkbox" tabindex="10" autocomplete="off"/>
                                    <label class="form-check-label" for="accept_consent"> I accept the <a href="{{ route('termAndConditions') }}">Terms and Conditions</a> and <a href="{{ route('termAndConditions') }}">Privacy Policy</a>.</label>
                                </div>
                            </div>
                            <button type="submit" class="btn w-100" tabindex="11">Register</button>
                        </form>

                        <!-- Replace your existing OTP form section with this -->
                        <form id="newRegistrationOTPForm" class="row g-3" action="#" method="POST" enctype="multipart/form-data" novalidate="novalidate" onsubmit="return false;" style="display: none;" autocomplete="off">
                            <div class="col-12 py-5 mt-3">
                                <input type="hidden" name="customer_id" value="" autocomplete="off">
                                <input type="hidden" name="token" value="" autocomplete="off">
                                <h3 class="text-center form-heading">Verify your Identity</h3>
                                <p class="text-center">Please enter the OTP we sent to you at registered email <span class="registered_email_id"></span></p>
                                <div class="form-group mb-1">
                                    <label class="mb-1">Enter OTP</label>
                                    <div id="otp" class="input-group flex form-otp text-center">
                                        <input class="text-center form-control" 
                                            type="text" 
                                            id="digit-1" 
                                            name="digit-1" 
                                            maxlength="1" 
                                            autocomplete="off"
                                            inputmode="numeric"
                                            pattern="[0-9]"
                                            data-index="0"/>
                                        <input class="text-center form-control" 
                                            type="text" 
                                            id="digit-2" 
                                            name="digit-2" 
                                            maxlength="1" 
                                            autocomplete="off"
                                            inputmode="numeric"
                                            pattern="[0-9]"
                                            data-index="1"/>
                                        <input class="text-center form-control" 
                                            type="text" 
                                            id="digit-3" 
                                            name="digit-3" 
                                            maxlength="1" 
                                            autocomplete="off"
                                            inputmode="numeric"
                                            pattern="[0-9]"
                                            data-index="2"/>
                                        <input class="text-center form-control" 
                                            type="text" 
                                            id="digit-4" 
                                            name="digit-4" 
                                            maxlength="1" 
                                            autocomplete="off"
                                            inputmode="numeric"
                                            pattern="[0-9]"
                                            data-index="3"/>
                                        <input class="text-center form-control" 
                                            type="text" 
                                            id="digit-5" 
                                            name="digit-5" 
                                            maxlength="1" 
                                            autocomplete="off"
                                            inputmode="numeric"
                                            pattern="[0-9]"
                                            data-index="4"/>
                                        <input class="text-center form-control" 
                                            type="text" 
                                            id="digit-6" 
                                            name="digit-6" 
                                            maxlength="1" 
                                            autocomplete="off"
                                            inputmode="numeric"
                                            pattern="[0-9]"
                                            data-index="5"/>
                                    </div>
                                    <input type="hidden" name="otp" id="full-otp" autocomplete="off">
                                </div>
                                <p>
                                    <span id="timer"></span>
                                    <button id="resendOTPBtn" disabled>Resend OTP</button>
                                </p>
                                <span class="invalid-new-login-otp text-danger">
                                    <strong></strong>
                                </span>
                            </div>
                            
                            <div class="col-12 mt-2">
                                <button class="btn w-100 validateOTP">Submit</button>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-6">
                                <a href="/deitiesdesignawards"><p class="text-left my-2"><i class="bi bi-chevron-left"></i> Go to Homepage</p></a>
                            </div>
                            
                        </div>
                    </div>
                    <svg class="abs-daimond" xmlns="http://www.w3.org/2000/svg" width="338" height="348" viewBox="0 0 338 348" fill="none">
                        <path d="M522.59 108.12C522.29 107.58 521.85 107.16 521.3 106.87L449.59 37.56L449.21 36.95C449.15 36.86 449.08 36.8 449.02 36.71C448.72 35.43 448.05 34.52 446.99 33.99L444.98 33.1L412.26 1.48C412.26 0.74 410.78 0.74 410.04 0.74H371.82L370.15 0H262.28C261.86 0 261.45 0.13 261.05 0.33C260.75 0.42 260.44 0.56 260.07 0.74H156.38C155.5 0.39 154.48 0.34 153.67 0.74L152 1.48H113.04C112.3 1.48 111.56 1.48 110.82 2.22L77.46 34.45L76.83 34.73C76.46 34.92 76.13 35.2 75.86 35.53C75.66 35.73 75.48 35.95 75.35 36.2L74.89 36.93L2.94 106.46C1.15 106.76 0 108.14 0 110.09V124.13C0 124.87 0 125.61 0.74 126.35L258.28 415.63C258.64 416.39 259.23 417.05 260.07 417.46H261.54C262.033 417.46 262.527 417.707 263.02 418.2C264.26 417.58 264.97 416.44 265.17 415.22L337.88 333.78C338.41 333.67 339.03 333.5 339.86 333.22L347.41 323.1L523.09 126.33C523.83 125.59 523.83 124.85 523.83 124.11V110.81C523.83 109.49 523.24 108.76 522.59 108.1V108.12ZM191.24 329.3L112.25 155.77L226.81 308.11L253.35 399.11L191.24 329.3ZM153.81 9.05L183.22 48.97L95.54 104.04L82.01 40.68V40.64L82.22 40.54L153.8 9.05H153.81ZM427.04 104.18L339.63 49.28L369.27 9.05L440.34 40.64L427.04 104.18ZM265.98 11.56L328.04 50.99L265.98 102.1V11.56ZM181.01 106.4L190.61 56.9L251.19 106.4H181H181.01ZM271.89 106.4L331.74 56.9L342.08 106.4H271.89ZM349.46 106.4L339.69 57.56L417.22 106.4H349.46ZM257.85 11.81V102.7L195.05 50.98L199.76 47.99L257.84 11.81H257.85ZM173.63 106.4H105.99L183.25 58.28L173.63 106.4ZM257.85 114.52V120.43H180.85L180.52 114.52H257.85ZM342.24 120.43H265.24V114.52H342.57L342.24 120.43ZM334 45.74L306.64 28.56L274.29 8.13H361.89L334 45.75V45.74ZM189.74 44.88L162.5 8.13H248.25L189.74 44.88ZM173.13 114.52L173.46 120.43H97.52V114.52H173.13ZM90.69 127.08L91.03 127.53L171.41 300.71L41.54 127.08H90.69ZM174.26 127.08L220.91 288.89L99.91 127.08H174.26ZM182.49 127.08H257.11L229.03 290.37L182.48 127.08H182.49ZM257.85 167.14V390.23L233.47 306.63L257.85 167.14ZM265.24 167.17L289.62 306.63L265.24 390.21V167.17ZM265.98 127.08H340.6L294.05 290.37L265.97 127.08H265.98ZM348.82 127.08H423.17L302.17 288.89L348.82 127.08ZM426.3 120.44H349.62L349.95 114.53H426.3V120.44ZM447.36 48.33L483.65 106.4H434.65L447.35 48.33H447.36ZM88.48 106.4H40.44L76.56 48.6L88.48 106.4ZM90.13 114.52V120.43H37.67V114.52H90.13ZM29.55 120.44H7.39V114.53H29.55V120.44ZM31.39 127.08L135.84 267.02L11.33 127.08H31.39ZM297.01 308.11L412.13 154.2L331.74 328.8C331.6 329.08 331.53 329.39 331.49 329.7L269.89 398.93L297.01 308.1V308.11ZM433.02 127.08H483.58L353.16 301.45L433.02 127.08ZM433.69 120.44V114.53H486.89V120.44H433.69ZM495.02 114.52H515.7V120.43H495.02V114.52ZM510.31 106.4H492.89L466.42 64.31L510.31 106.4ZM407.83 8.13L424.36 23.98L388.53 8.13H407.83ZM114.52 8.13H136.97L95.29 26.56L114.51 8.13H114.52ZM31.22 106.4H12.04L60.34 60.09L31.22 106.4ZM493.73 127.08H511.76L399.84 252.87L493.73 127.08Z" fill="#C6B682" fill-opacity="0.15"/>
                    </svg>
                </div>
                <!-- /Login basic -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="{{ asset('new_ui/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('new_ui/app-assets/js/scripts/forms/form-select2.js') }}?v={{ time() }}"></script>
<script src="{{ asset('new_ui/assets/js/frontend/customer-login.js') }}?v={{ time() }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const inputs = document.querySelectorAll('#otp input');
    
    // Function to initialize OTP inputs
    function initializeOTPInputs() {
        inputs.forEach((input, index) => {
            // Remove existing event listeners to prevent duplicate bindings
            input.removeEventListener('input', handleInput);
            input.removeEventListener('keydown', handleKeydown);
            input.removeEventListener('paste', handlePaste);
            
            // Add event listeners
            input.addEventListener('input', handleInput);
            input.addEventListener('keydown', handleKeydown);
            input.addEventListener('paste', handlePaste);
            
            // Only remove attributes from OTP inputs, not all inputs
            if (input.closest('#otp')) {
                input.removeAttribute('inputmode');
                input.removeAttribute('pattern');
                input.removeAttribute('tabindex'); // Remove tabindex to prevent conflicts
            }
            
            function handleInput(e) {
                // Only allow single digit
                this.value = this.value.replace(/[^0-9]/g, '').substring(0,1);
                
                // Move to next input if current has value
                if (this.value.length === 1 && index < inputs.length - 1) {
                    // Use setTimeout to ensure proper focus
                    setTimeout(() => {
                        inputs[index + 1].focus();
                        inputs[index + 1].select();
                    }, 10);
                }
                
                // Update hidden field
                updateFullOTP();
            }
            
            function handleKeydown(e) {
                // Allow navigation keys
                if (['Backspace', 'Delete', 'Tab', 'Escape', 'Enter', 'ArrowLeft', 'ArrowRight'].includes(e.key)) {
                    if (e.key === 'Backspace') {
                        if (this.value === '' && index > 0) {
                            setTimeout(() => {
                                inputs[index - 1].focus();
                                inputs[index - 1].select();
                            }, 10);
                        } else {
                            this.value = '';
                            updateFullOTP();
                        }
                    }
                    return;
                }
                
                // Only allow numeric input
                if (!/[0-9]/.test(e.key)) {
                    e.preventDefault();
                }
            }
            
            function handlePaste(e) {
                e.preventDefault();
                const pastedData = e.clipboardData.getData('text/plain');
                const numbers = pastedData.replace(/[^0-9]/g, '').substring(0, 6);
                
                for (let i = 0; i < Math.min(numbers.length, inputs.length); i++) {
                    if (inputs[i]) {
                        inputs[i].value = numbers[i];
                    }
                }
                
                // Focus on the next empty input or last input
                const nextEmptyIndex = Math.min(numbers.length, inputs.length - 1);
                setTimeout(() => {
                    inputs[nextEmptyIndex].focus();
                }, 10);
                
                updateFullOTP();
            }
        });
    }
    
    // Function to update hidden OTP field
    function updateFullOTP() {
        document.getElementById('full-otp').value = Array.from(inputs).map(i => i.value).join('');
    }
    
    // Function to clear OTP inputs
    function clearOTPInputs() {
        inputs.forEach(input => {
            input.value = '';
        });
        document.getElementById('full-otp').value = '';
        if (inputs[0]) {
            setTimeout(() => {
                inputs[0].focus();
            }, 100);
        }
    }
    
    // Initialize Select2 on page load
    function initializeSelect2() {
        if ($('.select2').length) {
            $('.select2').select2({
                placeholder: function() {
                    return $(this).data('placeholder');
                },
                allowClear: true,
                width: '100%',
                dropdownParent: $('.select-wrapper').length ? $('.select-wrapper') : $('body'),
                dropdownAutoWidth: false,
                containerCssClass: 'select2-container-custom',
                dropdownCssClass: 'select2-dropdown-custom'
            });
        }
    }
    
    // Initialize both OTP and Select2
    initializeOTPInputs();
    
    // Wait for jQuery to be available then initialize Select2
    if (typeof $ !== 'undefined') {
        initializeSelect2();
    } else {
        // If jQuery isn't loaded yet, wait for it
        const checkJQuery = setInterval(() => {
            if (typeof $ !== 'undefined') {
                clearInterval(checkJQuery);
                initializeSelect2();
            }
        }, 100);
    }
    
    // Toggle between login and register forms
    const toggleBtns = document.querySelectorAll('.toggle-auth-btns .btn');
    const loginForm = document.getElementById('custLoginForm');
    const registerForm = document.getElementById('custRegisterForm');
    const otpForm = document.getElementById('newRegistrationOTPForm');
    
    toggleBtns.forEach((btn, index) => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            toggleBtns.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');

            // Hide all custom error/success messages
            document.querySelectorAll('.custom-email-error, .custom-mobile-error, .custom-username-error').forEach(label => {
                label.style.display = 'none';
                label.classList.remove('text-success', 'text-danger');
                const span = label.querySelector('span');
                if (span) span.textContent = '';
            });
            
            if (index === 0) { // Login
                loginForm.style.display = 'block';
                registerForm.style.display = 'none';
                otpForm.style.display = 'none';
            } else { // Register
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
                otpForm.style.display = 'none';
                
                // Reinitialize Select2 when register form is shown
                setTimeout(() => {
                    initializeSelect2();
                }, 100);
            }
        });
    });
    
    // When showing OTP form, reinitialize OTP inputs
    function showOTPForm() {
        loginForm.style.display = 'none';
        registerForm.style.display = 'none';
        otpForm.style.display = 'block';
        
        // Clear and reinitialize OTP inputs
        setTimeout(() => {
            clearOTPInputs();
            initializeOTPInputs();
        }, 100);
    }
    
    // Export function to global scope
    window.showOTPForm = showOTPForm;
    
    // Handle Select2 events to prevent interference with OTP
    $(document).on('select2:open select2:close', function() {
        // Reinitialize OTP inputs after Select2 operations
        setTimeout(() => {
            if (otpForm.style.display !== 'none') {
                initializeOTPInputs();
            }
        }, 50);
    });
});

// Additional CSS to ensure proper input behavior
const otpInputStyles = `
<style>
#otp input {
    -webkit-appearance: none;
    -moz-appearance: textfield;
    appearance: none;
    text-align: center !important;
    font-size: 18px !important;
    font-weight: bold;
    caret-color: transparent;
}

#otp input:focus {
    outline: 2px solid #C6B682 !important;
    border-color: #C6B682 !important;
    caret-color: #C6B682;
}

#otp input::-webkit-outer-spin-button,
#otp input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Ensure Select2 styling remains intact and prevent horizontal scroll */
.select2-container--default .select2-selection--single {
    border: 0.5px solid #C6B682 !important;
    border-radius: 0;
    height: auto !important;
    max-width: 100% !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    right: 40px;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    padding-left: 12px;
    padding-right: 30px;
}

/* Fix dropdown width and positioning */
.select2-container-custom {
    width: 100% !important;
    max-width: 100% !important;
}

.select2-dropdown-custom {
    max-width: 100% !important;
    width: auto !important;
    min-width: 100% !important;
    box-sizing: border-box !important;
}

.select2-container--default .select2-results__options {
    max-height: 200px !important;
}

/* Prevent overflow on the select wrapper */
.select-wrapper {
    position: relative;
    overflow: visible;
    width: 100%;
}

.input-svg {
    width: 100%;
    max-width: 100%;
    overflow: visible;
}
</style>`;

// Inject the styles
if (!document.getElementById('otp-select2-styles')) {
    const styleElement = document.createElement('div');
    styleElement.id = 'otp-select2-styles';
    styleElement.innerHTML = otpInputStyles;
    document.head.appendChild(styleElement);
}
function togglePassword(formOf) {
    if(formOf == "login"){
        const x = document.getElementById("login-password");
        const showPassword = document.getElementById("show-password");
        const hidePassword = document.getElementById("hide-password");
        if (x.type === "password") {
            x.type = "text";
            showPassword.style.display="none";
            hidePassword.style.display="block";
        } else {
            x.type = "password";
            showPassword.style.display="block";
            hidePassword.style.display="none";
        }
    }
    if(formOf == "register"){
        const x = document.getElementById("password");
        const showPassword = document.getElementById("show-password-register");
        const hidePassword = document.getElementById("hide-password-register");
        if (x.type === "password") {
            x.type = "text";
            showPassword.style.display="none";
            hidePassword.style.display="block";
        } else {
            x.type = "password";
            showPassword.style.display="block";
            hidePassword.style.display="none";
        }
    }
    if(formOf == "confirm"){
        const x = document.getElementById("confirm-password");
        const showPassword = document.getElementById("show-password-confirm");
        const hidePassword = document.getElementById("hide-password-confirm");
        if (x.type === "password") {
            x.type = "text";
            showPassword.style.display="none";
            hidePassword.style.display="block";
        } else {
            x.type = "password";
            showPassword.style.display="block";
            hidePassword.style.display="none";
        }
    }
  
}

</script>

@endsection
