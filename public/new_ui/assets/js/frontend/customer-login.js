(function (window, undefined) {
    'use strict';
    $.validator.addMethod("strictEmail", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/i.test(value);
    }, "Please enter a valid email address.");
    window.encodeBase64Unicode = function(obj) {
        return btoa(unescape(encodeURIComponent(JSON.stringify(obj))));
    }

    window.decodeBase64Unicode = function(str) {
        return JSON.parse(decodeURIComponent(escape(atob(str))));
    }
    document.addEventListener("DOMContentLoaded", function() {
        
        const getQueryParam = (key) => new URLSearchParams(window.location.search).get(key);

        const custLoginForm = $('#custLoginForm');
        const custRegisterForm = $('#custRegisterForm');
        const emailInput = $('#login-email');
        const passwordInput = $('#login-password');
        const custSubmitButton = custLoginForm.find('button[type="submit"]');
        const custRegSubmitButton = custRegisterForm.find('button[type="submit"]');

        // Function to check if both fields are valid
        function checkFields() {
            let emailValid = emailInput.val().trim() !== '' && emailInput[0].checkValidity();
            let passwordValid = passwordInput.val().trim() !== '' && passwordInput.val().length >= 6;
            
            custSubmitButton.prop('disabled', !(emailValid && passwordValid));
        }
        // Function to check if both fields are valid
        function checkRememberMe() {
            const remember_me = localStorage.getItem('rememberMe');
            if(remember_me == 'true'){
                $('#remember_me').prop('checked', true);
                const credential = localStorage.getItem('credential');
                if(credential){
                    const decodedCredential = decodeBase64Unicode(credential);
                    $('[name="email"]').val(decodedCredential.email);
                    $('[name="password"]').val(decodedCredential.password);
                }
                else{
                    $('[name="email"]').val('');
                    $('[name="password"]').val('');
                }
            }
            else{
                $('#remember_me').prop('checked', false);
                $('[name="email"]').val('');
                $('[name="password"]').val('');
                localStorage.removeItem('rememberMe');
                localStorage.removeItem('credential');

            }
        }

        checkFields();
        setTimeout(() => {
            checkRememberMe();
        }, 1000); // Delay to ensure fields are populated


        
        $.validator.addMethod("strongPassword", function(value, element) {
            return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?#&_])[A-Za-z\d@$!%*?#&_]{6,}$/.test(value);
        }, "Password must contain uppercase, lowercase, number, and special character");

        $.validator.addMethod("alphanumeric", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9 .]+$/.test(value);
        }, "Only alphabets, numbers, spaces, and dots are allowed.");

        $.validator.addMethod("usernameValid", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9 .-]+$/.test(value);
        }, "Only alphabets, numbers, spaces, dots, and hyphens are allowed.");


        // Listen for input changes
        emailInput.on('keyup change', checkFields);
        passwordInput.on('keyup change', checkFields);

        async function getDeviceFingerprint() {
            const fingerprint = navigator.userAgent + screen.width + screen.height + new Date().getTimezoneOffset();
            return fingerprint; // Encode as base64
        }
        
        custLoginForm.validate({
            rules: {
                email: {
                    required: true,
                    // email: true,
                    maxlength: 50,
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 50,
                }
            },
            messages: {
                email: {
                    required: "Enter Username / Mobile Number / Email Id",
                    // email: "Please enter a valid email address",
                    maxlength: "Please enter less than 50 characters",
                },
                password: {
                    required: "Please enter password",
                    minlength: "Password must be at least 8 characters long",
                    maxlength: "Password must not exceed 50 characters",
                }
            },
            onkeyup: function (element) {
                $(element).valid();
                checkFields(); // Ensure button status updates
            },
            onfocusout: function (element) {
                $(element).valid();
                checkFields();
            },
            onchange: function (element) {
                $(element).valid();
                checkFields();
            },
            submitHandler: async function (form, event) {  // ✅ Make it async
                event.preventDefault();
                custSubmitButton.prop('disabled', true);

                
                loadingBlock();

                try {
                    const email = custLoginForm.find("[name=email]").val();       //  Use your encryption function
                    const password = custLoginForm.find("[name=password]").val(); //  Encrypt password
                    const deviceId = localStorage.getItem("device_id") || await getDeviceFingerprint();
                    localStorage.setItem("device_id", deviceId);

                    const payload = {
                        email: email,
                        password: password,
                        device_id: deviceId,
                    };
                    const response = await window.axiosApiClient.post(`login`, payload, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                        }
                    });

                    custSubmitButton.prop('disabled', false);
                    console.log(response.data.status);

                    if (response.data.status === 'success') {
                        let user = response.data.user;
                        let token = response.data.token;
                        let tokenExpiry = new Date().getTime() + (response.data.tokenExpiry * 60 * 1000); // In ms
                        let rememberMe = document.getElementById('remember_me')?.checked || false;

                        // Save session/token info
                        localStorage.setItem('authToken', token);
                        localStorage.setItem('tokenType', 'customer');
                        localStorage.setItem('tokenExpiry', tokenExpiry);
                        localStorage.setItem('rememberMe', rememberMe);

                        if (rememberMe) {
                            let credential = {
                                email: email,
                                password: password,
                            };
                            localStorage.setItem('credential', encodeBase64Unicode(credential));
                        }

                        localStorage.setItem('userData', encodeBase64Unicode(user));

                        // toastr.success('Logged In Successfully.', 'Success!');

                        // Redirect logic
                        let point = getQueryParam('point');
                        if (point === 'm') {
                            window.location.href = "/membership"; 
                        } else {
                            window.location.href = "/dashboard"; 
                        }
                    }
                } catch (error) {
                    custSubmitButton.prop('disabled', false);

                    let errorMessage = error.response?.data?.message || "Sorry! Unable to login at the moment. Please try again later!";
                    // toastr.error(errorMessage, 'Error!');
                } finally {
                    // loadingUnblock();
                }
            }
        });

        custRegisterForm.validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 50,
                },
                last_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 50,
                },
                email: {
                    required: true,
                    strictEmail: true, // Use strictEmail for validation
                    // email: true,
                    maxlength: 50,
                },
                mobile_no: {
                    required: true,
                    digits: true,
                    minlength: 7,
                    maxlength: 15,
                },
                category_id:{
                    required: true,
                },
                username: {
                    required: true,
                    usernameValid: true,
                    minlength: 3,
                    maxlength: 50,
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 20,
                    strongPassword: true,
                },
                confirm_password: {
                    required: true,
                    equalTo: '#password',
                },
                accept_consent: {
                    required: true,
                }
            },
            messages: {
                first_name: {
                    required: "Please enter your first name",
                    minlength: "Customer first name should be between 3-50 characters.",
                    maxlength: "Customer first name should be between 3-50 characters.", 
                },
                last_name: {
                    required: "Please enter your last name",
                    minlength: "Customer last name should be between 3-50 characters.",
                    maxlength: "Customer last name should be between 3-50 characters.",
                },
                email: {
                    required: "Please enter your email",
                    strictEmail: "Please enter a valid email address",
                    maxlength: "Email must be less than 50 characters",
                },
                mobile_no: {
                    required: "Please enter your mobile number",
                    digits: "Mobile number must contain only digits",
                    minlength: "Mobile number must be at least 7 digits",
                    maxlength: "Mobile number must not exceed 15 digits",
                },
                category_id: {
                    required: "Please select a category",
                },
                username: {
                    required: "Please enter a username",
                    usernameValid: "Only alphabets, numbers, spaces, dots, and hyphens are allowed.",
                    minlength: "Username should be between 3-50 characters.",
                    minlength: "Username should be between 3-50 characters.",
                    
                },
                password: {
                    required: "Please enter a password",
                    minlength: "Password must be at least 6 characters long",
                    maxlength: "Password must not exceed 20 characters",
                    strongPassword: "Password must contain uppercase, lowercase, number, and special character",
                },
                confirm_password: {
                    required: "Please confirm your password",
                    equalTo: "Password do not match",
                },
                accept_consent: {
                    required: "You must accept the Terms and Conditions",
                }
            },
            onkeyup: function (element) {
                $(element).valid();
            },
            onfocusout: function (element) {
                $(element).valid();
            },
            onchange: function (element) {
                $(element).valid();
            },
            submitHandler: async function (form, event) {
                event.preventDefault();
                const custRegSubmitButton = $(form).find('button[type="submit"]');
                custRegSubmitButton.prop('disabled', true);
                loadingBlock();
        
                try {
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
                        first_name: $(form).find('[name=first_name]').val().trim(),
                        last_name: $(form).find('[name=last_name]').val().trim(),
                        email: $(form).find('[name=email]').val().trim(),
                        mobile_no: $(form).find('[name=mobile_no]').val().trim(),
                        mobile_no_cc: countryCode,
                        mobile_no_ic: isoCode,
                        category_id: $(form).find('[name=category_id]').val().trim(),
                        username: $(form).find('[name=username]').val().trim(),
                        password: $(form).find('[name=password]').val(),
                        confirm_password: $(form).find('[name=confirm_password]').val(),
                        accept_consent: $(form).find('[name=accept_consent]').is(':checked'),
                        device_id: localStorage.getItem("device_id") || await getDeviceFingerprint()
                    };
        
                    localStorage.setItem("device_id", payload.device_id);
        
                    const response = await window.axiosApiClient.post(`save-new-customer`, payload);
        
                    if (response.data.status) {
                        startTimer();
                        toastr.success(response.data.message, 'Success!');
                        $('#custRegisterForm').hide();
                        $("#newRegistrationOTPForm").show();
                        $('#newRegistrationOTPForm input[name="customer_id"]').val(response.data.customer_id);
                        $('#newRegistrationOTPForm input[name="token"]').val(response.data.token);
                        $('#newRegistrationOTPForm .registered_email_id').text(response.data.email_id);
                        
                        $('#custRegisterForm')[0].reset();
                    }
                    else{
                        $('#custRegisterForm').find('button[type="submit"]').removeAttr('disabled');
                        toastr.error(response.data.message, 'Error!');

                        $(".invalid-existing-user strong").text(response.data.message);
                        setTimeout(() => {
                            $(".invalid-existing-user strong").text(''); // Clear the text
                        }, 3000);

                    }
        
                } catch (error) {
                    console.log(error);
                    $('#custRegisterForm').find('button[type="submit"]').removeAttr('disabled');
                }
            }
        });
        

        $(".mobile").each(function(){
            window.intlTelInput(this, {
                initialCountry: "in", // Default country (India)
                separateDialCode: true, // Show country code separately
                preferredCountries: ["us", "gb", "in"]
            });
    
        });

        $('.toggle-auth-btns .btn').on('click', function () {
            $('.toggle-auth-btns .btn').removeClass('active');
            $(this).addClass('active');
    
            if ($(this).text().trim().toLowerCase() === 'login') {

                $('#custLoginForm')[0].reset();
                $('#custRegisterForm').hide();
                $('#custLoginForm').show();
            } else {
                $('#custRegisterForm')[0].reset();
                $('#custLoginForm').hide();
                $('#custRegisterForm').show();
            }
        });

        $('.form-otp').find('input').each(function () {
			$(this).on('keyup', function (e) {
				var parent = $($(this).parent());
				if (e.keyCode === 8 || e.keyCode === 37) {
					var prev = parent.find('input#' + $(this).data('previous'));
					if (prev.length) {
						$(prev).select();
					}
				} else if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
					var next = parent.find('input#' + $(this).data('next'));
					if (next.length) {
						$(next).select();
					}
				}

				var otp = '';
				var counter = 0;
				$('.form-otp').find('input').each(function () {
					otp += $(this).val();
					if ($(this).val() == '') {
						counter++;
					}
				});

				$('#full-otp').val(otp);

				if (counter > 0) {
					$('.js-otp-confirm').addClass('disabled');
				} else {
					$('.js-otp-confirm').removeClass('disabled');
				}
			});
		});

		var timerDuration = 60; // Timer duration in seconds
        var timerInterval;
        var resendBtn = document.getElementById("resendOTPBtn");
        var timerDisplay = document.getElementById("timer");

        function formatTime(seconds) {
            const min = Math.floor(seconds / 60);
            const sec = seconds % 60;
            return `${min}:${sec.toString().padStart(2, '0')}`;
        }

        function startTimer() {
            clearInterval(timerInterval); // Clear any existing timer

            const getOTPBtn = document.querySelector('#custRegisterForm button[type="submit"]');
            getOTPBtn.disabled = true;
            resendBtn.disabled = true;

            let timeLeft = timerDuration;
            timerDisplay.innerHTML = formatTime(timeLeft);

            timerInterval = setInterval(function () {
                timeLeft--;
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    getOTPBtn.disabled = false;
                    resendBtn.disabled = false;
                    timerDisplay.innerHTML = '';
                } else {
                    timerDisplay.innerHTML = formatTime(timeLeft);
                }
            }, 1000);
        }
        
        $('#resendOTPBtn').on('click', async function () {
            try {
                const payload = {
                    id: $('#newRegistrationOTPForm input[name="customer_id"]').val(),
                };
        
                const response = await window.axiosApiClient.post(`resend-customer-otp`, payload);
        
                if (response.data.status) {
                    $('#newRegisterOTPForm input[name="customer_id"]').val(response.data.customer_id);
                    $('#newRegisterOTPForm input[name="token"]').val(response.data.token);
                    startTimer();
                } else {
                    toastr.error(response.data.message, 'Error!');
                }
            } catch (error) {
                console.error('Resend OTP error:', error);
            }
        });
        
        
        $('.validateOTP').on('click', async function () {
            var otp = $('#full-otp').val();
            if(otp.length == 6) {
                try {
                    $(this).prop('disabled', true);
                    loadingBlock();
                    const payload = {
                        customer_id: $('#newRegistrationOTPForm input[name="customer_id"]').val(),
                        token: $('#newRegistrationOTPForm input[name="token"]').val(),
                        otp: $('#full-otp').val()
                    };
            
                    const response = await window.axiosApiClient.post(`validate-registration-otp`, payload);
            
                    if (response.data.status) {
                        toastr.success('Registration successful', 'Success!');
                        
                        setTimeout(() => {
                            let point = getQueryParam('point');
                            if(point == 'm'){
                                window.location.href = "/membership"; 
                            }else{
                                window.location.href = "/login";
                            }
                        }, 2000); // 2000 ms = 2 seconds
                    } else {
                        toastr.error(response.data.message, 'Error!');
                        $(this).prop('disabled', false);
                    }
                } catch (error) {
                    console.error('Resend OTP error:', error);
                    $(this).prop('disabled', false);
                }
            }
            else{
                toastr.error('Please enter a valid OTP', 'Invalid OTP', 'Error!');
            }
        });

        function formatTime(seconds) {
            var minutes = Math.floor(seconds / 60);
            var remainingSeconds = seconds % 60;
            if (remainingSeconds < 10) {
                remainingSeconds = "0" + remainingSeconds;
            }
            return minutes + ":" + remainingSeconds;
        }

        window.checkValidUser = function(payload){
            window.axiosApiClient.post('/check-valid-user', payload)
            .then(response => {
                if (response.data?.status) {
                    if(payload.type == 'username'){
                        $('.custom-username-error').addClass('text-success').removeClass('text-danger').find('span').text('Username is available');
                        $('.custom-username-error').find('.bi').removeClass('bi-info-circle-fill').addClass('bi-check-circle-fill');
                        $('.custom-username-error').show();
                    }
                    if(payload.type == 'email'){
                        $('.custom-email-error').addClass('text-success').removeClass('text-danger').find('span').text('Email is available');
                        $('.custom-email-error').find('.bi').removeClass('bi-info-circle-fill').addClass('bi-check-circle-fill');
                        $('.custom-email-error').show();
                    }
                    if(payload.type == 'mobile'){
                        $('.custom-mobile-error').addClass('text-success').removeClass('text-danger').find('span').text('Mobile number is available');
                        $('.custom-mobile-error').find('.bi').removeClass('bi-info-circle-fill').addClass('bi-check-circle-fill');
                        $('.custom-mobile-error').show();
                    }
                } else {
                    if(payload.type == 'username'){
                        $('.custom-username-error').addClass('text-danger').removeClass('text-success').find('span').text('This Username is already registered.please use another username.');
                        $('.custom-username-error').find('.bi').removeClass('bi-check-circle-fill').addClass('bi-info-circle-fill');
                        $('.custom-username-error').show();
                    }
                    if(payload.type == 'email'){
                        $('.custom-email-error').addClass('text-danger').removeClass('text-success').find('span').text('This email ID is already registered. Please log in or use a different email.');
                        $('.custom-email-error').find('.bi').removeClass('bi-check-circle-fill').addClass('bi-info-circle-fill');
                        $('.custom-email-error').show();
                    }
                    if(payload.type == 'mobile'){
                        $('.custom-mobile-error').addClass('text-danger').removeClass('text-success').find('span').text('This mobile number is linked to an existing account. Try logging in or use another number.');
                        $('.custom-mobile-error').find('.bi').removeClass('bi-check-circle-fill').addClass('bi-info-circle-fill');
                        $('.custom-mobile-error').show();
                    }
                }
            });
        }

        $('#custRegisterForm [name=username]').on('change', function () {
            let $this = $(this);
            let userName = $this.val();
            $('.custom-username-error').hide();
        
            if (userName.length >= 3) {
                const payload = {
                    type: 'username',
                    data: userName,
                };
                checkValidUser(payload);
            }
        });

        $.validator.addMethod("strictEmail", function(value, element) {
            return this.optional(element) || /^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i.test(value);
        }, "Please enter a valid email address");

        $('#custRegisterForm [name=email]').on('change', function () {
            let $this = $(this);
            let email = $this.val();
            $('.custom-email-error').hide();
        
            // Step 1: Check if email field is valid according to jQuery validation
            if ($("#custRegisterForm").validate().element($this)) {
                // Step 2: Agar valid hai aur length bhi thik hai tabhi API call kare
                if (email.length >= 6) {
                    const payload = {
                        type: 'email',
                        data: email,
                    };
                    checkValidUser(payload);
                }
            }
        });

        $('#custRegisterForm [name=mobile_no]').on('change', function () {
            let $this = $(this);
            let mobile_no = $this.val();
            $('.custom-mobile-error').hide();
        
            if (mobile_no.length >= 6) {
                const payload = {
                    type: 'mobile',
                    data: mobile_no,
                };
                checkValidUser(payload);
            }
        });

        $('#digit-1').on('paste', function(e) {
            // Prevent the default paste behavior
            e.preventDefault();
    
            // Get the pasted content
            var pastedData = (e.originalEvent || e).clipboardData.getData('text/plain');
    
            // If the pasted content is a 6-digit number
            if(/^\d{6}$/.test(pastedData)) {
                // Distribute each digit into corresponding input fields
                $('#digit-1').val(pastedData.charAt(0));
                $('#digit-2').val(pastedData.charAt(1));
                $('#digit-3').val(pastedData.charAt(2));
                $('#digit-4').val(pastedData.charAt(3));
                $('#digit-5').val(pastedData.charAt(4));
                $('#digit-6').val(pastedData.charAt(5));
    
                $('#full-otp').val(pastedData);
            } else {
                // If the pasted content is not a 6-digit number, clear all inputs
                $('.form-otp input').val('');
            }
        });
        
        
    

    });

})(window);
