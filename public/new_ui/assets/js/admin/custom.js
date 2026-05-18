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
    window.encodeBase64Unicode = function(obj) {
        return btoa(unescape(encodeURIComponent(JSON.stringify(obj))));
    }

    window.decodeBase64Unicode = function(str) {
        return JSON.parse(decodeURIComponent(escape(atob(str))));
    }
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

    $(window).on('load', function() {
        
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

    window.getAuthToken = function() {
        return localStorage.getItem('authTokenAdmin') || '';
    }

    window.redirectToLogin = function() {
        window.location.href = "/admin/login"; // Change to your login page URL
        return;
    }

    window.logoutUser = function() {
        window.axiosApiClient.post(`/admin/logout`, {}, {
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('authTokenAdmin')}`,
                'session-id': localStorage.getItem('sessionIdAdmin'),
            }
        }).then(response => {
            localStorage.removeItem('authTokenAdmin');
            localStorage.removeItem('sessionIdAdmin');
            localStorage.removeItem('tokenExpiryAdmin');
            localStorage.removeItem('userDataAdmin');
    
            toastr.success(response.data.message, 'Success!');
            redirectToLogin();
        });
    }

    window.checkTokenExpiry = function() {
        const token = localStorage.getItem("authTokenAdmin");
        const tokenExpiry = localStorage.getItem("tokenExpiryAdmin");
        const userData = localStorage.getItem("userDataAdmin");
        let rememberMe = localStorage.getItem('rememberMeAdmin') === "true";
    
        if (!token || !tokenExpiry || !userData) {
            redirectToLogin(); 
            return;
        }
        let now = new Date().getTime();
        let existingTime = parseInt(tokenExpiry, 10);
        if (now > existingTime) {
            logoutUser();
            console.log("Token expired. Redirecting to login...");
            
            localStorage.removeItem("authTokenAdmin");
            localStorage.removeItem('sessionIdAdmin');
            localStorage.removeItem("tokenExpiryAdmin");
            localStorage.removeItem("userDataAdmin");
    
            // redirectToLogin();
        }
    };
    
    // Run this check every 1 minute
    setInterval(checkTokenExpiry, 60000);
    
    
    function redirectToLogin() {
        window.location.href = "/admin/login";  // Ensure correct login URL
    }
    
    //check inactivity for user
    // function resetInactivityTimer() {
    //     clearTimeout(inactivityTimer);
    //     inactivityTimer = setTimeout(logoutUser, INACTIVITY_LIMIT);
    //     localStorage.setItem('lastActivity', new Date().getTime());
    // }

    // ['click', 'mousemove', 'keypress', 'scroll', 'touchstart'].forEach(event => {
    //     window.addEventListener(event, resetInactivityTimer);
    // });

    // Start the timer on page load
    // resetInactivityTimer();
    


    // Call checkTokenExpiry when the page loads
    document.addEventListener("DOMContentLoaded", checkTokenExpiry);

    // window.loginUser = function() {
    //     window.axiosApiClient.post('login', {
    //         email: 'user@example.com',
    //         password: 'password123'
    //     })
    //     .then(response => {
    //         if (response.data.status) {
    //             localStorage.setItem('token', response.data.token);
    //             localStorage.setItem('tokenExpiryAdmin', new Date(response.data.expires_at).getTime());
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
                    let imgTrigger = $box.find('.upload-trigger')[0];
                    let fileInput = $box.find('input[type=file]')[0];
                    window.resetImage(imgTrigger, fileInput, $box[0]);

                    // $box.find('.remove-image-btn').trigger('click');
                }
            });
        }
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
        checkTokenExpiry();
        window.axiosApiClient.get('admin/user', {
            headers: { 'Authorization': 'Bearer ' + getAuthToken() }
        })
        .then(response => {
            $('.user-name').text(response.data.user.name);
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

    window.convertCurrency = function(amount, currency = 'INR') {
        let formattedAmount = '0.00';
        if (amount) {
            formattedAmount = new Intl.NumberFormat(undefined, {
                style: 'currency',
                currency: currency.toUpperCase(),
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }).format(amount);
        }
    
        return formattedAmount;
    };
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

    $.validator.addMethod("imageRequired", function(value, element) {
        const imgTrigger = $(element).closest(".upload-box").find(".upload-trigger");

        // If no file selected & placeholder image is still present, return false (invalid)
        return element.files.length > 0 || !imgTrigger.attr("src").includes("Placeholder_view_vector.svg");
    }, "Please upload a image.");

    $.validator.addMethod("checkDimensions1", function(value, element, expectedDimentions) {
        if (element.files.length === 0) return true; // Skip validation if no file is uploaded

        const file = element.files[0];
        const img = new Image();
        const valid = { status: false }; // Temporary validation flag

        img.onload = function() {
            // console.log(`Detected Width: ${this.width}, Height: ${this.height}`);

            if (this.width === expectedDimentions[0] && this.height === expectedDimentions[1]) {
                valid.status = true;
            } else {
                valid.status = false;
                // alert("Uploaded image dimensions do not match the required size.");
                $(element).val(""); // Clear invalid selection
            }
        };

        img.src = URL.createObjectURL(file);

        return valid.status; // **Directly return true or false**
    }, "Uploaded image dimensions do not match the required size.");

    $.validator.addMethod("checkDimensions", function (value, element) {
        const $el = $(element);
        const hasFile = element.files && element.files.length > 0;
        const dimAttr = $el.attr('data-dimension-valid');

        // Fail if data-dimension-valid is present and not "true", and file is selected
        if (hasFile && dimAttr !== undefined && dimAttr !== "true") {
            console.log("Validator checkDimensions: attribute exists and not true → fail");
            return false;
        }

        // Otherwise, pass
        return true;
    }, "Image dimensions do not match.");

    // 1. Attach to the input[type=file]
    $(document).on('change', 'input[name="banner"]', function () {
        const element = this;
        const file = element.files[0];

        if (!file) {
            $(element).attr('data-dimension-valid', true);
            return;
        }

        const img = new Image();
        img.onload = function () {
            const isValid = this.width === this.height; // ✅ Your expected dimensions
            $(element).attr('data-dimension-valid', isValid);
            setTimeout(() => {
                // Ensure the image is loaded before validation
                $(element).valid();
            }, 300); 
            if (!isValid) {
                // alert("Image must be exactly same pixels of height and width.");
                // $(element).val(""); // Clear invalid file
            }
        };
        img.onerror = function () {
            $(element).attr('data-dimension-valid', false);
            // alert("Image could not be loaded.");
            // $(element).val("");
        };
        img.src = URL.createObjectURL(file);
        // Adjust timeout as needed

    });







    




    // NOTE: PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED

})(window);