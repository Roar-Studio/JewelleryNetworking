<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About — Deities Design Awards</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Aboreto&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,300;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('dda-assets/css/dda.css') }}">
</head>
<body>
  <div id="evil-eye-cursor" class="evil-eye-cursor"></div>
  <div class="announce">Inaugural Edition | 2026 <span class="pipe">|</span> Registration opens soon <span class="pipe">|</span> <a href="{{ url('/deitiesdesignawards/contact') }}">Be notified &rarr;</a></div>
  <nav>
    <a href="{{ url('/deitiesdesignawards') }}" class="nav-logo"><img src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards"></a>
    <div class="nav-links">
      <a href="{{ url('/deitiesdesignawards') }}" class="nav-link">Home</a>
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
      <a href="{{ url('/deitiesdesignawards/about') }}" class="nav-link active">About</a>
      <a href="{{ url('/deitiesdesignawards/contact') }}" class="nav-link">Contact</a>
    </div>
    <div class="nav-right">
      <button class="nav-icon" aria-label="Search"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg></button>
      <a href="{{ route('dda.login') }}"
   class="nav-cta"
   onclick="localStorage.setItem('redirectAfterLogin','{{ route('dda.submit') }}')">
    Register
</a>
      <button class="mobile-menu-toggle" aria-label="Toggle Menu"><span class="bar"></span><span class="bar"></span><span class="bar"></span></button>
    </div>
  </nav>
  <div class="mobile-menu-drawer">
    <div class="mobile-menu-logo"><img src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards"></div>
    <div class="mobile-menu-links">
      <a href="{{ url('/deitiesdesignawards') }}" class="mob-link">Home</a>
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
      <a href="{{ url('/deitiesdesignawards/about') }}" class="mob-link active">About</a>
      <a href="{{ url('/deitiesdesignawards/contact') }}" class="mob-link">Contact</a>
      <a href="{{ route('dda.login') }}"
   class="mob-register-btn"
   onclick="localStorage.setItem('redirectAfterLogin','{{ route('dda.submit') }}')">
    Register
</a>
    </div>
  </div>

  <!-- <section class="page-hero-int">
    <div class="page-hero-int-content">
      <span class="page-hero-int-eyebrow">About the Awards</span>
      <h1 class="page-hero-int-title">A movement in sacred craft.</h1>
      <p class="page-hero-int-sub">It was always devotion</p>
    </div>
  </section> -->

 

  <section class="section" style="display:none;background:rgba(184,146,42,.04);border-top:1px solid rgba(184,146,42,.12);border-bottom:1px solid rgba(184,146,42,.12)">
    <div class="container">
      <div style="text-align:center;margin-bottom:3rem">
        <span class="section-eyebrow">The Five Pillars</span>
        <h2 class="section-title">The values that <span class="it">define this platform.</span></h2>
      </div>
      <div class="pillars-grid">
        <div class="pillar-card"><div class="pillar-icon">I</div><h4>Faith</h4><p>The sacred intention that inspires every creation and gives meaning to every design.</p></div>
        <div class="pillar-card"><div class="pillar-icon">II</div><h4>Artistry</h4><p>Creative vision transformed into timeless expressions of beauty and symbolism.</p></div>
        <div class="pillar-card"><div class="pillar-icon">III</div><h4>Craftsmanship</h4><p>The mastery of skilled hands that bring imagination and devotion to life.</p></div>
        <div class="pillar-card"><div class="pillar-icon">IV</div><h4>Devotion</h4><p>A heartfelt offering expressed through dedication, tradition and purpose.</p></div>
        <div class="pillar-card"><div class="pillar-icon">V</div><h4>Excellence</h4><p>The pursuit of quality, innovation and enduring impact.</p></div>
      </div>
    </div>
  </section>

  <section class="section">
      <div class="container">
      <span class="section-eyebrow">Founder Profile</span>
      <div class="founder-bio-grid">
        <div>
          <img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/founder.webp') }}" alt="Prernaa Makhariaa" class="founder-profile-photo" style="width:100%;aspect-ratio:4/5;object-fit:cover;border:1px solid rgba(184,146,42,.2);display:block">
          <div class="founder-bio-meta" style="margin-top:1.5rem;padding-top:1.25rem;border-top:1px solid rgba(184,146,42,.2)">
            <span class="founder-bio-name" style="display:block;font-family:var(--serif);font-size:1.4rem;font-style:italic;margin-bottom:.2rem">Prernaa Makhariaa</span>
            <span class="founder-bio-role" style="display:block;font-family:var(--body);font-size:.82rem;letter-spacing:.12em;text-transform:uppercase;color:var(--gold-deep,#8a7026);line-height:1.6">Founder &amp; Visionary,<br>Deities Design Awards (DDA).</span>
          </div>
        </div>
        <div>
          <blockquote style="font-family:var(--serif);font-size:1.5rem;font-style:italic;font-weight:300;line-height:1.65;border-left:2px solid var(--gold,#b8922a);padding-left:1.5rem;margin:0 0 2rem">&#x201C;BE CEEN: Connect, Engage, Empower and Network.&#x201D;</blockquote>
          <p>Prernaa Makhariaa, Founder and Visionary of the Deities Design Awards (DDA), is a seasoned entrepreneur and influential voice in the jewellery industry.</p>
          <br>
          <p>She is the founder of Jewellery Networking, a premier platform dedicated to helping the global jewellery community &#x201C;BE CEEN&#x201D; by providing a one-stop destination for businesses, service providers and service seekers to connect, engage, empower and network.</p>
          <br>
          <p>With over two decades of industry expertise, Prernaa is passionate about uniting the gems, jewellery and allied sectors, creating meaningful opportunities for collaboration, experiences, growth, learning and innovation across the global jewellery ecosystem.</p>
        </div>
      </div>
    </div>
  </section>


  <section class="section" style="background:rgba(184,146,42,.04);border-top:1px solid rgba(184,146,42,.12);border-bottom:1px solid rgba(184,146,42,.12)">
    <div class="container">
      <div style="text-align:center;margin-bottom:3rem">
        <span class="section-eyebrow">Mission &amp; Vision</span>
        <h2 class="section-title">Where Devotion Meets Design</h2>
      </div>
      <div class="vision-split">
        <div class="vision-card">
          <span class="vision-card-label">Mission Statement</span>
          <p>The Deities Design Awards is a globally travelling initiative dedicated to honouring exceptional jewellery design and craftsmanship. Hosted at a different spiritual destination each year, through this platform we aim to give back to society by encouraging jewellery that carries purpose, tells stories and upholds the finest traditions of craftsmanship and innovation for future generations.</p>
        </div>
        <div class="vision-card">
          <span class="vision-card-label">Vision Statement</span>
          <p>To cultivate a worldwide legacy that honors and promotes jewellery rooted in faith, tradition and heritage. By uniting unparalleled creative voices from across the globe, the platform aims to exhibit artistic excellence, safeguard cultural histories and advocate for craftsmanship as an enduring manifestation of human ingenuity.</p>
        </div>
      </div>
      <!-- <div class="tagline-center">It was always devotion</div> -->
    </div>
  </section>

 <!-- <section class="section about-deep-grid">
    <div class="container about-founder-wrap">
      <div class="about-deep-img" style="background-image:url('Images/Conceptual sacred jewellery composition crown, necklace, gemstones, temple motifs, dramatic editorial lighting.png');height:480px;background-size:cover;background-position:center"></div>
      <div>
        <span class="section-eyebrow">Founder&rsquo;s Note</span>
        <h2 class="section-title">A vision shaped by devotion.</h2>
        <p>Driven by a deep appreciation for both jewellery craftsmanship and culture, Prernaa Makhariaa founded the Deities Design Awards (DDA) to create a first-of-its-kind platform that celebrates jewellery inspired by faith, devotion and spiritual traditions. Her vision is to recognise creations that transcend into stories which transform into jewellery for the deities that are powerful expressions of heritage, spirituality and meaning.</p>
        <br>
        <p>The Deities Design Awards (DDA) is a deeply personal journey, born two years ago from a blend of spiritual devotion and a lifelong passion for jewellery. Having long admired the artistry inherent in deity adornment, I envisioned a platform that would invite talented designers to offer their creativity to the divine. This vision found its home at ISKCON Chowpatty, a serendipitous connection that transformed an idea into a mission.</p>
        <br>
        <p>While every significant project faces challenges, I believe everything unfolds for a higher reason&#x2014;leading to a meaningful partnership with the Jewellers Association Bengaluru (JAB). To witness this vision come to life and to play a part in the shringar (adornment) of the deities is an honour that still humbles me. It is, quite simply, the most meaningful endeavour of my career.</p>
      </div>
    </div>
  </section> -->
  
  
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
      <div class="footer-col"><h5>Explore</h5><ul><li><a href="{{ url('/deitiesdesignawards/about') }}">About DDA</a></li><li><a href="{{ url('/deitiesdesignawards/categories') }}">Categories</a></li><li><a href="{{ url('/deitiesdesignawards/inspiration') }}">Inspiration</a></li><li><a href="{{ url('/deitiesdesignawards/participate') }}#dates">Calendar</a></li></ul></div>
      <div class="footer-col"><h5>Participate</h5><ul><li><a href="{{ url('/deitiesdesignawards/participate') }}#how-to-enter">How to Enter</a></li><li><a href="{{ url('/deitiesdesignawards/participate') }}#fees">Fees</a></li><li><a href="{{ url('/deitiesdesignawards/participate') }}#guidelines">Guidelines</a></li><li><a href="{{ url('/deitiesdesignawards/faq') }}">FAQ</a></li></ul></div>
      <div class="footer-col"><h5>Contact</h5><ul><li><a href="tel:+919819155544">+91 98191 55544</a></li><li><a href="mailto:info@deitiesdesignawards.com">info@deitiesdesignawards.com</a></li><li>Mumbai, India</li></ul></div>
    </div>
    <div class="footer-bottom">
      <span>&#169; 2026 Deities Design Awards &#183; All Rights Reserved</span>
      <span><a href="{{ url('/deitiesdesignawards/terms') }}">Terms</a><a href="{{ url('/deitiesdesignawards/privacy') }}">Privacy</a><a href="{{ url('/deitiesdesignawards/terms') }}">Code of Conduct</a></span>
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
  </script>
</body>
</html>