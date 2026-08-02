<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Deities Design Awards</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Aboreto&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,300;1,400&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('dda-assets/css/dda.css') }}">

</head>

<body>
  <div id="evil-eye-cursor" class="evil-eye-cursor"></div>

  <!--  PAGE LOADER  -->
  <div id="dda-loader">
    <img src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards" id="dda-loader-logo">
    <div id="dda-loader-line"></div>
  </div>
  <script>
    document.getElementById('dda-loader').addEventListener('animationend', function (e) {
      if (e.animationName === 'loaderOut') this.remove();
    });
  </script>

  <!--  ANNOUNCEMENT  -->
  <div class="announce">
    Inaugural Edition | 2026 <span class="pipe">|</span> Registration opens soon <span class="pipe">|</span> <a
      href="{{ url('/deitiesdesignawards/contact') }}">Be notified &rarr;</a>
  </div>

  <!--  NAV  -->
  <nav>
    <a href="#" class="nav-logo"><img src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards"></a>

    <div class="nav-links">
      <a href="#" class="nav-link active">Home</a>

      <div class="has-dropdown">
        <a class="nav-link">Categories <span class="chev">&#x25BC;</span></a>
        <div class="dropdown">
          <span class="dropdown-label">Deities Category</span>
          <a href="{{ url('/deitiesdesignawards/design-category') }}#nitai">Nitai</a>
          <a href="{{ url('/deitiesdesignawards/design-category') }}#gaur">Gaur</a>
          <a href="{{ url('/deitiesdesignawards/design-category') }}#lalita">Lalita</a>
          <a href="{{ url('/deitiesdesignawards/design-category') }}#radharani-radha">Radharani / Radha</a>
          <a href="{{ url('/deitiesdesignawards/design-category') }}#gopinath-krishna">Gopinath / Krishna</a>
          <a href="{{ url('/deitiesdesignawards/design-category') }}#vishakhadevi">Vishakhadevi</a>
          <a href="{{ url('/deitiesdesignawards/design-category') }}#gopalji">Gopalji</a>
        </div>
      </div>
      <div class="has-dropdown">
        <a class="nav-link">Participate <span class="chev">&#x25BC;</span></a>
        <div class="dropdown">
          <a href="{{ url('/deitiesdesignawards/participate') }}#how-to-enter">How to Enter</a>
          <a href="{{ url('/deitiesdesignawards/participate') }}#guidelines">Submission Guidelines</a>
          <a href="{{ url('/deitiesdesignawards/participate') }}#fees">Fees</a>
          <a href="{{ url('/deitiesdesignawards/participate') }}#dates">Important Dates</a>
          <a href="{{ url('/deitiesdesignawards/jury') }}#evaluation-criteria">Judging Criteria</a>
        </div>
      </div>
      <a href="{{ url('/deitiesdesignawards/inspiration') }}" class="nav-link">Inspiration</a>
      <div class="has-dropdown">
        <a class="nav-link">Partners <span class="chev">&#x25BC;</span></a>
        <div class="dropdown">
          <a href="{{ url('/deitiesdesignawards/partners') }}">Our Partners</a>
          <a href="{{ url('/deitiesdesignawards/sponsor-us') }}">Be a Sponsor</a>
        </div>
      </div>
      <a href="{{ url('/deitiesdesignawards/about') }}" class="nav-link">About</a>
      <a href="{{ url('/deitiesdesignawards/contact') }}" class="nav-link">Contact</a>
    </div>

    <div class="nav-right">
      <button class="nav-icon" aria-label="Search">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <circle cx="11" cy="11" r="8" />
          <path d="M21 21l-4.35-4.35" />
        </svg>
      </button>
      <a href="{{ route('dda.login') }}"
   class="nav-cta"
   onclick="localStorage.setItem('redirectAfterLogin','{{ route('dda.submit') }}')">
    Register
</a>
      <button class="mobile-menu-toggle" aria-label="Toggle Menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </button>
    </div>
  </nav>

  <!--  MOBILE MENU DRAWER  -->
  <div class="mobile-menu-drawer">
    <div class="mobile-menu-logo">
      <img src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards">
    </div>
    <div class="mobile-menu-links">
      <a href="#" class="mob-link">Home</a>


      <div class="mob-dropdown">
        <button class="mob-dropdown-toggle">Categories <span class="chev">&#x25BC;</span></button>
        <div class="mob-dropdown-menu">
          <span class="dropdown-label">Deities Category</span>
          <a href="{{ url('/deitiesdesignawards/design-category') }}#nitai">Nitai</a>
          <a href="{{ url('/deitiesdesignawards/design-category') }}#gaur">Gaur</a>
          <a href="{{ url('/deitiesdesignawards/design-category') }}#lalita">Lalita</a>
          <a href="{{ url('/deitiesdesignawards/design-category') }}#radharani-radha">Radharani / Radha</a>
          <a href="{{ url('/deitiesdesignawards/design-category') }}#gopinath-krishna">Gopinath / Krishna</a>
          <a href="{{ url('/deitiesdesignawards/design-category') }}#vishakhadevi">Vishakhadevi</a>
          <a href="{{ url('/deitiesdesignawards/design-category') }}#gopalji">Gopalji</a>
        </div>
      </div>

      <div class="mob-dropdown">
        <button class="mob-dropdown-toggle">Participate <span class="chev">&#x25BC;</span></button>
        <div class="mob-dropdown-menu">
          <a href="{{ url('/deitiesdesignawards/participate') }}#how-to-enter">How to Enter</a>
          <a href="{{ url('/deitiesdesignawards/participate') }}#guidelines">Submission Guidelines</a>
          <a href="{{ url('/deitiesdesignawards/participate') }}#fees">Fees</a>
          <a href="{{ url('/deitiesdesignawards/participate') }}#dates">Important Dates</a>
          <a href="{{ url('/deitiesdesignawards/jury') }}#evaluation-criteria">Judging Criteria</a>
        </div>
      </div>

      <a href="{{ url('/deitiesdesignawards/inspiration') }}" class="mob-link">Inspiration</a>
      <div class="mob-dropdown">
        <button class="mob-dropdown-toggle">Partners <span class="chev">&#x25BC;</span></button>
        <div class="mob-dropdown-menu">
          <a href="{{ url('/deitiesdesignawards/partners') }}">Our Partners</a>
          <a href="{{ url('/deitiesdesignawards/sponsor-us') }}">Be a Sponsor</a>
        </div>
      </div>
      <a href="{{ url('/deitiesdesignawards/about') }}" class="mob-link">About</a>
      <a href="{{ url('/deitiesdesignawards/contact') }}" class="mob-link">Contact</a>
      <a href="{{ route('dda.login') }}"
   class="mob-register-btn"
   onclick="localStorage.setItem('redirectAfterLogin','{{ route('dda.submit') }}')">
    Register
</a>
    </div>
  </div>

  <!--  HERO FULL BLEED  -->
  <section class="hero">
    <div class="hero-media">
      <img class="hero-banner-img" src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Homepage.png') }}" alt="" aria-hidden="true">
    </div>

    <div class="hero-content">
      <img src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards" class="hero-logo-mark">


      <h1 class="hero-title">Jewellery for the Sacred</h1>
      <p class="hero-tagline">Deities. Design. Devotion.</p>

      <div class="hero-cta-row">
        <a href="{{ route('dda.login') }}"
   class="btn-gold pulse"
   onclick="localStorage.setItem('redirectAfterLogin','{{ route('dda.submit') }}')">
          <span>Register Now</span>
          <span class="arrow">&rarr;</span>
        </a>
        <a href="{{ url('/deitiesdesignawards/about') }}" class="btn-primary">
          <span>Discover More</span>
          <span class="arrow">&rarr;</span>
        </a>
      </div>
    </div>
  </section>



  <!--  CATEGORIES  -->
  <section class="section categories">
    <div class="container">
      <div class="cat-head">
        <div>
          <span class="section-eyebrow">Deities Categories</span>
          <h2 class="section-title">Seven sacred forms</h2>
        </div>
      </div>

      <div class="cat-strip" aria-hidden="true">
        <img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Nitai.jpg') }}" alt="">
        <img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Gaur.jpg') }}" alt="">
        <img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Lalita.jpg') }}" alt="">
        <img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Radha.jpg') }}" alt="">
        <img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Krishna.jpg') }}" alt="">
        <img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Vishaka+Devi.jpg') }}" alt="">
        <img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Gopalji.jpg') }}" alt="">
      </div>

      <div class="cat7-grid">
        <a href="{{ url('/deitiesdesignawards/design-category') }}#nitai" class="cat7-item">
          <h4>Nitai</h4>
          <span class="cat-explore">Explore Category <span>&rarr;</span></span>
        </a>
        <a href="{{ url('/deitiesdesignawards/design-category') }}#gaur" class="cat7-item">
          <h4>Gaur</h4>
          <span class="cat-explore">Explore Category <span>&rarr;</span></span>
        </a>
        <a href="{{ url('/deitiesdesignawards/design-category') }}#lalita" class="cat7-item">
          <h4>Lalita</h4>
          <span class="cat-explore">Explore Category <span>&rarr;</span></span>
        </a>
        <a href="{{ url('/deitiesdesignawards/design-category') }}#radharani-radha" class="cat7-item">
          <h4>Radharani / Radha</h4>
          <span class="cat-explore">Explore Category <span>&rarr;</span></span>
        </a>
        <a href="{{ url('/deitiesdesignawards/design-category') }}#gopinath-krishna" class="cat7-item">
          <h4>Gopinath / Krishna</h4>
          <span class="cat-explore">Explore Category <span>&rarr;</span></span>
        </a>
        <a href="{{ url('/deitiesdesignawards/design-category') }}#vishakhadevi" class="cat7-item">
          <h4>Vishakhadevi</h4>
          <span class="cat-explore">Explore Category <span>&rarr;</span></span>
        </a>
        <a href="{{ url('/deitiesdesignawards/design-category') }}#gopalji" class="cat7-item">
          <h4>Gopalji</h4>
          <span class="cat-explore">Explore Category <span>&rarr;</span></span>
        </a>
      </div>
    </div>
  </section>

  <!--  INSPIRATION PREVIEW  -->
  <section class="section inspo-preview-sec">
    <div class="container" style="text-align:center">
      <span class="section-eyebrow" style="justify-content:center">Inspiration</span>
      <div class="inspo-banner">
        <a href="{{ url('/deitiesdesignawards/gallery') }}?category=carvings" class="inspo-panel">
          <div class="inspo-panel-img"><img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/CARVINGS.png') }}" alt="Carvings" loading="lazy"></div>
          <span class="inspo-panel-btn">Carvings <span>&rarr;</span></span>
        </a>
        <a href="{{ url('/deitiesdesignawards/gallery') }}?category=paintings" class="inspo-panel">
          <div class="inspo-panel-img"><img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/PAINTINGS+(1).png') }}" alt="Painting" loading="lazy"></div>
          <span class="inspo-panel-btn">Painting <span>&rarr;</span></span>
        </a>
        <a href="{{ url('/deitiesdesignawards/gallery') }}?category=wooden" class="inspo-panel">
          <div class="inspo-panel-img"><img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/WOODEN+(1).png') }}" alt="Wooden" loading="lazy"></div>
          <span class="inspo-panel-btn">Wooden <span>&rarr;</span></span>
        </a>
        <a href="{{ url('/deitiesdesignawards/gallery') }}?category=deities" class="inspo-panel">
          <div class="inspo-panel-img"><img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/DIETY+INSPO+(1).png') }}" alt="Deities" loading="lazy"></div>
          <span class="inspo-panel-btn">Deities <span>&rarr;</span></span>
        </a>
      </div>
    </div>
  </section>

  <!--  TIMELINE  -->
  <section class="section timeline-sec">
    <div class="container">
      <div class="timeline-head">
        <svg class="timeline-cal-icon" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
        <span class="section-eyebrow">Timelines</span>
      </div>

      <div class="timeline-grid">
          <div class="tl-step">
            <div class="tl-dot pulse"></div>
            <div class="tl-phase">Phase One</div>
            <div class="tl-title">Registration Opens</div>
            <div class="tl-date">5th August 2026</div>
          </div>
          <div class="tl-step">
            <div class="tl-dot"></div>
            <div class="tl-phase">Phase Two</div>
            <div class="tl-title">Closure of Entry Submission</div>
            <div class="tl-date">25th August 2026</div>
          </div>
          <div class="tl-step">
            <div class="tl-dot"></div>
            <div class="tl-phase">Phase Three</div>
            <div class="tl-title">Preliminary Jury Evaluation</div>
            <div class="tl-date">30th August 2026</div>
          </div>
          <div class="tl-step">
            <div class="tl-dot"></div>
            <div class="tl-phase">Phase Four</div>
            <div class="tl-title">Final Jury Round</div>
            <div class="tl-date">14th Oct 2026</div>
          </div>
          <div class="tl-step">
            <div class="tl-dot"></div>
            <div class="tl-phase">Phase Five</div>
            <div class="tl-title">Awards<br>Night</div>
            <div class="tl-date">18th Oct 2026</div>
          </div>
        </div>

      <div class="timeline-cta">
        <a href="{{ route('dda.login') }}"
   class="btn-gold"
   onclick="localStorage.setItem('redirectAfterLogin','{{ route('dda.submit') }}')">
          <span>Register Now</span>
          <span class="arrow">&rarr;</span>
        </a>
      </div>
    </div>
  </section>

  <!--  JURY SLIDER — hidden for now, reveal later by removing the `hidden` attribute below  -->
  <section class="section jury-slider-sec" hidden>
    <div class="container">
      <div class="jury-slider-head">
        <span class="section-eyebrow">The Jury</span>
        <h2 class="section-title">Voices that will honour the craft.</span></h2>
      </div>
    </div>
    <div class="jury-slider-wrap">
      <div class="jury-slider-track">
        <div class="jury-slide">
          <div class="jury-slide-img"><img src="{{ asset('deitiesdesignawardsdda/inspiration%20pdf%20and%20images/Painting/thumbs/Painting%201_thumb.jpg') }}" alt="Priya Sharma"></div>
          <h4 class="jury-slide-name">Priya Sharma</h4>
          <span class="jury-slide-role">Master Jeweller &amp; Design Consultant</span>
        </div>
        <div class="jury-slide">
          <div class="jury-slide-img"><img src="{{ asset('deitiesdesignawardsdda/inspiration%20pdf%20and%20images/Painting/thumbs/Painting%202_thumb.jpg') }}" alt="Arjun Mehta"></div>
          <h4 class="jury-slide-name">Arjun Mehta</h4>
          <span class="jury-slide-role">Creative Director, Heritage Jewellery House</span>
        </div>
        <div class="jury-slide">
          <div class="jury-slide-img"><img src="{{ asset('deitiesdesignawardsdda/inspiration%20pdf%20and%20images/Painting/thumbs/Painting%206_thumb.jpg') }}" alt="Radhika Iyer"></div>
          <h4 class="jury-slide-name">Radhika Iyer</h4>
          <span class="jury-slide-role">Fine Jewellery Curator</span>
        </div>
        <div class="jury-slide">
          <div class="jury-slide-img"><img src="{{ asset('deitiesdesignawardsdda/inspiration%20pdf%20and%20images/Painting/thumbs/Painting%204_thumb.jpg') }}" alt="Vikram Nair"></div>
          <h4 class="jury-slide-name">Vikram Nair</h4>
          <span class="jury-slide-role">Gemologist &amp; Craft Historian</span>
        </div>
        <div class="jury-slide">
          <div class="jury-slide-img"><img src="{{ asset('deitiesdesignawardsdda/inspiration%20pdf%20and%20images/Painting/thumbs/Painting%205_thumb.jpg') }}" alt="Ananya Desai"></div>
          <h4 class="jury-slide-name">Ananya Desai</h4>
          <span class="jury-slide-role">Founder, Sacred Design Studio</span>
        </div>
        <!-- duplicate set for seamless infinite loop -->
        <div class="jury-slide" aria-hidden="true">
          <div class="jury-slide-img"><img src="{{ asset('deitiesdesignawardsdda/inspiration%20pdf%20and%20images/Painting/thumbs/Painting%201_thumb.jpg') }}" alt=""></div>
          <h4 class="jury-slide-name">Priya Sharma</h4>
          <span class="jury-slide-role">Master Jeweller &amp; Design Consultant</span>
        </div>
        <div class="jury-slide" aria-hidden="true">
          <div class="jury-slide-img"><img src="{{ asset('deitiesdesignawardsdda/inspiration%20pdf%20and%20images/Painting/thumbs/Painting%202_thumb.jpg') }}" alt=""></div>
          <h4 class="jury-slide-name">Arjun Mehta</h4>
          <span class="jury-slide-role">Creative Director, Heritage Jewellery House</span>
        </div>
        <div class="jury-slide" aria-hidden="true">
          <div class="jury-slide-img"><img src="{{ asset('deitiesdesignawardsdda/inspiration%20pdf%20and%20images/Painting/thumbs/Painting%206_thumb.jpg') }}" alt=""></div>
          <h4 class="jury-slide-name">Radhika Iyer</h4>
          <span class="jury-slide-role">Fine Jewellery Curator</span>
        </div>
        <div class="jury-slide" aria-hidden="true">
          <div class="jury-slide-img"><img src="{{ asset('deitiesdesignawardsdda/inspiration%20pdf%20and%20images/Painting/thumbs/Painting%204_thumb.jpg') }}" alt=""></div>
          <h4 class="jury-slide-name">Vikram Nair</h4>
          <span class="jury-slide-role">Gemologist &amp; Craft Historian</span>
        </div>
        <div class="jury-slide" aria-hidden="true">
          <div class="jury-slide-img"><img src="{{ asset('deitiesdesignawardsdda/inspiration%20pdf%20and%20images/Painting/thumbs/Painting%205_thumb.jpg') }}" alt=""></div>
          <h4 class="jury-slide-name">Ananya Desai</h4>
          <span class="jury-slide-role">Founder, Sacred Design Studio</span>
        </div>
      </div>
    </div>
  </section>

  <!--  PARTNERS BAND (gold) — logos, click through to Partners page  -->
  <section class="partners-band logo-variant">
    <div class="partners-collage-wash" aria-hidden="true"></div>
    <div class="partners-inner">
      <div class="partners-group">
        <div class="partners-label">Organised By</div>
        <div class="partners-logo-list">
          <a href="{{ url('/deitiesdesignawards/partners') }}" class="partner-logo-item">
            <span class="partner-logo-link">
              <img src="{{ asset('dda-assets/images/JNLogo.svg') }}" alt="Jewellery Networking">
            </span>
            <span class="partner-logo-name">Jewellery Networking</span>
          </a>
        </div>
      </div>
      <div class="partners-group">
        <div class="partners-label">Supported By</div>
        <div class="partners-logo-list">
          <a href="{{ url('/deitiesdesignawards/partners') }}" class="partner-logo-item">
            <span class="partner-logo-link">
              <img src="{{ asset('dda-assets/images/jab-logo.png') }}" alt="Jewellers Association Bengaluru">
            </span>
            <span class="partner-logo-name">Jewellers Association Bengaluru</span>
          </a>
          <a href="{{ url('/deitiesdesignawards/partners') }}" class="partner-logo-item">
            <span class="partner-logo-link">
              <img src="{{ asset('dda-assets/images/iskcon_logo.svg') }}" alt="ISKCON Chowpatty">
            </span>
            <span class="partner-logo-name">ISKCON Chowpatty</span>
          </a>
        </div>
      </div>
    </div>
  </section>


  <!--  FOOTER  -->
  <!-- FAQ -->

  <footer>
    <div class="footer-top">
      <div class="footer-brand">
        <img src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards">
        <div class="footer-socials">
          <a href="https://www.instagram.com/deitiesdesignawards" target="_blank" rel="noopener" class="footer-social" aria-label="Instagram">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <rect x="3" y="3" width="18" height="18" rx="4" />
              <circle cx="12" cy="12" r="4" />
              <circle cx="17.5" cy="6.5" r="1" fill="currentColor" />
            </svg>
          </a>
          <a href="https://www.facebook.com/profile.php?id=61578502570613" target="_blank" rel="noopener" class="footer-social" aria-label="Facebook">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path d="M14 8h-2a2 2 0 0 0-2 2v2H8v3h2v7h3v-7h2.5l.5-3H13v-1.5c0-.5.5-1 1-1h2V8z" />
            </svg>
          </a>
          <a href="https://www.youtube.com/@DeitiesDesignAwards" target="_blank" rel="noopener" class="footer-social" aria-label="YouTube"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="6" width="18" height="12" rx="3"/><path d="M10 9.75v4.5L15 12l-5-2.25z" fill="currentColor" stroke="none"/></svg></a>
        </div>
      </div>
      <div class="footer-col">
        <h5>Explore</h5>
        <ul>
          <li><a href="{{ url('/deitiesdesignawards/about') }}">About DDA</a></li>
          <li><a href="{{ url('/deitiesdesignawards/categories') }}">Categories</a></li>
          <li><a href="{{ url('/deitiesdesignawards/inspiration') }}">Inspiration</a></li>
          <li><a href="{{ url('/deitiesdesignawards/participate') }}#dates">Calendar</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h5>Participate</h5>
        <ul>
          <li><a href="{{ url('/deitiesdesignawards/participate') }}#how-to-enter">How to Enter</a></li>
          <li><a href="{{ url('/deitiesdesignawards/participate') }}#fees">Fees</a></li>
          <li><a href="{{ url('/deitiesdesignawards/participate') }}#guidelines">Guidelines</a></li>
          <li><a href="{{ url('/deitiesdesignawards/faq') }}">FAQ</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h5>Contact</h5>
        <ul>
          <li><a href="tel:+919819155544">+91 98191 55544</a></li>
          <li><a href="mailto:info@deitiesdesignawards.com">info@deitiesdesignawards.com</a></li>
          <li>Mumbai, India</li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <span>&#169; 2026 Deities Design Awards &#183; All Rights Reserved</span>
      <span><a href="{{ url('/deitiesdesignawards/terms') }}">Terms</a><a href="{{ url('/deitiesdesignawards/privacy') }}">Privacy</a><a href="{{ url('/deitiesdesignawards/terms') }}">Code of Conduct</a></span>
    </div>
  </footer>

  <script>
    const toggleBtn = document.querySelector('.mobile-menu-toggle');
    const drawer = document.querySelector('.mobile-menu-drawer');

    toggleBtn.addEventListener('click', () => {
      toggleBtn.classList.toggle('active');
      drawer.classList.toggle('active');
      document.body.classList.toggle('no-scroll');
    });

    // Close drawer when clicking outside
    document.addEventListener('click', (e) => {
      if (!drawer.contains(e.target) && !toggleBtn.contains(e.target) && drawer.classList.contains('active')) {
        toggleBtn.classList.remove('active');
        drawer.classList.remove('active');
        document.body.classList.remove('no-scroll');
      }
    });

    // Close drawer when clicking a link
    const drawerLinks = document.querySelectorAll('.mobile-menu-links > a.mob-link, .mob-dropdown-menu a');
    drawerLinks.forEach(link => {
      link.addEventListener('click', () => {
        toggleBtn.classList.remove('active');
        drawer.classList.remove('active');
        document.body.classList.remove('no-scroll');
      });
    });

    // Toggle dropdowns
    document.querySelectorAll('.mob-dropdown-toggle').forEach(toggle => {
      toggle.addEventListener('click', (e) => {
        e.stopPropagation();
        const menu = toggle.nextElementSibling;
        const chev = toggle.querySelector('.chev');

        document.querySelectorAll('.mob-dropdown-toggle').forEach(t => {
          if (t !== toggle) {
            t.nextElementSibling.classList.remove('open');
            t.querySelector('.chev').classList.remove('rotate');
          }
        });

        menu.classList.toggle('open');
        chev.classList.toggle('rotate');
      });
    });

    // Evil Eye Cursor
    const cursorContainer = document.getElementById('evil-eye-cursor');
    let mouseX = 0, mouseY = 0;

    const svgHTML = '<svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 3445.6 3445.6"><defs><style>.st0{fill:#170f15}.st1{fill:#fff}.st2{fill:#7bbae5}.st3{fill:#2d2c80}</style></defs><circle class="st3" cx="1722.8" cy="1722.8" r="1715.7"/><circle class="st1" cx="1722.8" cy="1722.8" r="1144"/><circle class="st2" cx="1722.8" cy="1722.8" r="638.6"/><circle class="st0" cx="1722.8" cy="1722.8" r="276.4" transform="translate(-713.6 1722.8) rotate(-45)"/></svg>';

    cursorContainer.innerHTML = svgHTML;
    const svg = cursorContainer.querySelector('svg');
    const pupil = svg.querySelector('.st0');
    const svgRect = svg.getBoundingClientRect();
    const centerX = 1722.8;
    const centerY = 1722.8;
    const maxDistance = 200;

    function updatePupilPosition() {
      const dx = mouseX - (cursorContainer.offsetLeft + 20);
      const dy = mouseY - (cursorContainer.offsetTop + 20);
      const distance = Math.sqrt(dx * dx + dy * dy);
      const angle = Math.atan2(dy, dx);
      const moveDistance = Math.min(distance, maxDistance) * 0.15;
      const newX = centerX + Math.cos(angle) * moveDistance;
      const newY = centerY + Math.sin(angle) * moveDistance;

      pupil.setAttribute('cx', newX);
      pupil.setAttribute('cy', newY);
    }

    document.addEventListener('mousemove', (e) => {
      mouseX = e.clientX;
      mouseY = e.clientY;
      cursorContainer.style.left = (mouseX - 20) + 'px';
      cursorContainer.style.top = (mouseY - 20) + 'px';
      updatePupilPosition();
    });
  </script>
</body>
</html>