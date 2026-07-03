{{-- resources/views/deitiesdesignawards/sections/participate.blade.php --}}

@extends('deitiesdesignawards.layouts.app')

@section('content')

<section class="page-hero-int">
    <div class="page-hero-int-content">
        <span class="page-hero-int-eyebrow">How to Participate</span>
        <h1 class="page-hero-int-title">Your journey<br>to recognition.</h1>
        <p class="page-hero-int-sub">Everything you need to know to prepare and submit your entry.</p>
    </div>
</section>

<section class="section">
    <div class="container">

        <div class="participate-tabs" id="participate-tabs">
            <button class="p-tab active" data-tab="how-to-enter">How to Enter</button>
            <button class="p-tab" data-tab="guidelines">Submission Guidelines</button>
            <button class="p-tab" data-tab="fees">Fees</button>
            <button class="p-tab" data-tab="dates">Important Dates</button>
        </div>

        {{-- Tab: How to Enter --}}
        <div class="p-panel active" id="tab-how-to-enter">
            <span class="section-eyebrow">The Process</span>
            <h2 class="section-title" style="margin-bottom:2rem">Five phases, one destination.</h2>

            <ol class="step-list">
                <li>
                    <div class="step-num">01</div>
                    <div class="step-content">
                        <h4>Registration</h4>
                        <p>Create your participant account and confirm your chosen category. Provide your details as a designer, brand, artisan or student.<br>Registration is free — you only pay the submission fee when you are ready to submit.</p>
                    </div>
                </li>
                <li>
                    <div class="step-num">02</div>
                    <div class="step-content">
                        <h4>Entry Preparation</h4>
                        <p>Prepare your entry materials including high-resolution images (JPEG/PNG, minimum 2000px on the long side), a design statement describing the piece&#x2019;s sacred intent and supporting technical documentation. Review the submission guidelines carefully before preparing your files.</p>
                    </div>
                </li>
                <li>
                    <div class="step-num">03</div>
                    <div class="step-content">
                        <h4>Submission</h4>
                        <p>Complete the online submission form. Upload your images, fill in all required fields, pay the submission fee and confirm your declaration. You will receive a confirmation email with your entry reference number.</p>
                    </div>
                </li>
                <li>
                    <div class="step-num">04</div>
                    <div class="step-content">
                        <h4>Jury Evaluation</h4>
                        <p>Your entry is reviewed through the DDA jury process, beginning with preliminary screening for eligibility, compliance and concept review, followed by final jury evaluation for design, execution and relevance. <a href="{{ url('/deitiesdesignawards/jury#evaluation-criteria') }}" style="color:var(--gold,#b8922a)">View the evaluation criteria</a>.</p>
                    </div>
                </li>
                <li>
                    <div class="step-num">05</div>
                    <div class="step-content">
                        <h4>Awards Ceremony</h4>
                        <p>Shortlisted and winning entries are announced at the Deities Design Awards Ceremony 2026. Winners receive their trophy, citation and access to a dedicated winners&#x2019; gallery platform with year-round visibility.</p>
                    </div>
                </li>
            </ol>

            <a href="{{ url('/deitiesdesignawards/submit') }}" class="btn-gold" style="display:inline-flex;align-items:center;gap:.75rem;margin-top:2.5rem">
                <span>Begin Your Submission</span><span class="arrow">&#x2192;</span>
            </a>
        </div>

        {{-- Tab: Submission Guidelines --}}
        <div class="p-panel" id="tab-guidelines">
            <span class="section-eyebrow">Guidelines</span>
            <h2 class="section-title">Submission standards.</h2>
            <p>All entries must meet the following requirements to be considered for evaluation. Submissions that do not comply with these guidelines may be disqualified without refund.</p>

            <ul class="guidelines-list">
                <li><strong>Image format:</strong> JPEG or PNG only. No other formats accepted.</li>
                <li><strong>Resolution:</strong> Minimum 2000 pixels on the long side. Recommended 3000px+. Images must be sharp, well-lit and free of watermarks.</li>
                <li><strong>File size:</strong> Maximum 25 MB per image. Maximum 10 images per submission entry.</li>
                <li><strong>Image content:</strong> Images must show only the submitted piece. No stock backgrounds, props or models that distract from the jewellery are permitted.</li>
                <li><strong>Multiple views:</strong> We recommend including at least 3 views — front, detail/close-up and a contextual or scale shot.</li>
                <li><strong>Design statement:</strong> Required for all entries. Between 150 and 500 words describing the sacred inspiration, design intent, materials and techniques used.</li>
                <li><strong>Eligibility:</strong> Entries must represent work created within the past 3 years (2023–2026). Previously submitted entries to DDA are not eligible for resubmission.</li>
                <li><strong>Authenticity:</strong> All submitted work must be the original creation of the entrant. Collaborative work must be clearly disclosed with all contributors named.</li>
                <li><strong>Sacred intent:</strong> All entries must be jewellery created with explicit sacred, devotional or spiritual intent for deities, temples, religious occasions or spiritual practices.</li>
                <li><strong>Language:</strong> All written submissions must be in English. Hindi submissions may include an English translation.</li>
            </ul>
        </div>

        {{-- Tab: Fees --}}
        <div class="p-panel" id="tab-fees">
            <span class="section-eyebrow">Entry Fees</span>
            <h2 class="section-title">Investment in recognition.</h2>
            <p>Entry fees vary by category and participant type. All fees are inclusive of taxes. Multiple entries attract a discounted rate from the third entry onward.</p>

            <div class="fees-table-wrap">
                <table class="fees-table">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Standard Fee</th>
                            <th>Early Bird</th>
                            <th>Student Fee</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Designers &amp; Studios</td>
                            <td>TBA</td>
                            <td>TBA</td>
                            <td>&#x2014;</td>
                        </tr>
                        <tr>
                            <td>Brands &amp; Retailers</td>
                            <td>TBA</td>
                            <td>TBA</td>
                            <td>&#x2014;</td>
                        </tr>
                        <tr>
                            <td>Artisans &amp; Manufacturers</td>
                            <td>TBA</td>
                            <td>TBA</td>
                            <td>&#x2014;</td>
                        </tr>
                        <tr>
                            <td>Diamantaires &amp; Suppliers</td>
                            <td>TBA</td>
                            <td>TBA</td>
                            <td>&#x2014;</td>
                        </tr>
                        <tr>
                            <td>Student Category</td>
                            <td>TBA</td>
                            <td>TBA</td>
                            <td>TBA</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p style="font-size:.8rem;opacity:.6;margin-top:1.5rem;font-style:italic">
                Fee structure will be published upon opening of registrations. Subscribe to be notified.
                <a href="{{ url('/deitiesdesignawards/contact') }}" style="color:var(--gold-deep,#8a7026)">Notify me</a>
            </p>
            <p style="font-size:.8rem;opacity:.6;font-style:italic">
                Fees are non-refundable once a submission has entered preliminary screening.
            </p>
        </div>

        {{-- Tab: Important Dates --}}
        <div class="p-panel" id="tab-dates">
            <span class="section-eyebrow">Calendar</span>
            <h2 class="section-title">Key dates for Edition 1.</h2>
            <p>Save these dates. Detailed timelines will be published upon the opening of the inaugural edition.</p>

            <div class="dates-timeline" id="dates">
                <div class="timeline-item">
                    <div class="tl-dot active"></div>
                    <div class="tl-content">
                        <span class="tl-label">Phase 1</span>
                        <h4>Registration Opens</h4>
                        <p>TBA &#x2014; 2026</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="tl-dot"></div>
                    <div class="tl-content">
                        <span class="tl-label">Phase 2</span>
                        <h4>Early Bird Deadline</h4>
                        <p>TBA &#x2014; 2026</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="tl-dot"></div>
                    <div class="tl-content">
                        <span class="tl-label">Phase 3</span>
                        <h4>Standard Submission Deadline</h4>
                        <p>TBA &#x2014; 2026</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="tl-dot"></div>
                    <div class="tl-content">
                        <span class="tl-label">Phase 4</span>
                        <h4>Jury Evaluation Period</h4>
                        <p>TBA &#x2014; 2026</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="tl-dot"></div>
                    <div class="tl-content">
                        <span class="tl-label">Phase 5</span>
                        <h4>Shortlist Announcement</h4>
                        <p>TBA &#x2014; 2026</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="tl-dot"></div>
                    <div class="tl-content">
                        <span class="tl-label">Finale</span>
                        <h4>Awards Ceremony 2026</h4>
                        <p>TBA &#x2014; Mumbai, India</p>
                    </div>
                </div>
            </div>

            <a href="{{ url('/deitiesdesignawards/contact') }}" class="btn-outline" style="margin-top:2rem;display:inline-flex;align-items:center;gap:.75rem">
                <span>Get Notified When Dates Are Announced</span><span class="arrow">&#x2192;</span>
            </a>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    (function () {
        const tabs   = document.querySelectorAll('.p-tab');
        const panels = document.querySelectorAll('.p-panel');

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                tabs.forEach(function (t) { t.classList.remove('active'); });
                panels.forEach(function (p) { p.classList.remove('active'); });

                tab.classList.add('active');
                document.getElementById('tab-' + tab.dataset.tab).classList.add('active');
            });
        });

        // Hash-based deep-link — activates the matching tab on page load
        var h = location.hash.replace('#', '');
        if (h) {
            var bt = document.querySelector('[data-tab="' + h + '"]');
            if (bt) bt.click();
        }
    })();
</script>
@endpush