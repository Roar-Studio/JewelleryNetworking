<header class="top-header container">
    <a href="/">
        <img src="{{ asset('new_ui/assets/images/jn-logo.webp') }}" class="logo" alt="Jewellery Networking Logo">
    </a>
    <div>
        <div class="dashboard" style="display:none;">
            <button type="button" class="btn rounded-4 login-signup-container" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="user-name">My dashboard</span><img src="{{ asset('new_ui/assets/images/user-icon.webp') }}">
            </button>
            <div class="dropdown-menu dropdown-menu-end" data-popper-placement="top-end">
                <a class="dropdown-item" href="/profile">                    
                    <div>
                        <img width="23" height="24" src="{{ asset('new_ui/assets/images/user-icon.webp') }}">
                         {{-- <svg xmlns="http://www.w3.org/2000/svg" width="23" height="24" viewBox="0 0 23 24" fill="none">
                            <path d="M4.53679 23.9992H17.7747C20.314 23.9992 22.3454 21.971 22.3454 19.4696C22.3454 15.2442 18.9259 11.8301 14.6938 11.8301H7.6516C3.41952 11.8301 0 15.2442 0 19.4696C0 21.971 2.0314 23.9992 4.53679 23.9992Z" fill="#666666"/>
                            <path d="M11.1729 10.817C14.1523 10.817 16.59 8.3832 16.59 5.40852C16.59 2.43383 14.1523 0 11.1729 0C8.19354 0 5.75586 2.43383 5.75586 5.40852C5.75586 8.3832 8.19354 10.817 11.1729 10.817Z" fill="#666666"/>
                        </svg> --}}                        
                    </div>
                    <span>My Profile</span>
                </a>
                <a class="dropdown-item" href="/membership-directory">
                    <div>
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="19" height="24" viewBox="0 0 19 24" fill="none">
                            <path d="M15.4648 15.3964C16.1269 15.2147 16.8322 15.0723 17.1855 14.5909C17.7327 13.843 17.2201 12.5266 17.514 11.6277C17.7969 10.7607 19 9.99932 19 9.03902C19 8.07749 17.7981 7.31734 17.514 6.45037C17.2201 5.55146 17.7339 4.23626 17.1855 3.4884C16.6321 2.73319 15.2116 2.81424 14.452 2.26409C13.6997 1.72007 13.3415 0.348378 12.4373 0.0561398C11.5641 -0.226303 10.4672 0.664006 9.5 0.664006C8.53283 0.664006 7.43598 -0.22629 6.5639 0.0549138C5.65971 0.347181 5.30151 1.71765 4.54927 2.26286C3.78839 2.81178 2.3679 2.73197 1.81453 3.48718C1.26732 4.23503 1.77994 5.55146 1.48595 6.44914C1.20309 7.31611 0 8.07749 0 9.03779C0 9.99933 1.20186 10.7595 1.48595 11.6264C1.77993 12.5254 1.26608 13.8406 1.81453 14.5884C2.16533 15.0685 2.86568 15.211 3.52531 15.3915L0.953605 20.8575C0.738678 21.2959 1.12283 21.7895 1.59716 21.7109L3.65255 21.3511C4.138 21.2725 4.61232 21.4973 4.86058 21.9234L5.8994 23.6978C6.14768 24.124 6.76899 24.0908 6.97279 23.6524L9.49137 18.2861L12.0211 23.6524C12.2249 24.0908 12.845 24.124 13.0945 23.6978L14.1333 21.9234C14.3816 21.4973 14.8559 21.2725 15.3413 21.3511L17.3856 21.6987C17.8599 21.7883 18.244 21.2946 18.0291 20.8563L15.4648 15.3964ZM13.3045 8.0911L9.29139 12.0808C8.85043 12.5192 8.13525 12.5192 7.69426 12.0808L5.69447 10.0926C5.25351 9.65424 5.25351 8.94323 5.69447 8.50481C6.13543 8.06642 6.85061 8.06642 7.2916 8.50481L8.49223 9.69844L11.7075 6.50192C12.1484 6.06354 12.8636 6.06354 13.3046 6.50192C13.7468 6.94154 13.7467 7.65271 13.3045 8.0911Z" fill="#666666"/>
                        </svg> --}}
                        <img width="23" height="24" src="{{ asset('new_ui/assets/images/member-directory.webp') }}">
                    </div>
                    <!-- <img src="{{ asset('new_ui/assets/images/user-icon.webp') }}"> -->
                    <span>Member Directory</span>
                </a>
                <a class="dropdown-item" href="javascript:;" onclick="logoutCustomer(); return false;">
                    <div>
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.95287 0H18.0471C19.6848 0 21.1734 0.66962 22.2514 1.74864C23.3294 2.82671 24 4.31506 24 5.95287V18.0471C24 19.6848 23.3304 21.1734 22.2514 22.2514C21.1733 23.3294 19.6849 24 18.0471 24H5.95287C4.31519 24 2.82664 23.3304 1.74864 22.2514C0.670575 21.1733 0 19.6849 0 18.0471V5.95287C0 4.31519 0.66962 2.82664 1.74864 1.74864C2.82671 0.670575 4.31506 0 5.95287 0ZM11.4371 7.42989C11.4371 7.119 11.6887 6.8674 11.9996 6.8674C12.3105 6.8674 12.5621 7.11898 12.5621 7.42989V11.2724C12.5621 11.5833 12.3105 11.8349 11.9996 11.8349C11.6887 11.8349 11.4371 11.5833 11.4371 11.2724V7.42989ZM14.8761 9.09052C14.658 8.8705 14.6589 8.51559 14.878 8.2975C15.098 8.0794 15.4529 8.08035 15.671 8.29941C16.1445 8.77579 16.5272 9.34591 16.7883 9.97824C17.0399 10.5895 17.1796 11.2563 17.1796 11.9517C17.1796 13.3818 16.5999 14.677 15.6624 15.6145C14.725 16.5519 13.4297 17.1316 11.9996 17.1316C10.5695 17.1316 9.27428 16.5519 8.33685 15.6145C7.3994 14.677 6.8197 13.3818 6.8197 11.9517C6.8197 11.2563 6.95936 10.5895 7.21096 9.97824C7.47211 9.34594 7.85474 8.77677 8.32826 8.29941C8.54636 8.07939 8.90223 8.07939 9.12128 8.2975C9.34129 8.5156 9.34129 8.87146 9.12319 9.09052C8.75108 9.46453 8.45166 9.91033 8.24791 10.4049C8.05277 10.8784 7.94467 11.4007 7.94467 11.9517C7.94467 13.0709 8.39906 14.0849 9.13276 14.8196C9.86647 15.5533 10.8805 16.0077 12.0006 16.0077C13.1199 16.0077 14.1338 15.5533 14.8685 14.8196C15.6022 14.0859 16.0566 13.0719 16.0566 11.9517C16.0566 11.4007 15.9485 10.8784 15.7534 10.4049C15.5487 9.91128 15.2502 9.46551 14.8781 9.09052H14.8761Z" fill="#666666"/>
                        </svg> --}}
                        <img width="23" height="24" src="{{ asset('new_ui/assets/images/logout-icon.webp') }}">
                    </div>
                    <!-- <img src="{{ asset('new_ui/assets/images/user-icon.webp') }}"> -->
                    <span>Logout</span>
                </a>
            </div>
        </div>
        <a href="{{ url('/login') }}" class="login-signup-container unauth" style="display:none;"><span>LOGIN/SIGNUP</span><img src="{{ asset('new_ui/assets/images/user-icon.webp') }}"></a>
        <!-- <img class="cart" src="{{ asset('new_ui/assets/images/cart.svg') }}"> -->
        <!-- <div class="dropdown currency-dropdown" style="display:none;">
            <button class="dropdown-toggle" type="button" id="currencyDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="symbol">&#8377;</span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="currencyDropdown">
            <li><a class="dropdown-item" href="#" onclick="setCurrency('INR', '&#8377;')"><span class="symbol">&#8377;</span> INR</a></li>
            <li><a class="dropdown-item" href="#" onclick="setCurrency('USD', '$')"><span class="symbol">$</span> USD</a></li>
            </ul>
        </div> -->
    </div>
</header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="/">
            <img src="{{ asset('new_ui/assets/images/home.svg') }}" class="home-icon" alt="Home Icon">
            <span>Home</span>
        </a>
        <a class="nav-link {{ request()->is('about-us') ? 'active' : '' }}" href="/about-us">
            <img src="{{ asset('new_ui/assets/images/user-icon-gold.svg') }}" class="about-us-icon" alt="about-us Icon">
            <span>About US</span>
        </a>
        <a class="nav-link {{ request()->is('membership') ? 'active' : '' }}" href="/membership">
            <img src="{{ asset('new_ui/assets/images/plan.svg') }}" class="membership-icon" alt="Membership Icon">
            <span>Membership</span>
        </a>
        <a class="nav-link {{ request()->is('events') ? 'active' : '' }}" href="/events">
            <img src="{{ asset('new_ui/assets/images/calender.svg') }}" class="calender-icon" alt="calender Icon">
            <span>Exclusive Events</span>
        </a>
        <a class="nav-link {{ request()->is('gallery') ? 'active' : '' }}" href="/gallery">
            <img src="{{ asset('new_ui/assets/images/gallery.svg') }}" class="gallery-icon" alt="gallery Icon">
            <span>GALLERY & Media</span>
        </a>
        <!-- <a class="nav-link {{ request()->is('gallery1') ? 'active' : '' }}" href="/gallery">
            <img src="{{ asset('new_ui/assets/images/videos.svg') }}" class="media-icon" alt="media Icon">
            <span>MEDIA</span>
        </a> -->
        <a class="nav-link {{ request()->is('contact-us') ? 'active' : '' }}" href="/contact-us">
            <img src="{{ asset('new_ui/assets/images/contact.svg') }}" class="contact-icon" alt="Contact Icon">
            <span>Contact Us</span>
        </a>
      </div>
    </div>
  </div>
</nav>