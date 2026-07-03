{{-- resources/views/deitiesdesignawards/sections/partners.blade.php --}}

@extends('deitiesdesignawards.layouts.app')

@section('content')

<section class="page-hero-int">
    <div class="page-hero-int-content">
        <span class="page-hero-int-eyebrow">Partners &amp; Supporters</span>
        <h1 class="page-hero-int-title">The pillars<br>behind the platform.</h1>
        <p class="page-hero-int-sub">Industry Associations, Spiritual Institutions and Visionary Brands who share our Devotion.</p>
    </div>
</section>

<section class="section">
    <div class="container">

        <div style="text-align:center;margin-bottom:4rem">
            <span class="section-eyebrow">Founding Partners</span>
        </div>

        {{-- Partner: Jewellers Association Bengaluru --}}
        <div class="partner-full">
            <div class="partner-full-logo">
                <div class="partner-logo-placeholder">
                    <img src="{{ asset('deitiesdesignawards/images/partners/jab-logo.png') }}" alt="Jewellers Association Bengaluru logo" class="partner-logo-img">
                </div>
            </div>
            <div class="partner-full-content">
                <h3>Jewellers Association Bengaluru (JAB)</h3>
                <h4 class="partner-copy-label">About JAB</h4>
                <p>Established in 1938, The Jewellers Association Bangalore is one of India's oldest and most respected jewellery trade bodies. The association has a thriving community of over 1,200 members, representing small, medium and large jewellery businesses. Built on a legacy of strong leadership, industry service and commitment to the trade, the association continues to play a pivotal role in supporting the growth, development and advancement of the jewellery sector.</p>
                <h4 class="partner-copy-label">Role in DDA</h4>
                <p>Serving as the official industry partner for the Deities Design Awards (DDA), The Jewellers Association Bengaluru is instrumental in driving sectoral involvement and commitment. Utilizing its broad professional network, the association bridges the gap between the awards and prominent jewellers, producers, craftsmen and major industry figures, encouraging cooperative efforts and guaranteeing robust representation across the field.</p>
            </div>
        </div>

        {{-- Partner: ISKCON Chowpatty --}}
        <div class="partner-full">
            <div class="partner-full-logo">
                <div class="partner-logo-placeholder">
                    <img src="{{ asset('deitiesdesignawards/images/partners/iskcon_logo.svg') }}" alt="ISKCON Chowpatty logo" class="partner-logo-img">
                </div>
            </div>
            <div class="partner-full-content">
                <h3>ISKCON Chowpatty (Sri Sri Radha Gopinath Temple)</h3>
                <h4 class="partner-copy-label">About ISKCON Chowpatty</h4>
                <p>Located in the heart of Mumbai, ISKCON Chowpatty is one of India's most respected spiritual and cultural institutions. Home to Sri Sri Radha Gopinath, the temple has grown from humble beginnings into a vibrant center for devotion, education, community service and cultural preservation. Renowned for its dedication to spiritual excellence and heritage, it has inspired generations through its teachings, outreach initiatives and commitment to devotional traditions.</p>
                <h4 class="partner-copy-label">Role in DDA</h4>
                <p>As the inaugural host and spiritual partner for the Deities Design Awards (DDA), ISKCON Chowpatty establishes the platform's spiritual core. By facilitating the ceremonial presentation of selected designs, the temple reinforces the DDA's mission to honor sacred jewellery. This partnership integrates these artistic contributions into a living tradition of craftsmanship, cultural legacy and devotion. Winning pieces will be donated to the permanent temple collection, where they will be used for the shringar (adornment) of the deities.</p>
            </div>
        </div>

        {{-- Partner: Jewellery Networking --}}
        <div class="partner-full">
            <div class="partner-full-logo">
                <div class="partner-logo-placeholder">
                    <img src="{{ asset('deitiesdesignawards/images/partners/JN-Logo.svg') }}" alt="Jewellery Networking logo" class="partner-logo-img">
                </div>
            </div>
            <div class="partner-full-content">
                <h3>Jewellery Networking</h3>
                <h4 class="partner-copy-label">About Jewellery Networking</h4>
                <p>Conceived by Prernaa Makhariaa, Jewellery Networking acts as a vital link between service providers and seekers within the global jewellery sector. The platform is dedicated to advancing the industry by facilitating knowledge sharing, business development and distinctive collaborative opportunities. It is widely recognized for hosting exclusive events and innovative initiatives that build robust professional relationships and inspire creative progress throughout the community.</p>
                <h4 class="partner-copy-label">Role in DDA</h4>
                <p>Jewellery Networking is the founding and organizing force behind the Deities Design Awards, serving as the conceptual heart of the initiative. By aligning its mission to build global connections with the DDA's focus on celebrating devotion through design, this project—which is one of the most important, special and close to my heart—unites spiritual institutions, industry leaders and creative participants. It ensures the awards achieve an international reach, creating a lasting legacy through cultural exchange, professional recognition and impactful collaborations.</p>
                <a href="https://jewellerynetworking.com/" target="_blank" rel="noopener" class="story-link" style="display:inline-flex;margin-top:.75rem">
                    Visit Jewellery Networking <span>→</span>
                </a>
            </div>
        </div>

    </div>
</section>

<section class="cta-strip">
    <div class="cta-overlay"></div>
    <div class="cta-inner">
        <h2>Interested in sponsoring? <span class="it">Explore our packages.</span></h2>
        <a href="{{ url('/deitiesdesignawards/sponsor-us') }}" class="btn-cta-gold">
            <span>Sponsorship Options</span><span class="arrow">→</span>
        </a>
    </div>
</section>

@endsection