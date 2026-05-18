(function (window, undefined) {
    'use strict';

    window.addEventListener('load', function () {
        $(".mobile").each(function(){
            window.intlTelInput(this, {
                initialCountry: "in", // Default country (India)
                separateDialCode: true, // Show country code separately
                preferredCountries: ["us", "gb", "in"]
            });
        });

    });

    function fetchBasicDetails() {
        try {
            window.axiosApiClient.get('/get-basic-details', {
                headers: { 'Authorization': 'Bearer ' + getAuthToken()}
            })
            .then(function (response) {
                if(response.data.status == 'success') {
                    const customer = response.data.data;
                    var basicForm = $('#basicForm');
                    
                    var mobileInput = basicForm.find('input[name="mobile_no"]')[0];
                    var iti = window.intlTelInputGlobals.getInstance(mobileInput);
                    if (iti) {
                        iti.setCountry(customer.mobile_no_ic || 'in');
                    }
                    basicForm.find('input[name="first_name"]').val(customer.first_name);
                    basicForm.find('input[name="last_name"]').val(customer.last_name);
                    basicForm.find('input[name="email"]').val(customer.email);
                    basicForm.find('input[name="mobile_no"]').val(customer.mobile_no);
                    basicForm.find('input[name="username"]').val(customer.username);
                    $('.profile-name').text(customer.first_name + ' ' + customer.last_name);
                    $('.profile-phone').text(customer.mobile_no_cc + ' ' + customer.mobile_no);
                    $('.profile-username').text(customer.username);
                    $('.profile-membership-id').text(customer.membership_id);
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

    function fetchCompanyDetails() {
        try {
            window.axiosApiClient.get('/get-company-details', {
                headers: { 'Authorization': 'Bearer ' + getAuthToken()}
            })
            .then(function (response) {
                if(response.data.status == 'success') {
                    const customer = response.data.data;
                    var companyForm = $('#companyForm');
                    
                    companyForm.find('input[name="company_name"]').val(customer.company_name);
                    companyForm.find('input[name="company_address"]').val(customer.company_address);
                    companyForm.find('input[name="google_map_link"]').val(customer.google_map_link);
                    companyForm.find('input[name="business_description"]').val(customer.business_description);
                    companyForm.find('input[name="trn_no"]').val(customer.trn_no);
                    companyForm.find('[name="category_id"]').val(customer.category_id).trigger('change');
                    companyForm.find('input[name="specialization"]').val(customer.specialization);
                    companyForm.find('input[name="linkedin_link"]').val(customer.linkedin_link);
                    companyForm.find('input[name="facebook_link"]').val(customer.facebook_link);
                    companyForm.find('input[name="instagram_link"]').val(customer.instagram_link);
                    companyForm.find('input[name="x_link"]').val(customer.x_link);
                    companyForm.find('input[name="youtube_link"]').val(customer.youtube_link);
                    companyForm.find('input[name="website"]').val(customer.website);
                    
                    if(customer.company_logo){
                        const companyLogoInput = companyForm.find('[name="company_logo"]').closest('.upload-box').get(0);
                        if (companyLogoInput && typeof companyLogoInput.setImage === 'function') {
                            companyLogoInput.setImage(customer.company_logo);
                        }
                    }

                    // Clear existing media upload boxes
                    const mediaWrapper = companyForm.find('.media-wrapper').get(0);
                    mediaWrapper.innerHTML = '';

                    // Add medias from event
                    const medias = customer.media_images || [];
                    medias.forEach((media) => {
                        const newmediaBox = createUploadBox('media[]', 'removeMediaImg', media.id);
                        mediaWrapper.appendChild(newmediaBox);
                        newmediaBox.setImage?.(media.image);
                    });

                    $('.media-wrapper').find('input[type="file"]').prop('disabled', true).attr('readonly', true); // Disable file input

                    if(customer.company_video) {
                        const videoWrapper = companyForm.find('.company_video-wrapper').get(0);
                        const videoInput = videoWrapper.querySelector("input[name='company_video']");
                        const videoTag = videoWrapper.querySelector(".upload-video-trigger");
                        const placeholderImg = videoWrapper.querySelector(".upload-placeholder");
                        const removeBtn = videoWrapper.querySelector(".remove-video-btn");

                        if (videoInput && videoTag) {
                            videoInput.value = ''; // Clear input
                            videoTag.src = `storage/${customer.company_video}`; // Set new source
                            videoTag.style.display = 'block'; // Show the video tag
                            placeholderImg.style.display = 'none'; // Hide placeholder
                            removeBtn.style.display = 'block'; // Show remove button
                        }
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

    function fetchSubscriptionDetails() {
        try {
            window.axiosApiClient.get('/get-subscription-details', {
                headers: { 'Authorization': 'Bearer ' + getAuthToken()}
            })
            .then(function (response) {
                if(response.data.status == 'success') {                    
                    $("#subscriptionForm").show();
                    const subscription = response.data.data;
                    let subscriptionForm = $('#subscriptionForm');
                    subscriptionForm.find('input[name="plan_name"]').val(subscription.membership_plan.name + ' plan');
                    $(".plan_name").text(subscription.membership_plan.name + ' plan');
                    subscriptionForm.find('input[name="valid_upto"]').val(subscription.plan_expired_at ? moment(subscription.plan_expired_at).format('DD-MM-YYYY') : 'N/A');
                    subscriptionForm.find('input[name="amount"]').val(subscription.mobile_no_ic == 'IN' ? convertCurrency(subscription.membership_plan.amount_in_inr, 'INR', 2) : convertCurrency(subscription.membership_plan.amount_in_usd, 'USD', 2));
                    if (subscription.plan_expired_at && moment(subscription.plan_expired_at).isBefore(moment())) {
                        subscriptionForm.find('.plan_status').html('<span class="badge rounded-pill bg-danger">Expired</span>');
                    } else {
                        subscriptionForm.find('.plan_status').html('<span class="badge rounded-pill bg-success">Active</span>');
                    }
                    if (subscription.plan_type == 3) {
                        $('.upgrade-plan-btn').hide();
                    } else if (
                        subscription.plan_type < 3 &&
                        subscription.plan_expired_at &&
                        moment(subscription.plan_expired_at).isBefore(moment().add(30, 'days'))
                    ) {
                        $('.upgrade-plan-btn').show();
                    } else {
                        //$('.upgrade-plan-btn').hide(); // Optional: hide by default for clarity
                    }
                    subscriptionForm.find('.benefits').html(subscription.membership_plan.benefits);   
                }
            })
            .catch(function (error) {
                console.error("Error fetching subscription details:", error);
            });
            
        } catch (error) {
            console.error('Error fetching subscription data:', error);
        }
    }

    function fetchTransactionDetails() {
        try {
            window.axiosApiClient.get('/get-transaction-details', {
                headers: { 'Authorization': 'Bearer ' + getAuthToken() }
            })
            .then(function (response) {
                let transactionTable = $('#transactionTable tbody');
                transactionTable.empty();
                if (response.data.status === 'success') {
                    const transactions = response.data.data;

                    if (transactions.length > 0) {
                        transactions.forEach(function (transaction) {
                            let orderId = transaction.order_id || 'N/A';
                            
                            let invoiceLink = '';

                            if (transaction.status == 'completed' && transaction.order_id) {
                                invoiceLink = `<a href="/invoice/${transaction.order_id}" target="_blank">Download</a>`;
                            }
                            let transactionDate = moment(transaction.transaction_date).format('DD-MM-YYYY');
                            let amount = transaction.total_amount ? convertCurrency(transaction.total_amount, transaction.currency_type, 2) : 'N/A';
                            let statusClass = transaction.status === 'completed' ? 'success' : 'danger';

                            let row = `<tr>
                                <td>${orderId}</td>
                                <td>${invoiceLink}</td>
                                <td>${transactionDate}</td>
                                <td>${amount}</td>
                                <td><span class="badge rounded-pill bg-${statusClass}">${transaction.status}</span></td>
                            </tr>`;

                            transactionTable.append(row);
                        });
                    } else {
                        transactionTable.append('<tr><td colspan="5">No transactions found.</td></tr>');
                    }
                }
                else{
                    transactionTable.append('<tr><td colspan="5">No transactions found.</td></tr>');
                }
            })
            .catch(function (error) {
                console.error("Error fetching transaction history:", error);
            });
        } catch (error) {
            console.error('Error fetching transaction history:', error);
        }
    }

    
    $(document).ready(function () {
        fetchBasicDetails();
        fetchCompanyDetails();
        fetchSubscriptionDetails();
        fetchTransactionDetails();
        
        $('.edit-link').on('click', function () {
            const $editLink = $(this);
            $editLink.prop('disabled', true); // Disable the edit button

            const $accordionBody = $editLink.closest('.accordion-body');
            const $form = $accordionBody.find('form');

            // Check which form it is
            if ($form.attr('id') === 'basicForm') {
                // Enable all fields except mobile_no, email, username
                $form.find('input').each(function () {
                    const name = $(this).attr('name');
                    if (name !== 'mobile_no' && name !== 'email' && name !== 'username') {
                        $(this).prop('readonly', false).prop('disabled', false);
                    } else {
                        $(this).prop('readonly', true).prop('disabled', true);
                    }
                });
            } else if ($form.attr('id') === 'companyForm') {
                // Enable all inputs and selects
                $form.find('input, select').each(function () {
                    $(this).prop('readonly', false).prop('disabled', false);
                });
                $('.addmediaBtn').show();
            }
            

            // Show submit and cancel buttons
            $form.find('button[type="submit"], .cancel-btn').show();
        });


        $('.cancel-btn').on('click', function () {
            const $cancelBtn = $(this);
            $cancelBtn.hide();
            const $accordionBody = $cancelBtn.closest('.accordion-body');
            const $form = $accordionBody.find('form');
            $form.find('input, select, textarea').each(function () {
                const $el = $(this);
                $el.attr('readonly', true).prop('disabled', true);

                // Handle select2 separately
                if ($el.hasClass('select2-hidden-accessible')) {
                    $el.prop("disabled", true).trigger("change.select2"); // For Select2 v4+
                }

            });
            $form.find('button[type="submit"]').hide(); // Hide the submit button
            $form.find('.addmediaBtn').hide();
            $form.find('label.error, span.error, .invalid-feedback').remove(); // remove 
            $form.find('.error').removeClass('error');
            $accordionBody.find('.edit-link').prop('disabled', false);
        });
        
        // jQuery Validation Rules
        $('#basicForm').validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 3
                },
                last_name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                mobile_no: {
                    required: true,
                    digits: true,
                    minlength: 8,
                    maxlength: 15
                },
                username: {
                    required: true
                },
            },
            messages: {
                first_name: {
                    required: "Please enter your first name",
                    minlength: "First name must be at least 3 characters long"
                },
                last_name: {
                    required: "Please enter your last name",
                    minlength: "Last name must be at least 3 characters long"
                },
                email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email"
                },
                mobile_no: {
                    required: "Please enter your mobile number",
                    digits: "Please enter a valid mobile number",
                    minlength: "Mobile number must be at least 8 digits long",
                    maxlength: "Mobile number must not exceed 15 digits"
                },
                username: {
                    required: "Please enter your username"
                },
                
            },
            submitHandler: function (form) {

                
                event.preventDefault();
                $(form).find('button[type="submit"]').attr('disabled', 'disabled');
                // Gather form data
                let countryCode = null;
                let isoCode = null;
                $(form).find(".mobile").each(function () {
                    const $input = $(this);
                    const fieldName = $input.attr("name");
                
                    // Skip if no name or irrelevant name
                    if (!fieldName || (!fieldName.includes("mobile") && !fieldName.includes("contact"))) {
                        return;
                    }
                
                    // Get intlTelInput instance
                    const itiInstance = window.intlTelInputGlobals.getInstance(this);
                    if (!itiInstance) return;
                
                    countryCode = `+${itiInstance.getSelectedCountryData().dialCode}`;
                    isoCode = itiInstance.getSelectedCountryData().iso2.toUpperCase();
                
                });

                const payload = {
                    first_name: $('input[name="first_name"]').val(),
                    last_name: $('input[name="last_name"]').val(), // Fix: Ensure you change name attribute for last name in HTML
                    email: $('input[name="email"]').val(),
                    mobile_no: $(form).find("[name=mobile_no]").val(),
                    mobile_no_cc: countryCode,
                    mobile_no_ic: isoCode,
                };

                // Submit via Axios
                window.axiosApiClient.post('/update-basic-details', payload,{
                    headers: { 'Authorization': 'Bearer ' + getAuthToken() }
                })
                .then(function (response) {
                    if (response.data.status === 'success') {
                        toastr.success(response.data.message, 'Success');

                        $(form).find('button[type="submit"]').removeAttr('disabled');
                        
                        const $accordionBody = $(form).closest('.accordion-body');
                        const $form = $accordionBody.find('form');
                        $form.find('input, select, textarea').each(function () {
                            $(this).attr('readonly', true).prop('disabled', true);

                            // Handle select2 separately
                            if ($(this).hasClass('select2-hidden-accessible')) {
                                $(this).prop("disabled", true).trigger("change.select2"); // For Select2 v4+
                            }
                        });
                        $form.find('button[type="submit"]').hide(); // Hide the submit button
                        $form.find('.cancel-btn').hide(); // Hide the cancel button
                        $accordionBody.find('.edit-link').prop('disabled', false);
                    }
                })
                .catch(function (error) {
                    console.error("Submission error:", error);
                });
            }
        });

        $('#companyForm').validate({
            rules: {
                company_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 50,
                    alphanumeric: true
                },
                category_id: {
                    required: true
                },
                company_address: {
                    required: true,
                    maxlength: 200
                },
                trn_no: {
                    maxlength: 15,
                    alphanumeric: true
                },
                google_map_link: {
                    url: true
                },
                specialization: {
                    maxlength: 100
                },
                business_description: {
                    maxlength: 500
                },
                website: {
                    url: true
                },
                linkedin_link: {
                    url: true
                },
                instagram_link: {
                    url: true
                },
                facebook_link: {
                    url: true
                },
                x_link: {
                    url: true
                },
                youtube_link: {
                    url: true
                },
                company_logo: {
                    accept: "image/jpeg,image/png,image/gif,image/webp",
                    fileSize: 2048, // 2MB
                },
                'media[]': {
                    accept: "image/jpeg,image/png,image/gif,image/webp",
                    fileSize: 2048, // 2MB
                },
                company_video: {
                    accept: "video/mp4,video/webm,video/ogg",
                    fileSize: 5 * 1024 // 5MB
                }
            },
            messages: {
                company_name: {
                    required: "Please enter your company name",
                    minlength: "Company name must be at least 3 characters long",
                    maxlength: "Company name must not exceed 50 characters",
                    alphanumeric: "Company name can only contain letters, numbers, and spaces"
                },
                category_id: {
                    required: "Please select a category"
                },
                company_address: {
                    required: "Please enter your company address",
                    maxlength: "Company address must not exceed 200 characters"
                },
                trn_no: {
                    maxlength: "Tax id must not exceed 15 characters",
                    alphanumeric: "Tax id can only contain letters and numbers"
                },
                google_map_link: {
                    url: "Please enter a valid URL"
                },
                specialization: {
                    maxlength: "Specialization must not exceed 100 characters"
                },
                business_description: {
                    maxlength: "Business description must not exceed 500 characters"
                },
                website: {
                    url: "Please enter a valid URL"
                },
                linkedin_link: {
                    url: "Please enter a valid URL"
                },
                instagram_link: {
                    url: "Please enter a valid URL"
                },
                facebook_link: {
                    url: "Please enter a valid URL"
                },
                x_link: {
                    url: "Please enter a valid URL"
                },
                youtube_link: {
                    url: "Please enter a valid URL"
                },
                company_logo: {
                    accept: "Please upload a valid image file (JPEG, PNG, GIF, WEBP)",
                    fileSize: "Company logo must be less than 2MB"
                },
                'media[]': {
                    accept: "Please upload a valid image file (JPEG, PNG, GIF, WEBP)",
                    fileSize: "Media image must be less than 2MB"
                },
                company_video: {
                    accept: "Please upload a valid video file (MP4, WEBM, OGG)",
                    fileSize: "Company video must be less than 5MB"
                }
            },
            submitHandler: async function (form, event) {
                event.preventDefault();

                const $submitBtn = $(form).find('button[type="submit"]');
                $submitBtn.attr('disabled', 'disabled');

                try {
                    // Show loading indicator
                    toastr.info('Uploading... Please wait', 'Processing');

                    // FormData approach (RECOMMENDED - Better for large files)
                    const formData = new FormData();
                    
                    // Add text fields
                    formData.append('company_name', $('input[name="company_name"]').val());
                    formData.append('category_id', $('select[name="category_id"]').val());
                    formData.append('company_address', $('input[name="company_address"]').val());
                    formData.append('trn_no', $('input[name="trn_no"]').val() || '');
                    formData.append('google_map_link', $('input[name="google_map_link"]').val() || '');
                    formData.append('business_description', $('input[name="business_description"]').val() || '');
                    formData.append('specialization', $('input[name="specialization"]').val() || '');
                    formData.append('linkedin_link', $('input[name="linkedin_link"]').val() || '');
                    formData.append('facebook_link', $('input[name="facebook_link"]').val() || '');
                    formData.append('instagram_link', $('input[name="instagram_link"]').val() || '');
                    formData.append('x_link', $('input[name="x_link"]').val() || '');
                    formData.append('youtube_link', $('input[name="youtube_link"]').val() || '');
                    formData.append('website', $('input[name="website"]').val() || '');

                    // Add company logo
                    const companyLogoInput = $(form).find("[name=company_logo]")[0];
                    if (companyLogoInput.files.length > 0) {
                        formData.append('company_logo', companyLogoInput.files[0]);
                    }

                    // Add media images
                    const mediaInputs = $(form).find("[name='media[]']");
                    for (let i = 0; i < mediaInputs.length; i++) {
                        if (mediaInputs[i].files.length > 0) {
                            formData.append('media_images[]', mediaInputs[i].files[0]);
                        }
                    }

                    // Add company video
                    const videoInput = $(form).find("input[name='company_video']")[0];
                    if (videoInput.files.length > 0) {
                        formData.append('company_video', videoInput.files[0]);
                    }

                    // Submit with longer timeout and progress tracking
                    const response = await window.axiosApiClient.post('/update-company-details', formData, {
                        headers: { 
                            'Authorization': 'Bearer ' + getAuthToken(),
                            'Content-Type': 'multipart/form-data'
                        },
                        timeout: 120000, // 2 minutes timeout
                        onUploadProgress: function(progressEvent) {
                            const percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                            console.log('Upload Progress: ' + percentCompleted + '%');
                            // You can show a progress bar here
                        }
                    });

                    if (response.data.status === 'success') {
                        toastr.success(response.data.message, 'Success');

                        $submitBtn.removeAttr('disabled');
                        
                        const $accordionBody = $(form).closest('.accordion-body');
                        const $formElement = $accordionBody.find('form');
                        $formElement.find('input, select, textarea').each(function () {
                            $(this).attr('readonly', true).prop('disabled', true);
                        });
                        $formElement.find('button[type="submit"]').hide();
                        $formElement.find('.addmediaBtn').hide();
                        $formElement.find('.cancel-btn').hide();
                        $accordionBody.find('.edit-link').prop('disabled', false);
                    }

                } catch (error) {
                    console.error("Submission error:", error);
                    
                    $submitBtn.removeAttr('disabled');
                    
                    if (error.response) {
                        toastr.error(error.response.data.message || 'Upload failed', 'Error');
                    } else if (error.request) {
                        toastr.error('Network error. Please check your connection.', 'Error');
                    } else {
                        toastr.error('An error occurred. Please try again.', 'Error');
                    }
                }
            }
        });

        $('#resetPasswordForm').validate({
            rules: {
                old_password: {
                    required: true,
                    minlength: 8
                },
                password: {
                    required: true,
                    minlength: 8,
                    strongPassword: true, // Custom rule for strong password
                },
                confirm_password: {
                    required: true,
                    minlength: 8,
                    equalTo: '[name="password"]'
                }
            },
            messages: {
                old_password: {
                    required: "Please enter your old password",
                    minlength: "Old password must be at least 8 characters long"
                },
                password: {
                    required: "Please enter a new password",
                    minlength: "New password must be at least 8 characters long",
                    strongPassword: "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character"
                },
                confirm_password: {
                    required: "Please confirm your new password",
                    minlength: "Confirm password must be at least 8 characters long",
                    equalTo: "Passwords do not match"
                }
            },
            submitHandler: function (form) {
                $(form).find('button[type="submit"]').attr('disabled', 'disabled');

                const payload = {
                    old_password: $('input[name="old_password"]').val(),
                    password: $('input[name="password"]').val(),
                    confirm_password: $('input[name="confirm_password"]').val()
                };

                // Submit via Axios
                window.axiosApiClient.post('/update-password', payload,{
                    headers: { 'Authorization': 'Bearer ' + getAuthToken() }
                })
                .then(function (response) {
                    if (response.data.status) {
                        toastr.success(response.data.message, 'Success');
                        form.reset();
                        $('#changePasswordModal').modal('hide');
                    } else {
                        toastr.error(response.data.message, 'Error');
                    }
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                })
                .catch(function (error) {
                    console.error("Submission error:", error);
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                });
            }
        });

        $(document).on('click', '.upgrade-btn', function() {
            const planId = $(this).data('plan-id');
            const user = localStorage.getItem('userData');
            let decodedUser = null;

            if(user){
                decodedUser = decodeBase64Unicode(user);
            }
            else{
                toastr.error('Please login to upgrade your membership.');
                setTimeout(() => {
                    window.location.href = '/login?point=m';
                }, 2000);
                return;
            }

            if(decodedUser && decodedUser.plan_type == planId) {
                toastr.info('You are already subscribed to this plan.', 'Information');
                return;
            }
            window.location.href =`order-summary?product_type=membership&membership_id=${planId}`
            
        });

        $('[name=username]').on('keyup', function () {
            let $this = $(this);
            let userName = $this.val();
        
            if (userName.length >= 3) {
                const payload = {
                    username: userName,
                };
        
                // loadingBlock();
        
                window.axiosApiClient.post('/check-valid-username', payload, {
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken()
                    }
                }).then(response => {
                    if (response.data?.status) {
                        $this.removeClass('is-invalid').addClass('is-valid');
                        $('.username_feedback').text(response.data?.message).addClass('valid-feedback').removeClass('invalid-feedback');
                    } else {
                        $this.removeClass('is-valid').addClass('is-invalid');
                        $('.username_feedback').text(response.data?.message).addClass('invalid-feedback').removeClass('valid-feedback');
                    }
                });
            } else {
                $this.removeClass('is-valid is-invalid'); // Clear validation if less than 3 chars
            }
        });

        $('#changeProfileImageForm').on('change', 'input[name="profile_photo"]', function () {
            const file = this.files[0];
            const preview = $('#profileImagePreview');
            const errorEl = $('#fileError');

            errorEl.addClass('d-none').text('');
            preview.attr('src', '/default-profile.png');
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];

            if (file) {    
                if (!allowedTypes.includes(file.type)) {
                    toastr.error('File type must be jpeg,jpg,png');
                    this.value = ''; // Reset the input so invalid files aren't sent
                }             
            if (!file.type.startsWith('image/')) {
                errorEl.removeClass('d-none').text('Only image files are allowed.');
                $(this).val('');
                return;
            }

            if (file.size > 2 * 1024 * 1024) { // 2MB max
                errorEl.removeClass('d-none').text('Image must be less than 2MB.');
                $(this).val('');
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                preview.attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
            }
        });

        /* $('#changeProfileImageForm').on('submit', async function (e) {
            e.preventDefault();
            const form = this;
            const input = $(form).find('[name="profile_photo"]')[0];
            const errorEl = $('#fileError');

            if (input.files.length === 0) {
            errorEl.removeClass('d-none').text('Please select an image.');
            return;
            }

            try {
            const profilePhotoBase64 = await getBase64(input.files[0]);

            const payload = {
                profile_photo: profilePhotoBase64
            };

            // Optional: disable button
            $(form).find('button[type="submit"]').attr('disabled', true);

            const response = await window.axiosApiClient.post('/update-profile-image', payload, {
                headers: { 'Authorization': 'Bearer ' + getAuthToken() }
            });

            if (response.data.status === 'success') {
                toastr.success(response.data.message || 'Image updated successfully');
                $('.profile-image').attr('src', profilePhotoBase64);
                $('#changeProfileImageModal').modal('hide');
                // Optionally update the profile image on page
                $('#navbarProfileImage').attr('src', profilePhotoBase64);
            } else {
                toastr.error(response.data.message || 'Upload failed');
            }
            } catch (error) {
            toastr.error('Something went wrong');
            console.error(error);
            } finally {
            $(form).find('button[type="submit"]').removeAttr('disabled');
            }
        }); */
        $('#changeProfileImageForm').on('submit', async function (e) {

            e.preventDefault();

            const form = this;

            const input =
                $(form).find('[name="profile_photo"]')[0];

            const errorEl = $('#fileError');


            /*
            ===============================
            FILE VALIDATION
            ===============================
            */

            if (input.files.length === 0) {

                errorEl
                    .removeClass('d-none')
                    .text('Please select an image.');

                return;
            }

            const file = input.files[0];

            const allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/gif',
                'image/webp'
            ];

            if (!allowedTypes.includes(file.type)) {

                errorEl
                    .removeClass('d-none')
                    .text('Only JPEG, PNG, GIF, WEBP allowed.');

                return;
            }

            if (file.size > 2 * 1024 * 1024) {

                errorEl
                    .removeClass('d-none')
                    .text('Image must be less than 2MB.');

                return;
            }

            errorEl.addClass('d-none');


            /*
            ===============================
            PREPARE FORMDATA
            ===============================
            */

            let formData = new FormData();

            formData.append(
                'profile_photo',
                file
            );


            try {

                $(form)
                    .find('button[type="submit"]')
                    .attr('disabled', true);


                const response =
                    await window.axiosApiClient.post(
                        '/update-profile-image',
                        formData,
                        {
                            headers: {
                                'Authorization':
                                    'Bearer ' +
                                    getAuthToken(),

                                'Content-Type':
                                    'multipart/form-data'
                            }
                        }
                    );


                if (response.data.status === 'success') {

                    toastr.success(
                        response.data.message ||
                        'Image updated successfully'
                    );


                    /*
                    UPDATE IMAGE PREVIEW
                    */

                    const previewURL =
                        URL.createObjectURL(file);

                    $('.profile-image')
                        .attr('src', previewURL);

                    $('#navbarProfileImage')
                        .attr('src', previewURL);

                    $('#changeProfileImageModal')
                        .modal('hide');

                } else {

                    toastr.error(
                        response.data.message ||
                        'Upload failed'
                    );
                }

            }

            catch (error) {

                toastr.error(
                    'Something went wrong'
                );

                console.error(error);
            }

            finally {

                $(form)
                    .find('button[type="submit"]')
                    .removeAttr('disabled');
            }

        });

        document.querySelectorAll('.addmediaBtn').forEach(button => {
            button.addEventListener('click', (e) => {
                const form = button.closest('form');
                const wrapper = form.querySelector('.media-wrapper');
                if (wrapper) {
                    const uploadBoxes = wrapper.querySelectorAll('.upload-box');
                    if (uploadBoxes.length < 5) {
                        const newBox = createUploadBox('media[]');
                        wrapper.appendChild(newBox);
                    } else {
                        toastr.error('You can upload a maximum of 5 images.', 'error!');
                    }
                }
            });
        });

        $('body').on('click', '.removeMediaImg',function(){
            let id  = $(this).data('id');
            if(id != 0){
                loadingBlock();
                window.axiosApiClient.post(`/media/remove/${id}`,{},{
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken()
                    }
                }).then(response => {
                    if (response.data.status) {
                        toastr.success('Media Image deleted successfully.', 'Success!');
                        $(this).removeClass('removeMediaImg');
                    }
                });
            }
        });
        $('body').on('click', '.remove-image-btn, .remove-video-btn',function(){
            let $uploadBox = $(this).closest('.upload-box');
            let type = $uploadBox.data('name');
            let file = $uploadBox.find('input[type=file]').val();

            if (!file || file.length === 0) {
                loadingBlock();
                window.axiosApiClient.post(`/removeUploaded`,{type: type},{
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken()
                    }
                }).then(response => {
                    if (response.data.status) {
                        toastr.success('Image deleted successfully.', 'Success!');
                    }
                });
            }
        });
        
        const $videoWrapper = $('.company_video-wrapper');
        const videoInput = $videoWrapper.find("input[name='company_video']");
        const videoTag = $videoWrapper.find(".upload-video-trigger");
        const placeholderImg = $videoWrapper.find(".upload-placeholder");
        const removeBtn = $videoWrapper.find(".remove-video-btn");

        videoInput.on("change", function () {
            const file = this.files[0];

            if (file && file.type.startsWith("video/")) {
                const videoURL = URL.createObjectURL(file);
                videoTag.attr("src", videoURL).show();
                placeholderImg.hide();
                removeBtn.show();
            } else {
                videoTag.hide();
                placeholderImg.show();
                removeBtn.hide();
            }
        });

        removeBtn.on("click", function () {
            videoInput.val('');
            videoTag.attr("src", "").hide();
            placeholderImg.show();
            removeBtn.hide();
        });

    });


})(window);
