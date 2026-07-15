<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Submit Entry — Deities Design Awards</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Aboreto&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,300;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('testdda/css/dda.css') }}">
</head>
<body>
  <div id="evil-eye-cursor" class="evil-eye-cursor"></div>
  <div class="announce">Inaugural Edition | 2026 <span class="pipe">|</span> Registration opens soon <span class="pipe">|</span> <a href="{{ url('/test/contact') }}">Be notified →</a></div>
  <nav>
    <a href="{{ url('/test/index') }}" class="nav-logo"><img src="{{ asset('testdda/Logo/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards"></a>
    <div class="nav-links">
      <a href="{{ url('/test/index') }}" class="nav-link">Home</a>
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
      <a href="{{ url('/test/submit') }}" class="nav-cta active">Register</a>
      <button class="mobile-menu-toggle" aria-label="Toggle Menu"><span class="bar"></span><span class="bar"></span><span class="bar"></span></button>
    </div>
  </nav>
  <div class="mobile-menu-drawer">
    <div class="mobile-menu-logo"><img src="{{ asset('testdda/Logo/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards"></div>
    <div class="mobile-menu-links">
      <a href="{{ url('/test/index') }}" class="mob-link">Home</a>
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

  <section class="page-hero-int wash-gold">
    <div class="page-hero-collage" aria-hidden="true">
      <img class="c1" src="inspiration%20pdf%20and%20images/Carving/thumbs/Carving%201_thumb.jpg" alt="">
      <img class="c2" src="inspiration%20pdf%20and%20images/Painting/thumbs/Painting%201_thumb.jpg" alt="">
      <img class="c3" src="inspiration%20pdf%20and%20images/Wooden/thumbs/Wooden%201_thumb.jpg" alt="">
      <img class="c4" src="inspiration%20pdf%20and%20images/Wooden/thumbs/Wooden%202_thumb.jpg" alt="">
      <img class="c5" src="inspiration%20pdf%20and%20images/Carving/thumbs/Carving%202_thumb.jpg" alt="">
      <img class="c6" src="inspiration%20pdf%20and%20images/Painting/thumbs/Painting%202_thumb.jpg" alt="">
    </div>
    <div class="page-hero-int-content">
      <span class="page-hero-int-eyebrow">Submit Your Entry</span>
      <h1 class="page-hero-int-title">Begin your <span class="it">submission.</span></h1>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="submit-layout">

        <aside class="submit-progress">
          <div class="submit-progress-title">Your Submission</div>
          <ul class="progress-steps">
            <li class="prog-step active" data-step="1"><span class="prog-num">1</span><span class="prog-label">Participant Info</span></li>
            <li class="prog-step" data-step="2"><span class="prog-num">2</span><span class="prog-label">Entry Details</span></li>
            <li class="prog-step" data-step="3"><span class="prog-num">3</span><span class="prog-label">Image Upload</span></li>
            <li class="prog-step" data-step="4"><span class="prog-num">4</span><span class="prog-label">Declaration</span></li>
          </ul>
          <div class="submit-sidebar-note">
            <p>All submissions first enter preliminary screening before proceeding to final jury evaluation. Ensure all images are JPEG or PNG format.</p>
            <p style="margin-top:.75rem"><a href="{{ url('/test/participate') }}#guidelines" style="color:var(--gold,#b8922a);font-size:.8rem">View submission guidelines &#x2192;</a></p>
          </div>
        </aside>

        <div class="submit-form-area">

          <!-- Step 1: Participant Info -->
          <div class="sub-panel active" id="sub-panel-1">
            <h3 class="sub-panel-title">Step 1 &#x2014; Participant Information</h3>
            <p class="sub-panel-desc">Tell us about yourself or your organisation.</p>
            <form id="form-step-1" novalidate>
              <div class="form-grid">
                <div class="form-field">
                  <label for="f-first">First Name <span class="req">*</span></label>
                  <input type="text" id="f-first" name="first_name" placeholder="Your first name" required>
                </div>
                <div class="form-field">
                  <label for="f-last">Last Name <span class="req">*</span></label>
                  <input type="text" id="f-last" name="last_name" placeholder="Your last name" required>
                </div>
                <div class="form-field full">
                  <label for="f-email">Email Address <span class="req">*</span></label>
                  <input type="email" id="f-email" name="email" placeholder="your@email.com" required>
                </div>
                <div class="form-field">
                  <label for="f-phone">Phone / WhatsApp</label>
                  <input type="tel" id="f-phone" name="phone" placeholder="+91 XXXXX XXXXX">
                </div>
                <div class="form-field">
                  <label for="f-city">City <span class="req">*</span></label>
                  <input type="text" id="f-city" name="city" placeholder="Mumbai" required>
                </div>
                <div class="form-field">
                  <label for="f-country">Country <span class="req">*</span></label>
                  <select id="f-country" name="country" required>
                    <option value="">Select country</option>
                    <option value="IN" selected>India</option>
                    <option value="AE">UAE</option>
                    <option value="US">United States</option>
                    <option value="GB">United Kingdom</option>
                    <option value="SG">Singapore</option>
                    <option value="other">Other</option>
                  </select>
                </div>
                <div class="form-field full">
                  <label for="f-org">Organisation / Studio Name</label>
                  <input type="text" id="f-org" name="organisation" placeholder="Your brand or studio (if applicable)">
                </div>
                <div class="form-field full">
                  <label for="f-category">Participant Type <span class="req">*</span></label>
                  <select id="f-category" name="participant_type" required>
                    <option value="">Select your category</option>
                    <option value="designer">Designer / Studio</option>
                    <option value="brand">Brand / Retailer</option>
                    <option value="artisan">Artisan / Manufacturer</option>
                    <option value="diamantaire">Diamantaire / Supplier</option>
                    <option value="student">Student</option>
                  </select>
                </div>
              </div>
              <div class="form-actions">
                <button type="button" class="btn-form-next" onclick="goStep(2)">Continue to Entry Details <span>&#x2192;</span></button>
              </div>
            </form>
          </div>

          <!-- Step 2: Entry Details -->
          <div class="sub-panel" id="sub-panel-2">
            <h3 class="sub-panel-title">Step 2 &#x2014; Entry Details</h3>
            <p class="sub-panel-desc">Tell us about your entry.</p>
            <form id="form-step-2" novalidate>
              <div class="form-grid">
                <div class="form-field full">
                  <label for="f-piece-name">Piece / Collection Name <span class="req">*</span></label>
                  <input type="text" id="f-piece-name" name="piece_name" placeholder="Name of the submitted piece or collection" required>
                </div>
                <div class="form-field full">
                  <label for="f-award-cat">Award Category <span class="req">*</span></label>
                  <select id="f-award-cat" name="award_category" required>
                    <option value="">Select award category</option>
                    <option value="designers-studios">Designers &amp; Studios</option>
                    <option value="brands-retailers">Brands &amp; Retailers</option>
                    <option value="artisans-manufacturers">Artisans &amp; Manufacturers</option>
                    <option value="diamantaires-suppliers">Diamantaires &amp; Suppliers</option>
                    <option value="student">Student Category</option>
                  </select>
                </div>
                <div class="form-field">
                  <label for="f-materials">Primary Materials <span class="req">*</span></label>
                  <input type="text" id="f-materials" name="materials" placeholder="e.g. 22k gold, rubies, enamel" required>
                </div>
                <div class="form-field">
                  <label for="f-year">Year Created <span class="req">*</span></label>
                  <select id="f-year" name="year" required>
                    <option value="">Select year</option>
                    <option value="2026">2026</option>
                    <option value="2025">2025</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                  </select>
                </div>
                <div class="form-field full">
                  <label for="f-deity">Deity / Occasion / Sacred Purpose <span class="req">*</span></label>
                  <input type="text" id="f-deity" name="deity" placeholder="e.g. Temple adornment for Goddess Lakshmi / Navratri" required>
                </div>
                <div class="form-field full">
                  <label for="f-statement">Design Statement <span class="req">*</span> <span class="field-note">(150&#x2013;500 words)</span></label>
                  <textarea id="f-statement" name="statement" rows="8" placeholder="Describe the sacred inspiration behind your piece, the design intent, the materials and techniques used and its connection to devotion or heritage..." required minlength="150"></textarea>
                  <div class="char-count"><span id="stmt-count">0</span> / 500 words</div>
                </div>
              </div>
              <div class="form-actions">
                <button type="button" class="btn-form-prev" onclick="goStep(1)"><span>&#x2190;</span> Back</button>
                <button type="button" class="btn-form-next" onclick="goStep(3)">Continue to Images <span>&#x2192;</span></button>
              </div>
            </form>
          </div>

          <!-- Step 3: Image Upload -->
          <div class="sub-panel" id="sub-panel-3">
            <h3 class="sub-panel-title">Step 3 &#x2014; Image Upload</h3>
            <p class="sub-panel-desc">Upload 1&#x2013;10 images of your entry. JPEG or PNG only. Maximum 25 MB per image.</p>

            <div class="upload-zone" id="upload-zone">
              <input type="file" id="file-input" accept="image/jpeg,image/png" multiple>
              <div class="upload-zone-inner">
                <div class="upload-icon">
                  <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="17 8 12 3 7 8"/>
                    <line x1="12" y1="3" x2="12" y2="15"/>
                  </svg>
                </div>
                <p class="upload-primary">Drag &amp; drop your images here</p>
                <p class="upload-secondary">or <button type="button" class="upload-browse" onclick="document.getElementById('file-input').click()">browse files</button></p>
                <p class="upload-hint">JPEG or PNG &bull; Max 25 MB each &bull; Up to 10 images</p>
              </div>
            </div>

            <div class="upload-count" id="upload-count" style="display:none"><span id="count-num">0</span> image(s) selected</div>
            <div class="upload-error" id="upload-error" style="display:none"></div>
            <div class="preview-grid" id="preview-grid"></div>

            <div class="form-actions" style="margin-top:2rem">
              <button type="button" class="btn-form-prev" onclick="goStep(2)"><span>&#x2190;</span> Back</button>
              <button type="button" class="btn-form-next" id="btn-to-step-4" onclick="goStep(4)">Continue to Declaration <span>&#x2192;</span></button>
            </div>
          </div>

          <!-- Step 4: Declaration -->
          <div class="sub-panel" id="sub-panel-4">
            <h3 class="sub-panel-title">Step 4 &#x2014; Declaration &amp; Submit</h3>
            <p class="sub-panel-desc">Please read and confirm the following declarations before submitting your entry.</p>
            <form id="form-step-4" novalidate>
              <div class="declaration-block">
                <div class="check-row">
                  <input type="checkbox" id="decl-1" required>
                  <label for="decl-1">I confirm that the submitted work is my original creation and I hold the rights to enter it in this competition.</label>
                </div>
                <div class="check-row">
                  <input type="checkbox" id="decl-2" required>
                  <label for="decl-2">I confirm that the submitted piece was created with sincere devotional, sacred or spiritual intent.</label>
                </div>
                <div class="check-row">
                  <input type="checkbox" id="decl-3" required>
                  <label for="decl-3">I confirm that all information provided in this submission is accurate and complete.</label>
                </div>
                <div class="check-row">
                  <input type="checkbox" id="decl-4" required>
                  <label for="decl-4">I grant Deities Design Awards the right to use submitted images for promotional, editorial and archival purposes with attribution.</label>
                </div>
                <div class="check-row">
                  <input type="checkbox" id="decl-5" required>
                  <label for="decl-5">I have read and agree to the <a href="{{ url('/test/terms') }}" target="_blank" style="color:var(--gold,#b8922a)">Terms &amp; Conditions</a> and <a href="{{ url('/test/privacy') }}" target="_blank" style="color:var(--gold,#b8922a)">Privacy Policy</a>.</label>
                </div>
              </div>

              <div class="submission-fee-note">
                <span class="sfn-label">Submission Fee</span>
                <p>The applicable fee will be displayed upon proceeding. Fees are non-refundable once your entry has entered preliminary screening.</p>
              </div>

              <div class="form-actions">
                <button type="button" class="btn-form-prev" onclick="goStep(3)"><span>&#x2190;</span> Back</button>
                <button type="submit" class="btn-form-next" id="btn-submit-final">Submit Entry <span>&#x2192;</span></button>
              </div>

              <div class="submit-success" id="submit-success" style="display:none">
                <div class="success-icon"></div>
                <h4>Submission Received</h4>
                <p>Thank you for entering the Deities Design Awards. You will receive a confirmation email at the address provided. Your entry reference number is <strong id="ref-num"></strong>.</p>
                <a href="{{ url('/test/index') }}" style="color:var(--gold,#b8922a);font-size:.85rem">Return to Homepage &#x2192;</a>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </section>
  <footer>
    <div class="footer-top">
      <div class="footer-brand">
        <img src="{{ asset('testdda/Logo/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards">
        <p>It was always devotion</p>
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
    // Step navigation
    function goStep(n){
      document.querySelectorAll('.sub-panel').forEach(p=>p.classList.remove('active'));
      document.querySelectorAll('.prog-step').forEach(s=>s.classList.remove('active','done'));
      document.getElementById('sub-panel-'+n).classList.add('active');
      document.querySelectorAll('.prog-step').forEach(s=>{
        const sn=parseInt(s.dataset.step);
        if(sn<n) s.classList.add('done');
        if(sn===n) s.classList.add('active');
      });
      window.scrollTo({top:document.querySelector('.submit-layout').offsetTop-80,behavior:'smooth'});
    }

    // File upload
    const zone=document.getElementById('upload-zone'),fi=document.getElementById('file-input');
    const grid=document.getElementById('preview-grid'),countEl=document.getElementById('upload-count'),cntNum=document.getElementById('count-num'),errEl=document.getElementById('upload-error');
    let files=[];

    function validateAndPreview(newFiles){
      errEl.style.display='none';
      const valid=[],errs=[];
      Array.from(newFiles).forEach(f=>{
        if(!['image/jpeg','image/png'].includes(f.type)){errs.push(f.name+': not JPEG or PNG');return;}
        if(f.size>25*1024*1024){errs.push(f.name+': exceeds 25 MB limit');return;}
        valid.push(f);
      });
      if(files.length+valid.length>10){errs.push('Maximum 10 images allowed.');valid.splice(0,Math.max(0,files.length+valid.length-10));}
      files=[...files,...valid];
      if(errs.length){errEl.textContent=errs.join(' | ');errEl.style.display='block';}
      renderPreviews();
    }

    function renderPreviews(){
      grid.innerHTML='';
      files.forEach((f,i)=>{
        const rd=new FileReader();
        rd.onload=e=>{
          const d=document.createElement('div');d.className='preview-thumb';
          d.innerHTML='<img src="'+e.target.result+'" alt="Preview '+i+'"><button class="preview-remove" data-idx="'+i+'" title="Remove">&times;</button>';
          grid.appendChild(d);
        };
        rd.readAsDataURL(f);
      });
      cntNum.textContent=files.length;
      countEl.style.display=files.length?'block':'none';
      grid.style.display=files.length?'grid':'none';
    }

    grid.addEventListener('click',e=>{
      if(e.target.classList.contains('preview-remove')){
        files.splice(parseInt(e.target.dataset.idx),1);renderPreviews();
      }
    });

    zone.addEventListener('dragover',e=>{e.preventDefault();zone.classList.add('drag-over');});
    zone.addEventListener('dragleave',()=>zone.classList.remove('drag-over'));
    zone.addEventListener('drop',e=>{e.preventDefault();zone.classList.remove('drag-over');validateAndPreview(e.dataTransfer.files);});
    fi.addEventListener('change',()=>{validateAndPreview(fi.files);fi.value='';});

    // Word count
    const ta=document.getElementById('f-statement'),wc=document.getElementById('stmt-count');
    if(ta)ta.addEventListener('input',()=>{const w=ta.value.trim().split(/\s+/).filter(Boolean).length;wc.textContent=w;});

    // Final submit
    document.getElementById('form-step-4').addEventListener('submit',e=>{
      e.preventDefault();
      const allChecked=[...document.querySelectorAll('.check-row input')].every(c=>c.checked);
      if(!allChecked){alert('Please confirm all declarations before submitting.');return;}
      const ref='DDA-'+Date.now().toString(36).toUpperCase();
      document.getElementById('ref-num').textContent=ref;
      document.getElementById('form-step-4').style.display='none';
      document.getElementById('submit-success').style.display='block';
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