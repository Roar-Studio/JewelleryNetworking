{{-- resources/views/deitiesdesignawards/sections/submit.blade.php --}}

@extends('deitiesdesignawards.layouts.app')

@section('content')

<section class="page-hero-int">
    <div class="page-hero-int-content">
        <span class="page-hero-int-eyebrow">Submit Your Entry</span>
        <h1 class="page-hero-int-title">Begin your <span class="it">submission.</span></h1>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="submit-layout">

            {{-- Progress Sidebar --}}
            <aside class="submit-progress">
                <div class="submit-progress-title">Your Submission</div>
                <ul class="progress-steps">
                    <li class="prog-step active" data-step="1"><span class="prog-num">1</span><span class="prog-label">Participant Info</span></li>
                    <li class="prog-step" data-step="2"><span class="prog-num">2</span><span class="prog-label">Entry Details</span></li>
                    <li class="prog-step" data-step="3"><span class="prog-num">3</span><span class="prog-label">Image Upload</span></li>
                    <li class="prog-step" data-step="4"><span class="prog-num">4</span><span class="prog-label">Declaration</span></li>
                </ul>
                <div class="submit-sidebar-note">
                    <p>All submissions first enter preliminary screening before proceeding to final jury evaluation. Ensure all images are JPEG or PNG format.</p>
                    <p style="margin-top:.75rem">
                        <a href="{{ url('/deitiesdesignawards/participate#guidelines') }}" style="color:var(--gold,#b8922a);font-size:.8rem">View submission guidelines &#x2192;</a>
                    </p>
                </div>
            </aside>

            {{-- Form Area --}}
            <div class="submit-form-area">

                {{-- Step 1: Participant Info --}}
                <div class="sub-panel active" id="sub-panel-1">
                    <h3 class="sub-panel-title">Step 1 &#x2014; Participant Information</h3>
                    <p class="sub-panel-desc">Tell us about yourself or your organisation.</p>
                    <form id="form-step-1" novalidate>
                        <div class="form-grid">
                            <div class="form-field">
                                <label for="f-first">First Name <span class="req">*</span></label>
                                <input type="text" id="f-first" name="first_name" placeholder="Your first name" required>
                            </div>
                            <div class="form-field">
                                <label for="f-last">Last Name <span class="req">*</span></label>
                                <input type="text" id="f-last" name="last_name" placeholder="Your last name" required>
                            </div>
                            <div class="form-field full">
                                <label for="f-email">Email Address <span class="req">*</span></label>
                                <input type="email" id="f-email" name="email" placeholder="your@email.com" required>
                            </div>
                            <div class="form-field">
                                <label for="f-phone">Phone / WhatsApp</label>
                                <input type="tel" id="f-phone" name="phone" placeholder="+91 XXXXX XXXXX">
                            </div>
                            <div class="form-field">
                                <label for="f-city">City <span class="req">*</span></label>
                                <input type="text" id="f-city" name="city" placeholder="Mumbai" required>
                            </div>
                            <div class="form-field">
                                <label for="f-country">Country <span class="req">*</span></label>
                                <select id="f-country" name="country" required>
                                    <option value="">Select country</option>
                                    <option value="IN" selected>India</option>
                                    <option value="AE">UAE</option>
                                    <option value="US">United States</option>
                                    <option value="GB">United Kingdom</option>
                                    <option value="SG">Singapore</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-field full">
                                <label for="f-org">Organisation / Studio Name</label>
                                <input type="text" id="f-org" name="organisation" placeholder="Your brand or studio (if applicable)">
                            </div>
                            <div class="form-field full">
                                <label for="f-category">Participant Type <span class="req">*</span></label>
                                <select id="f-category" name="participant_type" required>
                                    <option value="">Select your category</option>
                                    <option value="designer">Designer / Studio</option>
                                    <option value="brand">Brand / Retailer</option>
                                    <option value="artisan">Artisan / Manufacturer</option>
                                    <option value="diamantaire">Diamantaire / Supplier</option>
                                    <option value="student">Student</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="button" class="btn-form-next" onclick="goStep(2)">Continue to Entry Details <span>&#x2192;</span></button>
                        </div>
                    </form>
                </div>

                {{-- Step 2: Entry Details --}}
                <div class="sub-panel" id="sub-panel-2">
                    <h3 class="sub-panel-title">Step 2 &#x2014; Entry Details</h3>
                    <p class="sub-panel-desc">Tell us about your entry.</p>
                    <form id="form-step-2" novalidate>
                        <div class="form-grid">
                            <div class="form-field full">
                                <label for="f-piece-name">Piece / Collection Name <span class="req">*</span></label>
                                <input type="text" id="f-piece-name" name="piece_name" placeholder="Name of the submitted piece or collection" required>
                            </div>
                            <div class="form-field full">
                                <label for="f-award-cat">Award Category <span class="req">*</span></label>
                                <select id="f-award-cat" name="award_category" required>
                                    <option value="">Select award category</option>
                                    <option value="designers-studios">Designers &amp; Studios</option>
                                    <option value="brands-retailers">Brands &amp; Retailers</option>
                                    <option value="artisans-manufacturers">Artisans &amp; Manufacturers</option>
                                    <option value="diamantaires-suppliers">Diamantaires &amp; Suppliers</option>
                                    <option value="student">Student Category</option>
                                </select>
                            </div>
                            <div class="form-field">
                                <label for="f-materials">Primary Materials <span class="req">*</span></label>
                                <input type="text" id="f-materials" name="materials" placeholder="e.g. 22k gold, rubies, enamel" required>
                            </div>
                            <div class="form-field">
                                <label for="f-year">Year Created <span class="req">*</span></label>
                                <select id="f-year" name="year" required>
                                    <option value="">Select year</option>
                                    <option value="2026">2026</option>
                                    <option value="2025">2025</option>
                                    <option value="2024">2024</option>
                                    <option value="2023">2023</option>
                                </select>
                            </div>
                            <div class="form-field full">
                                <label for="f-deity">Deity / Occasion / Sacred Purpose <span class="req">*</span></label>
                                <input type="text" id="f-deity" name="deity" placeholder="e.g. Temple adornment for Goddess Lakshmi / Navratri" required>
                            </div>
                            <div class="form-field full">
                                <label for="f-statement">Design Statement <span class="req">*</span> <span class="field-note">(150&#x2013;500 words)</span></label>
                                <textarea id="f-statement" name="statement" rows="8" placeholder="Describe the sacred inspiration behind your piece, the design intent, the materials and techniques used and its connection to devotion or heritage..." required minlength="150"></textarea>
                                <div class="char-count"><span id="stmt-count">0</span> / 500 words</div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="button" class="btn-form-prev" onclick="goStep(1)"><span>&#x2190;</span> Back</button>
                            <button type="button" class="btn-form-next" onclick="goStep(3)">Continue to Images <span>&#x2192;</span></button>
                        </div>
                    </form>
                </div>

                {{-- Step 3: Image Upload --}}
                <div class="sub-panel" id="sub-panel-3">
                    <h3 class="sub-panel-title">Step 3 &#x2014; Image Upload</h3>
                    <p class="sub-panel-desc">Upload 1&#x2013;10 images of your entry. JPEG or PNG only. Maximum 25 MB per image.</p>

                    <div class="upload-zone" id="upload-zone">
                        <input type="file" id="file-input" accept="image/jpeg,image/png" multiple>
                        <div class="upload-zone-inner">
                            <div class="upload-icon">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                    <polyline points="17 8 12 3 7 8"/>
                                    <line x1="12" y1="3" x2="12" y2="15"/>
                                </svg>
                            </div>
                            <p class="upload-primary">Drag &amp; drop your images here</p>
                            <p class="upload-secondary">or <button type="button" class="upload-browse" onclick="document.getElementById('file-input').click()">browse files</button></p>
                            <p class="upload-hint">JPEG or PNG &bull; Max 25 MB each &bull; Up to 10 images</p>
                        </div>
                    </div>

                    <div class="upload-count" id="upload-count" style="display:none"><span id="count-num">0</span> image(s) selected</div>
                    <div class="upload-error" id="upload-error" style="display:none"></div>
                    <div class="preview-grid" id="preview-grid"></div>

                    <div class="form-actions" style="margin-top:2rem">
                        <button type="button" class="btn-form-prev" onclick="goStep(2)"><span>&#x2190;</span> Back</button>
                        <button type="button" class="btn-form-next" id="btn-to-step-4" onclick="goStep(4)">Continue to Declaration <span>&#x2192;</span></button>
                    </div>
                </div>

                {{-- Step 4: Declaration --}}
                <div class="sub-panel" id="sub-panel-4">
                    <h3 class="sub-panel-title">Step 4 &#x2014; Declaration &amp; Submit</h3>
                    <p class="sub-panel-desc">Please read and confirm the following declarations before submitting your entry.</p>
                    <form id="form-step-4" novalidate>
                        <div class="declaration-block">
                            <div class="check-row">
                                <input type="checkbox" id="decl-1" required>
                                <label for="decl-1">I confirm that the submitted work is my original creation and I hold the rights to enter it in this competition.</label>
                            </div>
                            <div class="check-row">
                                <input type="checkbox" id="decl-2" required>
                                <label for="decl-2">I confirm that the submitted piece was created with sincere devotional, sacred or spiritual intent.</label>
                            </div>
                            <div class="check-row">
                                <input type="checkbox" id="decl-3" required>
                                <label for="decl-3">I confirm that all information provided in this submission is accurate and complete.</label>
                            </div>
                            <div class="check-row">
                                <input type="checkbox" id="decl-4" required>
                                <label for="decl-4">I grant Deities Design Awards the right to use submitted images for promotional, editorial and archival purposes with attribution.</label>
                            </div>
                            <div class="check-row">
                                <input type="checkbox" id="decl-5" required>
                                <label for="decl-5">I have read and agree to the <a href="{{ url('/deitiesdesignawards/terms') }}" target="_blank" style="color:var(--gold,#b8922a)">Terms &amp; Conditions</a> and <a href="{{ url('/deitiesdesignawards/privacy') }}" target="_blank" style="color:var(--gold,#b8922a)">Privacy Policy</a>.</label>
                            </div>
                        </div>

                        <div class="submission-fee-note">
                            <span class="sfn-label">Submission Fee</span>
                            <p>The applicable fee will be displayed upon proceeding. Fees are non-refundable once your entry has entered preliminary screening.</p>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn-form-prev" onclick="goStep(3)"><span>&#x2190;</span> Back</button>
                            <button type="submit" class="btn-form-next" id="btn-submit-final">Submit Entry <span>&#x2192;</span></button>
                        </div>

                        <div class="submit-success" id="submit-success" style="display:none">
                            <div class="success-icon"></div>
                            <h4>Submission Received</h4>
                            <p>Thank you for entering the Deities Design Awards. You will receive a confirmation email at the address provided. Your entry reference number is <strong id="ref-num"></strong>.</p>
                            <a href="{{ url('/deitiesdesignawards') }}" style="color:var(--gold,#b8922a);font-size:.85rem">Return to Homepage &#x2192;</a>
                        </div>
                    </form>
                </div>

            </div>{{-- /.submit-form-area --}}
        </div>{{-- /.submit-layout --}}
    </div>{{-- /.container --}}
</section>

@endsection

@push('scripts')
<script>
(function () {

    // ── Step navigation ───────────────────────────────────────────────────────
    function goStep(n) {
        document.querySelectorAll('.sub-panel').forEach(function (p) {
            p.classList.remove('active');
        });
        document.querySelectorAll('.prog-step').forEach(function (s) {
            s.classList.remove('active', 'done');
        });

        document.getElementById('sub-panel-' + n).classList.add('active');

        document.querySelectorAll('.prog-step').forEach(function (s) {
            var sn = parseInt(s.dataset.step);
            if (sn < n) s.classList.add('done');
            if (sn === n) s.classList.add('active');
        });

        var layout = document.querySelector('.submit-layout');
        if (layout) {
            window.scrollTo({ top: layout.offsetTop - 80, behavior: 'smooth' });
        }
    }

    // Expose to global scope for inline onclick attributes
    window.goStep = goStep;

    // ── File upload ───────────────────────────────────────────────────────────
    var zone     = document.getElementById('upload-zone');
    var fi       = document.getElementById('file-input');
    var grid     = document.getElementById('preview-grid');
    var countEl  = document.getElementById('upload-count');
    var cntNum   = document.getElementById('count-num');
    var errEl    = document.getElementById('upload-error');
    var files    = [];

    function validateAndPreview(newFiles) {
        errEl.style.display = 'none';
        var valid = [], errs = [];

        Array.from(newFiles).forEach(function (f) {
            if (!['image/jpeg', 'image/png'].includes(f.type)) {
                errs.push(f.name + ': not JPEG or PNG');
                return;
            }
            if (f.size > 25 * 1024 * 1024) {
                errs.push(f.name + ': exceeds 25 MB limit');
                return;
            }
            valid.push(f);
        });

        if (files.length + valid.length > 10) {
            errs.push('Maximum 10 images allowed.');
            valid.splice(0, Math.max(0, files.length + valid.length - 10));
        }

        files = files.concat(valid);

        if (errs.length) {
            errEl.textContent = errs.join(' | ');
            errEl.style.display = 'block';
        }

        renderPreviews();
    }

    function renderPreviews() {
        grid.innerHTML = '';

        files.forEach(function (f, i) {
            var rd = new FileReader();
            rd.onload = function (e) {
                var d = document.createElement('div');
                d.className = 'preview-thumb';
                d.innerHTML = '<img src="' + e.target.result + '" alt="Preview ' + i + '">'
                            + '<button class="preview-remove" data-idx="' + i + '" title="Remove">&times;</button>';
                grid.appendChild(d);
            };
            rd.readAsDataURL(f);
        });

        cntNum.textContent    = files.length;
        countEl.style.display = files.length ? 'block' : 'none';
        grid.style.display    = files.length ? 'grid'  : 'none';
    }

    // Remove image on click
    grid.addEventListener('click', function (e) {
        if (e.target.classList.contains('preview-remove')) {
            files.splice(parseInt(e.target.dataset.idx), 1);
            renderPreviews();
        }
    });

    // Drag & drop
    zone.addEventListener('dragover', function (e) {
        e.preventDefault();
        zone.classList.add('drag-over');
    });
    zone.addEventListener('dragleave', function () {
        zone.classList.remove('drag-over');
    });
    zone.addEventListener('drop', function (e) {
        e.preventDefault();
        zone.classList.remove('drag-over');
        validateAndPreview(e.dataTransfer.files);
    });

    // File input change
    fi.addEventListener('change', function () {
        validateAndPreview(fi.files);
        fi.value = '';
    });

    // ── Word counter ──────────────────────────────────────────────────────────
    var ta = document.getElementById('f-statement');
    var wc = document.getElementById('stmt-count');
    if (ta && wc) {
        ta.addEventListener('input', function () {
            var words = ta.value.trim().split(/\s+/).filter(Boolean).length;
            wc.textContent = words;
        });
    }

    // ── Final submit ──────────────────────────────────────────────────────────
    var formStep4 = document.getElementById('form-step-4');
    if (formStep4) {
        formStep4.addEventListener('submit', function (e) {
            e.preventDefault();

            var allChecked = Array.from(
                document.querySelectorAll('.check-row input')
            ).every(function (c) { return c.checked; });

            if (!allChecked) {
                alert('Please confirm all declarations before submitting.');
                return;
            }

            var ref = 'DDA-' + Date.now().toString(36).toUpperCase();
            document.getElementById('ref-num').textContent = ref;
            formStep4.style.display = 'none';
            document.getElementById('submit-success').style.display = 'block';
        });
    }

})();
</script>
@endpush