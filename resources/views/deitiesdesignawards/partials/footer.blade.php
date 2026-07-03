<footer>
    <div class="footer-top">
        <div class="footer-brand">
            <img src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards">
            <p>It was always devotion</p>
            <div class="footer-socials">
                <a href="#" class="footer-social" aria-label="Instagram">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="3" width="18" height="18" rx="4" />
                        <circle cx="12" cy="12" r="4" />
                        <circle cx="17.5" cy="6.5" r="1" fill="currentColor" />
                    </svg>
                </a>
                <a href="#" class="footer-social" aria-label="Facebook">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M14 8h-2a2 2 0 0 0-2 2v2H8v3h2v7h3v-7h2.5l.5-3H13v-1.5c0-.5.5-1 1-1h2V8z" />
                    </svg>
                </a>
                <a href="#" class="footer-social" aria-label="LinkedIn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="3" width="18" height="18" rx="2" />
                        <path d="M8 10v8M8 7v.01M12 18v-5a2 2 0 0 1 4 0v5" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="footer-col">
            <h5>Explore</h5>
            <ul>
                <li><a href="{{ url('/deitiesdesignawards/about') }}">About DDA</a></li>
                <li><a href="{{ url('/deitiesdesignawards/categories') }}">Categories</a></li>
                <li><a href="{{ url('/deitiesdesignawards/inspiration') }}">Inspiration</a></li>
                <li><a href="{{ url('/deitiesdesignawards/jury') }}">Jury</a></li>
                <li><a href="{{ url('/deitiesdesignawards/press-kit') }}">Press Kit</a></li>
                <li><a href="{{ url('/deitiesdesignawards/participate') }}#dates">Calendar</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h5>Participate</h5>
            <ul>
                <li><a href="{{ url('/deitiesdesignawards/participate') }}#how-to-enter">How to Enter</a></li>
                <li><a href="{{ url('/deitiesdesignawards/participate') }}#fees">Fees</a></li>
                <li><a href="{{ url('/deitiesdesignawards/participate') }}#guidelines">Guidelines</a></li>
                <li><a href="{{ url('/deitiesdesignawards') }}#faq">FAQ</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h5>Contact</h5>
            <ul>
                <li><a href="tel:+919819155544">+91 98191 55544</a></li>
                <li><a href="mailto:info@deitiesdesignawards.com">info@deitiesdesignawards.com</a></li>
                <li>Mumbai, India</li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <span>© {{ date('Y') }} Deities Design Awards · All Rights Reserved</span>
        <span>
            <a href="{{ url('/deitiesdesignawards/terms') }}">Terms</a>
            <a href="{{ url('/deitiesdesignawards/privacy') }}">Privacy</a>
            <a href="#">Code of Conduct</a>
        </span>
    </div>
</footer>
