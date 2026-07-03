{{-- resources/views/deitiesdesignawards/sections/inspiration.blade.php --}}

@extends('deitiesdesignawards.layouts.app')

@section('content')

<section class="page-hero-int">
    <div class="page-hero-int-content">
        {{-- eyebrow commented out in original, preserved as Blade comment --}}
        {{-- <span class="page-hero-int-eyebrow">Inspiration</span> --}}
        <h1 class="page-hero-int-title">Inspiration</h1>
        <p class="page-hero-int-sub">Curated publications from the world of Sacred Jewellery.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="inspo-grid">

            {{-- Card 01: Carvings --}}
            <div class="inspo-card">
                <div class="inspo-card-cover">
                    <div class="inspo-pdf-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                            <polyline points="10 9 9 9 8 9"/>
                        </svg>
                    </div>
                    <span class="inspo-card-num">01</span>
                </div>
                <div class="inspo-card-body">
                    <h3 class="inspo-card-title">Carvings</h3>
                    <p class="inspo-card-desc">Intricate carving techniques and detailed artistry.</p>
                    <div class="inspo-card-actions">
                        <a href="{{ asset('deitiesdesignawards/inspiration/Inspiration - Carvings.pdf') }}" download class="inspo-card-btn inspo-btn-primary">
                            <span>Download PDF</span>
                        </a>
                        <button class="inspo-card-btn inspo-btn-secondary" onclick="openGallery('carvings')">
                            <span>Open Gallery</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Card 02: Painting --}}
            <div class="inspo-card">
                <div class="inspo-card-cover">
                    <div class="inspo-pdf-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                            <polyline points="10 9 9 9 8 9"/>
                        </svg>
                    </div>
                    <span class="inspo-card-num">02</span>
                </div>
                <div class="inspo-card-body">
                    <h3 class="inspo-card-title">Painting</h3>
                    <p class="inspo-card-desc">Artistic painting techniques and color palettes.</p>
                    <div class="inspo-card-actions">
                        <a href="{{ asset('deitiesdesignawards/inspiration/Inspiration - Painting.pdf') }}" download class="inspo-card-btn inspo-btn-primary">
                            <span>Download PDF</span>
                        </a>
                        <button class="inspo-card-btn inspo-btn-secondary" onclick="openGallery('painting')">
                            <span>Open Gallery</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Card 03: Wooden --}}
            <div class="inspo-card">
                <div class="inspo-card-cover">
                    <div class="inspo-pdf-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                            <polyline points="10 9 9 9 8 9"/>
                        </svg>
                    </div>
                    <span class="inspo-card-num">03</span>
                </div>
                <div class="inspo-card-body">
                    <h3 class="inspo-card-title">Wooden</h3>
                    <p class="inspo-card-desc">Sacred wooden inspirations and traditional craftsmanship.</p>
                    <div class="inspo-card-actions">
                        <a href="{{ asset('deitiesdesignawards/inspiration/Inspiration - Wooden.pdf') }}" download class="inspo-card-btn inspo-btn-primary">
                            <span>Download PDF</span>
                        </a>
                        <button class="inspo-card-btn inspo-btn-secondary" onclick="openGallery('wooden')">
                            <span>Open Gallery</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Card 04: Deities --}}
            <div class="inspo-card">
                <div class="inspo-card-cover">
                    <div class="inspo-pdf-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                            <polyline points="10 9 9 9 8 9"/>
                        </svg>
                    </div>
                    <span class="inspo-card-num">04</span>
                </div>
                <div class="inspo-card-body">
                    <h3 class="inspo-card-title">Deities</h3>
                    <p class="inspo-card-desc">Sacred deity representations and spiritual symbolism.</p>
                    <div class="inspo-card-actions">
                        <a href="{{ asset('deitiesdesignawards/inspiration/Inspiration - Deities.pdf') }}" download class="inspo-card-btn inspo-btn-primary">
                            <span>Download PDF</span>
                        </a>
                        <button class="inspo-card-btn inspo-btn-secondary" onclick="openGallery('deities')">
                            <span>Open Gallery</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    function openGallery(type) {
        window.location.href = '/deitiesdesignawards/gallery?category=' + type;
    }
</script>
@endpush