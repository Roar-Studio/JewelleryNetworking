@extends('frontend.layouts.master')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('new_ui/assets/css/membership.css') }}?v={{ time() }}">
<style>

    .form-check-input {
      cursor: pointer;
    }

    /* CSS rules are kept repetitive so that you can get CSS rules for each button easily :) */

.carousel-control-prev,
.carousel-control-next {
    z-index: 10; 
    pointer-events: auto; 
}
.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-size: 100% 100%;
    background-repeat: no-repeat;
    background-position: center;
    background-color: rgba(0,0,0,0.5);
}

</style>
@endsection

@section('content')
<!-- BEGIN: Content-->
<div id="carouselExampleCaptions" class="carousel slide position-relative" data-bs-ride="carousel" data-bs-interval="false">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('new_ui/assets/images/membership_header.webp') }}" class="d-block w-100 desktop_view" alt="carousel image">
            <img src="{{ asset('new_ui/assets/images/membership_mobile_banner.webp') }}" class="d-block w-100 mobile_view" alt="carousel image">
        </div>
    </div>
    <div class="social-icon-header">
        <a target="_blank" href="https://www.instagram.com/jewellerynetworking/?igsh=ZW41NGx4cm91czA3#">
            {{-- <svg width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path id="Vector" d="M15.0335 7.50781C19.2522 7.50781 22.7344 11.106 22.7344 15.4654C22.7344 19.894 19.2522 23.423 15.0335 23.423C10.7478 23.423 7.33259 19.894 7.33259 15.4654C7.33259 11.106 10.7478 7.50781 15.0335 7.50781ZM15.0335 20.6551C17.779 20.6551 19.9888 18.3717 19.9888 15.4654C19.9888 12.6283 17.779 10.3449 15.0335 10.3449C12.221 10.3449 10.0112 12.6283 10.0112 15.4654C10.0112 18.3717 12.2879 20.6551 15.0335 20.6551ZM24.8103 7.23103C24.8103 8.26897 24.0067 9.09933 23.0022 9.09933C21.9978 9.09933 21.1942 8.26897 21.1942 7.23103C21.1942 6.19308 21.9978 5.36272 23.0022 5.36272C24.0067 5.36272 24.8103 6.19308 24.8103 7.23103ZM29.8996 9.09933C30.0335 11.6596 30.0335 19.3404 29.8996 21.9007C29.7656 24.3917 29.2299 26.5368 27.4888 28.4051C25.7478 30.2042 23.6049 30.7578 21.1942 30.8962C18.7165 31.0346 11.2835 31.0346 8.8058 30.8962C6.39509 30.7578 4.3192 30.2042 2.51116 28.4051C0.770089 26.5368 0.234375 24.3917 0.100446 21.9007C-0.0334821 19.3404 -0.0334821 11.6596 0.100446 9.09933C0.234375 6.60826 0.770089 4.39397 2.51116 2.59487C4.3192 0.795759 6.39509 0.242188 8.8058 0.103795C11.2835 -0.0345982 18.7165 -0.0345982 21.1942 0.103795C23.6049 0.242188 25.7478 0.795759 27.4888 2.59487C29.2299 4.39397 29.7656 6.60826 29.8996 9.09933ZM26.6853 24.5993C27.4888 22.5926 27.2879 17.7489 27.2879 15.4654C27.2879 13.2511 27.4888 8.40737 26.6853 6.33147C26.1496 5.01674 25.1451 3.9096 23.8728 3.42522C21.8638 2.59487 17.1763 2.80246 15.0335 2.80246C12.8237 2.80246 8.13616 2.59487 6.1942 3.42522C4.85491 3.97879 3.85045 5.01674 3.31473 6.33147C2.51116 8.40737 2.71205 13.2511 2.71205 15.4654C2.71205 17.7489 2.51116 22.5926 3.31473 24.5993C3.85045 25.9833 4.85491 27.0212 6.1942 27.5748C8.13616 28.4051 12.8237 28.1975 15.0335 28.1975C17.1763 28.1975 21.8638 28.4051 23.8728 27.5748C25.1451 27.0212 26.2165 25.9833 26.6853 24.5993Z" fill="#264C5A"/>
            </svg> --}}
            <img src="{{ asset('new_ui/assets/images/instagram.webp') }}" alt="Instagram" width="25" height="25">
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
    <h1 class="main-page-title">Membership</h1>
</div>

<div class="special-design container">
    <hr/>
    <img src="{{ asset('new_ui/assets/images/diamond.webp') }}">
    <div class="vertical-line"></div>
</div>

<section class="container">

    <section class="intro-section">
      <h2 class="intro-heading">Join Our Community for Jewellery Networking Now!</h2>
      <p class="intro-text">
        <span>Be</span>
        <span class="highlight">"CEEN" @Jewellery Networking</span>
        <span>. No matter your role in the gems and jewellery industry or services
        related to this industry, our tools can unlock endless potential for
        your businesses.</span>
      </p>
    </section>
    <section class="currency-toggle">
      <span id="labelINR" class="fw-bold">INR</span>
      <div class="toggle-button-cover">
        <div class="button-cover">
          <div class="button b2" id="button-10">
            <input id="currencySwitch" type="checkbox" class="checkbox" />
            <div class="knobs">
              <span>&#8377;</span>
            </div>
            <div class="layer"></div>
          </div>
        </div>
      </div>
      <span id="labelUSD" class="fw-bold">USD</span>
    </section>
    <section class="pricing-cards">
      <!-- Free Membership Card -->
      <article class="pricing-card">
        <header class="card-header">
          <h3 class="card-title loading-text" style="height: 96px;"></h3>
          <div class="price-container loading-text" style="height: 80px;">
          </div>
        </header>

        <ul class="feature-list">
          <li class="feature-item loading-text">
          </li>
          <li class="feature-item loading-text">
          </li>
          <li class="feature-item loading-text">
          </li>
          <li class="feature-item loading-text">
          </li>
          <li class="feature-item loading-text">
          </li>
          <li class="feature-item loading-text">
          </li>
        </ul>

        <button class="unlock-button loading-text">
        </button>
      </article>

      <article class="pricing-card">
        <header class="card-header">
          <h3 class="card-title loading-text" style="height: 96px;"></h3>
          <div class="price-container loading-text" style="height: 80px;">
          </div>
        </header>

        <ul class="feature-list">
          <li class="feature-item loading-text">
          </li>
          <li class="feature-item loading-text">
          </li>
          <li class="feature-item loading-text">
          </li>
          <li class="feature-item loading-text">
          </li>
          <li class="feature-item loading-text">
          </li>
          <li class="feature-item loading-text">
          </li>
        </ul>

        <button class="unlock-button loading-text">
        </button>
      </article>
      
      <article class="pricing-card">
        <header class="card-header">
          <h3 class="card-title loading-text" style="height: 96px;"></h3>
          <div class="price-container loading-text" style="height: 80px;">
          </div>
        </header>

        <ul class="feature-list">
          <li class="feature-item loading-text">
          </li>
          <li class="feature-item loading-text">
          </li>
          <li class="feature-item loading-text">
          </li>
          <li class="feature-item loading-text">
          </li>
          <li class="feature-item loading-text">
          </li>
          <li class="feature-item loading-text">
          </li>
        </ul>

        <button class="unlock-button loading-text">
        </button>
      </article>

      <!-- Premium Membership Card -->
      <!-- <article class="pricing-card">
        <header class="card-header">
          <h3 class="card-title">
            <span>Premium</span>
            <br>
            <span>Membership</span>
          </h3>
          <div class="price-container">
            <span class="currency">&#8377;</span>
            <span class="price-amount">9,999</span>
            <span class="price-period">1 Year</span>
          </div>
        </header>

        <ul class="feature-list">
          <li class="feature-item">
            <i class="ti ti-check"></i>
            <span>Verified Membership: Premium members are by invitation only.</span>
          </li>
          <li class="feature-item">
            <i class="ti ti-check"></i>
            <span>Access to members directory</span>
          </li>
          <li class="feature-item">
            <i class="ti ti-check"></i>
            <span>One-on-One Sessions: Get a chance to schedule one business consultation for your brand with Prernaa. or other industry veterans to receive personalized advice and guidance on business challenges or growth strategies.</span>
          </li>
          <li class="feature-item">
            <i class="ti ti-check"></i>
            <span>Full access to members directory online.</span>
          </li>
          <li class="feature-item">
            <i class="ti ti-check"></i>
            <span>Featured Listings and Profiles: Enhanced visibility with featured profiles and listings in the community directory, making them more accessible to potential partners and clients.</span>
          </li>
          <li class="feature-item">
            <i class="ti ti-check"></i>
            <span>Access to an exclusive Premium members WhatsApp group for inquiries and requirements</span>
          </li>
          <li class="feature-item">
            <i class="ti ti-check"></i>
            <span>Twice a year, introduction on the WhatsApp group with your professional details and Jewellery Networking social media stories.</span>
          </li>
          <li class="feature-item">
            <i class="ti ti-check"></i>
            <span>Early access to workshops or limited seat events.</span>
          </li>
          <li class="feature-item">
            <i class="ti ti-check"></i>
            <span>Eligibility for discounts on selected workshops and events organized by Jewellery Networking.</span>
          </li>
          <li class="feature-item">
            <i class="ti ti-check"></i>
            <span>Email updates about Jewellery Networking workshops, events, and networking calls.</span>
          </li>
          <li class="feature-item">
            <i class="ti ti-check"></i>
            <span>Priority Access to specialized workshops, events conducted by industry experts, focusing on advanced topics.</span>
          </li>
        </ul>

        <button class="unlock-button">
          <span>Unlock This Plan</span>
          <i class="ti ti-arrow-right"></i>
        </button>
      </article> -->
    </section>
</section>

<div class="special-design mt-2 container">
    <hr/>
    <img src="{{ asset('new_ui/assets/images/diamond.webp') }}">
    <div class="vertical-line"></div>
</div>

<section class="container">
    <div class="faq-content">
      <div class="intro-section">
        <h2 class="intro-heading">Frequently Asked Question</h2>
        <p class="intro-text">
          We have compiled a list of commonly asked questions to provide you
          with quick and informative answers.
        </p>
      </div>
      <div class="accordion accordion-flush" id="jewelleryNetworkingFAQ">
          <div class="accordion-item">
              <h2 class="accordion-header" id="faq1">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-ans-1" aria-expanded="false" aria-controls="faq-ans-1">
                      <svg xmlns="http://www.w3.org/2000/svg" width="42" height="32" viewBox="0 0 42 32" fill="none">
                        <g clip-path="url(#clip0_1701_24854)">
                          <path d="M41.6783 16.0252C41.6279 15.9673 41.5736 15.9132 41.5155 15.8631L36.7786 11.7979C36.6429 11.628 36.3716 11.4003 35.8832 11.4003H33.0379C33.0379 11.4003 33.0108 11.4003 32.9953 11.4003L34.6621 9.5395C34.8792 9.32331 34.9877 9.04535 34.9877 8.72106V7.88719C34.9877 7.67486 34.9296 7.36215 34.666 7.07648C34.6156 7.01857 34.5613 6.96452 34.5032 6.91433L27.739 0.401605C27.6033 0.231741 27.332 0.00396948 26.8436 0.00396948H23.9983C20.4011 0.000108946 18.7537 -0.00375159 17.9668 0.00396948L8.1054 0.0502959C7.77591 0.0502959 7.50069 0.158391 7.29137 0.36686L0.476788 6.92205C0.333364 7.04559 0 7.34285 0 7.84086V8.72106C0 9.04921 0.104661 9.31945 0.290725 9.50089L16.5674 27.7111C16.8233 28.0006 17.1295 28.1473 17.4745 28.1473C17.9784 28.1473 18.2653 27.8269 18.4087 27.6724L21.7772 23.9161L28.6926 31.5677C28.9484 31.8573 29.2546 32.004 29.5996 32.004C30.1036 32.004 30.3904 31.6835 30.5338 31.5291L41.6666 18.4959C41.8837 18.2798 41.9922 18.0018 41.9922 17.6775V16.8436C41.9922 16.6313 41.9341 16.3186 41.6705 16.0329L41.6783 16.0252ZM17.4706 25.1322L2.4227 8.28482L8.58606 2.40136H26.3125L32.4875 8.30027L32.4952 8.30799L32.4759 8.34273L17.4706 25.1399V25.1322ZM39.4843 17.2876L29.5958 28.9889L23.3898 22.121L30.8478 13.8015H35.3521L39.4959 17.249L39.5036 17.2567L39.4843 17.2915V17.2876Z" fill="#C6B682"/>
                          <path d="M17.8652 16.8472C17.3768 16.8472 16.9504 17.0132 16.6093 17.3336C16.2643 17.654 16.0898 18.0439 16.0898 18.4956C16.0898 18.9473 16.2682 19.3372 16.6093 19.6538C16.9543 19.9742 17.3768 20.1402 17.8652 20.1402C18.1869 20.1402 18.4893 20.0669 18.7606 19.9163C19.0242 19.7657 19.2374 19.5688 19.3925 19.3218C19.5553 19.0708 19.6406 18.7929 19.6406 18.4995C19.6406 18.0517 19.4622 17.6579 19.1211 17.3375C18.78 17.017 18.3536 16.851 17.8652 16.851V16.8472Z" fill="#C6B682"/>
                          <path d="M20.8748 4.81426C20.1344 4.44365 19.2738 4.26221 18.3048 4.26221C17.4093 4.26221 16.5798 4.42821 15.8317 4.76022C15.0835 5.09608 14.4788 5.58637 14.0175 6.2195C13.5563 6.86807 13.3121 7.63246 13.2694 8.50494L13.2539 8.85625H15.9596L15.9828 8.53968C16.0216 8.01079 16.1612 7.60929 16.3782 7.32361C16.6108 7.01477 16.8899 6.79858 17.2233 6.6596C17.5721 6.51676 17.9326 6.44341 18.3086 6.44341C18.7428 6.44341 19.1343 6.52448 19.4793 6.69049C19.8243 6.85263 20.0956 7.0804 20.2972 7.3738C20.4949 7.66334 20.5995 8.00693 20.5995 8.43159C20.5995 8.77518 20.5336 9.0763 20.4096 9.34268C20.2856 9.62449 20.115 9.86771 19.9018 10.08C19.6809 10.2962 19.4289 10.4815 19.1459 10.6398C18.6149 10.9371 18.1536 11.2691 17.7621 11.6281C17.3512 12.0142 17.0411 12.5045 16.8318 13.0874C16.6147 13.6819 16.51 14.4579 16.4984 15.3999V15.8284H19.1149V15.4076C19.1265 14.8246 19.1886 14.3575 19.3049 13.9946C19.4173 13.6356 19.5917 13.3345 19.832 13.0835C20.0801 12.8172 20.4135 12.5585 20.8515 12.3037C21.3399 12.0257 21.7586 11.7053 22.1074 11.3424C22.4679 10.9718 22.7393 10.5472 22.9292 10.08C23.123 9.60519 23.2199 9.08402 23.2199 8.51652C23.2199 7.70967 23.0184 6.9723 22.6075 6.32759C22.2005 5.67902 21.6229 5.17329 20.8825 4.80654L20.8748 4.81426Z" fill="#C6B682"/>
                        </g>
                        <defs>
                          <clipPath id="clip0_1701_24854">
                            <rect width="42" height="32" fill="white"/>
                          </clipPath>
                        </defs>
                      </svg>
                      What is Jewellery Networking?
                  </button>
              </h2>
              <div id="faq-ans-1" class="accordion-collapse collapse" aria-labelledby="faq1" data-bs-parent="#jewelleryNetworkingFAQ">
                  <div class="accordion-body">Jewellery Networking is India’s first dedicated platform connecting service providers and professionals from the gems, jewellery, and allied industries worldwide.</div>
              </div>
          </div>

          <div class="accordion-item">
              <h2 class="accordion-header" id="faq2">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-ans-2" aria-expanded="false" aria-controls="faq-ans-2">
                      <svg xmlns="http://www.w3.org/2000/svg" width="42" height="32" viewBox="0 0 42 32" fill="none">
                        <g clip-path="url(#clip0_1701_24854)">
                          <path d="M41.6783 16.0252C41.6279 15.9673 41.5736 15.9132 41.5155 15.8631L36.7786 11.7979C36.6429 11.628 36.3716 11.4003 35.8832 11.4003H33.0379C33.0379 11.4003 33.0108 11.4003 32.9953 11.4003L34.6621 9.5395C34.8792 9.32331 34.9877 9.04535 34.9877 8.72106V7.88719C34.9877 7.67486 34.9296 7.36215 34.666 7.07648C34.6156 7.01857 34.5613 6.96452 34.5032 6.91433L27.739 0.401605C27.6033 0.231741 27.332 0.00396948 26.8436 0.00396948H23.9983C20.4011 0.000108946 18.7537 -0.00375159 17.9668 0.00396948L8.1054 0.0502959C7.77591 0.0502959 7.50069 0.158391 7.29137 0.36686L0.476788 6.92205C0.333364 7.04559 0 7.34285 0 7.84086V8.72106C0 9.04921 0.104661 9.31945 0.290725 9.50089L16.5674 27.7111C16.8233 28.0006 17.1295 28.1473 17.4745 28.1473C17.9784 28.1473 18.2653 27.8269 18.4087 27.6724L21.7772 23.9161L28.6926 31.5677C28.9484 31.8573 29.2546 32.004 29.5996 32.004C30.1036 32.004 30.3904 31.6835 30.5338 31.5291L41.6666 18.4959C41.8837 18.2798 41.9922 18.0018 41.9922 17.6775V16.8436C41.9922 16.6313 41.9341 16.3186 41.6705 16.0329L41.6783 16.0252ZM17.4706 25.1322L2.4227 8.28482L8.58606 2.40136H26.3125L32.4875 8.30027L32.4952 8.30799L32.4759 8.34273L17.4706 25.1399V25.1322ZM39.4843 17.2876L29.5958 28.9889L23.3898 22.121L30.8478 13.8015H35.3521L39.4959 17.249L39.5036 17.2567L39.4843 17.2915V17.2876Z" fill="#C6B682"/>
                          <path d="M17.8652 16.8472C17.3768 16.8472 16.9504 17.0132 16.6093 17.3336C16.2643 17.654 16.0898 18.0439 16.0898 18.4956C16.0898 18.9473 16.2682 19.3372 16.6093 19.6538C16.9543 19.9742 17.3768 20.1402 17.8652 20.1402C18.1869 20.1402 18.4893 20.0669 18.7606 19.9163C19.0242 19.7657 19.2374 19.5688 19.3925 19.3218C19.5553 19.0708 19.6406 18.7929 19.6406 18.4995C19.6406 18.0517 19.4622 17.6579 19.1211 17.3375C18.78 17.017 18.3536 16.851 17.8652 16.851V16.8472Z" fill="#C6B682"/>
                          <path d="M20.8748 4.81426C20.1344 4.44365 19.2738 4.26221 18.3048 4.26221C17.4093 4.26221 16.5798 4.42821 15.8317 4.76022C15.0835 5.09608 14.4788 5.58637 14.0175 6.2195C13.5563 6.86807 13.3121 7.63246 13.2694 8.50494L13.2539 8.85625H15.9596L15.9828 8.53968C16.0216 8.01079 16.1612 7.60929 16.3782 7.32361C16.6108 7.01477 16.8899 6.79858 17.2233 6.6596C17.5721 6.51676 17.9326 6.44341 18.3086 6.44341C18.7428 6.44341 19.1343 6.52448 19.4793 6.69049C19.8243 6.85263 20.0956 7.0804 20.2972 7.3738C20.4949 7.66334 20.5995 8.00693 20.5995 8.43159C20.5995 8.77518 20.5336 9.0763 20.4096 9.34268C20.2856 9.62449 20.115 9.86771 19.9018 10.08C19.6809 10.2962 19.4289 10.4815 19.1459 10.6398C18.6149 10.9371 18.1536 11.2691 17.7621 11.6281C17.3512 12.0142 17.0411 12.5045 16.8318 13.0874C16.6147 13.6819 16.51 14.4579 16.4984 15.3999V15.8284H19.1149V15.4076C19.1265 14.8246 19.1886 14.3575 19.3049 13.9946C19.4173 13.6356 19.5917 13.3345 19.832 13.0835C20.0801 12.8172 20.4135 12.5585 20.8515 12.3037C21.3399 12.0257 21.7586 11.7053 22.1074 11.3424C22.4679 10.9718 22.7393 10.5472 22.9292 10.08C23.123 9.60519 23.2199 9.08402 23.2199 8.51652C23.2199 7.70967 23.0184 6.9723 22.6075 6.32759C22.2005 5.67902 21.6229 5.17329 20.8825 4.80654L20.8748 4.81426Z" fill="#C6B682"/>
                        </g>
                        <defs>
                          <clipPath id="clip0_1701_24854">
                            <rect width="42" height="32" fill="white"/>
                          </clipPath>
                        </defs>
                      </svg>
                      Who is the target audience for Jewellery Networking?
                  </button>
              </h2>
              <div id="faq-ans-2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#jewelleryNetworkingFAQ">
                  <div class="accordion-body">The idea is to be ‘CEEN’ @jewellerynetworking No matter what you do for the gems and jewellery industry, this platform is for you!</div>
              </div>
          </div>

          <div class="accordion-item">
              <h2 class="accordion-header" id="faq3">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-ans-3" aria-expanded="false" aria-controls="faq-ans-3">
                      <svg xmlns="http://www.w3.org/2000/svg" width="42" height="32" viewBox="0 0 42 32" fill="none">
                        <g clip-path="url(#clip0_1701_24854)">
                          <path d="M41.6783 16.0252C41.6279 15.9673 41.5736 15.9132 41.5155 15.8631L36.7786 11.7979C36.6429 11.628 36.3716 11.4003 35.8832 11.4003H33.0379C33.0379 11.4003 33.0108 11.4003 32.9953 11.4003L34.6621 9.5395C34.8792 9.32331 34.9877 9.04535 34.9877 8.72106V7.88719C34.9877 7.67486 34.9296 7.36215 34.666 7.07648C34.6156 7.01857 34.5613 6.96452 34.5032 6.91433L27.739 0.401605C27.6033 0.231741 27.332 0.00396948 26.8436 0.00396948H23.9983C20.4011 0.000108946 18.7537 -0.00375159 17.9668 0.00396948L8.1054 0.0502959C7.77591 0.0502959 7.50069 0.158391 7.29137 0.36686L0.476788 6.92205C0.333364 7.04559 0 7.34285 0 7.84086V8.72106C0 9.04921 0.104661 9.31945 0.290725 9.50089L16.5674 27.7111C16.8233 28.0006 17.1295 28.1473 17.4745 28.1473C17.9784 28.1473 18.2653 27.8269 18.4087 27.6724L21.7772 23.9161L28.6926 31.5677C28.9484 31.8573 29.2546 32.004 29.5996 32.004C30.1036 32.004 30.3904 31.6835 30.5338 31.5291L41.6666 18.4959C41.8837 18.2798 41.9922 18.0018 41.9922 17.6775V16.8436C41.9922 16.6313 41.9341 16.3186 41.6705 16.0329L41.6783 16.0252ZM17.4706 25.1322L2.4227 8.28482L8.58606 2.40136H26.3125L32.4875 8.30027L32.4952 8.30799L32.4759 8.34273L17.4706 25.1399V25.1322ZM39.4843 17.2876L29.5958 28.9889L23.3898 22.121L30.8478 13.8015H35.3521L39.4959 17.249L39.5036 17.2567L39.4843 17.2915V17.2876Z" fill="#C6B682"/>
                          <path d="M17.8652 16.8472C17.3768 16.8472 16.9504 17.0132 16.6093 17.3336C16.2643 17.654 16.0898 18.0439 16.0898 18.4956C16.0898 18.9473 16.2682 19.3372 16.6093 19.6538C16.9543 19.9742 17.3768 20.1402 17.8652 20.1402C18.1869 20.1402 18.4893 20.0669 18.7606 19.9163C19.0242 19.7657 19.2374 19.5688 19.3925 19.3218C19.5553 19.0708 19.6406 18.7929 19.6406 18.4995C19.6406 18.0517 19.4622 17.6579 19.1211 17.3375C18.78 17.017 18.3536 16.851 17.8652 16.851V16.8472Z" fill="#C6B682"/>
                          <path d="M20.8748 4.81426C20.1344 4.44365 19.2738 4.26221 18.3048 4.26221C17.4093 4.26221 16.5798 4.42821 15.8317 4.76022C15.0835 5.09608 14.4788 5.58637 14.0175 6.2195C13.5563 6.86807 13.3121 7.63246 13.2694 8.50494L13.2539 8.85625H15.9596L15.9828 8.53968C16.0216 8.01079 16.1612 7.60929 16.3782 7.32361C16.6108 7.01477 16.8899 6.79858 17.2233 6.6596C17.5721 6.51676 17.9326 6.44341 18.3086 6.44341C18.7428 6.44341 19.1343 6.52448 19.4793 6.69049C19.8243 6.85263 20.0956 7.0804 20.2972 7.3738C20.4949 7.66334 20.5995 8.00693 20.5995 8.43159C20.5995 8.77518 20.5336 9.0763 20.4096 9.34268C20.2856 9.62449 20.115 9.86771 19.9018 10.08C19.6809 10.2962 19.4289 10.4815 19.1459 10.6398C18.6149 10.9371 18.1536 11.2691 17.7621 11.6281C17.3512 12.0142 17.0411 12.5045 16.8318 13.0874C16.6147 13.6819 16.51 14.4579 16.4984 15.3999V15.8284H19.1149V15.4076C19.1265 14.8246 19.1886 14.3575 19.3049 13.9946C19.4173 13.6356 19.5917 13.3345 19.832 13.0835C20.0801 12.8172 20.4135 12.5585 20.8515 12.3037C21.3399 12.0257 21.7586 11.7053 22.1074 11.3424C22.4679 10.9718 22.7393 10.5472 22.9292 10.08C23.123 9.60519 23.2199 9.08402 23.2199 8.51652C23.2199 7.70967 23.0184 6.9723 22.6075 6.32759C22.2005 5.67902 21.6229 5.17329 20.8825 4.80654L20.8748 4.81426Z" fill="#C6B682"/>
                        </g>
                        <defs>
                          <clipPath id="clip0_1701_24854">
                            <rect width="42" height="32" fill="white"/>
                          </clipPath>
                        </defs>
                      </svg>    
                      How can I become a member of Jewellery Networking?
                  </button>
              </h2>
              <div id="faq-ans-3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#jewelleryNetworkingFAQ">
                  <div class="accordion-body">Visit our official website <a href="https://www.jewellerynetworking.com" target="_blank">www.jewellerynetworking.com</a> and register for membership benefits!</div>
              </div>
          </div>

          <div class="accordion-item">
              <h2 class="accordion-header" id="faq4">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-ans-4" aria-expanded="false" aria-controls="faq-ans-4">
                      <svg xmlns="http://www.w3.org/2000/svg" width="42" height="32" viewBox="0 0 42 32" fill="none">
                        <g clip-path="url(#clip0_1701_24854)">
                          <path d="M41.6783 16.0252C41.6279 15.9673 41.5736 15.9132 41.5155 15.8631L36.7786 11.7979C36.6429 11.628 36.3716 11.4003 35.8832 11.4003H33.0379C33.0379 11.4003 33.0108 11.4003 32.9953 11.4003L34.6621 9.5395C34.8792 9.32331 34.9877 9.04535 34.9877 8.72106V7.88719C34.9877 7.67486 34.9296 7.36215 34.666 7.07648C34.6156 7.01857 34.5613 6.96452 34.5032 6.91433L27.739 0.401605C27.6033 0.231741 27.332 0.00396948 26.8436 0.00396948H23.9983C20.4011 0.000108946 18.7537 -0.00375159 17.9668 0.00396948L8.1054 0.0502959C7.77591 0.0502959 7.50069 0.158391 7.29137 0.36686L0.476788 6.92205C0.333364 7.04559 0 7.34285 0 7.84086V8.72106C0 9.04921 0.104661 9.31945 0.290725 9.50089L16.5674 27.7111C16.8233 28.0006 17.1295 28.1473 17.4745 28.1473C17.9784 28.1473 18.2653 27.8269 18.4087 27.6724L21.7772 23.9161L28.6926 31.5677C28.9484 31.8573 29.2546 32.004 29.5996 32.004C30.1036 32.004 30.3904 31.6835 30.5338 31.5291L41.6666 18.4959C41.8837 18.2798 41.9922 18.0018 41.9922 17.6775V16.8436C41.9922 16.6313 41.9341 16.3186 41.6705 16.0329L41.6783 16.0252ZM17.4706 25.1322L2.4227 8.28482L8.58606 2.40136H26.3125L32.4875 8.30027L32.4952 8.30799L32.4759 8.34273L17.4706 25.1399V25.1322ZM39.4843 17.2876L29.5958 28.9889L23.3898 22.121L30.8478 13.8015H35.3521L39.4959 17.249L39.5036 17.2567L39.4843 17.2915V17.2876Z" fill="#C6B682"/>
                          <path d="M17.8652 16.8472C17.3768 16.8472 16.9504 17.0132 16.6093 17.3336C16.2643 17.654 16.0898 18.0439 16.0898 18.4956C16.0898 18.9473 16.2682 19.3372 16.6093 19.6538C16.9543 19.9742 17.3768 20.1402 17.8652 20.1402C18.1869 20.1402 18.4893 20.0669 18.7606 19.9163C19.0242 19.7657 19.2374 19.5688 19.3925 19.3218C19.5553 19.0708 19.6406 18.7929 19.6406 18.4995C19.6406 18.0517 19.4622 17.6579 19.1211 17.3375C18.78 17.017 18.3536 16.851 17.8652 16.851V16.8472Z" fill="#C6B682"/>
                          <path d="M20.8748 4.81426C20.1344 4.44365 19.2738 4.26221 18.3048 4.26221C17.4093 4.26221 16.5798 4.42821 15.8317 4.76022C15.0835 5.09608 14.4788 5.58637 14.0175 6.2195C13.5563 6.86807 13.3121 7.63246 13.2694 8.50494L13.2539 8.85625H15.9596L15.9828 8.53968C16.0216 8.01079 16.1612 7.60929 16.3782 7.32361C16.6108 7.01477 16.8899 6.79858 17.2233 6.6596C17.5721 6.51676 17.9326 6.44341 18.3086 6.44341C18.7428 6.44341 19.1343 6.52448 19.4793 6.69049C19.8243 6.85263 20.0956 7.0804 20.2972 7.3738C20.4949 7.66334 20.5995 8.00693 20.5995 8.43159C20.5995 8.77518 20.5336 9.0763 20.4096 9.34268C20.2856 9.62449 20.115 9.86771 19.9018 10.08C19.6809 10.2962 19.4289 10.4815 19.1459 10.6398C18.6149 10.9371 18.1536 11.2691 17.7621 11.6281C17.3512 12.0142 17.0411 12.5045 16.8318 13.0874C16.6147 13.6819 16.51 14.4579 16.4984 15.3999V15.8284H19.1149V15.4076C19.1265 14.8246 19.1886 14.3575 19.3049 13.9946C19.4173 13.6356 19.5917 13.3345 19.832 13.0835C20.0801 12.8172 20.4135 12.5585 20.8515 12.3037C21.3399 12.0257 21.7586 11.7053 22.1074 11.3424C22.4679 10.9718 22.7393 10.5472 22.9292 10.08C23.123 9.60519 23.2199 9.08402 23.2199 8.51652C23.2199 7.70967 23.0184 6.9723 22.6075 6.32759C22.2005 5.67902 21.6229 5.17329 20.8825 4.80654L20.8748 4.81426Z" fill="#C6B682"/>
                        </g>
                        <defs>
                          <clipPath id="clip0_1701_24854">
                            <rect width="42" height="32" fill="white"/>
                          </clipPath>
                        </defs>
                      </svg>
                      How does Jewellery Networking help with business growth and expansion?
                  </button>
              </h2>
              <div id="faq-ans-4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#jewelleryNetworkingFAQ">
                  <div class="accordion-body">We’re your powerhouse for growth-connecting you with a diverse network of suppliers, vendors, service providers to accelerate and simplify your business expansion.</div>
              </div>
          </div>

          <div class="accordion-item">
              <h2 class="accordion-header" id="faq5">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-ans-5" aria-expanded="false" aria-controls="faq-ans-5">
                      <svg xmlns="http://www.w3.org/2000/svg" width="42" height="32" viewBox="0 0 42 32" fill="none">
                        <g clip-path="url(#clip0_1701_24854)">
                          <path d="M41.6783 16.0252C41.6279 15.9673 41.5736 15.9132 41.5155 15.8631L36.7786 11.7979C36.6429 11.628 36.3716 11.4003 35.8832 11.4003H33.0379C33.0379 11.4003 33.0108 11.4003 32.9953 11.4003L34.6621 9.5395C34.8792 9.32331 34.9877 9.04535 34.9877 8.72106V7.88719C34.9877 7.67486 34.9296 7.36215 34.666 7.07648C34.6156 7.01857 34.5613 6.96452 34.5032 6.91433L27.739 0.401605C27.6033 0.231741 27.332 0.00396948 26.8436 0.00396948H23.9983C20.4011 0.000108946 18.7537 -0.00375159 17.9668 0.00396948L8.1054 0.0502959C7.77591 0.0502959 7.50069 0.158391 7.29137 0.36686L0.476788 6.92205C0.333364 7.04559 0 7.34285 0 7.84086V8.72106C0 9.04921 0.104661 9.31945 0.290725 9.50089L16.5674 27.7111C16.8233 28.0006 17.1295 28.1473 17.4745 28.1473C17.9784 28.1473 18.2653 27.8269 18.4087 27.6724L21.7772 23.9161L28.6926 31.5677C28.9484 31.8573 29.2546 32.004 29.5996 32.004C30.1036 32.004 30.3904 31.6835 30.5338 31.5291L41.6666 18.4959C41.8837 18.2798 41.9922 18.0018 41.9922 17.6775V16.8436C41.9922 16.6313 41.9341 16.3186 41.6705 16.0329L41.6783 16.0252ZM17.4706 25.1322L2.4227 8.28482L8.58606 2.40136H26.3125L32.4875 8.30027L32.4952 8.30799L32.4759 8.34273L17.4706 25.1399V25.1322ZM39.4843 17.2876L29.5958 28.9889L23.3898 22.121L30.8478 13.8015H35.3521L39.4959 17.249L39.5036 17.2567L39.4843 17.2915V17.2876Z" fill="#C6B682"/>
                          <path d="M17.8652 16.8472C17.3768 16.8472 16.9504 17.0132 16.6093 17.3336C16.2643 17.654 16.0898 18.0439 16.0898 18.4956C16.0898 18.9473 16.2682 19.3372 16.6093 19.6538C16.9543 19.9742 17.3768 20.1402 17.8652 20.1402C18.1869 20.1402 18.4893 20.0669 18.7606 19.9163C19.0242 19.7657 19.2374 19.5688 19.3925 19.3218C19.5553 19.0708 19.6406 18.7929 19.6406 18.4995C19.6406 18.0517 19.4622 17.6579 19.1211 17.3375C18.78 17.017 18.3536 16.851 17.8652 16.851V16.8472Z" fill="#C6B682"/>
                          <path d="M20.8748 4.81426C20.1344 4.44365 19.2738 4.26221 18.3048 4.26221C17.4093 4.26221 16.5798 4.42821 15.8317 4.76022C15.0835 5.09608 14.4788 5.58637 14.0175 6.2195C13.5563 6.86807 13.3121 7.63246 13.2694 8.50494L13.2539 8.85625H15.9596L15.9828 8.53968C16.0216 8.01079 16.1612 7.60929 16.3782 7.32361C16.6108 7.01477 16.8899 6.79858 17.2233 6.6596C17.5721 6.51676 17.9326 6.44341 18.3086 6.44341C18.7428 6.44341 19.1343 6.52448 19.4793 6.69049C19.8243 6.85263 20.0956 7.0804 20.2972 7.3738C20.4949 7.66334 20.5995 8.00693 20.5995 8.43159C20.5995 8.77518 20.5336 9.0763 20.4096 9.34268C20.2856 9.62449 20.115 9.86771 19.9018 10.08C19.6809 10.2962 19.4289 10.4815 19.1459 10.6398C18.6149 10.9371 18.1536 11.2691 17.7621 11.6281C17.3512 12.0142 17.0411 12.5045 16.8318 13.0874C16.6147 13.6819 16.51 14.4579 16.4984 15.3999V15.8284H19.1149V15.4076C19.1265 14.8246 19.1886 14.3575 19.3049 13.9946C19.4173 13.6356 19.5917 13.3345 19.832 13.0835C20.0801 12.8172 20.4135 12.5585 20.8515 12.3037C21.3399 12.0257 21.7586 11.7053 22.1074 11.3424C22.4679 10.9718 22.7393 10.5472 22.9292 10.08C23.123 9.60519 23.2199 9.08402 23.2199 8.51652C23.2199 7.70967 23.0184 6.9723 22.6075 6.32759C22.2005 5.67902 21.6229 5.17329 20.8825 4.80654L20.8748 4.81426Z" fill="#C6B682"/>
                        </g>
                        <defs>
                          <clipPath id="clip0_1701_24854">
                            <rect width="42" height="32" fill="white"/>
                          </clipPath>
                        </defs>
                      </svg>
                      Can members of Jewellery Networking access exclusive deals or discounts from industry suppliers?
                  </button>
              </h2>
              <div id="faq-ans-5" class="accordion-collapse collapse" aria-labelledby="faq5" data-bs-parent="#jewelleryNetworkingFAQ">
                  <div class="accordion-body">Absolutely! Paid Membership comes with its perks, including exclusive deals and discounts for workshops and events.</div>
              </div>
          </div>

          <div class="accordion-item">
              <h2 class="accordion-header" id="faq6">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-ans-6" aria-expanded="false" aria-controls="faq-ans-6">
                      <svg xmlns="http://www.w3.org/2000/svg" width="42" height="32" viewBox="0 0 42 32" fill="none">
                        <g clip-path="url(#clip0_1701_24854)">
                          <path d="M41.6783 16.0252C41.6279 15.9673 41.5736 15.9132 41.5155 15.8631L36.7786 11.7979C36.6429 11.628 36.3716 11.4003 35.8832 11.4003H33.0379C33.0379 11.4003 33.0108 11.4003 32.9953 11.4003L34.6621 9.5395C34.8792 9.32331 34.9877 9.04535 34.9877 8.72106V7.88719C34.9877 7.67486 34.9296 7.36215 34.666 7.07648C34.6156 7.01857 34.5613 6.96452 34.5032 6.91433L27.739 0.401605C27.6033 0.231741 27.332 0.00396948 26.8436 0.00396948H23.9983C20.4011 0.000108946 18.7537 -0.00375159 17.9668 0.00396948L8.1054 0.0502959C7.77591 0.0502959 7.50069 0.158391 7.29137 0.36686L0.476788 6.92205C0.333364 7.04559 0 7.34285 0 7.84086V8.72106C0 9.04921 0.104661 9.31945 0.290725 9.50089L16.5674 27.7111C16.8233 28.0006 17.1295 28.1473 17.4745 28.1473C17.9784 28.1473 18.2653 27.8269 18.4087 27.6724L21.7772 23.9161L28.6926 31.5677C28.9484 31.8573 29.2546 32.004 29.5996 32.004C30.1036 32.004 30.3904 31.6835 30.5338 31.5291L41.6666 18.4959C41.8837 18.2798 41.9922 18.0018 41.9922 17.6775V16.8436C41.9922 16.6313 41.9341 16.3186 41.6705 16.0329L41.6783 16.0252ZM17.4706 25.1322L2.4227 8.28482L8.58606 2.40136H26.3125L32.4875 8.30027L32.4952 8.30799L32.4759 8.34273L17.4706 25.1399V25.1322ZM39.4843 17.2876L29.5958 28.9889L23.3898 22.121L30.8478 13.8015H35.3521L39.4959 17.249L39.5036 17.2567L39.4843 17.2915V17.2876Z" fill="#C6B682"/>
                          <path d="M17.8652 16.8472C17.3768 16.8472 16.9504 17.0132 16.6093 17.3336C16.2643 17.654 16.0898 18.0439 16.0898 18.4956C16.0898 18.9473 16.2682 19.3372 16.6093 19.6538C16.9543 19.9742 17.3768 20.1402 17.8652 20.1402C18.1869 20.1402 18.4893 20.0669 18.7606 19.9163C19.0242 19.7657 19.2374 19.5688 19.3925 19.3218C19.5553 19.0708 19.6406 18.7929 19.6406 18.4995C19.6406 18.0517 19.4622 17.6579 19.1211 17.3375C18.78 17.017 18.3536 16.851 17.8652 16.851V16.8472Z" fill="#C6B682"/>
                          <path d="M20.8748 4.81426C20.1344 4.44365 19.2738 4.26221 18.3048 4.26221C17.4093 4.26221 16.5798 4.42821 15.8317 4.76022C15.0835 5.09608 14.4788 5.58637 14.0175 6.2195C13.5563 6.86807 13.3121 7.63246 13.2694 8.50494L13.2539 8.85625H15.9596L15.9828 8.53968C16.0216 8.01079 16.1612 7.60929 16.3782 7.32361C16.6108 7.01477 16.8899 6.79858 17.2233 6.6596C17.5721 6.51676 17.9326 6.44341 18.3086 6.44341C18.7428 6.44341 19.1343 6.52448 19.4793 6.69049C19.8243 6.85263 20.0956 7.0804 20.2972 7.3738C20.4949 7.66334 20.5995 8.00693 20.5995 8.43159C20.5995 8.77518 20.5336 9.0763 20.4096 9.34268C20.2856 9.62449 20.115 9.86771 19.9018 10.08C19.6809 10.2962 19.4289 10.4815 19.1459 10.6398C18.6149 10.9371 18.1536 11.2691 17.7621 11.6281C17.3512 12.0142 17.0411 12.5045 16.8318 13.0874C16.6147 13.6819 16.51 14.4579 16.4984 15.3999V15.8284H19.1149V15.4076C19.1265 14.8246 19.1886 14.3575 19.3049 13.9946C19.4173 13.6356 19.5917 13.3345 19.832 13.0835C20.0801 12.8172 20.4135 12.5585 20.8515 12.3037C21.3399 12.0257 21.7586 11.7053 22.1074 11.3424C22.4679 10.9718 22.7393 10.5472 22.9292 10.08C23.123 9.60519 23.2199 9.08402 23.2199 8.51652C23.2199 7.70967 23.0184 6.9723 22.6075 6.32759C22.2005 5.67902 21.6229 5.17329 20.8825 4.80654L20.8748 4.81426Z" fill="#C6B682"/>
                        </g>
                        <defs>
                          <clipPath id="clip0_1701_24854">
                            <rect width="42" height="32" fill="white"/>
                          </clipPath>
                        </defs>
                      </svg>
                      What measures does Jewellery Networking take to ensure the privacy and security of its members' information?
                  </button>
              </h2>
              <div id="faq-ans-6" class="accordion-collapse collapse" aria-labelledby="faq6" data-bs-parent="#jewelleryNetworkingFAQ">
                  <div class="accordion-body">
                    Your trust is our top priority! We deploy robust data protection measures: encryption protocols, secure server infrastructure, and strict adherence to privacy regulations to safeguard your personal and professional info.<br/>
                    While Jewellery Networking serves as an aggregator platform for connections, we encourage individuals to conduct their due diligence and exercise caution before engaging in business activities. Your safety and success are paramount to us.
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
</section>

<div class="special-design mt-2 container" >
    <hr/>
    <img src="{{ asset('new_ui/assets/images/diamond.webp') }}">
    <div class="vertical-line"></div>
</div>

<section class="testimonials">
    <div class="container">
        <h3>What our members say about us</h3>
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="quate mb-2" src="{{ asset('new_ui/assets/images/quata.svg') }}" />
                    <p class="msg">Jewellery Networking will be a great platform for building and strengthening connections and bridges the gap within the gems and jewellery industry. The platform’s dedication to creating a vibrant and interactive community is evident, and we wish them the very best in this endeavour.</p>
                    <img class="quate end" src="{{ asset('new_ui/assets/images/quata.svg') }}" />
                    <div class="testi-person">
                        <img src="{{ asset('new_ui/assets/images/testicon1.webp') }}" />
                        <div>
                            <h5>Vaishali Banerjee</h5>
                            <p class="mb-0">Managing Director, PGI India</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="quate" src="{{ asset('new_ui/assets/images/quata.svg') }}" />
                    <p class="msg">Jewellery Networking will be a great platform for building and strengthening connections and bridges the gap within the gems and jewellery industry. The platform’s dedication to creating a vibrant and interactive community is evident, and we wish them the very best in this endeavour.</p>
                    <img class="quate end" src="{{ asset('new_ui/assets/images/quata.svg') }}" />
                    <div class="testi-person">
                        <img src="{{ asset('new_ui/assets/images/testicon1.webp') }}" />
                        <div>
                            <h5>Vaishali Banerjee</h5>
                            <p class="mb-0">Managing Director, PGI India</p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>

<div class="special-design container">
    <hr/>
    <img src="{{ asset('new_ui/assets/images/diamond.webp') }}">
    <div class="vertical-line"></div>
</div>

<section class="join-now-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <svg xmlns="http://www.w3.org/2000/svg" width="325" height="259" viewBox="0 0 325 259" fill="none">
                    <path d="M324.231 66.961C324.045 66.6265 323.772 66.3664 323.43 66.1868L278.939 23.2617L278.703 22.8839C278.666 22.8282 278.623 22.791 278.586 22.7353C278.399 21.9425 277.984 21.379 277.326 21.0507L276.079 20.4995L255.779 0.916595C255.779 0.458297 254.86 0.458297 254.401 0.458297H230.688L229.652 0H162.726C162.466 0 162.211 0.0805117 161.963 0.204376C161.777 0.260115 161.585 0.34682 161.355 0.458297H97.0229C96.4769 0.241535 95.8441 0.210569 95.3415 0.458297L94.3054 0.916595H70.1334C69.6743 0.916595 69.2152 0.916595 68.7561 1.37489L48.0585 21.3356L47.6677 21.509C47.4381 21.6267 47.2334 21.8001 47.0658 22.0045C46.9418 22.1283 46.8301 22.2646 46.7494 22.4194L46.464 22.8715L1.82407 65.9329C0.713495 66.1187 0 66.9734 0 68.181V76.8763C0 77.3346 0 77.7929 0.459118 78.2512L160.245 257.408C160.468 257.879 160.834 258.288 161.355 258.542H162.267C162.573 258.542 162.879 258.694 163.186 259C163.955 258.616 164.395 257.91 164.52 257.154L209.631 206.717C209.96 206.649 210.344 206.544 210.859 206.37L215.544 200.103L324.541 78.2388C325 77.7805 325 77.3222 325 76.8639V68.6269C325 67.8094 324.634 67.3573 324.231 66.9486V66.961ZM118.651 203.942L69.6433 96.4716L140.72 190.819L157.186 247.177L118.651 203.942ZM95.4284 5.60485L113.675 30.3281L59.2759 64.4341L50.8815 25.194V25.1692L51.0118 25.1073L95.4222 5.60485H95.4284ZM264.949 64.5209L210.717 30.5201L229.106 5.60485L273.2 25.1692L264.949 64.5209ZM165.022 7.15935L203.526 31.5792L165.022 63.2327V7.15935ZM112.304 65.8957L118.26 35.2394L155.846 65.8957H112.298H112.304ZM168.689 65.8957L205.822 35.2394L212.237 65.8957H168.689ZM216.816 65.8957L210.754 35.6481L258.856 65.8957H216.816ZM159.978 7.31418V63.6043L121.015 31.573L123.937 29.7212L159.972 7.31418H159.978ZM107.725 65.8957H65.7594L113.694 36.094L107.725 65.8957ZM159.978 70.9246V74.5848H112.205L112 70.9246H159.978ZM212.336 74.5848H164.563V70.9246H212.541L212.336 74.5848ZM207.224 28.3277L190.249 17.6878L170.178 5.03508H224.528L207.224 28.3339V28.3277ZM117.72 27.7951L100.82 5.03508H154.022L117.72 27.7951ZM107.415 70.9246L107.62 74.5848H60.5044V70.9246H107.415ZM56.2668 78.7033L56.4778 78.982L106.348 186.236L25.7727 78.7033H56.2668ZM108.116 78.7033L137.059 178.916L61.9872 78.7033H108.116ZM113.222 78.7033H159.519L142.097 179.832L113.216 78.7033H113.222ZM159.978 103.513V241.678L144.852 189.902L159.978 103.513ZM164.563 103.532L179.689 189.902L164.563 241.665V103.532ZM165.022 78.7033H211.319L182.438 179.832L165.016 78.7033H165.022ZM216.419 78.7033H262.547L187.475 178.916L216.419 78.7033ZM264.489 74.591H216.915L217.12 70.9308H264.489V74.591ZM277.556 29.9318L300.071 65.8957H269.67L277.549 29.9318H277.556ZM54.8957 65.8957H25.0902L47.5001 30.099L54.8957 65.8957ZM55.9194 70.9246V74.5848H23.3716V70.9246H55.9194ZM18.3337 74.591H4.58498V70.9308H18.3337V74.591ZM19.4753 78.7033L84.2793 165.371L7.02948 78.7033H19.4753ZM184.274 190.819L255.698 95.4993L205.822 203.633C205.735 203.806 205.691 203.998 205.666 204.19L167.448 247.066L184.274 190.813V190.819ZM268.659 78.7033H300.028L219.111 186.694L268.659 78.7033ZM269.074 74.591V70.9308H302.081V74.591H269.074ZM307.125 70.9246H319.956V74.5848H307.125V70.9246ZM316.612 65.8957H305.804L289.381 39.8285L316.612 65.8957ZM253.03 5.03508L263.286 14.8513L241.056 5.03508H253.03ZM71.0517 5.03508H84.9803L59.1208 16.4492L71.0455 5.03508H71.0517ZM19.3698 65.8957H7.46998L37.4368 37.215L19.3698 65.8957ZM306.325 78.7033H317.511L248.073 156.608L306.325 78.7033Z" fill="#C6B682" fill-opacity="0.5"/>
                </svg>
                <!-- <img src="{{ asset('new_ui/assets/images/join_now.png') }}" alt="Join Now"> -->
                <h3>Become <br/>A Member</h3>
            </div>
            <div class="col-md-5">
                <a href="/membership" class="btn btn-secondary custom-btn w-100">
                    Join Now
                    <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- END: Content-->
@endsection

@section('script')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="{{ asset('new_ui/assets/js/frontend/membership.js') }}?v={{ time() }}"></script>
<script src="{{ asset('new_ui/assets/js/admin/custom-image-uploader.js') }}?v={{ time() }}"></script>
<script>
    // var myCarousel = document.querySelector('#carouselExampleCaptions')
    // // var carousel = new bootstrap.Carousel(myCarousel, {
    // // interval: 3000,
    // // pause: true,
    // // })
</script>
<script>
const myCarousel = document.querySelector('#testimonialCarousel');
new bootstrap.Carousel(myCarousel, {
  interval: false,
  touch: true, // explicitly enable touch
  ride: false
});
</script>
@endsection