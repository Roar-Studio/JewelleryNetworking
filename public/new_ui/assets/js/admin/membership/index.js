(function (window, undefined){
    'use strict';

    document.addEventListener("DOMContentLoaded", function() {

        // call from custom.js
        
        // ========================       
        // Initialize CKEditors
        
        initCKEditor('#editMembershipForm [name="benefits"]', (editor, modal) => {
            window.benefitsEditorEdit = editor;
            attachFocusHandlers(editor, modal);
        });
    
        initCKEditor('#addMembershipForm [name="benefits"]', (editor, modal) => {
            window.benefitsEditorAdd = editor;
            attachFocusHandlers(editor, modal);
        });

        window.membership_plan_table = $('#membership-list-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + '/api/admin/membership/list',
                type: 'GET',
                data: function (d) {
                    d.search_key = $('#search_key').val();
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
                    data: 'name', 
                    title: 'Full Name', 
                    render: function (data, type, full, meta) {
                        var $name = full['name'];
                
                        return (
                            '<div class="d-flex flex-column justify-content-center align-items-start">' +
                            '<a class="emp-name" data-bs-toggle="tooltip" data-bs-placement="top" title="'+ $name +'" href="javascript:void(0);" onclick="fetchMembershipRecords('+ full['id'] +')">' +
                            '<span class="emp-name text-truncate fw-bold">' + $name + '</span>' +
                            '</a>' +
                            '</div>'
                        );
                    } 
                }, 
                {
                    data: 'amount_in_inr',
                    title: 'Amount(&#8377;)',
                    render: function (data, type, full, meta) {
                        
                        return convertCurrency(full['amount_in_inr'], 'INR');
                    }
                },
                {
                    data: 'amount_in_usd',
                    title: 'Amount($)',
                    render: function (data, type, full, meta) {
                        
                        return convertCurrency(full['amount_in_usd'], 'USD');
                    }
                },
                {
                    data: 'duration',
                    title: 'Duration',
                    render: function (data, type, full, meta) {
                        var $duration = (full['id'] != 1) ? `${full['duration']} days` : `Unlimited`;
                        return $duration;
                    }
                },
                {
                    data: 'description',
                    title: 'Description',
                    render: function (data, type, full, meta) {
                        return (full['description'] 
                            ? '<span class="emp-email text-truncate d-inline-block" ' +
                            'data-bs-toggle="tooltip" data-bs-placement="top" title="' + full['description'] + '" ' +
                            'style="max-width: 170px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">' +   full['description'] +
                            '</span>'
                            : ''
                        );
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
                        if(full['id'] != 1){        // if free plan do show edit btn
                            html += '<a href="javascript:;" class="item-edit me-2" ' +
                                'data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Plan" onclick="fetchMembershipRecords(' + full['id'] + ')">' +
                                '<i class="bi bi-pencil-square"></i>' +
                                '</a>';
                        }
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
                emptyTable: `<p class="text-center my-3">No membership found</p>`
            }
        });

        window.fetchMembershipRecords = function(id){
            $('input[name="membership_id"]').val(id);
            $('#membership-detail-modals').modal('show');
            fetchMembershipDetails();
        }
        window.fetchMembershipDetails = function() {
            loadingBlock();
            let id = $('input[name="membership_id"]').val();
            window.axiosApiClient.post(`admin/membership/view/${id}`,{},{
                headers: {
                            'Authorization': 'Bearer ' + getAuthToken()
                        }
            }).then(response => {
                var editMembershipForm = $('#editMembershipForm');
                window.resetForm('#editMembershipForm');

                if (response.data.status) {
                    var membership = response.data.data;

                    
                    $('input[name="membership_id"]').val(membership.id);

                    editMembershipForm.find('[name="name"]').val(membership.name);
                    editMembershipForm.find('[name="amount_in_inr"]').val(membership.amount_in_inr);
                    editMembershipForm.find('[name="amount_in_usd"]').val(membership.amount_in_usd);
                    editMembershipForm.find('[name="duration"]').val(membership.duration);
                    editMembershipForm.find('[name="description"]').val(membership.description);
                    editMembershipForm.find('[name="created_on"]').val(formatDateTime(membership.created_at));
                    editMembershipForm.find('[name="updated_on"]').val(formatDateTime(membership.updated_at));
                    benefitsEditorEdit.setData(membership.benefits || '');
                    editMembershipForm.find('[name="is_active"]').prop('checked', membership.is_active == 1).val(membership.is_active);
                    $('#mebership-detail-modals').modal('show');
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
            membership_plan_table.search('').draw();
        });

        $(document).on('click', '.add-membership-plan', function () {
            var addMembershipForm = $('#addMembershipForm');
            addMembershipForm.find(".select2").val(null).trigger("change");
            window.resetForm('#addMembershipForm');
            $('#add-membership-modals').modal('show');
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
            $('#is_active').val('').trigger('change');
            membership_plan_table.ajax.reload(); // Reload table with reset filters
            $(this).prop('disabled', true);
        });
    
        $('#search_key, #is_active').on('change keyup', function () {
            membership_plan_table.ajax.reload(); // Reload table when any filter changes
        });

        $('.filter-container').on('change keyup', '#search_key, #is_active', function () {
            let isAnyFieldFilled = false;
        
            $('.filter-container').find('input, select').each(function () {
                if ($(this).val().trim() !== '') {
                    isAnyFieldFilled = true;
                    return false; // Exit loop early if any field is filled
                }
            });
        
            $('#resetFilters').prop('disabled', !isAnyFieldFilled);
        });

        $('#addMembershipForm').validate({
            // ignore: ':hidden',
            rules: {
                name: {
                    required: true,
                    alphanumeric: true,
                    minlength: 3,
                    maxlength: 50
                },
                amount_in_inr: {
                    required: true,
                    number: true,
                    min: 0,
                    max: 999999
                },
                amount_in_usd: {
                    required: true,
                    number: true,
                    min: 0,
                    max: 999999

                },
                duration: {
                    required: true,
                    number: true,
                    min: 1,
                    max: 99999
                },
                description:{
                    required: true,
                    maxlength: 250
                },
                benefits:{
                    required: true,
                    maxPlainText: 1000
                }   
            },
            messages: {
                name: {
                    required: "Please enter Plan name",
                    alpha: "Only alphabets, numbers, spaces, and dots (.) are allowed.",
                    minlength: "Plan name should be between 3-50 characters.",
                    maxlength: "Plan name should be between 3-50 characters."
                },
                amount_in_inr: {
                    required: "Please enter Plan amount",
                    number: "Please enter a valid number.",
                    min: "Amount should be a positive number."
                },
                amount_in_usd: {
                    required: "Please enter Plan amount",
                    number: "Please enter a valid number.",
                    min: "Amount should be a positive number."
                },
                duration: {
                    required: "Please enter Plan duration",
                    number: "Please enter a valid number.",
                    min: "Duration should be a positive number.",
                    max: "Duration cannot exceed 5 characters."
                },
                description: {
                    required: "Please enter the description.",
                    maxlength: "Description should be between 0-250 characters."
                },
                benefits: {
                    required: "Please enter the benefits.",
                    maxPlainText: "Benefits must not exceed 1000 plain text characters."
                }
            },
            onkeyup: function (element) {
                const name = $(element).attr('name');
                if (name !== 'benefits') {
                    $(element).valid();
                }
            },
            onfocusout: function (element) {
                // $(element).valid(); // Validate on focus out
                const name = $(element).attr('name');
    
                if (name !== 'benefits') {
                    $(element).valid();
                }
            },
            onchange: function (element) {
                const name = $(element).attr('name');
                if (name !== 'benefits') {
                    $(element).valid();
                }
            },
            submitHandler: function (form, event) {
                event.preventDefault();
                $(form).find('button[type="submit"]').attr('disabled', 'disabled');
                
                const payload = {
                    name: $(form).find("[name=name]").val(),
                    amount_in_inr: $(form).find("[name=amount_in_inr]").val(),
                    amount_in_usd: $(form).find("[name=amount_in_usd]").val(),
                    duration: $(form).find("[name=duration]").val(),
                    description: $(form).find("[name=description]").val(),
                    benefits: benefitsEditorAdd.getData(),
                    is_active: $(form).find("[name=is_active]").val(),
                }; 

                loadingBlock();

                window.axiosApiClient.post('admin/membership/addnew', payload, {
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken()
                    }
                }).then(response => {
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                    toastr.success('Plan details have been added successfully.', 'Success!');
                    $('#add-membership-modals').modal('hide');
                    membership_plan_table.ajax.reload();
                }).catch(error => {
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                })
            }
        });

        $('#editMembershipForm').validate({
            ignore: ':hidden, [name="benefits"]',
            rules: {
                name: {
                    required: true,
                    alphanumeric: true,
                    minlength: 3,
                    maxlength: 50
                },
                amount_in_inr: {
                    required: true,
                    number: true,
                    min: 0,
                    max: 999999
                },
                amount_in_usd: {
                    required: true,
                    number: true,
                    min: 0,
                    max: 999999
                },
                duration: {
                    required: true,
                    number: true,
                    min: 1,
                    max: 99999
                },
                description:{
                    maxlength: 250
                }   
            },
            messages: {
                name: {
                    required: "Please enter Plan name",
                    alpha: "Only alphabets, numbers, spaces, and dots (.) are allowed.",
                    minlength: "Plan name should be between 3-50 characters.",
                    maxlength: "Plan name should be between 3-50 characters."
                },
                amount_in_inr: {
                    required: "Please enter Plan amount",
                    number: "Please enter a valid number.",
                    min: "Amount should be a positive number.",
                    max: "Fees cannot exceed 6 characters"
                },
                amount_in_usd: {
                    required: "Please enter Plan amount",
                    number: "Please enter a valid number.",
                    min: "Amount should be a positive number.",
                    max: "Fees cannot exceed 6 characters"

                },
                duration: {
                    required: "Please enter Plan duration",
                    number: "Please enter a valid number.",
                    min: "Duration should be a positive number.",
                    max: "Duration cannot exceed 5 characters."
                },
                description: {
                    maxlength: "Description should be between 0-250 characters."
                }
            },
            onkeyup: function (element) {
                const name = $(element).attr('name');
                if (name !== 'benefits') {
                    $(element).valid();
                }
            },
            onfocusout: function (element) {
                // $(element).valid(); // Validate on focus out
                const name = $(element).attr('name');
    
                if (name !== 'benefits') {
                    $(element).valid();
                }
            },
            onchange: function (element) {
                const name = $(element).attr('name');
                if (name !== 'benefits') {
                    $(element).valid();
                }
            },
            submitHandler: function (form, event) {
                event.preventDefault();
                $(form).find('button[type="submit"]').attr('disabled', 'disabled');
            
                const payload = {
                    membership_id: $(form).find("[name=membership_id]").val(),
                    name: $(form).find("[name=name]").val(),
                    amount_in_inr: $(form).find("[name=amount_in_inr]").val(),
                    amount_in_usd: $(form).find("[name=amount_in_usd]").val(),
                    duration: $(form).find("[name=duration]").val(),
                    description: $(form).find("[name=description]").val(),
                    benefits: benefitsEditorEdit.getData(),
                    is_active: $(form).find("[name=is_active]").val(),
                };

                loadingBlock();

                window.axiosApiClient.post('admin/membership/update', payload, {
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken()
                    }
                }).then(response => {
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                    toastr.success('Plan details have been updated successfully.', 'Success!');
                    $('#mebership-detail-modals').modal('hide');
                    membership_plan_table.ajax.reload();
                }).catch(error => {
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                })
            }
        });
        
                                     
    });

    // NOTE: ------ PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
})(window);