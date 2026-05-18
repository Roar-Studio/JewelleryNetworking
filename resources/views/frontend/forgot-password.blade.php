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
        font-size: 18px;
        font-weight: bold;

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
                <img src="{{ asset('new_ui/assets/images/login-left-portrait.webp') }}"/>
                <div class="card mb-0">
                    <div class="card-body">
                        <img class="brand-logo" src="{{ asset('new_ui/assets/images/jn-logo.webp') }}">
                        
                        <form class="auth-login-form mt-5" id="custForgotPasswordForm" autocomplete="off">
                            <h3 class="text-center form-heading">Forgot Password</h3>
                            <p class="text-center">Enter your email to receive OTP</p>
                            <div class="mb-2">
                                <label for="login-email" class="form-label required">Email Address</label>
                                <div class="input-svg position-relative">
                                    <input type="text" class="form-control" id="login-email" name="email" placeholder="Enter your email" aria-describedby="login-email" tabindex="1" autofocus maxlength="50" autocomplete="off"/>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                        <path d="M19.7285 4.03601H3.72852C2.62852 4.03601 1.73852 4.93601 1.73852 6.03601L1.72852 18.036C1.72852 19.136 2.62852 20.036 3.72852 20.036H19.7285C20.8285 20.036 21.7285 19.136 21.7285 18.036V6.03601C21.7285 4.93601 20.8285 4.03601 19.7285 4.03601ZM19.7285 8.03601L11.7285 13.036L3.72852 8.03601V6.03601L11.7285 11.036L19.7285 6.03601V8.03601Z" fill="#999999"/>
                                    </svg>
                                </div>
                            </div>
                            <button type="submit" class="btn w-100" tabindex="2">Send OTP</button>
                            
                        </form>

                        <form id="forgotOTPForm" class="row g-3" action="#" method="POST" enctype="multipart/form-data" novalidate="novalidate" onsubmit="return false;" style="display: none;" autocomplete="off">
							<div class="col-12 pt-5 mt-3">
								<input type="hidden" name="customer_id" value="" autocomplete="off">
								<input type="hidden" name="token" value="" autocomplete="off">
                                <h3 class="text-center form-heading">Verify your Identity</h3>
                                <p class="text-center">Please enter the OTP we sent to you at registered email <span class="registered_email_id"></span></p>
								<div class="form-group mb-1">
									<label class="mb-1">Enter OTP</label>
									<div id="otp" class="input-group flex form-otp text-center">
										<input class="text-center form-control" type="text" id="digit-1" name="digit-1" tabindex="3" data-next="digit-2" maxlength="1" autocomplete="off"/>
										<input class="text-center form-control" type="text" id="digit-2" name="digit-2" tabindex="4" data-next="digit-3" data-previous="digit-1" maxlength="1" autocomplete="off"/>
										<input class="text-center form-control" type="text" id="digit-3" name="digit-3" tabindex="5" data-next="digit-4" data-previous="digit-2" maxlength="1" autocomplete="off"/>
										<input class="text-center form-control" type="text" id="digit-4" name="digit-4" tabindex="6" data-next="digit-5" data-previous="digit-3" maxlength="1" autocomplete="off"/>
										<input class="text-center form-control" type="text" id="digit-5" name="digit-5" tabindex="7" data-next="digit-6" data-previous="digit-4" maxlength="1" autocomplete="off"/>
										<input class="text-center form-control" type="text" id="digit-6" name="digit-6" tabindex="8" data-previous="digit-5" maxlength="1" autocomplete="off"/>
									</div>
									<input type="hidden" name="otp" id="full-otp" autocomplete="off">
								</div>
								<p>
									<span id="timer"></span>
									<button id="resendOTPBtn" tabindex="9" disabled>Resend OTP</button>
								</p>
								<span class="invalid-new-login-otp text-danger">
									<strong></strong>
								</span>
							</div>
							
							<div class="col-12 mt-2">
								<button class="btn w-100 validateOTP" tabindex="10">Verify OTP</button>
							</div>
						</form>

                        <form class="auth-login-form mt-2" id="resetPasswordForm" style="display: none" autocomplete="off">
                            <h3 class="text-center form-heading">Set Password</h3>
                            <p class="text-center">Please enter your new password</p>
                            <input type="hidden" name="customer_id" value="" autocomplete="off">
                            <input type="hidden" name="token" value="" autocomplete="off">
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
                            
                            <button type="submit" class="btn w-100" tabindex="13">Confirm</button>
                        </form>
                        <a href="/"><p class="text-center my-2"><i class="bi bi-chevron-left"></i> Go to Homepage</p></a>

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
<!-- END: Content-->
@endsection

@section('script')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<script src="{{ asset('new_ui/assets/js/frontend/forgot-password.js') }}?v={{ time() }}"></script>

@endsection
