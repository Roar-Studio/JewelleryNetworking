{{-- resources/views/deitiesdesignawards/sections/about.blade.php --}}

@extends('deitiesdesignawards.layouts.app')

@section('content')

{{-- page-hero-int is commented out in the original — preserved as a Blade comment --}}
{{--
<section class="page-hero-int">
    <div class="page-hero-int-content">
        <span class="page-hero-int-eyebrow">About the Awards</span>
        <h1 class="page-hero-int-title">A movement in sacred craft.</h1>
        <p class="page-hero-int-sub">It was always devotion</p>
    </div>
</section>
--}}

{{-- Founder's Note --}}
<section class="section about-deep-grid">
    <div class="container about-founder-wrap">
        <div class="about-deep-img" style="background-image:url('{{ asset('deitiesdesignawards/images/Conceptual sacred jewellery composition crown, necklace, gemstones, temple motifs, dramatic editorial lighting.png') }}');height:480px;background-size:cover;background-position:center"></div>
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
</section>

{{-- Five Pillars — display:none preserved exactly as in original --}}
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

{{-- Founder Profile --}}
<section class="section">
    <div class="container">
        <span class="section-eyebrow">Founder Profile</span>
        <h2 class="section-title" style="margin-bottom:3rem">Founder &amp; Visionary,<br> Deities Design Awards.</h2>
        <div class="founder-bio-grid">
            <div>
                <img src="{{ asset('deitiesdesignawards/images/founder.webp') }}" alt="Prernaa Makhariaa" class="founder-profile-photo" style="width:100%;aspect-ratio:4/5;object-fit:cover;border:1px solid rgba(184,146,42,.2);display:block">
                <div class="founder-bio-meta" style="margin-top:1.5rem;padding-top:1.25rem;border-top:1px solid rgba(184,146,42,.2)">
                    <span class="founder-bio-name" style="display:block;font-family:'Cormorant Garamond',serif;font-size:1.4rem;font-style:italic;margin-bottom:.2rem">Prernaa Makhariaa</span>
                    <span style="font-size:.75rem;letter-spacing:.06em;opacity:.6">Founder &amp; Visionary, Deities Design Awards (DDA)</span>
                </div>
            </div>
            <div>
                <blockquote style="font-family:'Cormorant Garamond',serif;font-size:1.5rem;font-style:italic;font-weight:300;line-height:1.65;border-left:2px solid var(--gold,#b8922a);padding-left:1.5rem;margin:0 0 2rem">&#x201C;BE CEEN: connect, engage, empower and network.&#x201D;</blockquote>
                <p style="font-size:.9rem;line-height:1.85;opacity:.8;margin-bottom:.85rem">Prernaa Makhariaa, Founder and Visionary of the Deities Design Awards (DDA), is a seasoned entrepreneur and influential voice in the jewellery industry.</p>
                <p style="font-size:.9rem;line-height:1.85;opacity:.8;margin-bottom:.85rem">She is the founder of Jewellery Networking, a premier platform dedicated to helping the global jewellery community &#x201C;BE CEEN&#x201D; by providing a one-stop destination for businesses, service providers and service seekers to connect, engage, empower and network.</p>
                <p style="font-size:.9rem;line-height:1.85;opacity:.8">With over two decades of industry expertise, Prernaa is passionate about uniting the gems, jewellery and allied sectors, creating meaningful opportunities for collaboration, experiences, growth, learning and innovation across the global jewellery ecosystem.</p>
            </div>
        </div>
    </div>
</section>

{{-- Mission & Vision --}}
<section class="section" style="background:rgba(184,146,42,.04);border-top:1px solid rgba(184,146,42,.12);border-bottom:1px solid rgba(184,146,42,.12)">
    <div class="container">
        <div style="text-align:center;margin-bottom:3rem">
            <span class="section-eyebrow">Mission &amp; Vision</span>
            <h2 class="section-title">Where Devotion Meets Design</h2>
        </div>
        <div class="vision-split">
            <div class="vision-card">
                <span class="vision-card-label">Mission Statement</span>
                <p>The Deities Design Awards is a globally travelling initiative dedicated to honouring exceptional jewellery design and craftsmanship. Hosted at a different spiritual destination each year, its mission is to celebrate devotion through design, preserve and promote cultural heritage, recognise outstanding artistry and inspire meaningful creative expression. Through this platform, we aim to give back to society by encouraging jewellery that carries purpose, tells stories and upholds the finest traditions of craftsmanship and innovation for future generations.</p>
            </div>
            <div class="vision-card">
                <span class="vision-card-label">Vision Statement</span>
                <p>To cultivate a worldwide legacy that honors and promotes jewellery rooted in faith, tradition and heritage. By uniting unparalleled creative voices from across the globe, the platform aims to exhibit artistic excellence, safeguard cultural histories and advocate for craftsmanship as an enduring manifestation of human ingenuity.</p>
            </div>
        </div>
        {{-- tagline-center commented out in original --}}
        {{-- <div class="tagline-center">It was always devotion</div> --}}
    </div>
</section>

{{-- Partners --}}
<section class="section">
    <div class="container">
        <div style="text-align:center;margin-bottom:4rem">
            <h2 class="section-title">Partners</h2>
        </div>

        {{-- Partner: JAB --}}
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

        {{-- Partner: ISKCON --}}
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

{{-- Inaugural Edition --}}
<section class="section" style="background:rgba(184,146,42,.04);border-top:1px solid rgba(184,146,42,.12)">
    <div class="container">
        <div class="about-founder-wrap">
            <div>
                <span class="section-eyebrow">The Inaugural Edition</span>
                <h2 class="section-title">What Makes This Edition Special?</h2>
                <p style="font-size:.9rem;line-height:1.85;opacity:.8;margin-bottom:1rem">The debut of the Deities Design Awards (DDA) introduces an unprecedented platform exclusively focused on sacred and spiritual jewellery for divine figures.</p>
                <p style="font-size:.9rem;line-height:1.85;opacity:.8;margin-bottom:1rem">The premiere edition centers on creating bespoke jewellery for the deities at ISKCON Chowpatty.</p>
                <p style="font-size:.9rem;line-height:1.85;opacity:.8;margin-bottom:1rem">DDA distinguishes itself by ensuring that chosen works are not merely showcased, but ceremonially presented to temple deities. These pieces then serve as permanent adornments during significant festivals throughout India.</p>
                <p style="font-size:.9rem;line-height:1.85;opacity:.8;margin-bottom:1.5rem">By integrating into active devotional practices, these creations move beyond the realm of competition to occupy a respected role within the living heritage of craftsmanship and spiritual tradition.</p>
                <a href="{{ url('/deitiesdesignawards/submit') }}" class="btn-gold" style="display:inline-flex;align-items:center;gap:.75rem;margin-top:2rem">
                    <span>Enter the Inaugural Edition</span><span class="arrow">&#x2192;</span>
                </a>
            </div>
            <div class="about-deep-img" style="background-image:url('{{ asset('deitiesdesignawards/images/Traditional temple jewellery set, goddess deity ornaments, South Indian temple jewellery details.png') }}');height:500px;background-size:cover;background-position:center"></div>
        </div>
    </div>
</section>

@endsection