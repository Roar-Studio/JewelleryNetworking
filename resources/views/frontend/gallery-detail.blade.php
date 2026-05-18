@extends('frontend.layouts.master')

@section('title', 'Gallery Detail - Jewellery Networking')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('new_ui/assets/css/gallery.css') }}?v={{ time() }}">
<style>
    .nav-tabs{
        justify-content: center;
    }
    .nav-tabs .nav-item button{
        font-weight: 800;
        color: #264c5a;
        font-size: 20px;
        text-transform: capitalize;
    }
    .nav-tabs .nav-item .active{
        color: #c6b682;
        border-bottom: 2px solid;
    }
    .image-list img, .image-list video {
        display: block;
        width: 100%;
        margin-bottom: 15px;
        background-color: #ffffff;
        box-shadow: 0 1px 5px -1px #000000bd;
        padding: 5px;
        border-radius: 3px;
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .image-list img:hover {
        transform: scale(1.02);
    }

    .image-list {
        column-count: 4;
    }
    .image-list.empty{
        column-count: 1;
    }
    .image-list img {
        position: relative;
        z-index: 5;
        cursor: pointer;
        pointer-events: auto;
    }
    .grid-design h1{
        text-align: center;
        color: #264c5a;
        text-decoration: underline;
        margin-bottom: 15px;
    }
    #modalVideo{
        width: 100%;
        max-width: 100vw;
        max-height: 90vh;
    }
    .video-wrapper{
        position: relative;
    }
    .video-wrapper::before{
        content: '';
        position: absolute;
        top: calc(50% - 25px);
        left: calc(50% - 25px);
        width: 50px;
        height: 50px;
        background-image: url('../../../new_ui/assets/images/play-button.png');
        background-size: cover;
    }
    /* Updated CSS for Video Gallery Grid */
    .video-list {
        column-count: 3;
        column-gap: 15px;
    }

    .video-list.empty {
        column-count: 1;
    }

    /* YouTube Video Container */
    .youtube-video-item {
        display: block;
        width: 100%;
        margin-bottom: 15px;
        background-color: #ffffff;
        box-shadow: 0 1px 5px -1px #000000bd;
        padding: 8px;
        border-radius: 5px;
        position: relative;
        cursor: pointer;
        break-inside: avoid;
        transition: all 0.3s ease;
    }

    .youtube-video-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 20px -3px #000000bd;
    }

    /* Small iframe for grid display */
    .youtube-iframe-small {
        width: 100%;
        height: 180px;
        border: none;
        border-radius: 3px;
        pointer-events: none;
    }

    /* Video info overlay */
    .video-info-overlay {
        position: absolute;
        bottom: 8px;
        left: 8px;
        right: 8px;
        background: linear-gradient(transparent, rgba(0,0,0,0.8));
        color: white;
        padding: 15px 8px 8px;
        border-radius: 0 0 3px 3px;
        font-size: 12px;
        text-align: center;
    }

    /* Centered thumbnail + play button */
    .video-thumbnail{
        position: relative;
        width: 100%;
        height: 180px;
        border-radius: 3px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background-size: cover;
        background-position: center;
    }

    /* Keep overlay always perfectly centered */
    .youtube-video-item .play-overlay{
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
        opacity: 1;
    }

    /* Red circle + white triangle */
    .youtube-video-item .play-overlay::before{
        content: "";
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(255,0,0,0.9);
        box-shadow: 0 6px 18px rgba(0,0,0,.35);
    }
    .youtube-video-item .play-overlay::after{
        content: "";
        margin-left: 2px;       
        border-left: 20px solid #fff;
        border-top: 12px solid transparent;
        border-bottom: 12px solid transparent;
        position: absolute;
    }

    /* Modal iframe - full size */
    .youtube-iframe-modal {
        width: 100%;
        height: 500px;
        border: none;
        border-radius: 8px;
    }

    /* Loading placeholder for videos */
    .video-loading {
        width: 100%;
        height: 180px;
        background: linear-gradient(45deg, #f0f0f0 25%, transparent 25%),
                    linear-gradient(-45deg, #f0f0f0 25%, transparent 25%),
                    linear-gradient(45deg, transparent 75%, #f0f0f0 75%),
                    linear-gradient(-45deg, transparent 75%, #f0f0f0 75%);
        background-size: 20px 20px;
        background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
        border-radius: 3px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        font-size: 14px;
    }

    /* BOOTSTRAP IMAGE MODAL STYLES */
    .image-modal-body {
        position: relative;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 70vh;
        background: #000;
    }

    .modal-image {
        max-width: 100%;
        max-height: 80vh;
        width: auto;
        height: auto;
        transition: transform 0.3s ease;
        cursor: zoom-in;
    }

    .modal-image.zoomed {
        cursor: grab;
    }

    .modal-image.zoomed:active {
        cursor: grabbing;
    }

    /* Navigation arrows */
    .modal-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.7);
        color: white;
        border: none;
        font-size: 24px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s ease;
    }

    .modal-nav:hover {
        background: rgba(0, 0, 0, 0.9);
        color: white;
    }

    .modal-nav:focus {
        box-shadow: none;
        color: white;
        outline: none;
    }

    .modal-nav.prev {
        left: 20px;
    }

    .modal-nav.next {
        right: 20px;
    }

    /* Zoom controls */
    .zoom-controls {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 10;
    }

    .zoom-btn {
        background: rgba(0, 0, 0, 0.7);
        color: white;
        border: none;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s ease;
    }

    .zoom-btn:hover {
        background: rgba(0, 0, 0, 0.9);
        color: white;
    }

    .zoom-btn:focus {
        box-shadow: none;
        color: white;
        outline: none;
    }

    /* Image counter */
    .image-counter {
        color: white;
        background: rgba(0, 0, 0, 0.7);
        padding: 4px 15px;
        border-radius: 20px;
        font-size: 14px;
    }

    /* Dark modal background */
    .modal-content.image-modal-content {
        background-color: #000;
        border: none;
    }

    .modal-header.image-modal-header {
        border-bottom: none;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-close-white {
        filter: invert(1) grayscale(100%) brightness(200%);
        opacity: 1;
    }

    /* Responsive design */
    @media (max-width: 1200px) {
        .video-list {
            column-count: 2;
        }
        
        .youtube-iframe-small {
            height: 160px;
        }
    }

    @media (max-width: 768px) {
        .video-list {
            column-count: 1;
        }
        
        .youtube-iframe-small {
            height: 200px;
        }
        
        .youtube-iframe-modal {
            height: 300px;
        }

        .modal-nav {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }
        
        .modal-nav.prev {
            left: 10px;
        }
        
        .modal-nav.next {
            right: 10px;
        }
        
        .zoom-controls {
            bottom: 20px;
        }
        
        .zoom-btn {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }

        .modal-image {
            max-height: 60vh;
        }
        
        .image-modal-body {
            min-height: 60vh;
        }
    }

    @media (max-width: 576px) {
        .youtube-iframe-small {
            height: 180px;
        }
        
        .youtube-iframe-modal {
            height: 250px;
        }
    }
</style>
@endsection

@section('content')
<!-- BEGIN: Content-->
<div class="container mt-5">
    <!-- <div class="d-flex gap-2 align-items-center mb-3">
        <a href="{{ route('gallery') }}" class="btn btn-outline-secondary">
            <i class="bi bi-chevron-left me-1"></i>Back to Gallery
        </a>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb p-0 m-0">
                <li class="breadcrumb-item"><a href="{{ route('gallery') }}">Gallery</a></li>
                <li class="breadcrumb-item active" aria-current="page" id="galleryName">Loading...</li>
            </ol>
        </nav>
    </div> -->

    <a href="{{ route('gallery') }}"><h1 class="text-center mb-4" id="galleryTitle">Loading Gallery...</h1></a>
    
    <!-- Tabs for Gallery and Video Gallery -->
    <ul class="nav nav-tabs" id="galleryDetailTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="gallery-images-tab" data-bs-toggle="tab" 
                    data-bs-target="#gallery-images" type="button" role="tab" 
                    aria-controls="gallery-images" aria-selected="true">Image Gallery</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="video-gallery-tab" data-bs-toggle="tab" 
                    data-bs-target="#video-gallery" type="button" role="tab" 
                    aria-controls="video-gallery" aria-selected="false">Video Gallery</button>
        </li>
    </ul>
    
    <div class="tab-content mt-4" id="galleryDetailTabContent">
        <!-- Gallery Tab Content -->
        <div class="tab-pane fade show active" id="gallery-images" role="tabpanel" aria-labelledby="gallery-images-tab">
            <div class="image-list">
                <!-- Gallery images will be loaded here -->
            </div>
        </div>
        
        <!-- Video Gallery Tab Content -->
        <div class="tab-pane fade" id="video-gallery" role="tabpanel" aria-labelledby="video-gallery-tab">
            <div class="video-list">
                <!-- Video gallery content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<div class="special-design container mt-4">
    <hr/>
    <img src="{{ asset('new_ui/assets/images/diamond.webp') }}">
    <div class="vertical-line"></div>
</div>

<section class="join-now-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <svg xmlns="http://www.w3.org/2000/svg" width="325" height="259" viewBox="0 0 325 259" fill="none">
                    <path d="M324.231 66.961C324.045 66.6265 323.772 66.3664 323.43 66.1868L278.939 23.2617L278.703 22.8839C278.666 22.8282 278.623 22.791 278.586 22.7353C278.399 21.9425 277.984 21.379 277.326 21.0507L276.079 20.4995L255.779 0.916595C255.779 0.458297 254.86 0.458297 254.401 0.458297H230.688L229.652 0H162.726C162.466 0 162.211 0.0805117 161.963 0.204376C161.777 0.260115 161.585 0.34682 161.355 0.458297H97.0229C96.4769 0.241535 95.8441 0.210569 95.3415 0.458297L94.3054 0.916595H70.1334C69.6743 0.916595 69.2152 0.916595 68.7561 1.37489L48.0585 21.3356L47.6677 21.509C47.4381 21.6267 47.2334 21.8001 47.0658 22.0045C46.9418 22.1283 46.8301 22.2646 46.7494 22.4194L46.464 22.8715L1.82407 65.9329C0.713495 66.1187 0 66.9734 0 68.181V76.8763C0 77.3346 0 77.7929 0.459118 78.2512L160.245 257.408C160.468 257.879 160.834 258.288 161.355 258.542H162.267C162.573 258.542 162.879 258.694 163.186 259C163.955 258.616 164.395 257.91 164.52 257.154L209.631 206.717C209.96 206.649 210.344 206.544 210.859 206.37L215.544 200.103L324.541 78.2388C325 77.7805 325 77.3222 325 76.8639V68.6269C325 67.8094 324.634 67.3573 324.231 66.9486V66.961ZM118.651 203.942L69.6433 96.4716L140.72 190.819L157.186 247.177L118.651 203.942ZM95.4284 5.60485L113.675 30.3281L59.2759 64.4341L50.8815 25.194V25.1692L51.0118 25.1073L95.4222 5.60485H95.4284ZM264.949 64.5209L210.717 30.5201L229.106 5.60485L273.2 25.1692L264.949 64.5209ZM165.022 7.15935L203.526 31.5792L165.022 63.2327V7.15935ZM112.304 65.8957L118.26 35.2394L155.846 65.8957H112.298H112.304ZM168.689 65.8957L205.822 35.2394L212.237 65.8957H168.689ZM216.816 65.8957L210.754 35.6481L258.856 65.8957H216.816ZM159.978 7.31418V63.6043L121.015 31.573L123.937 29.7212L159.972 7.31418H159.978ZM107.725 65.8957H65.7594L113.694 36.094L107.725 65.8957ZM159.978 70.9246V74.5848H112.205L112 70.9246H159.978ZM212.336 74.5848H164.563V70.9246H212.541L212.336 74.5848ZM207.224 28.3277L190.249 17.6878L170.178 5.03508H224.528L207.224 28.3339V28.3277ZM117.72 27.7951L100.82 5.03508H154.022L117.72 27.7951ZM107.415 70.9246L107.62 74.5848H60.5044V70.9246H107.415ZM56.2668 78.7033L56.4778 78.982L106.348 186.236L25.7727 78.7033H56.2668ZM108.116 78.7033L137.059 178.916L61.9872 78.7033H108.116ZM113.222 78.7033H159.519L142.097 179.832L113.216 78.7033H113.222ZM159.978 103.513V241.678L144.852 189.902L159.978 103.513ZM164.563 103.532L179.689 189.902L164.563 241.665V103.532ZM165.022 78.7033H211.319L182.438 179.832L165.016 78.7033H165.022ZM216.419 78.7033H262.547L187.475 178.916L216.419 78.7033ZM264.489 74.591H216.915L217.12 70.9308H264.489V74.591ZM277.556 29.9318L300.071 65.8957H269.67L277.549 29.9318H277.556ZM54.8957 65.8957H25.0902L47.5001 30.099L54.8957 65.8957ZM55.9194 70.9246V74.5848H23.3716V70.9246H55.9194ZM18.3337 74.591H4.58498V70.9308H18.3337V74.591ZM19.4753 78.7033L84.2793 165.371L7.02948 78.7033H19.4753ZM184.274 190.819L255.698 95.4993L205.822 203.633C205.735 203.806 205.691 203.998 205.666 204.19L167.448 247.066L184.274 190.813V190.819ZM268.659 78.7033H300.028L219.111 186.694L268.659 78.7033ZM269.074 74.591V70.9308H302.081V74.591H269.074ZM307.125 70.9246H319.956V74.5848H307.125V70.9246ZM316.612 65.8957H305.804L289.381 39.8285L316.612 65.8957ZM253.03 5.03508L263.286 14.8513L241.056 5.03508H253.03ZM71.0517 5.03508H84.9803L59.1208 16.4492L71.0455 5.03508H71.0517ZM19.3698 65.8957H7.46998L37.4368 37.215L19.3698 65.8957ZM306.325 78.7033H317.511L248.073 156.608L306.325 78.7033Z" fill="#C6B682" fill-opacity="0.5"/>
                </svg>
                <h3>Become <br/>A Member</h3>
            </div>
            <div class="col-md-5">
                <a href="/membership" class="btn btn-secondary custom-btn w-100">
                    Join Now
                    <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- YouTube Video Modal -->
<div class="modal fade" id="youtubeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-dark">
            <div class="modal-header border-0" style="max-height:0px;">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <iframe id="youtubeIframe" class="youtube-iframe-modal" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content image-modal-content">
            <div class="modal-header image-modal-header" style="max-height: 10px;">
                <div class="image-counter" id="imageCounter">1 / 1</div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body image-modal-body">
                <button class="modal-nav prev" id="prevImage">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button class="modal-nav next" id="nextImage">
                    <i class="bi bi-chevron-right"></i>
                </button>
                
                <img class="modal-image" id="modalImage" src="" alt="">
                
                <div class="zoom-controls">
                    <button class="zoom-btn" id="zoomOut" title="Zoom Out">-</button>
                    <button class="zoom-btn" id="resetZoom" title="Reset Zoom">⌂</button>
                    <button class="zoom-btn" id="zoomIn" title="Zoom In">+</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@section('script')
<script src="{{ asset('new_ui/assets/js/admin/custom-image-uploader.js') }}?v={{ time() }}"></script>
<script>
    // Image modal variables
    let currentImageIndex = 0;
    let imageArray = [];
    let currentZoom = 1;
    let isDragging = false;
    let startX, startY, translateX = 0, translateY = 0;

    // Get category ID from blade variable
    const categoryId = {{ $id }};

    $(document).ready(function () {
        // Load Gallery Images on page load
        loadGalleryImages(categoryId);
        
        // Load Video Gallery when tab is clicked
        $('#video-gallery-tab').on('click', function() {
            //if ($('.video-list').is(':empty')) {
                loadVideoGallery(categoryId);
            //}
        });

        // Image click handler - using event delegation
        $(document).on('click', '.image-list img', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            imageArray = $('.image-list img').toArray();
            currentImageIndex = imageArray.indexOf(this);
            updateModalImage();
            
            const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        });

        // Navigation buttons
        $(document).on('click', '#prevImage', function (e) {
            e.preventDefault();
            if (currentImageIndex > 0) {
                currentImageIndex--;
                updateModalImage();
            }
        });

        $(document).on('click', '#nextImage', function (e) {
            e.preventDefault();
            if (currentImageIndex < imageArray.length - 1) {
                currentImageIndex++;
                updateModalImage();
            }
        });

        // Zoom controls
        $(document).on('click', '#zoomIn', function (e) {
            e.preventDefault();
            currentZoom = Math.min(currentZoom * 1.3, 5);
            updateImageTransform();
            updateCursor();
        });

        $(document).on('click', '#zoomOut', function (e) {
            e.preventDefault();
            currentZoom = Math.max(currentZoom / 1.3, 0.5);
            updateImageTransform();
            updateCursor();
        });

        $(document).on('click', '#resetZoom', function (e) {
            e.preventDefault();
            resetImageTransform();
        });

        // Keyboard navigation
        $(document).on('keydown', function (e) {
            if ($('#imageModal').hasClass('show')) {
                switch(e.key) {
                    case 'Escape':
                        $('#imageModal').modal('hide');
                        break;
                    case 'ArrowLeft':
                        $('#prevImage').trigger('click');
                        break;
                    case 'ArrowRight':
                        $('#nextImage').trigger('click');
                        break;
                    case '+':
                    case '=':
                        $('#zoomIn').trigger('click');
                        break;
                    case '-':
                        $('#zoomOut').trigger('click');
                        break;
                    case '0':
                        $('#resetZoom').trigger('click');
                        break;
                }
                e.preventDefault();
            }
        });

        // Mouse wheel zoom
        $(document).on('wheel', '#modalImage', function (e) {
            e.preventDefault();
            const delta = e.originalEvent.deltaY;
            
            if (delta < 0) {
                $('#zoomIn').trigger('click');
            } else {
                $('#zoomOut').trigger('click');
            }
        });

        // Image dragging
        $(document).on('mousedown', '#modalImage', function (e) {
            if (currentZoom > 1) {
                isDragging = true;
                startX = e.clientX - translateX;
                startY = e.clientY - translateY;
                $(this).addClass('zoomed');
                e.preventDefault();
            }
        });

        $(document).on('mousemove', function (e) {
            if (isDragging && currentZoom > 1) {
                translateX = e.clientX - startX;
                translateY = e.clientY - startY;
                updateImageTransform();
            }
        });

        $(document).on('mouseup', function () {
            if (isDragging) {
                isDragging = false;
                updateCursor();
            }
        });

        // Click on image to zoom
        $(document).on('click', '#modalImage', function (e) {
            if (!isDragging) {
                if (currentZoom === 1) {
                    currentZoom = 2;
                } else {
                    resetImageTransform();
                }
                updateImageTransform();
                updateCursor();
            }
        });

        // Modal events
        $(document).on('shown.bs.modal', '#imageModal', function () {
            if (imageArray.length > 0) {
                updateImageCounter();
                updateCursor();
            }
        });

        $(document).on('hidden.bs.modal', '#imageModal', function () {
            resetImageTransform();
            $('#modalImage').attr('src', '');
        });

        // YouTube video click
        $(document).on('click', '.youtube-video-item', function (e) {
            e.preventDefault();
            const embedUrl = $(this).data('embed-url');
            if (embedUrl) {
                const autoplayUrl = embedUrl + '?autoplay=1&modestbranding=1&showinfo=0&rel=0';
                $('#youtubeIframe').attr('src', autoplayUrl);
                $('#youtubeModal').modal('show');
            }
        });
    });

    // Load Gallery Images Function
    function loadGalleryImages(categoryId) {
        window.axiosApiClient.get(`/get-gallery-images/${categoryId}`)
            .then(response => {
                const data = response.data.data;
                const mediaFiles = data?.media_files || [];
                
                // Set page title and breadcrumb
                $('#galleryTitle').text(data.name);
                $('#galleryName').text(data.name);
                
                // Filter only images
                const imageFiles = mediaFiles.filter(media => {
                    const ext = media.url.split('.').pop().toLowerCase();
                    return !['mp4', 'mov', 'mpeg', 'mpg', 'mpeg1', 'mpeg2', 'mpeg4', 'webm', 'avi', 'mkv'].includes(ext);
                });

                if (imageFiles.length === 0) {
                    $('.image-list').html('<h4 class="my-5 text-center">No images found for this folder.</h4>');
                    $('.image-list').addClass('empty');
                } else {
                    $('.image-list').removeClass('empty');
                    imageFiles.forEach((media, index) => {
                        const src = `/storage/${media.url}`;
                        const alt = media.caption || `Image ${index + 1}`;
                        const elementHTML = `<img src="${src}" alt="${alt}" title="${alt}" />`;
                        $('.image-list').append(elementHTML);
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching media:', error);
                $('.image-list').html('<p>Error loading media files.</p>');
            });
    }

    // Load Video Gallery Function
    function loadVideoGallery(categoryId) {
        window.axiosApiClient.get(`/get-video-gallery/${categoryId}`)
            .then(response => {
                const videos = response.data.data?.videos || [];
                
                if (videos.length === 0) {
                    $('.video-list').html('<h4 class="my-5 text-center">No videos found for this event.</h4>');
                    $('.video-list').addClass('empty');
                    return;
                } else {
                    $('.video-list').removeClass('empty');
                }

                videos.forEach((video, index) => {
                    const embedUrl = video.embed_url;
                    const videoId = extractVideoId(embedUrl);
                    
                    const loadingHTML = `
                        <div class="youtube-video-item" data-embed-url="${embedUrl}" data-video-id="${video.id}" data-index="${index}">
                            <div class="video-loading">Loading video...</div>
                            <div class="play-overlay"></div>
                        </div>
                    `;
                    $('.video-list').append(loadingHTML);
                    
                    setTimeout(() => {
                        loadVideoIframe(video, index);
                    }, index * 200);
                });
            })
            .catch(error => {
                console.error('Error fetching video gallery:', error);
                $('.video-list').html('<p>Error loading video files.</p>');
            });
    }

    // Load individual video iframe
    function loadVideoIframe(video, index) {
        const embedUrl = video.embed_url;
        const videoId = extractVideoId(embedUrl);
        
        const iframeHTML = `
            <div class="youtube-video-item" data-embed-url="${embedUrl}" data-video-id="${video.id}">
                <div class="video-thumbnail" style="background-image:url('https://img.youtube.com/vi/${videoId}/mqdefault.jpg')">
                    <div class="play-overlay"></div>
                </div>
                <div class="video-info-overlay">
                    <small>Click to play in full screen</small>
                </div>
            </div>
        `;
        
        $(`.youtube-video-item[data-index="${index}"]`).replaceWith(iframeHTML);
    }

    // Extract YouTube video ID
    function extractVideoId(url) {
        const regex = /(?:youtube\.com\/embed\/|youtu\.be\/)([^?&]+)/;
        const matches = url.match(regex);
        return matches ? matches[1] : null;
    }

    // Helper functions for image modal
    function updateModalImage() {
        if (imageArray.length === 0) return;
        
        const currentImage = $(imageArray[currentImageIndex]);
        const imageSrc = currentImage.attr('src');
        const imageAlt = currentImage.attr('alt') || 'Gallery Image';
        
        $('#modalImage').attr('src', imageSrc).attr('alt', imageAlt);
        updateImageCounter();
        resetImageTransform();
        
        $('#prevImage').toggle(currentImageIndex > 0);
        $('#nextImage').toggle(currentImageIndex < imageArray.length - 1);
    }

    function updateImageCounter() {
        if (imageArray.length > 0) {
            $('#imageCounter').text(`${currentImageIndex + 1} / ${imageArray.length}`);
        }
        
        $('#prevImage').toggle(currentImageIndex > 0 && imageArray.length > 1);
        $('#nextImage').toggle(currentImageIndex < imageArray.length - 1 && imageArray.length > 1);
    }

    function updateImageTransform() {
        const transform = `scale(${currentZoom}) translate(${translateX / currentZoom}px, ${translateY / currentZoom}px)`;
        $('#modalImage').css('transform', transform);
    }

    function resetImageTransform() {
        currentZoom = 1;
        translateX = 0;
        translateY = 0;
        updateImageTransform();
        updateCursor();
    }

    function updateCursor() {
        const $image = $('#modalImage');
        if (currentZoom > 1) {
            $image.addClass('zoomed').css('cursor', isDragging ? 'grabbing' : 'grab');
        } else {
            $image.removeClass('zoomed').css('cursor', 'zoom-in');
        }
    }

    // YouTube modal cleanup
    document.addEventListener("DOMContentLoaded", function () {
        var modalEl = document.getElementById('youtubeModal');
        if (modalEl) {
            modalEl.addEventListener('hidden.bs.modal', function () {
                const frame = document.getElementById('youtubeIframe');
                if (frame) {
                    frame.src = 'about:blank';
                    const fresh = frame.cloneNode();
                    frame.replaceWith(fresh);
                }
            });
        }
    });
</script>
@endsection