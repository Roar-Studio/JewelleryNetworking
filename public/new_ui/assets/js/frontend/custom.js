(function (window, undefined) {
    'use strict';

    // const INACTIVITY_LIMIT = 30 * 60 * 1000; // 30 minutes in milliseconds
    // let inactivityTimer;

    // const APP_URL = document.querySelector("meta[name='app-url']").getAttribute("content");
    // toastr configuration
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showMethod": "slideDown",
        "hideMethod": "slideUp"
    };
    // Function to decrypt base64 encoded data
    window.decryptData = function (encryptedData) {
        if (!encryptedData) return ''; 
        try {
            return decodeBase64Unicode(encryptedData);
        } catch (error) {
            console.error("Decryption failed:", error);
            return encryptedData;
        }
    };

    window.setCurrency = function (code, symbol) {
        const text = `<span class="symbol">${symbol}</span>`;
        $('#currencyDropdown').html(text)
        localStorage.setItem('selectedCurrency', JSON.stringify({ 'selectedCurrencyCode' : code, 'selectedCurrencySymbol': symbol }));

        // window.location.reload(); // Reload the page to apply the new currency
    }
    window.getSelectedCurrency = function () {
        const currency = localStorage.getItem('selectedCurrency');
        if (currency) {
            return JSON.parse(currency);
        }
        return {
            selectedCurrencyCode: 'INR',
            selectedCurrencySymbol: '&#8377;'
        };
    };

    document.addEventListener('DOMContentLoaded', () => {
        const { selectedCurrencyCode, selectedCurrencySymbol } = getSelectedCurrency();
        if (selectedCurrencyCode && selectedCurrencySymbol) {
            const text = `<span class="symbol">${selectedCurrencySymbol}</span>`;
            $('#currencyDropdown').html(text);
            $('.currency-toggle').show();
        }
        $('.dropdown.currency-dropdown').show();
        if (selectedCurrencyCode === 'USD') {
            $('#currencySwitch').prop('checked', true);
        } else {
            $('#currencySwitch').prop('checked', false);
        }
    });

    $(window).on('load', function() {
        
        $('#communityForm').validate({
            rules: {
                email: {
                    required: true,
                    strictEmail: true
                },
                captcha: { required: true },
            },
            messages: {
                email: {
                    required: "Please enter your email",
                    strictEmail: "Please enter a valid email"
                },
                captcha: { required: "Please enter the CAPTCHA code" },
            },
            submitHandler: function (form) {

                $(form).find('button[type="submit"]').attr('disabled', 'disabled').text('Submitting...');
                // Gather form data
                const payload = {
                    email: $(form).find('input[name="email"]').val(),
                    captcha: $(form).find('input[name="captcha"]').val()
                };

                // Submit via Axios
                window.axiosApiClient.post('/send-community', payload)
                .then(function (response) {
                    toastr.success("Your request has been submitted successfully!");

                    // Reset form fields
                    $(form)[0].reset();

                    // Clear validation errors if any
                    $(form).validate().resetForm();
                    $(form).find('.captchaImg').attr('src', '/captcha/flat?' + Math.random());
                    $(form).find('button[type="submit"]').removeAttr('disabled').text('Submit');
                })
                .catch(function (error) {
                    $(form).find('button[type="submit"]').removeAttr('disabled').text('Submit');
                    $(form).find('.captchaImg').attr('src', '/captcha/flat?' + Math.random());
                    $(form).find('input[name="captcha"]').val('');
                    console.error("Submission error:", error);
                });
            }
        });

        document.querySelectorAll('input.mobile').forEach(input => {
            input.addEventListener("input", function () {
                this.value = this.value.replace(/\D/g, ''); // accept only digits
            });
        });

        document.querySelectorAll('input[type="email"]').forEach(input => {
            input.addEventListener("input", function () {
                this.value = this.value.toLowerCase(); // Convert to lowercase
            });
        });
        


        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    });

    window.getBase64 = async function(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = () => resolve(reader.result); // includes base64 header
            reader.onerror = error => reject(error);
            reader.readAsDataURL(file);
        });
    }
    
    window.initCKEditor = function(selector, callback) {
        const textarea = document.querySelector(selector);
        if (!textarea) return;

        ClassicEditor
            .create(textarea)
            .then(editor => {
            if (callback && typeof callback === 'function') {
                callback(editor, $(textarea).closest('.modal-dialog'));
            }
            })
            .catch(error => {
            console.error(`CKEditor init failed for ${selector}`, error);
        });
    }

    // Focus/blur logic with toolbar check
    window.attachFocusHandlers = function(editor, modalDialog) {
        const editableElement = editor.ui.view.editable.element;
        const toolbarElement = editor.ui.view.toolbar.element;

        editableElement.addEventListener('focus', function () {
            modalDialog.addClass('sidebar-md');
        });

        editableElement.addEventListener('blur', function () {
            setTimeout(() => {
            const active = document.activeElement;

                if (
                    !editableElement.contains(active) &&
                    !toolbarElement.contains(active)
                ) {
                    modalDialog.removeClass('sidebar-md');
                }
            }, 50); // slight delay to allow toolbar interaction
        });
    }

    $(document).find('.pickrdate').on('change', function (){
        let form = $(this).closest('form');
        if(form.length > 0) {
            $(this).valid();
        }
    });

    $(document).find('.pickatime').on('change', function (){
        let form = $(this).closest('form');
        if(form.length > 0) {
            $(this).valid();
        }
    });

    window.clearLocalStorage = function() {
        localStorage.removeItem("userData");
        localStorage.removeItem("tokenExpiry");
        localStorage.removeItem("tokenType");
        localStorage.removeItem("authToken");
    }

    window.getAuthToken = function() {
        const token = localStorage.getItem('authToken');
        const tokenExpiry = parseInt(localStorage.getItem('tokenExpiry'), 10);

        if (!token || !tokenExpiry) {
            
            // Clear all other data
            clearLocalStorage();

        }

        const now = new Date().getTime();

        if (now > tokenExpiry) {
            // Token expired → remove all related localStorage
            clearLocalStorage();
            return '';
        }

        return token;
    }

    window.redirectToLogin = function() {
        window.location.href = "/login"; // Change to your login page URL
        return;
    }

    window.logoutCustomer = function() {
        const deviceId = localStorage.getItem('device_id');

        window.axiosApiClient.post(`/logout`, {
            device_id: deviceId // ✅ Send it in request body
        }, {
            headers: {
                'Authorization': 'Bearer ' + getAuthToken(),
            }
        }).then(response => {
            console.log("Logout successful:", response);
            // Clear local storage
            clearLocalStorage();


            // toastr.success(response.data.message, 'Success!');
            redirectToLogin();
        }).catch(error => {
            console.error("Logout error:", error);
            // Still clear tokens on error (fallback)
            // clearLocalStorage();
            

            toastr.error("Something went wrong. Please try again.");
            // redirectToLogin();
        });
    };


    // window.checkTokenExpiry = function() {
    //     const token = localStorage.getItem("authToken");
    //     const tokenExpiry = localStorage.getItem("tokenExpiry");
    //     const userData = localStorage.getItem("userData");
    //     let rememberMe = localStorage.getItem('rememberMe') === "true";
    
    //     if (!token || !tokenExpiry || !userData) {
    //         redirectToLogin(); 
    //         return;
    //     }
    
    //     if (new Date().getTime() > parseInt(tokenExpiry)) {
    //         logoutCustomer();
    //         console.log("Token expired. Redirecting to login...");
            
    //         clearLocalStorage();
    
    //         // redirectToLogin();
    //     }
    //     if (!rememberMe && tokenExpiry && new Date().getTime() > tokenExpiry) {
    //     }
    // };
    
    // Run this check every 1 minute
    // setInterval(checkTokenExpiry, 60000);
    

    //check inactivity for user
    // function resetInactivityTimer() {
    //     clearTimeout(inactivityTimer);
    //     inactivityTimer = setTimeout(logoutCustomer, INACTIVITY_LIMIT);
    //     localStorage.setItem('lastActivity', new Date().getTime());
    // }

    // ['click', 'mousemove', 'keypress', 'scroll', 'touchstart'].forEach(event => {
    //     window.addEventListener(event, resetInactivityTimer);
    // });

    // Start the timer on page load
    // resetInactivityTimer();
    


    // Call checkTokenExpiry when the page loads
    // document.addEventListener("DOMContentLoaded", checkTokenExpiry);

    // window.loginUser = function() {
    //     window.axiosApiClient.post('login', {
    //         email: 'user@example.com',
    //         password: 'password123'
    //     })
    //     .then(response => {
    //         if (response.data.status) {
    //             localStorage.setItem('token', response.data.token);
    //             localStorage.setItem('tokenExpiry', new Date(response.data.expires_at).getTime());
    //             alert('Login successful!');
    //         } else {
    //             alert(response.data.message);
    //         }
    //     });
    // }

    window.initializeSelect2WithClearButton = function(selector) {
        $(selector).each(function () {
            var $select = $(this);

            // Check if select2 is already initialized before destroying
            if ($select.hasClass('select2-hidden-accessible')) {
                $select.select2('destroy');
            }

            // Remove existing wrapper and re-wrap to avoid duplicates
            if (!$select.parent().hasClass('select2-container')) {
                $select.wrap('<div class="position-relative select2-container d-none"></div>');
            }

            // Initialize select2
            $select.select2({
                placeholder: $(this).data('placeholder') ? $(this).data('placeholder') : 'Select an option',
                minimumResultsForSearch: 5,
                dropdownAutoWidth: true,
                width: '100%',
                dropdownParent: $select.parent()
            });

            // Add clear button if not already present
            if ($select.siblings('.clear-selection').length === 0) {
                var clearBtn = $('<span class="clear-selection">&times;</span>');
                $select.parent().append(clearBtn);

                function toggleClearButton() {
                    if ($select.val() && $select.val().length > 0) {
                        clearBtn.show();
                    } else {
                        clearBtn.hide();
                    }
                }

                toggleClearButton(); // Check on load

                // Handle clear button click
                clearBtn.on('click', function (e) {
                    e.stopPropagation();
                    $select.val(null).trigger('change');
                    toggleClearButton();
                });

                // Re-bind change event to update clear button visibility
                $select.on('change', toggleClearButton);
            }
        });
    }

    window.initializeDatepicker = function(selector) {
        $(selector).each(function () {
            var $select = $(this); // Use $(this) inside .each()
    
            $select.pickadate({
                selectYears: 80,
                selectMonths: true,
                format: 'dd-mm-yyyy',
                formatSubmit: 'dd-mm-yyyy',
                close: false,
                onSet: function(context) {
                    var input = this.$node;
                    var form = this.$node.closest('form'); // Get the closest form
                    if (context.select) { // Only run when a date is selected, not when clearing
                        this.$node.trigger('change'); // Trigger change event
                    }
                    if(form.length > 0){
                        input.valid();
                    }
                }
            });
        });
    };

    window.resetForm = function(selector) {
        var selectedForm = $(selector);
        selectedForm.validate().resetForm();
        selectedForm.find('.error').removeClass('error');
        selectedForm.find('.is-valid').removeClass('is-valid');
        selectedForm.find('.is-invalid').removeClass('is-invalid');
        selectedForm[0].reset();

        if ($('.upload-box').length) {
            $('.upload-box').each(function() {
                var $box = $(this);
                var dataName = $box.data('name') || '';
        
                if (dataName.includes('[]')) {
                    $box.remove();
                } else {
                    $box.find('.remove-image-btn').trigger('click');
                }
            });
        }
    }
    window.encodeBase64Unicode = function(obj) {
        return btoa(unescape(encodeURIComponent(JSON.stringify(obj))));
    }

    window.decodeBase64Unicode = function(str) {
        return JSON.parse(decodeURIComponent(escape(atob(str))));
    }
    window.formatPaymentStatus = function(status){
        var statusMapping = {
            'pending': { title: 'Pending', class: 'badge-light-warning' },
            'completed': { title: 'Completed', class: 'badge-light-success' },
            'failed': { title: 'Failed', class: 'badge-light-danger' },
            'refunded': { title: 'Refunded', class: 'badge-light-primary' },
        };
        
        var statusKey = String(status).trim(); // Ensure string consistency
        
        if (!statusMapping.hasOwnProperty(statusKey)) {
            return data; // Return default data if value is unexpected
        }
        
        return (
            '<span class="badge rounded-pill ' +
            statusMapping[statusKey].class +
            '">' +
            statusMapping[statusKey].title +
            '</span>'
        );
    }
    window.formatDateTime = function(input) {
        return input ? moment(input, "YYYY-MM-DD HH:mm:ss").format("DD/MM/YYYY hh:mm A") : '-';
    }
    window.formatDate = function(input) {
        return input ? moment(input, "YYYY-MM-DD HH:mm:ss").format("DD/MM/YYYY") : '-';
    }
    window.checkPlanExpiry = function(expiryDate) {
        const now = moment();
        if (!expiryDate) {
            return { status: "Unlimited", daysLeft: 'Unlimited', progress: 100 };
        }
        const expiry = moment(expiryDate, "YYYY-MM-DD HH:mm:ss");
        if (now.isAfter(expiry)) {
            return { status: "Expired", daysLeft: 0, progress: 100 };
        }
    
        const totalDuration = expiry.diff(now.clone().subtract(30, 'days'), 'days'); // assuming 30-day plan
        const daysRemaining = expiry.diff(now, 'days');
        const daysUsed = totalDuration - daysRemaining;
        const percentageUsed = Math.round((daysUsed / totalDuration) * 100);
    
        return {
            // status: `${daysRemaining} day${daysRemaining !== 1 ? 's' : ''} left`,
            status: `Active`,
            daysLeft: daysRemaining,
            progress: percentageUsed
        };
    };    
    
    

    $('.form-switch [type="checkbox"]').on('change', function () {
        var is_active = $(this).is(':checked') ? 1 : 0;
        $('[name="is_active"]').val(is_active);
    });

    // Initialize for existing select elements
    // initializeSelect2WithClearButton('.designation');

    // // Reinitialize when modal is shown
    // $('.modal').on('shown.bs.modal', function () {
    //     initializeSelect2WithClearButton('.designation');
    // });

    $('.modal').on('show.bs.modal', function () {
        
        $('[data-bs-toggle="tooltip"]').tooltip('dispose');
        $('[data-bs-toggle="tooltip"]').tooltip();

    });
    
    function fetchDashboardData() {
        $('.user-name').text('Loading...');
        
        window.axiosApiClient.get('/user', {
            // withCredentials: true
            headers: { 'Authorization': 'Bearer ' + getAuthToken() }    
        })
        .then(response => {
            if(response.data.status === 'success'){
                $('a.unauth').hide();
                $('.dashboard').show();
                localStorage.setItem('userData', encodeBase64Unicode(response.data.data.user));
                
                $('.user-name').text(
                    response.data.data.user.first_name + ' ' + response.data.data.user.last_name
                );
                //order summary page
                // $('#cname').val(response.data.data.user.company_name);
                // $('#caddress').val(response.data.data.user.company_address);
                // $('#taxid').val(response.data.data.user.trn_no);
            } else {
                $('.dashboard').hide();
                $('a.unauth').show();
            }
        })
        .catch(error => {
            $('.dashboard').hide();
            $('a.unauth').show();
            $('.user-name').text('');
            // logoutCustomer();
        });
    }
    fetchDashboardData();

        
    $(".mobile").each(function(){
        window.intlTelInput(this, {
            initialCountry: "in", // Default country (India)
            separateDialCode: true, // Show country code separately
            preferredCountries: ["us", "gb", "in"]
        });

    });

    window.convertCurrency = function(amount, currency = 'INR', digits = 2) {
        let formattedAmount = '0.00';
        if (amount) {
            const numAmount = Number(amount); // <- convert string to number safely
            if (currency.toUpperCase() === 'USD') {
                // Force $100 without "US"
                formattedAmount = '$' + numAmount.toFixed(digits);
            } else {
                formattedAmount = new Intl.NumberFormat('en-IN', {
                    style: 'currency',
                    currency: currency.toUpperCase(),
                    minimumFractionDigits: digits,
                    maximumFractionDigits: digits
                }).format(numAmount);
            }
        }
        return formattedAmount;
    };


    // window.convertCurrency = function(amount, currency = 'INR', digits = 2) {
    //     let formattedAmount = '0.00';
    //     if (amount) {
    //         formattedAmount = new Intl.NumberFormat(undefined, {
    //             style: 'currency',
    //             currency: currency.toUpperCase(),
    //             minimumFractionDigits: digits,
    //             maximumFractionDigits: digits
    //         }).format(amount);
    //     }
    
    //     return formattedAmount;
    // };
    window.copyText = function(selectedText) {
        navigator.clipboard.writeText(selectedText).then(function () {
            toastr.success('Copied to clipboard');
        }).catch(function (err) {
            console.error('Failed to copy: ', err);
        });
    }
    window.convertCurrencyWithoutSymbol = function(amount, currency = 'INR', digits = 2) {
        let formattedAmount = '0';
        if (amount) {
            formattedAmount = new Intl.NumberFormat(undefined, {
                style: 'decimal',
                currency: currency.toUpperCase(),
                minimumFractionDigits: digits,
                maximumFractionDigits: digits
            }).format(amount);
        }
    
        return formattedAmount;
    };
    $.validator.addMethod("afterStartDate", function(value, element, params) {
        if (!value) return true; // skip if end date is empty

        const startDate = $(params[0]).val();
        const startTime = $(params[1]).val() || "00:00";
        const endTime = $(params[2]).val() || "00:00";

        if (!startDate) return true; // skip if start date is empty

        const start = new Date(`${startDate}T${startTime}`);
        const end = new Date(`${value}T${endTime}`);

        return end > start;
    }, "End date/time must be after start date/time.");

    $.validator.addMethod("strictEmail", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/i.test(value);
    }, "Please enter a valid email address.");
    $.validator.addMethod("strongPassword", function(value, element) {
        return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?#&_])[A-Za-z\d@$!%*?#&_]{6,}$/.test(value);
    }, "Password must contain uppercase, lowercase, number, and special character");
    $.validator.addMethod("validIframe", function(value, element) {
        const regex = /^<iframe\s+[^>]*src="https:\/\/www\.google\.com\/maps\/embed\?[^"]*"[^>]*><\/iframe>$/i;
        return this.optional(element) || regex.test(value.trim());
    }, "Please enter a valid Google Maps iframe embed code.");
    
    $.validator.addMethod("alpha", function (value, element) {
        return /^[A-Za-z._\-\s]+$/.test(value) && !/^\s+$/.test(value);
    }, "Input should contain only alphabets, dots (.), underscores (_), hyphens (-), and spaces. Only spaces not allowed");
    $.validator.addMethod("email", function (value, element) {
        return /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value);
    }, "Please enter a valid email address.");
    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0] && element.files[0].size <= param);
    }, 'File size must be less than 1MB');
    // Add custom validator
    $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9 .]+$/.test(value);
    }, "Only alphabets, numbers, spaces, and dots are allowed.");

    $.validator.addMethod("greaterThan", function (value, element, param) {
        const start = new Date($(param).val());
        const end = new Date(value);
        return this.optional(element) || end >= start;
    }, "End date must be after start date.");

    $.validator.addMethod("fileSize", function(value, element, maxSize) {
        if (element.files.length === 0) return true;
    
        const file = element.files[0];
        return file.size <= maxSize * 1024; // Convert KB to bytes
    }, function(maxSize, element) {
        return "File size must be less than " + maxSize + " KB.";
    });

    $.validator.addMethod("maxPlainText", function (value, element, param) {
        const div = document.createElement("div");
        div.innerHTML = value;
    
        // Remove all tags and count plain text
        const plainText = div.textContent || div.innerText || "";
        return plainText.trim().length <= param;
    }, "Please enter no more than {0} characters.");
    
    $('.reloadCaptcha').on('click', function () {
        let $captchaImg = $(this).closest('div').find('.captchaImg');
        if( $captchaImg.length > 0 ){
            $captchaImg.attr('src', '/captcha/flat?' + Math.random());
        }
    });




    // NOTE: PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED

})(window);