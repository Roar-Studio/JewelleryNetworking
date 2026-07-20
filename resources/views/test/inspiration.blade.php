<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inspiration — Deities Design Awards</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Aboreto&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,300;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('testdda/css/dda.css') }}">
</head>
<body>
  <div id="evil-eye-cursor" class="evil-eye-cursor"></div>
  <div class="announce">Inaugural Edition | 2026 <span class="pipe">|</span> Registration opens soon <span class="pipe">|</span> <a href="{{ url('/test/contact') }}">Be notified →</a></div>
  <nav>
    <a href="{{ url('/test') }}" class="nav-logo"><img src="{{ asset('testdda/Logo/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards"></a>
    <div class="nav-links">
      <a href="{{ url('/test') }}" class="nav-link">Home</a>
      <div class="has-dropdown">
        <a class="nav-link">Categories <span class="chev">&#x25BC;</span></a>
        <div class="dropdown">
          <span class="dropdown-label">Deities Category</span>
          <a href="{{ url('/test/design-category') }}#nitai">Nitai</a>
          <a href="{{ url('/test/design-category') }}#gaur">Gaur</a>
          <a href="{{ url('/test/design-category') }}#lalita">Lalita</a>
          <a href="{{ url('/test/design-category') }}#radharani-radha">Radharani / Radha</a>
          <a href="{{ url('/test/design-category') }}#gopinath-krishna">Gopinath / Krishna</a>
          <a href="{{ url('/test/design-category') }}#vishakhadevi">Vishakhadevi</a>
          <a href="{{ url('/test/design-category') }}#gopalji">Gopalji</a>
        </div>
      </div>
      <div class="has-dropdown">
        <a class="nav-link">Participate <span class="chev">&#x25BC;</span></a>
        <div class="dropdown">
          <a href="{{ url('/test/participate') }}#how-to-enter">How to Enter</a>
          <a href="{{ url('/test/participate') }}#guidelines">Submission Guidelines</a>
          <a href="{{ url('/test/participate') }}#fees">Fees</a>
          <a href="{{ url('/test/participate') }}#dates">Important Dates</a>
          <a href="{{ url('/test/jury') }}#evaluation-criteria">Judging Criteria</a>
        </div>
      </div>
      <a href="{{ url('/test/inspiration') }}" class="nav-link active">Inspiration</a>
      <div class="has-dropdown">
        <a class="nav-link">Partners <span class="chev">▼</span></a>
        <div class="dropdown">
          <a href="{{ url('/test/partners') }}">Our Partners</a>
          <a href="{{ url('/test/sponsor-us') }}">Be a Sponsor</a>
        </div>
      </div>
      <a href="{{ url('/test/about') }}" class="nav-link">About</a>
      <a href="{{ url('/test/contact') }}" class="nav-link">Contact</a>
    </div>
    <div class="nav-right">
      <button class="nav-icon" aria-label="Search"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg></button>
      <a href="{{ url('/test/submit') }}" class="nav-cta">Register</a>
      <button class="mobile-menu-toggle" aria-label="Toggle Menu"><span class="bar"></span><span class="bar"></span><span class="bar"></span></button>
    </div>
  </nav>
  <div class="mobile-menu-drawer">
    <div class="mobile-menu-logo"><img src="{{ asset('testdda/Logo/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards"></div>
    <div class="mobile-menu-links">
      <a href="{{ url('/test') }}" class="mob-link">Home</a>
      <div class="mob-dropdown">
        <button class="mob-dropdown-toggle">Categories <span class="chev">&#x25BC;</span></button>
        <div class="mob-dropdown-menu">
          <span class="dropdown-label">Deities Category</span>
          <a href="{{ url('/test/design-category') }}#nitai">Nitai</a>
          <a href="{{ url('/test/design-category') }}#gaur">Gaur</a>
          <a href="{{ url('/test/design-category') }}#lalita">Lalita</a>
          <a href="{{ url('/test/design-category') }}#radharani-radha">Radharani / Radha</a>
          <a href="{{ url('/test/design-category') }}#gopinath-krishna">Gopinath / Krishna</a>
          <a href="{{ url('/test/design-category') }}#vishakhadevi">Vishakhadevi</a>
          <a href="{{ url('/test/design-category') }}#gopalji">Gopalji</a>
        </div>
      </div>
      <div class="mob-dropdown">
        <button class="mob-dropdown-toggle">Participate <span class="chev">&#x25BC;</span></button>
        <div class="mob-dropdown-menu">
          <a href="{{ url('/test/participate') }}#how-to-enter">How to Enter</a>
          <a href="{{ url('/test/participate') }}#guidelines">Submission Guidelines</a>
          <a href="{{ url('/test/participate') }}#fees">Fees</a>
          <a href="{{ url('/test/participate') }}#dates">Important Dates</a>
          <a href="{{ url('/test/jury') }}#evaluation-criteria">Judging Criteria</a>
        </div>
      </div>
      <a href="{{ url('/test/inspiration') }}" class="mob-link">Inspiration</a>
      <div class="mob-dropdown">
        <button class="mob-dropdown-toggle">Partners <span class="chev">▼</span></button>
        <div class="mob-dropdown-menu">
          <a href="{{ url('/test/partners') }}">Our Partners</a>
          <a href="{{ url('/test/sponsor-us') }}">Be a Sponsor</a>
        </div>
      </div>
      <a href="{{ url('/test/about') }}" class="mob-link">About</a>
      <a href="{{ url('/test/contact') }}" class="mob-link">Contact</a>
      <a href="{{ url('/test/submit') }}" class="mob-register-btn">Register</a>
    </div>
  </div>

  <section
    class="page-hero-int wash-gold"
    style="background-image:url('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/INSPIRATION+PAGE.png');
           background-size:cover;
           background-position:center;
           background-repeat:no-repeat;">

    <div class="page-hero-int-content">
        <!-- <span class="page-hero-int-eyebrow">Inspiration</span> -->
        <h1 class="page-hero-int-title">Inspiration</h1>
    </div>

</section>


  <section class="section insp-banner-sec">
    <div class="container">
      

      <!-- Row 1 — full width banner with theme colour palette -->
      <div class="insp-row-full">
        <img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Inspiration+Banner+1.png') }}" alt="Inspiration collection" loading="lazy">
        <div class="insp-theme">
          <span class="insp-theme-label">Theme</span>
          <div class="insp-palette">
            <span class="insp-swatch" style="background:#A6192E">#A6192E</span>
            <span class="insp-swatch" style="background:#D66676">#D66676</span>
            <span class="insp-swatch" style="background:#3A8223">#3A8223</span>
            <span class="insp-swatch" style="background:#85752B">#85752B</span>
          </div>
        </div>
      </div>

      <!-- Rows 2 & 3 — two image sections per row, each with its buttons -->
      <div class="insp-grid2">
        <div class="insp-item">
          <div class="insp-tile"><img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Carving-insp.jpg') }}" alt="Carvings" loading="lazy"></div>
          <div class="insp-btncell">
            <button class="insp-btn insp-btn-gallery" onclick="openGallery('carvings')">Open Carving Gallery</button>
          </div>
        </div>
        <div class="insp-item">
          <div class="insp-tile"><img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Painting-insp.jpg') }}" alt="Painting" loading="lazy"></div>
          <div class="insp-btncell">
            <button class="insp-btn insp-btn-gallery" onclick="openGallery('paintings')">Open Painting Gallery</button>
          </div>
        </div>
        <div class="insp-item">
          <div class="insp-tile"><img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Wooden-insp.jpg') }}" alt="Wooden" loading="lazy"></div>
          <div class="insp-btncell">
            <button class="insp-btn insp-btn-gallery" onclick="openGallery('wooden')">Open Wooden Gallery</button>
          </div>
        </div>
        <div class="insp-item">
          <div class="insp-tile"><img src="{{ asset('testdda/Images\Banner\Deities-insp.jpg') }}" alt="Deities" loading="lazy"></div>
          <div class="insp-btncell">
            <button class="insp-btn insp-btn-gallery" onclick="openGallery('deities')">Open Deities Gallery</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div class="footer-top">
      <div class="footer-brand">
        <img src="{{ asset('testdda/Logo/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards">

        <div class="footer-socials">
          <a href="https://www.instagram.com/deitiesdesignawards" target="_blank" rel="noopener" class="footer-social" aria-label="Instagram"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="4"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor"/></svg></a>
          <a href="https://www.facebook.com/profile.php?id=61578502570613" target="_blank" rel="noopener" class="footer-social" aria-label="Facebook"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 8h-2a2 2 0 0 0-2 2v2H8v3h2v7h3v-7h2.5l.5-3H13v-1.5c0-.5.5-1 1-1h2V8z"/></svg></a>
          <a href="https://www.youtube.com/@DeitiesDesignAwards" target="_blank" rel="noopener" class="footer-social" aria-label="YouTube"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="6" width="18" height="12" rx="3"/><path d="M10 9.75v4.5L15 12l-5-2.25z" fill="currentColor" stroke="none"/></svg></a>
        </div>
      </div>
      <div class="footer-col"><h5>Explore</h5><ul><li><a href="{{ url('/test/about') }}">About DDA</a></li><li><a href="{{ url('/test/categories') }}">Categories</a></li><li><a href="{{ url('/test/inspiration') }}">Inspiration</a></li><li><a href="{{ url('/test/participate') }}#dates">Calendar</a></li></ul></div>
      <div class="footer-col"><h5>Participate</h5><ul><li><a href="{{ url('/test/participate') }}#how-to-enter">How to Enter</a></li><li><a href="{{ url('/test/participate') }}#fees">Fees</a></li><li><a href="{{ url('/test/participate') }}#guidelines">Guidelines</a></li><li><a href="{{ url('/test/faq') }}">FAQ</a></li></ul></div>
      <div class="footer-col"><h5>Contact</h5><ul><li><a href="tel:+919819155544">+91 98191 55544</a></li><li><a href="mailto:info@deitiesdesignawards.com">info@deitiesdesignawards.com</a></li><li>Mumbai, India</li></ul></div>
    </div>
    <div class="footer-bottom">
      <span>&#169; 2026 Deities Design Awards &#183; All Rights Reserved</span>
      <span><a href="{{ url('/test/terms') }}">Terms</a><a href="{{ url('/test/privacy') }}">Privacy</a><a href="{{ url('/test/terms') }}">Code of Conduct</a></span>
    </div>
  </footer>
  <script>
    const tb=document.querySelector('.mobile-menu-toggle'),dr=document.querySelector('.mobile-menu-drawer');
    tb.addEventListener('click',()=>{tb.classList.toggle('active');dr.classList.toggle('active');document.body.classList.toggle('no-scroll');});
    document.addEventListener('click',e=>{if(!dr.contains(e.target)&&!tb.contains(e.target)&&dr.classList.contains('active')){tb.classList.remove('active');dr.classList.remove('active');document.body.classList.remove('no-scroll');}});
    document.querySelectorAll('.mobile-menu-links > a.mob-link, .mob-dropdown-menu a').forEach(l=>l.addEventListener('click',()=>{tb.classList.remove('active');dr.classList.remove('active');document.body.classList.remove('no-scroll');}));
    document.querySelectorAll('.mob-dropdown-toggle').forEach(t=>{t.addEventListener('click',e=>{e.stopPropagation();const m=t.nextElementSibling,c=t.querySelector('.chev');document.querySelectorAll('.mob-dropdown-toggle').forEach(o=>{if(o!==t){o.nextElementSibling.classList.remove('open');o.querySelector('.chev').classList.remove('rotate');}});m.classList.toggle('open');c.classList.toggle('rotate');});});

    // Evil Eye Cursor
    const cursorContainer = document.getElementById('evil-eye-cursor');
    let mouseX = 0, mouseY = 0;

    const svgHTML = '<svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 3445.6 3445.6"><defs><style>.st0{fill:#170f15}.st1{fill:#fff}.st2{fill:#7bbae5}.st3{fill:#2d2c80}</style></defs><circle class="st3" cx="1722.8" cy="1722.8" r="1715.7"/><circle class="st1" cx="1722.8" cy="1722.8" r="1144"/><circle class="st2" cx="1722.8" cy="1722.8" r="638.6"/><circle class="st0" cx="1722.8" cy="1722.8" r="276.4" transform="translate(-713.6 1722.8) rotate(-45)"/></svg>';

    cursorContainer.innerHTML = svgHTML;
    const svg = cursorContainer.querySelector('svg');
    const pupil = svg.querySelector('.st0');
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

    function openGallery(type) {
      window.location.href = `{{ url('/test/gallery') }}?category=${type}`;
    }
  </script>
</body>
</html>