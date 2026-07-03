{{-- resources/views/deitiesdesignawards/sections/faq.blade.php --}}

@extends('deitiesdesignawards.layouts.app')

@section('content')

<section class="page-hero-int">
    <div class="page-hero-int-content">
        <span class="page-hero-int-eyebrow">FAQs</span>
        <h1 class="page-hero-int-title">Frequently Asked<br>Questions</h1>
        <p class="page-hero-int-sub">Find answers to common questions about the Deities Design Awards.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="faq-list">

            <div class="faq-item">
                <button class="faq-q">Who can participate in DDA? <span class="faq-chev">+</span></button>
                <div class="faq-a">
                    <p>Open to participants worldwide, the Deities Design Awards invites entries from jewellery designers, accessory designers, artists, artisans, craftspeople, design studios, jewellery brands, manufacturers, students, educational institutions and creative professionals from allied disciplines. The awards are open to anyone eligible under the competition guidelines whose work reflects excellence in spiritual, devotional and deity-inspired design.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-q">What types of jewellery can be submitted? <span class="faq-chev">+</span></button>
                <div class="faq-a">
                    <p>All entries must align with the theme and requirements of the respective competition and should draw inspiration from faith, devotion, spirituality, cultural heritage, temple traditions, sacred symbolism, deity adornment and related religious or ceremonial practices.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-q">Can I submit a design concept instead of a finished piece? <span class="faq-chev">+</span></button>
                <div class="faq-a">
                    <p>Yes. The competition begins with the submission of original design concepts, sketches, renderings or digital presentations. Following the judging process, selected designs will be required to be manufactured as finished jewellery pieces in accordance with the competition requirements and timelines.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-q">Can I submit more than one entry? <span class="faq-chev">+</span></button>
                <div class="faq-a">
                    <p>Yes. Multiple submissions are permitted, provided each entry is submitted separately and complies with the competition guidelines.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-q">How will entries be judged? <span class="faq-chev">+</span></button>
                <div class="faq-a">
                    <p>Entries will be evaluated on creativity, craftsmanship originality, cultural relevance, execution, innovation and alignment with the competition theme.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-q">What do winners receive? <span class="faq-chev">+</span></button>
                <div class="faq-a">
                    <p>Winners will receive industry recognition, awards, certificates and extensive media visibility across DDA&rsquo;s platforms and partner networks. In addition, winning creations will have the unique opportunity to be ceremonially offered to a globally renowned spiritual institution, becoming part of its sacred adornment traditions. Winners may also benefit from media coverage, recognition and promotional opportunities generated through the associated temple or spiritual centre, further enhancing the visibility and legacy of their work among devotees, cultural communities and the wider public.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-q">Will winning designs be manufactured? <span class="faq-chev">+</span></button>
                <div class="faq-a">
                    <p>Following the selection process, finalists will have the unique opportunity to collaborate with esteemed jewellery manufacturers to realise their designs as exceptional handcrafted creations destined for divine adornment.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-q">Can international participants enter? <span class="faq-chev">+</span></button>
                <div class="faq-a">
                    <p>Yes. DDA welcomes submissions from participants across India and internationally.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-q">Is my submission confidential? <span class="faq-chev">+</span></button>
                <div class="faq-a">
                    <p>All entries and submissions will remain confidential throughout the judging process. Shortlisted and winning entries may be publicly showcased with due credit to the creator.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-q">What if my design is not commercially feasible to manufacture? <span class="faq-chev">+</span></button>
                <div class="faq-a">
                    <p>Entries will be assessed on creativity, concept, craftsmanship, relevance and feasibility. Innovative concepts are encouraged.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-q">Are sponsorship opportunities available? <span class="faq-chev">+</span></button>
                <div class="faq-a">
                    <p>Yes. DDA offers a range of sponsorship and partnership opportunities for brands, manufacturers, gemstone companies, institutions and organisations from both within and beyond the jewellery industry.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-q">How can I attend the awards ceremony or gala? <span class="faq-chev">+</span></button>
                <div class="faq-a">
                    <p>Attendance details will be announced closer to the event and may be available through invitation, registration, sponsorship or partner participation.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-q">What makes DDA unique? <span class="faq-chev">+</span></button>
                <div class="faq-a">
                    <p>DDA is a first-of-its-kind platform celebrating devotion through design. By connecting exceptional craftsmanship with living spiritual traditions, the awards offer selected creations the rare opportunity to become part of the sacred adornment and cultural legacy of globally respected spiritual institutions.</p>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    (function () {
        document.querySelectorAll('.faq-q').forEach(function (button) {
            button.addEventListener('click', function () {
                var item = button.parentElement;
                var chev = button.querySelector('.faq-chev');

                // Close all other open items
                document.querySelectorAll('.faq-item').forEach(function (otherItem) {
                    if (otherItem !== item && otherItem.classList.contains('open')) {
                        otherItem.classList.remove('open');
                        otherItem.querySelector('.faq-chev').textContent = '+';
                        otherItem.querySelector('.faq-chev').style.transform = '';
                    }
                });

                // Toggle current item
                item.classList.toggle('open');
                if (item.classList.contains('open')) {
                    chev.textContent = '\u2212'; // − minus sign
                    chev.style.transform = 'rotate(180deg)';
                } else {
                    chev.textContent = '+';
                    chev.style.transform = '';
                }
            });
        });
    })();
</script>
@endpush