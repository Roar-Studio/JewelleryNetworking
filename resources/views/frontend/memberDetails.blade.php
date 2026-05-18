@extends('frontend.layouts.master')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('new_ui/assets/css/profile.css') }}?v={{ time() }}">
<style>
    .custom-btn{
        font-size: 20px;
    } 
    .spinner{
        display: block;
    }
    .rating {
        direction: rtl; /* hover fill right to left (standard for ratings) */
        unicode-bidi: bidi-override;
        display: inline-block;
    }

    .rating input {
        opacity: 0;
        position: absolute;
    }

    .rating label {
        font-size: 30px;
        cursor: pointer;
        color: #000;
        position: relative;
    }

        /* Default icon — outline star */
    .rating label::before {
        content: "\f588"; /* Unicode for bi-star */
        font-family: "bootstrap-icons";
        color: #000;
        transition: color 0.2s ease-in-out, content 0.2s ease-in-out;
    }

        /* Hovered stars — filled star */
    .rating label:hover::before,
        .rating label:hover ~ label::before {
        content: "\f586"; /* Unicode for bi-star-fill */
        color: #ffca08;
    }

        /* Selected stars — stay filled */
    .rating input:checked ~ label::before {
        content: "\f586"; /* bi-star-fill */
        color: #ffca08;
    }

    .rating-fixed {
      direction: rtl;
      unicode-bidi: bidi-override;
      display: inline-block;
      /* padding-top: 80px; */
    }

    .rating-fixed input {
      opacity: 0;
      width: 2px;
    }

    .rating-fixed label {
      font-size: 30px;
      color: #ccc;
      cursor: pointer;
      color: #000;
    }

    .rating-fixed .filled {
        color: gold; /* filled (active) stars */
    }

    .rating-fixed input:checked ~ label {
      color: #ffca08;
    }
    .d-flex.social i {
        color: #c6b682;
        font-size: 25px;
    }
    .d-flex.social i:hover {
        color: #264c5a;
    }
    .directory-box h2{
        color: #000;
    }

    .file-input-wrapper {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .file-input-wrapper .form-control {
        flex: 1;
    }

    .remove-file-btn {
        display: none;
        cursor: pointer;
        color: #dc3545;
        font-size: 35px;
        line-height: 1;
        transition: color 0.3s;
        flex-shrink: 0;
    }

    .remove-file-btn:hover {
        color: #bb2d3b;
    }

    .remove-file-btn.show {
        display: block;
    }

</style>
@endsection

@section('content')
<!-- BEGIN: Content-->
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('new_ui/assets/images/profile_header.webp') }}" class="d-block w-100" alt="carousel image">
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
    <div class="col-12">
        <article class="profile-card mx-auto">
            <div class="profile-image-wrapper position-relative">
                <img
                src="{{ asset('new_ui/assets/images/dummy-user.webp') }}"
                alt="Profile picture of Prernaa Makhariaa"
                class="profile-image img-fluid"
                />
            </div>
            <section class="profile-details">
                <div class="profile-info">
                    <h2 class="profile-name"></h2>
                    <p class="profile-phone"></p>
                </div>
            </section>
        </article>
    </div>
    </div>
</div>


<section class="container profile-container mt-2">
    <!-- Personal Information Section -->

    <div class="membership-list">
        <div class="directory-box">
        </div>
        <div class="row mt-2">
            <div class="col-md-12 my-2 comment-box" style="display: none;">
                <h2 style="color: #000;font-weight: 600;">Leave a Reply</h2>
                <form id="commentForm">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter your title">
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload File</label>
                        <div class="file-input-wrapper">
                            <input type="file" class="form-control" id="file" name="comment_file">
                            <i class="remove-file-btn" id="removeFileBtn" style="font-size: 35px;">×</i>
                        </div>
                        <div class="form-text">Allowed file types: pdf, doc, docx, txt, png, jpg, jpeg, xlsx.</div>
                        <!-- <input type="file" class="form-control" id="file" name="comment_file"> -->
                    </div>
                    <button type="submit" class="btn btn-primary custom-btn">Post Comment</button>
                </form>
            </div>
            <div class="col-md-12 my-2 feedback-box" style="display: none;">
                <h2 style="color: #000;font-weight: 600;"><strong>Leave Feedback</strong></h2>
                <p>We Care About Your Experience – Share Your Thoughts</p>
                <form id="feedbackForm">
                    <div class="form-group">
                        <label class="form-label me-2">Rating:</label>
                        <div class="rating">
                        <input type="radio" id="star5" name="rating" value="5">
                        <label for="star5"></label>

                        <input type="radio" id="star4" name="rating" value="4">
                        <label for="star4"></label>

                        <input type="radio" id="star3" name="rating" value="3">
                        <label for="star3"></label>

                        <input type="radio" id="star2" name="rating" value="2">
                        <label for="star2"></label>

                        <input type="radio" id="star1" name="rating" value="1">
                        <label for="star1"></label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="feedback" class="form-label">Feedback</label>
                        <textarea class="form-control" id="feedback" rows="2" placeholder="Add feedback here..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary custom-btn">Submit Feedback</button>
                    </form>

            </div>
        </div>
    </div>
    <!-- Spinner -->
    <div class="spinner text-center my-3" style="display: none;">
        <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
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

    function fetchBasicDetails() {
        try {
            window.axiosApiClient.get('/get-basic-details', {
                headers: { 'Authorization': 'Bearer ' + getAuthToken()}
            })
            .then(function (response) {
                if(response.data.status == 'success') {
                    const customer = response.data.data;
                    var basicForm = $('#basicForm');
                    
                    $('.profile-name').text(customer.first_name + ' ' + customer.last_name);
                    $('.profile-phone').text(customer.mobile_no_cc + ' ' + customer.mobile_no);
                    $('.profile-username').text(customer.username);
                    if(customer.profile_photo) {
                        $('.profile-image').attr('src', `/storage/${customer.profile_photo}`);
                        // $('#navbarProfileImage').attr('src', customer.profile_photo);
                    }
                }
            })
            .catch(function (error) {
                console.error("Error fetching basic details:", error);
            });
            
        } catch (error) {
            console.error('Error fetching customer data:', error);
        }
    }

    function fetchMembership(id) {
        $('.spinner').show();                         // Show spinner
        

        window.axiosApiClient.get('getMember/'+id, {
            headers: { 'Authorization': 'Bearer ' + getAuthToken() }
        }).then(function (response) {
            if(response.data.status == 'success') {
                const member = response.data.data || [];
                $('.membership-list .directory-box').html(renderMemberBox(member));
                if(member.is_feedback_given) {
                    $('.feedback-box').hide(); // Hide feedback box if already given
                } else {
                    $('.feedback-box').show(); // Show feedback box if not given
                }
                $('.comment-box').show(); // Show comment box
                $('.spinner').hide();  
                
                return;
            }
        }).catch(function (error) {
            console.error('Fetch error:', error);
            $('.membership-list').html('<h1 class="text-center">No member found</h1>');

            $('.spinner').hide();
        });
    }

    function renderMemberBox(member) {

        let socialMediaLinks = renderSocialIcons(member);
        return `
        <div class="row m-0">
            <div class="col-md-3 p-0 position-relative">
                <img src="${member.company_logo ? '/storage/' + member.company_logo : '/new_ui/assets/images/directory-img.png'}" class="d-block w-100 h-100" alt="Directory image">
                <label class="position-absolute start-0 top-0 membership-chip">${member.membership_plan?.name || ''}</label>
            </div>
            <div class="col-md-6 directory-info">
                <header class="directory-header mt-1">
                    <h1 class="directory-title">${member.first_name} ${member.last_name}</h1>
                    <p class="directory-username">${member.company_name || '-'}</p>
                </header>
                <header class="directory-header">
                    <h1 class="directory-title">${member.mobile_no ? (member.mobile_no_cc + ' ' + member.mobile_no) : '-'}</h1>
                </header>
                ${socialMediaLinks}

                <div class="rating-fixed">
                    <label><i class="bi ${member.rating >= 5 ? 'bi-star-fill filled' : 'bi-star'}"></i></label>
                    <label><i class="bi ${member.rating >= 4 ? 'bi-star-fill filled' : 'bi-star'}"></i></label>
                    <label><i class="bi ${member.rating >= 3 ? 'bi-star-fill filled' : 'bi-star'}"></i></label>
                    <label><i class="bi ${member.rating >= 2 ? 'bi-star-fill filled' : 'bi-star'}"></i></label>
                    <label><i class="bi ${member.rating >= 1 ? 'bi-star-fill filled' : 'bi-star'}"></i></label>
                </div>
            </div>
            <div class="col-md-3">
                
            </div>
        </div>`;
    }

    function renderSocialIcons(member) {
        const socialIcons = [
            { key: 'facebook_link', icon: 'bi-facebook' },
            { key: 'x_link', icon: 'bi-twitter' },
            // { key: 'x_link', icon: 'bi-twitter' }, // use your preferred custom class
            { key: 'linkedin_link', icon: 'bi-linkedin' },
            { key: 'youtube_link', icon: 'bi-youtube' },
            { key: 'instagram_link', icon: 'bi-instagram' },
        ];

        let html = '<div class="d-flex social">';

        socialIcons.forEach(item => {
            const link = member[item.key];
            if (link) {
                html += `<a href="${link}" target="_blank" class="me-2"><i class="bi ${item.icon}"></i></a>`;
            }
        });

        html += '</div>';
        return html;
    }



    $(document).ready(function () {

        fetchBasicDetails(); // Fetch basic details on page load
        fetchMembership({{ $id }});
        // Initial fetch
        $('#feedbackForm').validate({
            rules: {
                rating: {
                    required: true
                }
            },
            messages: {
                rating: {
                    required: "Please rate our service."
                }
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                if (element.attr("name") === "rating") {
                    error.insertAfter(".rating");
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                
                let payload = {
                    member_id: "{{ $id }}",
                    rating: $('input[name="rating"]:checked').val(),
                    feedback: $('#feedback').val()
                }

                window.axiosApiClient.post('/submit-feedback', payload, {
                    headers: { 'Authorization': 'Bearer ' + getAuthToken() }
                }).then(function (response) {
                    if(response.data.status == 'success') {
                        toastr.success('Feedback submitted successfully!');
                        $('#feedbackForm')[0].reset();
                        $('.feedback-box').hide(); // Hide feedback box after submission
                        setTimeout(() => {
                            window.location.reload();
                        }, 1200);
                    }
                }).catch(function (error) {
                    console.error('Error submitting feedback:', error);
                });
            }
        });

        $('#commentForm').validate({
            rules: {
                title: {
                    required: true
                },
                comment: {
                    required: true
                }
            },
            messages: {
                title: {
                    required: "Please enter a title."
                },
                comment: {
                    required: "Please enter a comment."
                }
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            },
            /* submitHandler: async function (form, event) {
                event.preventDefault();
                const fileInput = $(form).find("[name=comment_file]")[0];
                let fileBase64 = null;

                if (fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    const allowedTypes = [
                        'application/pdf', 
                        'application/msword', 
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 
                        'text/plain', 
                        'image/png', 
                        'image/jpeg', 
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    ];

                    if (!allowedTypes.includes(file.type)) {
                        toastr.error('Invalid file type. Allowed: pdf, doc, docx, txt, png, jpg, jpeg, xlsx.');
                        return;
                    }

                    // Optional: limit file size (e.g., 5MB)
                    if (file.size > 5 * 1024 * 1024) {
                        toastr.error('File size exceeds 5MB limit.');
                        return;
                    }

                    fileBase64 = await getBase64(file);
                }

                let payload = {
                    member_id: "{{ $id }}",
                    title: $('#title').val(),
                    comment: $('#comment').val(),
                    file: fileBase64
                }

                window.axiosApiClient.post('/submit-comment', payload, {
                    headers: { 
                        'Authorization': 'Bearer ' + getAuthToken(),
                    }
                }).then(function (response) {
                    if(response.data.status == 'success') {
                        toastr.success('Comment submitted successfully!');
                        $('#commentForm')[0].reset();
                        // Hide the remove file icon after reset
                        $('#removeFileBtn').removeClass('show');
                    }
                }).catch(function (error) {
                    console.error('Error submitting comment:', error);
                    toastr.error('Something went wrong while submitting comment.');
                });
            } */
           submitHandler: function (form, event) {

                event.preventDefault();

                let formData = new FormData();

                /*
                ===========================
                ADD TEXT FIELDS
                ===========================
                */

                formData.append('member_id', "{{ $id }}");
                formData.append('title', $('#title').val());
                formData.append('comment', $('#comment').val());



                /*
                ===========================
                FILE VALIDATION
                ===========================
                */

                const fileInput =
                    $(form).find("[name=comment_file]")[0];

                if (fileInput.files.length > 0) {

                    const file = fileInput.files[0];

                    const allowedTypes = [
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'text/plain',
                        'image/png',
                        'image/jpeg',
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    ];

                    if (!allowedTypes.includes(file.type)) {

                        toastr.error(
                            'Invalid file type. Allowed: pdf, doc, docx, txt, png, jpg, jpeg, xlsx.'
                        );

                        return;
                    }

                    if (file.size > 5 * 1024 * 1024) {

                        toastr.error(
                            'File size exceeds 5MB limit.'
                        );

                        return;
                    }

                    /*
                    APPEND FILE
                    */

                    formData.append(
                        'file',
                        file
                    );
                }



                /*
                ===========================
                API CALL
                ===========================
                */

                window.axiosApiClient.post(
                    '/submit-comment',
                    formData,
                    {
                        headers: {
                            'Authorization': 'Bearer ' + getAuthToken(),
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function (response) {

                    if (response.data.status == 'success') {

                        toastr.success(
                            'Comment submitted successfully!'
                        );

                        $('#commentForm')[0].reset();

                        $('#removeFileBtn')
                            .removeClass('show');
                    }

                }).catch(function (error) {

                    console.error(
                        'Error submitting comment:',
                        error
                    );

                    toastr.error(
                        'Something went wrong while submitting comment.'
                    );

                });

            }
        });

    });
</script>


<script>
    const fileInput = document.getElementById('file');
    const removeBtn = document.getElementById('removeFileBtn');

    fileInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            removeBtn.classList.add('show');
        } else {
            removeBtn.classList.remove('show');
        }
    });

    removeBtn.addEventListener('click', function() {
        fileInput.value = '';
        removeBtn.classList.remove('show');
    });
</script>


@endsection