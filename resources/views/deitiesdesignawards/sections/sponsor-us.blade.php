{{-- resources/views/deitiesdesignawards/sections/sponsor-us.blade.php --}}

@extends('deitiesdesignawards.layouts.app')

@section('content')

<section class="page-hero-int">
    <div class="page-hero-int-content">
        <span class="page-hero-int-eyebrow">Sponsorship</span>
        <h1 class="page-hero-int-title">Partner with us.</h1>
        <p class="page-hero-int-sub">India's first sacred jewellery platform.</p>
    </div>
</section>

<section class="section" style="background:rgba(184,146,42,.04);border-top:1px solid rgba(184,146,42,.12)">
    <div class="container">

        <div style="text-align:center;margin-bottom:3rem">
            <h2 class="section-title">Partner with India's first sacred jewellery platform.</h2>
            <p style="max-width:640px;margin:1rem auto 0;font-size:.9rem;opacity:.7;line-height:1.8">DDA offers a unique opportunity to align your brand with devotion, heritage and creative excellence. Our sponsorship packages are designed for brands that understand the power of sacred craft.</p>
        </div>

        <div class="sponsor-grid">

            {{-- Platinum: Title Sponsor --}}
            <div class="sponsor-tier-card tier-platinum">
                <span class="tier-label">Platinum</span>
                <h4>Title Sponsor</h4>
                <ul>
                    <li>Co-branding on all DDA communications</li>
                    <li>Presenting sponsorship of the Awards Ceremony</li>
                    <li>Premium exhibition space</li>
                    <li>Exclusive jury interaction opportunity</li>
                    <li>Year-round digital visibility</li>
                    <li>Editorial feature in DDA publication</li>
                </ul>
                <a href="mailto:info@deitiesdesignawards.com" class="btn-outline" style="margin-top:auto;display:inline-flex;align-items:center;gap:.75rem">
                    <span>Enquire</span><span class="arrow">→</span>
                </a>
                <a href="mailto:info@deitiesdesignawards.com?subject=Partner With Us" class="btn-gold" style="margin-top:.75rem;display:inline-flex;align-items:center;gap:.75rem">
                    <span>Partner with Us</span><span class="arrow">→</span>
                </a>
            </div>

            {{-- Gold: Category Sponsor --}}
            <div class="sponsor-tier-card tier-gold">
                <span class="tier-label">Gold</span>
                <h4>Category Sponsor</h4>
                <ul>
                    <li>Category naming rights</li>
                    <li>Prominent branding at ceremony</li>
                    <li>Exhibition presence</li>
                    <li>Logo on all digital assets</li>
                    <li>Social media features</li>
                </ul>
                <a href="mailto:info@deitiesdesignawards.com?subject=Partner With Us" class="btn-outline" style="margin-top:auto;display:inline-flex;align-items:center;gap:.75rem">
                    <span>Enquire</span><span class="arrow">→</span>
                </a>
                <a href="mailto:info@deitiesdesignawards.com?subject=Partner With Us" class="btn-gold" style="margin-top:.75rem;display:inline-flex;align-items:center;gap:.75rem">
                    <span>Partner with Us</span><span class="arrow">→</span>
                </a>
            </div>

            {{-- Silver: Associate Sponsor --}}
            <div class="sponsor-tier-card tier-silver">
                <span class="tier-label">Silver</span>
                <h4>Associate Sponsor</h4>
                <ul>
                    <li>Logo on website and digital assets</li>
                    <li>Social media acknowledgement</li>
                    <li>Ceremony invitation</li>
                </ul>
                <a href="mailto:info@deitiesdesignawards.com?subject=Partner With Us" class="btn-outline" style="margin-top:auto;display:inline-flex;align-items:center;gap:.75rem">
                    <span>Enquire</span><span class="arrow">→</span>
                </a>
                <a href="mailto:info@deitiesdesignawards.com?subject=Partner With Us" class="btn-gold" style="margin-top:.75rem;display:inline-flex;align-items:center;gap:.75rem">
                    <span>Partner with Us</span><span class="arrow">→</span>
                </a>
            </div>

        </div>

        <p style="text-align:center;margin-top:2rem;font-size:.85rem;opacity:.6">
            For custom partnership packages, contact us at
            <a href="mailto:info@deitiesdesignawards.com" style="color:var(--gold-deep,#8a7026)">info@deitiesdesignawards.com</a>
        </p>

    </div>
</section>

{{-- cta-strip is commented out in the original — preserved as a Blade comment --}}
{{--
<section class="cta-strip">
    <div class="cta-overlay"></div>
    <div class="cta-inner">
        <h2>Become part of <span class="it">India's most sacred design platform.</span></h2>
        <a href="mailto:info@deitiesdesignawards.com" class="btn-cta-gold"><span>Partner With Us</span><span class="arrow">→</span></a>
    </div>
</section>
--}}

@endsection