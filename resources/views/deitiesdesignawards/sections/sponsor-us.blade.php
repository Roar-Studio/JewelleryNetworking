<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Be a Sponsor — Deities Design Awards</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Aboreto&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,300;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('dda-assets/css/dda.css') }}">
</head>
<body>
  <div id="evil-eye-cursor" class="evil-eye-cursor"></div>
  <div class="announce">Inaugural Edition | 2026 <span class="pipe">|</span> Registration opens soon <span class="pipe">|</span> <a href="{{ url('/deitiesdesignawards/contact') }}">Be notified →</a></div>
  <nav>
    <a href="{{ url('/deitiesdesignawards') }}" class="nav-logo"><img src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards"></a>
    <div class="nav-links">
      <a href="{{ url('/deitiesdesignawards') }}" class="nav-link">Home</a>
      <div class="has-dropdown">
        <a class="nav-link">Categories <span class="chev">▼</span></a>
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
        <a class="nav-link">Participate <span class="chev">▼</span></a>
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
        <a class="nav-link">Partners <span class="chev">▼</span></a>
        <div class="dropdown">
          <a href="{{ url('/deitiesdesignawards/partners') }}">Our Partners</a>
          <a href="{{ url('/deitiesdesignawards/sponsor-us') }}">Be a Sponsor</a>
        </div>
      </div>
      <a href="{{ url('/deitiesdesignawards/about') }}" class="nav-link">About</a>
      <a href="{{ url('/deitiesdesignawards/contact') }}" class="nav-link">Contact</a>
    </div>
    <div class="nav-right">
      <button class="nav-icon" aria-label="Search"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg></button>
      <a href="{{ url('/deitiesdesignawards/submit') }}" class="nav-cta">Register</a>
      <button class="mobile-menu-toggle" aria-label="Toggle Menu"><span class="bar"></span><span class="bar"></span><span class="bar"></span></button>
    </div>
  </nav>
  <div class="mobile-menu-drawer">
    <div class="mobile-menu-logo"><img src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards"></div>
    <div class="mobile-menu-links">
      <a href="{{ url('/deitiesdesignawards/index') }}" class="mob-link">Home</a>
      <div class="mob-dropdown">
        <button class="mob-dropdown-toggle">Categories <span class="chev">▼</span></button>
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
        <button class="mob-dropdown-toggle">Participate <span class="chev">▼</span></button>
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
        <button class="mob-dropdown-toggle">Partners <span class="chev">▼</span></button>
        <div class="mob-dropdown-menu">
          <a href="{{ url('/deitiesdesignawards/partners') }}">Our Partners</a>
          <a href="{{ url('/deitiesdesignawards/sponsor-us') }}">Be a Sponsor</a>
        </div>
      </div>
      <a href="{{ url('/deitiesdesignawards/about') }}" class="mob-link">About</a>
      <a href="{{ url('/deitiesdesignawards/contact') }}" class="mob-link">Contact</a>
      <a href="{{ url('/deitiesdesignawards/submit') }}" class="mob-register-btn">Register</a>
    </div>
  </div>

<section class="page-hero-int wash-gold"
    style="
        background-image: url('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/SPONSERs+(1).png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    ">
    <div class="page-hero-int-content">
      <h1 class="page-hero-int-title sponsor-hero-title">Partner with us.</h1>
    </div>
  </section>

  <section class="section" style="background:#fff;border-top:1px solid rgba(184,146,42,.12)">
    <div class="container">

        <div style="text-align:center;margin-bottom:3rem">
            <p style="max-width:740px;margin:1rem auto 0;font-size:.9rem;opacity:.7;line-height:1.8">
                DDA offers a unique opportunity to align your brand with devotion, heritage and creative excellence.<br>
                Our sponsorship packages are designed for brands that understand the power of sacred craft.
            </p>
        </div>

        <!-- ALL 3 CARDS INSIDE THE GRID -->
        <div class="sponsor-grid">

            <!-- Title Sponsor -->
            <div class="sponsor-tier-card">
                <span class="tier-label">Title Sponsor</span>

                <h4>INR &#8377;20 Lakhs + GST</h4>

                <div class="sponsor-card-actions">
                    <button type="button"
                        class="sponsor-read-more"
                        data-sponsor="title-sponsor">
                        Read More
                    </button>

                    <a href="{{ url('/deitiesdesignawards/contact') }}" class="btn-gold">
                        <span>Enquire</span>
                        <span class="arrow">→</span>
                    </a>
                </div>
            </div>

            <!-- Powered By -->
            <div class="sponsor-tier-card">
                <span class="tier-label">Powered By</span>

                <h4>INR &#8377;10 Lakh + GST</h4>

                <div class="sponsor-card-actions">
                    <button type="button"
                        class="sponsor-read-more"
                        data-sponsor="powered-by">
                        Read More
                    </button>

                    <a href="{{ url('/deitiesdesignawards/contact') }}" class="btn-gold">
                        <span>Enquire</span>
                        <span class="arrow">→</span>
                    </a>
                </div>
            </div>

            <!-- Logistics Partner -->
            <div class="sponsor-tier-card">
                <span class="tier-label">Logistics Partner</span>

                <h4>INR &#8377;5 Lakh + GST</h4>

                <div class="sponsor-card-actions">
                    <button type="button"
                        class="sponsor-read-more"
                        data-sponsor="logistics-partner">
                        Read More
                    </button>

                    <a href="{{ url('/deitiesdesignawards/contact') }}" class="btn-gold">
                        <span>Enquire</span>
                        <span class="arrow">→</span>
                    </a>
                </div>
            </div>

        </div>

        <p style="text-align:center;margin-top:1.5rem;font-size:.85rem;opacity:.6">
            For more details, mail us at
            <a href="mailto:info@deitiesdesignawards.com"
               style="color:var(--gold-deep,#8a7026)">
                info@deitiesdesignawards.com
            </a>
            or call
            <a href="tel:+919819155544"
               style="color:var(--gold-deep,#8a7026)">
                +91 98191 55544
            </a>
        </p>

    </div>
</section>

  <section class="section" style="background:#fff;border-top:1px solid rgba(184,146,42,.12)">
    <div class="container">
      <div style="text-align:center;margin-bottom:3rem">
        <h2 class="page-hero-int-title" style="font-size:2rem;margin-bottom:.5rem">Category Sponsorships</h2>
      </div>
      <div class="sponsor-grid">
        <div class="sponsor-tier-card">
          <span class="tier-label">Sponsor</span>
          <h4>INR &#8377;8 Lakhs + GST</h4>
          <div class="sponsor-card-actions">
            <button type="button" class="sponsor-read-more" data-sponsor="accessories-sponsor">Read More</button>
            <a href="{{ url('/deitiesdesignawards/contact') }}" class="btn-gold"><span>Enquire</span><span class="arrow">→</span></a>
          </div>
        </div>
        <div class="sponsor-tier-card">
          <span class="tier-label">Co-Sponsor</span>
          <h4>INR &#8377;4 Lakh + GST</h4>
          <div class="sponsor-card-actions">
            <button type="button" class="sponsor-read-more" data-sponsor="accessories-co-sponsor">Read More</button>
            <a href="{{ url('/deitiesdesignawards/contact') }}" class="btn-gold"><span>Enquire</span><span class="arrow">→</span></a>
          </div>
        </div>
        <div class="sponsor-tier-card">
          <span class="tier-label">Necklace Set</span>
          <h4>INR &#8377;6 Lakh + GST</h4>
          <div class="sponsor-card-actions">
            <button type="button" class="sponsor-read-more" data-sponsor="necklace-set">Read More</button>
            <a href="{{ url('/deitiesdesignawards/contact') }}" class="btn-gold"><span>Enquire</span><span class="arrow">→</span></a>
          </div>
        </div>
      </div>
      <div class="sponsor-grid" style="margin-top:2rem">
        <div class="sponsor-tier-card">
          <span class="tier-label">Choker</span>
          <h4>INR &#8377;6 Lakh + GST</h4>
          <div class="sponsor-card-actions">
            <button type="button" class="sponsor-read-more" data-sponsor="choker">Read More</button>
            <a href="{{ url('/deitiesdesignawards/contact') }}" class="btn-gold"><span>Enquire</span><span class="arrow">→</span></a>
          </div>
        </div>
        <div class="sponsor-tier-card">
          <span class="tier-label">Bangle / Bracelet</span>
          <h4>INR &#8377;6 Lakh + GST</h4>
          <div class="sponsor-card-actions">
            <button type="button" class="sponsor-read-more" data-sponsor="bangle-bracelet">Read More</button>
            <a href="{{ url('/deitiesdesignawards/contact') }}" class="btn-gold"><span>Enquire</span><span class="arrow">→</span></a>
          </div>
        </div>
        <!-- <div class="sponsor-tier-card">
          <span class="tier-label">Earrings</span>
          <h4>INR &#8377;6 Lakh + GST</h4>
          <div class="sponsor-card-actions">
            <button type="button" class="sponsor-read-more" data-sponsor="earrings">Read More</button>
            <a href="{{ url('/deitiesdesignawards/contact') }}" class="btn-gold"><span>Enquire</span><span class="arrow">→</span></a>
          </div>
        </div> -->
        <div class="sponsor-tier-card">
          <span class="tier-label">Special Category</span>
          <h4>INR &#8377;5 Lakh + GST</h4>
          <div class="sponsor-card-actions">
            <button type="button" class="sponsor-read-more" data-sponsor="special-category">Read More</button>
            <a href="{{ url('/deitiesdesignawards/contact') }}" class="btn-gold"><span>Enquire</span><span class="arrow">→</span></a>
          </div>
        </div>
      </div>
      <p style="text-align:center;margin-top:1.5rem;font-size:.85rem;opacity:.6">For more details, mail us at <a href="mailto:info@deitiesdesignawards.com" style="color:var(--gold-deep,#8a7026)">info@deitiesdesignawards.com</a> or call <a href="tel:+919819155544" style="color:var(--gold-deep,#8a7026)">+91 98191 55544</a></p>
    </div>
  </section>

  <!-- ============================================================
       SPONSOR READ MORE MODAL (single reusable instance)
       ============================================================ -->
  <div class="sponsor-modal-overlay" id="sponsorModalOverlay">
    <div class="sponsor-modal" role="dialog" aria-modal="true" aria-labelledby="sponsorModalTitle">
      <button type="button" class="sponsor-modal-close" id="sponsorModalClose" aria-label="Close">&times;</button>

      <div class="sponsor-modal-header">
        <div class="sponsor-modal-header-left">
          <span class="sponsor-modal-type" id="sponsorModalType"></span>
          <h2 class="sponsor-modal-title" id="sponsorModalTitle"></h2>
          <p class="sponsor-modal-price" id="sponsorModalPrice"></p>
        </div>
        <div class="sponsor-modal-header-right">
          <p class="sponsor-modal-tagline" id="sponsorModalTagline"></p>
        </div>
      </div>

      <div class="sponsor-modal-body">
        <div class="sponsor-modal-panel sponsor-modal-panel-left">
          <h3 class="sponsor-modal-panel-title" id="sponsorModalLeftTitle"></h3>
          <ul class="sponsor-modal-list" id="sponsorModalLeftList"></ul>
        </div>
        <div class="sponsor-modal-panel sponsor-modal-panel-right">
          <h3 class="sponsor-modal-panel-title" id="sponsorModalRightTitle"></h3>
          <ul class="sponsor-modal-list" id="sponsorModalRightList"></ul>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div class="footer-top">
      <div class="footer-brand">
        <img src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards">

        <div class="footer-socials">
          <a href="https://www.instagram.com/deitiesdesignawards" target="_blank" rel="noopener" class="footer-social" aria-label="Instagram"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="4"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor"/></svg></a>
          <a href="https://www.facebook.com/profile.php?id=61578502570613" target="_blank" rel="noopener" class="footer-social" aria-label="Facebook"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 8h-2a2 2 0 0 0-2 2v2H8v3h2v7h3v-7h2.5l.5-3H13v-1.5c0-.5.5-1 1-1h2V8z"/></svg></a>
          <a href="https://www.youtube.com/@DeitiesDesignAwards" target="_blank" rel="noopener" class="footer-social" aria-label="YouTube"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="6" width="18" height="12" rx="3"/><path d="M10 9.75v4.5L15 12l-5-2.25z" fill="currentColor" stroke="none"/></svg></a>
        </div>
      </div>
      <div class="footer-col"><h5>Explore</h5><ul><li><a href="{{ url('/deitiesdesignawards/about') }}">About DDA</a></li><li><a href="{{ url('/deitiesdesignawards/design-category') }}">Design Categories</a></li><li><a href="{{ url('/deitiesdesignawards/inspiration') }}">Inspiration</a></li><li><a href="{{ url('/deitiesdesignawards/participate') }}#dates">Calendar</a></li></ul></div>
      <div class="footer-col"><h5>Participate</h5><ul><li><a href="{{ url('/deitiesdesignawards/participate') }}#how-to-enter">How to Enter</a></li><li><a href="{{ url('/deitiesdesignawards/participate') }}#fees">Fees</a></li><li><a href="{{ url('/deitiesdesignawards/participate') }}#guidelines">Guidelines</a></li><li><a href="{{ url('/deitiesdesignawards/faq') }}">FAQ</a></li></ul></div>
      <div class="footer-col"><h5>Contact</h5><ul><li><a href="tel:+919819155544">+91 98191 55544</a></li><li><a href="mailto:info@deitiesdesignawards.com">info@deitiesdesignawards.com</a></li><li>Mumbai, India</li></ul></div>
    </div>
    <div class="footer-bottom">
      <span>© 2026 Deities Design Awards · All Rights Reserved</span>
      <span><a href="{{ url('/deitiesdesignawards/terms') }}">Terms</a><a href="{{ url('/deitiesdesignawards/privacy') }}">Privacy</a></span>
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
cursorContainer.style.position = 'fixed';
cursorContainer.style.zIndex = '999999';
cursorContainer.style.pointerEvents = 'none';
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

    // ============================================================
    // SPONSOR READ MORE MODAL
    // ============================================================
    (function () {
      const sponsorDetails = {
        "title-sponsor": {
          type: "TITLE SPONSOR",
          title: "TITLE SPONSOR",
          price: "₹20 LAKHS + GST",
          tagline: "Shape the Future of Deity Jewellery Design",
          leftTitle: "VISIBILITY & BRAND",
          left: [
            "Exclusive Title Sponsor naming rights",
            "Dominant branding across all DDA communication & website",
            "Prime venue & stage branding",
            "Social Media: 1 Dedicated Reel + 1 Post + 7–8 Stories",
            "Brand integration across finalist & winner announcements",
            "Speaking / Welcome Address opportunity"
          ],
          rightTitle: "EXPERIENCE & CONTENT",
          right: [
            "Present the Grand Award",
            "Premium display / activation space",
            "Dedicated brand photo & video moments",
            "Prominent PR & media visibility",
            "Professional content assets for brand use",
            "Rights to use \u201CTitle Sponsor – Deities Design Awards\u201D"
          ]
        },
        "powered-by": {
    type: "POWERED BY",
    title: "POWERED BY",
    price: "₹10 LAKH + GST",
    tagline: "Power the Awards. Amplify Your Brand.",

    leftTitle: "VISIBILITY & BRAND",

    left: [
        "Exclusive Powered By association",
        "Premium branding across key communication & website",
        "Prime venue branding",
        "Social Media: 1 Dedicated Post + 5–6 Stories",
        "Brand integration across key campaign communication",
        "Opportunity to present a Major Award"
    ],

    rightTitle: "EXPERIENCE & CONTENT",

    right: [
        "Speaking / brand integration opportunity",
        "Premium display space",
        "PR & media visibility",
        "Professional sponsor content assets",
        "Rights to use “Powered By Deities Design Awards”"
    ]
},
        "category-sponsor": {
          type: "CATEGORY SPONSOR",
          title: "CATEGORY SPONSOR",
          price: "₹7.50 LAKH + GST",
          tagline: "Content to be provided",
          leftTitle: "VISIBILITY & BRAND",
          left: ["Content to be provided"],
          rightTitle: "EXPERIENCE & CONTENT",
          right: ["Content to be provided"]
        },
        "media-sponsor": {
          type: "MEDIA SPONSOR",
          title: "MEDIA SPONSOR",
          price: "₹7.50 LAKH + GST",
          tagline: "Content to be provided",
          leftTitle: "VISIBILITY & BRAND",
          left: ["Content to be provided"],
          rightTitle: "EXPERIENCE & CONTENT",
          right: ["Content to be provided"]
        },
        "logistics-partner": {
    type: "LOGISTICS PARTNER",

    title: "OFFICIAL LOGISTICS PARTNER",

    price: "₹5 LAKHS + GST",

    tagline: "Making the Awards Experience Possible",

    leftTitle: "VISIBILITY & BRAND",

    left: [
        "Exclusive Official Logistics Partner status",
        "Branding across relevant event touchpoints",
        "Website & event collateral visibility",
        "Social Media: 1 Sponsor Announcement + 3–4 Stories",
        "Brand visibility during opening & closing"
    ],

    rightTitle: "EXPERIENCE & CONTENT",

    right: [
        "Opportunity to present an award",
        "Sponsor appreciation content",
        "Post-event recognition",
        "Rights to use “Official Logistics Partner – Deities Design Awards”"
    ]
},
        "accessories-sponsor": {
    type: "ACCESSORIES SPONSOR",
    title: "ACCESSORIES CATEGORY SPONSOR",
    price: "₹8 LAKHS + GST",

    tagline: "Maangtika | Paisley Kalgi With Mathapatti | Nose Ring | Waist Belt | Payal | Flute | Sticks",

    leftTitle: "VISIBILITY & BRAND",

    left: [
        "Exclusive Accessories Category presented by [Brand]",
        "Branding across all 6 sub-categories",
        "Social Media: 1 Dedicated Category Reel + 6–8 Stories",
        "Logo across all category creatives"
    ],

    rightTitle: "EXPERIENCE & CONTENT",

    right: [
        "Brand representative presents the Accessories Category Awards",
        "Premium category branding & activation opportunity",
        "Winner announcements & category content",
        "Professional photo & video assets"
    ]
},
        "accessories-co-sponsor": {
    type: "ACCESSORIES CO-SPONSOR",

    title: "ACCESSORIES CATEGORY CO-SPONSOR",

    price: "₹4 LAKHS + GST",

    tagline: "Maangtika | Paisley Kalgi With Mathapatti | Nose Ring | Waist Belt | Payal | Flute | Sticks",

    leftTitle: "VISIBILITY & BRAND",

    left: [
        "Accessories Category Co-Sponsor recognition",
        "Logo across category communication & website",
        "Category backdrop branding",
        "Social Media: 1 Category Story + 2–3 Campaign Stories"
    ],

    rightTitle: "EXPERIENCE & CONTENT",

    right: [
        "Opportunity to present one sub-category award* Winner photograph",
        "Ceremony mention",
        "Post-event brand recognition",
        "Digital sponsorship certificate"
    ]
},
        "necklace-set": {
    type: "ACCESSORIES",
    title: "CATEGORY SPONSOR(NECKLACE SET)",
    price: "₹6 LAKHS + GST",
    tagline: "Own a Jewellery Design Category",

    leftTitle: "VISIBILITY & BRAND",

    left: [
        "Exclusive Category Naming Rights",
        "Branding across category communication",
        "Social Media: 1 Category Post/Reel + 4–5 Stories",
        "Brand representative presents the category award"
    ],

    rightTitle: "EXPERIENCE & CONTENT",

    right: [
        "Logo on category award backdrop",
        "Winner photograph & social media announcement",
        "Post-event brand recognition",
        "Rights to use “Category Sponsor – Deities Design Awards”"
    ]
},

"choker": {
    type: "ACCESSORIES",
    title: "CATEGORY SPONSOR(CHOKER)",
    price: "₹6 LAKHS + GST",
    tagline: "Own a Jewellery Design Category",

    leftTitle: "VISIBILITY & BRAND",

    left: [
        "Exclusive Category Naming Rights",
        "Branding across category communication",
        "Social Media: 1 Category Post/Reel + 4–5 Stories",
        "Brand representative presents the category award"
    ],

    rightTitle: "EXPERIENCE & CONTENT",

    right: [
        "Logo on category award backdrop",
        "Winner photograph & social media announcement",
        "Post-event brand recognition",
        "Rights to use “Category Sponsor – Deities Design Awards”"
    ]
},

"bangle-bracelet": {
    type: "ACCESSORIES",
    title: "CATEGORY SPONSOR(BANGLE BRACELET)",
    price: "₹6 LAKHS + GST",
    tagline: "Own a Jewellery Design Category",

    leftTitle: "VISIBILITY & BRAND",

    left: [
        "Exclusive Category Naming Rights",
        "Branding across category communication",
        "Social Media: 1 Category Post/Reel + 4–5 Stories",
        "Brand representative presents the category award"
    ],

    rightTitle: "EXPERIENCE & CONTENT",

    right: [
        "Logo on category award backdrop",
        "Winner photograph & social media announcement",
        "Post-event brand recognition",
        "Rights to use “Category Sponsor – Deities Design Awards”"
    ]
},

"earrings": {
    type: "ACCESSORIES",
    title: "CATEGORY SPONSOR(EARRINGS)",
    price: "₹6 LAKHS + GST",
    tagline: "Own a Jewellery Design Category",

    leftTitle: "VISIBILITY & BRAND",

    left: [
        "Exclusive Category Naming Rights",
        "Branding across category communication",
        "Social Media: 1 Category Post/Reel + 4–5 Stories",
        "Brand representative presents the category award"
    ],

    rightTitle: "EXPERIENCE & CONTENT",

    right: [
        "Logo on category award backdrop",
        "Winner photograph & social media announcement",
        "Post-event brand recognition",
        "Rights to use “Category Sponsor – Deities Design Awards”"
    ]
},
        "special-category": {
    type: "ACCESSORIES",

    title: "SPECIAL CATEGORY SPONSOR",

    price: "₹5 LAKHS + GST",

    tagline: "Create an Award That Reflects Your Brand",

    leftTitle: "VISIBILITY & BRAND",

    left: [
        "Exclusive Category Naming Rights",
        "Digital & website presence",
        "Social Media: 1 Dedicated Digital Integration + 3–4 Stories",
        "Stage & award branding"
    ],

    rightTitle: "EXPERIENCE & CONTENT",

    right: [
        "Brand representative presents the sponsored award",
        "Winner photograph & announcement",
        "Post-event brand recognition",
        "Rights to leverage the sponsored award association"
    ]
},
      };

      const overlay = document.getElementById('sponsorModalOverlay');
      const closeBtn = document.getElementById('sponsorModalClose');
      const modal = overlay ? overlay.querySelector('.sponsor-modal') : null;

      const els = {
        type: document.getElementById('sponsorModalType'),
        title: document.getElementById('sponsorModalTitle'),
        price: document.getElementById('sponsorModalPrice'),
        tagline: document.getElementById('sponsorModalTagline'),
        leftTitle: document.getElementById('sponsorModalLeftTitle'),
        leftList: document.getElementById('sponsorModalLeftList'),
        rightTitle: document.getElementById('sponsorModalRightTitle'),
        rightList: document.getElementById('sponsorModalRightList')
      };

      function fillList(listEl, items) {
        if (!listEl) return;
        listEl.innerHTML = '';
        (items || []).forEach(function (item) {
          const li = document.createElement('li');
          li.textContent = item;
          listEl.appendChild(li);
        });
      }

      function openSponsorModal(key) {
        if (!overlay) return;
        const data = sponsorDetails[key];
        if (!data) return;

        if (els.type) els.type.textContent = data.type || '';
        if (els.title) els.title.textContent = data.title || '';
        if (els.price) els.price.textContent = data.price || '';
        if (els.tagline) els.tagline.textContent = data.tagline || '';
        if (els.leftTitle) els.leftTitle.textContent = data.leftTitle || '';
        if (els.rightTitle) els.rightTitle.textContent = data.rightTitle || '';
        fillList(els.leftList, data.left);
        fillList(els.rightList, data.right);

        overlay.classList.add('active');
        document.body.classList.add('sponsor-modal-open');
      }

      function closeSponsorModal() {
        if (!overlay) return;
        overlay.classList.remove('active');
        document.body.classList.remove('sponsor-modal-open');
      }

      document.querySelectorAll('.sponsor-read-more').forEach(function (btn) {
        btn.addEventListener('click', function () {
          const key = btn.getAttribute('data-sponsor');
          openSponsorModal(key);
        });
      });

      if (closeBtn) {
        closeBtn.addEventListener('click', closeSponsorModal);
      }

      if (overlay) {
        overlay.addEventListener('click', function (e) {
          if (e.target === overlay) {
            closeSponsorModal();
          }
        });
      }

      if (modal) {
        modal.addEventListener('click', function (e) {
          e.stopPropagation();
        });
      }

      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && overlay && overlay.classList.contains('active')) {
          closeSponsorModal();
        }
      });
    })();
  </script>
</body>
</html>