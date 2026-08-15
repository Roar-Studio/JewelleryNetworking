<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Design Category - Deities Design Awards</title>
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
        <a class="nav-link active">Categories <span class="chev">▼</span></a>
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
      <a href="{{ route('dda.login') }}"
   class="mob-register-btn"
   onclick="localStorage.setItem('redirectAfterLogin','{{ route('dda.submit') }}')">
    Register
</a>
    </div>
  </div>

<section class="page-hero-int wash-gold"
    style="
        background-image: url('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/SEVEN+SACRED.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    ">
    <div class="page-hero-int-content">
        <span class="page-hero-int-eyebrow">Design Category</span>
        <h1 class="page-hero-int-title">Seven Sacred Forms</h1>
    </div>

</section>


  <!-- DEITY CATEGORIES ACCORDION -->
  <section class="section" style="background:var(--ivory)">
    <div class="container">
      <div class="deity-accordion">

        <!-- Nitai -->
        <div class="deity-card" id="nitai">
          <button class="deity-card-head">
            <div class="deity-card-avatar"><img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Nitai.jpg') }}" alt="Nitai"></div>
            <div class="deity-card-title">
              <span class="deity-card-num">I</span>
              <h3>Nitai</h3>
            </div>
            <span class="deity-card-chev"></span>
          </button>
          <div class="deity-card-body">
            <div class="deity-card-top">
              <div class="deity-card-visual"><img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Nitai.jpg') }}" alt="Nitai"></div>
              <div class="deity-meta">
                <div><span class="deity-meta-label">Metals</span><ul class="deity-meta-list"><li>925 Silver</li><li>Brass</li><li>Other precious metals</li><li class="opt">Optional — 14/18/22kt gold or platinum 950</li></ul></div>
                <div><span class="deity-meta-label">Stones</span><ul class="deity-meta-list"><li>Cubic zirconia — white and coloured</li><li class="opt">Optional — diamond and lab-grown diamonds</li></ul></div>
                <div><span class="deity-meta-label">Idol Height</span><ul class="deity-meta-list"><li>24 inches</li></ul></div>
                <div><span class="deity-meta-label">Theme</span><ul class="deity-meta-list"><li>Colourfull Jewellery (Prefer Primary Colors)</li></ul></div>
              </div>
            </div>
            <div class="deity-table-wrap">
  <table class="deity-table">
    <thead>
      <tr>
        <th>Jewellery Piece</th>
        <th>No. of Pieces</th>
        <th>No. of Pairs</th>
        <th>Length</th>
        <th>Breadth</th>
        <th>Width</th>
        <th>Specifications</th>
        <th>Reference Image</th>
      </tr>
    </thead>
    <tbody>

      <tr>
        <td>Waistbelt/Kamarbandh</td>
        <td>1</td>
        <td>-</td>
        <td>6 inches</td>
        <td>1 inch</td>
        <td>1–1.5 inches</td>
        <td>Thick thread to tie up -adjustable and flexible. Total circumference is 12 inches and front prefer 6 inches.</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Nitai/Waistbelt-Clear-Deity.png"
            alt="Waistbelt/Kamarbandh"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Payal</td>
        <td>2</td>
        <td>1</td>
        <td>10 to 11 inches</td>
        <td>1–1.5 inches</td>
        <td>1–1.5 inches</td>
        <td>Flexible & Openable</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Nitai/Payal-Clear-Deity.png"
            alt="Payal"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Jhumka Earrings</td>
        <td>2</td>
        <td>1</td>
        <td>2 – 2.5 inches</td>
        <td>-</td>
        <td>-</td>
        <td>Stick-ons without post and butterfly</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Vishaka+Devi/Earring-Clear-Deity-V2.png"
            alt="Payal"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Choker</td>
        <td>1</td>
        <td>-</td>
        <td>4.5–6 inches</td>
        <td>3–3.5 inches</td>
        <td>-</td>
        <td>Detachable/ adjustable threads</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Nitai/Choker-Clear-Deity.png"
            alt="Choker"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Necklace Set (Layer 1)</td>
        <td>1</td>
        <td>-</td>
        <td>7.5 inches</td>
        <td>-</td>
        <td>-</td>
        <td>Detachable/ adjustable threads</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Nitai/Necklace-Clear-Deity.png"
            alt="Necklace Set (Layer 1)"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Necklace Set (Layer 2)</td>
        <td>1</td>
        <td>-</td>
        <td>11 inches</td>
        <td>-</td>
        <td>-</td>
        <td>Detachable/ adjustable threads</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Nitai/Necklace-Clear-Deity.png"
            alt="Necklace Set (Layer 2)"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Bracelet</td>
        <td>2</td>
        <td>1</td>
        <td>6.5 inches</td>
        <td>-</td>
        <td>-</td>
        <td>Flexible/loose/openable bracelet</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Nitai/Bracelet-Clear-Deity.png"
            alt="Bracelet"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Bangle</td>
        <td>2</td>
        <td>1</td>
        <td>2 inches</td>
        <td>2 inches</td>
        <td>2 inches</td>
        <td>Openable bangles</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Nitai/Bangles-Clear-Deity.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

    </tbody>
  </table>
</div>
<div class="table-scroll-note">
    ← Swipe horizontally to view all details →
</div>
          </div>
        </div>

        <!-- Gaur -->
        <div class="deity-card" id="gaur">
          <button class="deity-card-head">
            <div class="deity-card-avatar"><img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Gaur+(2)_thumb.jpg') }}" alt="Gaur"></div>
            <div class="deity-card-title">
              <span class="deity-card-num">II</span>
              <h3>Gaur</h3>
            </div>
            <span class="deity-card-chev"></span>
          </button>
          <div class="deity-card-body">
            <div class="deity-card-top">
              <div class="deity-card-visual"><img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Gaur+(2)_thumb.jpg') }}" alt="Gaur"></div>
              <div class="deity-meta">
                <div><span class="deity-meta-label">Metals</span><ul class="deity-meta-list"><li>925 Silver</li><li>Brass</li><li>Other precious metals</li><li class="opt">Optional — 14/18/22kt gold or platinum 950</li></ul></div>
                <div><span class="deity-meta-label">Stones</span><ul class="deity-meta-list"><li>Cubic zirconia — white and coloured</li><li class="opt">Optional — diamond and lab-grown diamonds</li></ul></div>
                <div><span class="deity-meta-label">Idol Height</span><ul class="deity-meta-list"><li>24 inches</li></ul></div>
                <div><span class="deity-meta-label">Theme</span><ul class="deity-meta-list"><li>Colourfull Jewellery (Prefer Primary Colors)</li></ul></div>
              </div>
            </div>
            <div class="deity-table-wrap">
  <table class="deity-table">
    <thead>
      <tr>
        <th>Jewellery Piece</th>
        <th>No. of Pieces</th>
        <th>No. of Pairs</th>
        <th>Length</th>
        <th>Breadth</th>
        <th>Width</th>
        <th>Specifications</th>
        <th>Reference Image</th>
      </tr>
    </thead>
    <tbody>

      <tr>
        <td>Waistbelt/Kamarbandh</td>
        <td>1</td>
        <td>-</td>
        <td>16 inches</td>
        <td>1–1.5 inches</td>
        <td>1–1.5 inches</td>
        <td>Thick thread to tie up -adjustable and flexible</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Gaur/Waistbelt-Clear-Deity.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Payal</td>
        <td>2</td>
        <td>1</td>
        <td>10 to 11 inches</td>
        <td>1–1.5 inches</td>
        <td>1–1.5 inches</td>
        <td>Flexible</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Gaur/Payal-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Jhumka Earrings</td>
        <td>2</td>
        <td>1</td>
        <td>2 inches</td>
        <td>2.5 inches</td>
        <td>2.5 inches</td>
        <td>Stick-ons without post and butterfly</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Radha+Rani/Jhumkas-Earring-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Long earrings</td>
        <td>2</td>
        <td>1</td>
        <td>2.5 inches</td>
        <td>2.5 inches</td>
        <td>2.5 inches</td>
        <td>Stick-ons without post and butterfly</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Radha+Rani/Jhumkas-Earring-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Choker</td>
        <td>1</td>
        <td>-</td>
        <td>4.5–6 inches</td>
        <td>3/3.5 inches</td>
        <td>3/3.5 inches</td>
        <td>Detachable/ adjustable threads</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Gaur/Choker-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Necklace Set (Layer 1)</td>
        <td>1</td>
        <td>-</td>
        <td>10 inches</td>
        <td>-</td>
        <td>-</td>
        <td>Detachable/ adjustable threads</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Gaur/Necklace-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Necklace Set (Layer 2)</td>
        <td>1</td>
        <td>-</td>
        <td>11 inches</td>
        <td>-</td>
        <td>-</td>
        <td>Detachable/ adjustable threads</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Gaur/Necklace-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Bracelet</td>
        <td>2</td>
        <td>1</td>
        <td>6.5 inches</td>
        <td>2 inches</td>
        <td>2 inches</td>
        <td>Flexible/loose/openable bracelet</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Gaur/Bracelet-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Bangle</td>
        <td>2</td>
        <td>1</td>
        <td>2 inches</td>
        <td>2 inches</td>
        <td>2 inches</td>
        <td>Openable bangles</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Gaur/Bangles-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

    </tbody>
  </table>
</div>
<div class="table-scroll-note">
    ← Swipe horizontally to view all details →
</div>
          </div>
        </div>

        <!-- Lalita -->
        <div class="deity-card" id="lalita">
          <button class="deity-card-head">
            <div class="deity-card-avatar"><img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Lalita+(1)_thumb.jpg') }}" alt="Lalita"></div>
            <div class="deity-card-title">
              <span class="deity-card-num">III</span>
              <h3>Lalita</h3>
            </div>
            <span class="deity-card-chev"></span>
          </button>
          <div class="deity-card-body">
            <div class="deity-card-top">
              <div class="deity-card-visual"><img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Lalita+(1)_thumb.jpg') }}" alt="Lalita"></div>
              <div class="deity-meta">
                <div><span class="deity-meta-label">Metals</span><ul class="deity-meta-list"><li>925 Silver</li><li>Brass</li><li>Other precious metals</li><li class="opt">Optional — 14/18/22kt gold or platinum 950</li></ul></div>
                <div><span class="deity-meta-label">Stones</span><ul class="deity-meta-list"><li>Cubic zirconia — white and coloured</li><li class="opt">Optional — diamond and lab-grown diamonds</li></ul></div>
                <div><span class="deity-meta-label">Idol Height</span><ul class="deity-meta-list"><li>32/33 inches</li></ul></div>
                <div><span class="deity-meta-label">Theme</span><ul class="deity-meta-list"><li>Colourfull Jewellery (Prefer Primary Colors)</li></ul></div>
              </div>
            </div>
           <div class="deity-table-wrap">
  <table class="deity-table">
    <thead>
      <tr>
        <th>Jewellery Piece</th>
        <th>No. of Pieces</th>
        <th>No. of Pairs</th>
        <th>Length</th>
        <th>Breadth</th>
        <th>Width</th>
        <th>Specifications</th>
        <th>Reference Image</th>
      </tr>
    </thead>
    <tbody>

      <tr>
        <td>Paisley</td>
        <td>1</td>
        <td>1</td>
        <td>3 inches</td>
        <td>2 inches</td>
        <td>-</td>
        <td>Paisley turn towards right side facing/Height 5 inch, 1.5 inch pin at the back.</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/lalita/Paisley-Clear-Deity.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Damini/Mathapatti</td>
        <td>1</td>
        <td>1</td>
        <td>6.5 inches</td>
        <td>1 inch</td>
        <td>-</td>
        <td>-</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/lalita/Damini-Mathapatti-Clear-Deity.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Maangtikha</td>
        <td>1</td>
        <td>1</td>
        <td>5 inches</td>
        <td>0.8 inches</td>
        <td>-</td>
        <td>-</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/lalita/Maangtikha-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Waistbelt/Kamarbandh</td>
        <td>1</td>
        <td>-</td>
        <td>16 inches</td>
        <td>2 inches</td>
        <td>-</td>
        <td>Detachable/ adjustable threads</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/lalita/Waistbelt-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Payal</td>
        <td>2</td>
        <td>1</td>
        <td>10 inches</td>
        <td>1–1.5 inches</td>
        <td>-</td>
        <td>Flexible</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Nitai/Payal-Clear-Deity.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Nosering</td>
        <td>1</td>
        <td>-</td>
        <td>0.7 inches</td>
        <td>1 inch</td>
        <td>-</td>
        <td>maximium size 1 length and 1.4 breadth</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/lalita/Nose-Ring-Clear-Deity.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Earings</td>
        <td>2</td>
        <td>1</td>
        <td>2 inches</td>
        <td>2 inches</td>
        <td>-</td>
        <td>Stick-ons without post and butterfly</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/lalita/Earring-2-Clear-Deity.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Choker</td>
        <td>1</td>
        <td>-</td>
        <td>4.5–6 inches</td>
        <td>3–3.5 inches</td>
        <td>-</td>
        <td>Detachable/ adjustable threads</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Nitai/Choker-Clear-Deity.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Necklace Set (Layer 1)</td>
        <td>1</td>
        <td>-</td>
        <td>10 inches</td>
        <td>1 inch</td>
        <td>-</td>
        <td>Detachable/ adjustable threads</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/lalita/Necklace-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Necklace Set (Layer 2)</td>
        <td>1</td>
        <td>-</td>
        <td>11 inches</td>
        <td>1 inch</td>
        <td>-</td>
        <td>Detachable/ adjustable threads</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/lalita/Necklace-2-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Necklace Set (Layer 3)</td>
        <td>1</td>
        <td>-</td>
        <td>12 inches</td>
        <td>1 inch</td>
        <td>-</td>
        <td>Detachable/ adjustable threads</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/lalita/Necklace-3-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Bangle</td>
        <td>6</td>
        <td>3</td>
        <td>2 inches</td>
        <td>2 inches</td>
        <td>2 inches</td>
        <td>2.0 aani openable bangle</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Nitai/Bangles-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      

    </tbody>
  </table>
</div>
<div class="table-scroll-note">
    ← Swipe horizontally to view all details →
</div>
          </div>
        </div>

        <!-- Radharani / Radha -->
        <div class="deity-card" id="radharani-radha">
          <button class="deity-card-head">
            <div class="deity-card-avatar"><img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Radha+(2)_thumb.jpg') }}" alt="Radharani / Radha"></div>
            <div class="deity-card-title">
              <span class="deity-card-num">IV</span>
              <h3>Radharani / Radha</h3>
            </div>
            <span class="deity-card-chev"></span>
          </button>
          <div class="deity-card-body">
            <div class="deity-card-top">
              <div class="deity-card-visual"><img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Radha+(2)_thumb.jpg') }}" alt="Radharani / Radha"></div>
              <div class="deity-meta">
                <div><span class="deity-meta-label">Metals</span><ul class="deity-meta-list"><li>925 Silver</li><li>Brass</li><li>Other precious metals</li><li class="opt">Optional — 14/18/22kt gold or platinum 950</li></ul></div>
                <div><span class="deity-meta-label">Stones</span><ul class="deity-meta-list"><li>Cubic zirconia — white and coloured</li><li class="opt">Optional — diamond and lab-grown diamonds</li></ul></div>
                <div><span class="deity-meta-label">Idol Height</span><ul class="deity-meta-list"><li>34 inches</li></ul></div>
                <div><span class="deity-meta-label">Theme</span><ul class="deity-meta-list"><li>Colourfull Jewellery (Prefer Primary Colors)</li></ul></div>
              </div>
            </div>
            <div class="deity-table-wrap">
  <table class="deity-table">
    <thead>
      <tr>
        <th>Jewellery Piece</th>
        <th>No. of Pieces</th>
        <th>No. of Pairs</th>
        <th>Length</th>
        <th>Breadth</th>
        <th>Width</th>
        <th>Specifications</th>
        <th>Reference Image</th>
      </tr>
    </thead>
    <tbody>

      <tr>
        <td>Paiseley</td>
        <td>1</td>
        <td>0</td>
        <td>3 inches</td>
        <td>2 inches</td>
        <td>-</td>
        <td>Paisley kalgi turns towards left side facing/Height 5 inch, 1.5 inch pin at the back, will be made as a set with mathapatti. Mechanism will be like brooch pins in the V shape with 2 sticks at the back that goes into the hair.</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Radha+Rani/Paisley-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Damini/Mathapatti</td>
        <td>1</td>
        <td>0</td>
        <td>5-6.5 inches</td>
        <td>0.8 inches</td>
        <td>-</td>
        <td>Flexible, will be made as a set with the paisely kalgi.</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Radha+Rani/Damini-Mathapatti-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Maangtikha</td>
        <td>1</td>
        <td>1</td>
        <td>5 inches</td>
        <td>0.8 inches</td>
        <td>-</td>
        <td>-</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Vishaka+Devi/Maangtikha-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Long Latkan Waistbelt/Kamarbandh</td>
        <td>1</td>
        <td>0</td>
        <td>16 inches</td>
        <td>2-2.5 inches</td>
        <td>-</td>
        <td>Detachable/ adjustable threads/drop shape latkans</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Radha+Rani/Long-Latkan-Waistbelt-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Payals</td>
        <td>2</td>
        <td>1</td>
        <td>10 inches</td>
        <td>1-1.5 inches</td>
        <td>-</td>
        <td>Flexible</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Nitai/Payal-Clear-Deity.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Nosering</td>
        <td>1</td>
        <td>-</td>
        <td>0.7 inches</td>
        <td>1 inch</td>
        <td>-</td>
        <td>maximium size 1 length and 1.4 breadth</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/lalita/Nose-Ring-Clear-Deity.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Earings</td>
        <td>2</td>
        <td>1</td>
        <td>2 inches</td>
        <td>2.5 inches</td>
        <td>-</td>
        <td>Stick-ons without post and butterfly</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Vishaka+Devi/Earring-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Choker</td>
        <td>1</td>
        <td>0</td>
        <td>4.5-6 inches</td>
        <td>3/3.5 inches</td>
        <td>-</td>
        <td>Detachable/ adjustable threads</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Radha+Rani/Choker-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Necklace Set (Layer 1)</td>
        <td>1</td>
        <td>0</td>
        <td>9 inches</td>
        <td>0 inches</td>
        <td>-</td>
        <td>Detachable/ adjustable threads</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Radha+Rani/Bracelet-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Necklace Set (Layer 2)</td>
        <td>1</td>
        <td>0</td>
        <td>10 inches</td>
        <td>0 inches</td>
        <td>-</td>
        <td>Detachable/ adjustable threads</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Radha+Rani/Necklace-2-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Necklace Set (Layer 3)</td>
        <td>1</td>
        <td>0</td>
        <td>12 inches</td>
        <td>0 inches</td>
        <td>-</td>
        <td>Detachable/ adjustable threads</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Radha+Rani/Necklace-3-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Bangle</td>
        <td>1</td>
        <td>2</td>
        <td>2 inches</td>
        <td>2 inches</td>
        <td>openable 2 aani</td>
        <td>Flexible/loose/openable bracelet</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Radha+Rani/Bangle-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Bracelet</td>
        <td>1</td>
        <td>2</td>
        <td>6.5 inches</td>
        <td>0 inches</td>
        <td>-</td>
        <td>Flexible/loose/openable bracelet</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Radha+Rani/Bracelet-Clear-Deity-V2.png
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      

    </tbody>
  </table>
</div>
<div class="table-scroll-note">
    ← Swipe horizontally to view all details →
</div>
          </div>
        </div>


        <!-- Gopinath / Krishna -->
        <div class="deity-card" id="gopinath-krishna">
          <button class="deity-card-head">
            <div class="deity-card-avatar"><img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Krishna+(1)_thumb.jpg') }}" alt="Gopinath / Krishna"></div>
            <div class="deity-card-title">
              <span class="deity-card-num">V</span>
              <h3>Gopinath / Krishna</h3>
            </div>
            <span class="deity-card-chev"></span>
          </button>
          <div class="deity-card-body">
            <div class="deity-card-top">
              <div class="deity-card-visual"><img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Krishna+(1)_thumb.jpg') }}" alt="Gopinath / Krishna"></div>
              <div class="deity-meta">
                <div><span class="deity-meta-label">Metals</span><ul class="deity-meta-list"><li>925 Silver</li><li>Brass</li><li>Other precious metals</li><li class="opt">Optional — 14/18/22kt gold or platinum 950</li></ul></div>
                <div><span class="deity-meta-label">Stones</span><ul class="deity-meta-list"><li>Cubic zirconia — white and coloured</li><li class="opt">Optional — diamond and lab-grown diamonds</li></ul></div>
                <div><span class="deity-meta-label">Idol Height</span><ul class="deity-meta-list"><li>34 inches</li></ul></div>
                <div><span class="deity-meta-label">Theme</span><ul class="deity-meta-list"><li>Colourfull Jewellery (Prefer Primary Colors)</li></ul></div>
              </div>
            </div>
            <div class="deity-table-wrap">
  <table class="deity-table">
    <thead>
      <tr>
        <th>Jewellery Piece</th>
        <th>No. of Pieces</th>
        <th>No. of Pairs</th>
        <th>Length</th>
        <th>Breadth</th>
        <th>Width</th>
        <th>Specifications</th>
        <th>Reference Image</th>
      </tr>
    </thead>
    <tbody>

      <tr>
        <td>Waistbelt/Kamarband</td>
        <td>1</td>
        <td>-</td>
        <td>16 inches</td>
        <td>1–1.5 inches</td>
        <td>1–1.5 inches</td>
        <td>Detachable/ adjustable threads /5/6 layered</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Nitai/Waistbelt-Clear-Deity.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Payal</td>
        <td>2</td>
        <td>2</td>
        <td>10 to 11 inches</td>
        <td>1–1.5 inches</td>
        <td>-</td>
        <td>Flexible</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Krishna/Payal-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Flute</td>
        <td>-</td>
        <td>-</td>
        <td>16 inches</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Radha+Rani/Rings-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Jhumka & Long Earings</td>
        <td>2</td>
        <td>1</td>
        <td>2 inches</td>
        <td>2.5 inches</td>
        <td>-</td>
        <td>Stick-ons without post and butterfly</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Krishna/Long-Earrings-2-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Chokers</td>
        <td>1</td>
        <td>-</td>
        <td>4.5–6 inches</td>
        <td>3–3.5 inches</td>
        <td>-</td>
        <td>Detachable/ adjustable threads</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Krishna/Chokers-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Long Necklace</td>
        <td>1</td>
        <td>-</td>
        <td>28 inches</td>
        <td>-</td>
        <td>-</td>
        <td>Detachable/ adjustable threads. With single pendant which will be large - (Haaram), goes around the body like a janeo, crossing the body like a janeo.</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Krishna/Long-Necklace-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>

      <tr>
        <td>Bracelet</td>
        <td>-</td>
        <td>1</td>
        <td>2 inches</td>
        <td>6.5 inches</td>
        <td>0</td>
        <td>-</td>
        <td><img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Krishna/Bracelet-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          ></td>
      </tr>


    </tbody>
  </table>
</div>
<div class="table-scroll-note">
    ← Swipe horizontally to view all details →
</div>
          </div>
        </div>

        <!-- Vishakhadevi -->
        <div class="deity-card" id="vishakhadevi">
          <button class="deity-card-head">
            <div class="deity-card-avatar"><img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Vishaka+Devi+(6).jpg') }}" alt="Vishakhadevi"></div>
            <div class="deity-card-title">
              <span class="deity-card-num">VI</span>
              <h3>Vishakhadevi</h3>
            </div>
            <span class="deity-card-chev"></span>
          </button>
          <div class="deity-card-body">
            <div class="deity-card-top">
              <div class="deity-card-visual"><img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Vishaka+Devi+(6).jpg') }}" alt="Vishakhadevi"></div>
              <div class="deity-meta">
                <div><span class="deity-meta-label">Metals</span><ul class="deity-meta-list"><li>925 Silver</li><li>Brass</li><li>Other precious metals</li><li class="opt">Optional — 14/18/22kt gold or platinum 950</li></ul></div>
                <div><span class="deity-meta-label">Stones</span><ul class="deity-meta-list"><li>Cubic zirconia — white and coloured</li><li class="opt">Optional — diamond and lab-grown diamonds</li></ul></div>
                <div><span class="deity-meta-label">Idol Height</span><ul class="deity-meta-list"><li>31/32 inches</li></ul></div>
                <div><span class="deity-meta-label">Theme</span><ul class="deity-meta-list"><li>Colourfull Jewellery (Prefer Primary Colors)</li></ul></div>
              </div>
            </div>
            <div class="deity-table-wrap">
  <table class="deity-table">
    <thead>
      <tr>
        <th>Jewellery Piece</th>
        <th>No. of Pieces</th>
        <th>No. of Pairs</th>
        <th>Length</th>
        <th>Breadth</th>
        <th>Width</th>
        <th>Specifications</th>
        <th>Reference Image</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Paisley</td>
        <td>1</td>
        <td>-</td>
        <td>3 inches</td>
        <td>2 inches</td>
        <td>-</td>
        <td>Paisley turn towards left side facing/Height 5 inch, 1.5 inch pin at the back</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Vishaka+Devi/Paisley-Clear-Deity-V2.png"
            alt="Paisley"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Damini/Mathapatti</td>
        <td>1</td>
        <td>-</td>
        <td>6.5 inches</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Vishaka+Devi/Damini-Mathapatti-Clear-Deity-V2.png"
            alt="Damini/Mathapatti"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Maangtikha</td>
        <td>1</td>
        <td>-</td>
        <td>5 inches</td>
        <td>0.8 inches</td>
        <td>-</td>
        <td>-</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Vishaka+Devi/Maangtikha-Clear-Deity-V2.png"
            alt="Maangtikha"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Waistbelt</td>
        <td>1</td>
        <td>-</td>
        <td>16 inches</td>
        <td>1–1.5 inches</td>
        <td>1–1.5 inches</td>
        <td>detachable/ adjustable threads</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Vishaka+Devi/Waistbelt-Clear-Deity-V2.png"
            alt="Waistbelt"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Payal</td>
        <td>2</td>
        <td>1</td>
        <td>10-11 inches</td>
        <td>1–1.5 inches</td>
        <td>-</td>
        <td>Flexible</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Nitai/Payal-Clear-Deity.png"
            alt="Payal"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Nosering</td>
        <td>1</td>
        <td>-</td>
        <td>0.7 inches</td>
        <td>1 inch</td>
        <td>-</td>
        <td>-</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/lalita/Nose-Ring-Clear-Deity.png"
            alt="Nosering"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Long Earings</td>
        <td>2</td>
        <td>1</td>
        <td>2 inches</td>
        <td>2 inches</td>
        <td>-</td>
        <td>Stick-ons without post and butterfly</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Vishaka+Devi/Earring-Clear-Deity-V2.png"
            alt="Long Earings"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Choker</td>
        <td>1</td>
        <td>-</td>
        <td>4.5-6 inches</td>
        <td>3/3.5 inches</td>
        <td>-</td>
        <td>detachable/ adjustable threads</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Vishaka+Devi/Choker-Clear-Deity-V2.png"
            alt="Choker"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Necklace Set (Layer 1)</td>
        <td>1</td>
        <td>-</td>
        <td>9 inches</td>
        <td>-</td>
        <td>-</td>
        <td>detachable/ adjustable threads</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Gopalji/Necklace-1-Clear-Deity-V2.png"
            alt="Necklace Set (Layer 1)"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Necklace Set (Layer 2)</td>
        <td>-</td>
        <td>-</td>
        <td>10 inches</td>
        <td>-</td>
        <td>-</td>
        <td>detachable/ adjustable threads</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Vishaka+Devi/Necklace-2-Clear-Deity-V2.png"
            alt="Necklace Set (Layer 2)"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Necklace Set (Layer 3)</td>
        <td>-</td>
        <td>-</td>
        <td>11 inches</td>
        <td>-</td>
        <td>-</td>
        <td>detachable/ adjustable threads</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Vishaka+Devi/Necklace-3-Clear-Deity-V2.png"
            alt="Necklace Set (Layer 3)"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Bangle</td>
        <td>6</td>
        <td>3</td>
        <td>2 inches</td>
        <td>2 inches</td>
        <td>2 aani openable</td>
        <td>Flexible/loose/openable bracelet</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Vishaka+Devi/Bangle-Clear-Deity-V2.png"
            alt="Bangle"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      
    </tbody>
  </table>
</div>
<div class="table-scroll-note">
    ← Swipe horizontally to view all details →
</div>
          </div>
        </div>

        <!-- Gopalji -->
        <!-- Gopalji -->
        <div class="deity-card" id="gopalji">
          <button class="deity-card-head">
            <div class="deity-card-avatar"><img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Gopalji+(2)_thumb.jpg') }}" alt="Gopalji"></div>
            <div class="deity-card-title">
              <span class="deity-card-num">VII</span>
              <h3>Gopalji</h3>
            </div>
            <span class="deity-card-chev"></span>
          </button>
          <div class="deity-card-body">
            <div class="deity-card-top">
              <div class="deity-card-visual"><img src="{{ asset('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/Gopalji+(2)_thumb.jpg') }}" alt="Gopalji"></div>
              <div class="deity-meta">
                <div><span class="deity-meta-label">Metals</span><ul class="deity-meta-list"><li>925 Silver</li><li>Brass</li><li>Other precious metals</li><li class="opt">Optional — 14/18/22kt gold or platinum 950</li></ul></div>
                <div><span class="deity-meta-label">Stones</span><ul class="deity-meta-list"><li>Cubic zirconia — white and coloured</li><li class="opt">Optional — diamond and lab-grown diamonds</li></ul></div>
                <div><span class="deity-meta-label">Idol Height</span><ul class="deity-meta-list"><li>26 inches</li></ul></div>
                <div><span class="deity-meta-label">Theme</span><ul class="deity-meta-list"><li>Colourfull Jewellery (Prefer Primary Colors)</li></ul></div>
              </div>
            </div>
            <div class="deity-table-wrap">
  <table class="deity-table">
    <thead>
      <tr>
        <th>Jewellery Piece</th>
        <th>No. of Pieces</th>
        <th>No. of Pairs</th>
        <th>Length</th>
        <th>Breadth</th>
        <th>Width</th>
        <th>Specifications</th>
        <th>Reference Image</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Layered Waistbelt/Kamarbandh</td>
        <td>1</td>
        <td>0</td>
        <td>16 inches</td>
        <td>1–1.5 inches</td>
        <td>1–1.5 inches</td>
        <td>Detachable/ adjustable threads</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Nitai/Waistbelt-Clear-Deity.png"
            alt="Layered Waistbelt/Kamarbandh"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Pair of sticks</td>
        <td>2</td>
        <td>-</td>
        <td>19 inches</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Radha+Rani/Necklace-3-Clear-Deity-V2.png"
            alt="Pair of sticks"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Anklets/ PAYAL</td>
        <td>2</td>
        <td>2</td>
        <td>10-11 inches</td>
        <td>-</td>
        <td>-</td>
        <td>Flexible</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Nitai/Payal-Clear-Deity.png"
            alt="Anklets/ PAYAL"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Choker</td>
        <td>1</td>
        <td>0</td>
        <td>4.5–6 inches</td>
        <td>3-3.50 inches</td>
        <td>-</td>
        <td>Detachable/ adjustable threads</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Gopal+Ji/Chokers-Clear-Deity-V2.png"
            alt="Choker"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Necklace Set (Layer 1)</td>
        <td>1</td>
        <td>0</td>
        <td>9 inches</td>
        <td>-</td>
        <td>-</td>
        <td>Detachable/ adjustable threads</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Gopal+Ji/Necklace-4-Clear-Deity-V2.png"
            alt="Necklace Set (Layer 1)"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Necklace Set (Layer 2)</td>
        <td>1</td>
        <td>0</td>
        <td>10 inches</td>
        <td>-</td>
        <td>-</td>
        <td>Detachable/ adjustable threads</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Gopal+Ji/Necklace-3-Clear-Deity-V2.png"
            alt="Necklace Set (Layer 2)"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Necklace Set (Layer 3)</td>
        <td>1</td>
        <td>0</td>
        <td>11 inches</td>
        <td>-</td>
        <td>-</td>
        <td>Detachable/ adjustable threads</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Gopal+Ji/Necklace-2-Clear-Deity-V2.png"
            alt="Necklace Set (Layer 3)"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Necklaces Set (Layer 4)</td>
        <td>1</td>
        <td>0</td>
        <td>12 inches</td>
        <td>-</td>
        <td>-</td>
        <td>Detachable/ adjustable threads</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Gopal+Ji/Necklace-1-Clear-Deity-V2.png"
            alt="Necklaces Set (Layer 4)"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Bracelets 1</td>
        <td>2</td>
        <td>1</td>
        <td>6.5 inches</td>
        <td>1–1.5 inches</td>
        <td>-</td>
        <td>Flexible</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Nitai/Bracelet-Clear-Deity.png"
            alt="Bracelets 1"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>

      <tr>
        <td>Bracelets 2</td>
        <td>2</td>
        <td>1</td>
        <td>6.5 inches</td>
        <td>1–1.5 inches</td>
        <td>-</td>
        <td>Flexible</td>
        <td>
          <img
            src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/Final+Images/Gaur/Not+to+be+used/Bracelet-Clear-Deity.png"
            alt="Bracelets 2"
            class="table-thumb"
            onclick="openImage(this.src)"
          >
        </td>
      </tr>
    </tbody>
  </table>
</div>
<div class="table-scroll-note">
    ← Swipe horizontally to view all details →
</div>
          </div>
        </div>

      </div>
    </div>
  </section>



  <!-- FOOTER -->
  <footer>
    <div class="footer-top">
      <div class="footer-brand">
        <img src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards">
        
        <div class="footer-socials">
          <a href="https://www.instagram.com/deitiesdesignawards" target="_blank" rel="noopener" class="footer-social" aria-label="Instagram"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="0.5" fill="currentColor"/></svg></a>
          <a href="https://www.facebook.com/profile.php?id=61578502570613" target="_blank" rel="noopener" class="footer-social" aria-label="Facebook"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
          <a href="https://www.youtube.com/@DeitiesDesignAwards" target="_blank" rel="noopener" class="footer-social" aria-label="YouTube"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="6" width="18" height="12" rx="3"/><path d="M10 9.75v4.5L15 12l-5-2.25z" fill="currentColor" stroke="none"/></svg></a>
        </div>
      </div>
      <div class="footer-col">
        <h5>Explore</h5>
        <ul>
          <li><a href="{{ url('/deitiesdesignawards/about') }}">About DDA</a></li>
          <li><a href="{{ url('/deitiesdesignawards/design-category') }}">Design Categories</a></li>
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
          <li><a href="mailto:info@deitiesdesignawards.com">info@deitiesdesignawards.com</a></li>
          <li>+91 98191 55544</li>
          <li>Mumbai, India</li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <span>&copy; 2026 Deities Design Awards. All rights reserved.</span>
      <div class="footer-legal">
        <a href="{{ url('/deitiesdesignawards/privacy') }}">Privacy Policy</a>
        <a href="{{ url('/deitiesdesignawards/terms') }}">Terms</a>
      </div>
    </div>
  </footer>


  <script>
    const tb=document.querySelector('.mobile-menu-toggle'),dr=document.querySelector('.mobile-menu-drawer');
    tb.addEventListener('click',()=>{tb.classList.toggle('active');dr.classList.toggle('active');document.body.classList.toggle('no-scroll');});
    document.addEventListener('click',e=>{if(!dr.contains(e.target)&&!tb.contains(e.target)&&dr.classList.contains('active')){tb.classList.remove('active');dr.classList.remove('active');document.body.classList.remove('no-scroll');}});
    document.querySelectorAll('.mobile-menu-links > a.mob-link, .mob-dropdown-menu a').forEach(l=>l.addEventListener('click',()=>{tb.classList.remove('active');dr.classList.remove('active');document.body.classList.remove('no-scroll');}));
    document.querySelectorAll('.mob-dropdown-toggle').forEach(t=>{t.addEventListener('click',e=>{e.stopPropagation();const m=t.nextElementSibling,c=t.querySelector('.chev');document.querySelectorAll('.mob-dropdown-toggle').forEach(o=>{if(o!==t){o.nextElementSibling.classList.remove('open');o.querySelector('.chev').classList.remove('rotate');}});m.classList.toggle('open');c.classList.toggle('rotate');});});

    // Deity card accordion toggle
    document.querySelectorAll('.deity-card-head').forEach(button => {
      button.addEventListener('click', () => {
        const card = button.parentElement;
        document.querySelectorAll('.deity-card').forEach(other => {
          if (other !== card) other.classList.remove('open');
        });
        card.classList.toggle('open');
      });
    });

    // Auto-open + scroll to deity card from URL hash (e.g. design-category.html#gaur)
    if (window.location.hash) {
      const target = document.querySelector(window.location.hash);
      if (target && target.classList.contains('deity-card')) {
        target.classList.add('open');
        setTimeout(() => target.scrollIntoView({ behavior: 'smooth', block: 'start' }), 100);
      }
    }

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
    const centerX = 1722.8, centerY = 1722.8, maxDistance = 200;
    function updatePupilPosition() {
      const dx = mouseX - (cursorContainer.offsetLeft + 20);
      const dy = mouseY - (cursorContainer.offsetTop + 20);
      const distance = Math.sqrt(dx * dx + dy * dy);
      const angle = Math.atan2(dy, dx);
      const moveDistance = Math.min(distance, maxDistance) * 0.15;
      pupil.setAttribute('cx', centerX + Math.cos(angle) * moveDistance);
      pupil.setAttribute('cy', centerY + Math.sin(angle) * moveDistance);
    }
    document.addEventListener('mousemove', (e) => {
      mouseX = e.clientX; mouseY = e.clientY;
      cursorContainer.style.left = (mouseX - 20) + 'px';
      cursorContainer.style.top = (mouseY - 20) + 'px';
      updatePupilPosition();
    });

function openImage(src){
    document.getElementById('imageModal').style.display = "flex";
    document.getElementById('modalImg').src = src;
}

function closeImage(){
    document.getElementById('imageModal').style.display = "none";
}

document.getElementById('imageModal').addEventListener('click', function(e){
    if(e.target === this){
        closeImage();
    }
});

document.addEventListener('keydown', function(e){
    if(e.key === "Escape"){
        closeImage();
    }
});

  </script>

    <div id="imageModal" class="image-modal">
    <span class="close-image" onclick="closeImage()">&times;</span>

    <img id="modalImg" class="image-modal-content">

    <div id="imageCaption"></div>
</div>
</body>
</html>