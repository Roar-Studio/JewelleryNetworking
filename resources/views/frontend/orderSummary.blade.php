@extends('frontend.layouts.master')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.min.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('new_ui/assets/css/order.css') }}?v={{ time() }}">
<style>
    .social-icon-header a svg path{
        fill: #fff;
    }
    .order-summary *{
        font-family: "Lato", sans-serif;
    }
    .empty-checkout-summary{
        margin: 6rem;
        text-align: center;
        color: #f00;
    }
    .coupon-card{
        padding: 15px 29px;
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        filter: drop-shadow(0 0 1px #664d00);
        border-radius: 12px;
        overflow:hidden;
    }
    .coupon-card::before, .coupon-card::after {
        content: "";
        position: absolute;
        top: 0;
        width: 51%;
        height: 100%;
        z-index: -1;
    }
    .coupon-card::before {
        left: 0;
        background-image: radial-gradient(circle at 0 50%, transparent 15px, #f9f9f9 16px);
    }
    .coupon-card::after {
        right: 0;
        background-image: radial-gradient(circle at 100% 50%, transparent 15px, #f9f9f9 16px);
    }
    .coupon-list .coupon-card:last-child{
        margin-bottom: unset;
    }
    .coupon-card .brand-text img{
        width: 50px;
    }
    .coupon-card .brand-text h4{
        font-size:11px;
    }
    .coupon-card .card-right{
        display: flex;
        justify-content: space-between;
        flex: 1;
        align-items: center;
        border-left: 1.5px dashed #c6b682;
        margin-left: 15px;
        padding-left: 15px;
    }
    .coupon-card .card-right .desc h1{
        font-family: 'Lato';
        font-weight: 900;
        font-size: 30px;
        color: #c6b682;
        margin-bottom: 5px;
    }
    .coupon-card .card-right .desc p{
        font-family: 'Lato';
        font-weight: 900;
        font-size: 20px;
        color: #c6b682;
        margin-bottom: 5px;
    }
    .coupon-card .card-right .desc p span{
        color: #254b5a;
        font-family: 'Lato';
        font-size: 30px;
    }
    .coupon-card .card-right .desc .validity{
        color: #c6b68a;
        font-variant-numeric: lining-nums;
        font-family: 'Lato';
        font-weight: 600;
        font-size: 10px;
        letter-spacing: 0.5px;
        margin-bottom: 0;
    }
    .coupon-card .action-btns{
        text-align: center;
    }
    .coupon-card .action-btns div{
        background: #F0EFEF;
        color: #254b5a;
        padding: 5px 15px;
        font-family: 'Lato';
        font-weight: 900;
    }
    .coupon-card .action-btns button{
        background: unset;
        border: unset;
        font-family: 'Lato';
        color: #c6b682;
        font-weight: 600;
        font-size: 17px;
    }
    .iti__flag-container{
        height: 38px;
    }
    
    @media screen and (max-width: 480px) {
        .coupon-card{
            padding: 10px 20px;
        }
        .coupon-card .card-right{
            margin-left: 7px;
            padding-left: 7px;
            flex-direction: column;
        }
        .coupon-card .brand-text img{
            width: 40px;
        }
        .coupon-card .brand-text h4{
            font-size: 9px;
        }
        .coupon-card .card-right .desc h1{
            font-size: 18px;
        }
        .coupon-card .card-right .desc p{
            font-size: 15px;
        }
        .coupon-card .card-right .desc p span{
            font-size: 20px;
        }
        .coupon-card .card-right .desc .validity{
            font-size: 9px;
            line-height: 10px;
        }
        .coupon-card .action-btns div{
            padding: 5px;
            font-size: 13px;
        }
        .coupon-card .action-btns button{
            font-size: 14px;
        }
        .offers-content{
            padding: 5px;
        }
        .offers-title{
            font-size: 22px;
        }
        .offers-icon{
            width: 25px;
            height: 25px;
        }
        .coupon-button{
            min-height: 38px;
            width: 190px;
        }
        .coupon-card::before{
            background-image: radial-gradient(circle at 0 50%, transparent 10px, #f9f9f9 10px)
        }
        .coupon-card::after{
            background-image: radial-gradient(circle at 100% 50%, transparent 10px, #f9f9f9 10px)
        }
    }
    @media (max-width: 768px) {
        #couponModal .modal-dialog {
            margin-top: auto;
            margin-bottom: auto;
            display: flex;
            align-items: center;
            min-height: calc(100% - 1rem);
        }
    }
    #couponModal .btn-close {
        pointer-events: auto !important;
        z-index: 9999 !important;
    }
    .coupon-card, .action-btns, .apply-coupon-btn {
        cursor: pointer;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
    }
    #couponModal .apply-coupon-btn,
    #couponModal .bi-copy {
        pointer-events: auto !important;
        z-index: 9999 !important;
    }  
    
    .coupon-list {
        position: relative;
        z-index: 1;
    }

    .coupon-card {
        position: relative;
        z-index: 2;
        pointer-events: auto;
    }

    .coupon-card .action-btns {
        position: relative;
        z-index: 10;
        pointer-events: auto;
    }

    .apply-coupon-btn {
        position: relative;
        z-index: 11;
        pointer-events: auto !important;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        cursor: pointer;
        background: transparent;
        border: none;
    }

    /* iOS specific fix */
    @supports (-webkit-touch-callout: none) {
        .apply-coupon-btn {
            transform: translateZ(0);
            -webkit-transform: translateZ(0);
        }
    }
    
</style>
@endsection

@section('content')
<!-- BEGIN: Content-->
<div id="carouselExampleCaptions" class="carousel slide position-relative" data-bs-ride="carousel" data-bs-interval="false">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('new_ui/assets/images/order_summary_header.png') }}" class="d-block w-100 desktop_view" alt="carousel image">
            <img src="{{ asset('new_ui/assets/images/order_summary_mobile_banner.webp') }}" class="d-block w-100 mobile_view" alt="carousel image">
        </div>
    </div>
    <div class="social-icon-header">
        <a target="_blank" href="https://www.instagram.com/jewellerynetworking/?igsh=ZW41NGx4cm91czA3#">
            <svg width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path id="Vector" d="M15.0335 7.50781C19.2522 7.50781 22.7344 11.106 22.7344 15.4654C22.7344 19.894 19.2522 23.423 15.0335 23.423C10.7478 23.423 7.33259 19.894 7.33259 15.4654C7.33259 11.106 10.7478 7.50781 15.0335 7.50781ZM15.0335 20.6551C17.779 20.6551 19.9888 18.3717 19.9888 15.4654C19.9888 12.6283 17.779 10.3449 15.0335 10.3449C12.221 10.3449 10.0112 12.6283 10.0112 15.4654C10.0112 18.3717 12.2879 20.6551 15.0335 20.6551ZM24.8103 7.23103C24.8103 8.26897 24.0067 9.09933 23.0022 9.09933C21.9978 9.09933 21.1942 8.26897 21.1942 7.23103C21.1942 6.19308 21.9978 5.36272 23.0022 5.36272C24.0067 5.36272 24.8103 6.19308 24.8103 7.23103ZM29.8996 9.09933C30.0335 11.6596 30.0335 19.3404 29.8996 21.9007C29.7656 24.3917 29.2299 26.5368 27.4888 28.4051C25.7478 30.2042 23.6049 30.7578 21.1942 30.8962C18.7165 31.0346 11.2835 31.0346 8.8058 30.8962C6.39509 30.7578 4.3192 30.2042 2.51116 28.4051C0.770089 26.5368 0.234375 24.3917 0.100446 21.9007C-0.0334821 19.3404 -0.0334821 11.6596 0.100446 9.09933C0.234375 6.60826 0.770089 4.39397 2.51116 2.59487C4.3192 0.795759 6.39509 0.242188 8.8058 0.103795C11.2835 -0.0345982 18.7165 -0.0345982 21.1942 0.103795C23.6049 0.242188 25.7478 0.795759 27.4888 2.59487C29.2299 4.39397 29.7656 6.60826 29.8996 9.09933ZM26.6853 24.5993C27.4888 22.5926 27.2879 17.7489 27.2879 15.4654C27.2879 13.2511 27.4888 8.40737 26.6853 6.33147C26.1496 5.01674 25.1451 3.9096 23.8728 3.42522C21.8638 2.59487 17.1763 2.80246 15.0335 2.80246C12.8237 2.80246 8.13616 2.59487 6.1942 3.42522C4.85491 3.97879 3.85045 5.01674 3.31473 6.33147C2.51116 8.40737 2.71205 13.2511 2.71205 15.4654C2.71205 17.7489 2.51116 22.5926 3.31473 24.5993C3.85045 25.9833 4.85491 27.0212 6.1942 27.5748C8.13616 28.4051 12.8237 28.1975 15.0335 28.1975C17.1763 28.1975 21.8638 28.4051 23.8728 27.5748C25.1451 27.0212 26.2165 25.9833 26.6853 24.5993Z" fill="#264C5A"/>
            </svg>
        </a>
        <a target="_blank" href="https://www.facebook.com/people/Jewellery-Networking/61554254949019/">
            <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path id="Vector" d="M31 15.5943C31 23.3915 25.3125 29.8682 17.875 31V20.1217H21.5L22.1875 15.5943H17.875V12.7018C17.875 11.4442 18.5 10.2495 20.4375 10.2495H22.375V6.41379C22.375 6.41379 20.625 6.0994 18.875 6.0994C15.375 6.0994 13.0625 8.30019 13.0625 12.1988V15.5943H9.125V20.1217H13.0625V31C5.625 29.8682 0 23.3915 0 15.5943C0 6.97972 6.9375 0 15.5 0C24.0625 0 31 6.97972 31 15.5943Z" fill="#264C5A"/>
            </svg>
        </a>
        <a target="_blank" href="https://www.linkedin.com/company/jewellerynetworking/">
            <svg width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path id="Vector" d="M6.69643 31H0.46875V10.264H6.69643V31ZM3.54911 7.48993C1.60714 7.48993 0 5.75615 0 3.67562C0 1.66443 1.60714 0 3.54911 0C5.55804 0 7.16518 1.66443 7.16518 3.67562C7.16518 5.75615 5.55804 7.48993 3.54911 7.48993ZM23.7723 31V20.9441C23.7723 18.5168 23.7054 15.4653 20.4911 15.4653C17.2768 15.4653 16.808 18.0313 16.808 20.736V31H10.5804V10.264H16.5402V13.1074H16.6071C17.4777 11.5123 19.4866 9.77852 22.5 9.77852C28.7946 9.77852 30 14.0783 30 19.6264V31H23.7723Z" fill="#264C5A"/>
            </svg>
        </a>
        <a target="_blank" href="https://www.youtube.com/@JewelleryNetworking">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 50 50">
                <path d="M 44.898438 14.5 C 44.5 12.300781 42.601563 10.699219 40.398438 10.199219 C 37.101563 9.5 31 9 24.398438 9 C 17.800781 9 11.601563 9.5 8.300781 10.199219 C 6.101563 10.699219 4.199219 12.199219 3.800781 14.5 C 3.398438 17 3 20.5 3 25 C 3 29.5 3.398438 33 3.898438 35.5 C 4.300781 37.699219 6.199219 39.300781 8.398438 39.800781 C 11.898438 40.5 17.898438 41 24.5 41 C 31.101563 41 37.101563 40.5 40.601563 39.800781 C 42.800781 39.300781 44.699219 37.800781 45.101563 35.5 C 45.5 33 46 29.398438 46.101563 25 C 45.898438 20.5 45.398438 17 44.898438 14.5 Z M 19 32 L 19 18 L 31.199219 25 Z" fill="#264C5A"></path>
            </svg>
        </a>
    </div>
</div>
<div class="container">
    <h1 class="main-page-title">Order Summary</h1>
</div>

<div class="special-design container mt-2">
    <hr/>
    <img src="{{ asset('new_ui/assets/images/diamond.webp') }}">
    <div class="vertical-line"></div>
</div>

<section class="container">
    <h2 class="main-section-title">Order Summary</h2>
</section>
<div class="container checkout-container">
    <form id="checkoutForm">
        <section class="order-summary enrollment" style="display: none;">
            <header class="order-header">
                <h1 class="order-title">Enter Enrollment</h1>
            </header>
            <article class="order-content contact-us membership-form row mt-1 mx-0">
                <div class="col-md-12">
                    <label class="enrollment-label">User Details</label>
                </div>
                <div class="col-md-5 mt-1 mb-2 enrollment-box">
                    <label class="enrollment-label mb-1">Already a Jewellery Networking Member?</label>
                    <div class="d-flex justify-content-between">
                    <input type="text" class="form-control membership-number-input" name="membership_number" placeholder="Enter membership number">
                    <button class="btn btn-secondary membership-verify">Verify</button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label required">First Name</label>
                            <input type="text" class="form-control" name="first_name" placeholder="Enter first name"/>
                            <input type="hidden" name="product_id"/> 
                            <input type="hidden" name="product_type"/> 
                            <input type="hidden" name="cart_data"/>
                            <input type="hidden" name="coupon_id"/>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label required">Last Name</label>
                            <input type="text" class="form-control" name="last_name" placeholder="Enter last name"/>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label required">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter your email"/>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label required">Mobile Number</label>
                            <input type="tel" id="mobile-input" class="form-control mobile" name="mobile_no" placeholder="Enter mobile number"/>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label">Company Name</label>
                            <input type="text" id="company-name-input" class="form-control" name="company_name" placeholder="Enter company name"/>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label">Company Address</label>
                            <input type="text" id="company-address-input" class="form-control" name="company_address" placeholder="Enter company address"/>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label">Tax Id</label>
                            <input type="tel" id="tax-id-input" class="form-control" name="tax_id" placeholder="Enter tax id"/>
                        </div>
                    </div>
                </div>
                
            </article>
        </section>
        <section class="order-summary">
            <header class="order-header">
                <h1 class="order-title">Your order</h1>
            </header>
            <article class="order-content">
                <div class="checkout-summary">
                    <!-- Spinner -->
                    <div class="spinner text-center my-3 m-auto d-block">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="payment-method row">
                    <div class="payment-option col-md-12">
                        <input type="radio" id="razorpay-radio-btn" class="form-check-input" name="payment_method" value="razorpay" disabled/>
                        <label class="payment-label" for="razorpay-radio-btn">Razorpay</label> <!-- Credit Card/Debit Card/NetBanking -->
                        <img src="https://cdn.builder.io/api/v1/image/assets/740faa840ad94e37b84bd074aed36f9e/a947abf1b9b2f3ef7bfd9aa1b067def46be44551?placeholderIfAbsent=true" alt="Payment options" class="payment-icons">
                    </div>
                </div>
                <div class="payment-description row">
                    <p class="payment-info col-12">Pay securely by Credit or Debit card or Internet Banking through Razorpay.</p>
                </div>
                <div class="paypal-option row">
                    <div class="payment-option col-12">
                        <input type="radio" id="paypal-radio-btn" class="form-check-input" name="payment_method" value="paypal" disabled/>
                        <label class="payment-label" for="paypal-radio-btn">PayPal</label>
                        <img src="https://cdn.builder.io/api/v1/image/assets/740faa840ad94e37b84bd074aed36f9e/2e98f8c429057d87e8c5b0da71bfcaf8f6a68efa?placeholderIfAbsent=true" alt="PayPal" class="paypal-icon">
                    </div>
                </div>
                <hr class="divider">
                <div class="privacy-section row">
                    <p class="privacy-text col-12">
                        Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our
                        <a href="/term-and-conditions" target="_blank" class="privacy-link">privacy policy</a>.
                    </p>
                </div>
                <div class="order-button-container row">
                    <div class="col-12 col-md-4">
                    <button type="submit" class="btn btn-secondary custom-btn w-100" disabled>
                        Place Order
                        <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
                        </svg>
                    </button>
                    </div>
                </div>
            </article>
        </section>
    </form>
</div>

<!-- <div id="checkoutSection"></div> -->

<!-- Modal -->

<div class="modal fade" id="couponModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog custom-modal-width" role="document">
    <div class="modal-content">
      <div class="">
        <section class="container">
          <div class="row">
            <div class="col-12 shadow p-1">
              <div class="offers-content bg-white">
                <header class="d-flex justify-content-between align-items-center mb-2">
                  <h1 class="offers-title mb-0">Offers & Discounts</h1>
                  <div class="offers-icon d-flex align-items-center justify-content-center">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                </header>

                <div class="coupon-form d-flex justify-content-between mt-2 mb-2">
                  <input type="text" placeholder="Add Coupon Code" class="coupon-input form-control border-0 bg-transparent">
                  <button type="button" class="coupon-button border-0 text-center">Apply Coupon</button>
                </div>
                <div class="coupon-list">
                    <!-- <div class="coupon-card">
                        <div class="brand-text">
                            <img src="{{ asset('new_ui/assets/images/jn-logo.webp') }}">
                            <h4 class="mt-25">Jewellery<br>Networking</h4>
                        </div>
                        <div class="card-right">
                            <div class="desc">
                                <h1>AI Workshop</h1>
                                <p>Flat <span>20% OFF</span></p>
                                <p class="validity">Valid till April 30, 2025</p>
                            </div>
                            <div class="action-btns">
                                <div>JNAIWS20
                                    <a><i class="bi bi-copy ms-50"></i></a>
                                </div>
                                <button>Apply</button>
                            </div>
                        </div>
                    </div> -->
                </div>                  
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>


<!-- END: Content-->
@endsection

@section('script')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<!-- <script src="{{ asset('new_ui/assets/js/admin/customer/index.js') }}?v={{ time() }}"></script> -->
<script src="{{ asset('new_ui/assets/js/admin/custom-image-uploader.js') }}?v={{ time() }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    const user = localStorage.getItem('userData');
    let tokenType = localStorage.getItem('tokenType') || null;

    let decodedUser = null;

    if(user && tokenType == 'customer'){
        decodedUser = decodeBase64Unicode(user);
    }

    const RAZORPAY_KEY = "{{ env('RAZORPAY_KEY') }}";

    function openRazorpay(order_id, amount, txn_id, txn_order_id) {

        var options = {
            key: RAZORPAY_KEY,
            amount: amount * 100,
            currency: "INR",
            name: "Jewellery Networking",
            description: "Payment",
            order_id: order_id,
            handler: function (response) {
                window.axiosApiClient.post('/razorpay/callback', {
                    txn_id,
                    razorpay_payment_id: response.razorpay_payment_id,
                    razorpay_order_id: order_id,
                    razorpay_signature: response.razorpay_signature
                },{
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken()
                    }
                }).then(r => window.location.href = r.data.redirect);
            },
            prefill: {
                name: `${decodedUser ? decodedUser.first_name + ' ' + decodedUser.last_name : 'Test'}`,
                email: `${decodedUser ? decodedUser.email : 'Test'}`,
                contact: `${decodedUser ? decodedUser.mobile_no : ''}`,
                tax_id: `${decodedUser ? decodedUser.tax_id : ''}`,
                company_name: `${decodedUser ? decodedUser.company_name : ''}`,
                company_address: `${decodedUser ? decodedUser.company_address : ''}`
            },
            modal: {
                escape: false,
                ondismiss: function() {
                    // Redirect to cancellation URL if user closes the payment modal
                    window.location.href = `/razorpay/checkout/cancel/${txn_order_id}`;
                }
            }

        };
        var rzp = new Razorpay(options);
        rzp.open();
    }

    const input = document.querySelector("#mobile-input");
    window.intlTelInput(input, {
      initialCountry: "in",
      separateDialCode: true,
      preferredCountries: ["in", "us", "gb"],
      utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js",
    });

    document.addEventListener("DOMContentLoaded", () => {

        if(decodedUser){
            //$('.enrollment-box').remove();
            var mobileInput = $('#checkoutForm').find('input[name="mobile_no"]')[0];
            var iti = window.intlTelInputGlobals.getInstance(mobileInput);
            if (iti) {
                iti.setCountry(decodedUser.mobile_no_ic || 'IN');
            }
            $('#checkoutForm [name="first_name"]').val(decodedUser.first_name || '').attr('disabled', true);
            $('#checkoutForm [name="last_name"]').val(decodedUser.last_name || '').attr('disabled', true);
            $('#checkoutForm [name="email"]').val(decodedUser.email || '').attr('disabled', true);
            $('#checkoutForm [name="mobile_no"]').val(decodedUser.mobile_no || '').attr('disabled', true);
            $('#checkoutForm [name="tax_id"]').val(decodedUser.tax_id || '').attr('disabled', true);
            $('#checkoutForm [name="company_name"]').val(decodedUser.company_name || '').attr('disabled', true);
            $('#checkoutForm [name="company_address"]').val(decodedUser.company_address || '').attr('disabled', true);
            //$('.order-summary.enrollment').hide();
        }
        else{
            $('.order-summary.enrollment').show();
        }

        const getQueryParam = (key) => new URLSearchParams(window.location.search).get(key);

        const getSelectedCurrency = () => {
            const defaultCurrency = { selectedCurrencyCode: 'INR', selectedCurrencySymbol: '&#8377;' };

            const selectedCurrency = localStorage.getItem('selectedCurrency');
            if (!selectedCurrency) return defaultCurrency;

            try {
                const parsed = JSON.parse(selectedCurrency);

                // Ensure parsed object has valid code and symbol
                if (!parsed.selectedCurrencyCode || !parsed.selectedCurrencySymbol) {
                    return defaultCurrency;
                }

                return parsed;
            } catch (e) {
                console.error("Invalid currency data in localStorage:", e);
                return defaultCurrency;
            }
        };
        // const getSelectedCurrency = () => {
        //     const selectedCurrency = localStorage.getItem('selectedCurrency');
        //     try {
        //         return selectedCurrency ? JSON.parse(selectedCurrency) : { selectedCurrencyCode: 'INR', selectedCurrencySymbol: '&#8377;' };
        //     } catch (e) {
        //         console.error("Invalid currency data in localStorage");
        //         return { selectedCurrencyCode: 'INR', selectedCurrencySymbol: '&#8377;' };
        //     }
        // };

        const productType = getQueryParam('product_type');
        const eventId = getQueryParam('event_id');
        const membershipId = getQueryParam('membership_id');
        let couponId = null;

        if (!productType || (productType === 'event' && !eventId) || (productType === 'membership' && (!membershipId || membershipId == 1))) {
            $(".checkout-summary").html('<h2 class="empty-checkout-summary">Data not found</h2>');
            return;
        }
        else if(productType == 'membership' && (!decodedUser || tokenType != 'customer')){
            toastr.error('You have to Login First for Upgrade/Renew Membership');
            $(".checkout-summary").html('<h2 class="empty-checkout-summary">Data not found</h2>');
            return;
        }

        const productId = productType === 'event' ? eventId : membershipId;
        const { selectedCurrencyCode, selectedCurrencySymbol } = getSelectedCurrency();
        const displaySymbol = selectedCurrencySymbol || '&#8377;';

        const getCheckoutData = (productType, productId, selectedCurrencyCode, couponId = null) => {
            let payload = {
                product_type: productType,
                product_id: productId,
                selectedCurrencyCode,
                couponId
            };

            window.axiosApiClient.post(`/get-checkout-data`, payload,{
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken()
                    }
                }).then(res => {
                const data = res.data.data;

                $('#checkoutForm').find('[name="product_id"]').val(productId);
                $('#checkoutForm').find('[name="product_type"]').val(productType);
                $('#checkoutForm').find('[name="coupon_id"]').val(couponId);
                $('#checkoutForm').find('[name="cart_data"]').val(data);

                const companySection = data.userid ? `
                    <div class="row newdetail">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">Company Name</label>
                            <input type="text" id="company-name-input" class="form-control company_name" placeholder="Enter company name" value="${data.company_name}"/>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label">Company Address</label>
                            <input type="text" id="company-address-input" class="form-control company_address" placeholder="Enter company address" value="${data.company_address}"/>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label">Tax Id</label>
                            <input type="tel" id="tax-id-input" class="form-control tax_id" placeholder="Enter tax id" value="${data.trn_no}"/>
                        </div>
                        <hr class="divider">
                    </div>
                ` : ''; // empty string if data.userid exists

                const checkoutHtml = `
                    <div class="product-row row">
                        <div class="product-info col-md-8">
                            <div class="product-image">
                                <img src="${data.product_image}" class="d-block w-100" alt="logo">
                            </div>
                            <h2 class="product-name">${ data.product_name ? data.product_name.charAt(0).toUpperCase() + data.product_name.slice(1) : '' }</h2>
                        </div>
                        <p class="product-price col-md-4 text-md-end">
                            <span class="price-value">${displaySymbol}${data.product_price}</span>
                        </p>
                    </div>
                    <div class="price-row row">
                        <div class="col-6"><p class="price-label">Sub-total</p></div>
                        <div class="col-6 text-end"><label class="price-value-medium">${displaySymbol}${data.subtotal}</label></div>
                    </div>
                    <hr class="divider">
                    <div class="price-row row">
                        <div class="col-6"><p class="price-label">GST</p></div>
                        <div class="col-6 text-end"><label class="price-value-medium">${displaySymbol}${data.gst}</label></div>
                    </div>
                    <hr class="divider">
                    <div class="price-row row">
                        <div class="col-6">
                            <p class="price-label">
                                <label>Coupon Discount</label>
                                <a href="#" class="view-offers-link" data-bs-toggle="modal" data-bs-target="#couponModal">${data.coupon == 0 ? `View Offers` : 'Change Coupon'}</a>
                            </p>
                        </div>
                        <div class="col-6 text-end"><p class="price-label">${data.coupon != 0 ? `<a href="javascript:;" class="text-danger small remove-coupon">Remove</a>`: ''}<label class="price-value-medium">${displaySymbol}${data.coupon}</label></p></div>
                    </div>
                    <hr class="divider">
                    ${companySection}
                    <div class="total-container">
                        <div class="total-row row">
                            <div class="col-6"><p class="total-label">Total</p></div>
                            <div class="col-6 text-end"><label class="total-value">${displaySymbol}${data.total}</label></div>
                        </div>
                    </div>
                `;
                $('.checkout-summary').html(checkoutHtml);
                $('#checkoutForm').find('button[type="submit"]').removeAttr('disabled');
                if(selectedCurrencyCode == 'INR'){
                    $('#razorpay-radio-btn').removeAttr('disabled');
                    $('#razorpay-radio-btn').prop('checked', true);
                    $('#paypal-radio-btn').attr('disabled', true);

                }
                else{
                    $('#razorpay-radio-btn').attr('disabled', true);
                    $('#paypal-radio-btn').removeAttr('disabled');
                    $('#paypal-radio-btn').prop('checked', true);

                }

            }).catch(err => {
                console.error("Checkout data fetch error:", err);
                $(".checkout-summary").html('<h2 class="empty-checkout-summary text-danger">No Data Found</h2>');
            });
        };

        const getCouponList = (productType, productId, selectedCurrencyCode) => {
            window.axiosApiClient.post(`/get-coupons`, {
                product_type: productType,
                product_id: productId,
                selectedCurrencyCode
            },{
                headers: {
                    'Authorization': 'Bearer ' + getAuthToken()
                }
            }).then(res => {
                const coupons = res.data.data || [];
                const couponsHtml = coupons.map(c => {
                    let discountText = '';

                    if (c.discount_type === 'flat') {
                        const currencySymbol = selectedCurrencyCode === 'INR' ? '&#8377;' : '$';
                        const discountValue = parseFloat(selectedCurrencyCode === 'INR' ? c.discount_flat_inr : c.discount_flat_usd);
                        const minimumPurchase = parseFloat(selectedCurrencyCode === 'INR' ? c.minimum_purchase_inr : c.minimum_purchase_usd);

                        discountText = `Flat <span>${currencySymbol}${discountValue}</span> off on ${currencySymbol}${minimumPurchase}`;
                    } 
                    else if (c.discount_type === 'percent') {
                        const currencySymbol = selectedCurrencyCode === 'INR' ? '&#8377;' : '$';
                        const discountPercent = parseFloat(selectedCurrencyCode === 'INR' ? c.discount_percent_inr : c.discount_percent_usd);
                        const maxDiscount = parseFloat(selectedCurrencyCode === 'INR' ? c.maximum_discount_inr : c.maximum_discount_usd);

                        discountText = `<span>${discountPercent}%</span> off upto ${currencySymbol}${maxDiscount}`;
                    } 
                    else {
                        discountText = `<span>Special Offer</span>`;
                    }


                    const validTill = c.end_date ? moment(c.end_date).format('ddd, MMM DD, YYYY') : '';

                    return `
                        <div class="coupon-card">
                            <div class="brand-text">
                                <img src="new_ui/assets/images/jn-logo.webp" alt="Brand Logo">
                                <h4 class="mt-25">Jewellery<br>Networking</h4>
                            </div>
                            <div class="card-right">
                                <div class="desc">
                                    <h1>${c.coupon_name || ''}</h1>
                                    <p>${discountText}</p>
                                    <p class="validity">Valid till ${validTill}</p>
                                </div>
                                <div class="action-btns">
                                    <div>${c.coupon_code || ''}
                                        <a href="javascript:void(0);" class="copy-btn" data-code="${c.coupon_code}">
                                            <i class="bi bi-copy ms-50"></i>
                                        </a>
                                    </div>
                                    <button class="apply-coupon-btn" data-id="${c.id}" data-coupon_code="${c.coupon_code}">Apply</button>
                                </div>
                            </div>
                        </div>
                    `;
                }).join('');
                $('.coupon-list').html(couponsHtml);
                bindCouponEvents();
            }).catch(err => {
                console.error("Coupon list fetch error:", err);
                $('.coupon-list').html('<p class="text-center text-danger">No coupons available at this time</p>');
            });
        };
        $(document).on('click', '.remove-coupon', function(){
            getCheckoutData(productType, productId, selectedCurrencyCode);
        });
        $('.coupon-button').click(function() {
            const { selectedCurrencyCode, selectedCurrencySymbol } = getSelectedCurrency();

            let couponCode = $('.coupon-input').val(); // Get the input value
            let payload = {
                    product_type: productType,
                    product_id: productId,
                    coupon_code: couponCode,
                    selectedCurrencyCode
                };

            if (couponCode.trim() !== '') {
                window.axiosApiClient.post('/get-coupon-by-id', payload,{
                        headers: {
                            'Authorization': 'Bearer ' + getAuthToken()
                        }
                    })
                    .then(response => {
                        $('#couponModal').modal('hide');
                        getCheckoutData(productType, productId, selectedCurrencyCode, response.data.data.id);
                        toastr.success('Coupon Code Applied');

                    })
                    .catch(error => {
                        console.error('Error applying coupon:', error);
                    });
            } else {
                alert('Please enter a coupon code');
            }
        });
        
        // $(document).on('touchstart click', '.apply-coupon-btn', function(e){
        //     alert();
        //     e.preventDefault();
        //     e.stopPropagation();
            
        //     const couponId = $(this).data('id');
        //     const couponCode = $(this).data('coupon_code');
            
        //     let payload = {
        //         product_type: productType,
        //         product_id: productId,
        //         coupon_code: couponCode,
        //     };

        //     window.axiosApiClient.post('/get-coupon-by-id', payload,{
        //         headers: {
        //             'Authorization': 'Bearer ' + getAuthToken()
        //         }
        //     })
        //     .then(response => {
        //         $('#couponModal').modal('hide');
        //         getCheckoutData(productType, productId, selectedCurrencyCode, response.data.data.id);
        //         toastr.success('Coupon Code Applied');
        //     })
        //     .catch(error => {
        //         console.error('Error applying coupon:', error);
        //     });
        // });

        // First, remove any existing handlers
        $(document).off('click touchstart touchend', '.apply-coupon-btn');

        // Then add new handler after coupon list is loaded
        function bindCouponEvents() {
            $('.apply-coupon-btn').off('click touchstart').on('click touchstart', function(e) {
                //alert('Button clicked!');
                e.preventDefault();
                e.stopPropagation();
                
                const couponId = $(this).data('id');
                const couponCode = $(this).data('coupon_code');
                const { selectedCurrencyCode, selectedCurrencySymbol } = getSelectedCurrency();
                
                let payload = {
                    product_type: productType,
                    product_id: productId,
                    coupon_code: couponCode,
                    selectedCurrencyCode
                };

                window.axiosApiClient.post('/get-coupon-by-id', payload,{
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken()
                    }
                })
                .then(response => {
                    $('#couponModal').modal('hide');
                    getCheckoutData(productType, productId, selectedCurrencyCode, response.data.data.id);
                    toastr.success('Coupon Code Applied');
                })
                .catch(error => {
                    console.error('Error applying coupon:', error);
                });
            });
        }

        $(document).on('input', '.membership-number-input', function () {
            const membershipNo = $(this).val().trim();
            $('.membership-verify').prop('disabled', membershipNo.length !== 7);
        });

        // On clicking "Verify" button
        $(document).on('click', '.membership-verify', function () {
            const membershipNo = $('.membership-number-input').val().trim();

            // Optional: Show loading state
            $(this).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Verifying...`).prop('disabled', true);

            // API Call
            window.axiosApiClient.post('/get-user-by-membership-id', {
                membership_number: membershipNo
            }).then(res => {
                const user = res.data.data;

                // Fill form fields
                var mobileInput = $('#checkoutForm').find('input[name="mobile_no"]')[0];
                var iti = window.intlTelInputGlobals.getInstance(mobileInput);
                if (iti) {
                    iti.setCountry(user.mobile_no_ic || 'IN');
                }
                $('#checkoutForm [name="first_name"]').val(user.first_name || '');
                $('#checkoutForm [name="last_name"]').val(user.last_name || '');
                $('#checkoutForm [name="email"]').val(user.email || '');
                $('#checkoutForm [name="mobile_no"]').val(user.mobile_no || '');
                $('#checkoutForm [name="tax_id"]').val(user.tax_id || '');
                $('#checkoutForm [name="company_name"]').val(user.company_name || '');
                $('#checkoutForm [name="company_address"]').val(user.company_address || '');
                $('.membership-verify').prop('disabled', true);
                toastr.success('User fetched successfully');


            }).catch(err => {
                // toastr.error('User not found or invalid membership number');
                // console.error(err);
            }).finally(() => {
                $('.membership-verify').html('Verify');
            });
        });

        $('#checkoutForm').validate({
            rules: {
                first_name: {
                    required: true,
                    alphanumeric: true,
                    minlength: 3,
                    maxlength: 50
                },
                last_name: {
                    required: true,
                    alphanumeric: true,
                    minlength: 3,
                    maxlength: 50
                },
                email: {
                    required: true,
                    email: true,
                    maxlength: 50
                },
                mobile_no: {
                    required: true,
                    minlength: 7,
                    maxlength: 15
                    // validPhone: true
                }
            },
            messages: {
                first_name: {
                    required: "Please enter customer first name",
                    alphanumeric: "Only alphabets, spaces, and dots (.) are allowed.",
                    minlength: "Customer first name should be between 3-50 characters.",
                    maxlength: "Customer first name should be between 3-50 characters."
                },
                last_name: {
                    required: "Please enter customer last name",
                    alphanumeric: "Only alphabets, spaces, and dots (.) are allowed.",
                    minlength: "Customer last name should be between 3-50 characters.",
                    maxlength: "Customer last name should be between 3-50 characters."
                },
                email: {
                    required: "Email ID is required",
                    email: "Please enter a valid email address",
                    maxlength: "Email ID must not exceed 50 characters"
                },
                mobile_no: {
                    required: "Please enter mobile number.",
                    minlength: "Mobile number should be between 7-15 characters.",
                    maxlength: "Mobile number should be between 7-15 characters."
                }
            },
            onkeyup: function (element) {
                $(element).valid(); // Validate on keypress
            },
            onfocusout: function (element) {
                $(element).valid(); // Validate on focus out
            },
            onchange: function (element) {
                $(element).valid(); // Validate on change
            },
            submitHandler: async function (form, event) {
                event.preventDefault();
                $(form).find('button[type="submit"]').attr('disabled', 'disabled');
                
                let countryCode = null;
                let isoCode = null;
                $(form).find(".mobile").each(function () {
                    const $input = $(this);
                    const fieldName = $input.attr("name");
                
                    // Skip if no name or irrelevant name
                    if (!fieldName || (!fieldName.includes("mobile") && !fieldName.includes("contact"))) {
                        return;
                    }
                
                    // Get intlTelInput instance
                    const itiInstance = window.intlTelInputGlobals.getInstance(this);
                    if (!itiInstance) return;
                
                    countryCode = `+${itiInstance.getSelectedCountryData().dialCode}`;
                    isoCode = itiInstance.getSelectedCountryData().iso2.toUpperCase();
                
                });
                let taxId = $(".tax_id").val() || $(form).find("[name=tax_id]").val();
                let companyName = $(".company_name").val() || $(form).find("[name=company_name]").val();
                let companyAddress = $(".company_address").val() || $(form).find("[name=company_address]").val();
                // console.log("Tax ID:", taxId);
                // console.log("Company Name:", companyName);
                // console.log("Company Address:", companyAddress);

                const payload = {
                    first_name : $(form).find("[name=first_name]").val(),
                    last_name: $(form).find("[name=last_name]").val(),
                    mobile_no: $(form).find("[name=mobile_no]").val(),
                    mobile_no_cc: countryCode,
                    mobile_no_ic: isoCode,
                    email: $(form).find("[name=email]").val(),
                    tax_id: taxId,
                    company_name: companyName,
                    company_address: companyAddress,
                    user_id: $(form).find("[name=user_id]").val(),
                    cart_data: $(form).find("[name=cart_data]").val(),
                    payment_method: $(form).find("[name=payment_method]:checked").val() || 'razorpay',
                    product_id: $(form).find("[name=product_id]").val(),
                    product_type: $(form).find("[name=product_type]").val(),
                    coupon_id : $(form).find('[name="coupon_id"]').val(),
                    selectedCurrencyCode
                };

                loadingBlock();

                window.axiosApiClient.post('/place-order', payload, {
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken()
                    }
                }).then(response => {
                    loadingBlock();

                    if (response.data.success && response.data.gateway === 'razorpay') {
                        openRazorpay(response.data.order_id, response.data.amount, response.data.txn_id, response.data.txn_order_id);
                    } else if (response.data.success && response.data.gateway === 'paypal') {
                        window.location.href = `/api/paypal/checkout/${response.data.order_id}`;
                    } else if (response.data.redirect) {
                        window.location.href = response.data.redirect;
                    }
                }).catch(error => {
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                })
            }
        });

        getCheckoutData(productType, productId, selectedCurrencyCode);
        getCouponList(productType, productId, selectedCurrencyCode);
        // if(productType == 'event'){
        // }
    });

    const closeBtn = document.querySelector('#couponModal .btn-close');
    closeBtn.addEventListener('touchend', function(e) {
        e.preventDefault();
        const modal = bootstrap.Modal.getInstance(document.getElementById('couponModal'));
        modal.hide();
    });

    $(document).on('click touchend', '.copy-btn', function(e) {
        e.preventDefault(); // prevent ghost click in iOS
        const code = $(this).data('code');
        copyText(code);
    });

    function copyText(text) {
        navigator.clipboard.writeText(text).then(() => {
            toastr.success('Copied to clipboard!');
        }).catch(err => {
            console.error('Copy failed:', err);
        });
    }

</script>
@endsection