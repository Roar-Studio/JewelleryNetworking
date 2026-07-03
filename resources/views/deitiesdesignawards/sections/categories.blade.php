{{-- resources/views/deitiesdesignawards/sections/categories.blade.php --}}

@extends('deitiesdesignawards.layouts.app')

@section('content')

<section class="page-hero-int">
    <div class="page-hero-int-content">
        <span class="page-hero-int-eyebrow">Award Categories</span>
        <h1 class="page-hero-int-title">Every craft, every calibre.</h1>
        <p class="page-hero-int-sub">Three dedicated categories honouring the artists, craftspeople and institutions shaping devotional jewellery.</p>
    </div>
</section>

<section class="section">
    <div class="container">

        <div id="designers-brands" class="cat-full-item">
            <div class="cat-full-img" style="background-image:url('{{ asset('deitiesdesignawards/images/Designer sketching temple jewellery, mood boards, CAD design desk, elegant studio.png') }}')">
                <span class="cat-full-num">Category I</span>
            </div>
            <div class="cat-full-content">
                <h3>Jewellery Designers and Brands</h3>
                <p>Independent designers, ateliers, emerging studios, heritage houses and contemporary jewellery labels shaping the language of devotional craft. This category celebrates both visionary makers and established brands that approach sacred jewellery as a distinct creative discipline.</p>
                <p>From independent designers translating devotion into wearable form to heritage houses and contemporary labels curating dedicated collections for deity adornment, this category recognises the artists and brands at the forefront of devotional jewellery creation.</p>
                <div class="cat-eligibility">
                    <span class="cat-eligibility-label">Who Can Participate</span>
                    <ul class="cat-elig-list">
                        <li>Independent Jewellery Designers and Ateliers</li>
                        <li>Design Studios and Emerging Designers (TBC)</li>
                        <li>Established Jewellery Brands and Houses (TBC)</li>
                        <li>Contemporary Labels with Devotional Collections (TBC)</li>
                        <li>Temple Jewellery Specialists and Retailers (TBC)</li>
                    </ul>
                </div>
                <a href="{{ url('/deitiesdesignawards/submit') }}" class="btn-outline" style="margin-top:1.5rem;display:inline-flex;align-items:center;gap:.75rem">
                    <span>Submit in this Category</span><span class="arrow">&#x2192;</span>
                </a>
            </div>
        </div>

        <div id="manufacturers" class="cat-full-item">
            <div class="cat-full-img" style="background-image:url('{{ asset('deitiesdesignawards/images/Closeup artisan hands making setting gold jewellery, tools, wax model, filigree, gemstone setting.png') }}')">
                <span class="cat-full-num">Category II</span>
            </div>
            <div class="cat-full-content">
                <h3>Jewellery Manufacturers</h3>
                <p>Master craftsmen in gold, silver and platinum whose hands give shape to the divine. This category honours the skilled artisans, karigars and manufacturing units that preserve centuries-old techniques while applying them to sacred creations.</p>
                <p>From filigree work and kundan setting to temple jewellery casting and stone inlay, this category recognises the irreplaceable human craft at the heart of devotional jewellery. It celebrates both individual artisans and manufacturing facilities that embody excellence in sacred craftsmanship.</p>
                <div class="cat-eligibility">
                    <span class="cat-eligibility-label">Who Can Participate</span>
                    <ul class="cat-elig-list">
                        <li>Individual Master Artisans and Karigars (TBC)</li>
                        <li>Jewellery Manufacturing Units and Workshops (TBC)</li>
                        <li>Traditional Craft Families and Cooperative Units (TBC)</li>
                        <li>Casting, Setting, Finishing and Gemstone Specialists (TBC)</li>
                    </ul>
                </div>
                <a href="{{ url('/deitiesdesignawards/submit') }}" class="btn-outline" style="margin-top:1.5rem;display:inline-flex;align-items:center;gap:.75rem">
                    <span>Submit in this Category</span><span class="arrow">&#x2192;</span>
                </a>
            </div>
        </div>

        <div id="students-institutions" class="cat-full-item">
            <div class="cat-full-img" style="background-image:url('{{ asset('deitiesdesignawards/images/Designer sketching temple jewellery, mood boards, CAD design desk, elegant studio.png') }}');filter:saturate(.8)">
                <span class="cat-full-num">Category III</span>
            </div>
            <div class="cat-full-content">
                <h3>Students and Institutions</h3>
                <p>The future of devotional jewellery begins with education. This category is open to students currently enrolled in or recently graduated from jewellery design, gemology, or related craft programmes, as well as educational institutions offering such programmes.</p>
                <p>Entries are evaluated with emphasis on conceptual depth, understanding of sacred tradition and creative exploration. This category is designed to discover and nurture the next generation of sacred jewellery makers and support the institutions that educate them.</p>
                <div class="cat-eligibility">
                    <span class="cat-eligibility-label">Who Can Participate</span>
                    <ul class="cat-elig-list">
                        <li>Students Enrolled in Jewellery Design and Craft Programmes (TBC)</li>
                        <li>Recent Graduates within 2 Years of Completing their Degree (TBC)</li>
                        <li>Gemology and Craft Students (TBC)</li>
                        <li>Educational Institutions Offering Jewellery and Craft Programmes (TBC)</li>
                    </ul>
                </div>
                <a href="{{ url('/deitiesdesignawards/submit') }}" class="btn-outline" style="margin-top:1.5rem;display:inline-flex;align-items:center;gap:.75rem">
                    <span>Submit in this Category</span><span class="arrow">&#x2192;</span>
                </a>
            </div>
        </div>

    </div>
</section>

{{-- Special Awards section is commented out in the original — preserved as a Blade comment below --}}
{{--
<section class="section" id="special-awards" style="background:rgba(184,146,42,.04);border-top:1px solid rgba(184,146,42,.12)">
    <div class="container">
        <div style="text-align:center;margin-bottom:1rem">
            <span class="section-eyebrow">Special Recognition</span>
            <h2 class="section-title">Above and Beyond Category.</h2>
            <p style="margin:1rem auto 0;font-size:.9rem;opacity:.7;line-height:1.8">Awarded at the sole discretion of the jury, these three honours recognise work that transcends its category.</p>
        </div>
        <div class="special-awards-grid">
            <div class="special-award-card">
                <h4>Best in Show</h4>
                <p>Awarded to the single most outstanding entry across all categories. The highest honour at the Deities Design Awards, given to the piece that best embodies the sacred spirit of the platform.</p>
            </div>
            <div class="special-award-card">
                <h4>Innovation Award</h4>
                <p>Recognising a contemporary interpretation within devotional jewellery — honouring entries that push the boundaries of materials, technique, or concept while remaining rooted in sacred tradition.</p>
            </div>
            <div class="special-award-card">
                <h4>Sacred Heritage Award</h4>
                <p>Honouring designs rooted in traditional temple jewellery and cultural practices. Celebrating the preservation and continuity of forms, techniques and iconographies that have adorned the divine for centuries.</p>
            </div>
        </div>
    </div>
</section>
--}}

<section class="cta-strip">
    <div class="cta-overlay"></div>
    <div class="cta-inner">
        <h2>Ready to enter? <span class="it">Let your craft become an offering.</span></h2>
        <p>Limited registrations &bull; Curated jury &bull; Industry-defining recognition</p>
        <a href="{{ url('/deitiesdesignawards/submit') }}" class="btn-cta-gold">
            <span>Begin Your Submission</span><span class="arrow">&#x2192;</span>
        </a>
    </div>
</section>

@endsection