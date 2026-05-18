(function (window, undefined){
    'use strict';

    document.addEventListener("DOMContentLoaded", function() {

        // call from custom.js
        
        // ========================  
        window.fetchEventList = function() {
            checkTokenExpiry();
            // loadingBlock();
            window.axiosApiClient.get('admin/event/get-all-events', {
                headers: { 'Authorization': 'Bearer ' + getAuthToken() }
            })
            .then(response => {
                $('select.event_type').find('option:not(:first)').remove();
                $('select.event_type').append(`<option value="all">All</option>`);
                response.data.data.forEach(event => {
                    $('select.event_type').append(`<option value="${event.id}">${event.name}</option>`);
                });
                initializeSelect2WithClearButton('select.event_type');
            });
        }

        window.fetchCustomerList = function() {
            checkTokenExpiry();
            // loadingBlock();
            window.axiosApiClient.get('admin/customer/get-all-customers', {
                headers: { 'Authorization': 'Bearer ' + getAuthToken() }
            })
            .then(response => {
                $('select.user_specific').find('option:not(:first)').remove();
                response.data.data.forEach(customer => {
                    $('select.user_specific').append(`<option value="${customer.id}">${customer.first_name} (${customer.email})</option>`);
                });
                initializeSelect2WithClearButton('select.user_specific');
            });
        }

        fetchEventList();
        fetchCustomerList();

        $('#addCouponForm').find('input[name="start_date"]').pickadate('picker').set('min', new Date());
        $('#addCouponForm').find('input[name="end_date"]').pickadate('picker').set('min', new Date());
        
        window.coupon_plan_table = $('#coupon-list-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + '/api/admin/coupon/list',
                type: 'GET',
                data: function (d) {
                    d.search_key = $('#search_key').val();
                    d.date_from = $('#date_from').val();
                    d.date_to = $('#date_to').val();
                    d.is_active = $('#is_active').val();
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
                    data: 'coupon_code', 
                    title: 'Coupon Code', 
                    render: function (data, type, full, meta) {
                        var $coupon_code = full['coupon_code'];
                
                        return (
                            '<div class="d-flex flex-column justify-content-center align-items-start">' +
                            '<a class="emp-name" data-bs-toggle="tooltip" data-bs-placement="top" title="'+ $coupon_code +'" href="javascript:void(0);" onclick="fetchCouponRecords('+ full['id'] +')">' +
                            '<span class="emp-name text-truncate fw-bold">' + $coupon_code + '</span>' +
                            '</a>' +
                            '</div>'
                        );
                    } 
                }, 
                {
                    data: 'coupon_name',
                    title: 'Coupon Name',
                    render: function (data, type, full, meta) {
                        return full['coupon_name'] || '-';
                    }
                },
                {
                    data: 'coupon_type',
                    title: 'Service Name',
                    render: function (data, type, full, meta) {
                        if (!data) return '-';

                        // snake_case ko split karke har word ka first letter uppercase
                        return data
                            .split('_')
                            .map(function(word) {
                                return word.charAt(0).toUpperCase() + word.slice(1);
                            })
                            .join(' ');
                    }
                },
                {
                    data: 'start_date',
                    title: 'Start Date',
                    render: function (data, type, full, meta) {
                        return (full['start_date']) ? formatDate(full['start_date']) : '-';
                    }
                },
                {
                    data: 'end_date',
                    title: 'End Date',
                    render: function (data, type, full, meta) {
                        return (full['end_date']) ? formatDate(full['end_date']) : '-';
                    }
                },
                {
                    data: 'is_active', 
                    title: 'Status',
                    render: function (data, type, full, meta) {
                        var statusMapping = {
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
                            'data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Plan" onclick="fetchCouponRecords(' + full['id'] + ')">' +
                            '<i class="bi bi-pencil-square"></i>' +
                            '</a>';
                        
                        html += '<a href="javascript:;" class="item-edit text-danger me-2" ' +
                            'data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Coupon" onclick="deleteCouponRecords(' + full['id'] + ')">' +
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
                emptyTable: `<p class="text-center my-3">No coupons found</p>`
            }
        });

        window.fetchCouponRecords = function(id){
            $('input[name="coupon_id"]').val(id);
            $('#coupon-detail-modals').modal('show');
            fetchCouponDetails();
        }
        window.deleteCouponRecords= function(id){
            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to delete this event record?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Delete it!",
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    loadingBlock();
                    window.axiosApiClient.post(`admin/coupon/remove/${id}`,{},{
                        headers: {
                            'Authorization': 'Bearer ' + getAuthToken()
                        }
                    }).then(response => {
                        if (response.data.status) {
                            toastr.success('Coupon deleted successfully.', 'Success!');
                            coupon_plan_table.ajax.reload();
                        }
                    });
    
                }
            });
            
        }

        window.fetchCouponDetails = function() {
            loadingBlock();
            let id = $('input[name="coupon_id"]').val();
            window.axiosApiClient.post(`admin/coupon/view/${id}`,{},{
                headers: {
                            'Authorization': 'Bearer ' + getAuthToken()
                        }
            }).then(response => {
                var editCouponForm = $('#editCouponForm');
                window.resetForm('#editCouponForm');

                if (response.data.status) {
                    var coupon = response.data.data;

                    
                    $('input[name="coupon_id"]').val(coupon.id);

                    editCouponForm.find('[name="coupon_name"]').val(coupon.coupon_name);
                    editCouponForm.find('[name="coupon_code"]').val(coupon.coupon_code);
                    editCouponForm.find('[name="marketing_text"]').val(coupon.marketing_text);
                    editCouponForm.find('[name="start_date"]').pickadate('picker').set('select', moment(coupon.start_date, "YYYY-MM-DD").format("DD/MM/YYYY"));
                    editCouponForm.find('[name="end_date"]').pickadate('picker').set('select', moment(coupon.end_date, "YYYY-MM-DD").format("DD/MM/YYYY"));
                    editCouponForm.find('[name="coupon_type"]').val(coupon.coupon_type).trigger('change');
                    if(coupon.coupon_type == 'membership'){
                        editCouponForm.find('[name="membership_type"]').val(coupon.membership_type).trigger('change');
                        editCouponForm.find('[name="membership_type"]').closest('.form-group').show();
                    }
                    else if(coupon.coupon_type == 'event'){
                        editCouponForm.find('[name="event_type"]').val(coupon.event_type).trigger('change');
                        editCouponForm.find('[name="event_type"]').closest('.form-group').show();
                    }
                    else if(coupon.coupon_type == 'user_specific' && coupon.user_specific){
                        let selectedUsers = JSON.parse(coupon.user_specific);
                        if (selectedUsers.length > 0) {
                            editCouponForm.find('[name="user_specific"]').val(selectedUsers).trigger('change');
                            editCouponForm.find('[name="user_specific"]').closest('.form-group').show();
                        }
                    }
                    editCouponForm.find('[name="discount_type"]').val(coupon.discount_type).trigger('change');
                    
                    if(coupon.discount_type == 'flat'){
                        editCouponForm.find('[name="discount_flat_inr"]').val(coupon.discount_flat_inr);
                        editCouponForm.find('[name="discount_flat_usd"]').val(coupon.discount_flat_usd);
                        editCouponForm.find('[name="minimum_purchase_inr"]').val(coupon.minimum_purchase_inr);
                        editCouponForm.find('[name="minimum_purchase_usd"]').val(coupon.minimum_purchase_usd);
                        editCouponForm.find('[name="discount_flat_inr"]').closest('.form-group').show();
                        editCouponForm.find('[name="minimum_purchase_inr"]').closest('.form-group').show();

                    }
                    else if(coupon.discount_type == 'percent'){
                        editCouponForm.find('[name="discount_percent_inr"]').val(coupon.discount_percent_inr);
                        editCouponForm.find('[name="discount_percent_usd"]').val(coupon.discount_percent_usd);
                        editCouponForm.find('[name="maximum_discount_inr"]').val(coupon.maximum_discount_inr);
                        editCouponForm.find('[name="maximum_discount_usd"]').val(coupon.maximum_discount_usd);
                        editCouponForm.find('[name="discount_percent_inr"]').closest('.form-group').show();
                        editCouponForm.find('[name="maximum_discount_inr"]').closest('.form-group').show();

                    }
                    editCouponForm.find('[name="max_use_per_user"]').val(coupon.max_use_per_user);
                    editCouponForm.find('[name="is_active"]').prop('checked', coupon.is_active == 1).val(coupon.is_active);

                    $('#coupon-detail-modals').modal('show');
                }
            });
        }

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
            coupon_plan_table.ajax.reload();
        });

        $(document).on('click', '.add-coupon', function () {
            var addCouponForm = $('#addCouponForm');
            addCouponForm.find(".select2").val(null).trigger("change");
            window.resetForm('#addCouponForm');
            addCouponForm.find('[name="membership_type"]').closest('.form-group').hide();
            addCouponForm.find('[name="event_type"]').closest('.form-group').hide();
            addCouponForm.find('[name="user_specific"]').closest('.form-group').hide();
            addCouponForm.find('[name="discount_flat_inr"]').closest('.form-group').hide();
            addCouponForm.find('[name="discount_percent_inr"]').closest('.form-group').hide();
            addCouponForm.find('[name="maximum_discount_inr"]').closest('.form-group').hide();
            addCouponForm.find('[name="minimum_purchase_inr"]').closest('.form-group').hide();
            $('#add-coupon-modals').modal('show');
        });
    
        
        $('input[name="start_date"]').on('change', function () {
            var selectedDate = $(this).val();
            var form = $(this).closest('form'); // Get the closest form
        
            if (selectedDate) {
                var separationPicker = form.find('input[name="end_date"]').pickadate('picker');
                if (separationPicker) {
                    separationPicker.set('min', selectedDate); // Set min date to joining date
                }
            }
        });

        $('#date_from').on('change', function () {
            const selectedDate = $(this).val();
            if (!selectedDate) return;
        
            const toPicker = $('#date_to').pickadate('picker');
            if (!toPicker) return;
        
            toPicker.set('min', selectedDate);
        
            // const to = toPicker.get('select');
            // if (to && new Date(to.year, to.month, to.date) > new Date(selectedDate)) {
            //     toPicker.clear();
            // }
        });  
    
        $('#resetFilters').on('click', function () {
            $('#search_key').val('');
            $('#date_from').val('');
            $('#date_to').val('');
            $('#is_active').val('').trigger('change');
            coupon_plan_table.ajax.reload(); // Reload table with reset filters
            $(this).prop('disabled', true);
        });
    
        $('#search_key, #is_active, #date_from, #date_to').on('change keyup', function () {
            coupon_plan_table.ajax.reload(); // Reload table when any filter changes
        });

        $('.filter-container').on('change keyup', '#search_key, #is_active, #date_from, #date_to', function () {
            let isAnyFieldFilled = false;
        
            $('.filter-container').find('input, select').each(function () {
                if ($(this).val().trim() !== '') {
                    isAnyFieldFilled = true;
                    return false; // Exit loop early if any field is filled
                }
            });
        
            $('#resetFilters').prop('disabled', !isAnyFieldFilled);
        });

        $('#addCouponForm').validate({
            rules: {
                coupon_name: {
                    required: true,
                    maxlength: 25,
                },
                coupon_code: {
                    required: true,
                    maxlength: 10,
                },
                marketing_text: {
                    required: true,
                    maxlength: 20
                },
                start_date: {
                    required: true,
                },
                end_date: {
                    required: true,
                    // greaterThan: '[name="start_date_submit"]'
                },
                coupon_type: {
                    required: true
                },
                membership_type: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="coupon_type"]').val() === 'membership';
                    }
                },
                event_type: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="coupon_type"]').val() === 'event';
                    }
                },
                user_specific: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="coupon_type"]').val() === 'user_specific';
                    }
                },
                discount_type: {
                    required: true
                },
                discount_flat_inr: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="discount_type"]').val() === 'flat';
                    },
                    max: 99999,
                    min: 0,
                    number: true
                },
                discount_flat_usd: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="discount_type"]').val() === 'flat';
                    },
                    max: 99999,
                    min: 0,
                    number: true
                },
                discount_percent_inr: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="discount_type"]').val() === 'percent';
                    },
                    // max: 99999,
                    max: 99,
                    min: 0,
                    number: true
                },
                discount_percent_usd: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="discount_type"]').val() === 'percent';
                    },
                    // max: 99999,
                    max: 99,
                    min: 0,
                    number: true
                },
                maximum_discount_inr: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="discount_type"]').val() === 'percent';
                    },
                    max: 99999,
                    min: 0,
                    number: true,
                },
                maximum_discount_usd: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="discount_type"]').val() === 'percent';
                    },
                    max: 99999,
                    min: 0,
                    number: true
                },
                minimum_purchase_inr: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="discount_type"]').val() === 'flat';
                    },
                    max: 99999,
                    min: 0,
                    number: true,
                },
                minimum_purchase_usd: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="discount_type"]').val() === 'flat';
                    },
                    max: 99999,
                    min: 0,
                    number: true
                },
                max_use_per_user:{
                    number: true,
                    maxlength: 2
                },
                status: {
                    required: true
                }
            },
            messages: {
                coupon_name: {
                    required: "Coupon name is required.",
                    maxlength: "Coupon name cannot exceed 25 characters."
                },
                coupon_code: {
                    required: "Coupon code is required.",
                    maxlength: "Coupon code cannot exceed 10 characters."
                },
                marketing_text: {
                    required: "Marketing text is required.",
                    maxlength: "Marketing text cannot exceed 20 characters."
                },
                start_date: {
                    required: "Start date is required."
                },
                end_date: {
                    required: "End date is required.",
                    // greaterThan: "End date must be greater than start date."
                },
                coupon_type: {
                    required: "Coupon type is required."
                },
                membership_type: {
                    required: "Membership type is required when coupon type is 'membership'."
                },
                event_type: {
                    required: "Event type is required when coupon type is 'event'."
                },
                user_specific: {
                    required: "Please select users when coupon type is 'user specific'."
                },
                discount_type: {
                    required: "Discount type is required."
                },
                discount_flat_inr: {
                    required: "INR flat discount is required for flat type.",
                    max: "INR flat discount cannot exceed 5 digits.",
                    min: "INR flat discount cannot be negative.",
                    number: "Please enter a valid number for INR flat discount."
                },
                discount_flat_usd: {
                    required: "USD flat discount is required for flat type.",
                    max: "USD flat discount cannot exceed 5 digits.",
                    min: "USD flat discount cannot be negative.",
                    number: "Please enter a valid number for USD flat discount."
                },
                discount_percent_inr: {
                    required: "INR discount percentage is required for percent type.",
                    number: "Please enter a valid percentage for INR.",
                    min: "INR discount percentage cannot be negative.",
                    max: "INR discount percentage cannot exceed 99.",
                },
                discount_percent_usd: {
                    required: "USD discount percentage is required for percent type.",
                    number: "Please enter a valid percentage for USD.",
                    max: "USD discount percentage cannot exceed 99.",
                    min: "USD discount percentage cannot be negative.",
                },
                maximum_discount_inr: {
                    required: "Maximum INR discount is required for percentage type.",
                    max: "Maximum INR discount cannot exceed 5 digits.",
                    min: "Maximum INR discount cannot be negative.",
                    number: "Please enter a valid number for maximum INR discount."
                },
                maximum_discount_usd: {
                    required: "Maximum USD discount is required for percentage type.",
                    max: "Maximum USD discount cannot exceed 5 digits.",
                    min: "Maximum USD discount cannot be negative.",
                    number: "Please enter a valid number for maximum USD discount."
                },
                minimum_purchase_inr: {
                    required: "Minimum INR purchase is required for flat type.",
                    max: "Minimum INR purchase cannot exceed 5 digits.",
                    min: "Minimum INR purchase cannot be negative.",
                    number: "Please enter a valid number for minimum INR purchase."
                },
                minimum_purchase_usd: {
                    required: "Minimum USD discount is required for flat type.",
                    max: "Minimum USD discount cannot exceed 5 digits.",
                    min: "Minimum USD discount cannot be negative.",
                    number: "Please enter a valid number for minimum USD discount."
                },
                max_use_per_user: {
                    maxlength: "Max uses per user cannot exceed 2 digits.",
                    number: "Please enter a valid number for max uses per user."
                },
                status: {
                    required: "Status is required."
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
            submitHandler: async function (form, event) {
                event.preventDefault();
                $(form).find('button[type="submit"]').attr('disabled', 'disabled');
                // var formData = new FormData(form);

                const payload = {
                    coupon_name: $(form).find("[name=coupon_name]").val(),
                    coupon_code: $(form).find("[name=coupon_code]").val(),
                    marketing_text: $(form).find("[name=marketing_text]").val(),
                    start_date: $(form).find("[name=start_date_submit]").val(),
                    end_date: $(form).find("[name=end_date_submit]").val(),
                    coupon_type: $(form).find("[name=coupon_type]").val(),
                    membership_type: $(form).find("[name=membership_type]").val(),
                    event_type: $(form).find("[name=event_type]").val(),
                    user_specific: $(form).find("[name=user_specific]").val(),
                    discount_type: $(form).find("[name=discount_type]").val(),
                    discount_flat_inr: $(form).find("[name=discount_flat_inr]").val(),
                    discount_flat_usd: $(form).find("[name=discount_flat_usd]").val(),
                    discount_percent_inr: $(form).find("[name=discount_percent_inr]").val(),
                    discount_percent_usd: $(form).find("[name=discount_percent_usd]").val(),
                    maximum_discount_inr: $(form).find("[name=maximum_discount_inr]").val(),
                    maximum_discount_usd: $(form).find("[name=maximum_discount_usd]").val(),
                    minimum_purchase_inr: $(form).find("[name=minimum_purchase_inr]").val(),
                    minimum_purchase_usd: $(form).find("[name=minimum_purchase_usd]").val(),
                    max_use_per_user: $(form).find("[name=max_use_per_user]").val(),
                    is_active: $(form).find("[name=is_active]").val(),
                };

                loadingBlock();

                window.axiosApiClient.post('admin/coupon/addnew', payload, {
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken()
                    }
                }).then(response => {
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                    toastr.success('Coupon details have been added successfully.', 'Success!');
                    $('#add-coupon-modals').modal('hide');
                    coupon_plan_table.ajax.reload();
                }).catch(error => {
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                })
            }
        });

        $('#editCouponForm').validate({
            rules: {
                coupon_name: {
                    required: true,
                    maxlength: 25,
                },
                coupon_code: {
                    required: true,
                    maxlength: 10,
                },
                marketing_text: {
                    required: true,
                    maxlength: 20
                },
                start_date: {
                    required: true,
                },
                end_date: {
                    required: true,
                    // greaterThan: '[name="start_date_submit"]'
                },
                coupon_type: {
                    required: true
                },
                membership_type: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="coupon_type"]').val() === 'membership';
                    }
                },
                event_type: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="coupon_type"]').val() === 'event';
                    }
                },
                user_specific: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="coupon_type"]').val() === 'user_specific';
                    }
                },
                discount_type: {
                    required: true
                },
                discount_flat_inr: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="discount_type"]').val() === 'flat';
                    },
                    max: 99999,
                    min: 0,
                    number: true
                },
                discount_flat_usd: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="discount_type"]').val() === 'flat';
                    },
                    max: 99999,
                    min: 0,
                    number: true
                },
                discount_percent_inr: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="discount_type"]').val() === 'percent';
                    },
                    max: 99,
                    min: 0,
                    number: true
                },
                discount_percent_usd: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="discount_type"]').val() === 'percent';
                    },
                    max: 99,
                    min: 0,
                    number: true
                },
                maximum_discount_inr: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="discount_type"]').val() === 'percent';
                    },
                    max: 99999,
                    min: 0,
                    number: true,
                },
                maximum_discount_usd: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="discount_type"]').val() === 'percent';
                    },
                    max: 99999,
                    min: 0,
                    number: true
                },
                minimum_purchase_inr: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="discount_type"]').val() === 'flat';
                    },
                    max: 99999,
                    min: 0,
                    number: true,
                },
                minimum_purchase_usd: {
                    required: function (element) {
                        return $(element).closest('form').find('[name="discount_type"]').val() === 'flat';
                    },
                    max: 99999,
                    min: 0,
                    number: true
                },
                max_use_per_user:{
                    number: true,
                    maxlength: 2
                },
                status: {
                    required: true
                }
            },
            messages: {
                coupon_name: {
                    required: "Coupon name is required.",
                    maxlength: "Coupon name cannot exceed 25 characters."
                },
                coupon_code: {
                    required: "Coupon code is required.",
                    maxlength: "Coupon code cannot exceed 10 characters."
                },
                marketing_text: {
                    required: "Marketing text is required.",
                    maxlength: "Marketing text cannot exceed 20 characters."
                },
                start_date: {
                    required: "Start date is required."
                },
                end_date: {
                    required: "End date is required.",
                    // greaterThan: "End date must be greater than start date."
                },
                coupon_type: {
                    required: "Coupon type is required."
                },
                membership_type: {
                    required: "Membership type is required when coupon type is 'membership'."
                },
                event_type: {
                    required: "Event type is required when coupon type is 'event'."
                },
                user_specific: {
                    required: "Please select users when coupon type is 'user specific'."
                },
                discount_type: {
                    required: "Discount type is required."
                },
                discount_flat_inr: {
                    required: "INR flat discount is required for flat type.",
                    max: "INR flat discount cannot exceed 5 digits.",
                    min: "INR flat discount cannot be negative.",
                    number: "Please enter a valid number for INR flat discount."
                },
                discount_flat_usd: {
                    required: "USD flat discount is required for flat type.",
                    max: "USD flat discount cannot exceed 5 digits.",
                    min: "USD flat discount cannot be negative.",
                    number: "Please enter a valid number for USD flat discount."
                },
                discount_percent_inr: {
                    required: "INR discount percentage is required for percent type.",
                    max: "INR discount percentage cannot exceed 99.",
                    min: "INR discount percentage cannot be negative.",
                    number: "Please enter a valid percentage for INR."
                },
                discount_percent_usd: {
                    required: "USD discount percentage is required for percent type.",
                    max: "USD discount percentage cannot exceed 99.",
                    min: "USD discount percentage cannot be negative.",
                    number: "Please enter a valid percentage for USD."
                },
                maximum_discount_inr: {
                    required: "Maximum INR discount is required for percentage type.",
                    max: "Maximum INR discount cannot exceed 5 digits.",
                    min: "Maximum INR discount cannot be negative.",
                    number: "Please enter a valid number for maximum INR discount."
                },
                maximum_discount_usd: {
                    required: "Maximum USD discount is required for percentage type.",
                    max: "Maximum USD discount cannot exceed 5 digits.",
                    min: "Maximum USD discount cannot be negative.",
                    number: "Please enter a valid number for maximum USD discount."
                },
                minimum_purchase_inr: {
                    required: "Minimum INR purchase is required for flat type.",
                    max: "Minimum INR purchase cannot exceed 5 digits.",
                    min: "Minimum INR purchase cannot be negative.",
                    number: "Please enter a valid number for minimum INR purchase."
                },
                minimum_purchase_usd: {
                    required: "Minimum USD discount is required for flat type.",
                    max: "Minimum USD discount cannot exceed 5 digits.",
                    min: "Minimum USD discount cannot be negative.",
                    number: "Please enter a valid number for minimum USD discount."
                },
                max_use_per_user: {
                    maxlength: "Max uses per user cannot exceed 2 digits.",
                    number: "Please enter a valid number for max uses per user."
                },
                status: {
                    required: "Status is required."
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
            submitHandler: async function (form, event) {
                event.preventDefault();
                $(form).find('button[type="submit"]').attr('disabled', 'disabled');

                const payload = {
                    coupon_id : $(form).find("[name=coupon_id]").val(),
                    coupon_name: $(form).find("[name=coupon_name]").val(),
                    coupon_code: $(form).find("[name=coupon_code]").val(),
                    marketing_text: $(form).find("[name=marketing_text]").val(),
                    start_date: $(form).find("[name=start_date_submit]").val(),
                    end_date: $(form).find("[name=end_date_submit]").val(),
                    coupon_type: $(form).find("[name=coupon_type]").val(),
                    membership_type: $(form).find("[name=membership_type]").val(),
                    event_type: $(form).find("[name=event_type]").val(),
                    user_specific: $(form).find("[name=user_specific]").val(),
                    discount_type: $(form).find("[name=discount_type]").val(),
                    discount_flat_inr: $(form).find("[name=discount_flat_inr]").val(),
                    discount_flat_usd: $(form).find("[name=discount_flat_usd]").val(),
                    discount_percent_inr: $(form).find("[name=discount_percent_inr]").val(),
                    discount_percent_usd: $(form).find("[name=discount_percent_usd]").val(),
                    maximum_discount_inr: $(form).find("[name=maximum_discount_inr]").val(),
                    maximum_discount_usd: $(form).find("[name=maximum_discount_usd]").val(),
                    minimum_purchase_inr: $(form).find("[name=minimum_purchase_inr]").val(),
                    minimum_purchase_usd: $(form).find("[name=minimum_purchase_usd]").val(),
                    max_use_per_user: $(form).find("[name=max_use_per_user]").val(),
                    is_active: $(form).find("[name=is_active]").val(),
                };

                loadingBlock();

                window.axiosApiClient.post('admin/coupon/update', payload, {
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken()
                    }
                }).then(response => {
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                    toastr.success('Coupon have been updated successfully.', 'Success!');
                    $('#coupon-detail-modals').modal('hide');
                    coupon_plan_table.ajax.reload();
                }).catch(error => {
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                })
            }
        });

        $('select[name="coupon_type"]').on('change', function () {
            const selectedValue = $(this).val();
            const form = $(this).closest('form');
            
            form.find('select[name="membership_type"]').closest('.form-group').hide();
            form.find('select[name="event_type"]').closest('.form-group').hide();
            form.find('select[name="user_specific"]').closest('.form-group').hide();
            if (selectedValue === 'membership') {
                form.find('select[name="membership_type"]').closest('.form-group').show();
            } else if (selectedValue === 'event') {
                form.find('select[name="event_type"]').closest('.form-group').show();
            } else if (selectedValue === 'user_specific') {
                form.find('select[name="user_specific"]').closest('.form-group').show();

            }
        });
        
        $('select[name="discount_type"]').on('change', function () {
            const selectedValue = $(this).val();
            const form = $(this).closest('form');
            
            form.find('input[name="discount_flat_inr"]').closest('.form-group').hide();
            form.find('input[name="discount_percent_inr"]').closest('.form-group').hide();
            form.find('input[name="maximum_discount_inr"]').closest('.form-group').hide();
            form.find('input[name="minimum_purchase_inr"]').closest('.form-group').hide();
            
            if (selectedValue === 'flat') {
                form.find('input[name="discount_flat_inr"]').closest('.form-group').show();
                form.find('input[name="minimum_purchase_inr"]').closest('.form-group').show();
            } else if (selectedValue === 'percent') {
                form.find('input[name="discount_percent_inr"]').closest('.form-group').show();
                form.find('input[name="maximum_discount_inr"]').closest('.form-group').show();
            }
        });

        $('#addCouponForm [name=coupon_code]').on('input', function () {
            let $this = $(this);
            let couponCode = $this.val();
        
            if (couponCode.length >= 3) {
                const payload = {
                    coupon_code: couponCode,
                };
        
                // loadingBlock();
        
                window.axiosApiClient.post('admin/coupon/check-valid-coupon-code', payload, {
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken()
                    }
                }).then(response => {
                    if (response.data?.status) {
                        $this.removeClass('is-invalid').addClass('is-valid');
                        $('.coupon_code_feedback').text(response.data?.message).addClass('valid-feedback').removeClass('invalid-feedback');
                    } else {
                        $this.removeClass('is-valid').addClass('is-invalid');
                        $('.coupon_code_feedback').text(response.data?.message).addClass('invalid-feedback').removeClass('valid-feedback');
                    }
                });
            } else {
                $this.removeClass('is-valid is-invalid'); // Clear validation if less than 3 chars
            }
        });
        
        
                                     
    });

    // NOTE: ------ PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
})(window);