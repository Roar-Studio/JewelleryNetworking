(function (window, undefined) {
    'use strict';
    
    $(document).ready(function () {
        // jQuery Validation Rules
        $('#contactForm').validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 2
                },
                last_name: {
                    required: true,
                    minlength: 2
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    digits: true,
                    minlength: 8,
                    maxlength: 15
                },
                country: {
                    // required: true
                },
                company_name: {
                    // required: true
                },
                message: {
                    // required: true,
                    maxlength: 250
                },
                captcha: { required: true },
            },
            messages: {
                first_name: {
                    required: "Please enter your first name",
                    minlength: "First name must be at least 2 characters long"
                },
                last_name: {
                    required: "Please enter your last name",
                    minlength: "Last name must be at least 2 characters long"
                },
                email: {
                    required: "Please enter your email",
                    email: "Please enter a valid email"
                },
                phone: {
                    required: "Please enter your phone number",
                    digits: "Only numbers are allowed",
                    minlength: "Phone number is too short",
                    maxlength: "Phone number is too long"
                },
                country: {
                    // required: "Please enter your country"
                },
                company_name: {
                    // required: "Please enter your company name"
                },
                message: {
                    // required: "Please enter your message",
                    // minlength: "Message should be at least 10 characters"
                    maxlength: "Maximum message length is 250 characters."
                },
                captcha: { required: "Please enter the CAPTCHA code" },
            },
            submitHandler: function (form) {
                // Gather form data
                $(form).find('button[type="submit"]').attr('disabled', 'disabled').text('Submitting...');

                const payload = {
                    first_name: $(form).find('input[name="first_name"]').val(),
                    last_name: $(form).find('input[name="last_name"]').val(), // Fix: Ensure you change name attribute for last name in HTML
                    email: $(form).find('input[name="email"]').val(),
                    phone: $(form).find('input[name="phone"]').val(),
                    country: $(form).find('input[name="country"]').val(),
                    company_name: $(form).find('input[name="company_name"]').val(),
                    message: $(form).find('textarea[name="message"]').val(),
                    captcha: $(form).find('input[name="captcha"]').val()
                };

                // Submit via Axios
                window.axiosApiClient.post('/add-enquiry', payload, {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                .then(function (response) {
                    toastr.success("Your enquiry has been submitted successfully!");

                    // Reset form fields
                    $('#contactForm')[0].reset();

                    // Clear validation errors if any
                    $('#contactForm').validate().resetForm();
                    $(form).find('.captchaImg').attr('src', '/captcha/default?' + Math.random());
                    $(form).find('button[type="submit"]').removeAttr('disabled').text('Submit');

                })
                .catch(function (error) {
                    $(form).find('button[type="submit"]').removeAttr('disabled').text('Submit');
                    console.error("Submission error:", error);
                    // toastr.error(err.response?.data?.message || "Invalid or expired CAPTCHA. Please try again.");
                    $(form).find('.captchaImg').attr('src', '/captcha/flat?' + Math.random());
                    $(form).find('input[name="captcha"]').val('');


            
                    // toastr.error("Something went wrong. Please try again.");
                });
            }
        });

        
    });

    // NOTE: PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED

})(window);