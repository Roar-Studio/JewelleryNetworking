@extends('frontend.layouts.master')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('new_ui/assets/css/terms-and-conditions.css') }}?v={{ time() }}">
<style>
.social-icon-header a svg path{
    fill: #fff;
}
ul{
  color: #000;
  font-family: "Playfair Display", serif;
  font-size: 18px;
  font-weight: 400;
  line-height: 30px;
}
.unlockdata{
  color: #000;
  font-family: "Playfair Display", serif;
  font-size: 18px;
  font-weight: 400;
  line-height: 30px;
}
    
</style>
@endsection

@section('content')
<!-- BEGIN: Content-->
<div id="carouselExampleCaptions" class="carousel slide position-relative" data-bs-ride="carousel" data-bs-interval="false">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('new_ui/assets/images/terms_header.webp') }}" class="d-block w-100 desktop_view" alt="carousel image">
            <img src="{{ asset('new_ui/assets/images/termncondition_m_banner.webp') }}" class="d-block w-100 mobile_view" alt="carousel image">
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
    <h1 class="main-page-title">Terms &amp; Conditions</h1>
</div>
<hr />

<main class="container pb-4">
    <div class="content-wrapper">
      <section class="section mb-4">
        <h2 class="section-title">Introduction</h2>
        <p class="section-text">
          Welcome to Jewellery Networking, the premiere networking platform and community where business professionals in the gems, jewellery and allied industry can Be “CEEN”- Connect, Empower, Engage, Network. By visiting and using our website at www.jewellerynetworking.com, you agree to follow our terms and conditions. Please review these terms carefully to ensure a smooth and enjoyable experience on our site.<br/>
          Thank you for being a part of our community!
        </p>
      </section>

      <section class="section mb-4">
        <h2 class="section-title">Membership and Services</h2>
        <div class="subsection mb-2">
          <h3 class="subsection-title">Eligibility</h3>
          <p class="subsection-text">Jewellery Networking is open to service providers, business professionals, entrepreneurs, independent designers or brands and anyone offering services that can be of use to the gems, jewellery and allied industry. We welcome you to join our community designed just for you</p>
        </div>

        <div class="subsection">
          <h3 class="subsection-title">Membership Options and Fees</h3>
          <p class="subsection-text">
            <span><strong>Standard Membership:</strong></span><br>
            <span>INR 5,999 per year (includes GST) Or</span><br>
            <span>USD 75 per year (based on current exchange rate)</span><br><br>
            <span><strong>Premium Membership:</strong></span><br>
            <span>By invite only for Jewellery Networking verified members</span><br>
            <span>INR 9,999 per year (includes GST) Or</span><br>
            <span>USD 125 per year (based on current exchange rate)</span>
            <br/>
            <span>Membership fees are non-refundable and renew automatically each year unless cancelled before the renewal date.</span><br><br>
            <span>Membership benefits:</span><br>
            <ul>
              <li>Exclusive access to our online platform and global member directory</li>
              <li>Invitations to top networking events and workshops</li>
              <li>Opportunities to collaborate with leading professionals</li>
              <li>Latest industry insights and market updates</li>
              <li>Boosted brand visibility for your business</li>
              <li>Personal and professional growth through strategic networking</li>
            </ul>
            <br>
            <span class="unlockdata">Unlock even more opportunities by upgrading to Premium Membership, where you can access enhanced features and exclusive benefits designed to accelerate your success.</span><br>
            <span class="unlockdata">Join Jewellery Networking to connect, learn, and grow your business community.</span>
          </p>
        </div>
      </section>

      <section class="section mb-4">
        <h2 class="section-title">Membership Upgrade</h2>
        <div class="subsection mb-2">
          <h3 class="subsection-title">Upgrade Benefit</h3>
          <p class="subsection-text">
            Members upgrading from the Standard to the Premium plan will receive
            a one-month extension, provided they have completed at least 9
            months on the Standard plan. No extension will be granted if the
            usage is less than 9 months.
          </p>
        </div>

        <div class="subsection">
          <h3 class="subsection-title">Upgrade Fee</h3>
          <p class="subsection-text">
            Any member upgrading from the Standard to the Premium plan will be
            required to pay a differential amount of INR 4,000 (inclusive of
            GST) or USD 50.
          </p>
        </div>
      </section>

      <section class="section mb-4">
        <h2 class="section-title">Payment and Renewal</h2>
          <p class="section-text">Membership fees are billed annually and can be paid in either INR or US Dollars. All membership fees are non-refundable. Your membership will renew automatically each year unless you cancel before the renewal date.</p>
          <p class="section-text">You may upgrade your membership at any time, subject to our terms and conditions for upgrading. <a href="/membership" class="text-decoration-underline">Membership upgrade</a></p>
          <p class="section-text">Members can also renew their membership at any point in the future using their existing membership details. </p>
      </section>

      <section class="section mb-4">
        <h2 class="section-title">Refund</h2>
        <p class="section-text">Please note that once you have enrolled, registered, and made your payment, refunds are generally not available. However, in exceptional cases, if you have any concerns, please contact our customer support team for assistance. <a href="/contact-us" class="text-decoration-underline">Contact us</a></p>
      </section>

      <section class="section mb-4">
        <h2 class="section-title">User Conduct</h2>
        <p class="section-text">We request all members to be professional and respectful in their interactions. Harassment, abusive language, or inappropriate behaviour will not be tolerated and may lead to cancellation of your membership without a refund.</p>
      </section>

      <section class="section mb-4">
        <h2 class="section-title">Content and Intellectual Property</h2>
        <p class="section-text">The concept of Jewellery Networking, along with all content on our website, digital platforms, and social media-including text, graphics, logos, images, and software-is the property of Jewellery Networking or our content partners and is protected by copyright laws. Members and visitors are not allowed to reproduce, share, or create new works from any of our content without getting written permission from us. This helps protect our original ideas and ensures the rights of our creators and partners are respected.</p>
      </section>

      <section class="section mb-4">
        <h2 class="section-title">Privacy and Security</h2>
        <div class="subsection mb-2">
          <h3 class="subsection-title">Data Protection</h3>
          <p class="subsection-text">
            Your privacy is very important to us. We are dedicated to
            safeguarding your personal and professional information collected
            during registration and while using our platform. This information
            is protected through advanced encryption protocols and secure server
            infrastructure. We also comply with all relevant data protection
            laws and regulations to ensure your data is handled with the utmost
            care.
          </p>
        </div>

        <div class="subsection">
          <h3 class="subsection-title">Due Diligence</h3>
          <p class="subsection-text">
            Jewellery Networking provides a valuable platform for connecting
            businesses and professionals. However, we encourage all members to
            conduct their own due diligence before entering into any business
            transactions or agreements. Please note that Jewellery Networking is
            not responsible for the outcomes of any business activities or
            agreements made between members.
          </p>
        </div>
      </section>

      <section class="section mb-4">
        <h2 class="section-title">Events and Workshops</h2>
        <div class="subsection mb-2">
          <h3 class="subsection-title">Events and Workshops</h3>
          <p class="subsection-text">Members can join our online and offline events, including workshops, meetups, and conferences. Event details-such as dates, locations, and any fees-will be shared on our website as they become available.</p>
        </div>

        <div class="subsection">
          <h3 class="subsection-title">Cancellation and Refunds</h3>
          <p class="subsection-text">You can cancel your event registration up to 7 days before the event and get a full refund. If you cancel within 7 days of the event, a refund will not be available.<br/>
          Please note, payment and refund policies may differ for each event, so be sure to check the event’s terms and conditions before registering.</p>
        </div>
      </section>

      <section class="section mb-4">
        <h2 class="section-title">Liability</h2>
        <p class="section-text">Jewellery Networking aims to offer a valuable platform and event experience for all members. However, we cannot be held responsible for any direct, indirect, incidental, or consequential damages that may result from using our platform or participating in our events. By using our website and joining our events, you agree to indemnify and hold Jewellery Networking harmless from any claims, damages, or expenses that may arise.</p>
      </section>

      <section class="section mb-4">
        <h2 class="section-title">Modifications to Terms</h2>
        <p class="section-text">Jewellery Networking reserves the right to update these terms and conditions whenever needed. We will inform members about any changes by email or with a notice on our website. Continued use of the platform after the updates will be considered as acceptance of the revised terms by the member.</p>
      </section>

      <section class="section">
        <h2 class="section-title">Contact Us</h2>
        <p class="section-text">If you have any questions or concerns about these terms and conditions, please feel free to contact us at <br/>
          {{-- <i class="bi bi-envelope-at" style="color: #7367f0"></i>  --}}
          {{-- <svg height="20" width="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#143d54 "><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M13.025 17H3.707l5.963-5.963L12 12.83l2.33-1.794 1.603 1.603a5.463 5.463 0 0 1 1.004-.41l-1.808-1.808L21 5.9v6.72a5.514 5.514 0 0 1 1 .64V5.5A1.504 1.504 0 0 0 20.5 4h-17A1.504 1.504 0 0 0 2 5.5v11A1.5 1.5 0 0 0 3.5 18h9.525c-.015-.165-.025-.331-.025-.5s.01-.335.025-.5zM3 16.293V5.901l5.871 4.52zM20.5 5c.009 0 .016.005.025.005L12 11.57 3.475 5.005c.009 0 .016-.005.025-.005zm-2 8a4.505 4.505 0 0 0-4.5 4.5 4.403 4.403 0 0 0 .05.5 4.49 4.49 0 0 0 4.45 4h.5v-1h-.5a3.495 3.495 0 0 1-3.45-3 3.455 3.455 0 0 1-.05-.5 3.498 3.498 0 0 1 5.947-2.5H20v.513A2.476 2.476 0 0 0 18.5 15a2.5 2.5 0 1 0 1.733 4.295A1.497 1.497 0 0 0 23 18.5v-1a4.555 4.555 0 0 0-4.5-4.5zm0 6a1.498 1.498 0 0 1-1.408-1 1.483 1.483 0 0 1-.092-.5 1.5 1.5 0 0 1 3 0 1.483 1.483 0 0 1-.092.5 1.498 1.498 0 0 1-1.408 1zm3.5-.5a.5.5 0 0 1-1 0v-3.447a3.639 3.639 0 0 1 1 2.447z"></path><path fill="none" d="M0 0h24v24H0z"></path></g></svg> --}}
          <img src="{{ asset('new_ui/assets/images/email_logo.svg') }}">
          support@jewellerynetworking.com or call on 
          <br class="mobile-break"> 
          {{-- <i class="bi bi-telephone" style="color: #7367f0"></i> --}}
          {{-- <svg height="20" width="20" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg" fill="#143d54" stroke="#143d54"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs> <style>.cls-1{fill:#ff7900;}</style> </defs> <g id="phone"> <path class="cls-1" d="M23,17.11a5.92,5.92,0,0,0-4.63-3.95,1.5,1.5,0,0,0-1.51.66L15.6,15.63a.53.53,0,0,1-.61.2,13.25,13.25,0,0,1-3.6-2.14,13,13,0,0,1-2.94-3.52.5.5,0,0,1,.17-.69l1.63-1.09a1.52,1.52,0,0,0,.61-1.71A10.13,10.13,0,0,0,9.48,3.79a10.36,10.36,0,0,0-2.2-2.33A1.53,1.53,0,0,0,6,1.19a7.31,7.31,0,0,0-1.13.43A7.64,7.64,0,0,0,1.2,6.1a1.48,1.48,0,0,0,0,.93A24.63,24.63,0,0,0,7.73,17.44,24.76,24.76,0,0,0,17.12,23a1.41,1.41,0,0,0,.45.07,1.59,1.59,0,0,0,.48-.07,7.64,7.64,0,0,0,4.47-3.66A6.21,6.21,0,0,0,23,18,1.46,1.46,0,0,0,23,17.11Zm-1.33,1.74A6.61,6.61,0,0,1,17.73,22a.54.54,0,0,1-.31,0,23.61,23.61,0,0,1-9-5.29,23.74,23.74,0,0,1-6.27-10,.47.47,0,0,1,0-.31A6.59,6.59,0,0,1,5.29,2.52a5,5,0,0,1,1-.36h.1a.5.5,0,0,1,.32.11,9.4,9.4,0,0,1,2,2.09A9.07,9.07,0,0,1,9.9,7a.52.52,0,0,1-.21.6L8.06,8.64a1.54,1.54,0,0,0-.47,2,14.09,14.09,0,0,0,7,6.09,1.51,1.51,0,0,0,1.81-.58l1.21-1.81a.51.51,0,0,1,.51-.23A4.94,4.94,0,0,1,22,17.44a.58.58,0,0,1,0,.29A5.35,5.35,0,0,1,21.62,18.85Z"></path> </g> </g></svg> --}}
          <img src="{{ asset('new_ui/assets/images/Phone.svg') }}">+91 9819155544 or use the <a href="/contact-us" class="text-decoration-underline">Contact us</a> form on our website.<br/>
        We’re here to assist you and ensure you have a great experience with Jewellery Networking.</p>
      </section>
    </div>
</main>

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
    // var myCarousel = document.querySelector('#carouselExampleCaptions')
    // // var carousel = new bootstrap.Carousel(myCarousel, {
    // // interval: 3000,
    // // pause: true,
    // // })
</script>
@endsection