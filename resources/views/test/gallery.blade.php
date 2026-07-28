<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inspiration Gallery — Deities Design Awards</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Aboreto&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,300;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('testdda/css/dda.css') }}">
  <style>
    .gallery-filter-tabs {
      display: flex;
      gap: 1rem;
      justify-content: center;
      margin: 2rem 0;
      flex-wrap: wrap;
    }

    .gallery-tab-btn {
      padding: 0.75rem 1.5rem;
      background: transparent;
      border: 2px solid var(--gold);
      color: var(--gold);
      font-family: var(--body);
      font-size: 0.9rem;
      font-weight: 500;
      letter-spacing: 0.05em;
      cursor: pointer;
      transition: all 0.3s ease;
      text-transform: uppercase;
    }

    .gallery-tab-btn:hover,
    .gallery-tab-btn.active {
      background: var(--gold);
      color: var(--brown);
    }

    .deity-filter-tabs {
      display: none;
      gap: 0.65rem;
      margin: -0.75rem 0 2rem;
    }

    .deity-filter-tabs .gallery-tab-btn {
      padding: 0.55rem 1rem;
      border-width: 1px;
      font-size: 0.72rem;
      letter-spacing: 0.04em;
    }

    .gallery-pdf-wrap {
      display: flex;
      justify-content: center;
      margin: 0 0 1rem;
    }

    .gallery-pdf-btn {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.7rem 1.6rem;
      background: var(--gold);
      color: var(--brown);
      border: 2px solid var(--gold);
      font-family: var(--body);
      font-size: 0.85rem;
      font-weight: 500;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      text-decoration: none;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .gallery-pdf-btn:hover {
      background: var(--gold-deep);
      border-color: var(--gold-deep);
      color: #fff;
    }

    .gallery-pdf-btn svg {
      width: 16px;
      height: 16px;
    }

    .gallery-masonry {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 1.5rem;
      margin-top: 2rem;
    }

    .gal-item {
      position: relative;
      overflow: hidden;
      aspect-ratio: 3 / 4;
      cursor: pointer;
      border: 1px solid rgba(184,146,42,0.15);
      background: rgba(184,146,42,0.05);
    }

    .gal-item img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      padding: 0.5rem;
      transition: transform 0.3s ease;
    }

    .gal-item:hover img {
      transform: scale(1.05);
    }

    .gal-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(42, 31, 16, 0.8);
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .gal-item:hover .gal-overlay {
      opacity: 1;
    }

    .gal-overlay span {
      color: var(--gold);
      font-size: 0.9rem;
      text-align: center;
      font-weight: 500;
    }

    .lightbox {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0,0,0,0.9);
      z-index: 1000;
      align-items: center;
      justify-content: center;
    }

    .lightbox.active {
      display: flex;
    }

    .lightbox-content {
      position: relative;
      max-width: 90vw;
      max-height: 90vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .lightbox-img {
      max-width: 90vw;
      max-height: 90vh;
      width: auto;
      height: auto;
      object-fit: contain;
    }

    .lightbox-loading {
      display: none;
      color: var(--gold);
      font-family: var(--body);
      font-size: 0.9rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
    }

    .lightbox-content.loading .lightbox-img {
      display: none;
    }

    .lightbox-content.loading .lightbox-loading {
      display: block;
    }

    .lightbox-close {
      position: absolute;
      top: 2rem;
      right: 2rem;
      font-size: 2rem;
      color: white;
      cursor: pointer;
      background: none;
      border: none;
      padding: 0;
    }

    .lightbox-download {
      position: absolute;
      top: 2rem;
      right: 5rem;
      z-index: 1001;
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      padding: 0.5rem 1rem;
      background: var(--gold);
      color: var(--brown);
      font-family: var(--body);
      font-size: 0.8rem;
      font-weight: 500;
      letter-spacing: 0.05em;
      text-transform: uppercase;
      text-decoration: none;
      border: none;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .lightbox-download:hover {
      background: var(--gold-deep);
      color: white;
    }

    .lightbox-download svg {
      width: 16px;
      height: 16px;
    }

    .lightbox-nav {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      font-size: 2rem;
      color: white;
      cursor: pointer;
      background: none;
      border: none;
      padding: 1rem;
      z-index: 1001;
    }

    .lightbox-prev {
      left: 1rem;
    }

    .lightbox-next {
      right: 1rem;
    }

    .gallery-loading {
      text-align: center;
      padding: 3rem;
      color: var(--brown);
      opacity: 0.6;
    }

    .load-more-btn {
      display: block;
      margin: 3rem auto 0;
      padding: 0.75rem 2rem;
      background: var(--gold);
      color: var(--brown);
      border: none;
      font-family: var(--body);
      font-size: 0.9rem;
      font-weight: 500;
      letter-spacing: 0.05em;
      cursor: pointer;
      text-transform: uppercase;
      transition: all 0.3s ease;
    }

    .load-more-btn:hover {
      background: var(--gold-deep);
      color: white;
    }

    .load-more-btn:disabled {
      opacity: 0.5;
      cursor: not-allowed;
      background: var(--gold);
      color: var(--brown);
    }

    .gallery-info {
      text-align: center;
      margin-top: 1rem;
      font-size: 0.85rem;
      opacity: 0.6;
    }

    @media(max-width: 768px) {
      .gallery-masonry {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 1rem;
      }

      .lightbox-close {
        top: 1rem;
        right: 1rem;
        font-size: 1.5rem;
      }

      .lightbox-download {
        top: 1rem;
        right: 3.5rem;
        padding: 0.4rem 0.7rem;
        font-size: 0.7rem;
      }

      .lightbox-nav {
        font-size: 1.5rem;
        padding: 0.5rem;
      }
    }
  </style>
</head>
<body>
  <div id="evil-eye-cursor" class="evil-eye-cursor"></div>
  <div class="announce">Inaugural Edition | 2026 <span class="pipe">|</span> Registration opens soon <span class="pipe">|</span> <a href="{{ url('/test/contact') }}">Be notified →</a></div>
  <nav>
    <a href="{{ url('/test') }}" class="nav-logo"><img src="{{ asset('testdda/Logo/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards"></a>
    <div class="nav-links">
      <a href="{{ url('/test') }}" class="nav-link">Home</a>
      <div class="has-dropdown">
        <a class="nav-link">Categories <span class="chev">▼</span></a>
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
        <a class="nav-link">Participate <span class="chev">▼</span></a>
        <div class="dropdown">
          <a href="{{ url('/test/participate') }}#how-to-enter">How to Enter</a>
          <a href="{{ url('/test/participate') }}#guidelines">Submission Guidelines</a>
          <a href="{{ url('/test/participate') }}#fees">Fees</a>
          <a href="{{ url('/test/participate') }}#dates">Important Dates</a>
          <a href="{{ url('/test/jury') }}#evaluation-criteria">Judging Criteria</a>
        </div>
      </div>
      <a href="{{ url('/test/inspiration') }}" class="nav-link">Inspiration</a>
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
        <button class="mob-dropdown-toggle">Categories <span class="chev">▼</span></button>
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
        <button class="mob-dropdown-toggle">Participate <span class="chev">▼</span></button>
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

  <section class="page-hero-int wash-gold">
    <div class="page-hero-collage" aria-hidden="true">
      <img class="c1" src="{{ asset('testdda/inspiration%20pdf%20and%20images/Carving/thumbs/Carving%201_thumb.jpg') }}" alt="">
      <img class="c2" src="{{ asset('testdda/inspiration%20pdf%20and%20images/Painting/thumbs/Painting%201_thumb.jpg') }}" alt="">
      <img class="c3" src="{{ asset('testdda/inspiration%20pdf%20and%20images/Wooden/thumbs/Wooden%201_thumb.jpg') }}" alt="">
      <img class="c4" src="{{ asset('testdda/inspiration%20pdf%20and%20images/Wooden/thumbs/Wooden%202_thumb.jpg') }}" alt="">
      <img class="c5" src="{{ asset('testdda/inspiration%20pdf%20and%20images/Carving/thumbs/Carving%202_thumb.jpg') }}" alt="">
      <img class="c6" src="{{ asset('testdda/inspiration%20pdf%20and%20images/Painting/thumbs/Painting%202_thumb.jpg') }}" alt="">
    </div>
    <div class="page-hero-int-content">
      <span class="page-hero-int-eyebrow">Inspiration Gallery</span>
      <h1 class="page-hero-int-title">Sacred Design Inspiration</h1>
      <p class="page-hero-int-sub">Explore timeless craftsmanship, intricate details and devotional artistry.</p>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="gallery-filter-tabs">
        <button class="gallery-tab-btn active" data-category="all">All Images</button>
        <button class="gallery-tab-btn" data-category="carvings">Carvings</button>
        <button class="gallery-tab-btn" data-category="paintings">Painting</button>
        <button class="gallery-tab-btn" data-category="wooden">Wooden</button>
        <button class="gallery-tab-btn" data-category="deities">Deities</button>
      </div>
      <div class="gallery-filter-tabs deity-filter-tabs" id="deity-filter-tabs" aria-label="Filter deities">
        <button class="gallery-tab-btn deity-tab-btn active" data-deity="all">All Deities</button>
        <button class="gallery-tab-btn deity-tab-btn" data-deity="Natai">Natai</button>
        <button class="gallery-tab-btn deity-tab-btn" data-deity="Gaur">Gaur</button>
        <button class="gallery-tab-btn deity-tab-btn" data-deity="Lalita">Lalita</button>
        <button class="gallery-tab-btn deity-tab-btn" data-deity="Radha">Radharani / Radha</button>
        <button class="gallery-tab-btn deity-tab-btn" data-deity="Gopinath">Gopinath</button>
        <button class="gallery-tab-btn deity-tab-btn" data-deity="Krishna">Krishna</button>
        <button class="gallery-tab-btn deity-tab-btn" data-deity="Vishaka Devi">Vishakhadevi</button>
        <button class="gallery-tab-btn deity-tab-btn" data-deity="Gopalji">Gopalji</button>
        <button class="gallery-tab-btn deity-tab-btn" data-deity="All dietiestogether">All Together</button>
      </div>

      <div class="gallery-pdf-wrap">
        <a id="gallery-pdf-btn" class="gallery-pdf-btn" href="#" download style="display:none">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3v12M7 10l5 5 5-5M5 21h14"/></svg>
          <span>Download Inspiration PDF</span>
        </a>
      </div>

      <div id="gallery-container" class="gallery-masonry">
        <div class="gallery-loading">Loading images...</div>
      </div>
      <button id="load-more-btn" class="load-more-btn" onclick="loadMoreImages()">Load More</button>
      <div class="gallery-info" id="gallery-info"></div>
    </div>
  </section>

  <div class="lightbox" id="lightbox">
    <a class="lightbox-download" id="lightbox-download" href="#" download onclick="downloadImage(event)"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3v12M7 10l5 5 5-5M5 21h14"/></svg>Download</a>
    <button class="lightbox-close" onclick="closeLightbox()">✕</button>
    <button class="lightbox-nav lightbox-prev" onclick="previousImage()">❮</button>
    <div class="lightbox-content" id="lightbox-content">
      <span class="lightbox-loading" id="lightbox-loading">Loading full image…</span>
      <img class="lightbox-img" id="lightbox-img" src="" alt="">
    </div>
    <button class="lightbox-nav lightbox-next" onclick="nextImage()">❯</button>
  </div>

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
      <span>© 2026 Deities Design Awards · All Rights Reserved</span>
      <span><a href="{{ url('/test/terms') }}">Terms</a><a href="{{ url('/test/privacy') }}">Privacy</a><a href="{{ url('/test/terms') }}">Code of Conduct</a></span>
    </div>
  </footer>

  <script src="{{ asset('testdda/js/gallery-data.js') }}"></script>
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

    // Gallery functionality - data loaded from gallery-data.js
    const IMAGES_PER_LOAD = 20;
    let currentCategory = 'all';
    let currentImages = [];
    let currentImageIndex = 0;
    let imagesDisplayed = 0;
    let currentDeityFilter = 'all';

    // Inspiration PDF per category — shown as a download button above the grid
    const CATEGORY_PDFS = {
      wooden:    '{{ asset('testdda/inspiration%20pdf%20and%20images/Inspiration%20-%20Wooden.pdf') }}',
      carvings:  '{{ asset('testdda/inspiration%20pdf%20and%20images/Inspiration%20-%20Carvings.pdf') }}',
      deities:   '{{ asset('testdda/inspiration%20pdf%20and%20images/Inspiration%20-%20Deities.pdf') }}',
      paintings: '{{ asset('testdda/inspiration%20pdf%20and%20images/Inspiration%20-%20Painting.pdf') }}'
    };

    const CATEGORY_LABELS = {
      wooden:    'Wooden',
      carvings:  'Carvings',
      deities:   'Deities',
      paintings: 'Painting'
    };

    function updatePdfButton(category) {
      const btn = document.getElementById('gallery-pdf-btn');
      const pdf = CATEGORY_PDFS[category];
      if (pdf) {
        btn.href = pdf;
        btn.setAttribute('download', decodeURIComponent(pdf.split('/').pop()));
        btn.querySelector('span').textContent = `Download ${CATEGORY_LABELS[category]} Inspiration PDF`;
        btn.style.display = 'inline-flex';
      } else {
        btn.style.display = 'none';
      }
    }

    function getDeityGroup(img) {
      const source = decodeURIComponent(img.full || img.thumb || '');
      const match = source.match(/\/Deities\/([^/]+)\//);
      return match ? match[1] : '';
    }

    function updateDeityFilters(category) {
      const filters = document.getElementById('deity-filter-tabs');
      if (!filters) return;

      filters.style.display = category === 'deities' ? 'flex' : 'none';

      if (category !== 'deities') {
        currentDeityFilter = 'all';
        filters.querySelectorAll('.deity-tab-btn').forEach(btn => {
          btn.classList.toggle('active', btn.dataset.deity === 'all');
        });
      }
    }

    function getImagesForCategory(category) {
      if (category === 'all') {
        return [...galleryData.wooden, ...galleryData.carvings, ...galleryData.deities, ...galleryData.paintings];
      }

      const images = galleryData[category] || [];
      if (category !== 'deities' || currentDeityFilter === 'all') {
        return images;
      }

      return images.filter(img => getDeityGroup(img) === currentDeityFilter);
    }

    function renderGallery(category) {
      const container = document.getElementById('gallery-container');
      const allImages = getImagesForCategory(category);

      currentImages = allImages;
      imagesDisplayed = 0;
      container.innerHTML = '';

      updateDeityFilters(category);
      updatePdfButton(category);
      loadMoreImages();
    }

    function loadMoreImages() {
      const container = document.getElementById('gallery-container');
      const loadBtn = document.getElementById('load-more-btn');
      const infoDiv = document.getElementById('gallery-info');

      const startIdx = imagesDisplayed;
      const endIdx = Math.min(imagesDisplayed + IMAGES_PER_LOAD, currentImages.length);
      const imagesToAdd = currentImages.slice(startIdx, endIdx);

      const html = imagesToAdd.map((img, idx) => `
        <div class="gal-item" onclick="openLightbox(${startIdx + idx})">
          <img src="${img.thumb}" alt="Gallery image" loading="lazy">
          <div class="gal-overlay"><span>View Image</span></div>
        </div>
      `).join('');

      container.innerHTML += html;
      imagesDisplayed = endIdx;

      // Update load more button
      if (imagesDisplayed >= currentImages.length) {
        loadBtn.style.display = 'none';
        infoDiv.textContent = `Showing all ${currentImages.length} images`;
      } else {
        loadBtn.style.display = 'block';
        infoDiv.textContent = `Showing ${imagesDisplayed} of ${currentImages.length} images`;
      }
    }

    function showFullImage(src) {
      const content = document.getElementById('lightbox-content');
      const img = document.getElementById('lightbox-img');
      const dl = document.getElementById('lightbox-download');
      content.classList.add('loading');
      // Point the download link at the full image, using the original filename
      dl.href = src;
      dl.setAttribute('download', decodeURIComponent(src.split('/').pop()));
      const loader = new Image();
      loader.onload = () => {
        img.src = src;
        content.classList.remove('loading');
      };
      loader.src = src;
    }

    async function downloadImage(e) {
      const dl = document.getElementById('lightbox-download');
      const src = dl.getAttribute('href');
      if (!src || src === '#') return;
      // Fetch as a blob so the browser saves the file instead of navigating to it
      e.preventDefault();
      try {
        const res = await fetch(src);
        const blob = await res.blob();
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = decodeURIComponent(src.split('/').pop());
        document.body.appendChild(a);
        a.click();
        a.remove();
        URL.revokeObjectURL(url);
      } catch (err) {
        // Fallback: open the image in a new tab if the fetch fails
        window.open(src, '_blank');
      }
    }

    function openLightbox(index) {
      currentImageIndex = index;
      document.getElementById('lightbox').classList.add('active');
      showFullImage(currentImages[index].full);
    }

    function closeLightbox() {
      document.getElementById('lightbox').classList.remove('active');
    }

    function nextImage() {
      currentImageIndex = (currentImageIndex + 1) % currentImages.length;
      showFullImage(currentImages[currentImageIndex].full);
    }

    function previousImage() {
      currentImageIndex = (currentImageIndex - 1 + currentImages.length) % currentImages.length;
      showFullImage(currentImages[currentImageIndex].full);
    }

    document.getElementById('lightbox').addEventListener('click', (e) => {
      if (e.target.id === 'lightbox') closeLightbox();
    });

    document.querySelectorAll('.gallery-tab-btn[data-category]').forEach(btn => {
      btn.addEventListener('click', (e) => {
        document.querySelectorAll('.gallery-tab-btn[data-category]').forEach(b => b.classList.remove('active'));
        e.currentTarget.classList.add('active');
        currentCategory = e.currentTarget.dataset.category;
        if (currentCategory !== 'deities') currentDeityFilter = 'all';
        renderGallery(currentCategory);
      });
    });

    document.querySelectorAll('.deity-tab-btn').forEach(btn => {
      btn.addEventListener('click', (e) => {
        document.querySelectorAll('.deity-tab-btn').forEach(b => b.classList.remove('active'));
        e.currentTarget.classList.add('active');
        currentDeityFilter = e.currentTarget.dataset.deity;
        currentCategory = 'deities';
        document.querySelectorAll('.gallery-tab-btn[data-category]').forEach(b => {
          b.classList.toggle('active', b.dataset.category === 'deities');
        });
        renderGallery(currentCategory);
      });
    });

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
      if (document.getElementById('lightbox').classList.contains('active')) {
        if (e.key === 'ArrowRight') nextImage();
        if (e.key === 'ArrowLeft') previousImage();
        if (e.key === 'Escape') closeLightbox();
      }
    });

    const urlParams = new URLSearchParams(window.location.search);
    const category = urlParams.get('category');
    const deity = urlParams.get('deity');
    if (category && galleryData[category]) {
      currentCategory = category;
      document.querySelector(`[data-category="${category}"]`).click();
      const deityBtn = [...document.querySelectorAll('.deity-tab-btn')].find(btn => btn.dataset.deity === deity);
      if (category === 'deities' && deityBtn) deityBtn.click();
    } else {
      renderGallery('all');
    }
  </script>
</body>
</html>