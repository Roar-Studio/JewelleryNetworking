@php
    $currentRoute = request()->path();
@endphp

<nav>
    <a href="{{ url('/deitiesdesignawards') }}" class="nav-logo">
        <img src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards">
    </a>

    <div class="nav-links">
        <a href="{{ url('/deitiesdesignawards') }}"
           class="nav-link {{ $currentRoute === 'deitiesdesignawards' ? 'active' : '' }}">Home</a>

        <div class="has-dropdown">
            <a class="nav-link {{ str_contains($currentRoute, 'categories') || str_contains($currentRoute, 'design-category') ? 'active' : '' }}">
                Categories <span class="chev">▼</span>
            </a>
            <div class="dropdown">
                <span class="dropdown-label">Participation Category</span>
                <a href="{{ url('/deitiesdesignawards/categories') }}#designers-brands">Jewellery Designers &amp; Brands</a>
                <a href="{{ url('/deitiesdesignawards/categories') }}#manufacturers">Jewellery Manufacturers</a>
                <a href="{{ url('/deitiesdesignawards/categories') }}#students-institutions">Students &amp; Institutions</a>
                <div class="dropdown-sep"></div>
                <a href="{{ url('/deitiesdesignawards/design-category') }}">Design Category</a>
            </div>
        </div>

        <div class="has-dropdown">
            <a class="nav-link {{ str_contains($currentRoute, 'participate') ? 'active' : '' }}">
                Participate <span class="chev">▼</span>
            </a>
            <div class="dropdown">
                <a href="{{ url('/deitiesdesignawards/participate') }}#how-to-enter">How to Enter</a>
                <a href="{{ url('/deitiesdesignawards/participate') }}#fees">Fees</a>
                <a href="{{ url('/deitiesdesignawards/participate') }}#guidelines">Submission Guidelines</a>
                <a href="{{ url('/deitiesdesignawards/jury') }}#evaluation-criteria">Judging Criteria</a>
                <a href="{{ url('/deitiesdesignawards/participate') }}#dates">Important Dates</a>
            </div>
        </div>

        <a href="{{ url('/deitiesdesignawards/inspiration') }}"
           class="nav-link {{ str_contains($currentRoute, 'inspiration') ? 'active' : '' }}">Inspiration</a>

        <a href="{{ url('/deitiesdesignawards/jury') }}"
           class="nav-link {{ str_contains($currentRoute, 'jury') ? 'active' : '' }}">Jury</a>

        <div class="has-dropdown">
            <a class="nav-link {{ str_contains($currentRoute, 'partners') || str_contains($currentRoute, 'sponsor') ? 'active' : '' }}">
                Partners <span class="chev">▼</span>
            </a>
            <div class="dropdown">
                <a href="{{ url('/deitiesdesignawards/partners') }}">Our Partners</a>
                <a href="{{ url('/deitiesdesignawards/sponsor-us') }}">Be a Sponsor</a>
            </div>
        </div>

        <a href="{{ url('/deitiesdesignawards/about') }}"
           class="nav-link {{ str_contains($currentRoute, 'about') ? 'active' : '' }}">About</a>

        <a href="{{ url('/deitiesdesignawards/contact') }}"
           class="nav-link {{ str_contains($currentRoute, 'contact') ? 'active' : '' }}">Contact</a>
    </div>

    <div class="nav-right">
        <button class="nav-icon" aria-label="Search">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="11" cy="11" r="8" />
                <path d="M21 21l-4.35-4.35" />
            </svg>
        </button>
        <a href="{{ url('/deitiesdesignawards/submit') }}" class="nav-cta">Register</a>
        <button class="mobile-menu-toggle" aria-label="Toggle Menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
    </div>
</nav>
