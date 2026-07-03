{{-- resources/views/deitiesdesignawards/sections/contact.blade.php --}}

@extends('deitiesdesignawards.layouts.app')

@section('content')

<section class="page-hero-int">
    <div class="page-hero-int-content">
        {{-- eyebrow commented out in original, preserved as Blade comment --}}
        {{-- <span class="page-hero-int-eyebrow">Contact</span> --}}
        <h1 class="page-hero-int-title">Get in touch with us.</h1>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="contact-layout">

            {{-- Contact Info --}}
            <div class="contact-info">
                <span class="section-eyebrow">Reach Us</span>
                <h2 class="section-title" style="margin-bottom:2rem">We&#x2019;d love to hear from you.</h2>

                <div class="contact-detail-item">
                    <span class="cdi-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.22 2 2 0 0 1 3.6 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.64a16 16 0 0 0 6 6l1.27-.94a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                    </span>
                    <div>
                        <span class="cdi-label">Phone</span>
                        <a href="tel:+919819155544" class="cdi-value">+91 98191 55544</a>
                    </div>
                </div>

                <div class="contact-detail-item">
                    <span class="cdi-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="2" y="4" width="20" height="16" rx="2"/>
                            <path d="M2 7l10 7 10-7"/>
                        </svg>
                    </span>
                    <div>
                        <span class="cdi-label">Email</span>
                        <a href="mailto:info@deitiesdesignawards.com" class="cdi-value">info@deitiesdesignawards.com</a>
                    </div>
                </div>

                <div class="contact-detail-item" style="margin-top:1.5rem">
                    <span class="cdi-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                    </span>
                    <div>
                        <span class="cdi-label">Address</span>
                        <span class="cdi-value">TBA, Mumbai, India</span>
                    </div>
                </div>

                <div class="contact-detail-item">
                    <span class="cdi-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </span>
                    <div>
                        <span class="cdi-label">Office Hours</span>
                        <span class="cdi-value">10:00 AM &#x2013; 6:00 PM IST</span>
                    </div>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="contact-form-col">
                <div class="contact-form-card">
                    <h3 style="font-family:'Cormorant Garamond',serif;font-style:italic;font-size:1.5rem;margin-bottom:1.5rem">Send us a message</h3>
                    <form class="contact-form" id="contact-form" novalidate>
                        <div class="form-field">
                            <label for="cf-name">Your Name <span class="req">*</span></label>
                            <input type="text" id="cf-name" placeholder="Full name" required>
                        </div>
                        <div class="form-field">
                            <label for="cf-email">Email Address <span class="req">*</span></label>
                            <input type="email" id="cf-email" placeholder="your@email.com" required>
                        </div>
                        <div class="form-field">
                            <label for="cf-subject">Subject <span class="req">*</span></label>
                            <select id="cf-subject" required>
                                <option value="">Select a topic</option>
                                <option>General Enquiry</option>
                                <option>Submission Help</option>
                                <option>Partnership Enquiry</option>
                                <option>Media / Press</option>
                                <option>Technical Support</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="form-field">
                            <label for="cf-msg">Message <span class="req">*</span></label>
                            <textarea id="cf-msg" rows="6" placeholder="How can we help you?" required></textarea>
                        </div>
                        <button type="submit" class="btn-gold" style="width:100%;justify-content:center">
                            Send Message <span class="arrow">&#x2192;</span>
                        </button>
                        <div id="cf-success" style="display:none;margin-top:1rem;padding:1rem;background:rgba(184,146,42,.08);border:1px solid rgba(184,146,42,.2);border-radius:4px;font-size:.85rem;text-align:center">
                            Thank you &#x2014; we&#x2019;ve received your message and will respond within 2 business days.
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    (function () {
        document.getElementById('contact-form').addEventListener('submit', function (e) {
            e.preventDefault();
            document.getElementById('cf-success').style.display = 'block';
            e.target.querySelector('button[type="submit"]').disabled = true;
        });
    })();
</script>
@endpush