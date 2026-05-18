(function (window, undefined) {
    'use strict';

    document.addEventListener("DOMContentLoaded", function() {

        const custForgotPasswordForm = $('#custForgotPasswordForm');
        const resetPasswordForm = $('#resetPasswordForm');
        const emailInput = $('#login-email');
        const passwordInput = $('#login-password');
        const custSubmitButton = custForgotPasswordForm.find('button[type="submit"]');
        const custRegSubmitButton = resetPasswordForm.find('button[type="submit"]');
        
        $.validator.addMethod("strongPassword", function(value, element) {
            return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?#&_])[A-Za-z\d@$!%*?#&_]{6,}$/.test(value);
        }, "Password must contain uppercase, lowercase, number, and special character");

        async function getDeviceFingerprint() {
            const fingerprint = navigator.userAgent + screen.width + screen.height + new Date().getTimezoneOffset();
            return fingerprint; // Encode as base64
        }
        
        custForgotPasswordForm.validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    maxlength: 50,
                },
            },
            messages: {
                email: {
                    required: "Please enter email address",
                    email: "Please enter a valid email address",
                    maxlength: "Please enter less than 50 characters",
                },
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
            submitHandler: async function (form, event) {  // ✅ Make it async
                event.preventDefault();
                custSubmitButton.prop('disabled', true);

                loadingBlock();

                try {
                    const email = custForgotPasswordForm.find("[name=email]").val();       //  Use your encryption function
                    
                    const payload = {
                        email: email,
                    };
                    const response = await window.axiosApiClient.post(`get-forgot-otp`, payload);

                    custSubmitButton.prop('disabled', false);
                    if (response.data.status) {
                        startTimer();
                        toastr.success(response.data.message, 'Success!');
                        custForgotPasswordForm.hide();
                        $("#forgotOTPForm").show();
                        $('#forgotOTPForm input[name="customer_id"]').val(response.data.customer_id);
                        $('#forgotOTPForm input[name="token"]').val(response.data.token);
                        $('#forgotOTPForm .registered_email_id').text(response.data.email_id);
                        
                        // $('#resetPasswordForm')[0].reset();
                    }
                    else{
                        custForgotPasswordForm.find('button[type="submit"]').removeAttr('disabled');
                        toastr.error(response.data.message, 'Error!');

                        $(".invalid-existing-user strong").text(response.data.message);
                        setTimeout(() => {
                            $(".invalid-existing-user strong").text(''); // Clear the text
                        }, 3000);

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

        resetPasswordForm.validate({
            rules: {
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 20,
                    strongPassword: true,
                },
                confirm_password: {
                    required: true,
                    equalTo: '#password',
                },
            },
            messages: {
                password: {
                    required: "Please enter a password",
                    minlength: "Password must be at least 8 characters long",
                    maxlength: "Password must not exceed 20 characters",
                    strongPassword: "Password must contain uppercase, lowercase, number, and special character",
                },
                confirm_password: {
                    required: "Please confirm your password",
                    equalTo: "Password do not match",
                },
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

                    const payload = {
                        password: $(form).find('[name=password]').val(),
                        confirm_password: $(form).find('[name=confirm_password]').val(),
                        customer_id: $(form).find('input[name="customer_id"]').val(),
                        token: $(form).find('input[name="token"]').val(),
                    };
        
                    const response = await window.axiosApiClient.post(`save-new-password`, payload);
        
                    if (response.data.status) {
                        toastr.success(response.data.message, 'Success!');
                        setTimeout(() => {
                            window.location.href = '/login';
                        }, 2000);
                    }
                    else{
                        toastr.error(response.data.message, 'Error!');
                    }
        
                } catch (error) {
                    console.log(error);
                    $('#resetPasswordForm').find('button[type="submit"]').removeAttr('disabled');
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

                $('#custForgotPasswordForm')[0].reset();
                $('#resetPasswordForm').hide();
                $('#custForgotPasswordForm').show();
            } else {
                $('#resetPasswordForm')[0].reset();
                $('#custForgotPasswordForm').hide();
                $('#resetPasswordForm').show();
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

            const getOTPBtn = document.querySelector('#resetPasswordForm button[type="submit"]');
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
                    id: $('#forgotOTPForm input[name="customer_id"]').val(),
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
                    const payload = {
                        customer_id: $('#forgotOTPForm input[name="customer_id"]').val(),
                        token: $('#forgotOTPForm input[name="token"]').val(),
                        otp: $('#full-otp').val()
                    };
            
                    const response = await window.axiosApiClient.post(`validate-forgot-otp`, payload);
            
                    if (response.data.status) {
                        toastr.success(response.data.message, 'Success!');
                        $('#forgotOTPForm').hide();
                        $("#resetPasswordForm").show();
                        $('#resetPasswordForm input[name="customer_id"]').val(response.data.customer_id);
                        $('#resetPasswordForm input[name="token"]').val(response.data.token);
                    } else {
                        toastr.error(response.data.message, 'Error!');
                    }
                } catch (error) {
                    console.error('Resend OTP error:', error);
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
                } else {
                    if(payload.type == 'username'){
                        $('.custom-username-error').show();
                    }
                    if(payload.type == 'email'){
                        $('.custom-email-error').show();
                    }
                    if(payload.type == 'mobile'){
                        $('.custom-mobile-error').show();
                    }
                }
            });
        }

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
