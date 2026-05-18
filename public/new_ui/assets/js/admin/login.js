(function (window, undefined) {
    'use strict';

    document.addEventListener("DOMContentLoaded", function() {
        window.encodeBase64Unicode = function(obj) {
            return btoa(unescape(encodeURIComponent(JSON.stringify(obj))));
        }

        window.decodeBase64Unicode = function(str) {
            return JSON.parse(decodeURIComponent(escape(atob(str))));
        }
        const loginForm = $('#authLoginForm');
        const emailInput = $('#login-email');
        const passwordInput = $('#login-password');
        const submitButton = loginForm.find('button[type="submit"]');

        // Function to check if both fields are valid
        function checkFields() {
            let emailValid = emailInput.val().trim() !== '' && emailInput[0].checkValidity();
            let passwordValid = passwordInput.val().trim() !== '' && passwordInput.val().length >= 6;
            
            submitButton.prop('disabled', !(emailValid && passwordValid));
        }

        function checkRememberMe() {
            const remember_me = localStorage.getItem('rememberMeAdmin');
            if(remember_me == 'true'){
                $('#remember_me').prop('checked', true);
                const credential = localStorage.getItem('credentialAdmin');
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
                localStorage.removeItem('rememberMeAdmin');
                localStorage.removeItem('credentialAdmin');

            }
        }

        setTimeout(() => {
            checkRememberMe();
        }, 1000);

        // Run on page load to disable button initially
        checkFields();

        // window.checkAlreadyLogin = function() {
        //     const token = localStorage.getItem("authToken");
        //     const tokenExpiry = localStorage.getItem("tokenExpiry");
        //     const userData = localStorage.getItem("userData");
        //     let rememberMe = localStorage.getItem('rememberMe') === "true";
        
        //     if (token && tokenExpiry && userData) {
        //         window.location.href = "/admin/manage/customer";
        //         return;
        //     }
        // };

        // checkAlreadyLogin();

        // Listen for input changes
        emailInput.on('keyup change', checkFields);
        passwordInput.on('keyup change', checkFields);

        async function getDeviceFingerprint() {
            const fingerprint = navigator.userAgent + screen.width + screen.height + new Date().getTimezoneOffset();
            return fingerprint; // Encode as base64
        }
        
        loginForm.validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    maxlength: 50,
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 20,
                }
            },
            messages: {
                email: {
                    required: "Please enter username",
                    email: "Please enter a valid email address",
                    maxlength: "Please enter less than 50 characters",
                },
                password: {
                    required: "Please enter password",
                    minlength: "Password must be at least 8 characters long",
                    maxlength: "Password must not exceed 20 characters",
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
                submitButton.prop('disabled', true);

                
                loadingBlock();

                try {
                    const email = loginForm.find("[name=email]").val();       //  Use your encryption function
                    const password = loginForm.find("[name=password]").val(); //  Encrypt password
                    let rememberMe = loginForm.find('[name=remember_me]').prop('checked');
                    
                    const deviceId = localStorage.getItem("device_id") || await getDeviceFingerprint();
                    localStorage.setItem("device_id", deviceId);

                    const payload = {
                        email: email,
                        password: password,
                        device_id: deviceId,
                        remember_me: rememberMe
                    };
                    const response = await window.axiosApiClient.post(`admin/login`, payload, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                        }
                    });

                    submitButton.prop('disabled', false);

                    if (response.data.status === 'success') {
                        let user = response.data.user;
                        let token = response.data.token;
                        let tokenExpiry = new Date().getTime() + (response.data.tokenExpiry * 60 * 1000); // Convert minutes to milliseconds
                        rememberMe = loginForm.find('[name=remember_me]').prop('checked');
                
                        // Store token and session ID
                        localStorage.setItem('authTokenAdmin', token);
                        localStorage.setItem('sessionIdAdmin', user.session_id);
                        localStorage.setItem('tokenExpiryAdmin', tokenExpiry);
                        localStorage.setItem('rememberMeAdmin', rememberMe);

                        if (rememberMe) {
                            let credential = {
                                email: email,
                                password: password,
                            };
                            localStorage.setItem('credentialAdmin', encodeBase64Unicode(credential));
                        }

                        localStorage.setItem('userDataAdmin',  encodeBase64Unicode(user));
                
                        toastr.success('Logged In Successfully.', 'Success!');
                        window.location.href = "/admin/manage/customer"; 
                    }
                } catch (error) {
                    submitButton.prop('disabled', false);

                    let errorMessage = error.response?.data?.message || "Sorry! Unable to login at the moment. Please try again later!";
                    // toastr.error(errorMessage, 'Error!');
                } finally {
                    // loadingUnblock();
                }
            }
        });

    });

})(window);
