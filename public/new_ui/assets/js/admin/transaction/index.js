(function (window, undefined){
    'use strict';

    document.addEventListener("DOMContentLoaded", function() {

        // call from custom.js
        
        // ========================       
        
        window.transaction_list_table = $('#transaction-list-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + '/api/admin/transaction/list',
                type: 'GET',
                data: function (d) {
                    d.search_key = $('#search_key').val();
                    d.is_active = $('#is_active').val();
                    d.status = $('#status').val();
                    d.service_name = $('#service_name').val();
                    d.date_from = $('#date_from').val();
                    d.date_to = $('#date_to').val();
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
                    data: 'transaction_date',
                    title: 'Transaction Date',
                    render: function (data, type, full, meta) {
                        return formatDateTime(full['transaction_date']);
                    }
                },
                {
                    data: 'order_id',
                    title: 'Order Id',
                    render: function (data, type, full, meta) {
                        var $name = full['order_id'] || '';
                
                        return (
                            '<div class="d-flex flex-column justify-content-center align-items-start">' +
                            '<a class="emp-name" data-bs-toggle="tooltip" data-bs-placement="top" title="'+ $name +'" href="javascript:void(0);" onclick="fetchTransactionRecords('+ full['id'] +')">' +
                            '<span class="emp-name text-truncate fw-bold">' + $name + '</span>' +
                            '</a>' +
                            '</div>'
                        );
                    }
                },
                {
                    data: 'customer_id',
                    title: 'Membership ID',
                    render: function (data, type, full, meta) {
                        return full['membership_id'] || '-';
                    }
                },
                {
                    data: 'customer_name',
                    title: 'Customer Name',
                    render: function (data, type, full, meta) {
                        let name = full['customer_name'] 
                            ? full['customer_name']
                            : (( ( (full['payer_first_name'] ?? '') + ' ' + (full['payer_last_name'] ?? '') ).trim() ) 
                                ? ( (full['payer_first_name'] ?? '') + ' ' + (full['payer_last_name'] ?? '') ).trim() 
                                : '-');
                        return name;
                    }
                },
                {
                    data: 'transactionable_type',
                    title: 'Service Name',
                    render: function (data, type, full, meta) {
                        const typeMap = {
                            'MembershipPlan': 'Membership',
                            'Event': 'Event'
                        };
                
                        if (!full['transactionable_type']) return '-';
                
                        const parts = full['transactionable_type'].split('\\');
                        const className = parts[parts.length - 1];
                        return typeMap[className] ?? className;
                    }
                },
                {
                    data: 'total_amount',
                    title: 'Service Type',
                    render: function (data, type, full, meta) {
                        return full['total_amount'] > 0 ? 'Paid' : 'Free';
                    }
                },
                {
                    data: 'mobile_no',
                    title: 'Mobile No',
                    render: function (data, type, full, meta) {
                        let mobile_no;
                        if(full['mobile_no']){
                            mobile_no = (full['mobile_no_cc'] || '')+full['mobile_no']
                        }
                        else if(full['payer_mobile_no']){
                            mobile_no = (full['payer_mobile_no_cc'] || '')+full['payer_mobile_no']
                        }
                        else{
                            mobile_no = '-'
                        }
                        return mobile_no;
                    }
                },                 
                {
                    data: 'status', 
                    title: 'Payment Status',
                    render: function (data, type, full, meta) {
                        var statusMapping = {
                            'pending': { title: 'Pending', class: 'badge-light-warning' },
                            'completed': { title: 'Completed', class: 'badge-light-success' },
                            'failed': { title: 'Failed', class: 'badge-light-danger' },
                            'refunded': { title: 'Refunded', class: 'badge-light-primary' },
                        };
                        
                        var statusKey = String(full['status']).trim(); // Ensure string consistency
                        
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
                    data: 'total_amount',
                    title: 'Amount',
                    render: function (data, type, full, meta) {
                        const symbol = full.currency_type === 'INR' ? '&#8377;' : '$';
                        return full.total_amount != null ? `${symbol}${full.total_amount}` : '-';
                    }
                },                        
                {
                    data: 'id', 
                    title: 'Actions', 
                    orderable: false,
                    render: function (data, type, full, meta) {
                        let html = '<div class="d-inline-flex">';
                    
                        html += '<a href="javascript:;" class="item-edit me-2" ' +
                            'data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Plan" onclick="fetchTransactionRecords(' + full['id'] + ')">' +
                            '<i class="bi bi-eye"></i>' +
                            '</a>';
                    
                        html += '</div>';
                        return html;
                    }                    
                }, 
            ],
            drawCallback: function(settings) {
                $('[data-bs-toggle="tooltip"]').tooltip();
            },
            order: [[0, 'desc']],
            dom: '<"table-box"t><"d-flex border-top justify-content-between mx-0"<""l><""i><""p>>',
            displayLength: 15,
            lengthMenu: [15, 25, 50, 75, 100],
            language: {
                paginate: {
                    previous: '&nbsp;',
                    next: '&nbsp;'
                },
                emptyTable: `<p class="text-center my-3">No transaction found</p>`
            }
        });

        window.fetchTransactionRecords = function(id){
            // $('input[name="transaction_id"]').val(id);
            $('#transaction-detail-modals').modal('show');
            fetchTransactionDetails(id);
        }

        window.fetchTransactionDetails = function(id) {
            loadingBlock();
            // let id = $('input[name="transaction_id"]').val();
            window.axiosApiClient.post(`admin/transaction/view/${id}`,{},{
                headers: {
                            'Authorization': 'Bearer ' + getAuthToken()
                        }
            }).then(response => {
                if (response.data.status) {
                    var transaction = response.data.data;
                    var transaction_detail_modals = $('#transaction-detail-modals');

                    // 1️⃣ Customer name: fallback to payer name if customer name not available
                    let custName = (transaction.customer?.first_name && transaction.customer?.last_name)
                        ? `${transaction.customer.first_name} ${transaction.customer.last_name}`
                        : (`${transaction.payer_first_name} ${transaction.payer_last_name}` || '-');
                    transaction_detail_modals.find('.cust_name').text(custName);

                    transaction_detail_modals.find('.membership_id').text(transaction.membership_id || '-');
                    transaction_detail_modals.find('.order_id').text(transaction.order_id || '-');
                    if (transaction.order_id) {
                        transaction_detail_modals.find('.order_id+.bi-copy').show();
                    } else {
                        transaction_detail_modals.find('.order_id+.bi-copy').hide();
                    }

                    // 2️⃣ Customer mobile: customer first, then payer, with country code
                    let custMobile = '-';
                    if (transaction.customer?.mobile_no) {
                        custMobile = `${transaction.customer.mobile_no_cc || ''}${transaction.customer.mobile_no}`;
                    } else if (transaction.payer_mobile_no) {
                        custMobile = `${transaction.payer_mobile_no_cc || ''}${transaction.payer_mobile_no}`;
                    }
                    transaction_detail_modals.find('.cust_mobile').text(custMobile);

                    transaction_detail_modals.find('.email').text(transaction.payer_email || '-');
                    transaction_detail_modals.find('.tax_id').text(transaction.payer_taxid || '-');
                    transaction_detail_modals.find('.company_name').text(transaction.payer_company_name || '-');
                    transaction_detail_modals.find('.company_address').text(transaction.payer_company_address || '-');
                    transaction_detail_modals.find('.status').html(formatPaymentStatus(transaction.status) || '-');
                    transaction_detail_modals.find('.amount').html(
                        `${transaction.currency_type === 'INR' ? '&#8377;' : '$'}${transaction.total_amount ?? '-'}`
                    );
                    transaction_detail_modals.find('.transaction_date').text(formatDateTime(transaction.transaction_date));
                    transaction_detail_modals.find('.service_details').text(transaction.membership_plan?.name || '-');
                    transaction_detail_modals.find('.discount').text(transaction.discount || '-');
                    transaction_detail_modals.find('.transaction_id').text(transaction.transaction_id || '-');
                    if (transaction.transaction_id) {
                        transaction_detail_modals.find('.transaction_id+.bi-copy').show();
                    } else {
                        transaction_detail_modals.find('.transaction_id+.bi-copy').hide();
                    }
                    transaction_detail_modals.find('.payment_mode').text(transaction.payment_method || '-');

                    if (transaction.coupon_id && transaction.coupon) {
                        let coupon = transaction.coupon;
                        let discountText = '';

                        if (coupon.discount_type === 'flat') {
                            const flatAmount = transaction.currency_type ? coupon.discount_flat_inr : coupon.discount_flat_usd;
                            discountText = `Flat ${transaction.currency_type == 'INR' ? '&#8377;' : '$'}${flatAmount}`;
                        } else if (coupon.discount_type === 'percent') {
                            const percent = transaction.currency_type ? coupon.discount_percent_inr : coupon.discount_percent_usd;
                            const maxDiscount = transaction.currency_type ? coupon.maximum_discount_inr : coupon.maximum_discount_usd;
                            discountText = `${percent}% off (Max ${transaction.currency_type == 'INR' ? '&#8377;' : '$'}${maxDiscount})`;
                        } else {
                            discountText = '-';
                        }

                        const displayText = `${coupon.coupon_code} - ${discountText}`;
                        transaction_detail_modals.find('.coupon').html(displayText);
                    } else {
                        transaction_detail_modals.find('.coupon').html('-');
                    }

                    // Payment summary
                    if (transaction) {
                        let payerName = `${transaction.payer_first_name || ''} ${transaction.payer_last_name || ''}`.trim();
                        const item = transaction.transactionable || {};
                        const itemType = transaction.transactionable_type?.includes('MembershipPlan') ? 'Membership' : 'Event';
                        const itemName = itemType == 'Membership' ? item.name + ' Plan' : item.name || 'N/A';

                        const summary = [
                            `<b>Payer Name: </b> ${payerName}`,
                            `<b>Mobile: </b> ${custMobile}`,
                            `<b>Email: </b> ${transaction.payer_email || 'N/A'}`,
                            `<b>Item: </b> ${itemName ? itemName.charAt(0).toUpperCase() + itemName.slice(1) : '-'}`,
                            `<b>Type: </b> ${itemType}`,
                            `<b>Price: </b> ${transaction.currency_type == 'INR' ? '&#8377;' : '$'} ${transaction.price}`,
                            `<b>GST: </b> ${transaction.currency_type == 'INR' ? '&#8377;' : '$'} ${transaction.gst}`,
                            `<b>Discount: </b> ${transaction.currency_type == 'INR' ? '&#8377;' : '$'} ${transaction.discount}`,
                            `<b>Total Paid: </b> ${transaction.currency_type == 'INR' ? '&#8377;' : '$'} ${transaction.total_amount}`
                        ].join('<br/>');

                        transaction_detail_modals.find('.payment_summary').html(summary);
                    } else {
                        transaction_detail_modals.find('.payment_summary').html('-');
                    }

                    $('#transaction-detail-modals').modal('show');
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

        $('.copy-transaction-id').on('click', function () {
            var transactionText = $(this).closest('.d-flex').find('.transaction_id').text().trim();
            navigator.clipboard.writeText(transactionText).then(function () {
                toastr.success('Transaction ID copied to clipboard');
            }).catch(function (err) {
                console.error('Failed to copy: ', err);
            });
        });
        $('.copy-order-id').on('click', function () {
            var orderText = $(this).closest('.d-flex').find('.order_id').text().trim();
            navigator.clipboard.writeText(orderText).then(function () {
                toastr.success('Order ID copied to clipboard');
            }).catch(function (err) {
                console.error('Failed to copy: ', err);
            });
        });

        $('#search_key').on('keyup input change', function() {
            let clear_btn = $(this).closest('.table-header-search').find('.clear-btn');
            if ($(this).val().length > 0) {
                clear_btn.show();  // Show button when input has text
            } else {
                clear_btn.hide();  // Hide button when empty
            }
        });
    
        $('#resetFilters').on('click', function () {
            $('#search_key').val('').trigger('change');
            $('#status').val('').trigger('change');
            $('#service_name').val('').trigger('change');
            $('#date_from').val('');
            $('#date_to').val('');
            $('#is_active').val('').trigger('change');
            transaction_list_table.ajax.reload(); // Reload table with reset filters
            $(this).prop('disabled', true);
        });
    
        $('#search_key, #status, #service_name, #date_from, #date_to').on('change keyup', function () {
            transaction_list_table.ajax.reload(); // Reload table when any filter changes
        });

        $('.clear-btn').on('click', function() {
            $(this).closest('.table-header-search').find('#search_key').val('').trigger('change'); // Clear input and trigger event
            transaction_list_table.ajax.reload(); // Reload table when any filter changes
        });

        $('.filter-container').on('change keyup', '#search_key, #status, #service_name, #date_from, #date_to', function () {
            let isAnyFieldFilled = false;
        
            $('.filter-container').find('input, select').each(function () {
                if ($(this).val().trim() !== '') {
                    isAnyFieldFilled = true;
                    return false; // Exit loop early if any field is filled
                }
            });
        
            $('#resetFilters').prop('disabled', !isAnyFieldFilled);
        });
                                     
    });

    // NOTE: ------ PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
})(window);