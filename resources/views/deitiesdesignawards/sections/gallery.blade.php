{{-- resources/views/deitiesdesignawards/sections/gallery.blade.php --}}

@extends('deitiesdesignawards.layouts.app')

@push('styles')
<style>
    .gallery-filter-tabs {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin: 2rem 0;
        flex-wrap: wrap;
    }

    .gallery-tab-btn {
        padding: 0.75rem 1.5rem;
        background: transparent;
        border: 2px solid var(--gold);
        color: var(--gold);
        font-family: var(--body);
        font-size: 0.9rem;
        font-weight: 500;
        letter-spacing: 0.05em;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
    }

    .gallery-tab-btn:hover,
    .gallery-tab-btn.active {
        background: var(--gold);
        color: var(--brown);
    }

    .gallery-masonry {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .gal-item {
        position: relative;
        overflow: hidden;
        aspect-ratio: 1;
        cursor: pointer;
        border: 1px solid rgba(184,146,42,0.15);
        background: rgba(184,146,42,0.05);
    }

    .gal-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .gal-item:hover img {
        transform: scale(1.05);
    }

    .gal-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(42, 31, 16, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gal-item:hover .gal-overlay {
        opacity: 1;
    }

    .gal-overlay span {
        color: var(--gold);
        font-size: 0.9rem;
        text-align: center;
        font-weight: 500;
    }

    .lightbox {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.9);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .lightbox.active {
        display: flex;
    }

    .lightbox-content {
        position: relative;
        max-width: 90vw;
        max-height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .lightbox-img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .lightbox-close {
        position: absolute;
        top: 2rem;
        right: 2rem;
        font-size: 2rem;
        color: white;
        cursor: pointer;
        background: none;
        border: none;
        padding: 0;
    }

    .lightbox-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 2rem;
        color: white;
        cursor: pointer;
        background: none;
        border: none;
        padding: 1rem;
        z-index: 1001;
    }

    .lightbox-prev {
        left: 1rem;
    }

    .lightbox-next {
        right: 1rem;
    }

    .gallery-loading {
        text-align: center;
        padding: 3rem;
        color: var(--brown);
        opacity: 0.6;
    }

    .load-more-btn {
        display: block;
        margin: 3rem auto 0;
        padding: 0.75rem 2rem;
        background: var(--gold);
        color: var(--brown);
        border: none;
        font-family: var(--body);
        font-size: 0.9rem;
        font-weight: 500;
        letter-spacing: 0.05em;
        cursor: pointer;
        text-transform: uppercase;
        transition: all 0.3s ease;
    }

    .load-more-btn:hover {
        background: var(--gold-deep);
        color: white;
    }

    .load-more-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background: var(--gold);
        color: var(--brown);
    }

    .gallery-info {
        text-align: center;
        margin-top: 1rem;
        font-size: 0.85rem;
        opacity: 0.6;
    }

    @media (max-width: 768px) {
        .gallery-masonry {
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
        }

        .lightbox-close {
            top: 1rem;
            right: 1rem;
            font-size: 1.5rem;
        }

        .lightbox-nav {
            font-size: 1.5rem;
            padding: 0.5rem;
        }
    }
</style>
@endpush

@section('content')

<section class="page-hero-int">
    <div class="page-hero-int-content">
        <span class="page-hero-int-eyebrow">Inspiration Gallery</span>
        <h1 class="page-hero-int-title">Sacred Design Inspiration</h1>
        <p class="page-hero-int-sub">Explore timeless craftsmanship, intricate details and devotional artistry.</p>
    </div>
</section>

<section class="section">
    <div class="container">

        <div class="gallery-filter-tabs">
            <button class="gallery-tab-btn active" data-category="all">All Images</button>
            <button class="gallery-tab-btn" data-category="wooden">Wooden</button>
            <button class="gallery-tab-btn" data-category="carvings">Carvings</button>
            <button class="gallery-tab-btn" data-category="deities">Deities</button>
            <button class="gallery-tab-btn" data-category="paintings">Paintings</button>
        </div>

        <div id="gallery-container" class="gallery-masonry">
            <div class="gallery-loading">Loading images...</div>
        </div>

        <button id="load-more-btn" class="load-more-btn" onclick="loadMoreImages()">Load More</button>
        <div class="gallery-info" id="gallery-info"></div>

    </div>
</section>

{{-- Lightbox --}}
<div class="lightbox" id="lightbox">
    <button class="lightbox-close" onclick="closeLightbox()">&#x2715;</button>
    <button class="lightbox-nav lightbox-prev" onclick="previousImage()">&#x276E;</button>
    <div class="lightbox-content">
        <img class="lightbox-img" id="lightbox-img" src="" alt="">
    </div>
    <button class="lightbox-nav lightbox-next" onclick="nextImage()">&#x276F;</button>
</div>

@endsection

@push('scripts')
{{-- Gallery data — defines the galleryData object used by the scripts below --}}
<script src="{{ asset('deitiesdesignawards/js/gallery-data.js') }}"></script>

<script>
(function () {
    var IMAGES_PER_LOAD  = 20;
    var currentCategory  = 'all';
    var currentImages    = [];
    var currentImageIndex = 0;
    var imagesDisplayed  = 0;

    // ── Render ──────────────────────────────────────────────────────────────
    function renderGallery(category) {
        var container = document.getElementById('gallery-container');
        var allImages = category === 'all'
            ? [].concat(
                galleryData.wooden   || [],
                galleryData.carvings || [],
                galleryData.deities  || [],
                galleryData.paintings || []
              )
            : (galleryData[category] || []);

        currentImages    = allImages;
        imagesDisplayed  = 0;
        container.innerHTML = '';

        loadMoreImages();
    }

    // ── Load more ────────────────────────────────────────────────────────────
    function loadMoreImages() {
        var container = document.getElementById('gallery-container');
        var loadBtn   = document.getElementById('load-more-btn');
        var infoDiv   = document.getElementById('gallery-info');

        var startIdx     = imagesDisplayed;
        var endIdx       = Math.min(imagesDisplayed + IMAGES_PER_LOAD, currentImages.length);
        var imagesToAdd  = currentImages.slice(startIdx, endIdx);

        var html = imagesToAdd.map(function (img, idx) {
            return '<div class="gal-item" onclick="openLightbox(' + (startIdx + idx) + ')">'
                 +     '<img src="' + img + '" alt="Gallery image" loading="lazy">'
                 +     '<div class="gal-overlay"><span>View Image</span></div>'
                 + '</div>';
        }).join('');

        container.innerHTML += html;
        imagesDisplayed = endIdx;

        if (imagesDisplayed >= currentImages.length) {
            loadBtn.style.display = 'none';
            infoDiv.textContent   = 'Showing all ' + currentImages.length + ' images';
        } else {
            loadBtn.style.display = 'block';
            infoDiv.textContent   = 'Showing ' + imagesDisplayed + ' of ' + currentImages.length + ' images';
        }
    }

    // ── Lightbox ─────────────────────────────────────────────────────────────
    function openLightbox(index) {
        currentImageIndex = index;
        document.getElementById('lightbox').classList.add('active');
        document.getElementById('lightbox-img').src = currentImages[index];
    }

    function closeLightbox() {
        document.getElementById('lightbox').classList.remove('active');
    }

    function nextImage() {
        currentImageIndex = (currentImageIndex + 1) % currentImages.length;
        document.getElementById('lightbox-img').src = currentImages[currentImageIndex];
    }

    function previousImage() {
        currentImageIndex = (currentImageIndex - 1 + currentImages.length) % currentImages.length;
        document.getElementById('lightbox-img').src = currentImages[currentImageIndex];
    }

    // Close lightbox on backdrop click
    document.getElementById('lightbox').addEventListener('click', function (e) {
        if (e.target.id === 'lightbox') closeLightbox();
    });

    // ── Filter tabs ───────────────────────────────────────────────────────────
    document.querySelectorAll('.gallery-tab-btn').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            document.querySelectorAll('.gallery-tab-btn').forEach(function (b) {
                b.classList.remove('active');
            });
            e.target.classList.add('active');
            currentCategory = e.target.dataset.category;
            renderGallery(currentCategory);
        });
    });

    // ── Keyboard navigation ───────────────────────────────────────────────────
    document.addEventListener('keydown', function (e) {
        if (document.getElementById('lightbox').classList.contains('active')) {
            if (e.key === 'ArrowRight') nextImage();
            if (e.key === 'ArrowLeft')  previousImage();
            if (e.key === 'Escape')     closeLightbox();
        }
    });

    // ── URL parameter — ?category=wooden ─────────────────────────────────────
    var urlParams = new URLSearchParams(window.location.search);
    var categoryParam = urlParams.get('category');

    if (categoryParam && galleryData[categoryParam]) {
        currentCategory = categoryParam;
        var matchingBtn = document.querySelector('[data-category="' + categoryParam + '"]');
        if (matchingBtn) matchingBtn.click();
    } else {
        renderGallery('all');
    }

    // Expose functions called from inline onclick attributes to global scope
    window.loadMoreImages = loadMoreImages;
    window.openLightbox   = openLightbox;
    window.closeLightbox  = closeLightbox;
    window.nextImage      = nextImage;
    window.previousImage  = previousImage;

})();
</script>
@endpush