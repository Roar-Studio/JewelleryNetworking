@extends('frontend.layouts.master')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('new_ui/assets/css/events.css') }}?v={{ time() }}">
<style>
    .list-view .fc-view-harness {
        height: unset !important;
    }
    .list-view.fc .fc-view-harness-active > .fc-view{
        position: unset !important;
    }
    .fc .fc-list-empty-cushion{
        margin: 1em 0;
    }
    .fc .fc-list-event:hover td{
        background: #fff
    }
    .view-toggle {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    .custom-event-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
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
            <img src="{{ asset('new_ui/assets/images/event_header.webp') }}" class="d-block w-100 desktop_view" alt="carousel image">
            <img src="{{ asset('new_ui/assets/images/events_mobile_banner.webp') }}" class="d-block w-100 mobile_view" alt="carousel image">
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
                <path d="M 44.898438 14.5 C 44.5 12.300781 42.601563 10.699219 40.398438 10.199219 C 37.101563 9.5 31 9 24.398438 9 C 17.800781 9 11.601563 9.5 8.300781 10.199219 C 6.101563 10.699219 4.199219 12.199219 3.800781 14.5 C 3.398438 17 3 20.5 3 25 C 3 29.5 3.398438 33 3.898438 35.5 C 4.300781 37.699219 6.199219 39.300781 8.398438 39.800781 C 11.898438 40.5 17.898438 41 24.5 41 C 31.101563 41 37.101563 40.5 40.601563 39.800781 C 42.800781 39.300781 44.699219 37.800781 45.101563 35.5 C 45.5 33 46 29.398438 46.101563 25 C 45.898438 20.5 45.398438 17 44.898438 14.5 Z M 19 32 L 19 18 L 31.199219 25 Z" fill="#264C5A"></path>
            </svg>
        </a>
    </div>
</div>

<div class="container">
    <h1 class="main-page-title">Exclusive Events</h1>
</div>

<div class="special-design container mt-2">
    <hr/>
    <img src="{{ asset('new_ui/assets/images/diamond.webp') }}">
    <div class="vertical-line"></div>
</div>
<section class="event-header-section">
    <div class="container">
        <h3>Check our Exclusive Events</h3>
        <p>Join our exclusive Jewellery Networking events to connect with industry leaders, learn from expert workshops, showcase your work, and discover the latest trends. Whether you want to grow your network or your brand, our events offer the perfect chance to boost your career and business in the gems, jewellery and allied industry. Don’t miss out-these unparelled experieneces and events designed to inspire and empower you!</p>
    </div>
</section>
<section class="currency-toggle" style="display:none;">
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
<section class="filter container">
    <div class="search-input mt-3 mb-1">
        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
            <path d="M22 21.8799L16.925 16.8049M19.6667 10.2132C19.6667 15.3679 15.488 19.5465 10.3333 19.5465C5.17868 19.5465 1 15.3679 1 10.2132C1 5.05856 5.17868 0.879883 10.3333 0.879883C15.488 0.879883 19.6667 5.05856 19.6667 10.2132Z" stroke="#254B5A" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <input type="text" id="searchInput" placeholder="Search for Events" class="form-control">
    </div>
    <div class="upcoming-past">
        <button id="showAll" class="btn btn-primary custom-btn">All</button>
        <button id="showUpcoming" class="btn btn-secondary custom-btn">Upcoming Events</button>
        <button id="showPast" class="btn btn-secondary custom-btn">Past Events</button>
    </div>
    <div class="view-toggle">
        <button id="viewList" class="btn btn-primary custom-btn">List</button>
        <button id="viewMonth" class="btn btn-secondary custom-btn">Month</button>
    </div>
</section>
<section class="container">
    <div id="calendar" class="list-view"></div>
</section>
<!-- <div class="container">
    <div class="event-card">
        <div class="left-date-display">
            <img src="{{ asset('new_ui/assets/images/calendar2.svg') }}" alt="Event Date Icon">
            <p class="fees">Fees<br/><span class="rs-sign">&#8377;</span><span class="amount">4,999/-</span></p>
            <div class="date-info">
                <span class="month">MAY</span>
                <span class="day">20</span>
                <span class="year">2025</span>
            </div>
        </div>
        <div class="event-details">
            <h1 class="event-title">How to use AI: Masterclass for the Jewellery Industry with an Expert from Microsoft</h1>
            <div class="event-description">
                <p>Bharat Ratnam– Mega Common Facilitation Centre Diamond Conference Room 6th Floor, Bharat Ratnam– Mega Common Facilitation Centre, Gate No. 4 &amp; 5, SEEPZ Special Economic Zone, Andheri (E), Mumbai</p>
                <p>An interactive session with Chinmay Gavankar, Director of Data &amp; Artificial Intelligence at Microsoft India, for an insightful session on, 1. Types of AI 2. Use of AI in the jewellery sector 3. How to use Generative AI This event can be attended offline (in person) and online via Zoom. To register, please fill the […]</p>
            </div>
            <div class="event-timing">
                <div>
                    <h2 class="timing-title">Event Start Date &amp; Time:</h2>
                    <div class="date-display-small">
                        <label>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <g clip-path="url(#clip0_1701_25520)">
                                    <path d="M13.6689 0.5C13.6881 0.5 13.7079 0.507743 13.7246 0.524414C13.7412 0.541067 13.749 0.560995 13.749 0.580078V2.37012H14.333L14.3232 2.37988H15.5303C16.6016 2.38009 17.4794 3.25088 17.4795 4.3291V10.875C17.4794 10.8941 17.4717 10.9141 17.4551 10.9307C17.4386 10.9469 17.4192 10.954 17.4004 10.9541C17.3814 10.9541 17.3613 10.9471 17.3447 10.9307C17.3281 10.914 17.3204 10.8941 17.3203 10.875V6.2793H0.658203V15.541C0.658331 16.5277 1.46157 17.331 2.44824 17.3311H7.13281C7.15193 17.3311 7.17181 17.3388 7.18848 17.3555C7.20514 17.3721 7.21289 17.392 7.21289 17.4111C7.21283 17.4302 7.20508 17.4502 7.18848 17.4668C7.17185 17.4833 7.15185 17.4902 7.13281 17.4902H2.45801C1.38649 17.4902 0.50794 16.6194 0.507812 15.541V4.32031C0.507812 3.24872 1.37955 2.37012 2.45801 2.37012H4.24805V0.580078C4.24805 0.560967 4.2558 0.541082 4.27246 0.524414C4.28913 0.507743 4.30901 0.5 4.32812 0.5C4.34714 0.500082 4.36721 0.507834 4.38379 0.524414C4.40023 0.541016 4.40723 0.561087 4.40723 0.580078V2.37012H13.5898V0.580078C13.5898 0.561059 13.5968 0.541032 13.6133 0.524414C13.6299 0.507791 13.6499 0.500043 13.6689 0.5ZM2.45801 2.5293C1.47122 2.5293 0.666992 3.33352 0.666992 4.32031V6.11035H17.3389V4.32031C17.3389 3.3336 16.5355 2.52943 15.5488 2.5293H2.45801Z" fill="black" stroke="black"/>
                                    <path d="M15.5488 13.5898C15.5618 13.5899 15.5734 13.5918 15.583 13.5957L15.6064 13.6113L17.4766 15.4814C17.4889 15.4938 17.498 15.5141 17.498 15.54C17.498 15.553 17.4962 15.5645 17.4922 15.5742L17.4766 15.5977L15.6064 17.4678C15.5942 17.48 15.5746 17.4892 15.5488 17.4893C15.536 17.4893 15.5243 17.4873 15.5146 17.4834L15.4902 17.4678C15.4781 17.4555 15.4688 17.4358 15.4688 17.4102C15.4688 17.3973 15.4708 17.3856 15.4746 17.376L15.4902 17.3516L16.9492 15.8936L17.3027 15.54L15.4902 13.7275C15.4781 13.7153 15.4688 13.6956 15.4688 13.6699C15.4688 13.6571 15.4708 13.6454 15.4746 13.6357L15.4902 13.6113C15.5025 13.599 15.5229 13.5898 15.5488 13.5898Z" fill="black" stroke="black"/>
                                    <path d="M10.877 13.5898C10.8899 13.5899 10.9015 13.5918 10.9111 13.5957L10.9346 13.6113L12.8047 15.4814C12.817 15.4938 12.8262 15.5141 12.8262 15.54C12.8261 15.553 12.8243 15.5645 12.8203 15.5742L12.8047 15.5977L10.9346 17.4678C10.9223 17.48 10.9027 17.4892 10.877 17.4893C10.8641 17.4893 10.8524 17.4873 10.8428 17.4834L10.8184 17.4678C10.8062 17.4555 10.797 17.4358 10.7969 17.4102C10.7969 17.3973 10.7989 17.3856 10.8027 17.376L10.8184 17.3516L12.2773 15.8936L12.6309 15.54L10.8184 13.7275C10.8062 13.7153 10.797 13.6956 10.7969 13.6699C10.7969 13.6571 10.7989 13.6454 10.8027 13.6357L10.8184 13.6113C10.8307 13.599 10.851 13.5898 10.877 13.5898Z" fill="black" stroke="black"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1701_25520">
                                    <rect width="18" height="18" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            <span>Thu, 20 May 2025</span>
                        </label>
                        <label>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <g clip-path="url(#clip0_1701_25537)">
                                    <path d="M8.82701 0C3.95532 0 0 3.95532 0 8.82701C0 13.6987 3.95532 17.654 8.82701 17.654C13.6987 17.654 17.654 13.6987 17.654 8.82701C17.654 3.95532 13.6894 0 8.82701 0ZM8.82701 16.5132C4.58182 16.5132 1.13143 13.0629 1.13143 8.81766C1.13143 4.57247 4.58182 1.13143 8.82701 1.13143C13.0722 1.13143 16.5226 4.58182 16.5226 8.82701C16.5226 13.0722 13.0722 16.5226 8.82701 16.5226V16.5132Z" fill="black"/>
                                    <path d="M8.82666 3.60938C8.51809 3.60938 8.26562 3.86184 8.26562 4.17041V8.81769C8.29368 9.0234 8.37783 9.15431 8.5742 9.33197L11.3607 12.1278C11.5758 12.3429 11.9498 12.3429 12.1648 12.1278C12.2677 12.025 12.3332 11.8753 12.3332 11.7257C12.3332 11.5761 12.2771 11.4265 12.1648 11.3237L9.39705 8.55587V4.17041C9.39705 3.86184 9.14459 3.60938 8.83601 3.60938H8.82666Z" fill="black"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1701_25537">
                                    <rect width="17.6447" height="17.6447" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            <span>2:00 pm IST</span>
                        </label>
                    </div>
                </div>
                <div>
                    <h2 class="timing-title">Event End Date &amp; Time:</h2>
                    <div class="date-display-small">
                        <label>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <g clip-path="url(#clip0_1701_25520)">
                                    <path d="M13.6689 0.5C13.6881 0.5 13.7079 0.507743 13.7246 0.524414C13.7412 0.541067 13.749 0.560995 13.749 0.580078V2.37012H14.333L14.3232 2.37988H15.5303C16.6016 2.38009 17.4794 3.25088 17.4795 4.3291V10.875C17.4794 10.8941 17.4717 10.9141 17.4551 10.9307C17.4386 10.9469 17.4192 10.954 17.4004 10.9541C17.3814 10.9541 17.3613 10.9471 17.3447 10.9307C17.3281 10.914 17.3204 10.8941 17.3203 10.875V6.2793H0.658203V15.541C0.658331 16.5277 1.46157 17.331 2.44824 17.3311H7.13281C7.15193 17.3311 7.17181 17.3388 7.18848 17.3555C7.20514 17.3721 7.21289 17.392 7.21289 17.4111C7.21283 17.4302 7.20508 17.4502 7.18848 17.4668C7.17185 17.4833 7.15185 17.4902 7.13281 17.4902H2.45801C1.38649 17.4902 0.50794 16.6194 0.507812 15.541V4.32031C0.507812 3.24872 1.37955 2.37012 2.45801 2.37012H4.24805V0.580078C4.24805 0.560967 4.2558 0.541082 4.27246 0.524414C4.28913 0.507743 4.30901 0.5 4.32812 0.5C4.34714 0.500082 4.36721 0.507834 4.38379 0.524414C4.40023 0.541016 4.40723 0.561087 4.40723 0.580078V2.37012H13.5898V0.580078C13.5898 0.561059 13.5968 0.541032 13.6133 0.524414C13.6299 0.507791 13.6499 0.500043 13.6689 0.5ZM2.45801 2.5293C1.47122 2.5293 0.666992 3.33352 0.666992 4.32031V6.11035H17.3389V4.32031C17.3389 3.3336 16.5355 2.52943 15.5488 2.5293H2.45801Z" fill="black" stroke="black"/>
                                    <path d="M15.5488 13.5898C15.5618 13.5899 15.5734 13.5918 15.583 13.5957L15.6064 13.6113L17.4766 15.4814C17.4889 15.4938 17.498 15.5141 17.498 15.54C17.498 15.553 17.4962 15.5645 17.4922 15.5742L17.4766 15.5977L15.6064 17.4678C15.5942 17.48 15.5746 17.4892 15.5488 17.4893C15.536 17.4893 15.5243 17.4873 15.5146 17.4834L15.4902 17.4678C15.4781 17.4555 15.4688 17.4358 15.4688 17.4102C15.4688 17.3973 15.4708 17.3856 15.4746 17.376L15.4902 17.3516L16.9492 15.8936L17.3027 15.54L15.4902 13.7275C15.4781 13.7153 15.4688 13.6956 15.4688 13.6699C15.4688 13.6571 15.4708 13.6454 15.4746 13.6357L15.4902 13.6113C15.5025 13.599 15.5229 13.5898 15.5488 13.5898Z" fill="black" stroke="black"/>
                                    <path d="M10.877 13.5898C10.8899 13.5899 10.9015 13.5918 10.9111 13.5957L10.9346 13.6113L12.8047 15.4814C12.817 15.4938 12.8262 15.5141 12.8262 15.54C12.8261 15.553 12.8243 15.5645 12.8203 15.5742L12.8047 15.5977L10.9346 17.4678C10.9223 17.48 10.9027 17.4892 10.877 17.4893C10.8641 17.4893 10.8524 17.4873 10.8428 17.4834L10.8184 17.4678C10.8062 17.4555 10.797 17.4358 10.7969 17.4102C10.7969 17.3973 10.7989 17.3856 10.8027 17.376L10.8184 17.3516L12.2773 15.8936L12.6309 15.54L10.8184 13.7275C10.8062 13.7153 10.797 13.6956 10.7969 13.6699C10.7969 13.6571 10.7989 13.6454 10.8027 13.6357L10.8184 13.6113C10.8307 13.599 10.851 13.5898 10.877 13.5898Z" fill="black" stroke="black"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1701_25520">
                                    <rect width="18" height="18" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            <span>Thu, 20 May 2025</span>
                        </label>
                        <label>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <g clip-path="url(#clip0_1701_25537)">
                                    <path d="M8.82701 0C3.95532 0 0 3.95532 0 8.82701C0 13.6987 3.95532 17.654 8.82701 17.654C13.6987 17.654 17.654 13.6987 17.654 8.82701C17.654 3.95532 13.6894 0 8.82701 0ZM8.82701 16.5132C4.58182 16.5132 1.13143 13.0629 1.13143 8.81766C1.13143 4.57247 4.58182 1.13143 8.82701 1.13143C13.0722 1.13143 16.5226 4.58182 16.5226 8.82701C16.5226 13.0722 13.0722 16.5226 8.82701 16.5226V16.5132Z" fill="black"/>
                                    <path d="M8.82666 3.60938C8.51809 3.60938 8.26562 3.86184 8.26562 4.17041V8.81769C8.29368 9.0234 8.37783 9.15431 8.5742 9.33197L11.3607 12.1278C11.5758 12.3429 11.9498 12.3429 12.1648 12.1278C12.2677 12.025 12.3332 11.8753 12.3332 11.7257C12.3332 11.5761 12.2771 11.4265 12.1648 11.3237L9.39705 8.55587V4.17041C9.39705 3.86184 9.14459 3.60938 8.83601 3.60938H8.82666Z" fill="black"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1701_25537">
                                    <rect width="17.6447" height="17.6447" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            <span>2:00 pm IST</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="event-btns">
                <div>
                    <button class="btn btn-primary custom-btn w-100">Register Now</button>
                    <p class="registration-start-date">Registration Starts On: <span>Mon, 19 May 2025</span></p>
                </div>
                <button class="btn btn-secondary custom-btn">Seats Available(20)</button>
                <a href="#">Know more</a>
                <a href="#">Terms & Conditions</a>
            </div>
        </div>
        <div class="event-banner">
            <img src="{{ asset('new_ui/assets/images/event-banner.png') }}" alt="Event Banner">
        </div>
    </div>
</div> -->

<div class="special-design container mt-2">
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
<!-- <script src="{{ asset('new_ui/assets/js/admin/customer/index.js') }}?v={{ time() }}"></script> -->
<script src="{{ asset('new_ui/assets/js/admin/custom-image-uploader.js') }}?v={{ time() }}"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
    


let calendar;
let allEvents = [];
let filterType = 'all';
let currentView = 'list'; // 'list' or 'month'

async function fetchAllEvents() {
    console.log("Fetching all events");
    try {
        const startDate = new Date('2020-01-01');
        const endDate = new Date('2030-12-31');
        
        const response = await window.axiosApiClient.post('/get-events', {
            start_date: startDate.toISOString(),
            end_date: endDate.toISOString()
        });
        
        const events = response.data.data;
        
        const mappedEvents = events.map(ev => {
            return {
                id: ev.id,
                title: ev.name || 'Untitled',
                start: moment(ev.event_start_datetime).format('YYYY-MM-DDTHH:mm:ss'),
                end: moment(ev.event_end_datetime).format('YYYY-MM-DDTHH:mm:ss'),
                description: ev.description || '',
                event_start_day_number: ev.event_start_datetime ? moment(ev.event_start_datetime).format('DD') : '',
                event_start_month: ev.event_start_datetime ? moment(ev.event_start_datetime).format('MMM') : '',
                event_start_year: ev.event_start_datetime ? moment(ev.event_start_datetime).format('YYYY') : '',
                event_start_date: ev.event_start_datetime ? moment(ev.event_start_datetime).format('ddd, DD MMM YYYY') : '',
                event_start_time: ev.event_start_datetime ? moment(ev.event_start_datetime).format('hh:mm a') : '',
                event_end_date: ev.event_end_datetime ? moment(ev.event_end_datetime).format('ddd, DD MMM YYYY') : '',
                event_end_time: ev.event_end_datetime ? moment(ev.event_end_datetime).format('hh:mm a') : '',
                event_type: ev.event_type,
                event_mode: ev.event_mode,
                currency_type: ev.currency_type,
                venue_address: ev.venue_address || '',
                total_seats: ev.total_seats || 0,
                display_start_date: ev.display_start_date ? moment(ev.display_start_date).format('ddd, DD MMM YYYY') : '',
                display_end_date: ev.display_end_date ? moment(ev.display_end_date).format('ddd, DD MMM YYYY') : '',
                amount_in_inr: ev.amount_in_inr || 0,
                amount_in_usd: ev.amount_in_usd || 0,
                completed_transaction_count: ev.completed_transaction_count || 0,
                banner: ev.banner || 'https://via.placeholder.com/300x100?text=Event'
            };
        });
        
        console.log("Fetched all events:", mappedEvents);
        return mappedEvents;
    } catch (error) {
        console.error("Error fetching events:", error);
        return [];
    }
}

function getFilteredEvents() {
    const search = $('#searchInput').val().toLowerCase();
    const now = moment();

    let filtered = allEvents.filter(ev => {
        const start = moment(ev.start);

        if (filterType === 'upcoming' && start.isBefore(now, 'day')) return false;
        if (filterType === 'past' && start.isSameOrAfter(now, 'day')) return false;

        if (search && !ev.title.toLowerCase().includes(search)) return false;

        return true;
    });

    return filtered;
}

function renderEventCard(e) {
    const { selectedCurrencyCode } = getSelectedCurrency();
    
    const calendarSVG = `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"><g clip-path="url(#clip0)"><path d="M13.6689 0.5C13.6881 0.5 13.7079 0.507743 13.7246 0.524414C13.7412 0.541067 13.749 0.560995 13.749 0.580078V2.37012H14.333L14.3232 2.37988H15.5303C16.6016 2.38009 17.4794 3.25088 17.4795 4.3291V10.875C17.4794 10.8941 17.4717 10.9141 17.4551 10.9307C17.4386 10.9469 17.4192 10.954 17.4004 10.9541C17.3814 10.9541 17.3613 10.9471 17.3447 10.9307C17.3281 10.914 17.3204 10.8941 17.3203 10.875V6.2793H0.658203V15.541C0.658331 16.5277 1.46157 17.331 2.44824 17.3311H7.13281C7.15193 17.3311 7.17181 17.3388 7.18848 17.3555C7.20514 17.3721 7.21289 17.392 7.21289 17.4111C7.21283 17.4302 7.20508 17.4502 7.18848 17.4668C7.17185 17.4833 7.15185 17.4902 7.13281 17.4902H2.45801C1.38649 17.4902 0.50794 16.6194 0.507812 15.541V4.32031C0.507812 3.24872 1.37955 2.37012 2.45801 2.37012H4.24805V0.580078C4.24805 0.560967 4.2558 0.541082 4.27246 0.524414C4.28913 0.507743 4.30901 0.5 4.32812 0.5C4.34714 0.500082 4.36721 0.507834 4.38379 0.524414C4.40023 0.541016 4.40723 0.561087 4.40723 0.580078V2.37012H13.5898V0.580078C13.5898 0.561059 13.5968 0.541032 13.6133 0.524414C13.6299 0.507791 13.6499 0.500043 13.6689 0.5ZM2.45801 2.5293C1.47122 2.5293 0.666992 3.33352 0.666992 4.32031V6.11035H17.3389V4.32031C17.3389 3.3336 16.5355 2.52943 15.5488 2.5293H2.45801Z" fill="black" stroke="black"/></g></svg>`;
    
    const clockSVG = `<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"><g clip-path="url(#clip0)"><path d="M8.82701 0C3.95532 0 0 3.95532 0 8.82701C0 13.6987 3.95532 17.654 8.82701 17.654C13.6987 17.654 17.654 13.6987 17.654 8.82701C17.654 3.95532 13.6894 0 8.82701 0ZM8.82701 16.5132C4.58182 16.5132 1.13143 13.0629 1.13143 8.81766C1.13143 4.57247 4.58182 1.13143 8.82701 1.13143C13.0722 1.13143 16.5226 4.58182 16.5226 8.82701C16.5226 13.0722 13.0722 16.5226 8.82701 16.5226V16.5132Z" fill="black"/><path d="M8.82666 3.60938C8.51809 3.60938 8.26562 3.86184 8.26562 4.17041V8.81769C8.29368 9.0234 8.37783 9.15431 8.5742 9.33197L11.3607 12.1278C11.5758 12.3429 11.9498 12.3429 12.1648 12.1278C12.2677 12.025 12.3332 11.8753 12.3332 11.7257C12.3332 11.5761 12.2771 11.4265 12.1648 11.3237L9.39705 8.55587V4.17041C9.39705 3.86184 9.14459 3.60938 8.83601 3.60938H8.82666Z" fill="black"/></g></svg>`;
    
    const eventEndDateHTML = e.event_end_date ? `<div>
        <h2 class="timing-title">Event End Date &amp; Time:</h2>
        <div class="date-display-small">
            <label>${calendarSVG}<span>${e.event_end_date}</span></label>
            <label>${clockSVG}<span>${e.event_end_time} IST</span></label>
        </div>
    </div>` : '';
    
    const registrationStart = moment(e.display_start_date).startOf('day');
    const registrationEnd = moment(e.display_end_date).endOf('day');
    const EventEndDate = moment(e.event_end_date).startOf('day');
    
    const today = moment();
    const isRegistrationOpen = today.isBetween(registrationStart, registrationEnd, undefined, '[]');
    const isUpcoming = today.isBefore(registrationStart);
    const isEventOver = today.isAfter(EventEndDate, 'day');
    const totalSeats = parseInt(e.total_seats) || 0;
    const completed = parseInt(e.completed_transaction_count) || 0;
    const availableSeats = totalSeats - completed;

    const eventType = e.event_type == 'paid' 
        ? `<p class="fees">Fees<br/><span class="rs-sign">${selectedCurrencyCode === 'INR' ? '&#8377;' : '$'}</span><span class="amount">${selectedCurrencyCode === 'INR' ? convertCurrencyWithoutSymbol(e.amount_in_inr, 'INR', 0) : convertCurrencyWithoutSymbol(e.amount_in_usd, 'USD', 0)}/-</span></p>`
        : `<p class="fees">Free<br/><b>Entry</b></p>`;

    const btns = `<div class="event-btns mt-1">
        ${
            isUpcoming
                ? `<div>
                        <button class="btn btn-primary custom-btn w-100" disabled>Register Now</button>
                        <p class="registration-start-date">Registration Starts On: <span>${e.display_start_date}</span></p>
                    </div>
                    <button class="btn btn-light custom-btn" disabled>Coming Soon</button>`
                : (
                    isRegistrationOpen
                        ? `<div>
                                ${availableSeats > 0 
                                    ? `<a href="/order-summary?product_type=event&event_id=${e.id}" class="btn btn-primary custom-btn w-100">Register Now</a>`
                                    : `<button class="btn btn-primary custom-btn w-100" disabled>Register Now</button>`
                                }
                                <p class="registration-start-date">Registration Starts On: <span>${e.display_start_date}</span></p>
                            </div>
                            ${
                                availableSeats > 0
                                    ? `<a href="/order-summary?product_type=event&event_id=${e.id}" class="btn btn-secondary custom-btn">Seats Available (${availableSeats})</a>`
                                    : `<button class="btn btn-light custom-btn" disabled>Event is fully booked,<br/> stay tuned</button>`
                            }`
                        : `<button class="btn btn-light custom-btn m-0" disabled>Registration Closed</button>`
                )
        }
        <div class="d-flex align-items-center gap-3 justify-content-center">
        <a href="/event/${e.id}">Know more</a>
        <a href="/term-and-conditions">Terms & Conditions</a>
        </div>
        
    </div>`;

    return `
        <div class="event-card ${isEventOver ? 'closed' : ''}">
            <div class="left-date-display">
                <img src="{{ asset('new_ui/assets/images/calendar2.svg') }}" alt="Event Date Icon">
                ${isRegistrationOpen && totalSeats > 0 ? eventType : ''}
                <div class="date-info">
                    <span class="month">${e.event_start_month}</span>
                    <span class="day">${e.event_start_day_number}</span>
                    <span class="year">${e.event_start_year}</span>
                </div>
            </div>
            <div class="event-details">
                <h1 class="event-title">${e.title}</h1>
                <div class="event-description">
                    <p>${e.description}</p>
                </div>
                <div class="event-timing">
                    <div>
                        <h2 class="timing-title">Event Start Date &amp; Time:</h2>
                        <div class="date-display-small">
                            <label>${calendarSVG}<span>${e.event_start_date}</span></label>
                            <label>${clockSVG}<span>${e.event_start_time} IST</span></label>
                        </div>
                    </div>
                    ${eventEndDateHTML}
                </div>
                ${btns}
            </div>
            <div class="event-banner">
                <img src="${e.banner ? APP_URL + '/storage/' + e.banner : ""}" alt="Event Banner">
            </div>
        </div>
    `;
}

function renderCustomList() {
    // First destroy calendar if exists
    if (calendar) {
        calendar.destroy();
        calendar = null;
    }
    
    // Clear everything from calendar div
    $('#calendar').empty();
    $('#calendar').removeClass('month-view fc fc-media-screen fc-direction-ltr fc-theme-standard').addClass('list-view');

    const filtered = getFilteredEvents();
    
    const emptySVG = `<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none"><g clip-path="url(#clip0_1701_18823)"><path d="M17.3412 8.81152L17.9676 9.62007V16.6416C17.9676 17.5719 17.2136 18.3258 16.2834 18.3258H6.71545C5.78519 18.3258 5.03125 17.5719 5.03125 16.6416V9.62007L5.73892 8.81152H17.3413H17.3412Z" fill="#D6D6D6"/><path d="M17.9677 7.07385V9.62024H5.03125V7.07385C5.03125 6.14359 5.78519 5.38965 6.71545 5.38965H16.2834C17.2136 5.38965 17.9676 6.14359 17.9676 7.07385H17.9677Z" fill="#724848"/><path d="M22.0961 7.02361C21.5169 5.65412 20.6877 4.42428 19.6317 3.36841C18.5757 2.31239 17.3459 1.48328 15.9765 0.904004C14.5584 0.30416 13.0523 0 11.5 0C9.94766 0 8.44159 0.30416 7.02347 0.904004C5.65399 1.48328 4.42415 2.31239 3.36827 3.36841C2.31226 4.42442 1.48314 5.65412 0.903865 7.02361C0.30416 8.44172 0 9.9478 0 11.5C0 13.0522 0.30416 14.5584 0.904004 15.9765C1.48328 17.346 2.31239 18.5759 3.36841 19.6317C4.42442 20.6877 5.65426 21.5169 7.02361 22.0961C8.44173 22.696 9.9478 23.0001 11.5001 23.0001C13.0525 23.0001 14.5586 22.696 15.9767 22.0961C17.3462 21.5169 18.576 20.6877 19.6319 19.6317C20.6879 18.5757 21.517 17.3459 22.0963 15.9765C22.6961 14.5584 23.0003 13.0523 23.0003 11.5C23.0003 9.94766 22.6961 8.44159 22.0963 7.02347L22.0961 7.02361Z" fill="#CE5959"/></g></svg>`;
    
    if (filtered.length === 0) {
        $('#calendar').html(`
            <div class="custom-empty-msg">
                ${emptySVG}
                There are no events matching your criteria.
            </div>
        `);
        return;
    }

    let html = '<div class="custom-event-list">';
    filtered.forEach(e => {
        html += renderEventCard(e);
    });
    html += '</div>';
    
    $('#calendar').html(html);
    $('#calendar').removeClass('month-view').addClass('list-view');
}

function renderMonthCalendar() {
    // Clear everything first
    $('#calendar').empty();
    $('#calendar').removeClass('list-view').addClass('month-view');
    
    // Destroy old calendar if exists
    if (calendar) {
        calendar.destroy();
        calendar = null;
    }
    
    const calendarEl = document.getElementById('calendar');
    calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: ''
        },
        events: getFilteredEvents().map(e => ({
            id: e.id,
            title: e.title,
            start: e.start,
            url: `/event/${e.id}`
        })),
        eventClick: function(info) {
            info.jsEvent.preventDefault();
            if (info.event.url) {
                window.location.href = info.event.url;
            }
        },
        eventContent: function(arg) {
            return {
                html: `
                    <div class="event-day-box">
                        <p class="event-day-title">${arg.event.title}</p>
                    </div>
                `
            };
        }
    });
    
    calendar.render();
}

function applyFilters() {
    if (currentView === 'list') {
        renderCustomList();
    } else {
        renderMonthCalendar();
    }
}

// Initialize
$(document).ready(async function () {
    allEvents = await fetchAllEvents();
    
    renderCustomList(); // Start with list view
    
    $("#currencySwitch").on("change", function() {
        if ($(this).is(":checked")) {
            setCurrency('USD', '$');
        } else {
            setCurrency('INR', '&#8377;');
        }
        applyFilters();
    });
    
    $('#searchInput').on('input', applyFilters);
    
    $('#showAll').on('click', function() {
        filterType = 'all';
        setFilterActive(this);
        applyFilters();
    });

    $('#showUpcoming').on('click', function() {
        filterType = 'upcoming';
        setFilterActive(this);
        applyFilters();
    });

    $('#showPast').on('click', function() {
        filterType = 'past';
        setFilterActive(this);
        applyFilters();
    });
    
    // View toggle buttons
    $('#viewList').on('click', function() {
        currentView = 'list';
        setViewActive(this);
        renderCustomList();
    });
    
    $('#viewMonth').on('click', function() {
        currentView = 'month';
        setViewActive(this);
        renderMonthCalendar();
    });

    function setFilterActive(btn) {
        $('.upcoming-past button').removeClass('btn-primary').addClass('btn-secondary');
        $(btn).removeClass('btn-secondary').addClass('btn-primary');
    }
    
    function setViewActive(btn) {
        $('.view-toggle button').removeClass('btn-primary').addClass('btn-secondary');
        $(btn).removeClass('btn-secondary').addClass('btn-primary');
    }
});

</script>

@endsection