(function (window, undefined){
    'use strict';

    document.addEventListener("DOMContentLoaded", function() {

        // call from custom.js
        
        // ========================       
        $('#addEventForm').find('input[name="display_start_date"]').pickadate('picker').set('min', new Date());
        $('#addEventForm').find('input[name="event_start_date"]').pickadate('picker').set('min', new Date());
        $('#addEventForm').find('input[name="event_end_date"]').pickadate('picker').set('min', new Date());
        // $('#to_date').pickadate('picker').set('min', new Date());


        window.event_plan_table = $('#event-list-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + '/api/admin/event/list',
                type: 'GET',
                data: function (d) {
                    d.search_key = $('#search_key').val();
                    d.event_type = $('#event_type').val();
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
                    data: 'name', 
                    title: 'Event Name', 
                    render: function (data, type, full, meta) {
                        var $name = full['name'];
                
                        return (
                            '<div class="d-flex flex-column justify-content-center align-items-start">' +
                            '<a class="emp-name" data-bs-toggle="tooltip" data-bs-placement="top" title="'+ $name +'" href="javascript:void(0);" onclick="fetchEventRecords('+ full['id'] +')">' +
                            '<span class="emp-name text-truncate fw-bold">' + $name + '</span>' +
                            '</a>' +
                            '</div>'
                        );
                    } 
                }, 
                {
                    data: 'event_type',
                    title: 'Event Type',
                    render: function (data, type, full, meta) {
                        return (full['event_type'] ? full['event_type'].charAt(0).toUpperCase() + full['event_type'].slice(1) : '-');
                    }                    
                },
                {
                    data: 'venue_address', 
                    title: 'Venue',
                    render: function (data, type, full, meta) {
                        
                        return (full['venue_address'] 
                            ? '<span class="emp-email text-truncate d-inline-block" ' +
                            'data-bs-toggle="tooltip" data-bs-placement="top" title="' + full['venue_address'] + '" ' +
                            'style="max-width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">' +   full['venue_address'] +
                            '</span>'
                            : ''
                        );
                    }
                },
                {
                    data: 'google_maps_link', 
                    title: 'Map Link',
                    render: function (data, type, full, meta) {
                        return (
                            full['google_maps_link']
                            ? '<span class="emp-email text-truncate d-inline-block" ' +
                            'data-bs-toggle="tooltip" data-bs-placement="top" title="' + full['google_maps_link'] + '" ' +
                            'style="max-width: 200px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">' +   full['google_maps_link'] +
                            '</span>'
                            : ''
                        );
                    }
                },
                {
                    data: 'event_start_datetime',
                    title: 'Event Date',
                    render: function (data, type, full, meta) {
                        return (full['event_start_datetime']) ? formatDateTime(full['event_start_datetime']) : '-';
                    }
                },
                {
                    data: 'completed_transaction_count',
                    title: 'Total Registered Attendees',
                    render: function (data, type, full, meta) {
                        var $completed_transaction_count = full['completed_transaction_count'] || 0;
                
                        return (
                            $completed_transaction_count > 0
                            ? `<div class="d-flex flex-column justify-content-center align-items-start">
                                <a class="emp-name" data-bs-toggle="tooltip" data-bs-placement="top" title="${$completed_transaction_count}" href="javascript:void(0);" onclick="fetchRegisteredPersons(${ full['id'] })">
                                <span class="emp-name text-truncate fw-bold">${$completed_transaction_count}</span>
                                </a>
                            </div>`
                            : $completed_transaction_count
                        );
                    }
                },
                {
                    data: 'display_start_date',
                    title: 'Registration Start Date',
                    render: function (data, type, full, meta) {
                        return (full['display_start_date']) ? formatDate(full['display_start_date']) : '-';
                    }
                },
                {
                    data: 'display_end_date',
                    title: 'Registration End Date',
                    render: function (data, type, full, meta) {
                        return (full['display_end_date']) ? formatDate(full['display_end_date']) : '-';
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
                            'data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Event" onclick="fetchEventRecords(' + full['id'] + ')">' +
                            '<i class="bi bi-pencil-square"></i>' +
                            '</a>';
                        html += '<a href="javascript:;" class="item-edit text-danger me-2" ' +
                            'data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Event" onclick="deleteEventRecords(' + full['id'] + ')">' +
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
            order: [[6, 'desc']],
            dom: '<"table-box"t><"d-flex border-top justify-content-between mx-0"<""l><""i><""p>>',
            displayLength: 15,
            lengthMenu: [15, 25, 50, 75, 100],
            language: {
                paginate: {
                    previous: '&nbsp;',
                    next: '&nbsp;'
                },
                emptyTable: `<p class="text-center my-3">No events found</p>`
            }
        });

        window.fetchEventRecords = function(id){
            $('input[name="event_id"]').val(id);
            $('#event-detail-modals').modal('show');
            fetchEventDetails();
        }

        $('#eventEndsOnNext, #eventEndsOnNexte').on('change', function () {
            if ($(this).is(':checked')) {
                $('input[name="event_end_time"]').closest('.form-group').show();
            } else {
                $('input[name="event_end_time"]').closest('.form-group').hide();
            }
        });

        $('select[name="event_type"]').on('change', function () {
            const selectedValue = $(this).val();
        
            if (selectedValue === 'paid') {
                $('input[name="amount_in_inr"]').closest('.form-group').show();
            } else {
                $('input[name="amount_in_inr"]').closest('.form-group').hide();
                $('input[name="amount_in_inr"], input[name="amount_in_usd"]').val('');
            }
        });

        $('body').on('click', '.removeSponserImg',function(){
            let id  = $(this).data('id');
            if(id != 0){
                loadingBlock();
                window.axiosApiClient.post(`admin/event/sponsor/remove/${id}`,{},{
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken()
                    }
                }).then(response => {
                    if (response.data.status) {
                        toastr.success('Sponsor Image deleted successfully.', 'Success!');
                        $(this).removeClass('removeSponserImg');
                    }
                });
            }
        });

        window.deleteEventRecords= function(id){
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
                    window.axiosApiClient.post(`admin/event/remove/${id}`,{},{
                        headers: {
                            'Authorization': 'Bearer ' + getAuthToken()
                        }
                    }).then(response => {
                        if (response.data.status) {
                            toastr.success('Event deleted successfully.', 'Success!');
                            event_plan_table.ajax.reload();
                        }
                    });
    
                }
            });
            
        }

        
        window.fetchEventDetails = function() {
            loadingBlock();
            let id = $('input[name="event_id"]').val();
            window.axiosApiClient.post(`admin/event/view/${id}`,{},{
                headers: {
                            'Authorization': 'Bearer ' + getAuthToken()
                        }
            }).then(response => {
                var editEventForm = $('#editEventForm');
                window.resetForm('#editEventForm');
                $('input[name="event_end_time"]').closest('.form-group').hide();

                if (response.data.status) {
                    var event = response.data.data;

                    
                    $('input[name="event_id"]').val(event.id);

                    editEventForm.find('[name="name"]').val(event.name);
                    editEventForm.find('[name="event_type"]').val(event.event_type).trigger('change');
                    editEventForm.find('[name="event_mode"]').val(event.event_mode).trigger('change');
                    editEventForm.find('[name="description"]').val(event.description);
                    editEventForm.find('[name="event_start_date"]').pickadate('picker').set('select', moment(event.event_start_datetime, "YYYY-MM-DD").format("DD/MM/YYYY"));
                    // editEventForm.find('[name="event_start_time"]').val(event.event_start_datetime ? moment(event.event_start_datetime, "YYYY-MM-DD HH:mm:ss").format("hh:mm A") : '');
                    editEventForm.find('[name="event_start_time"]').pickatime('picker')
                        .set('select', event.event_start_datetime 
                            ? moment(event.event_start_datetime, "YYYY-MM-DD HH:mm:ss").toDate() 
                            : null);

                    editEventForm.find('[name="event_start_datetime"]').val(event.event_start_datetime);
                    editEventForm.find('[name="event_end_date"]').val(event.event_end_datetime ? moment(event.event_end_datetime, "YYYY-MM-DD HH:mm:ss").format("DD/MM/YYYY") : '');
                    editEventForm.find('[name="event_end_time"]').val(event.event_end_datetime ? moment(event.event_end_datetime, "YYYY-MM-DD HH:mm:ss").format("hh:mm A") : '');
                    editEventForm.find('[name="event_end_datetime"]').val(event.event_end_datetime);
                    
                    const start = new Date(event.event_start_datetime);
                    const end = new Date(event.event_end_datetime);

                    if (new Date(event.event_start_datetime) < new Date(event.event_end_datetime)) {
                        $('#eventEndsOnNexte').prop('checked', true);
                    } else {
                        $('#eventEndsOnNexte').prop('checked', false);
                    }
                    $('#eventEndsOnNexte').change();
                    editEventForm.find('[name="amount_in_inr"]').val(event.amount_in_inr);
                    editEventForm.find('[name="amount_in_usd"]').val(event.amount_in_usd);
                    editEventForm.find('[name="venue_address"]').val(event.venue_address);
                    editEventForm.find('[name="google_maps_link"]').val(event.google_maps_link);
                    editEventForm.find('[name="google_meet_link"]').val(event.google_meet_link);
                    editEventForm.find('[name="total_seats"]').val(event.total_seats);
                    editEventForm.find('[name="display_start_date"]').pickadate('picker').set('select', moment(event.display_start_date, "YYYY-MM-DD").format("DD/MM/YYYY"));
                    editEventForm.find('[name="display_end_date"]').pickadate('picker').set('select', moment(event.display_end_date, "YYYY-MM-DD").format("DD/MM/YYYY"));
                    editEventForm.find('[name="is_active"]').prop('checked', event.is_active == 1).val(event.is_active);

                
                    const bannerInput = editEventForm.find('[name="banner"]').closest('.upload-box').get(0);
                    if (bannerInput && typeof bannerInput.setImage === 'function') {
                        bannerInput.setImage(event.banner);
                    }

                    // Clear existing sponsor upload boxes
                    const sponsorWrapper = editEventForm.find('.sponsor-wrapper').get(0);
                    sponsorWrapper.innerHTML = '';

                    // Add sponsors from event
                    const sponsors = event.sponsors;
                    sponsors.forEach((sponsor) => {
                        const newSponsorBox = createUploadBox('sponsor[]', 'removeSponserImg', sponsor.id);
                        sponsorWrapper.appendChild(newSponsorBox);
                        newSponsorBox.setImage?.(sponsor.image);
                    });

                    $('#event-detail-modals').modal('show');

                }
            });
        }

        window.fetchRegisteredPersons = function(event_id) {
            loadingBlock();
            window.axiosApiClient.post(`admin/event/register-list/${event_id}`, {}, {
                headers: {
                    'Authorization': 'Bearer ' + getAuthToken()
                }
            }).then(response => {
                if (response.data.status) {
                    var event = response.data.data;
                    var transactions = event.transactions || [];

                    // Destroy existing DataTable instance before modifying table content
                    if ($.fn.DataTable.isDataTable('.RegisterListTable')) {
                        $('.RegisterListTable').DataTable().clear().destroy();
                    }

                    var tableBody = $('.RegisterListTable tbody');
                    tableBody.empty(); // Clear previous data

                    if (transactions.length === 0) {
                        tableBody.append(`<tr><td colspan="7" class="text-center">No registered users found.</td></tr>`);
                    } else {
                        transactions.forEach((txn, index) => {
                            const name = txn.payer_first_name || 'N/A';
                            const mobile = txn.payer_mobile_no || 'N/A';
                            const payment_method = txn.payment_method || 'N/A';
                            const order_id = txn.order_id || 'N/A';
                            const amount = txn.total_amount || '0.00';
                            const status = txn.status || 'Pending';

                            tableBody.append(`
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${name}</td>
                                    <td>${mobile}</td>
                                    <td>${payment_method}</td>
                                    <td>${order_id}</td>
                                    <td>${amount}</td>
                                    <td>${status}</td>
                                </tr>
                            `);
                        });
                    }

                    // Re-initialize the DataTable
                    $('.RegisterListTable').DataTable({
                        destroy: true,
                        dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                        buttons: [
                            {
                                extend: 'collection',
                                className: 'btn btn-outline-secondary dropdown-toggle',
                                text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Export',
                                buttons: [
                                    {
                                        extend: 'print',
                                        text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
                                        className: 'dropdown-item',
                                    },
                                    {
                                        extend: 'csv',
                                        text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                                        className: 'dropdown-item',
                                    },
                                    {
                                        extend: 'excel',
                                        text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                                        className: 'dropdown-item',
                                    },
                                    {
                                        extend: 'pdf',
                                        text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                                        className: 'dropdown-item',
                                    },
                                    {
                                        extend: 'copy',
                                        text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                                        className: 'dropdown-item',
                                    }
                                ],
                                init: function (api, node, config) {
                                    $(node).removeClass('btn-secondary');
                                    $(node).parent().removeClass('btn-group');
                                    setTimeout(function () {
                                        $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                                    }, 50);
                                }
                            }
                        ]
                    });

                    $('#register-list-modals').modal('show'); // Show modal
                } else {
                    toastr.error(response.data.message || "Failed to load data");
                }
            }).catch(error => {
                toastr.error("Something went wrong while fetching registered users.");
                console.error(error);
            }).finally(() => {
                loadingUnblock();
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
            event_plan_table.search('').draw();
        });

        $(document).on('click', '.add-event', function () {
            var addEventForm = $('#addEventForm');
            addEventForm.find(".select2").val(null).trigger("change");
            window.resetForm('#addEventForm');
            $('input[name="event_end_time"]').closest('.form-group').hide();
            $('#add-event-modals').modal('show');
        });
        
        // Add sponsor upload box
        document.querySelectorAll('.addsponsorBtn').forEach(button => {
            button.addEventListener('click', (e) => {
                const form = button.closest('form');
                const wrapper = form.querySelector('.sponsor-wrapper');
                if (wrapper) {
                    const uploadBoxes = wrapper.querySelectorAll('.upload-box');
                    if (uploadBoxes.length < 5) {
                        const newBox = createUploadBox('sponsor[]');
                        wrapper.appendChild(newBox);
                    } else {
                        toastr.error('You can upload a maximum of 5 sponsor images.', 'error!');
                    }
                }
            });
        });
        $(document).on('change', 'input[name="banner"], input[name="sponsor[]"]', function () {
            $(this).valid();
        });

        $('input[name="display_start_date"]').on('change', function () {
            var selectedDate = $(this).val();
            var form = $(this).closest('form'); // Get the closest form
        
            if (selectedDate) {
                let separationPicker = form.find('input[name="display_end_date"]').pickadate('picker');
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
        

        $('input[name="event_start_date"]').on('change', function () {
            var selectedDate = $(this).val();
            var form = $(this).closest('form'); // Get the closest form
            
            if (selectedDate) {
                // Get the end date picker
                let endDatePicker = form.find('input[name="event_end_date"]').pickadate('picker');
                if (endDatePicker) {
                    // Set min date to the selected start date
                    endDatePicker.set('min', selectedDate);

                    // Get current end date
                    var currentEndDate = endDatePicker.get('select', 'yyyy-mm-dd');

                    // If current end date is before new start date, reset it
                    if (currentEndDate && currentEndDate < selectedDate) {
                        endDatePicker.set('select', selectedDate); // or null if you want to force user to select
                    }
                }
            }
            // if (selectedDate) {
            //     let separationPicker = form.find('input[name="event_end_date"]').pickadate('picker');
            //     if (separationPicker) {
            //         separationPicker.set('min', selectedDate); // Set min date to joining date
            //     }
            // }
        });

        $('input[name="event_start_date"]').on('change', function () {
            var selectedDate = $(this).val();
            var form = $(this).closest('form'); // Get the closest form
        
            if (selectedDate) {
                let separationPicker = form.find('input[name="display_start_date"]').pickadate('picker');
                if (separationPicker) {
                    separationPicker.set('max', selectedDate); // Set min date to joining date
                }
                let separationEndPicker = form.find('input[name="display_end_date"]').pickadate('picker');
                if (separationEndPicker) {
                    separationEndPicker.set('max', selectedDate); // Set min date to joining date
                }
            }
        });
        $('input[name="event_end_date"]').on('change', function () {
            var selectedDate = $(this).val();
            var form = $(this).closest('form'); // Get the closest form
        
            if (selectedDate) {
                let separationPicker = form.find('input[name="display_start_date"]').pickadate('picker');
                if (separationPicker) {
                    separationPicker.set('max', selectedDate); // Set min date to joining date
                }
                let separationEndPicker = form.find('input[name="display_end_date"]').pickadate('picker');
                if (separationEndPicker) {
                    separationEndPicker.set('max', selectedDate); // Set min date to joining date
                }
            }
        });
    
        $('#resetFilters').on('click', function () {
            $('#search_key').val('').trigger('change');
            $('#is_active').val('').trigger('change');
            $('#event_type').val('').trigger('change');
            $('#date_from').val('');
            $('#date_to').val('');

            event_plan_table.ajax.reload(); // Reload table with reset filters
            $(this).prop('disabled', true);
        });
    
        $('#search_key, #is_active, #event_type, #date_from, #date_to').on('change keyup', function () {
            event_plan_table.ajax.reload(); // Reload table when any filter changes
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

        $('#addEventForm').validate({
            rules: {
                name: {
                    required: true,
                    // alphanumeric: true,
                    maxlength: 250
                },
                description: {
                    required: true,
                    maxlength: 500 // Optional limit, adjust as needed
                },
                event_type: {
                    required: true,
                },
                event_mode: {
                    required: true,
                },
                venue_address: {
                    required: true,
                    // alphanumeric: true,
                    maxlength: 250,
                },
                amount_in_inr: {
                    number: true,
                    min: 0,
                    max: 999999,
                    required: {
                        depends: function () {
                            return $('#addEventForm select[name="event_type"]').val() === 'paid';
                        }
                    }
                },
                amount_in_usd: {
                    number: true,
                    min: 0,
                    max: 999999,
                    required: {
                        depends: function () {
                            return $('#addEventForm select[name="event_type"]').val() === 'paid';
                        }
                    }
                },
                event_start_date: {
                    required: true,
                },
                event_start_time: {
                    required: true,
                },
                // event_end_date: {
                //     afterStartDate: ["#event_start_date", "#event_start_time", "#event_end_time"]
                // },
                total_seats: {
                    required: true,
                    number: true,
                    min: 1,
                    max: 999999
                },
                google_maps_link: {
                    validIframe: true,
                    maxlength: 500,
                },
                google_meet_link: {
                    url: true,
                    maxlength: 100,
                },
                banner: {
                    required: true,
                    accept: "image/jpeg,image/png,image/gif,image/webp",
                    fileSize: 5120, // in kb
                    checkDimensions: true
                },
                'sponsor[]': {
                    required: true,
                    accept: "image/jpeg,image/png,image/gif,image/webp",
                    fileSize: 5120 // in kb
                },
                
            },
            messages: {
                name: {
                    required: "Please enter Event name",
                    // alphanumeric: "Only alphabets, digits, spaces, and dots (.) are allowed.",
                    maxlength: "Please enter data up to 250 characters."
                },
                description: {
                    required: "Please enter Event description",
                    maxlength: "Please enter data up to 500 characters."
                },
                event_type:{
                    required: "Please select event type",
                },
                event_mode:{
                    required: "Please select event mode",
                },
                venue_address: {
                    required: "Please enter venue address",
                    // alphanumeric: "Only alphabets, digits, spaces, and dots (.) are allowed.",
                    maxlength: "Please enter data up to 250 characters."
                },
                amount_in_inr: {
                    required: "Please enter amount",
                    number: "Enter a valid number.",
                    min: "Amount cannot be negative.",
                    max: "Amount should be less than 999999" 
                },
                amount_in_usd: {
                    required: "Please enter amount",
                    number: "Enter a valid number.",
                    min: "Amount cannot be negative.",
                    max: "Amount should be less than 999999" 
                },
                event_start_date: {
                    required: "Event date is required.",
                },
                event_start_time: {
                    required: "Event time is required.",
                },
                event_end_date: {
                    afterStartDate: "End date must be after the start date." // <-- Custom message for end date
                },
                total_seats: {
                    required: "Please enter total registration limit.",
                    number: "Please enter a valid number for total seats.",
                    min: "Total seats should between 1 and 999999.",
                    max: "Total seats should between 1 and 999999."
                },
                google_maps_link: {
                    validIframe: "Please enter a valid Google Maps Iframe.",
                    maxlength: "Google Maps link cannot exceed 500 characters."
                },
                google_meet_link: {
                    url: "Please enter a valid Google Meet URL.",
                    maxlength: "Google Meet link cannot exceed 100 characters."
                },
                banner: {
                    required: "Please upload a banner image.",
                    accept: "Only image formats are allowed.",
                    fileSize: "Banner image must be less than 5MB.",
                    checkDimensions: "Banner should be same height and width."


                },
                'sponsor[]': {
                    required: "Please upload at least one sponsor image.",
                    accept: "Only image formats are allowed.",
                    fileSize: "Each sponsor image must be less than 5MB."
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
                // var formData = new FormData(form);

                const bannerInput = $(form).find("[name=banner]")[0];
                let bannerBase64 = null;

                if (bannerInput.files.length > 0) {
                    bannerBase64 = await getBase64(bannerInput.files[0]);
                }

                const sponsorInputs = $(form).find("[name='sponsor[]']");
                let sponsorBase64 = [];

                for (let sponsorInput of sponsorInputs) {
                    if (sponsorInput.files.length > 0) {
                        const sponsorFile = sponsorInput.files[0];
                        const sponsorBase64File = await getBase64(sponsorFile);
                        sponsorBase64.push(sponsorBase64File);
                    }
                }

                const payload = {
                    name: $(form).find("[name=name]").val(),
                    event_type: $(form).find("[name=event_type]").val(),
                    event_mode: $(form).find("[name=event_mode]").val(),
                    description: $(form).find("[name=description]").val(),
                    event_start_datetime: $(form).find("[name=event_start_datetime]").val(),
                    event_end_datetime: $(form).find("[name=event_end_datetime]").val(),
                    amount_in_inr: $(form).find("[name=amount_in_inr]").val(),
                    amount_in_usd: $(form).find("[name=amount_in_usd]").val(),
                    venue_address: $(form).find("[name=venue_address]").val(),
                    google_maps_link: $(form).find("[name=google_maps_link]").val(),
                    google_meet_link: $(form).find("[name=google_meet_link]").val(),
                    total_seats: $(form).find("[name=total_seats]").val(),
                    display_start_date_submit: $(form).find("[name=display_start_date_submit]").val(),
                    display_end_date_submit: $(form).find("[name=display_end_date_submit]").val(),
                    is_active: $(form).find("[name=is_active]").val(),
                    banner: bannerBase64, // null if not selected
                    sponsor: sponsorBase64
                };

                loadingBlock();

                window.axiosApiClient.post('admin/event/addnew', payload, {
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken()
                    }
                }).then(response => {
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                    toastr.success('Event details have been added successfully.', 'Success!');
                    $('#add-event-modals').modal('hide');
                    event_plan_table.ajax.reload();
                }).catch(error => {
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                })
            } */
           submitHandler: function (form, event) {

    event.preventDefault();

    $(form).find('button[type="submit"]').attr('disabled', 'disabled');

    let formData = new FormData();

    /*
    ===============================
    ADD FORM FIELDS
    ===============================
    */

    formData.append('name', $(form).find("[name=name]").val());
    formData.append('event_type', $(form).find("[name=event_type]").val());
    formData.append('event_mode', $(form).find("[name=event_mode]").val());
    formData.append('description', $(form).find("[name=description]").val());

    formData.append('event_start_datetime',
        $(form).find("[name=event_start_datetime]").val());

    formData.append('event_end_datetime',
        $(form).find("[name=event_end_datetime]").val());

    formData.append('amount_in_inr',
        $(form).find("[name=amount_in_inr]").val());

    formData.append('amount_in_usd',
        $(form).find("[name=amount_in_usd]").val());

    formData.append('venue_address',
        $(form).find("[name=venue_address]").val());

    formData.append('google_maps_link',
        $(form).find("[name=google_maps_link]").val());

    formData.append('google_meet_link',
        $(form).find("[name=google_meet_link]").val());

    formData.append('total_seats',
        $(form).find("[name=total_seats]").val());

    formData.append('display_start_date_submit',
        $(form).find("[name=display_start_date_submit]").val());

    formData.append('display_end_date_submit',
        $(form).find("[name=display_end_date_submit]").val());

    formData.append('is_active',
        $(form).find("[name=is_active]").val());


    /*
    ===============================
    BANNER FILE
    ===============================
    */

    let bannerInput = $(form).find("[name=banner]")[0];

    if (bannerInput.files.length > 0) {

        formData.append(
            'banner',
            bannerInput.files[0]
        );
    }


    /*
    ===============================
    SPONSOR FILES
    ===============================
    */

    let sponsorInputs =
        $(form).find("[name='sponsor[]']");

    for (let input of sponsorInputs) {

        if (input.files.length > 0) {

            formData.append(
                'sponsor[]',
                input.files[0]
            );
        }
    }


    loadingBlock();


    window.axiosApiClient.post(
        'admin/event/addnew',
        formData,
        {
            headers: {
                'Authorization': 'Bearer ' + getAuthToken(),
                'Content-Type': 'multipart/form-data'
            }
        }
    ).then(response => {

        $(form)
            .find('button[type="submit"]')
            .removeAttr('disabled');

        toastr.success(
            'Event details have been added successfully.',
            'Success!'
        );

        $('#add-event-modals').modal('hide');

        event_plan_table.ajax.reload();

    }).catch(error => {

        $(form)
            .find('button[type="submit"]')
            .removeAttr('disabled');

    });
}
        });

        $('#editEventForm').validate({
            rules: {
                name: {
                    required: true,
                    // alphanumeric: true,
                    maxlength: 250
                },
                description: {
                    required: true,
                    maxlength: 500 // Optional limit, adjust as needed
                },
                event_type: {
                    required: true,
                },
                event_mode: {
                    required: true,
                },
                venue_address: {
                    required: true,
                    // alphanumeric: true,
                    maxlength: 250,
                },
                amount_in_inr: {
                    number: true,
                    min: 0,
                    max: 999999,
                    required: {
                        depends: function () {
                            return $('#editEventForm select[name="event_type"]').val() === 'paid';
                        }
                    }
                },
                amount_in_usd: {
                    number: true,
                    min: 0,
                    max: 999999,
                    required: {
                        depends: function () {
                            return $('#editEventForm select[name="event_type"]').val() === 'paid';
                        }
                    }
                },
                event_start_date: {
                    required: true,
                },
                event_start_time: {
                    required: true,
                },
                total_seats: {
                    required: true,
                    number: true,
                    min: 1,
                    max: 999999
                },
                google_maps_link: {
                    validIframe: true,
                    maxlength: 500,
                },
                google_meet_link: {
                    url: true,
                    maxlength: 100,
                },
                banner: {
                    imageRequired: true,
                    accept: "image/jpeg,image/png,image/gif,image/webp",
                    fileSize: 5120, // in kb
                    checkDimensions: true
                },
                'sponsor[]': {
                    imageRequired: true,
                    accept: "image/jpeg,image/png,image/gif,image/webp",
                    fileSize: 5120 // in kb
                },
            },
            messages: {
                name: {
                    required: "Please enter Event name",
                    // alphanumeric: "Only alphabets, digits, spaces, and dots (.) are allowed.",
                    maxlength: "Please enter data up to 250 characters."
                },
                description: {
                    required: "Please enter Event description",
                    maxlength: "Please enter data up to 500 characters."
                },
                event_type:{
                    required: "Please select event type",
                },
                event_mode:{
                    required: "Please select event mode",
                },
                venue_address: {
                    required: "Please enter venue address",
                    // alphanumeric: "Only alphabets, digits, spaces, and dots (.) are allowed.",
                    maxlength: "Please enter data up to 250 characters."
                },
                amount_in_inr: {
                    number: "Enter a valid number.",
                    min: "Amount cannot be negative.",
                    max: "Amount should be less than 999999" 
                },
                amount_in_usd: {
                    number: "Enter a valid number.",
                    min: "Amount cannot be negative.",
                    max: "Amount should be less than 999999" 
                },
                event_start_date: {
                    required: "Event date is required.",
                },
                event_start_time: {
                    required: "Event time is required.",
                },
                total_seats: {
                    required: "Please enter total registration limit.",
                    number: "Please enter a valid number for total seats.",
                    min: "Total seats should between 1 and 999999.",
                    max: "Total seats should between 1 and 999999."

                },
                google_maps_link: {
                    validIframe: "Please enter a valid Google Maps Iframe.",
                    maxlength: "Google Maps link cannot exceed 500 characters."
                },
                google_meet_link: {
                    url: "Please enter a valid Google Meet URL.",
                    maxlength: "Google Meet link cannot exceed 100 characters."
                },
                banner: {
                    imageRequired: "Please upload a banner image.",
                    accept: "Only image formats are allowed.",
                    fileSize: "Banner image must be less than 5MB.",
                    checkDimensions: "Banner should be same height and width."
                },
                'sponsor[]': {
                    imageRequired: "Please upload at least one sponsor image.",
                    accept: "Only image formats are allowed.",
                    fileSize: "Each sponsor image must be less than 5MB."
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
                
                const bannerInput = $(form).find("[name=banner]")[0];
                let bannerBase64 = null;

                if (bannerInput.files.length > 0) {
                    bannerBase64 = await getBase64(bannerInput.files[0]);
                }

                const sponsorInputs = $(form).find("[name='sponsor[]']");
                let sponsorBase64 = [];

                for (let sponsorInput of sponsorInputs) {
                    if (sponsorInput.files.length > 0) {
                        const sponsorFile = sponsorInput.files[0];
                        const sponsorBase64File = await getBase64(sponsorFile);
                        sponsorBase64.push(sponsorBase64File);
                    }
                }

                const payload = {
                    event_id : $(form).find("[name=event_id]").val(),
                    name: $(form).find("[name=name]").val(),
                    event_type: $(form).find("[name=event_type]").val(),
                    event_mode: $(form).find("[name=event_mode]").val(),
                    description: $(form).find("[name=description]").val(),
                    event_start_datetime: $(form).find("[name=event_start_datetime]").val(),
                    event_end_datetime: $(form).find("[name=event_end_datetime]").val(),
                    amount_in_inr: $(form).find("[name=amount_in_inr]").val(),
                    amount_in_usd: $(form).find("[name=amount_in_usd]").val(),
                    venue_address: $(form).find("[name=venue_address]").val(),
                    google_maps_link: $(form).find("[name=google_maps_link]").val(),
                    google_meet_link: $(form).find("[name=google_meet_link]").val(),
                    total_seats: $(form).find("[name=total_seats]").val(),
                    display_start_date_submit: $(form).find("[name=display_start_date_submit]").val(),
                    display_end_date_submit: $(form).find("[name=display_end_date_submit]").val(),
                    is_active: $(form).find("[name=is_active]").val(),
                    banner: bannerBase64, // null if not selected
                    sponsor: sponsorBase64
                };

                loadingBlock();

                window.axiosApiClient.post('admin/event/update', payload, {
                    headers: {
                        'Authorization': 'Bearer ' + getAuthToken()
                    }
                }).then(response => {
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                    toastr.success('Plan details have been updated successfully.', 'Success!');
                    $('#event-detail-modals').modal('hide');
                    event_plan_table.ajax.reload();
                }).catch(error => {
                    $(form).find('button[type="submit"]').removeAttr('disabled');
                })
            } */
           submitHandler: function (form, event) {
    event.preventDefault();

    $(form).find('button[type="submit"]').attr('disabled', 'disabled');

    let formData = new FormData(form);

    loadingBlock();

    window.axiosApiClient.post('admin/event/update', formData, {
        headers: {
            'Authorization': 'Bearer ' + getAuthToken(),
            'Content-Type': 'multipart/form-data'
        }
    }).then(response => {

        $(form).find('button[type="submit"]').removeAttr('disabled');

        toastr.success('Plan details have been updated successfully.', 'Success!');

        $('#event-detail-modals').modal('hide');
        event_plan_table.ajax.reload();

    }).catch(error => {

        $(form).find('button[type="submit"]').removeAttr('disabled');

    });
}
        });

        $('form [name="event_start_date"], form [name="event_start_time"]').on('change', function () {
            
            let $form = $(this).closest('form');
            let eventDate  = $form.find('[name="event_start_date"]').pickadate('picker').get('select', 'yyyy-mm-dd');
            let eventTime  = $form.find('[name="event_start_time"]').pickatime('picker').get('select', 'HH:i');
            let eventDateTime;
            if (eventDate && eventTime) {
                eventDateTime = `${eventDate} ${eventTime}:00`;
            } else {
                eventDateTime = `${eventDate} 00:00:00`;
            }
            $form.find('[name="event_start_datetime"]').val(eventDateTime);
        });

        $('form [name="event_end_date"], form [name="event_end_time"]').on('change', function () {
            
            let $form = $(this).closest('form');
            let eventDate  = $form.find('[name="event_end_date"]').pickadate('picker').get('select', 'yyyy-mm-dd');
            let eventTime  = $form.find('[name="event_end_time"]').pickatime('picker').get('select', 'HH:i');
             
            if (eventDate && eventTime) {
                const eventDateTime = `${eventDate} ${eventTime}:00`;
                $form.find('[name="event_end_datetime"]').val(eventDateTime);
            } else {
                $form.find('[name="event_end_datetime"]').val('');
            }
        });

        $('.preview-btn').on('click', async function () {
            const form = $(this).closest('form');

            // Validate form
            if (!form.valid()) return;

            // Convert banner to base64
            const bannerInput = form.find("[name=banner]")[0];
            let bannerBase64 = null;
            if (bannerInput?.files?.length > 0) {
                bannerBase64 = await getBase64(bannerInput.files[0]);
            }
            else {
                const bannerImg = form.find('.banner-wrapper img');
                const bannerSrc = bannerImg.attr('src');
                if (bannerSrc && !bannerSrc.includes("Placeholder_view_vector.svg")) {
                    bannerBase64 = bannerSrc;
                }
            }

            // Extract form values
            const payload = {
                title: form.find("[name=name]").val(),
                description: form.find("[name=description]").val(),
                event_type: form.find("[name=event_type]").val(),
                event_mode: form.find("[name=event_mode]").val(),
                currency_type: form.find("[name=currency_type]").val(),
                event_start_datetime: form.find("[name=event_start_datetime]").val(),
                event_end_datetime: form.find("[name=event_end_datetime]").val(),
                venue_address: form.find("[name=venue_address]").val(),
                display_start_date: form.find("[name=display_start_date_submit]").val(),
                display_end_date: form.find("[name=display_end_date_submit]").val(),
                amount_in_inr: form.find("[name=amount_in_inr]").val(),
                amount_in_usd: form.find("[name=amount_in_usd]").val(),
                total_seats: parseInt(form.find("[name=total_seats]").val() || 0),
                banner: bannerBase64,
            };

            // Format dates
            const momentStart = moment(payload.event_start_datetime);
            const momentEnd = moment(payload.event_end_datetime);

            const registrationStart = moment(payload.display_start_date).startOf('day');
            
            // Generate event type display
            const selectedCurrencyCode = payload.currency_type || 'INR';
            const eventType = payload.event_type === 'paid'
                ? `<p class="fees">Fees<br/><span class="rs-sign">${selectedCurrencyCode === 'INR' ? '&#8377;' : '$'}</span><span class="amount">${selectedCurrencyCode === 'INR' ? payload.amount_in_inr : payload.amount_in_usd}/-</span></p>`
                : `<p class="fees">Free<br/><b>Entry</b></p>`;

            // Generate preview HTML
            const previewHTML = `
                <div class="event-card">
                    <div class="left-date-display">
                        <img src="/new_ui/assets/images/calendar2.svg" alt="Event Date Icon">
                        ${eventType}
                        <div class="date-info">
                            <span class="month">${momentStart.format('MMM')}</span>
                            <span class="day">${momentStart.format('DD')}</span>
                            <span class="year">${momentStart.format('YYYY')}</span>
                        </div>
                    </div>
                    <div class="event-details">
                        <h1 class="event-title">${payload.title || 'Untitled'}</h1>
                        <div class="event-description">
                            <p>${payload.description}</p>
                        </div>
                        <div class="event-timing">
                            <div>
                                <h2 class="timing-title">Event Start Date &amp; Time:</h2>
                                <div class="date-display-small">
                                    <label><span>${momentStart.format('ddd, DD MMM YYYY')}</span></label>
                                    <label><span>${momentStart.format('hh:mm a')} IST</span></label>
                                </div>
                            </div>
                            ${payload.event_end_datetime ? `
                            <div>
                                <h2 class="timing-title">Event End Date &amp; Time:</h2>
                                <div class="date-display-small">
                                    <label><span>${momentEnd.format('ddd, DD MMM YYYY')}</span></label>
                                    <label><span>${momentEnd.format('hh:mm a')} IST</span></label>
                                </div>
                            </div>` : ''}
                        </div>
                        <div class="event-btns">
                            <div>
                                <a href="javascript:;" class="btn btn-primary custom-btn w-100">Register Now</a>
                                <p class="registration-start-date">Registration Starts On: <span>${registrationStart.format('ddd, DD MMM YYYY')}</span></p>
                            </div>
                            <a href="javascript:;" class="btn btn-secondary custom-btn">Seats Available (${payload.total_seats})</a>
                            <a href="javascript:;">Know more</a>
                            <a href="javascript:;">Terms & Conditions</a>
                        </div>
                    </div>
                    <div class="event-banner">
                        <img src="${payload.banner || 'https://upload.wikimedia.org/wikipedia/commons/3/3f/Placeholder_view_vector.svg'}" alt="Event Banner">
                    </div>
                </div>`;

            // Show preview
            $('.event-preview').html(previewHTML);
            $('#preview-modal').modal('show');
        });



        
                                     
    });

    // NOTE: ------ PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
})(window);