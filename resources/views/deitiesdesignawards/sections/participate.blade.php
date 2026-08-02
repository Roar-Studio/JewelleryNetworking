<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>How to Participate — Deities Design Awards</title>
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
        <a class="nav-link active">Participate <span class="chev">&#x25BC;</span></a>
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
      <a href="{{ route('dda.login') }}"
   class="nav-cta"
   onclick="localStorage.setItem('redirectAfterLogin','{{ route('dda.submit') }}')">
    Register
</a>
      <button class="mobile-menu-toggle" aria-label="Toggle Menu"><span class="bar"></span><span class="bar"></span><span class="bar"></span></button>
    </div>
  </nav>
  <div class="mobile-menu-drawer">
    <div class="mobile-menu-logo"><img src="{{ asset('deitiesdesignawardsdda/Logo/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards"></div>
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
        <button class="mob-dropdown-toggle">Partners <span class="chev">▼</span></button>
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

<section class="page-hero-int wash-gold"
    style="
        background-image: url('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/participate.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    ">
    <div class="page-hero-int-content">

      <span class="page-hero-int-eyebrow">How to Participate</span>
      <h1 class="page-hero-int-title">Your journey to recognition.</h1>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="participate-tabs" id="participate-tabs">
        <button class="p-tab active" data-tab="how-to-enter">How to Enter</button>
        <button class="p-tab" data-tab="guidelines">Submission Guidelines</button>
        <button class="p-tab" data-tab="fees">Fees</button>
        <button class="p-tab" data-tab="dates">Important Dates</button>
      </div>

      <div class="p-panel active" id="tab-how-to-enter">
          <span class="section-eyebrow">The Process</span>
          <h2 class="section-title" style="margin-bottom:2rem">Five phases, one destination.</h2>
        
        <ol class="step-list">
          <li>
            <div class="step-num">01</div>
            <div class="step-content">
              <h4>Registration</h4>
              <p>Create your participant account and confirm your chosen category. Provide your details as a designer, brand, artisan or student.<br>Registration is free you only pay the submission fee when you are ready to submit.</p>
            </div>
          </li>
          <li>
            <div class="step-num">02</div>
            <div class="step-content">
              <h4>Entry Preparation</h4>
              <p>Prepare your entry materials including high-resolution images (JPEG/PNG, minimum 2000px on the long side), a design statement describing the piece&#x2019;s sacred intent and supporting technical documentation. Review the submission guidelines carefully before preparing your files.</p>
            </div>
          </li>
          <li>
            <div class="step-num">03</div>
            <div class="step-content">
              <h4>Submission</h4>
              <p>Complete the online submission form. Upload your images, fill in all required fields, pay the submission fee and confirm your declaration. You will receive a confirmation email with your entry reference number.</p>
            </div>
          </li>
          <li>
            <div class="step-num">04</div>
            <div class="step-content">
              <h4>Jury Evaluation</h4>
              <p>Your entry is reviewed through the DDA jury process, beginning with preliminary screening for eligibility, compliance and concept review, followed by final jury evaluation for design, execution and relevance. <a href="{{ url('/deitiesdesignawards/jury') }}#evaluation-criteria" style="color:var(--gold,#b8922a)">View the evaluation criteria</a>.</p>
            </div>
          </li>
          <li>
            <div class="step-num">05</div>
            <div class="step-content">
              <h4>Awards Ceremony</h4>
              <p>Shortlisted and winning entries are announced at the Deities Design Awards Ceremony 2026. Winners receive their trophy, citation and access to a dedicated winners&#x2019; gallery platform with year-round visibility.</p>
            </div>
          </li>
        </ol>
        <a href="{{ route('dda.login') }}"
   onclick="localStorage.setItem('redirectAfterLogin','{{ route('dda.submit') }}')" class="btn-gold" style="display:inline-flex;align-items:center;gap:.75rem;margin-top:2.5rem"><span>Begin Your Submission</span><span class="arrow">&#x2192;</span></a>
      </div>

      <div class="p-panel" id="tab-guidelines">
  
          <span class="section-eyebrow">Guidelines</span>
          <h2 class="section-title">Submission standards.</h2>
          <p>All entries must meet the following requirements to be considered for evaluation. <br>Submissions that do not comply with these guidelines may be disqualified without refund.</p>
          <br>
        <ul class="guidelines-list">
          <li><strong>Image format:</strong> JPEG or PNG only. No other formats accepted.</li>
          <li><strong>Resolution:</strong> Minimum 2000 pixels on the long side. Recommended 3000px+. Images must be sharp, well-lit and free of watermarks.</li>
          <li><strong>File size:</strong> Maximum 25 MB per image. Maximum 10 images per submission entry.</li>
          <li><strong>Image content:</strong> Images must show only the submitted piece. No stock backgrounds, props or models that distract from the jewellery are permitted.</li>
          <li><strong>No AI-generated or enhanced images:</strong> AI-generated or AI-enhanced images are strictly not allowed. Submitted images must be genuine, unedited-beyond-basic-correction photographs of the actual physical piece.</li>
          <li><strong>Multiple views:</strong> We recommend including at least 3 views front, detail/close-up and a contextual or scale shot.</li>
          <li><strong>Design statement:</strong> Required for all entries. Between 150 and 500 words describing the sacred inspiration, design intent, materials and techniques used.</li>
          <li><strong>Eligibility:</strong> Entries must represent work created within the past 3 years (2023-2026). Previously submitted entries to DDA are not eligible for resubmission.</li>
          <li><strong>Authenticity:</strong> All submitted work must be the original creation of the entrant. Collaborative work must be clearly disclosed with all contributors named.</li>
          <li><strong>Sacred intent:</strong> All entries must be jewellery created with explicit sacred, devotional or spiritual intent for deities, temples, religious occasions or spiritual practices.</li>
          <li><strong>Language:</strong> All written submissions must be in English. Hindi submissions may include an English translation.</li>
        </ul>
      </div>

      <div class="p-panel" id="tab-fees">
  
          <span class="section-eyebrow">Entry Fees</span>
          <h2 class="section-title">Investment in recognition.</h2>
          <p>Entry fees are structured around the Deities Categories. All fees are inclusive of GST.</p>

        <div class="fees-table-wrap">
        <table class="fees-table">
          <thead>
            <tr><th>Deities Categories</th><th>Fee</th><th>Details</th></tr>
          </thead>
          <tbody>
            <tr><td>Entry Fee</td><td><span class="fee-inr">INR &#8377;2,500</span> <span class="fee-gst">(incl. GST) /</span> <span class="fee-usd">USD $29</span></td><td>Participants are eligible to submit up to 2 categories, Category 1  Radharani or Gopinath. <br><br>One entry in any of the other Deity categories, in accordance with the competition guidelines.</td></tr>
            <tr><td>Special Category</td><td><span class="fee-inr">INR &#8377;9,000</span> <span class="fee-gst">(incl. GST) /</span> <span class="fee-usd">USD $99</span></td><td>Create 1 exclusive piece for any one deity</td></tr>
          </tbody>
        </table>
        </div>
        <p style="font-size:.85rem;opacity:.75;margin-top:1rem">Part of the participation proceeds will be donated to ISKCON Chowpatty.</p>
        <p style="font-size:.8rem;opacity:.6;font-style:italic">Fees are non-refundable unless mutually agreed upon.</p>
      </div>

      <div class="p-panel" id="tab-dates">
      
          <div class="dates-intro" style="text-align:center;margin-bottom:2.5rem">
            <!-- <h2 class="section-title">Key dates for Edition 1.</h2> -->
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
      <div class="footer-col"><h5>Explore</h5><ul><li><a href="{{ url('/deitiesdesignawards/about') }}">About DDA</a></li><li><a href="{{ url('/deitiesdesignawards/design-category') }}">Design Categories</a></li><li><a href="{{ url('/deitiesdesignawards/inspiration') }}">Inspiration</a></li><li><a href="{{ url('/deitiesdesignawards/participate') }}#dates">Calendar</a></li></ul></div>
      <div class="footer-col"><h5>Participate</h5><ul><li><a href="{{ url('/deitiesdesignawards/participate') }}#how-to-enter">How to Enter</a></li><li><a href="{{ url('/deitiesdesignawards/participate') }}#fees">Fees</a></li><li><a href="{{ url('/deitiesdesignawards/participate') }}#guidelines">Guidelines</a></li><li><a href="{{ url('/deitiesdesignawards/faq') }}">FAQ</a></li></ul></div>
      <div class="footer-col"><h5>Contact</h5><ul><li><a href="tel:+919819155544">+91 98191 55544</a></li><li><a href="mailto:info@deitiesdesignawards.com">info@deitiesdesignawards.com</a></li><li>Mumbai, India</li></ul></div>
    </div>
    <div class="footer-bottom">
      <span>&#169; 2026 Deities Design Awards &#183; All Rights Reserved</span>
      <span><a href="{{ url('/deitiesdesignawards/terms') }}">Terms</a><a href="{{ url('/deitiesdesignawards/privacy') }}">Privacy</a></span>
    </div>
  </footer>
  <script>
    const tb=document.querySelector('.mobile-menu-toggle'),dr=document.querySelector('.mobile-menu-drawer');
    tb.addEventListener('click',()=>{tb.classList.toggle('active');dr.classList.toggle('active');document.body.classList.toggle('no-scroll');});
    document.addEventListener('click',e=>{if(!dr.contains(e.target)&&!tb.contains(e.target)&&dr.classList.contains('active')){tb.classList.remove('active');dr.classList.remove('active');document.body.classList.remove('no-scroll');}});
    document.querySelectorAll('.mobile-menu-links > a.mob-link, .mob-dropdown-menu a').forEach(l=>l.addEventListener('click',()=>{tb.classList.remove('active');dr.classList.remove('active');document.body.classList.remove('no-scroll');}));
    document.querySelectorAll('.mob-dropdown-toggle').forEach(t=>{t.addEventListener('click',e=>{e.stopPropagation();const m=t.nextElementSibling,c=t.querySelector('.chev');document.querySelectorAll('.mob-dropdown-toggle').forEach(o=>{if(o!==t){o.nextElementSibling.classList.remove('open');o.querySelector('.chev').classList.remove('rotate');}});m.classList.toggle('open');c.classList.toggle('rotate');});});
    // Tab logic
    const tabs=document.querySelectorAll('.p-tab'),panels=document.querySelectorAll('.p-panel');
    tabs.forEach(tab=>{
      tab.addEventListener('click',()=>{
        tabs.forEach(t=>t.classList.remove('active'));
        panels.forEach(p=>p.classList.remove('active'));
        tab.classList.add('active');
        document.getElementById('tab-'+tab.dataset.tab).classList.add('active');
      });
    });
    // Hash-based deep link — works on load AND when the hash changes
    // (e.g. clicking a Participate dropdown / footer link while already on this page)
    function activateTabFromHash(scroll){
      const h=location.hash.replace('#','');
      if(!h) return;
      const bt=document.querySelector('.p-tab[data-tab="'+h+'"]');
      if(!bt) return;
      bt.click();
      if(scroll){
        const tabsEl=document.getElementById('participate-tabs');
        if(tabsEl){
          const y=tabsEl.getBoundingClientRect().top+window.scrollY-90;
          window.scrollTo({top:y,behavior:'smooth'});
        }
      }
    }
    activateTabFromHash(false);
    window.addEventListener('hashchange',()=>activateTabFromHash(true));

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