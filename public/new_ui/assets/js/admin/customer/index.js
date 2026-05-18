(function (window, undefined){
    'use strict';

    document.addEventListener("DOMContentLoaded", function() {

        // call from custom.js
        
        // ========================       
        // $('#updateMembershipForm').find('input[name="transaction_date"]').pickadate('picker').set('min', new Date());
        
        window.customer_table = $('#customer-list-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + '/api/admin/customer/list',
                type: 'GET',
                data: function (d) {
                    d.search_key = $('#search_key').val();
                    d.plan_type = $('#plan_type').val();
                    d.is_active = $('#is_active').val();
                    d.location = $('#location').val();
                },
                headers: {
                    'Authorization': 'Bearer ' + getAuthToken()
                },
                dataSrc: function (json) {
                    try {
                        if(USE_ENCRYPTION){
                            const decryptedData = CryptoHelper.decrypt(json.data);
                            json.data = decryptedData.data; // Only update the data array
                            json.recordsTotal = decryptedData.recordsTotal ?? decryptedData.total ?? json.recordsTotal;
                            json.recordsFiltered = decryptedData.recordsFiltered ?? decryptedData.totalFiltered ?? json.recordsFiltered;
                        }
                
                        return json.data;
                    } catch (err) {
                        console.error('Decryption failed:', err);
                        return [];
                    }
                },
                error: function (xhr, error, thrown) {
                    console.error('Error fetching data:', error);
                    alert('There was an error fetching data. Please try again later.');
                }
            },
            columns: [
                // { data: 'responsive_id', title: '' },
                // { data: 'id', title: 'ID' },
                {
                    data: 'first_name', 
                    title: 'Full Name', 
                    render: function (data, type, full, meta) {
                        var $name = (full['first_name'] || full['last_name']) 
                            ? `${full['first_name'] || ''} ${full['last_name'] || ''}`.trim() 
                            : '';
                
                        return (
                            '<div class="d-flex flex-column justify-content-center align-items-start">' +
                            '<a class="emp-name" data-bs-toggle="tooltip" data-bs-placement="top" title="'+ $name +'" href="javascript:void(0);" onclick="fetchCustomerRecords('+ full['id'] +')">' +
                            '<span class="emp-name text-truncate fw-bold">' + $name + '</span>' +
                            '</a>' +
                            '</div>'
                        );
                    } 
                }, 
                {
                    data: 'id',
                    title: 'Membership ID',
                    render: function (data, type, full, meta) {
                        return full['membership_id'] || '-';
                    }
                },
                {
                    data: 'mobile_no',
                    title: 'Mobile No',
                    render: function (data, type, full, meta) {
                        var $mobileno = (full['mobile_no_cc'] ?? '+91') + '-' + full['mobile_no'];
                        return $mobileno;
                    }
                },                
                {
                    data: 'created_at', 
                    title: 'Register Date',
                    render: function (data, type, full, meta) {
                        var $register_date = formatDateTime(full['created_at']);
                        return (
                            '<span class="emp-email text-truncate d-inline-block" ' +
                            'data-bs-toggle="tooltip" data-bs-placement="top" title="' + $register_date + '" ' +
                            'style="max-width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">' +
                            $register_date +
                            '</span>'
                        );
                    }
                },
                {
                    data: 'plan_type', 
                    title: 'Membership Type' ,
                    render: function (data, type, full, meta) {
                        var statusMapping = {
                            '1': { title: 'Free', class: 'badge-light-danger' },
                            '2': { title: 'Standard', class: 'badge-light-primary' },
                            '3': { title: 'Premium', class: 'badge-light-success' },
                        };
    
                        var statusKey = String(full['plan_type']).trim(); // Ensure string consistency
    
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
                },
                {
                    data: 'is_active', 
                    title: 'Status',
                    render: function (data, type, full, meta) {
                        var statusMapping = {
                            'Active': { title: 'Active', class: 'badge-light-success' },
                            'InActive': { title: 'Inactive', class: 'badge-light-danger' },
                            '1': { title: 'Active', class: 'badge-light-success' },
                            '0': { title: 'Inactive', class: 'badge-light-danger' },
                        };
    
                        var statusKey = String(full['is_active']).trim(); // Ensure string consistency
    
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
                },
                {
                    data: 'id', 
                    title: 'Actions', 
                    orderable: false,
                    render: function (data, type, full, meta) {
                        let html = '<div class="d-inline-flex">';
                    
                        html += '<a href="javascript:;" class="item-edit me-2" ' +
                            'data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile" onclick="fetchCustomerRecords(' + full['id'] + ')">' +
                            '<i class="bi bi-pencil-square"></i>' +
                            '</a>';
                    
                        if (full['is_active'] == 1) {
                            html += '<a href="javascript:;" class="item-edit me-2" ' +
                                'data-bs-toggle="tooltip" data-bs-placement="top" title="Subscription Details" onclick="fetchCustomerMembership(' + full['id'] + ')">' +
                                '<i class="bi bi-cash-coin"></i>' +
                                '</a>';
                        }

                        html += '<a href="javascript:;" class="item-edit text-danger me-2" ' +
                            'data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Customer" onclick="deleteCustomerRecords(' + full['id'] + ')">' +
                            '<i class="bi bi-trash"></i>' +
                            '</a>';
                    
                        html += '</div>';
                        return html;
                    }                    
                }, 
            ],
            drawCallback: function(settings) {
                $('[data-bs-toggle="tooltip"]').tooltip();
            },
            order: [[0, 'asc']],
            dom: '<"table-box"t><"d-flex border-top justify-content-between mx-0"<""l><""i><""p>>',
            displayLength: 15,
            lengthMenu: [15, 25, 50, 75, 100],
            language: {
                paginate: {
                    previous: '&nbsp;',
                    next: '&nbsp;'
                },
                emptyTable: `<p class="text-center my-3">No customer found</p>`
            }
        });
        window.deleteCustomerRecords= function(id){
            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to delete this customer record?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Delete it!",
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    loadingBlock();
                    window.axiosApiClient.post(`admin/customer/remove/${id}`,{},{
                        headers: {
                            'Authorization': 'Bearer ' + getAuthToken()
                        }
                    }).then(response => {
                        if (response.data.status) {
                            toastr.success('Customer deleted successfully.', 'Success!');
                            customer_table.ajax.reload();
                        }
                    });
    
                }
            });
            
        }

        window.fetchCustomerRecords = function(id){
            $('input[name="user_id"]').val(id);
            $('#customer-detail-modals').modal('show');
            $("#personal-tab").trigger("click");
            fetchCustomerDetails();
        }

        window.fetchCustomerDetails = function() {
            loadingBlock();
            let id = $('input[name="user_id"]').val();
            window.axiosApiClient.post(`admin/customer/view/${id}`,{},{
                headers: {
                            'Authorization': 'Bearer ' + getAuthToken()
                        }
            }).then(response => {
                var editCustomerForm = $('#editCustomerForm');
                window.resetForm('#editCustomerForm');

                if (response.data.status) {
                    var customer = response.data.data;
                    
                    $('input[name="user_id"]').val(customer.id);
                    $('.emp-name-title').text(customer.name);

                    var mobileInput = editCustomerForm.find('input[name="mobile_no"]')[0];
                    var iti = window.intlTelInputGlobals.getInstance(mobileInput);
                    if (iti) {
                        iti.setCountry(customer.mobile_no_ic || 'in');
                    }

                    editCustomerForm.find('input[name="first_name"]').val(customer.first_name);
                    editCustomerForm.find('input[name="last_name"]').val(customer.last_name);
                    
                    if (customer.username) {
                        editCustomerForm.find('input[name="username"]').val(customer.username);
                        editCustomerForm.find('input[name="username"]').prop('readonly', true);
                        editCustomerForm.find('input[name="username"]');
                        $('.username_feedback').text('');
                    } else {
                        editCustomerForm.find('input[name="username"]').prop('readonly', false);
                    }

                    editCustomerForm.find('input[name="email"]').val(customer.email);
                    editCustomerForm.find('input[name="mobile_no"]').val(customer.mobile_no);
                    editCustomerForm.find('input[name="trn_no"]').val(customer.trn_no);
                    editCustomerForm.find('input[name="company_name"]').val(customer.company_name);
                    editCustomerForm.find('input[name="company_address"]').val(customer.company_address);
                    editCustomerForm.find('input[name="business_description"]').val(customer.business_description);
                    editCustomerForm.find('input[name="google_map_link"]').val(customer.google_map_link);
                    editCustomerForm.find('input[name="website"]').val(customer.website);
                    editCustomerForm.find('textarea[name="specialization"]').val(customer.specialization);
                    editCustomerForm.find('input[name="facebook_link"]').val(customer.facebook_link);
                    editCustomerForm.find('input[name="linkedin_link"]').val(customer.linkedin_link);
                    editCustomerForm.find('input[name="youtube_link"]').val(customer.youtube_link);
                    editCustomerForm.find('input[name="x_link"]').val(customer.x_link);
                    editCustomerForm.find('input[name="instagram_link"]').val(customer.instagram_link);
                    editCustomerForm.find('[name="is_active"]').prop('checked', customer.is_active == 1).val(customer.is_active);
                    editCustomerForm.find('[name="category_id"]').val(customer.category_id).trigger('change');

                    const profileInput = editCustomerForm.find('[name="profile_photo"]').closest('.upload-box').get(0);
                    if (profileInput && typeof profileInput.setImage === 'function') {
                        profileInput.setImage(customer.profile_photo); 
                    }

                    if(customer.company_logo){
                        const companyLogoInput = editCustomerForm.find('[name="company_logo"]').closest('.upload-box').get(0);
                        if (companyLogoInput && typeof companyLogoInput.setImage === 'function') {
                            companyLogoInput.setImage(customer.company_logo);
                        }
                    }

                    // Clear existing media upload boxes
                    const mediaWrapper = editCustomerForm.find('.media-wrapper').get(0);
                    mediaWrapper.innerHTML = '';

                    // Add medias from event
                    const medias = customer.media_images || [];
                    medias.forEach((media) => {
                        const newmediaBox = createUploadBox('media[]', 'removeMediaImg', media.id);
                        mediaWrapper.appendChild(newmediaBox);
                        newmediaBox.setImage?.(media.image);
                    });

                    $('.media-wrapper').find('input[type="file"]').prop('disabled', true).attr('readonly', true); // Disable file input

                    if (customer.company_video) {
                        const videoWrapper = editCustomerForm.find('.company_video-wrapper').get(0);
                        const videoInput = videoWrapper.querySelector("input[name='company_video']");
                        const videoTag = videoWrapper.querySelector(".upload-video-trigger");
                        const placeholderImg = videoWrapper.querySelector(".upload-placeholder");
                        const removeBtn = videoWrapper.querySelector(".remove-video-btn");

                        if (videoInput && videoTag) {
                            videoInput.value = ''; // Clear input
                            videoTag.src = `${APP_URL}/storage/${customer.company_video}`; // Set new source
                            videoTag.style.display = 'block'; // Show video
                            placeholderImg.style.display = 'none'; // Hide placeholder
                            removeBtn.style.display = 'block'; // Show remove button
                        }
                    } else {
                        // ✅ ELSE PART — handle when there is no company video
                        const videoWrapper = editCustomerForm.find('.company_video-wrapper').get(0);
                        const videoInput = videoWrapper?.querySelector("input[name='company_video']");
                        const videoTag = videoWrapper?.querySelector(".upload-video-trigger");
                        const placeholderImg = videoWrapper?.querySelector(".upload-placeholder");
                        const removeBtn = videoWrapper?.querySelector(".remove-video-btn");

                        if (videoInput && videoTag) {
                            videoInput.value = ''; // Clear file input
                            videoTag.src = ''; // Remove video source
                            videoTag.style.display = 'none'; // Hide video player
                            placeholderImg.style.display = 'block'; // Show placeholder image
                            removeBtn.style.display = 'none'; // Hide remove button
                        }
                    }


                }
            });
        }

        window.fetchCustomerMembership = function(id){
            $('#upgrade-tab').tab('show');
            $('#upgrade-tab').trigger('click');
            $('#customer-membership-modals').modal('show');
            loadingBlock();
            window.axiosApiClient.post(`admin/customer/view/${id}`,{},{
                headers: {
                            'Authorization': 'Bearer ' + getAuthToken()
                        }
            }).then(response => {
                var updateMembershipForm = $('#updateMembershipForm');
                window.resetForm('#updateMembershipForm');

                if (response.data.status) {
                    var customer = response.data.data;
                    
                    updateMembershipForm.find('input[name="customer_id"]').val(customer.id);
                    updateMembershipForm.find('input[name="old_plan_id"]').val(customer.plan_type);
                    $('.cust_plan_type').text(customer.membership_plan.name);
                    
                    $('.cust_start_date').text(customer.plan_started_at ? formatDateTime(customer.plan_started_at) : 'Unlimited');
                    $('.cust_end_date').text(customer.plan_expired_at ? formatDateTime(customer.plan_expired_at) : 'Unlimited');
                    
                    const statusInfo = checkPlanExpiry(customer.plan_expired_at);
                    
                    $('.days-left').html(`<span class="badge bg-light-${statusInfo.daysLeft > 0 ? 'success' : 'danger'}">${statusInfo.status}</span>`);
                    $('.standard-radio-box').show();
                    $('.premium-radio-box').show();
                    $('.plan_transaction_container').hide();
                    if (customer.plan_type == 2 && statusInfo.daysLeft > 90) {
                        $('.standard-radio-box').hide();
                    } else if (customer.plan_type == 3) {
                        $('.standard-radio-box').hide(); // Always hide for plan 3
                        if (statusInfo.daysLeft > 90) {
                            $('.premium-radio-box').hide();
                        }
                    }


                }
            });
        }

        window.fetchCategoryList = function() {
            checkTokenExpiry();
            // loadingBlock();
            window.axiosApiClient.get('admin/customer/get-all-categories', {
                headers: { 'Authorization': 'Bearer ' + getAuthToken() }
            })
            .then(response => {
                $('select.category_id').find('option:not(:first)').remove();
                response.data.data.forEach(category => {
                    $('select.category_id').append(`<option value="${category.id}">${category.name}</option>`);
                });
                initializeSelect2WithClearButton('select.category_id');
            });
        };
        fetchCategoryList();

        window.selectTab = (e) => {
            // Remove active, prev, and next classes from all tabs
            const tabContainer = document.querySelector('#myTab');
            tabContainer.querySelectorAll('.nav-link').forEach(tab => {
                tab.classList.remove('active', 'prev', 'next');
            });
        
            // Set clicked tab to active
            const currentTab = e.target;
            currentTab.classList.add('active');
        
            // Add prev and next classes if available
            if (currentTab?.previousElementSibling) {
                currentTab.previousElementSibling?.classList.add('prev');
            }
            if (currentTab?.nextElementSibling) {
                currentTab.nextElementSibling?.classList.add('next');
            }
        };

        window.fetchCustomerActivityHistory = function() {
            loadingBlock();
            let id = $('input[name="customer_id"]').val();
            window.axiosApiClient.post(`admin/customer/activity/${id}`, {}, {
                headers: {
                    'Authorization': 'Bearer ' + getAuthToken()
                }
            }).then(response => {
                if (response.data.status) {
                    const tableData = response.data.data;

                    // Destroy previous instance if exists
                    if ($.fn.DataTable.isDataTable('#customer-transactions-table')) {
                        $('#customer-transactions-table').DataTable().destroy();
                    }

                    // Clear old data
                    $('#customer-transactions-table tbody').empty();

                    // Populate new data
                    var statusMapping = {
                        'pending': { title: 'Pending', class: 'badge-light-warning' },
                        'completed': { title: 'Completed', class: 'badge-light-success' },
                        'failed': { title: 'Failed', class: 'badge-light-danger' },
                        'refunded': { title: 'Refunded', class: 'badge-light-primary' },
                    };
                    
                    tableData.forEach(row => {
                        let statusInfo = checkPlanExpiry(row.expire_date);
                        
                        
                        var statusKey = String(row.status).trim(); // Ensure string consistency
                        
                        if (!statusMapping.hasOwnProperty(statusKey)) {
                            return ''; // Return default data if value is unexpected
                        }
                        
                        let status_pill = '<span class="badge rounded-pill ' +
                            statusMapping[statusKey].class +
                            '">' +
                            statusMapping[statusKey].title +
                            '</span>';

                        $('#customer-transactions-table tbody').append(`
                            <tr>
                                <td>${row.transactionable.name}</td>
                                <td>${formatDate(row.start_date)}</td>
                                <td>${(row.transactionable.id != 1) ? formatDate(row.expire_date) : 'Unlimited'}</td>
                                <td>${row.currency_type == 'INR' ? '&#8377;' : '$'}${row.total_amount}</td>
                                <td>${status_pill}</td>
                                <td>${row.status == 'completed' ? ((statusInfo.daysLeft <= 0 ) ? '<span class="badge rounded-pill badge-light-danger">Expired</span>' : '<span class="badge rounded-pill badge-light-success">Active</span>') : ''}</td>
                                </tr>
                        `);
                    });

                    // Initialize DataTable
                    $('#customer-transactions-table').DataTable();
                }
            });
        }

        $('button[data-bs-target="#activity"]').on('shown.bs.tab', function () {
            window.fetchCustomerActivityHistory();
        });

        $('#search_key').on('keyup input change', function() {
            let clear_btn = $(this).closest('.table-header-search').find('.clear-btn');
            if ($(this).val().length > 0) {
                clear_btn.show();  // Show button when input has text
            } else {
                clear_btn.hide();  // Hide button when empty
            }
        });
    
        $('.clear-btn').on('click', function() {
            $(this).closest('.table-header-search').find('#search_key').val('').trigger('change'); // Clear input and trigger event
            customer_table.search('').draw();
        });

        
        $(document).on('click', '.add-customer', function () {
            var addCustomerForm = $('#addCustomerForm');
            addCustomerForm.find(".select2").val(null).trigger("change");
            window.resetForm('#addCustomerForm');
            $('.mobile_feedback').text('');
            $('.email_feedback').text('');
            $('.username_feedback').text('');
            removeBtn.click();
            $('#customer-add-modals').modal('show');
        });
    
        $('input[name="joining_date"]').on('change', function () {
            var selectedDate = $(this).val();
            var form = $(this).closest('form'); // Get the closest form
        
            if (selectedDate) {
                var separationPicker = form.find('input[name="separation_date"]').pickadate('picker');
                if (separationPicker) {
                    separationPicker.set('min', selectedDate); // Set min date to joining date
                    separationPicker.set('max', new Date());  // Set max date to today
                }
            }
        });
    
        $('#resetFilters').on('click', function () {
            $('#search_key').val('').trigger('change');
            $('#plan_type').val('').trigger('change');
            $('#is_active').val('').trigger('change');
            customer_table.ajax.reload(); // Reload table with reset filters
            $(this).prop('disabled', true);
        });
    
        $('#search_key, #plan_type, #is_active').on('change keyup', function () {
            customer_table.ajax.reload(); // Reload table when any filter changes
        });

        $('.filter-container').on('change keyup', '#search_key, #plan_type, #is_active', function () {
            let isAnyFieldFilled = false;
        
            $('.filter-container').find('input, select').each(function () {
                if ($(this).val().trim() !== '') {
                    isAnyFieldFilled = true;
                    return false; // Exit loop early if any field is filled
                }
            });
        
            $('#resetFilters').prop('disabled', !isAnyFieldFilled);
        });

        $('#addCustomerForm').validate({
            rules: {
                first_name: {
                    required: true,
                    alphanumeric: true,
                    minlength: 3,
                    maxlength: 50
                },
                last_name: {
                    required: true,
                    alphanumeric: true,
                    minlength: 3,
                    maxlength: 50
                },
                username: {
                    required: true,
                    alphanumeric: true,
                    minlength: 3,
                    maxlength: 50
                },
                    password: {
                    required: true,
                    minlength: 6,
                    maxlength: 20,
                    strongPassword: true
                },
                "confirm-password": {
                    required: true,
                    equalTo: "[name='password']"
                },
                email: {
                    required: true,
                    email: true,
                    maxlength: 50
                },
                mobile_no: {
                    required: true,
                    minlength: 7,
                    maxlength: 15
                    // validPhone: true
                },
                category_id: {
                    required: true,
                },
                specialization: {
                    maxlength: 200
                },
                company_name: {
                    required: true,
                    maxlength: 50
                },
                company_address: {
                    required: true,
                    maxlength: 250
                },
                google_map_link: {
                    url: true,
                    maxlength: 255,
                },
                business_description: {
                    maxlength: 255,
                },
                trn_no: {
                    maxlength: 20
                },
                website: {
                    url: true,
                    maxlength: 100
                },
                facebook_link: {
                    url: true,
                    maxlength: 250
                },
                x_link: {
                    url: true,
                    maxlength: 250
                },
                linkedin_link: {
                    url: true,
                    maxlength: 250
                },
                youtube_link: {
                    url: true,
                    maxlength: 250
                },
                instagram_link: {
                    url: true,
                    maxlength: 250
                },
                profile_photo: {
                    accept: "image/jpeg,image/png,image/gif,image/webp",
                    filesize: 2 * 1024 * 1024 // 2MB limit
                },
                company_logo: {
                    accept: "image/jpeg,image/png,image/gif,image/webp",
                    fileSize: 2048, // in kb - 2mb
                },
                'media[]': {
                    accept: "image/jpeg,image/png,image/gif,image/webp",
                    fileSize: 2048, // in kb - 2mb
                },
                company_video: {
                    accept: "video/mp4,video/webm,video/ogg",
                    fileSize: 10 * 1024 // in kb - 10mb
                }
            },
            messages: {
                first_name: {
                    required: "Please enter customer first name",
                    alphanumeric: "Only alphabets, numbers, spaces, and dots (.) are allowed.",
                    minlength: "Customer first name should be between 3-50 characters.",
                    maxlength: "Customer first name should be between 3-50 characters."
                },
                last_name: {
                    required: "Please enter customer last name",
                    alphanumeric: "Only alphabets, numbers, spaces, and dots (.) are allowed.",
                    minlength: "Customer last name should be between 3-50 characters.",
                    maxlength: "Customer last name should be between 3-50 characters."
                },
                username: {
                    required: "Please enter customer username",
                    alphanumeric: "Only alphabets, numbers, spaces, and dots (.) are allowed.",
                    minlength: "Customer username should be between 3-50 characters.",
                    maxlength: "Customer username should be between 3-50 characters."
                },
                password: {
                    required: "Please enter a password.",
                    minlength: "Password must be at least 6 characters long.",
                    maxlength: "Password must not exceed 20 characters.",
                    strongPassword: "Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character."
                },
                "confirm-password": {
                    required: "Please confirm your password.",
                    equalTo: "Passwords do not match."
                },
                email: {
                    required: "Email ID is required",
                    email: "Please enter a valid email address",
                    maxlength: "Email ID must not exceed 50 characters"
                },
                mobile_no: {
                    required: "Please enter mobile number.",
                    minlength: "Mobile number should be between 7-15 characters.",
                    maxlength: "Mobile number should be between 7-15 characters."
                },
                category_id: {
                    required: "Please select a category"
                },
                specialization: {
                    maxlength: "Specialization must not exceed 200 characters"
                },
                company_name: {
                    required: "Please enter company name",
                    maxlength: "Company name must not exceed 50 characters"
                },
                company_address: {
                    required: "Please enter company address",
                    maxlength: "Company address must not exceed 250 characters"
                },
                google_map_link: {
                    url: "Please enter a valid Google Map link",
                    maxlength: "Google Map link must not exceed 255 characters"
                },
                business_description: {
                    maxlength: "Business description must not exceed 255 characters"
                },
                trn_no: {
                    maxlength: "Tax id should not exceed 20 characters"
                },
                website: {
                    url: "Please enter a valid website URL",
                    maxlength: "Website URL must not exceed 100 characters"
                },
                facebook_link: {
                    url: "Please enter a valid Facebook URL",
                    maxlength: "Facebook URL must not exceed 250 characters"
                },
                x_link: {
                    url: "Please enter a valid X (Twitter) URL",
                    maxlength: "Twitter URL must not exceed 250 characters"
                },
                linkedin_link: {
                    url: "Please enter a valid LinkedIn URL",
                    maxlength: "LinkedIn URL must not exceed 250 characters"
                },
                youtube_link: {
                    url: "Please enter a valid YouTube URL",
                    maxlength: "YouTube URL must not exceed 250 characters"
                },
                instagram_link: {
                    url: "Please enter a valid Instagram URL",
                    maxlength: "Instagram URL must not exceed 250 characters"
                },
                profile_photo: {
                    accept: "Only image files (JPEG, PNG, GIF, WEBP) are allowed",
                    filesize: "File size must be less than 2MB"
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
                    fileSize: "Company video must be less than 10MB"
                }
            },
            onkeyup: function (element) {
                $(element).valid(); // Validate on keypress
            },
            onfocusout: function (element) {
                $(element).valid(); // Validate on focus out
            },
            onchange: function (element) {
                $(element).valid(); // Validate on change
            },
            // submitHandler: async function (form, event) {
            //     event.preventDefault();
            //     $(form).find('button[type="submit"]').attr('disabled', 'disabled');
            //     var formData = new FormData(form);

            //     let countryCode = null;
            //     let isoCode = null;
            //     $(form).find(".mobile").each(function () {
            //         const $input = $(this);
            //         const fieldName = $input.attr("name");
                
            //         // Skip if no name or irrelevant name
            //         if (!fieldName || (!fieldName.includes("mobile") && !fieldName.includes("contact"))) {
            //             return;
            //         }
                
            //         // Get intlTelInput instance
            //         const itiInstance = window.intlTelInputGlobals.getInstance(this);
            //         if (!itiInstance) return;
                
            //         countryCode = `+${itiInstance.getSelectedCountryData().dialCode}`;
            //         isoCode = itiInstance.getSelectedCountryData().iso2.toUpperCase();
                
            //     });

            //     const profilePhotoInput = $(form).find("[name=profile_photo]")[0];
            //     let profilePhotoBase64 = null;

            //     if (profilePhotoInput.files.length > 0) {
            //         profilePhotoBase64 = await getBase64(profilePhotoInput.files[0]);
            //     }

            //     const companyLogoInput = $(form).find("[name=company_logo]")[0];
            //     let companyLogoBase64 = null;

            //     if (companyLogoInput.files.length > 0) {
            //         companyLogoBase64 = await getBase64(companyLogoInput.files[0]);
            //     }

            //     const mediaInputs = $(form).find("[name='media[]']");
            //     let mediaBase64 = [];

            //     for (let mediaInput of mediaInputs) {
            //         if (mediaInput.files.length > 0) {
            //             const mediaFile = mediaInput.files[0];
            //             const mediaBase64File = await getBase64(mediaFile);
            //             mediaBase64.push(mediaBase64File);
            //         }
            //     }

            //     const videoInput = $(form).find("input[name='company_video']")[0];
            //     let companyVideoBase64 = null;
            //     if (videoInput.files.length > 0) {
            //         companyVideoBase64 = await getBase64(videoInput.files[0]);
            //     }

            //     const payload = {
            //         first_name: $(form).find("[name=first_name]").val(),
            //         last_name: $(form).find("[name=last_name]").val(),
            //         username: $(form).find("[name=username]").val(),
            //         email: $(form).find("[name=email]").val(),
            //         mobile_no: $(form).find("[name=mobile_no]").val(),
            //         password: $(form).find("[name=password]").val(),
            //         mobile_no_cc: countryCode,
            //         mobile_no_ic: isoCode,
            //         profile_photo: profilePhotoBase64,
            //         category_id: $(form).find("[name=category_id]").val(),
            //         company_name: $(form).find("[name=company_name]").val(),
            //         company_address: $(form).find("[name=company_address]").val(),
            //         google_map_link: $(form).find("[name=google_map_link]").val(),
            //         business_description: $(form).find("[name=business_description]").val(),
            //         trn_no: $(form).find("[name=trn_no]").val(),
            //         website: $(form).find("[name=website]").val(),
            //         facebook_link: $(form).find("[name=facebook_link]").val(),
            //         x_link: $(form).find("[name=x_link]").val(),
            //         linkedin_link: $(form).find("[name=linkedin_link]").val(),
            //         youtube_link: $(form).find("[name=youtube_link]").val(),
            //         instagram_link: $(form).find("[name=instagram_link]").val(),
            //         specialization: $(form).find("[name=specialization]").val(),
            //         plan_type: $(form).find("[name=plan_type]").val(),
            //         is_active: $(form).find("[name=is_active]").val(),
            //         company_logo: companyLogoBase64,
            //         media_images: mediaBase64,
            //         company_video: companyVideoBase64
            //     };
                   

            //     loadingBlock();

            //     window.axiosApiClient.post('admin/customer/addnew', payload, {
            //         headers: {
            //             'Authorization': 'Bearer ' + getAuthToken()
            //         }
            //     }).then(response => {
            //         $(form).find('button[type="submit"]').removeAttr('disabled');
            //         toastr.success('Customer created successfully.', 'Success!');
            //         //Swal.fire('Success!', 'Customer details have been updated successfully.', 'success');
            //         // fetchCustomerDetails();
            //         $('#add-customer-modals').modal('hide');

            //         customer_table.ajax.reload();
            //     }).catch(error => {
            //         $(form).find('button[type="submit"]').removeAttr('disabled');
            //     })
            // }
           submitHandler: function (form, event) {

                event.preventDefault();

                const $submitBtn =
                    $(form).find('button[type="submit"]');

                $submitBtn.attr('disabled', 'disabled');


                /*
                =================================
                CREATE FORMDATA
                =================================
                */

                let formData = new FormData(form);


                /*
                =================================
                ADD COUNTRY CODE
                =================================
                */

                let countryCode = null;
                let isoCode = null;

                $(form).find(".mobile").each(function () {

                    const itiInstance =
                        window.intlTelInputGlobals.getInstance(this);

                    if (!itiInstance) return;

                    countryCode =
                        '+' +
                        itiInstance.getSelectedCountryData().dialCode;

                    isoCode =
                        itiInstance
                            .getSelectedCountryData()
                            .iso2
                            .toUpperCase();

                });

                formData.append('mobile_no_cc', countryCode);
                formData.append('mobile_no_ic', isoCode);


                /*
                =================================
                HANDLE MEDIA FILES
                =================================
                */

                const mediaInputs =
                    $(form).find("[name='media[]']");

                for (let i = 0; i < mediaInputs.length; i++) {

                    if (mediaInputs[i].files.length > 0) {

                        formData.append(
                            'media_images[]',
                            mediaInputs[i].files[0]
                        );
                    }
                }


                loadingBlock();


                /*
                =================================
                API CALL
                =================================
                */

                window.axiosApiClient.post(
                    'admin/customer/addnew',
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
                )

                .then(response => {

                    $submitBtn.removeAttr('disabled');

                    toastr.success(
                        'Customer created successfully.',
                        'Success!'
                    );

                    $('#add-customer-modals')
                        .modal('hide');

                    customer_table.ajax.reload();

                })

                .catch(error => {

                    $submitBtn.removeAttr('disabled');

                    console.error(error);

                    toastr.error(
                        'Something went wrong'
                    );

                });

            }
        });
        $('body').on('click', '.remove-image-btn, .remove-video-btn',function(){
            let $uploadBox = $(this).closest('.upload-box');
            let userId = $(this).closest('form').find('input[name=user_id]').val();
            let type = $uploadBox.data('name');
            let file = $uploadBox.find('input[type=file]').val();

            if ((!file || file.length === 0) && userId) {
                loadingBlock();
                window.axiosApiClient.post(`/admin/customer/removeUploaded`,{userId:userId, type: type},{
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
        $('body').on('click', '.removeMediaImg',function(){
            let id  = $(this).data('id');
            if(id != 0){
                loadingBlock();
                window.axiosApiClient.post(`/admin/customer/media/remove/${id}`,{},{
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

        $('#editCustomerForm').validate({
            rules: {
                first_name: {
                    required: true,
                    alphanumeric: true,
                    minlength: 3,
                    maxlength: 50
                },
                last_name: {
                    required: true,
                    alphanumeric: true,
                    minlength: 3,
                    maxlength: 50
                },
                username: {
                    required: true,
                    alphanumeric: true,
                    minlength: 3,
                    maxlength: 50
                },
                email: {
                    required: true,
                    email: true,
                    maxlength: 50
                },
                mobile_no: {
                    required: true,
                    minlength: 7,
                    maxlength: 15
                    // validPhone: true
                },
                category_id: {
                    required: true,
                },
                specialization: {
                    maxlength: 200
                },
                company_name: {
                    required: true,
                    maxlength: 50
                },
                company_address: {
                    required: true,
                    maxlength: 250
                },
                google_map_link: {
                    url: true,
                    maxlength: 255,
                },
                business_description: {
                    maxlength: 255,
                },
                trn_no: {
                    maxlength: 20
                },
                website: {
                    url: true,
                    maxlength: 100
                },
                facebook_link: {
                    url: true,
                    maxlength: 250
                },
                x_link: {
                    url: true,
                    maxlength: 250
                },
                linkedin_link: {
                    url: true,
                    maxlength: 250
                },
                youtube_link: {
                    url: true,
                    maxlength: 250
                },
                instagram_link: {
                    url: true,
                    maxlength: 250
                },
                profile_photo: {
                    accept: "image/jpeg,image/png,image/gif,image/webp",
                    filesize: 2 * 1024 * 1024 // 2MB limit
                },
                company_logo: {
                    accept: "image/jpeg,image/png,image/gif,image/webp",
                    fileSize: 2048, // in kb - 2mb
                },
                'media[]': {
                    accept: "image/jpeg,image/png,image/gif,image/webp",
                    fileSize: 2048, // in kb - 2mb
                },
                company_video: {
                    accept: "video/mp4,video/webm,video/ogg",
                    fileSize: 10 * 1024 // in kb - 10mb
                }
            },
            messages: {
                first_name: {
                    required: "Please enter customer first name",
                    alphanumeric: "Only alphabets, numbers, spaces, and dots (.) are allowed.",
                    minlength: "Customer first name should be between 3-50 characters.",
                    maxlength: "Customer first name should be between 3-50 characters."
                },
                last_name: {
                    required: "Please enter customer last name",
                    alphanumeric: "Only alphabets, numbers, spaces, and dots (.) are allowed.",
                    minlength: "Customer last name should be between 3-50 characters.",
                    maxlength: "Customer last name should be between 3-50 characters."
                },
                username: {
                    required: "Please enter customer username",
                    alphanumeric: "Only alphabets, numbers, spaces, and dots (.) are allowed.",
                    minlength: "Customer username should be between 3-50 characters.",
                    maxlength: "Customer username should be between 3-50 characters."
                },
                email: {
                    required: "Email ID is required",
                    email: "Please enter a valid email address",
                    maxlength: "Email ID must not exceed 50 characters"
                },
                mobile_no: {
                    required: "Please enter mobile number.",
                    minlength: "Mobile number should be between 7-15 characters.",
                    maxlength: "Mobile number should be between 7-15 characters."
                },
                category_id: {
                    required: "Please select a category"
                },
                specialization: {
                    maxlength: "Specialization must not exceed 200 characters"
                },
                company_name: {
                    required: "Please enter company name",
                    maxlength: "Company name must not exceed 50 characters"
                },
                company_address: {
                    required: "Please enter company address",
                    maxlength: "Company address must not exceed 250 characters"
                },
                google_map_link: {
                    url: "Please enter a valid Google Map link",
                    maxlength: "Google Map link must not exceed 255 characters"
                },
                business_description: {
                    maxlength: "Business description must not exceed 255 characters"
                },
                trn_no: {
                    maxlength: "Tax id should not exceed 20 characters"
                },
                website: {
                    url: "Please enter a valid website URL",
                    maxlength: "Website URL must not exceed 100 characters"
                },
                facebook_link: {
                    url: "Please enter a valid Facebook URL",
                    maxlength: "Facebook URL must not exceed 250 characters"
                },
                x_link: {
                    url: "Please enter a valid X (Twitter) URL",
                    maxlength: "Twitter URL must not exceed 250 characters"
                },
                linkedin_link: {
                    url: "Please enter a valid LinkedIn URL",
                    maxlength: "LinkedIn URL must not exceed 250 characters"
                },
                youtube_link: {
                    url: "Please enter a valid YouTube URL",
                    maxlength: "YouTube URL must not exceed 250 characters"
                },
                instagram_link: {
                    url: "Please enter a valid Instagram URL",
                    maxlength: "Instagram URL must not exceed 250 characters"
                },
                profile_photo: {
                    accept: "Only image files (JPEG, PNG, GIF, WEBP) are allowed",
                    filesize: "File size must be less than 2MB"
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
                    fileSize: "Company video must be less than 10MB"
                }
            },
            onkeyup: function (element) {
                $(element).valid(); // Validate on keypress
            },
            onfocusout: function (element) {
                $(element).valid(); // Validate on focus out
            },
            onchange: function (element) {
                $(element).valid(); // Validate on change
            },
            /* submitHandler: async function (form, event) {
                event.preventDefault();
                $(form).find('button[type="submit"]').attr('disabled', 'disabled');
                var formData = new FormData(form);

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

                const profilePhotoInput = $(form).find("[name=profile_photo]")[0];
                let profilePhotoBase64 = null;

                if (profilePhotoInput.files.length > 0) {
                    profilePhotoBase64 = await getBase64(profilePhotoInput.files[0]);
                }

                const companyLogoInput = $(form).find("[name=company_logo]")[0];
                let companyLogoBase64 = null;

                if (companyLogoInput.files.length > 0) {
                    companyLogoBase64 = await getBase64(companyLogoInput.files[0]);
                }

                const mediaInputs = $(form).find("[name='media[]']");
                let mediaBase64 = [];

                for (let mediaInput of mediaInputs) {
                    if (mediaInput.files.length > 0) {
                        const mediaFile = mediaInput.files[0];
                        const mediaBase64File = await getBase64(mediaFile);
                        mediaBase64.push(mediaBase64File);
                    }
                }

                const videoInput = $(form).find("input[name='company_video']")[0];
                let companyVideoBase64 = null;
                if (videoInput.files.length > 0) {
                    companyVideoBase64 = await getBase64(videoInput.files[0]);
                }

                const payload = {
                    user_id: $(form).find("[name=user_id]").val(),
                    first_name: $(form).find("[name=first_name]").val(),
                    last_name: $(form).find("[name=last_name]").val(),
                    username: $(form).find("[name=username]").val(),
                    email: $(form).find("[name=email]").val(),
                    mobile_no: $(form).find("[name=mobile_no]").val(),
                    mobile_no_cc: countryCode,
                    mobile_no_ic: isoCode,
                    profile_photo: profilePhotoBase64,
                    category_id: $(form).find("[name=category_id]").val(),
                    company_name: $(form).find("[name=company_name]").val(),
                    company_address: $(form).find("[name=company_address]").val(),
                    google_map_link: $(form).find("[name=google_map_link]").val(),
                    business_description: $(form).find("[name=business_description]").val(),
                    trn_no: $(form).find("[name=trn_no]").val(),
                    website: $(form).find("[name=website]").val(),
                    facebook_link: $(form).find("[name=facebook_link]").val(),
                    x_link: $(form).find("[name=x_link]").val(),
                    linkedin_link: $(form).find("[name=linkedin_link]").val(),
                    youtube_link: $(form).find("[name=youtube_link]").val(),
                    instagram_link: $(form).find("[name=instagram_link]").val(),
                    specialization: $(form).find("[name=specialization]").val(),
                    plan_type: $(form).find("[name=plan_type]").val(),
                    is_active: $(form).find("[name=is_active]").val(),
                    company_logo: companyLogoBase64,
                    media_images: mediaBase64,
                    company_video: companyVideoBase64
                };
                   

                loadingBlock();

                window.axiosApiClient.post('admin/customer/update', payload, {
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken()
                    }
                }).then(response => {
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                    toastr.success('Customer details have been updated successfully.', 'Success!');
                    //Swal.fire('Success!', 'Customer details have been updated successfully.', 'success');
                    // fetchCustomerDetails();
                    $('#customer-detail-modals').modal('hide');

                    customer_table.ajax.reload();
                }).catch(error => {
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                })
            } */
        
        submitHandler: function (form, event) {

    event.preventDefault();

    $(form).find('button[type="submit"]').attr('disabled', 'disabled');

    var formData = new FormData(form);
    let emailValue = $(form).find("[name=email]").val();

    formData.append('email', emailValue);

    let mobile_no = $(form).find("[name=mobile_no]").val();
    formData.append('mobile_no', mobile_no);

    let countryCode = null;
    let isoCode = null;

    $(form).find(".mobile").each(function () {

        const itiInstance =
            window.intlTelInputGlobals.getInstance(this);

        if (!itiInstance) return;

        countryCode =
            `+${itiInstance.getSelectedCountryData().dialCode}`;

        isoCode =
            itiInstance.getSelectedCountryData().iso2.toUpperCase();

    });

    formData.append("mobile_no_cc", countryCode);
    formData.append("mobile_no_ic", isoCode);

    loadingBlock();

    window.axiosApiClient.post(
        'admin/customer/update',
        formData,
        {
            headers: {
                'Authorization': 'Bearer ' + getAuthToken(),
                'Content-Type': 'multipart/form-data'
            }
        }
    )
    .then(response => {

        $(form)
            .find('button[type="submit"]')
            .removeAttr('disabled');

        toastr.success(
            'Customer details updated successfully',
            'Success!'
        );

        $('#customer-detail-modals').modal('hide');

        customer_table.ajax.reload();

    })
    .catch(error => {

        $(form)
            .find('button[type="submit"]')
            .removeAttr('disabled');

    });
}
        });

        $(document).on('click', '.add-customer', function () {
            var addCustomerForm = $('#addCustomerForm');
            addCustomerForm.find(".select2").val(null).trigger("change");
            window.resetForm('#addCustomerForm');
            $('#add-customer-modals').modal('show');
        });

        $(document).on('change', 'input[name="profile_photo"]', function () {
            $(this).valid();
        });

        $('#updateMembershipForm').validate({
            rules: {
                plan_type: {
                    required: true,
                },
                payment_id: {
                    required: true,
                    alphanumeric: true,
                    minlength: 3,
                    maxlength: 20
                },
                transaction_date: {
                    required: true,
                },
                payment_mode: {
                    required: true,
                },
                amount : {
                    required: true,
                    number: true,
                    min: 0,
                    max: 99999
                },
                
            },
            messages: {
                plan_type: {
                    required: "Please select a plan type",
                },
                payment_id: {
                    required: "Please enter payment ID",
                    alphanumeric: "Only alphabets, numbers, spaces, and dots (.) are allowed.",
                    minlength: "Payment ID should be between 3-20 characters.",
                    maxlength: "Payment ID should be between 3-20 characters."
                },
                transaction_date: {
                    required: "Please select transaction date",
                },
                payment_mode: {
                    required: "Please select payment mode",
                },
                amount : {
                    required: "Please enter payment amount",
                    number: "Please enter a valid number",
                    min: "Amount should be between 0 to 99999.",
                    max: "Amount should be between 0 to 99999."

                },
                
            },
            onkeyup: function (element) {
                $(element).valid(); // Validate on keypress
            },
            onfocusout: function (element) {
                $(element).valid(); // Validate on focus out
            },
            onchange: function (element) {
                $(element).valid(); // Validate on change
            },
            submitHandler: function (form, event) {
                event.preventDefault();

                Swal.fire({
                    title: "Are you sure?",
                    text: "Do you want to update this membership record?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, Update it!",
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(form).find('button[type="submit"]').attr('disabled', 'disabled');
                        
                        const payload = {
                            customer_id: $(form).find("[name=customer_id]").val(),
                            plan_type: $(form).find("[name='plan_type']:checked").val(),

                            payment_id: $(form).find("[name=payment_id]").val(),
                            payment_mode: $(form).find("[name=payment_mode]").val(),
                            currency_type: $(form).find("[name=currency_type]").val(),
                            amount: $(form).find("[name=amount]").val(),
                            transaction_date: $(form).find("[name=transaction_date]").val(),
                            transaction_date_submit: $(form).find("[name=transaction_date_submit]").val(),
                            note: $(form).find("[name=note]").val()

                        };   

                        loadingBlock();
        
                        window.axiosApiClient.post('admin/customer/membership/update', payload, {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                                'Authorization': 'Bearer ' + getAuthToken()
                            }
                        }).then(response => {
                            $(form).find('button[type="submit"]').removeAttr('disabled');
                            toastr.success(response.data.message, 'Success!');

                            // toastr.success('Membership details have been updated successfully.', 'Success!');
                            $('#customer-membership-modals').modal('hide');
                            customer_table.ajax.reload();
                        }).catch(error => {
                            $(form).find('button[type="submit"]').removeAttr('disabled');
                        })
                    }
                });

            }
        });
        
                                     
    });

    function toggleTransactionContainer() { 
        const form = $('#updateMembershipForm');
        const selectedPlan = form.find('[name=plan_type]:checked').val();
        const oldPlan = form.find('[name=old_plan_id]').val();
        const transactionContainer = $('.plan_transaction_container');
        const amountInput = form.find('[name=amount]');
    
        if (selectedPlan === '1') {
            transactionContainer.hide();
            amountInput.val(''); // clear amount when not needed
        } else {
            transactionContainer.show();
    
            // Set amount based on old and selected plan values
            if (oldPlan === '1' && selectedPlan === '2') {
                amountInput.val('5999');
            } else if (oldPlan === '1' && selectedPlan === '3') {
                amountInput.val('9999');
            } else if (oldPlan === '2' && selectedPlan === '2') {
                amountInput.val('5999');
            } else if (oldPlan === '2' && selectedPlan === '3') {
                amountInput.val('4000');
            } else if (oldPlan === '3' && selectedPlan === '3') {
                amountInput.val('9999');
            } else {
                amountInput.val(''); // fallback if no match
            }
        }
    }
    
    // $('[name=username]').on('keyup', function () {
    //     let $this = $(this);
    //     let userName = $this.val();

    //     // Allow only letters, numbers, spaces, and dots
    //     const validUsernameRegex = /^[a-zA-Z0-9 .]+$/;

    //     if (userName.length >= 3) {
    //         if (!validUsernameRegex.test(userName)) {
    //             $this.removeClass('is-valid').addClass('is-invalid');
    //             $('.username_feedback').text('').removeClass('valid-feedback invalid-feedback');
    //             return; // Exit early, don't make API call
    //         }

    //         const payload = {
    //             username: userName,
    //         };

    //         window.axiosApiClient.post('admin/customer/check-valid-username', payload, {
    //             headers: {
    //                 'Authorization': 'Bearer ' + getAuthToken()
    //             }
    //         }).then(response => {
    //             if (response.data?.status) {
    //                 $this.removeClass('is-invalid').addClass('is-valid');
    //                 $('.username_feedback').text(response.data?.message).addClass('valid-feedback').removeClass('invalid-feedback');
    //             } else {
    //                 $this.removeClass('is-valid').addClass('is-invalid');
    //                 $('.username_feedback').text(response.data?.message).addClass('invalid-feedback').removeClass('valid-feedback');
    //             }
    //         });
    //     } else {
    //         $this.removeClass('is-valid is-invalid');
    //         $('.username_feedback').text('').removeClass('valid-feedback invalid-feedback');
    //     }
    // });

    window.checkValidUser = function(payload) {
        window.axiosApiClient.post('/check-valid-user', payload)
        .then(response => {
            if (payload.type === 'username') {
                const $feedback = $('.username_feedback');
                if (response.data?.status) {
                    $feedback
                        .text(response.data.message)
                        .addClass('valid-feedback')
                        .removeClass('invalid-feedback');
                    $('[name="username"]').removeClass('is-invalid').addClass('is-valid');
                } else {
                    $feedback
                        .text(response.data.message)
                        .addClass('invalid-feedback')
                        .removeClass('valid-feedback');
                    $('[name="username"]').removeClass('is-valid').addClass('is-invalid');
                }
            }

            if (payload.type === 'email') {
                const $feedback = $('.email_feedback');
                if (response.data?.status) {
                    $feedback
                        .text(response.data.message)
                        .addClass('valid-feedback')
                        .removeClass('invalid-feedback');
                    $('[name="email"]').removeClass('is-invalid').addClass('is-valid');
                } else {
                    $feedback
                        .text(response.data.message)
                        .addClass('invalid-feedback')
                        .removeClass('valid-feedback');
                    $('[name="email"]').removeClass('is-valid').addClass('is-invalid');
                }
            }

            if (payload.type === 'mobile') {
                const $feedback = $('.mobile_feedback');
                if (response.data?.status) {
                    $feedback
                        .text(response.data.message)
                        .removeClass('invalid-feedback d-block')
                        .addClass('valid-feedback d-block');
                    $('[name="mobile_no"]').removeClass('is-invalid').addClass('is-valid');
                } else {
                    $feedback
                        .text(response.data.message)
                        .removeClass('valid-feedback d-block')
                        .addClass('invalid-feedback d-block');
                    $('[name="mobile_no"]').removeClass('is-valid').addClass('is-invalid');
                }
            }
        });
    };


    // Username validation
    $('#addCustomerForm [name=username]').on('keyup', function () {
        let $this = $(this);
        let userName = $this.val().trim();
        const $feedback = $('.username_feedback');
        $feedback.text('').removeClass('valid-feedback invalid-feedback');
        $this.removeClass('is-valid is-invalid');

        const usernameRegex = /^[a-zA-Z0-9 .]+$/;

        if (userName.length >= 3 && usernameRegex.test(userName)) {
            const payload = {
                type: 'username',
                data: userName,
            };
            checkValidUser(payload);
        }
    });


    // Email validation
    $('#addCustomerForm [name=email]').on('keyup', function () {
        let $this = $(this);
        let email = $this.val().trim();
        const $feedback = $('.email_feedback');
        $feedback.text('').removeClass('valid-feedback invalid-feedback');
        $this.removeClass('is-valid is-invalid');

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (email.length >= 6 && emailRegex.test(email)) {
            const payload = {
                type: 'email',
                data: email,
            };
            checkValidUser(payload);
        }
    });

    // mobile validation
    $('#addCustomerForm [name=mobile_no]').on('keyup', function () {
        let $this = $(this);
        let mobile_no = $this.val().trim();
        const $feedback = $('.mobile_feedback');
        $feedback.text('').removeClass('valid-feedback invalid-feedback d-block');
        $this.removeClass('is-valid is-invalid');

        const mobileRegex = /^\d{10}$/;

        if (mobile_no.length >= 6 && mobileRegex.test(mobile_no)) {
            const payload = {
                type: 'mobile',
                data: mobile_no,
            };
            checkValidUser(payload);
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

    const $videoWrapper = $('.company_video-wrapper');
    const videoInput = $videoWrapper.find("input[name='company_video']");
    const videoTag = $videoWrapper.find(".upload-video-trigger");
    const placeholderImg = $videoWrapper.find(".upload-placeholder");
    const removeBtn = $videoWrapper.find(".remove-video-btn");

    videoInput.on("change", function () {
        const file = this.files[0];

        // Check if file exists, is a video, and size is less than 10MB
        if (file && file.type.startsWith("video/") && file.size < 10 * 1024 * 1024) {
            const videoURL = URL.createObjectURL(file);
            videoTag.attr("src", videoURL).show();
            placeholderImg.hide();
            removeBtn.show();
        } else {
            // If invalid type or size too large
            if (file) {
                if (!file.type.startsWith("video/")) {
                    alert("Please upload a valid video file.");
                } else if (file.size >= 10 * 1024 * 1024) {
                    alert("Video file size must be less than 10 MB.");
                }
            }

            // Reset UI
            $(this).val("");
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
    
    // Attach event listener
    $('#updateMembershipForm').find('[name=plan_type]').on('change', toggleTransactionContainer);

    // NOTE: ------ PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
})(window);