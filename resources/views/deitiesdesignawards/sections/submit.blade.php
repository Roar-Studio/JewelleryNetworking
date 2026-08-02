<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Entry — Deities Design Awards</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Aboreto&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;1,300;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dda-assets/css/dda.css') }}">
</head>

<body>
    <div id="evil-eye-cursor" class="evil-eye-cursor"></div>
    <div class="announce">Inaugural Edition | 2026 <span class="pipe">|</span> Registration opens soon <span
            class="pipe">|</span> <a href="{{ url('/deitiesdesignawards/contact') }}">Be notified →</a></div>
    <nav>
        <a href="{{ url('/deitiesdesignawards') }}" class="nav-logo"><img
                src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards"></a>
        <div class="nav-links">
            <a href="{{ url('/deitiesdesignawards') }}" class="nav-link">Home</a>
            <div class="has-dropdown">
                <a class="nav-link">Categories <span class="chev">&#x25BC;</span></a>
                <div class="dropdown">
                    <span class="dropdown-label">Deities Category</span>
                    <a href="{{ url('/deitiesdesignawards/design-category') }}#nitai">Nitai</a>
                    <a href="{{ url('/deitiesdesignawards/design-category') }}#gaur">Gaur</a>
                    <a href="{{ url('/deitiesdesignawards/design-category') }}#lalita">Lalita</a>
                    <a href="{{ url('/deitiesdesignawards/design-category') }}#radharani-radha">Radharani / Radha</a>
                    <a href="{{ url('/deitiesdesignawards/design-category') }}#gopinath-krishna">Gopinath / Krishna</a>
                    <a href="{{ url('/deitiesdesignawards/design-category') }}#vishakhadevi">Vishakhadevi</a>
                    <a href="{{ url('/deitiesdesignawards/design-category') }}#gopalji">Gopalji</a>
                </div>
            </div>
            <div class="has-dropdown">
                <a class="nav-link">Participate <span class="chev">&#x25BC;</span></a>
                <div class="dropdown">
                    <a href="{{ url('/deitiesdesignawards/participate') }}#how-to-enter">How to Enter</a>
                    <a href="{{ url('/deitiesdesignawards/participate') }}#guidelines">Submission Guidelines</a>
                    <a href="{{ url('/deitiesdesignawards/participate') }}#fees">Fees</a>
                    <a href="{{ url('/deitiesdesignawards/participate') }}#dates">Important Dates</a>
                    <a href="{{ url('/deitiesdesignawards/jury') }}#evaluation-criteria">Judging Criteria</a>
                </div>
            </div>
            <a href="{{ url('/deitiesdesignawards/inspiration') }}" class="nav-link">Inspiration</a>
            <div class="has-dropdown">
                <a class="nav-link">Partners <span class="chev">▼</span></a>
                <div class="dropdown">
                    <a href="{{ url('/deitiesdesignawards/partners') }}">Our Partners</a>
                    <a href="{{ url('/deitiesdesignawards/sponsor-us') }}">Be a Sponsor</a>
                </div>
            </div>
            <a href="{{ url('/deitiesdesignawards/about') }}" class="nav-link">About</a>
            <a href="{{ url('/deitiesdesignawards/contact') }}" class="nav-link">Contact</a>
        </div>
        <div class="nav-right">
            <button class="nav-icon" aria-label="Search"><svg width="18" height="18" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="11" cy="11" r="8" />
                    <path d="M21 21l-4.35-4.35" />
                </svg></button>
            <a href="{{ url('/deitiesdesignawards/submit') }}" class="nav-cta active">Register</a>
            <button class="mobile-menu-toggle" aria-label="Toggle Menu"><span class="bar"></span><span
                    class="bar"></span><span class="bar"></span></button>
        </div>
    </nav>
    <div class="mobile-menu-drawer">
        <div class="mobile-menu-logo"><img src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}"
                alt="Deities Design Awards"></div>
        <div class="mobile-menu-links">
            <a href="{{ url('/deitiesdesignawards') }}" class="mob-link">Home</a>
            <div class="mob-dropdown">
                <button class="mob-dropdown-toggle">Categories<span class="chev">&#x25BC;</span></button>
                <div class="mob-dropdown-menu">
                    <span class="dropdown-label">Deities Category</span>
                    <a href="{{ url('/deitiesdesignawards/design-category') }}#nitai">Nitai</a>
                    <a href="{{ url('/deitiesdesignawards/design-category') }}#gaur">Gaur</a>
                    <a href="{{ url('/deitiesdesignawards/design-category') }}#lalita">Lalita</a>
                    <a href="{{ url('/deitiesdesignawards/design-category') }}#radharani-radha">Radharani / Radha</a>
                    <a href="{{ url('/deitiesdesignawards/design-category') }}#gopinath-krishna">Gopinath / Krishna</a>
                    <a href="{{ url('/deitiesdesignawards/design-category') }}#vishakhadevi">Vishakhadevi</a>
                    <a href="{{ url('/deitiesdesignawards/design-category') }}#gopalji">Gopalji</a>
                </div>
            </div>
            <div class="mob-dropdown">
                <button class="mob-dropdown-toggle">Participate <span class="chev">&#x25BC;</span></button>
                <div class="mob-dropdown-menu">
                    <a href="{{ url('/deitiesdesignawards/participate') }}#how-to-enter">How to Enter</a>
                    <a href="{{ url('/deitiesdesignawards/participate') }}#guidelines">Submission Guidelines</a>
                    <a href="{{ url('/deitiesdesignawards/participate') }}#fees">Fees</a>
                    <a href="{{ url('/deitiesdesignawards/participate') }}#dates">Important Dates</a>
                    <a href="{{ url('/deitiesdesignawards/jury') }}#evaluation-criteria">Judging Criteria</a>
                </div>
            </div>
            <a href="{{ url('/deitiesdesignawards/inspiration') }}" class="mob-link">Inspiration</a>
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

    <section class="page-hero-int wash-gold"
        style="
        background-image: url('https://deities-design-awards-assets.s3.ap-south-1.amazonaws.com/DDA+Web+Images/SUBMITION+PAGE.PNG');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    ">
        <div class="page-hero-int-content">
            <span class="page-hero-int-eyebrow">Submit Your Entry</span>
            <h1 class="page-hero-int-title">Begin your submission.</h1>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="submit-layout">

                <aside class="submit-progress">
                    <div class="submit-progress-title">Your Submission</div>
                    <ul class="progress-steps">
                        <li class="prog-step active" data-step="1"><span class="prog-num">1</span><span
                                class="prog-label">Participant Info</span></li>
                        <li class="prog-step" data-step="2"><span class="prog-num">2</span><span
                                class="prog-label">Deity Category Entries</span></li>
                        <li class="prog-step" data-step="3"><span class="prog-num">3</span><span
                                class="prog-label">Declaration</span></li>
                    </ul>
                    <div class="submit-sidebar-note">
                        <p>All submissions first enter preliminary screening before proceeding to final jury evaluation.
                            Ensure all images are JPEG or PNG format.</p>
                        <p style="margin-top:.75rem"><a
                                href="{{ url('/deitiesdesignawards/participate') }}#guidelines"
                                style="color:var(--gold,#b8922a);font-size:.8rem">View submission guidelines
                                &#x2192;</a></p>
                    </div>
                </aside>

                <div class="submit-form-area">

                    <form id="ddaSubmissionForm" method="POST" action="{{ route('dda.submit') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Step 1: Participant Info -->
                        <div class="sub-panel active" id="sub-panel-1">
                            <h3 class="sub-panel-title">Step 1 &#x2014; Participant Information</h3>
                            <p class="sub-panel-desc">Tell us about yourself or your organisation.</p>
                            <div class="form-grid">
                                <div class="form-field">
                                    <label for="f-first">First Name <span class="req">*</span></label>
                                    <input type="text" id="f-first" name="first_name"
                                        value="{{ old('first_name', Auth::guard('customer')->user()?->first_name) }}"
                                        placeholder="Your first name" required>
                                    @error('first_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-field">
                                    <label for="f-last">Last Name <span class="req">*</span></label>
                                    <input type="text" id="f-last" name="last_name"
                                        value="{{ old('last_name', Auth::guard('customer')->user()?->last_name) }}"
                                        placeholder="Your last name" required>
                                    @error('last_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-field full">
                                    <label for="f-email">Email Address <span class="req">*</span></label>
                                    <input type="email" id="f-email" name="email"
                                        value="{{ old('email', Auth::guard('customer')->user()?->email) }}"
                                        placeholder="your@email.com" required>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-field">
                                    <label for="f-phone">Phone / WhatsApp</label>
                                    <input type="tel" id="f-phone" name="phone"
                                        value="{{ old('phone', Auth::guard('customer')->user()?->mobile_no) }}"
                                        placeholder="+91 XXXXX XXXXX">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-field">
                                    <label for="f-city">City <span class="req">*</span></label>
                                    <input type="text" id="f-city" name="city" value="{{ old('city') }}"
                                        placeholder="Mumbai" required>
                                    @error('city')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-field">
                                    <label for="f-country">Country <span class="req">*</span></label>
                                    <select id="f-country" name="country" required>
                                        <option value="">Select country</option>
                                        <option value="IN" {{ old('country', 'IN') == 'IN' ? 'selected' : '' }}>
                                            India</option>
                                        <option value="AE" {{ old('country') == 'AE' ? 'selected' : '' }}>UAE
                                        </option>
                                        <option value="US" {{ old('country') == 'US' ? 'selected' : '' }}>United
                                            States</option>
                                        <option value="GB" {{ old('country') == 'GB' ? 'selected' : '' }}>United
                                            Kingdom</option>
                                        <option value="SG" {{ old('country') == 'SG' ? 'selected' : '' }}>
                                            Singapore</option>
                                        <option value="other" {{ old('country') == 'other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                    @error('country')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-field full">
                                    <label for="f-org">Organisation / Studio Name</label>
                                    <input type="text" id="f-org" name="organisation"
                                        value="{{ old('organisation') }}"
                                        placeholder="Your brand or studio (if applicable)">
                                    @error('organisation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-field full">
                                    <label for="f-category">
                                        Participant Type
                                        <span class="req">*</span>
                                    </label>

                                    <select id="f-category" name="participant_type" required>

                                        <option value="">Select your category</option>

                                        <option value="designer"
                                            {{ old('participant_type') == 'designer' ? 'selected' : '' }}>
                                            Designer / Studio
                                        </option>

                                        <option value="brand"
                                            {{ old('participant_type') == 'brand' ? 'selected' : '' }}>
                                            Brand / Retailer
                                        </option>

                                        <option value="artisan"
                                            {{ old('participant_type') == 'artisan' ? 'selected' : '' }}>
                                            Artisan / Manufacturer
                                        </option>

                                        <option value="diamantaire"
                                            {{ old('participant_type') == 'diamantaire' ? 'selected' : '' }}>
                                            Diamantaire / Supplier
                                        </option>

                                        <option value="student"
                                            {{ old('participant_type') == 'student' ? 'selected' : '' }}>
                                            Student
                                        </option>

                                        <option value="other"
                                            {{ old('participant_type') == 'other' ? 'selected' : '' }}>
                                            Other
                                        </option>

                                    </select>

                                    @error('participant_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-field full" id="participant-type-other"
                                    style="{{ old('participant_type') == 'other' ? '' : 'display:none;' }}">

                                    <label for="participant_type_other">
                                        Please specify
                                        <span class="req">*</span>
                                    </label>

                                    <input type="text" id="participant_type_other" name="participant_type_other"
                                        value="{{ old('participant_type_other') }}"
                                        placeholder="Enter your participant type">

                                    @error('participant_type_other')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="button" class="btn-form-next"
                                    onclick="if(validateStep(1)) goStep(2)">Continue to Entry Details
                                    <span>&#x2192;</span></button>
                            </div>
                        </div>

                        <!-- Step 2: Deity Category Entries -->
                        <div class="sub-panel" id="sub-panel-2">
                            <h3 class="sub-panel-title">Step 2 &#x2014; Deity Category Entries</h3>
                            <p class="sub-panel-desc">You may enter up to <strong>two Deity Categories</strong>: one
                                from Radharani&#8202;/&#8202;Radha or Gopinath&#8202;/&#8202;Krishna, and one from
                                Nitai, Gaur, Lalita, Vishakhadevi or Gopalji. For each, select the deity, the jewellery
                                piece from that deity&#8217;s category, describe your piece and upload your images.</p>

                            <!-- Entry 1 -->
                            <div class="entry-block" data-entry="a">
                                <div class="entry-block-head">
                                    <span class="entry-block-num">Entry 1</span>
                                    <h4>Radharani&#8202;/&#8202;Radha or Gopinath&#8202;/&#8202;Krishna</h4>
                                </div>
                                <div class="form-grid">
                                    <div class="form-field full">
                                        <label for="f-deity-a">Deity Category <span class="req">*</span></label>
                                        <select id="f-deity-a" name="deity_category_a" class="deity-select" required>
                                            <option value="">Select deity category</option>
                                            <option value="radharani-radha"
                                                {{ old('deity_category_a') == 'radharani-radha' ? 'selected' : '' }}>
                                                Radharani / Radha</option>
                                            <option value="gopinath-krishna"
                                                {{ old('deity_category_a') == 'gopinath-krishna' ? 'selected' : '' }}>
                                                Gopinath / Krishna</option>
                                        </select>
                                        @error('deity_category_a')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-field full">
                                        <label for="f-piece-a">Jewellery Piece <span class="req">*</span></label>
                                        <select id="f-piece-a" name="jewellery_piece_a" class="piece-select" required
                                            disabled data-old="{{ old('jewellery_piece_a') }}">
                                            <option value="">Select deity category first</option>
                                        </select>
                                        @error('jewellery_piece_a')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-field full">
                                        <label for="f-material-a">Primary Material <span
                                                class="req">*</span></label>
                                        <input type="text" id="f-material-a" name="material_a"
                                            value="{{ old('material_a') }}" placeholder="e.g. 22k gold, silver"
                                            required>
                                        @error('material_a')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-field full">
                                        <label for="f-statement-a">Design Statement <span class="req">*</span>
                                            <span class="field-note">(150&#x2013;500 words)</span></label>
                                        <textarea id="f-statement-a" name="statement_a" rows="6" class="stmt-input"
                                            placeholder="Describe the sacred inspiration behind your piece, the design intent, the materials and techniques used and its connection to devotion or heritage..."
                                            required minlength="150">{{ old('statement_a') }}</textarea>
                                        <div class="char-count"><span class="stmt-count">0</span> / 500 words</div>
                                        @error('statement_a')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="entry-upload-label">Upload Images <span class="req">*</span></div>
                                <p class="sub-panel-desc" style="margin-top:-1rem">Upload 1&#x2013;10 images of this
                                    entry. JPEG or PNG only. Maximum 25 MB per image.</p>
                                <p style="margin:10px 0 15px;color:#b22222;font-weight:700;font-size:15px;">
                                    <strong>Note:</strong> All submitted images must be photographed or presented
                                    against a plain <strong>white or black background only</strong>. Images with
                                    coloured, textured, or distracting backgrounds may not be considered during the
                                    evaluation process.
                                </p>
                                <div class="upload-zone" id="upload-zone-a">
                                    <input type="file" class="file-input" id="file-input-a" name="images_a[]"
                                        accept="image/jpeg,image/png" multiple>
                                    <div class="upload-zone-inner">
                                        <div class="upload-icon">
                                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="1">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                                <polyline points="17 8 12 3 7 8" />
                                                <line x1="12" y1="3" x2="12" y2="15" />
                                            </svg>
                                        </div>
                                        <p class="upload-primary">Drag &amp; drop your images here</p>
                                        <p class="upload-secondary">or <button type="button" class="upload-browse"
                                                onclick="document.getElementById('file-input-a').click()">browse
                                                files</button></p>
                                        <p class="upload-hint">JPEG or PNG &bull; Max 25 MB each &bull; Up to 10 images
                                        </p>
                                    </div>
                                </div>
                                <div class="upload-count" id="upload-count-a" style="display:none"><span
                                        class="count-num">0</span> image(s) selected</div>
                                <div class="upload-error" id="upload-error-a" style="display:none"></div>
                                <div class="preview-grid" id="preview-grid-a"></div>
                                @error('images_a')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @error('images_a.*')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Entry 2 -->
                            <div class="entry-block" data-entry="b">
                                <div class="entry-block-head">
                                    <span class="entry-block-num">Entry 2</span>
                                    <h4>Nitai, Gaur, Lalita, Vishakhadevi or Gopalji</h4>
                                </div>
                                <div class="form-grid">
                                    <div class="form-field full">
                                        <label for="f-deity-b">Deity Category <span class="req">*</span></label>
                                        <select id="f-deity-b" name="deity_category_b" class="deity-select" required>
                                            <option value="">Select deity category</option>
                                            <option value="nitai"
                                                {{ old('deity_category_b') == 'nitai' ? 'selected' : '' }}>Nitai
                                            </option>
                                            <option value="gaur"
                                                {{ old('deity_category_b') == 'gaur' ? 'selected' : '' }}>Gaur</option>
                                            <option value="lalita"
                                                {{ old('deity_category_b') == 'lalita' ? 'selected' : '' }}>Lalita
                                            </option>
                                            <option value="vishakhadevi"
                                                {{ old('deity_category_b') == 'vishakhadevi' ? 'selected' : '' }}>
                                                Vishakhadevi</option>
                                            <option value="gopalji"
                                                {{ old('deity_category_b') == 'gopalji' ? 'selected' : '' }}>Gopalji
                                            </option>
                                        </select>
                                        @error('deity_category_b')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-field full">
                                        <label for="f-piece-b">Jewellery Piece <span class="req">*</span></label>
                                        <select id="f-piece-b" name="jewellery_piece_b" class="piece-select" required
                                            disabled data-old="{{ old('jewellery_piece_b') }}">
                                            <option value="">Select deity category first</option>
                                        </select>
                                        @error('jewellery_piece_b')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-field full">
                                        <label for="f-material-b">Primary Material <span
                                                class="req">*</span></label>
                                        <input type="text" id="f-material-b" name="material_b"
                                            value="{{ old('material_b') }}"
                                            placeholder="e.g. 22k gold, rubies, enamel" required>
                                        @error('material_b')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-field full">
                                        <label for="f-statement-b">Design Statement <span class="req">*</span>
                                            <span class="field-note">(150&#x2013;500 words)</span></label>
                                        <textarea id="f-statement-b" name="statement_b" rows="6" class="stmt-input"
                                            placeholder="Describe the sacred inspiration behind your piece, the design intent, the materials and techniques used and its connection to devotion or heritage..."
                                            required minlength="150">{{ old('statement_b') }}</textarea>
                                        <div class="char-count"><span class="stmt-count">0</span> / 500 words</div>
                                        @error('statement_b')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="entry-upload-label">Upload Images <span class="req">*</span></div>
                                <p class="sub-panel-desc" style="margin-top:-1rem">Upload 1&#x2013;10 images of this
                                    entry. JPEG or PNG only. Maximum 25 MB per image.</p>
                                <p style="margin:10px 0 15px;color:#b22222;font-weight:700;font-size:15px;">
                                    <strong>Note:</strong> All submitted images must be photographed or presented
                                    against a plain <strong>white or black background only</strong>. Images with
                                    coloured, textured, or distracting backgrounds may not be considered during the
                                    evaluation process.
                                </p>
                                <div class="upload-zone" id="upload-zone-b">
                                    <input type="file" class="file-input" id="file-input-b" name="images_b[]"
                                        accept="image/jpeg,image/png" multiple>
                                    <div class="upload-zone-inner">
                                        <div class="upload-icon">
                                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="1">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                                <polyline points="17 8 12 3 7 8" />
                                                <line x1="12" y1="3" x2="12" y2="15" />
                                            </svg>
                                        </div>
                                        <p class="upload-primary">Drag &amp; drop your images here</p>
                                        <p class="upload-secondary">or <button type="button" class="upload-browse"
                                                onclick="document.getElementById('file-input-b').click()">browse
                                                files</button></p>
                                        <p class="upload-hint">JPEG or PNG &bull; Max 25 MB each &bull; Up to 10 images
                                        </p>
                                    </div>
                                </div>
                                <div class="upload-count" id="upload-count-b" style="display:none"><span
                                        class="count-num">0</span> image(s) selected</div>
                                <div class="upload-error" id="upload-error-b" style="display:none"></div>
                                <div class="preview-grid" id="preview-grid-b"></div>
                                @error('images_b')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @error('images_b.*')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-actions">
                                <button type="button" class="btn-form-prev"
                                    onclick="goStep(1)"><span>&#x2190;</span> Back</button>
                                <button type="button" class="btn-form-next"
                                    onclick="if(validateStep(2)) goStep(3)">Continue to Declaration
                                    <span>&#x2192;</span></button>
                            </div>
                        </div>

                        <!-- Step 3: Declaration -->
                        <div class="sub-panel" id="sub-panel-3">
                            <h3 class="sub-panel-title">Step 3 &#x2014; Declaration &amp; Submit</h3>
                            <p class="sub-panel-desc">Please read and confirm the following declarations before
                                submitting your entry.</p>
                            <div class="declaration-block">
                                <p>I confirm that the submitted work is my original creation and I hold the rights to
                                    enter it in this competition.</p>
                                <p>I confirm that the submitted piece was created with sincere devotional, sacred or
                                    spiritual intent.</p>
                                <p>I confirm that all information provided in this submission is accurate and complete.
                                </p>
                                <p>I grant Deities Design Awards the right to use submitted images for promotional,
                                    editorial and archival purposes with attribution.</p>
                                <div class="check-row">
                                    <input type="checkbox" id="declaration" name="declaration" value="1"
                                        required {{ old('declaration') ? 'checked' : '' }}>
                                    <label for="declaration">I confirm and agree to all of the above declarations, and
                                        I have read and agree to the <a
                                            href="{{ url('/deitiesdesignawards/terms') }}" target="_blank"
                                            style="color:var(--gold,#b8922a)">Terms &amp; Conditions</a> and <a
                                            href="{{ url('/deitiesdesignawards/privacy') }}" target="_blank"
                                            style="color:var(--gold,#b8922a)">Privacy Policy</a>.</label>
                                </div>
                                @error('declaration')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="submission-fee-note">
                                <span class="sfn-label">Submission Fee</span>
                                <p>The applicable fee will be displayed upon proceeding. Fees are non-refundable once
                                    your entry has entered preliminary screening.</p>
                            </div>

                            <div class="form-actions">
                                <button type="button" class="btn-form-prev"
                                    onclick="goStep(2)"><span>&#x2190;</span> Back</button>
                                <button type="submit" class="btn-form-next" id="btn-submit-final">Submit Entry
                                    <span>&#x2192;</span></button>
                            </div>

                            <div class="submit-success" id="submit-success" style="display:none">
                                <div class="success-icon"></div>
                                <h4>Submission Received</h4>
                                <p>Thank you for entering the Deities Design Awards. You will receive a confirmation
                                    email at the address provided. Your entry reference number is <strong
                                        id="ref-num"></strong>.</p>
                                <a href="{{ url('/deitiesdesignawards') }}"
                                    style="color:var(--gold,#b8922a);font-size:.85rem">Return to Homepage &#x2192;</a>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="footer-top">
            <div class="footer-brand">
                <img src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards">
                <div class="footer-socials">
                    <a href="https://www.instagram.com/deitiesdesignawards" target="_blank" rel="noopener"
                        class="footer-social" aria-label="Instagram"><svg width="16" height="16"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="3" width="18" height="18" rx="4" />
                            <circle cx="12" cy="12" r="4" />
                            <circle cx="17.5" cy="6.5" r="1" fill="currentColor" />
                        </svg></a>
                    <a href="https://www.facebook.com/profile.php?id=61578502570613" target="_blank" rel="noopener"
                        class="footer-social" aria-label="Facebook"><svg width="16" height="16"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M14 8h-2a2 2 0 0 0-2 2v2H8v3h2v7h3v-7h2.5l.5-3H13v-1.5c0-.5.5-1 1-1h2V8z" />
                        </svg></a>
                    <a href="https://www.youtube.com/@DeitiesDesignAwards" target="_blank" rel="noopener"
                        class="footer-social" aria-label="YouTube"><svg width="16" height="16"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="6" width="18" height="12" rx="3" />
                            <path d="M10 9.75v4.5L15 12l-5-2.25z" fill="currentColor" stroke="none" />
                        </svg></a>
                </div>
            </div>
            <div class="footer-col">
                <h5>Explore</h5>
                <ul>
                    <li><a href="{{ url('/deitiesdesignawards/about') }}">About DDA</a></li>
                    <li><a href="{{ url('/deitiesdesignawards/design-category') }}">Design Categories</a></li>
                    <li><a href="{{ url('/deitiesdesignawards/inspiration') }}">Inspiration</a></li>
                    <li><a href="{{ url('/deitiesdesignawards/participate') }}#dates">Calendar</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h5>Participate</h5>
                <ul>
                    <li><a href="{{ url('/deitiesdesignawards/participate') }}#how-to-enter">How to Enter</a></li>
                    <li><a href="{{ url('/deitiesdesignawards/participate') }}#fees">Fees</a></li>
                    <li><a href="{{ url('/deitiesdesignawards/participate') }}#guidelines">Guidelines</a></li>
                    <li><a href="{{ url('/deitiesdesignawards/faq') }}">FAQ</a></li>
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
            <span>&#169; 2026 Deities Design Awards &#183; All Rights Reserved</span>
            <span><a href="{{ url('/deitiesdesignawards/terms') }}">Terms</a><a
                    href="{{ url('/deitiesdesignawards/privacy') }}">Privacy</a></span>
        </div>
    </footer>
    <script>
        const tb = document.querySelector('.mobile-menu-toggle'),
            dr = document.querySelector('.mobile-menu-drawer');
        tb.addEventListener('click', () => {
            tb.classList.toggle('active');
            dr.classList.toggle('active');
            document.body.classList.toggle('no-scroll');
        });
        document.addEventListener('click', e => {
            if (!dr.contains(e.target) && !tb.contains(e.target) && dr.classList.contains('active')) {
                tb.classList.remove('active');
                dr.classList.remove('active');
                document.body.classList.remove('no-scroll');
            }
        });
        document.querySelectorAll('.mobile-menu-links > a.mob-link, .mob-dropdown-menu a').forEach(l => l.addEventListener(
            'click', () => {
                tb.classList.remove('active');
                dr.classList.remove('active');
                document.body.classList.remove('no-scroll');
            }));
        document.querySelectorAll('.mob-dropdown-toggle').forEach(t => {
            t.addEventListener('click', e => {
                e.stopPropagation();
                const m = t.nextElementSibling,
                    c = t.querySelector('.chev');
                document.querySelectorAll('.mob-dropdown-toggle').forEach(o => {
                    if (o !== t) {
                        o.nextElementSibling.classList.remove('open');
                        o.querySelector('.chev').classList.remove('rotate');
                    }
                });
                m.classList.toggle('open');
                c.classList.toggle('rotate');
            });
        });
        // Step navigation
        let highestStepReached = 1;

        function validateStep(step) {

            const panel = document.getElementById('sub-panel-' + step);

            const fields = panel.querySelectorAll(
                'input, textarea, select'
            );

            for (const field of fields) {

                if (!field.checkValidity()) {

                    field.reportValidity();

                    return false;

                }

            }

            return true;

        }

        function goStep(n) {
            if (n > highestStepReached) highestStepReached = n;
            document.querySelectorAll('.sub-panel').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.prog-step').forEach(s => s.classList.remove('active', 'done'));
            document.getElementById('sub-panel-' + n).classList.add('active');
            document.querySelectorAll('.prog-step').forEach(s => {
                const sn = parseInt(s.dataset.step);
                if (sn < n) s.classList.add('done');
                if (sn === n) s.classList.add('active');
            });
            window.scrollTo({
                top: document.querySelector('.submit-layout').offsetTop - 80,
                behavior: 'smooth'
            });
        }

        // Clicking a step in the sidebar jumps to it (only steps already reached)
        document.querySelectorAll('.prog-step').forEach(s => {
            s.addEventListener('click', () => {
                const sn = parseInt(s.dataset.step);
                if (sn <= highestStepReached) goStep(sn);
            });
        });

        // Jewellery pieces available per deity (matches design-category.html)
        const JEWELLERY_PIECES = {
            'nitai': ['Jhumka Earrings', 'Choker', 'Necklace 1', 'Necklace 2', 'Bracelet', 'Bangle', 'Waistbelt',
                'Payal'
            ],
            'gaur': ['Jhumka Earrings', 'Long Earrings', 'Choker', 'Necklace 1', 'Necklace 2', 'Bracelet', 'Bangle',
                'Waistbelt', 'Payal'
            ],
            'lalita': ['Paisley', 'Maangtikha', 'Damini / Mathapatti', 'Earrings', 'Nosering', 'Bangle', 'Choker',
                'Necklace 1', 'Necklace 2', 'Necklace 3', 'Waistbelt', 'Payal', 'Rings'
            ],
            'radharani-radha': ['Paisley', 'Damini / Mathapatti', 'Choker', 'Necklace 1', 'Necklace 2', 'Necklace 3',
                'Waistbelt with Long Latkan', 'Bangle', 'Bracelet', 'Payal', 'Rings', 'Jhumka Earrings'
            ],
            'gopinath-krishna': ['Long Earrings', 'Choker', 'Mala', 'Waistbelt', 'Payal', 'Bracelet', 'Flute'],
            'vishakhadevi': ['Paisley', 'Maangtikha', 'Damini / Mathapatti', 'Long Earrings', 'Nosering', 'Bangle',
                'Choker', 'Necklace 1', 'Necklace 2', 'Necklace 3', 'Waistbelt', 'Payal', 'Rings'
            ],
            'gopalji': ['Choker', 'Necklace 1', 'Necklace 2', 'Necklace 3', 'Necklace 4', 'Waistbelt', 'Bracelet 1',
                'Bracelet 2', 'Payal', 'Stick'
            ]
        };

        document.querySelectorAll('.deity-select').forEach(sel => {
            const entryBlock = sel.closest('.entry-block');
            const pieceSelect = entryBlock.querySelector('.piece-select');

            function populatePieces(selectedValue) {
                const pieces = JEWELLERY_PIECES[sel.value];
                if (!pieces) {
                    pieceSelect.innerHTML = '<option value="">Select deity category first</option>';
                    pieceSelect.disabled = true;
                    return;
                }
                pieceSelect.innerHTML = '<option value="">Select jewellery piece</option>' +
                    pieces.map(p => {
                        const val = p.toLowerCase().replace(/[^a-z0-9]+/g, '-');
                        const sel = (selectedValue && selectedValue === val) ? ' selected' : '';
                        return `<option value="${val}"${sel}>${p}</option>`;
                    }).join('');
                pieceSelect.disabled = false;
            }

            sel.addEventListener('change', () => populatePieces());

            // Re-populate jewellery pieces on page load if a deity category was
            // already selected (e.g. after a Laravel validation redirect) so the
            // previously chosen piece can be restored from the old() value.
            if (sel.value) {
                populatePieces(pieceSelect.dataset.old || '');
            }
        });

        // Per-entry file upload (Entry 1 = "a", Entry 2 = "b")
        const entryFiles = {};
        ['a', 'b'].forEach(key => {
            const zone = document.getElementById('upload-zone-' + key),
                fi = document.getElementById('file-input-' + key);
            const grid = document.getElementById('preview-grid-' + key),
                countEl = document.getElementById('upload-count-' + key);
            const cntNum = countEl.querySelector('.count-num'),
                errEl = document.getElementById('upload-error-' + key);
            entryFiles[key] = [];

            function syncFileInput() {
                // Keep the real <input type="file"> in sync with entryFiles so that
                // drag-and-drop and removed files are correctly reflected when the
                // form is submitted to Laravel.
                const dt = new DataTransfer();
                entryFiles[key].forEach(f => dt.items.add(f));
                fi.files = dt.files;
            }

            function validateAndPreview(newFiles) {
                errEl.style.display = 'none';
                const valid = [],
                    errs = [];
                Array.from(newFiles).forEach(f => {
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
                let list = entryFiles[key];
                if (list.length + valid.length > 10) {
                    errs.push('Maximum 10 images allowed.');
                    valid.splice(0, Math.max(0, list.length + valid.length - 10));
                }
                entryFiles[key] = [...list, ...valid];
                if (errs.length) {
                    errEl.textContent = errs.join(' | ');
                    errEl.style.display = 'block';
                }
                renderPreviews();
                syncFileInput();
            }

            function renderPreviews() {
                grid.innerHTML = '';
                entryFiles[key].forEach((f, i) => {
                    const rd = new FileReader();
                    rd.onload = e => {
                        const d = document.createElement('div');
                        d.className = 'preview-thumb';
                        d.innerHTML = '<img src="' + e.target.result + '" alt="Preview ' + i +
                            '"><button class="preview-remove" data-idx="' + i +
                            '" title="Remove">&times;</button>';
                        grid.appendChild(d);
                    };
                    rd.readAsDataURL(f);
                });
                cntNum.textContent = entryFiles[key].length;
                countEl.style.display = entryFiles[key].length ? 'block' : 'none';
                grid.style.display = entryFiles[key].length ? 'grid' : 'none';
            }

            grid.addEventListener('click', e => {
                if (e.target.classList.contains('preview-remove')) {
                    entryFiles[key].splice(parseInt(e.target.dataset.idx), 1);
                    renderPreviews();
                    syncFileInput();
                }
            });

            zone.addEventListener('dragover', e => {
                e.preventDefault();
                zone.classList.add('drag-over');
            });
            zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
            zone.addEventListener('drop', e => {
                e.preventDefault();
                zone.classList.remove('drag-over');
                validateAndPreview(e.dataTransfer.files);
            });
            fi.addEventListener('change', () => {
                validateAndPreview(fi.files);
            });
        });

        // Word count (per entry design statement)
        document.querySelectorAll('.stmt-input').forEach(ta => {
            const wc = ta.parentElement.querySelector('.stmt-count');
            const updateCount = () => {
                const w = ta.value.trim().split(/\s+/).filter(Boolean).length;
                wc.textContent = w;
            };
            ta.addEventListener('input', updateCount);
            updateCount();
        });

        const participantType = document.getElementById('f-category');
        const otherField = document.getElementById('participant-type-other');
        const otherInput = document.getElementById('participant_type_other');

        function toggleParticipantType() {

            if (participantType.value === 'other') {

                otherField.style.display = 'block';
                otherInput.required = true;

            } else {

                otherField.style.display = 'none';
                otherInput.required = false;
                otherInput.value = '';

            }

        }

        participantType.addEventListener('change', toggleParticipantType);

        toggleParticipantType();

        // Evil Eye Cursor
        const cursorContainer = document.getElementById('evil-eye-cursor');
        let mouseX = 0,
            mouseY = 0;

        const svgHTML =
            '<svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 3445.6 3445.6"><defs><style>.st0{fill:#170f15}.st1{fill:#fff}.st2{fill:#7bbae5}.st3{fill:#2d2c80}</style></defs><circle class="st3" cx="1722.8" cy="1722.8" r="1715.7"/><circle class="st1" cx="1722.8" cy="1722.8" r="1144"/><circle class="st2" cx="1722.8" cy="1722.8" r="638.6"/><circle class="st0" cx="1722.8" cy="1722.8" r="276.4" transform="translate(-713.6 1722.8) rotate(-45)"/></svg>';

        cursorContainer.innerHTML = svgHTML;
        const svg = cursorContainer.querySelector('svg');
        const pupil = svg.querySelector('.st0');
        const centerX = 1722.8;
        const centerY = 1722.8;
        const maxDistance = 200;

        function updatePupilPosition() {
            const dx = mouseX - (cursorContainer.offsetLeft + 20);
            const dy = mouseY - (cursorContainer.offsetTop + 20);
            const distance = Math.sqrt(dx * dx + dy * dy);
            const angle = Math.atan2(dy, dx);
            const moveDistance = Math.min(distance, maxDistance) * 0.15;
            const newX = centerX + Math.cos(angle) * moveDistance;
            const newY = centerY + Math.sin(angle) * moveDistance;

            pupil.setAttribute('cx', newX);
            pupil.setAttribute('cy', newY);
        }

        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            cursorContainer.style.left = (mouseX - 20) + 'px';
            cursorContainer.style.top = (mouseY - 20) + 'px';
            updatePupilPosition();
        });
    </script>
</body>

</html>
