@extends('frontend.layouts.master')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>

    
    
    </style>
@endsection

@section('content')
<!-- BEGIN: Content-->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="{{ asset('new_ui/assets/images/carousel1.webp') }}" class="d-block w-100" alt="carousel image">
        <div class="carousel-caption d-none d-md-block">
            <img src="{{ asset('new_ui/assets/images/be-ceen.webp') }}"/>
            <button class="btn btn-primary custom-btn w-100">Become a part of Our Thriving Community<img src="{{ asset('new_ui/assets/images/right-arrow.svg') }}"/></button>
        </div>
        </div>
        <div class="carousel-item">
        <img src="{{ asset('new_ui/assets/images/carousel1.webp') }}" class="d-block w-100" alt="carousel image">
        <div class="carousel-caption d-none d-md-block">
            <img src="{{ asset('new_ui/assets/images/be-ceen.webp') }}"/>
            <button class="btn btn-primary custom-btn w-100">Become a part of Our Thriving Community<img src="{{ asset('new_ui/assets/images/right-arrow.svg') }}"/></button>
        </div>
        </div>
        <div class="carousel-item">
        <img src="{{ asset('new_ui/assets/images/carousel1.webp') }}" class="d-block w-100" alt="carousel image">
        <!-- <div class="carousel-caption d-none d-md-block">
            <h5>Third slide label</h5>
            <p>Some representative placeholder content for the third slide.</p>
        </div> -->
        <div class="carousel-caption d-none d-md-block">
            <img src="{{ asset('new_ui/assets/images/be-ceen.webp') }}"/>
            <button class="btn btn-primary custom-btn w-100">Become a part of Our Thriving Community<img src="{{ asset('new_ui/assets/images/right-arrow.svg') }}"/></button>
        </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div class="special-design" style="height: 200px;">
    <hr/>
    <img src="{{ asset('new_ui/assets/images/diamond.webp') }}">
    <div class="vertical-line"></div>
</div>
<section class="key-features">
    <div class="key-box">
        <div class="key-circle">
            <img src="{{ asset('new_ui/assets/images/connect1.webp') }}">
        </div>
        <div class="key-circle">
            <img src="{{ asset('new_ui/assets/images/connect2.webp') }}">
        </div>
        <div class="key-circle">
            <img src="{{ asset('new_ui/assets/images/connect3.webp') }}">
        </div>
        <div class="key-circle">
            <img src="{{ asset('new_ui/assets/images/connect4.webp') }}">
        </div>
    </div>
    <div class="key-btns">
        <a href="/membership" class="btn btn-secondary custom-btn">
            Join Now
            <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
            </svg>
        </a>
        <a href="/events" class="btn btn-secondary custom-btn">
            Learn More
            <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
            </svg>
        </a>
    </div>
</section>
<section class="become-member">
    <h3>Jewellery Networking: Where Connections Become Opportunities</h3>
    <div class="bm-box">
        <div class="bm-left">
            <p>At Jewellery Networking, we all aspire to Be “CEEN”. Our mission is to create a vibrant
                community that acts as your comprehensive business directory in the gems and jewellery industry. Our platform fosters global connections among service providers, professionals, retailers, manufacturers, wholesalers, and independent designers etc. This is your gateway, to a one-stop destination for all your business needs, facilitating seamless access to building relationships, exchanging vital information, and forging collaborations that drive mutual success. </p>
            <p>This membership is your essential tool for thriving in thebusiness world.</p>
            
            <button class="btn btn-secondary custom-btn">
                Become A Member
                <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
                </svg>
                <!-- <img src="{{ asset('new_ui/assets/images/right-arrow.svg') }}" /> -->
            </button>
        </div>
        <img class="bm-right" src="{{ asset('new_ui/assets/images/become-member.webp') }}"/>
    </div>
</section>
<div class="special-design" style="height: 100px;">
    <hr/>
    <img src="{{ asset('new_ui/assets/images/diamond.webp') }}">
    <div class="vertical-line"></div>
</div>
<section class="eevents">
    <h3>Be part of our Exclusive Events</h3>
    <div class="ee-box">
        <div class="ee-imgs">
            <img src="{{ asset('new_ui/assets/images/exclusive-event1.webp') }}">
            <img src="{{ asset('new_ui/assets/images/exclusive-event1.webp') }}">
        </div>
        <div class="ee-list">
            <div>
                <img src="{{ asset('new_ui/assets/images/four-person.png') }}">
                <h4>Online Workshops & Digital Conferences​</h4>
                <p>Our online workshops are designed for a global audience to ignite creativity, develop new skills and explore business strategies through dynamic brainstorming sessions, complemented by action-oriented plans.</p>
            </div>
            <div>
                <img src="{{ asset('new_ui/assets/images/tea.png') }}">
                <h4>Offline Workshops</h4>
                <p>Our offline workshops ensure practical insights and personalised strategies, fostering meaningful connections that propel business growth with confidence and expertise. Engage in dynamic sessions where networking and skill-building converge, paving the way for tangible advancements in your business journey.</p>
            </div>
            <div>
                <img src="{{ asset('new_ui/assets/images/hands.png') }}">
                <h4>Networking Meetups​</h4>
                <p>Discover a dynamic community of like minded people at jewellery networking events across trade and luxury shows. Laying the groundwork for innovative partnerships and growth opportunities.</p>
            </div>
        </div>
        <div class="ee-btn">
            <button class="btn btn-secondary custom-btn">
                Join Now
                <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
                </svg>
            </button>
            <button class="btn btn-secondary custom-btn">
                Learn More
                <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
                </svg>
            </button>
        </div>
    </div>
</section>
<div class="special-design" style="height: 100px;">
    <hr/>
    <img src="{{ asset('new_ui/assets/images/diamond.webp') }}">
    <div class="vertical-line"></div>
</div>
<section class="more-section">
    <h3>There’s more to it</h3>
    <div class="row">
        <div class="col-md-4">
            <div class="more-box">
                <img src="{{ asset('new_ui/assets/images/more1.webp') }}">
                <div>
                    <h4>Exclusive Soirées and Galas</h4>
                    <p>Network with top buyers, collectors, and influencers in a sophisticated, elegant setting that encourages collaboration and opportunity.</p>
                    <a>View more 
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="15" viewBox="0 0 10 15" fill="none">
                            <path d="M9.08036 7.59818L2.45536 14.2232C2.34226 14.3363 2.20833 14.3928 2.05357 14.3928C1.89881 14.3928 1.76488 14.3363 1.65179 14.2232L0.169643 12.741C0.0565476 12.6279 0 12.494 0 12.3393C0 12.1845 0.0565476 12.0506 0.169643 11.9375L4.91071 7.19639L0.169643 2.45532C0.0565476 2.34223 0 2.2083 0 2.05354C0 1.89877 0.0565476 1.76485 0.169643 1.65175L1.65179 0.169607C1.76488 0.0565119 1.89881 -3.52859e-05 2.05357 -3.52859e-05C2.20833 -3.52859e-05 2.34226 0.0565119 2.45536 0.169607L9.08036 6.79461C9.19345 6.9077 9.25 7.04163 9.25 7.19639C9.25 7.35116 9.19345 7.48508 9.08036 7.59818Z" fill="#0000E7"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="15" viewBox="0 0 10 15" fill="none">
                            <path d="M9.08036 7.59818L2.45536 14.2232C2.34226 14.3363 2.20833 14.3928 2.05357 14.3928C1.89881 14.3928 1.76488 14.3363 1.65179 14.2232L0.169643 12.741C0.0565476 12.6279 0 12.494 0 12.3393C0 12.1845 0.0565476 12.0506 0.169643 11.9375L4.91071 7.19639L0.169643 2.45532C0.0565476 2.34223 0 2.2083 0 2.05354C0 1.89877 0.0565476 1.76485 0.169643 1.65175L1.65179 0.169607C1.76488 0.0565119 1.89881 -3.52859e-05 2.05357 -3.52859e-05C2.20833 -3.52859e-05 2.34226 0.0565119 2.45536 0.169607L9.08036 6.79461C9.19345 6.9077 9.25 7.04163 9.25 7.19639C9.25 7.35116 9.19345 7.48508 9.08036 7.59818Z" fill="#0000E7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="more-box">
                <img src="{{ asset('new_ui/assets/images/more2.webp') }}">
                <div>
                    <h4>Intimate Artist Meet-and-Greets</h4>
                    <p>Build meaningful connections and gain insights from the experiences and wisdom of established experts.</p>
                    <a>View more 
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="15" viewBox="0 0 10 15" fill="none">
                            <path d="M9.08036 7.59818L2.45536 14.2232C2.34226 14.3363 2.20833 14.3928 2.05357 14.3928C1.89881 14.3928 1.76488 14.3363 1.65179 14.2232L0.169643 12.741C0.0565476 12.6279 0 12.494 0 12.3393C0 12.1845 0.0565476 12.0506 0.169643 11.9375L4.91071 7.19639L0.169643 2.45532C0.0565476 2.34223 0 2.2083 0 2.05354C0 1.89877 0.0565476 1.76485 0.169643 1.65175L1.65179 0.169607C1.76488 0.0565119 1.89881 -3.52859e-05 2.05357 -3.52859e-05C2.20833 -3.52859e-05 2.34226 0.0565119 2.45536 0.169607L9.08036 6.79461C9.19345 6.9077 9.25 7.04163 9.25 7.19639C9.25 7.35116 9.19345 7.48508 9.08036 7.59818Z" fill="#0000E7"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="15" viewBox="0 0 10 15" fill="none">
                            <path d="M9.08036 7.59818L2.45536 14.2232C2.34226 14.3363 2.20833 14.3928 2.05357 14.3928C1.89881 14.3928 1.76488 14.3363 1.65179 14.2232L0.169643 12.741C0.0565476 12.6279 0 12.494 0 12.3393C0 12.1845 0.0565476 12.0506 0.169643 11.9375L4.91071 7.19639L0.169643 2.45532C0.0565476 2.34223 0 2.2083 0 2.05354C0 1.89877 0.0565476 1.76485 0.169643 1.65175L1.65179 0.169607C1.76488 0.0565119 1.89881 -3.52859e-05 2.05357 -3.52859e-05C2.20833 -3.52859e-05 2.34226 0.0565119 2.45536 0.169607L9.08036 6.79461C9.19345 6.9077 9.25 7.04163 9.25 7.19639C9.25 7.35116 9.19345 7.48508 9.08036 7.59818Z" fill="#0000E7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="more-box">
                <img src="{{ asset('new_ui/assets/images/more3.webp') }}">
                <div>
                    <h4>Network at Digital Conferences</h4>
                    <p>Join digital conferences dedicated to the jewellery industry, connecting with global stakeholders, exploring digital marketing strategies, and adapting to e-commerce trends.</p>
                    <a>View more 
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="15" viewBox="0 0 10 15" fill="none">
                            <path d="M9.08036 7.59818L2.45536 14.2232C2.34226 14.3363 2.20833 14.3928 2.05357 14.3928C1.89881 14.3928 1.76488 14.3363 1.65179 14.2232L0.169643 12.741C0.0565476 12.6279 0 12.494 0 12.3393C0 12.1845 0.0565476 12.0506 0.169643 11.9375L4.91071 7.19639L0.169643 2.45532C0.0565476 2.34223 0 2.2083 0 2.05354C0 1.89877 0.0565476 1.76485 0.169643 1.65175L1.65179 0.169607C1.76488 0.0565119 1.89881 -3.52859e-05 2.05357 -3.52859e-05C2.20833 -3.52859e-05 2.34226 0.0565119 2.45536 0.169607L9.08036 6.79461C9.19345 6.9077 9.25 7.04163 9.25 7.19639C9.25 7.35116 9.19345 7.48508 9.08036 7.59818Z" fill="#0000E7"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="15" viewBox="0 0 10 15" fill="none">
                            <path d="M9.08036 7.59818L2.45536 14.2232C2.34226 14.3363 2.20833 14.3928 2.05357 14.3928C1.89881 14.3928 1.76488 14.3363 1.65179 14.2232L0.169643 12.741C0.0565476 12.6279 0 12.494 0 12.3393C0 12.1845 0.0565476 12.0506 0.169643 11.9375L4.91071 7.19639L0.169643 2.45532C0.0565476 2.34223 0 2.2083 0 2.05354C0 1.89877 0.0565476 1.76485 0.169643 1.65175L1.65179 0.169607C1.76488 0.0565119 1.89881 -3.52859e-05 2.05357 -3.52859e-05C2.20833 -3.52859e-05 2.34226 0.0565119 2.45536 0.169607L9.08036 6.79461C9.19345 6.9077 9.25 7.04163 9.25 7.19639C9.25 7.35116 9.19345 7.48508 9.08036 7.59818Z" fill="#0000E7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <button class="btn btn-secondary custom-btn mx-auto d-block">
        Join Now
        <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
        </svg>
    </button>
</section>
<div class="special-design" style="height: 100px;">
    <hr/>
    <img src="{{ asset('new_ui/assets/images/diamond.webp') }}">
    <div class="vertical-line"></div>
</div>
<section class="testimonials">
    <h3>What our members say about us</h3>
    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="quate" src="{{ asset('new_ui/assets/images/quata.svg') }}" />
                <p class="msg">Jewellery Networking will be a great platform for building and strengthening connections and bridges the gap within the gems and jewellery industry. The platform’s dedication to creating a vibrant and interactive community is evident, and we wish them the very best in this endeavour.</p>
                <img class="quate end" src="{{ asset('new_ui/assets/images/quata.svg') }}" />
                <div class="testi-person">
                    <img src="{{ asset('new_ui/assets/images/testicon1.webp') }}" />
                    <div>
                        <h5>Vaishali Banerjee</h5>
                        <p class="mb-0">Managing Director, PGI India</p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="quate" src="{{ asset('new_ui/assets/images/quata.svg') }}" />
                <p class="msg">Jewellery Networking will be a great platform for building and strengthening connections and bridges the gap within the gems and jewellery industry. The platform’s dedication to creating a vibrant and interactive community is evident, and we wish them the very best in this endeavour.</p>
                <img class="quate end" src="{{ asset('new_ui/assets/images/quata.svg') }}" />
                <div class="testi-person">
                    <img src="{{ asset('new_ui/assets/images/testicon1.webp') }}" />
                    <div>
                        <h5>Vaishali Banerjee</h5>
                        <p class="mb-0">Managing Director, PGI India</p>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<section class="contact-us">
    <div class="special-design" style="height: 100px;">
        <hr/>
        <img src="{{ asset('new_ui/assets/images/diamond.webp') }}">
        <div class="vertical-line"></div>
    </div>
    <div class="form-box">
        <div class="form-heading">Leave us a message, and we will respond.</div>
        <div class="contact-form-area">
            <div class="area-left">
                <form class="">
                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" placeholder="Enter first name">
                        </div>
                        <div class="col-md-6 mb-1">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="first_name" placeholder="Enter last name">
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter your email">
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter your phone number">
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Country</label>
                            <input type="text" class="form-control" name="country" placeholder="Enter your country">
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label ">Company</label>
                            <input type="text" class="form-control" name="company_name" placeholder="Enter your company name">
                        </div>
                        <div class="col-md-12 mb-1">
                            <label class="form-label">Your Message</label>
                            <textarea class="form-control" name="message" rows="3" placeholder="Enter your message"></textarea>
                        </div>
                        <div class="col-md-12 mb-1">
                            <button type="submit" class="btn btn-secondary custom-btn mt-2 w-100">
                                Submit
                                <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path id="Vector" d="M38.2731 19L48.668 9.5L38.2731 -4.29463e-07L36.4817 1.63271L43.8233 8.34234L-0.000271229 8.34234L-0.000271336 10.658L43.8233 10.658L36.4817 17.3676L38.2731 19Z" fill="black"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="area-right">
                <img src="{{ asset('new_ui/assets/images/be-ceen-gold.webp') }}" class="w-100 p-5"/>
                <img src="{{ asset('new_ui/assets/images/enquiry-img.webp') }}" class="w-100"/>
            </div>
        </div>
    </div>
</section>

<!-- END: Content-->
@endsection

@section('script')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<!-- <script src="{{ asset('new_ui/assets/js/admin/customer/index.js') }}?v={{ time() }}"></script> -->
<script src="{{ asset('new_ui/assets/js/admin/custom-image-uploader.js') }}?v={{ time() }}"></script>
<script>
    // var myCarousel = document.querySelector('#carouselExampleCaptions')
    // // var carousel = new bootstrap.Carousel(myCarousel, {
    // // interval: 3000,
    // // pause: true,
    // // })
</script>
@endsection