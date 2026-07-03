{{-- resources/views/deitiesdesignawards/sections/jury.blade.php --}}

@extends('deitiesdesignawards.layouts.app')

@section('content')

<section class="jury-hero">
    <div class="jury-hero-copy">
        <span class="jury-kicker">The Jury</span>
        <h1>Discernment in service of the divine.</h1>
        <p>A two-stage evaluation process combining technical expertise with creative authority.</p>
        <a href="#grand-jury" class="jury-text-link">Meet the jury framework <span>&darr;</span></a>
    </div>
    <div class="jury-hero-image" role="img" aria-label="Jewellery awards jury reviewing designs"></div>
    <div class="jury-hero-edition"><span>Inaugural Edition 2026</span></div>
</section>

<section class="section jury-panel-section" id="grand-jury">
    <div class="container">
        <div class="jury-panel-intro">
            <div>
                <span class="section-eyebrow">The Grand Jury</span>
                <h2 class="section-title">The panel will be announced soon.</h2>
            </div>
            <p>Our jury panel for the inaugural edition is being carefully assembled. Jurors are drawn from the fields of jewellery design, gemology, cultural heritage, sacred arts and spiritual leadership.</p>
        </div>
        <div class="jury-announcement">
            <div class="jury-announcement-mark">DDA</div>
            <div class="jury-announcement-copy">
                <span>Grand Jury &middot; Inaugural Edition</span>
                <h3>Names to be announced</h3>
                <p>A multidisciplinary panel chosen to balance design excellence, material knowledge, cultural sensitivity and devotional understanding.</p>
            </div>
        </div>
        <div class="jury-disciplines" aria-label="Jury disciplines">
            <div><span>01</span><p>Jewellery Design &amp; Education</p></div>
            <div><span>02</span><p>Cultural Heritage</p></div>
            <div><span>03</span><p>Temple Arts</p></div>
            <div><span>04</span><p>Gemology</p></div>
            <div><span>05</span><p>Sacred Arts &amp; Iconography</p></div>
            <div><span>06</span><p>Industry Leadership</p></div>
        </div>
    </div>
</section>

<section class="section jury-process-section">
    <div class="container">
        <div class="jury-section-heading">
            <span class="section-eyebrow">Judging Structure</span>
            <h2 class="section-title">Two stages, one standard of excellence.</h2>
            <p>The evaluation will take place in two stages:</p>
        </div>
        <div class="jury-process-grid">
            <article class="jury-stage">
                <span class="jury-stage-number">01</span>
                <div>
                    <span class="jury-stage-label">Stage One</span>
                    <h3>Preliminary Screening</h3>
                    <p>Eligibility, compliance and concept review.</p>
                </div>
            </article>
            <article class="jury-stage">
                <span class="jury-stage-number">02</span>
                <div>
                    <span class="jury-stage-label">Stage Two</span>
                    <h3>Final Jury Evaluation</h3>
                    <p>Design, execution and relevance.</p>
                </div>
            </article>
        </div>
        <div class="jury-facts">
            <div><strong>2</strong><span>Jury Stages</span></div>
            <div><strong>6</strong><span>Evaluation Criteria</span></div>
            <div><strong>Final</strong><span>Jury Decision</span></div>
        </div>
    </div>
</section>

<section class="section jury-criteria-section" id="evaluation-criteria">
    <div class="container jury-criteria-layout">
        <div class="jury-criteria-intro">
            <span class="section-eyebrow">Evaluation Criteria</span>
            <h2 class="section-title">How entries are evaluated.</h2>
            <p>Every eligible entry is assessed against the official DDA criteria below.</p>
        </div>
        <div class="jury-criteria-list">
            <div><span>01</span><h3>Concept &amp; Interpretation</h3></div>
            <div><span>02</span><h3>Relevance to Theme</h3></div>
            <div><span>03</span><h3>Craft Feasibility</h3></div>
            <div><span>04</span><h3>Design Quality</h3></div>
            <div><span>05</span><h3>Material Understanding</h3></div>
            <div><span>06</span><h3>Overall Impact</h3></div>
        </div>
    </div>
</section>

<section class="section jury-policy-section">
    <div class="container jury-policy-layout">
        <div class="jury-policy-heading">
            <span class="section-eyebrow">Jury Policies</span>
            <h2 class="section-title">Standards that <span class="it">protect integrity.</span></h2>
        </div>
        <div class="jury-policy-list">
            <article>
                <span>01</span>
                <div>
                    <h3>Conflict of Interest</h3>
                    <p>Jury members must disclose any association with participants. Entries will be reassigned where required.</p>
                </div>
            </article>
            <article>
                <span>02</span>
                <div>
                    <h3>Final Decision</h3>
                    <p>All decisions by the jury are final.</p>
                </div>
            </article>
            <article>
                <span>03</span>
                <div>
                    <h3>Score Publication</h3>
                    <p>Individual scores will not be disclosed.</p>
                </div>
            </article>
            <article>
                <span>04</span>
                <div>
                    <h3>Jury Selection Criteria</h3>
                    <p>To Be Decided</p>
                </div>
            </article>
        </div>
    </div>
</section>

<section class="cta-strip">
    <div class="cta-overlay"></div>
    <div class="cta-inner">
        <h2>Ready to have your work <span class="it">evaluated by the finest?</span></h2>
        <a href="{{ url('/deitiesdesignawards/submit') }}" class="btn-cta-gold">
            <span>Submit Your Entry</span><span class="arrow">&#x2192;</span>
        </a>
    </div>
</section>

@endsection