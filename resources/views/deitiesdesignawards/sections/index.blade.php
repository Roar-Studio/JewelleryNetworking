@extends('deitiesdesignawards.layouts.app')

@section('title', 'Deities Design Awards — Jewellery for the Sacred')

@section('content')

    {{-- ─── HERO FULL BLEED ─────────────────────────────────────────────── --}}
    <section class="hero">
        <div class="hero-media">
            <video autoplay muted loop playsinline
                poster="{{ asset('deitiesdesignawards/images/Indias first awards platform dedicated to jewellery created for the divine.png') }}">
                <source src="https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/home.mp4" type="video/mp4">
            </video>
        </div>
        <div class="hero-vignette"></div>

        <div class="hero-content">
            <img src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}"
                 alt="Deities Design Awards" class="hero-logo-mark">

            <h1 class="hero-title">Jewellery for the Sacred</h1>
            <p class="hero-tagline">Deities. Design. Devotion.</p>

            <div class="hero-cta-row">
                <a href="{{ url('/deitiesdesignawards/submit') }}" class="btn-gold pulse">
                    <span>Register Now</span>
                    <span class="arrow">&rarr;</span>
                </a>
                <a href="{{ url('/deitiesdesignawards/about') }}" class="btn-primary">
                    <span>Discover More</span>
                    <span class="arrow">&rarr;</span>
                </a>
            </div>
        </div>

        <div class="hero-scroll">
            <span>Scroll</span>
            <span class="line"></span>
        </div>
    </section>

    {{-- ─── FEATURED STRIP ──────────────────────────────────────────────── --}}
    <div class="featured-strip">
        <span class="sep">|</span>
        <div class="item">India's First Sacred Jewellery Awards</div>
        <span class="sep">|</span>
        <div class="item">Global Participation</div>
        <span class="sep">|</span>
        <div class="item">Industry & Spiritual Partnerships</div>
        <span class="sep">|</span>
        <div class="item">Multi-Category Recognition</div>
        <span class="sep">|</span>
        <div class="item">Annual Platform</div>
        <span class="sep">|</span>
    </div>

    {{-- ─── FIVE PILLARS (hidden) ───────────────────────────────────────── --}}
    <section class="section pillars-sec" style="display:none">
        <div class="container">
            <div class="pillars-head">
                <span class="section-eyebrow">The Five Pillars</span>
                <h2 class="section-title">The values that <span class="it">define this platform.</span></h2>
            </div>
            <div class="pillars-grid">
                <div class="pillar-card">
                    <div class="pillar-icon">I</div>
                    <h4>Faith</h4>
                    <p>The sacred intention that inspires every creation and gives meaning to every design.</p>
                </div>
                <div class="pillar-card">
                    <div class="pillar-icon">II</div>
                    <h4>Artistry</h4>
                    <p>Creative vision transformed into timeless expressions of beauty and symbolism.</p>
                </div>
                <div class="pillar-card">
                    <div class="pillar-icon">III</div>
                    <h4>Craftsmanship</h4>
                    <p>The mastery of skilled hands that bring imagination and devotion to life.</p>
                </div>
                <div class="pillar-card">
                    <div class="pillar-icon">IV</div>
                    <h4>Devotion</h4>
                    <p>A heartfelt offering expressed through dedication, tradition and purpose.</p>
                </div>
                <div class="pillar-card">
                    <div class="pillar-icon">V</div>
                    <h4>Excellence</h4>
                    <p>The pursuit of quality, innovation and enduring impact.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ─── IMAGE / VIDEO BREAK ─────────────────────────────────────────── --}}
    <section class="image-break">
        <div class="image-break-media">
            <video autoplay muted loop playsinline
                poster="{{ asset('deitiesdesignawards/images/Closeup artisan hands making setting gold jewellery, tools, wax model, filigree, gemstone setting.png') }}">
                <source src="{{ asset('deitiesdesignawards/videos/Artisans_making_Indian_temple_je…_202606051817.mp4') }}" type="video/mp4">
            </video>
        </div>
        <div class="image-break-overlay"></div>

        <div class="image-break-content">
            <span class="image-break-eyebrow">| A Moment in Sacred Craft |</span>
            <h3>Every piece begins with faith <span class="it"><br>and is completed through craftsmanship.</span></h3>
            <a href="{{ url('/deitiesdesignawards/submit') }}" class="btn-gold">
                <span>Enter the Awards</span>
                <span class="arrow">&rarr;</span>
            </a>
        </div>
    </section>

    {{-- ─── CATEGORIES ──────────────────────────────────────────────────── --}}
    <section class="section categories">
        <div class="container">
            <div class="cat-head">
                <div>
                    <span class="section-eyebrow">Award Categories</span>
                    <h2 class="section-title">Every craft, every calibre.</h2>
                    <p>Three dedicated categories honouring the artists, artisans and institutions shaping devotional jewellery, from visionary designers and established brands to master artisans and the next generation of makers.</p>
                </div>
            </div>

            <div class="cat-grid">
                <div class="cat-card">
                    <div class="cat-image-wrap">
                        <span class="cat-num-tag">i</span>
                        <div class="cat-image"
                            style="background: url('{{ asset('deitiesdesignawards/images/Designer sketching temple jewellery, mood boards, CAD design desk, elegant studio.png') }}') center/cover no-repeat">
                        </div>
                    </div>
                    <div class="cat-body">
                        <h4>Jewellery Designers and Brands</h4>
                        <p>Independent designers, studios, heritage houses and contemporary labels shaping the language of devotional craft.</p>
                        <a href="{{ url('/deitiesdesignawards/categories') }}#designers-brands" class="cat-explore">Explore Category <span>&rarr;</span></a>
                    </div>
                </div>

                <div class="cat-card">
                    <div class="cat-image-wrap">
                        <span class="cat-num-tag">ii</span>
                        <div class="cat-image"
                            style="background: url('{{ asset('deitiesdesignawards/images/Closeup artisan hands making setting gold jewellery, tools, wax model, filigree, gemstone setting.png') }}') center/cover no-repeat">
                        </div>
                    </div>
                    <div class="cat-body">
                        <h4>Jewellery Manufacturers</h4>
                        <p>Master craftsmen in gold, silver and platinum whose hands give shape to the divine and manufacturing units preserving sacred traditions.</p>
                        <a href="{{ url('/deitiesdesignawards/categories') }}#manufacturers" class="cat-explore">Explore Category <span>&rarr;</span></a>
                    </div>
                </div>

                <div class="cat-card">
                    <div class="cat-image-wrap">
                        <span class="cat-num-tag">iii</span>
                        <div class="cat-image"
                            style="background: url('{{ asset('deitiesdesignawards/images/Designer sketching temple jewellery, mood boards, CAD design desk, elegant studio.png') }}') center/cover no-repeat; filter: saturate(.8)">
                        </div>
                    </div>
                    <div class="cat-body">
                        <h4>Students and Institutions</h4>
                        <p>Students and educational institutions discovering and nurturing the next generation of sacred jewellery makers.</p>
                        <a href="{{ url('/deitiesdesignawards/categories') }}#students-institutions" class="cat-explore">Explore Category <span>&rarr;</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ─── PARTNERS BAND ───────────────────────────────────────────────── --}}
    <section class="partners-band">
        <div class="partners-inner">
            <div class="partners-label">Brought Together By</div>
            <div class="partners-list">
                <div class="partner-item">Jewellers Association Bengaluru</div>
                <div class="partner-item">ISKCON Chowpatty</div>
                <div class="partner-item">Jewellery Networking</div>
            </div>
        </div>
    </section>

    {{-- ─── TIMELINE ────────────────────────────────────────────────────── --}}
    <section class="section timeline-sec">
        <div class="container">
            <div class="timeline-head">
                <svg class="timeline-cal-icon" width="32" height="32" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                <span class="section-eyebrow">The Calendar</span>
                <h2 class="section-title">From first sketch to<br>the final ceremony.</h2>
            </div>

            <div class="timeline-grid">
                <div class="tl-step">
                    <div class="tl-dot pulse"></div>
                    <div class="tl-phase">Phase One</div>
                    <div class="tl-title">Registration Opens</div>
                    <div class="tl-date">Date TBA</div>
                </div>
                <div class="tl-step">
                    <div class="tl-dot"></div>
                    <div class="tl-phase">Phase Two</div>
                    <div class="tl-title">Design Submission</div>
                    <div class="tl-date">Date TBA</div>
                </div>
                <div class="tl-step">
                    <div class="tl-dot"></div>
                    <div class="tl-phase">Phase Three</div>
                    <div class="tl-title">Shortlist Revealed</div>
                    <div class="tl-date">Date TBA</div>
                </div>
                <div class="tl-step">
                    <div class="tl-dot"></div>
                    <div class="tl-phase">Phase Four</div>
                    <div class="tl-title">Final Pieces</div>
                    <div class="tl-date">Date TBA</div>
                </div>
                <div class="tl-step">
                    <div class="tl-dot"></div>
                    <div class="tl-phase">Phase Five</div>
                    <div class="tl-title">Gala Ceremony</div>
                    <div class="tl-date">2026</div>
                </div>
            </div>

            <div class="timeline-cta">
                <a href="{{ url('/deitiesdesignawards/submit') }}" class="btn-gold">
                    <span>Register Now</span>
                    <span class="arrow">&rarr;</span>
                </a>
            </div>
        </div>
    </section>

@endsection
