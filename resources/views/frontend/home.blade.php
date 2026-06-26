@extends('frontend.layouts.master')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('new_ui/assets/css/home.css') }}?v={{ time() }}">

<style>
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
/* @media (max-width: 480px) {
  #youtube-vector{
    fill : red;
  }
} */
</style>
@endsection

@section('content')
<!-- BEGIN: Content-->
<div id="carouselExampleCaptions" class="carousel slide position-relative" data-bs-ride="carousel" data-bs-interval="false">
    <!-- <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div> -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('new_ui/assets/images/carousel1.png') }}" class="d-block w-100 desktop_view" alt="carousel image">
            <a href="/membership">
                {{-- <img src="{{ asset('new_ui/assets/images/home_mobile_banner.webp') }}" class="d-block w-100 mobile_view" alt="carousel image"> --}}
                <img src="{{ asset('new_ui/assets/images/home_mobile_banner_new.webp') }}" class="d-block w-100 mobile_view" alt="carousel image">
            </a>
            <div class="carousel-caption d-none d-md-block">
                <img src="{{ asset('new_ui/assets/images/be-ceen.svg') }}"/>                
                <a href="/membership" class="btn btn-primary custom-btn w-100">Become a part of Our Thriving Community
                    <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button> -->
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
                <path id="youtube-vector" d="M 44.898438 14.5 C 44.5 12.300781 42.601563 10.699219 40.398438 10.199219 C 37.101563 9.5 31 9 24.398438 9 C 17.800781 9 11.601563 9.5 8.300781 10.199219 C 6.101563 10.699219 4.199219 12.199219 3.800781 14.5 C 3.398438 17 3 20.5 3 25 C 3 29.5 3.398438 33 3.898438 35.5 C 4.300781 37.699219 6.199219 39.300781 8.398438 39.800781 C 11.898438 40.5 17.898438 41 24.5 41 C 31.101563 41 37.101563 40.5 40.601563 39.800781 C 42.800781 39.300781 44.699219 37.800781 45.101563 35.5 C 45.5 33 46 29.398438 46.101563 25 C 45.898438 20.5 45.398438 17 44.898438 14.5 Z M 19 32 L 19 18 L 31.199219 25 Z" fill="#264C5A"></path>
            </svg>           
             {{--<img src="{{ asset('new_ui/assets/images/yt_logo.png') }}" alt="YouTube" width="25" height="25"> --}}
        </a>
    </div>
</div>
<div class="special-design container kp">
    <hr/>
    <img src="{{ asset('new_ui/assets/images/diamond.webp') }}">
    <div class="vertical-line"></div>
</div>
<section class="key-features">
    <div class="container">
        <div class="key-box">
            <div class="key-circle">
                <img src="{{ asset('new_ui/assets/images/connect1.webp') }}">
            </div>
            <div class="key-circle">
                <img src="{{ asset('new_ui/assets/images/connect2.webp') }}">
            </div>
            <div class="key-circle">
                <img src="{{ asset('new_ui/assets/images/connect3.webp') }}">
            </div>
            <div class="key-circle">
                <img src="{{ asset('new_ui/assets/images/connect4.webp') }}">
            </div>
        </div>
        <div class="key-btns">
            <a href="/membership" class="btn btn-secondary custom-btn">
                Join Now
                <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
                </svg>
            </a>
            <a href="/events" class="btn btn-secondary custom-btn">
                Learn More
                <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
                </svg>
            </a>
        </div>
    </div>
</section>
<div class="special-design container">
    <hr/>
    <img src="{{ asset('new_ui/assets/images/diamond.webp') }}">
    <div class="vertical-line"></div>
</div>
<section class="become-member">
    <div class="container">
        <h3>Jewellery Networking: Where Connections Become Opportunities</h3>
        <div class="bm-box">
            <div class="bm-left">
                <p>At Jewellery Networking, we empower service providers, service seekers, businesses, and professionals to connect globally and turn relationships into real opportunities.</p>
                <p>As your business networking hub, we make it easy to discover new contacts, share key updates, and collaborate for lasting partnerships. Stay informed, showcase your work, and access exclusive industry events-both online and offline-to expand your reach.</p>
                <p>Membership gives you the tools to succeed and grow, opening doors to opportunities beyond the gems and jewellery sectors too. </p>
                                
                <a href="/membership" class="btn btn-secondary custom-btn">
                    Become A Member
                    <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
                    </svg>
                    <!-- <img src="{{ asset('new_ui/assets/images/right-arrow.svg') }}" /> -->
                </a>
            </div>
            <img class="bm-right" src="{{ asset('new_ui/assets/images/become-member.webp') }}"/>
        </div>
    </div>
</section>
<div class="special-design container">
    <hr/>
    <img src="{{ asset('new_ui/assets/images/diamond.webp') }}">
    <div class="vertical-line"></div>
</div>
<section class="eevents">
    <div class="container">
        <h3>Be part of our Exclusive Events</h3>
        <div class="ee-box">
            <div class="ee-imgs">
                <img src="{{ asset('new_ui/assets/images/exclusive-event1.webp') }}">
                <img src="{{ asset('new_ui/assets/images/exclusive-event2.webp') }}">
            </div>
            <div class="ee-list">
                <div>
                    <img src="{{ asset('new_ui/assets/images/hands.svg') }}">
                    <h4>Online Workshops & Digital Conferences</h4>
                    <p>Join our online workshops and conferences for gems, jewellery, allied industries, and service providers. Learn new skills, gain fresh ideas, and get practical business tips from experts-all from the comfort of your home. These sessions offer actionable insights to help you grow and succeed.</p>
                </div>
                <div>
                    <img src="{{ asset('new_ui/assets/images/tea.svg') }}">
                    <h4>Offline Workshops</h4>
                    <p>Take part in our hands-on workshops in person. Meet other jewellery professionals, learn useful techniques, and get personal advice to help your business grow. These events are great for building strong connections and gaining skills you can use every day.</p>
                </div>
                <div>
                    <img src="{{ asset('new_ui/assets/images/four-person.svg') }}">
                    <h4>Networking Meetups​</h4>
                    <p>Discover a dynamic community of like minded people at jewellery networking events across trade and luxury shows. Laying the groundwork for innovative partnerships and growth opportunities</p>
                </div>
            </div>
            <div class="ee-btn">
                <a href="/membership" class="btn btn-secondary custom-btn">
                    Join Now
                    <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
                    </svg>
                </a>
                <a href="/events" class="btn btn-secondary custom-btn">
                    Learn More
                    <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
<div class="special-design container">
    <hr/>
    <img src="{{ asset('new_ui/assets/images/diamond.webp') }}">
    <div class="vertical-line"></div>
</div>
<section class="more-section">
    <div class="container">
        <h3>There’s more to it</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="more-box">
                    <img src="{{ asset('new_ui/assets/images/more1.webp') }}">
                    <div>
                        <h4>Special Networking Evenings</h4>
                        <p>Meet top buyers, collectors, influencers, and professionals from across the gems, jewellery, allied industries, and service sectors in a friendly, welcoming setting. These special evenings are perfect for making new connections, sharing ideas, and finding fresh business opportunities.</p>
                        <a href="/events">View more 
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="15" viewBox="0 0 10 15" fill="none">
                                <path d="M9.08036 7.59818L2.45536 14.2232C2.34226 14.3363 2.20833 14.3928 2.05357 14.3928C1.89881 14.3928 1.76488 14.3363 1.65179 14.2232L0.169643 12.741C0.0565476 12.6279 0 12.494 0 12.3393C0 12.1845 0.0565476 12.0506 0.169643 11.9375L4.91071 7.19639L0.169643 2.45532C0.0565476 2.34223 0 2.2083 0 2.05354C0 1.89877 0.0565476 1.76485 0.169643 1.65175L1.65179 0.169607C1.76488 0.0565119 1.89881 -3.52859e-05 2.05357 -3.52859e-05C2.20833 -3.52859e-05 2.34226 0.0565119 2.45536 0.169607L9.08036 6.79461C9.19345 6.9077 9.25 7.04163 9.25 7.19639C9.25 7.35116 9.19345 7.48508 9.08036 7.59818Z"  fill="#254B59"/> <!--#0000E7-->
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="15" viewBox="0 0 10 15" fill="none">
                                <path d="M9.08036 7.59818L2.45536 14.2232C2.34226 14.3363 2.20833 14.3928 2.05357 14.3928C1.89881 14.3928 1.76488 14.3363 1.65179 14.2232L0.169643 12.741C0.0565476 12.6279 0 12.494 0 12.3393C0 12.1845 0.0565476 12.0506 0.169643 11.9375L4.91071 7.19639L0.169643 2.45532C0.0565476 2.34223 0 2.2083 0 2.05354C0 1.89877 0.0565476 1.76485 0.169643 1.65175L1.65179 0.169607C1.76488 0.0565119 1.89881 -3.52859e-05 2.05357 -3.52859e-05C2.20833 -3.52859e-05 2.34226 0.0565119 2.45536 0.169607L9.08036 6.79461C9.19345 6.9077 9.25 7.04163 9.25 7.19639C9.25 7.35116 9.19345 7.48508 9.08036 7.59818Z" fill="#254B59"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="more-box">
                    <img src="{{ asset('new_ui/assets/images/more2.webp') }}">
                    <div>
                        <h4>Intimate Artist Meet-and-Greets</h4>
                        <p>Build meaningful connections and gain insights from the experiences and wisdom of established experts.</p>
                        <a href="/events">View more 
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="15" viewBox="0 0 10 15" fill="none">
                                <path d="M9.08036 7.59818L2.45536 14.2232C2.34226 14.3363 2.20833 14.3928 2.05357 14.3928C1.89881 14.3928 1.76488 14.3363 1.65179 14.2232L0.169643 12.741C0.0565476 12.6279 0 12.494 0 12.3393C0 12.1845 0.0565476 12.0506 0.169643 11.9375L4.91071 7.19639L0.169643 2.45532C0.0565476 2.34223 0 2.2083 0 2.05354C0 1.89877 0.0565476 1.76485 0.169643 1.65175L1.65179 0.169607C1.76488 0.0565119 1.89881 -3.52859e-05 2.05357 -3.52859e-05C2.20833 -3.52859e-05 2.34226 0.0565119 2.45536 0.169607L9.08036 6.79461C9.19345 6.9077 9.25 7.04163 9.25 7.19639C9.25 7.35116 9.19345 7.48508 9.08036 7.59818Z" fill="#254B59"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="15" viewBox="0 0 10 15" fill="none">
                                <path d="M9.08036 7.59818L2.45536 14.2232C2.34226 14.3363 2.20833 14.3928 2.05357 14.3928C1.89881 14.3928 1.76488 14.3363 1.65179 14.2232L0.169643 12.741C0.0565476 12.6279 0 12.494 0 12.3393C0 12.1845 0.0565476 12.0506 0.169643 11.9375L4.91071 7.19639L0.169643 2.45532C0.0565476 2.34223 0 2.2083 0 2.05354C0 1.89877 0.0565476 1.76485 0.169643 1.65175L1.65179 0.169607C1.76488 0.0565119 1.89881 -3.52859e-05 2.05357 -3.52859e-05C2.20833 -3.52859e-05 2.34226 0.0565119 2.45536 0.169607L9.08036 6.79461C9.19345 6.9077 9.25 7.04163 9.25 7.19639C9.25 7.35116 9.19345 7.48508 9.08036 7.59818Z" fill="#254B59"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="more-box">
                    <img src="{{ asset('new_ui/assets/images/more3.webp') }}">
                    <div>
                        <h4>Network at Digital Conferences</h4>
                        <p>Join digital conferences to connect, learn new skills, and stay updated on the latest trends in digital marketing, e-commerce, and business growth. Expand your network and knowledge with peers and experts from around the world.</p>
                        <a href="/events">View more 
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="15" viewBox="0 0 10 15" fill="none">
                                <path d="M9.08036 7.59818L2.45536 14.2232C2.34226 14.3363 2.20833 14.3928 2.05357 14.3928C1.89881 14.3928 1.76488 14.3363 1.65179 14.2232L0.169643 12.741C0.0565476 12.6279 0 12.494 0 12.3393C0 12.1845 0.0565476 12.0506 0.169643 11.9375L4.91071 7.19639L0.169643 2.45532C0.0565476 2.34223 0 2.2083 0 2.05354C0 1.89877 0.0565476 1.76485 0.169643 1.65175L1.65179 0.169607C1.76488 0.0565119 1.89881 -3.52859e-05 2.05357 -3.52859e-05C2.20833 -3.52859e-05 2.34226 0.0565119 2.45536 0.169607L9.08036 6.79461C9.19345 6.9077 9.25 7.04163 9.25 7.19639C9.25 7.35116 9.19345 7.48508 9.08036 7.59818Z" fill="#254B59"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="15" viewBox="0 0 10 15" fill="none">
                                <path d="M9.08036 7.59818L2.45536 14.2232C2.34226 14.3363 2.20833 14.3928 2.05357 14.3928C1.89881 14.3928 1.76488 14.3363 1.65179 14.2232L0.169643 12.741C0.0565476 12.6279 0 12.494 0 12.3393C0 12.1845 0.0565476 12.0506 0.169643 11.9375L4.91071 7.19639L0.169643 2.45532C0.0565476 2.34223 0 2.2083 0 2.05354C0 1.89877 0.0565476 1.76485 0.169643 1.65175L1.65179 0.169607C1.76488 0.0565119 1.89881 -3.52859e-05 2.05357 -3.52859e-05C2.20833 -3.52859e-05 2.34226 0.0565119 2.45536 0.169607L9.08036 6.79461C9.19345 6.9077 9.25 7.04163 9.25 7.19639C9.25 7.35116 9.19345 7.48508 9.08036 7.59818Z" fill="#254B59"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <a href="/membership" class="btn btn-secondary custom-btn mx-auto d-block mx-2 mt-1">
                    Join Now
                    <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
                    </svg>
                </a>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>
<div class="special-design container">
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
<section class="contact-us">
    <div class="container">
        <div class="special-design container">
            <hr/>
            <img src="{{ asset('new_ui/assets/images/diamond.webp') }}">
            <div class="vertical-line"></div>
        </div>
        <div class="form-box">
            <div class="form-heading">Leave us a message, and we will respond.</div>
            <div class="contact-form-area">
                <div class="area-left">
                    <form class="" id="contactForm">
                        <div class="row">
                            <div class="col-md-6 mb-1">
                                <label class="form-label required">First Name</label>
                                <input type="text" class="form-control" name="first_name" placeholder="Enter first name">
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label required">Last Name</label>
                                <input type="text" class="form-control" name="last_name" placeholder="Enter last name">
                            </div>
                            <div class="col-md-12 mb-1">
                                <label class="form-label required">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter your email">
                            </div>
                            <div class="col-md-12 mb-1">
                                <label class="form-label required">Mobile Number</label>
                                <input type="text" class="form-control" name="phone" placeholder="Enter your phone number">
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label">Country</label>
                                <input type="text" class="form-control" name="country" placeholder="Enter your country">
                            </div>
                            <div class="col-md-6 mb-1">
                                <label class="form-label ">Company</label>
                                <input type="text" class="form-control" name="company_name" placeholder="Enter your company name">
                            </div>
                            <div class="col-md-12 mb-1">
                                <label class="form-label">Your Message</label>
                                <textarea class="form-control" name="message" rows="3" placeholder="Enter your message"></textarea>
                            </div>
                            <!-- ✅ CAPTCHA Section -->
                            <div class="col-md-12 mb-1">
                                <label class="form-label required">CAPTCHA</label>
                                <div class="captcha-container">
                                    <div class="me-2 w-100">
                                        <input type="text" name="captcha" class="form-control" placeholder="Enter code above" required>
                                    </div>
                                    <div class="me-2 w-100 d-flex align-items-center">
                                        <img src="{{ captcha_src('flat') }}" class="captchaImg" style="cursor:pointer; height:40px;">
                                        <i class="bi bi-arrow-clockwise reloadCaptcha"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-1">
                                <button type="submit" class="btn btn-secondary custom-btn mt-2 w-100">
                                    Submit
                                    <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="area-right">
                    <img src="{{ asset('new_ui/assets/images/be-ceen-gold.webp') }}" class="w-100 p-5"/>
                    <img src="{{ asset('new_ui/assets/images/enquiry-img.webp') }}" class="w-100"/>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- END: Content-->
@endsection

@section('script')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="{{ asset('new_ui/assets/js/admin/custom-image-uploader.js') }}?v={{ time() }}"></script>
<script src="{{ asset('new_ui/assets/js/frontend/contact-us.js') }}?v={{ time() }}"></script>

@endsection