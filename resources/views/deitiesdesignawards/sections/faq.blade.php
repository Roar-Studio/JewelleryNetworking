<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ — Deities Design Awards</title>
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
      <a href="{{ url('/deitiesdesignawards') }}" class="mob-link">Home</a>
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
        background-image: url('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/JURY.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    ">
    
    <div class="page-hero-int-content">
      <span class="page-hero-int-eyebrow">FAQs</span>
      <h1 class="page-hero-int-title">Frequently Asked<br>Questions</h1>
      <p class="page-hero-int-sub">Find answers to common questions about the Deities Design Awards.</p>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="faq-list">
        <div class="faq-item">
          <button class="faq-q">Who can participate in DDA? <span class="faq-chev">+</span></button>
          <div class="faq-a">
            <p>Open to participants worldwide, the Deities Design Awards invites entries from jewellery designers, accessory designers, artists, artisans, craftspeople, design studios, jewellery brands, manufacturers, students, educational institutions and creative professionals from allied disciplines. The awards are open to anyone eligible under the competition guidelines whose work reflects excellence in spiritual, devotional and deity-inspired design.</p>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-q">What types of jewellery can be submitted? <span class="faq-chev">+</span></button>
          <div class="faq-a">
            <p>All entries must align with the theme and requirements of the respective competition and should draw inspiration from faith, devotion, spirituality, cultural heritage, temple traditions, sacred symbolism, deity adornment and related religious or ceremonial practices.</p>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-q">Can I submit a design concept instead of a finished piece? <span class="faq-chev">+</span></button>
          <div class="faq-a">
            <p>Yes. The competition begins with the submission of original design concepts, sketches, renderings or digital presentations. Following the judging process, selected designs will be required to be manufactured as finished jewellery pieces in accordance with the competition requirements and timelines.</p>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-q">Can I submit more than one entry? <span class="faq-chev">+</span></button>
          <div class="faq-a">
            <p>Yes. Multiple submissions are permitted, provided each entry is submitted separately and complies with the competition guidelines.</p>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-q">How will entries be judged? <span class="faq-chev">+</span></button>
          <div class="faq-a">
            <p>Entries will be evaluated on creativity, craftsmanship originality, cultural relevance, execution, innovation and alignment with the competition theme.</p>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-q">What do winners receive? <span class="faq-chev">+</span></button>
          <div class="faq-a">
            <p>Winners will receive industry recognition, awards, certificates and extensive media visibility across DDA&rsquo;s platforms and partner networks. In addition, winning creations will have the unique opportunity to be ceremonially offered to a globally renowned spiritual institution, becoming part of its sacred adornment traditions. Winners may also benefit from media coverage, recognition and promotional opportunities generated through the associated temple or spiritual centre, further enhancing the visibility and legacy of their work among devotees, cultural communities and the wider public.</p>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-q">Will winning designs be manufactured? <span class="faq-chev">+</span></button>
          <div class="faq-a">
            <p>Following the selection process, finalists will have the unique opportunity to collaborate with esteemed jewellery manufacturers to realise their designs as exceptional handcrafted creations destined for divine adornment.</p>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-q">Can international participants enter? <span class="faq-chev">+</span></button>
          <div class="faq-a">
            <p>Yes. DDA welcomes submissions from participants across India and internationally.</p>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-q">Is my submission confidential? <span class="faq-chev">+</span></button>
          <div class="faq-a">
            <p>All entries and submissions will remain confidential throughout the judging process. Shortlisted and winning entries may be publicly showcased with due credit to the creator.</p>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-q">What if my design is not commercially feasible to manufacture? <span class="faq-chev">+</span></button>
          <div class="faq-a">
            <p>Entries will be assessed on creativity, concept, craftsmanship, relevance and feasibility. Innovative concepts are encouraged.</p>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-q">Are sponsorship opportunities available? <span class="faq-chev">+</span></button>
          <div class="faq-a">
            <p>Yes. DDA offers a range of sponsorship and partnership opportunities for brands, manufacturers, gemstone companies, institutions and organisations from both within and beyond the jewellery industry.</p>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-q">How can I attend the awards ceremony or gala? <span class="faq-chev">+</span></button>
          <div class="faq-a">
            <p>Attendance details will be announced closer to the event and may be available through invitation, registration, sponsorship or partner participation.</p>
          </div>
        </div>
        <div class="faq-item">
          <button class="faq-q">What makes DDA unique? <span class="faq-chev">+</span></button>
          <div class="faq-a">
            <p>DDA is a first-of-its-kind platform celebrating devotion through design. By connecting exceptional craftsmanship with living spiritual traditions, the awards offer selected creations the rare opportunity to become part of the sacred adornment and cultural legacy of globally respected spiritual institutions.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

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
      <span>© 2026 Deities Design Awards · All Rights Reserved</span>
      <span><a href="{{ url('/deitiesdesignawards/terms') }}">Terms</a><a href="{{ url('/deitiesdesignawards/privacy') }}">Privacy</a><a href="{{ url('/deitiesdesignawards/terms') }}">Code of Conduct</a></span>
    </div>
  </footer>
  <script>
    const tb=document.querySelector('.mobile-menu-toggle'),dr=document.querySelector('.mobile-menu-drawer');
    tb.addEventListener('click',()=>{tb.classList.toggle('active');dr.classList.toggle('active');document.body.classList.toggle('no-scroll');});
    document.addEventListener('click',e=>{if(!dr.contains(e.target)&&!tb.contains(e.target)&&dr.classList.contains('active')){tb.classList.remove('active');dr.classList.remove('active');document.body.classList.remove('no-scroll');}});
    document.querySelectorAll('.mobile-menu-links > a.mob-link, .mob-dropdown-menu a').forEach(l=>l.addEventListener('click',()=>{tb.classList.remove('active');dr.classList.remove('active');document.body.classList.remove('no-scroll');}));
    document.querySelectorAll('.mob-dropdown-toggle').forEach(t=>{t.addEventListener('click',e=>{e.stopPropagation();const m=t.nextElementSibling,c=t.querySelector('.chev');document.querySelectorAll('.mob-dropdown-toggle').forEach(o=>{if(o!==t){o.nextElementSibling.classList.remove('open');o.querySelector('.chev').classList.remove('rotate');}});m.classList.toggle('open');c.classList.toggle('rotate');});});

    // Accordion toggle script
    document.querySelectorAll('.faq-q').forEach(button => {
      button.addEventListener('click', () => {
        const item = button.parentElement;
        const chev = button.querySelector('.faq-chev');
        
        // Close other items
        document.querySelectorAll('.faq-item').forEach(otherItem => {
          if (otherItem !== item && otherItem.classList.contains('open')) {
            otherItem.classList.remove('open');
            otherItem.querySelector('.faq-chev').textContent = '+';
            otherItem.querySelector('.faq-chev').style.transform = '';
          }
        });
        
        item.classList.toggle('open');
        if (item.classList.contains('open')) {
          chev.textContent = '−';
          chev.style.transform = 'rotate(180deg)';
        } else {
          chev.textContent = '+';
          chev.style.transform = '';
        }
      });
    });

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