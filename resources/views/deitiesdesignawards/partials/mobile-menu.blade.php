<div class="mobile-menu-drawer">
    <div class="mobile-menu-logo">
        <img src="{{ asset('deitiesdesignawards/images/Logo/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards">
    </div>
    <div class="mobile-menu-links">
        <a href="{{ url('/deitiesdesignawards') }}" class="mob-link">Home</a>

        <div class="mob-dropdown">
            <button class="mob-dropdown-toggle">Categories <span class="chev">▼</span></button>
            <div class="mob-dropdown-menu">
                <span class="dropdown-label">Participation Category</span>
                <a href="{{ url('/deitiesdesignawards/categories') }}#designers-brands">Jewellery Designers &amp; Brands</a>
                <a href="{{ url('/deitiesdesignawards/categories') }}#manufacturers">Jewellery Manufacturers</a>
                <a href="{{ url('/deitiesdesignawards/categories') }}#students-institutions">Students &amp; Institutions</a>
                <div class="dropdown-sep"></div>
                <a href="{{ url('/deitiesdesignawards/design-category') }}">Design Category</a>
            </div>
        </div>

        <div class="mob-dropdown">
            <button class="mob-dropdown-toggle">Participate <span class="chev">▼</span></button>
            <div class="mob-dropdown-menu">
                <a href="{{ url('/deitiesdesignawards/participate') }}#how-to-enter">How to Enter</a>
                <a href="{{ url('/deitiesdesignawards/participate') }}#fees">Fees</a>
                <a href="{{ url('/deitiesdesignawards/participate') }}#guidelines">Submission Guidelines</a>
                <a href="{{ url('/deitiesdesignawards/jury') }}#evaluation-criteria">Judging Criteria</a>
                <a href="{{ url('/deitiesdesignawards/participate') }}#dates">Important Dates</a>
            </div>
        </div>

        <a href="{{ url('/deitiesdesignawards/inspiration') }}" class="mob-link">Inspiration</a>
        <a href="{{ url('/deitiesdesignawards/jury') }}" class="mob-link">Jury</a>

        <div class="mob-dropdown">
            <button class="mob-dropdown-toggle">Partners <span class="chev">▼</span></button>
            <div class="mob-dropdown-menu">
                <a href="{{ url('/deitiesdesignawards/partners') }}">Our Partners</a>
                <a href="{{ url('/deitiesdesignawards/sponsor-us') }}">Be a Sponsor</a>
            </div>
        </div>

        <a href="{{ url('/deitiesdesignawards/about') }}" class="mob-link">About</a>
        <a href="{{ url('/deitiesdesignawards/contact') }}" class="mob-link">Contact</a>
        <a href="{{ url('/deitiesdesignawards/submit') }}" class="mob-register-btn">Register</a>
    </div>
</div>
