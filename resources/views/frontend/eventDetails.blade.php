@extends('frontend.layouts.master')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('new_ui/assets/css/events.css') }}?v={{ time() }}">
<style>
    .event-detail-card{
        border: 1px solid #C6B682;
    }
    .event-card{
        border: unset;
    }
    .event-details{
        width: 55%;;
    }
    .event-banner{
        width: 25%;
    }
    .event-banner img{
        width: 100% !important;
        object-fit: cover;
    }
    .event-banner a{
        /* text-align: right; */
        text-align: center;
        width: 100%;
        display: block;
        /* color: #0000E7; */
        color: #244c5a;
        /* font-family: 'Lato'; */
        font-family: "Playfair Display", sans-serif;
        font-weight: 600;
    }
    .event-btns .fees{
        font-size: 20px;
        line-height: 20px;
        text-align:center;
    }
    .event-card-footer{
        padding: 0 20px;
        color: #000;
        font-variant-numeric: lining-nums proportional-nums;
    }
    .event-card-footer h2.section-title{
        font-size: 18px;
        color: #000;
        border-bottom: 1px solid #DDDAD1;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }
    .contact-detail{
        display: flex;
        gap: 5px;
    }
    .back-btn{
        background: #f2f4f5;
        border-radius: 2px;
        color: #000;
        font-size: 18px;
        padding: 13px 20px;
    }
    .contact-detail svg{
        width: 13px;
    }
    .contact-detail .contact-value{
        font-weight: 700;
    }
    .sponsers{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .sponsers > div {
        padding: 0 15px;
        /* max-width:200px;  */
    }
    .sponsers > div .line {
        content: '';
        position: absolute;
        height: 100%;
        border: 1px solid #c6b682;
        top: 0;
        right: 0;
    }
    .sponsers > div .line::before, .sponsers > div .line::after{
        content: '';
        background-image: url(http://127.0.0.1:8000/new_ui/assets/images/gold-d-vector.png);
        position: absolute;
        width: 12px;
        background-size: contain;
        height: 9px;    
        background-repeat: no-repeat;
    }
    .sponsers > div .line::before {
        top: auto;
        top: -7px;
        right: -6px;
    }
    .sponsers > div .line::after {
        top: auto;
        bottom: -7px;
        right: -6px;
    }
    .sponsers > div:last-child .line{
        display:none;
    }
    .map-box iframe{
        width: 100%;
    }
    .social-icon-header a svg path{
        fill: #fff;
    }
    .sponsers img {
        width: 160px !important;
        height: 80px;
        object-fit: contain;
    }
    .date-display-small {
        display: flex;
        align-items: center; /* Keeps icons and text vertically aligned */
        gap: 20px;           /* Adjust this value to set the desired spacing */
    }

    /* Optional: Ensures the icon and text stay close together */
    .date-display-small label {
        display: flex;
        align-items: center;
        gap: 8px;            /* Space between the SVG icon and the span text */
    }

    
</style>
@endsection

@section('content')
<!-- BEGIN: Content-->
<div id="carouselExampleCaptions" class="carousel slide position-relative" data-bs-ride="carousel" data-bs-interval="false">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('new_ui/assets/images/event_detail_header.png') }}" class="d-block w-100 desktop_view" alt="carousel image">
            <img src="{{ asset('new_ui/assets/images/event_detail_mobile_banner.webp') }}" class="d-block w-100 mobile_view" alt="carousel image">
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
    <h1 class="main-page-title">Event Detail</h1>
</div>

<div class="special-design container mt-2">
    <hr/>
    <img src="{{ asset('new_ui/assets/images/diamond.webp') }}">
    <div class="vertical-line"></div>
</div>

<section class="event-header-section">
    <div class="container">
        <h3>Check our Exclusive Events</h3>
        <p>Join us at our exclusive Jewellery Networking events to connect with industry leaders, learn from expert workshops, showcase your work, and discover the latest trends. Whether you’re looking to expand your network, gain insights, or grow your brand, our events offer unique opportunities to elevate your career and business in the Jewellery industry. Don’t miss out on these unparalleled experiences designed to inspire and empower Jewellery professionals.</p>
        <div class="text-center mb-2">
            <a href="{{ route('events') }}" class="btn back-btn">
                <i class="bi bi-chevron-left"></i>
                All Events
            </a>
        </div>
    </div>
</section>

<div class="container">
    <div class="event-detail-card">
      <div class="event-card">
          <div class="event-details">
              <h1 class="event-title loading-text" style="height: 45px;"></h1>
              <div class="event-description mb-50 loading-text" style="height: 50px;">
              </div>
              <div class="event-timing">
                  <div class="loading-text" style="height: 45px;"></div>
                  <div class="loading-text" style="height: 45px;"></div>
              </div>
              <div class="event-btns">
                  <div class="loading-text me-50" style="height: 45px;"></div>
                  <p class="loading-text me-50" style="height: 45px;"></p>
                  <div class="loading-text me-50" style="height: 45px;"></div>
                </div>
            </div>
            <div class="event-banner">
                <div class="loading-text mb-1" style="height: 200px;"></div>
                <a class="loading-text" href="#"></a>
          </div>
      </div>
      <div class="event-card-footer">
            <div class="row">
                <!-- Organizer Section -->
                <section class="col-lg-3 col-md-6 mb-4">
                    <h2 class="section-title loading-text"></h2>
                    <p class="organization-name loading-text"></p>

                    <div class="mb-2">
                        <p class="contact-label mb-25 loading-text"></p>
                        <div class="loading-text me-50" style="height: 45px;"></div>
                        </div>
                    <div>
                    <div class="mb-2">
                        <p class="contact-label mb-25 loading-text"></p>
                        <div class="loading-text me-50" style="height: 45px;"></div>
                        </div>
                    <div>
                </section>

                <!-- Venue Section -->
                <section class="col-lg-5 col-md-6 mb-4">
                    <h2 class="section-title loading-text"></h2>
                    <div class="loading-text me-50" style="height: 100px;"></div>
                    
                    <div class="mb-2">
                        <p class="contact-label mb-25 loading-text"></p>
                        <div class="loading-text me-50" style="height: 45px;"></div>
                        </div>
                    <div>
                </section>

                <!-- Map Section -->
                <section class="col-lg-4 col-md-12 mb-4">
                    <h2 class="section-title loading-text"></h2>
                    <div class="loading-text me-50" style="height: 150px;">
                    </div>
                </section>
            </div>
      </div>
    </div>
</div>

<section class="main-section-outer mt-2">
    <h2 class="main-section-title mt-5">Event Sponsored By</h2>
</section>

<section class="container">
    <div class="sponsers mb-5">
            <div class="text-center position relative">
                <div class="line"></div>
                <div class="loading-text mb-1" style="height: 100px;"></div>
            </div>
            <div class="text-center position relative">
                <div class="line"></div>
                <div class="loading-text mb-1" style="height: 100px;"></div>
            </div>
            <div class="text-center position relative">
                <div class="line"></div>
                <div class="loading-text mb-1" style="height: 100px;"></div>
            </div>
            <div class="text-center position relative">
                <div class="line"></div>
                <div class="loading-text mb-1" style="height: 100px;"></div>
            </div>
    </div>
</section>

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
<script>
    $(document).ready(function () {
        const { selectedCurrencyCode, selectedCurrencySymbol } = getSelectedCurrency();

        function getEventDataById(eventId) {
            // Check if ID is empty, null, or only whitespace
            if (!eventId || eventId.trim() === '') {
                window.location.href = '/events'; // Redirect
                return;
            }

            // Optional: show loading indicator
            $('#eventResult').html('Loading event data...');

            try{
                // Make the API call to get event data
                window.axiosApiClient.get(`/get-event/${eventId}`)
                .then(response => {
                    const eventData = response.data.data;
                    if (response.data.status && eventData) {
                        // Render the event data
                        renderEventData(eventData);
                    } else {
                        // Handle case where no data is returned
                        $('.event-detail-card').html('No event data found.');
                    }
                })
                .catch(error => {
                    console.error('Error fetching event data:', error);
                });
            } catch (error) {
                console.error('Unexpected error:', error);
            }
            
        }

        function renderEventData(eventData) {
            // Clear previous content
            $('.event-detail-card').empty();
            $('.sponsers').empty();


            let event = {
                id: eventData.id,
                name: eventData.name || '',
                description: eventData.description || '',
                event_start_day_number: eventData.event_start_datetime ? moment(eventData.event_start_datetime).format('DD') : '',
                event_start_month: eventData.event_start_datetime ? moment(eventData.event_start_datetime).format('MMM') : '',
                event_start_year: eventData.event_start_datetime ? moment(eventData.event_start_datetime).format('YYYY') : '',
                event_start_date: eventData.event_start_datetime ? moment(eventData.event_start_datetime).format('ddd, DD MMM YYYY') : '',
                event_start_time: eventData.event_start_datetime ? moment(eventData.event_start_datetime).format('hh:mm a') : '',
                event_end_date: eventData.event_end_datetime ? moment(eventData.event_end_datetime).format('ddd, DD MMM YYYY') : '',
                event_end_time: eventData.event_end_datetime ? moment(eventData.event_end_datetime).format('hh:mm a') : '',
                event_type: eventData.event_type,
                event_mode: eventData.event_mode,
                currency_type: eventData.currency_type,
                venue_address: eventData.venue_address || '',
                total_seats: eventData.total_seats || 0,
                completed_transaction_count: eventData.completed_transaction_count  || 0,
                display_start_date: eventData.display_start_date ? moment(eventData.display_start_date).format('ddd, DD MMM YYYY') : moment(startDate).format('ddd, DD MMM YYYY'),
                display_end_date: eventData.display_end_date ? moment(eventData.display_end_date).format('ddd, DD MMM YYYY') : moment(startDate).format('ddd, DD MMM YYYY'),
                amount_in_inr: eventData.amount_in_inr || 0,
                amount_in_usd: eventData.amount_in_usd || 0,
                banner: eventData.banner || 'https://via.placeholder.com/300x100?text=Event'
            };

            // const registrationStart = moment(event.display_start_date).startOf('day'); // full ISO string with time
            const registrationStart = moment(event.display_start_date).startOf('day');
                    const registrationEnd = moment(event.display_end_date).endOf('day');
                    const EventStartDate = moment(event.event_start_date).startOf('day');
                    const EventEndDate = moment(event.event_end_date).startOf('day');
                    
                    const today = moment();
                    const isRegistrationOpen = today.isBetween(registrationStart, registrationEnd, undefined, '[]');
                    const isUpcoming = today.isBefore(registrationStart);
                    const isEventOver = today.isAfter(EventEndDate, 'day');
                    const totalSeats = parseInt(event.total_seats) || 0;
                    const completed = parseInt(event.completed_transaction_count) || 0;
                    const availableSeats = totalSeats - completed;

                    const eventType = event.event_type == 'paid' 
                            ? `<p class="fees">Fees<br/><span class="rs-sign">${selectedCurrencyCode === 'INR' ? '&#8377;' : '$'}</span><span class="amount">${selectedCurrencyCode === 'INR' ? convertCurrencyWithoutSymbol(event.amount_in_inr, 'INR', 0) : convertCurrencyWithoutSymbol(event.amount_in_usd, 'USD', 0)}/-</span></p>`
                            : `<p class="fees">Free<br/><b>Entry</b></p>`;

                    const btns = `<div class="event-btns">
                        ${
                            isUpcoming
                                ? `<div>
                                        <button class="btn btn-primary custom-btn w-100" disabled>Register Now</button>
                                        <p class="registration-start-date">Registration Starts On: <span>${event.display_start_date}</span></p>
                                    </div>
                                    <button class="btn btn-light custom-btn" disabled>Coming Soon</button>`
                                : (
                                    isRegistrationOpen
                                        ? `<div>
                                                ${availableSeats > 0 
                                                    ? `<a href="/order-summary?product_type=event&event_id=${event.id}" class="btn btn-primary custom-btn w-100">Register Now</a>`
                                                    : `<button class="btn btn-primary custom-btn w-100" disabled>Register Now</button>`
                                                }
                                                <p class="registration-start-date">Registration Starts On: <span>${event.display_start_date}</span></p>
                                            </div>
                                            ${eventType}
                                            ${
                                                availableSeats > 0
                                                    ? `<a href="/order-summary?product_type=event&event_id=${event.id}" class="btn btn-secondary custom-btn">Seats Available (${availableSeats})</a>`
                                                    : `<button class="btn btn-light custom-btn" disabled>Event is fully booked,<br/> stay tuned</button>`
                                            }`
                                        : `<button class="btn btn-light custom-btn" disabled>Registration Closed</button>`
                                )
                        }
                    </div>`;

            const eventEndDateHTML = event.event_end_date ? `<div>
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
                            <span>${event.event_end_date}</span>
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
                            <span>${event.event_end_time} IST</span>
                        </label>
                    </div>
                </div>` : '';
            // Create the event details HTML
            const eventDetails = `<div class="event-card">
                    <div class="event-details">
                        <h1 class="event-title">${event.name || ''}</h1>
                        <div class="event-description">
                            <p>${event.description || ''}</p>
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
                                        <span>${event.event_start_date}</span>
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
                                        <span>${event.event_start_time} IST</span>
                                    </label>
                                </div>
                            </div>
                            ${eventEndDateHTML}
                        </div>
                        ${btns}
                        
                    </div>
                    <div class="event-banner">
                        <img src="${event.banner ? APP_URL + '/storage/' + event.banner : ""}" 
                            alt="Event Banner" 
                            class="tc-thumb"
                            style="
                                max-width: 100%;
                                max-height: 220px;
                                width: auto;
                                height: auto;
                                object-fit: contain;
                                display: block;
                                margin-left: auto;
                                margin-right: 0;
                                cursor: pointer;
                            ">

                        <a href="/term-and-conditions">
                            Terms & Conditions
                        </a>
                    </div>
                    <div class="modal fade" id="tcModal" tabindex="-1">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Terms & Conditions</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img id="tcFullImage" src="" class="img-fluid">
                            </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="event-card-footer">
                        <div class="row">
                            <!-- Organizer Section -->
                            <section class="col-lg-3 col-md-6 mb-4">
                                <h2 class="section-title">Organizer</h2>
                                <p class="organization-name">Jewellery Networking</p>

                                <div class="mb-2">
                                <p class="contact-label mb-25">Phone:</p>
                                <div class="contact-detail">
                                    <div class="icon-container">                                        
                                        <img src="{{ asset('new_ui/assets/images/Phone.svg') }}" style="width: 80%;">
                                    </div>
                                    <p class="contact-value">+91 9819155544</p>
                                </div>
                                </div>

                                <div>
                                <p class="contact-label mb-25">Email:</p>
                                <div class="contact-detail">
                                    <div class="icon-container">
                                        <img src="{{ asset('new_ui/assets/images/email_logo.svg') }}" style="width: 90%;">
                                    </div>
                                    <p class="contact-value">support@jewellerynetworking.com</p>
                                </div>
                                </div>
                            </section>

                            <!-- Venue Section -->
                            <section class="col-lg-5 col-md-6 mb-4">
                                <h2 class="section-title">Venue</h2>
                                <address class="venue-address">
                                    <span>
                                        ${event.venue_address}
                                    </span>
                                </address>

                                <div class="mt-2">
                                    <p class="contact-label mb-25">Phone:</p>
                                    <div class="contact-detail">
                                        <div class="icon-container">
                                            <img src="{{ asset('new_ui/assets/images/Phone.svg') }}" style="width: 80%;">
                                        </div>
                                        <p class="contact-value">+91 9819155544</p>
                                    </div>
                                </div>
                            </section>

                            <!-- Map Section -->
                            <section class="col-lg-4 col-md-12 mb-4">
                                <h2 class="section-title">Map</h2>
                                <div class="mt-1 map-box">
                                    ${eventData.google_maps_link || 'No Map Available'}
                                </div>
                            </section>
                        </div>
                </div>`;
                
            $('.event-detail-card').html(eventDetails);
            
            let sponsorHtml = ``;
            if (eventData.sponsors && eventData.sponsors.length > 0) {
                eventData.sponsors.forEach(sponsor => {
                    sponsorHtml += `
                        <div class="text-center position-relative">
                            <div class="line"></div>
                            <img src="${sponsor.image ? APP_URL + '/storage/' + sponsor.image : ''}" class="w-75" alt="sponsor image">
                        </div>`;
                });
            } else {
                sponsorHtml += `<div class="text-center">
                        <p>No sponsors available for this event.</p>
                    </div>`;
            }
            $('.sponsers').html(sponsorHtml);
                
        }

        $('#tcModal').on('show.bs.modal', function () {
            $('#tcFullImage').attr('src', event.banner ? APP_URL + '/storage/' + event.banner : '');
        });
        $(document).on('click', '.tc-thumb', function () {
            const imgSrc = $(this).attr('src');
            $('#tcFullImage').attr('src', imgSrc);
            $('#tcModal').modal('show');
        });


        const eventId = '{{ $event_id }}';
        getEventDataById(eventId);

    });
</script>
@endsection