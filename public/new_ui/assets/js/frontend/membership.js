(function (window, undefined) {
    'use strict';
    
    async function fetchMembershipData() {
        try {
            const response = await window.axiosApiClient.get('/get-membership');
            
            if (response.data.status !== 'success') return;

            const memberships = response.data.data;
            const container = document.querySelector('.pricing-cards');
            
            if (!container) {
                console.error('Missing container: .pricing-cards');
                return;
            }

            container.innerHTML = ''; // Clear existing cards

            // Decode user data from localStorage
            let decodedUser = null;
            const user = localStorage.getItem('userData');
            if (user) {
                try {
                    decodedUser = decodeBase64Unicode(user);
                } catch (err) {
                    console.error('Error decoding userData:', err);
                }
            }

            // Get selected currency
            const { selectedCurrencyCode, selectedCurrencySymbol } = getSelectedCurrency();

            memberships.forEach(plan => {
                const price = selectedCurrencyCode === 'INR'
                    ? window.convertCurrency(plan.amount_in_inr, 'INR', 0)
                    : window.convertCurrency(plan.amount_in_usd, 'USD', 0);

                //alert(`Price: ${price}`);

                const durationText = plan.id === 1 ? 'LifeTime' : '1 Year';
                const diamondName = plan.id === 2 ? 'silver' : (plan.id === 3 ? 'gold' : '');
                const diamondHtml = diamondName
                    ? `<span class="avatar avatar-tag avatar-tag-web bg-light-info">
                            <img width="28px" src="new_ui/assets/images/${diamondName}-daimond.png">
                    </span>`
                    : '';

                // Determine user plan status
                let actionButton = '';
                if (!decodedUser) {
                    actionButton = `
                        <a href="javascript:;" class="btn upgrade-btn custom-btn btn-secondary w-100" data-plan-id="${plan.id}">
                            <span>Unlock This Plan</span>
                            <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M38.2731 19L48.668 9.5L38.2731 0L36.4817 1.63271L43.8233 8.34234H0V10.658H43.8233L36.4817 17.3676L38.2731 19Z" fill="black"/>
                            </svg>
                        </a>`;
                } else if (decodedUser.plan_type <= plan.id) {
                    const isCurrent = decodedUser.plan_type == plan.id;
                    actionButton = `
                        <a href="javascript:;" class="btn upgrade-btn custom-btn btn-${isCurrent ? 'primary' : 'secondary'} w-100" data-plan-id="${plan.id}">
                            <span>${isCurrent ? 'Current Plan' : 'Upgrade now'}</span>
                            <svg width="49" height="19" viewBox="0 0 49 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M38.2731 19L48.668 9.5L38.2731 0L36.4817 1.63271L43.8233 8.34234H0V10.658H43.8233L36.4817 17.3676L38.2731 19Z" fill="black"/>
                            </svg>
                        </a>`;
                }

                // Final card HTML
                const cardHtml = `
                    <article class="pricing-card">
                        <header class="card-header">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h3 class="card-title m-0">
                                    <span>${plan.name}</span>
                                    <br>
                                    <span>Membership</span>
                                </h3>
                                ${diamondHtml}
                            </div>
                            <div class="price-container">
                                <span class="price-amount">${price}</span>
                                <span class="price-period">${durationText}</span>
                            </div>
                        </header>
                        <div class="feature-list">${plan.benefits}</div>
                        ${actionButton}
                    </article>
                `;

                container.insertAdjacentHTML('beforeend', cardHtml);
            });

        } catch (error) {
            console.error('Error fetching membership data:', error);
        }
    }

    fetchMembershipData();

    $("#currencySwitch").on("change", function() {
        if ($(this).is(":checked")) {
        setCurrency('USD', '$');
        } else {
        setCurrency('INR', '&#8377;');
        }
        fetchMembershipData();
    });

    $(document).on('click', '.upgrade-btn', function() {
        const planId = $(this).data('plan-id');
        const user = localStorage.getItem('userData');
        let decodedUser = null;

        if(user){
            decodedUser = decodeBase64Unicode(user);
        }
        else{
            toastr.error('Please login to upgrade your membership.');
            setTimeout(() => {
                window.location.href = '/login?point=m';
            }, 2000);
            return;
        }

        if(decodedUser && decodedUser.plan_type == planId) {
            toastr.info('You are already subscribed to this plan.', 'Information');
            return;
        }
        window.location.href =`order-summary?product_type=membership&membership_id=${planId}`
        
    });

    // NOTE: PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED

})(window);