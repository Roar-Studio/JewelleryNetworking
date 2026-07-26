<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Order Summary</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {

            background: #f7f5f2;
            font-family: Inter, sans-serif;
            color: #333;

            display: flex;
            justify-content: center;
            align-items: center;

            min-height: 100vh;

            padding: 30px;

        }

        .card {

            width: 100%;
            max-width: 760px;

            background: #fff;

            border-radius: 18px;

            padding: 45px;

            box-shadow:
                0 12px 40px rgba(0, 0, 0, .08);

        }

        .logo {

            text-align: center;
            margin-bottom: 25px;

        }

        .logo img {

            height: 80px;

        }

        .title {

            font-family: "Cormorant Garamond", serif;

            font-size: 44px;

            text-align: center;

            color: #b78a2c;

            margin-bottom: 10px;

        }

        .subtitle {

            text-align: center;

            color: #777;

            margin-bottom: 35px;

        }

        .summary {

            border: 1px solid #ececec;

            border-radius: 12px;

            overflow: hidden;

        }

        .row {

            display: flex;

            justify-content: space-between;

            padding: 18px 22px;

            border-bottom: 1px solid #ececec;

        }

        .row:last-child {

            border-bottom: none;

        }

        .label {

            font-weight: 600;

            color: #666;

        }

        .value {

            font-weight: 500;

            color: #222;

            text-align: right;

        }

        .total {

            background: #faf7f1;

        }

        .total .label {

            font-size: 20px;

            font-weight: 700;

            color: #b78a2c;

        }

        .total .value {

            font-size: 28px;

            font-weight: 700;

            color: #b78a2c;

        }

        .note {

            margin-top: 25px;

            font-size: 14px;

            line-height: 24px;

            color: #777;

            text-align: center;

        }

        .pay-btn {

            width: 100%;

            margin-top: 35px;

            padding: 18px;

            font-size: 18px;

            font-weight: 600;

            border: none;

            border-radius: 10px;

            background: #b78a2c;

            color: #fff;

            cursor: pointer;

            transition: .3s;

        }

        .pay-btn:hover {

            background: #9f7320;

            transform: translateY(-2px);

        }

        .payment-section {

    margin-top: 35px;
    padding: 28px;

    background: #faf7f1;

    border: 1px solid #ececec;
    border-radius: 14px;

}

.payment-section-title {

    font-family: "Cormorant Garamond", serif;
    font-size: 24px;
    font-weight: 600;
    color: #b78a2c;

    margin-bottom: 18px;

}

.payment-options {

    display: flex;
    flex-direction: column;
    gap: 14px;

}

.payment-option {

    position: relative;

    display: flex;
    align-items: center;

    cursor: pointer;

}

.payment-radio {

    position: absolute;
    left: 20px;

    width: 20px;
    height: 20px;

    accent-color: #b78a2c;
    cursor: pointer;

    z-index: 2;

}

.payment-option-content {

    display: flex;
    align-items: center;
    gap: 16px;

    width: 100%;

    padding: 18px 20px 18px 54px;

    background: #fff;

    border: 1.5px solid #ececec;
    border-radius: 12px;

    transition: border-color .25s ease, background .25s ease, box-shadow .25s ease, transform .2s ease;

}

.payment-option:hover .payment-option-content {

    border-color: #d9c188;
    box-shadow: 0 6px 18px rgba(183, 138, 44, .1);
    transform: translateY(-1px);

}

.payment-radio:checked + .payment-option-content {

    border-color: #b78a2c;
    background: #fdf6e8;
    box-shadow: 0 6px 18px rgba(183, 138, 44, .15);

}

.payment-option-icon {

    display: flex;
    align-items: center;
    justify-content: center;

    width: 44px;
    height: 44px;
    flex-shrink: 0;

    background: #f7f5f2;

    border-radius: 10px;

}

.payment-option-text {

    display: flex;
    flex-direction: column;
    gap: 2px;

}

.payment-option-name {

    font-size: 16px;
    font-weight: 600;
    color: #222;

}

.payment-option-desc {

    font-size: 12.5px;
    color: #888;

}

@media (max-width: 600px) {

    .payment-section {

        padding: 20px;

    }

    .payment-option-content {

        padding: 16px 16px 16px 48px;
        gap: 12px;

    }

    .payment-radio {

        left: 16px;

    }

    .payment-option-desc {

        display: none;

    }

}

        @media(max-width:600px) {

            .card {

                padding: 25px;

            }

            .title {

                font-size: 34px;

            }

            .row {

                flex-direction: column;

                gap: 8px;

            }

            .value {

                text-align: left;

            }

            .total .value {

                font-size: 24px;

            }
            

        }
    </style>

</head>

<body>

    <div class="card">

        <div class="logo">

            <img src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}" alt="Logo">

        </div>

        <h1 class="title">
            Order Summary
        </h1>

        <p class="subtitle">
            Please review your submission before proceeding to payment.
        </p>

        <div class="summary">

            <div class="row">

                <div class="label">
                    Entry ID
                </div>

                <div class="value">
                    {{ $submission->entry_id }}
                </div>

            </div>

            <div class="row">

                <div class="label">
                    Participant Name
                </div>

                <div class="value">
                    {{ $submission->first_name }} {{ $submission->last_name }}
                </div>

            </div>

            <div class="row">

                <div class="label">
                    Email
                </div>

                <div class="value">
                    {{ $submission->email }}
                </div>

            </div>

            <div class="row">

                <div class="label">
                    Phone
                </div>

                <div class="value">
                    {{ $submission->phone }}
                </div>

            </div>

            <div class="row">

                <div class="label">
                    Participant Type
                </div>

                <div class="value">
                    {{ ucfirst($submission->participant_type) }}
                </div>

            </div>

            <div class="row">

                <div class="label">
                    Organisation
                </div>

                <div class="value">
                    {{ $submission->organisation }}
                </div>

            </div>

            <div class="row">

                <div class="label">
                    City
                </div>

                <div class="value">
                    {{ $submission->city }}
                </div>

            </div>

            <div class="row">

                <div class="label">
                    Country
                </div>

                <div class="value">
                    {{ $submission->country }}
                </div>

            </div>

            <div class="row" style="background:#faf7f1;">

                <div class="label" style="font-size:17px;">
                    Entry 1
                </div>

                <div class="value"></div>

            </div>

            <div class="row">

                <div class="label">
                    Deity Category
                </div>

                <div class="value">
                    {{ $submission->deity_category_a }}
                </div>

            </div>

            <div class="row">

                <div class="label">
                    Jewellery Piece
                </div>

                <div class="value">
                    {{ $submission->jewellery_piece_a }}
                </div>

            </div>

            <div class="row">

                <div class="label">
                    Primary Material
                </div>

                <div class="value">
                    {{ $submission->material_a }}
                </div>

            </div>

            <div class="row" style="background:#faf7f1;">

                <div class="label" style="font-size:17px;">
                    Entry 2
                </div>

                <div class="value"></div>

            </div>

            <div class="row">

                <div class="label">
                    Deity Category
                </div>

                <div class="value">
                    {{ $submission->deity_category_b }}
                </div>

            </div>

            <div class="row">

                <div class="label">
                    Jewellery Piece
                </div>

                <div class="value">
                    {{ $submission->jewellery_piece_b }}
                </div>

            </div>

            <div class="row">

                <div class="label">
                    Primary Material
                </div>

                <div class="value">
                    {{ $submission->material_b }}
                </div>

            </div>

            <div class="row">

                <div class="label">
                    Entries Submitted
                </div>

                <div class="value">
                    Entry A + Entry B
                </div>

            </div>

            <div class="row total">

                <div class="label">
                    Total Amount
                </div>

                <div class="value">
                    ₹{{ number_format($amount) }}
                </div>

            </div>

        </div>

        <p class="note">

            Your submission will be processed once payment is successfully completed.

        </p>

        <div style="margin-top:30px;">

    <div class="payment-section">

    <h3 class="payment-section-title">Select Payment Method</h3>

    <div class="payment-options">

        <label class="payment-option" for="pay-razorpay">

            <input
                type="radio"
                id="pay-razorpay"
                name="payment_method"
                value="razorpay"
                class="payment-radio"
                checked>

            <span class="payment-option-content">

                <span class="payment-option-icon payment-icon-razorpay">
                    <svg viewBox="0 0 32 32" width="26" height="26" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#3395FF" d="M18.5 2 8 19.2h7.1L11.6 30 26 12.3h-7.6z"/>
                        <path fill="#072654" d="M18.5 2 13.9 16.9h4.4L26 12.3z" opacity=".55"/>
                    </svg>
                </span>

                <span class="payment-option-text">
                    <span class="payment-option-name">Razorpay</span>
                    <span class="payment-option-desc">Cards, UPI, Netbanking &amp; Wallets</span>
                </span>

            </span>

        </label>

        <label class="payment-option" for="pay-paypal">

            <input
                type="radio"
                id="pay-paypal"
                name="payment_method"
                value="paypal"
                class="payment-radio">

            <span class="payment-option-content">

                <span class="payment-option-icon payment-icon-paypal">
                    <svg viewBox="0 0 32 32" width="26" height="26" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#003087" d="M12.3 6.5h6.6c3.7 0 5.6 1.8 5.1 5.1-.6 4-3.4 6.1-7.1 6.1h-2.1c-.5 0-.9.3-1 .8l-.9 5.6c0 .2-.2.4-.4.4h-3.4c-.3 0-.5-.2-.4-.6L11 7.2c.1-.4.4-.7.9-.7z"/>
                        <path fill="#009cde" d="M15.9 10.2h5.1c2.9 0 4.3 1.5 3.9 4.1-.5 3.2-2.7 4.9-5.7 4.9H17c-.4 0-.7.3-.8.6l-.7 4.5c0 .1-.1.2-.3.2h-2.6l1.7-11.4c.1-.6.6-.9 1.6-.9z" opacity=".85"/>
                    </svg>
                </span>

                <span class="payment-option-text">
                    <span class="payment-option-name">PayPal</span>
                    <span class="payment-option-desc">International Payments</span>
                </span>

            </span>

        </label>

    </div>

</div>

<button id="pay-btn" data-submission="{{ $submission->id }}" class="pay-btn">
    Proceed to Payment
</button>
    </div>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>

document.getElementById("pay-btn").addEventListener("click", function () {

    let paymentMethod = document.querySelector(
        'input[name="payment_method"]:checked'
    ).value;

    let submissionId = this.dataset.submission;

    let url =
        paymentMethod === "razorpay"
            ? "{{ route('dda.create.order') }}"
            : "{{ route('dda.paypal.create') }}";

    fetch(url, {

        method: "POST",

        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },

        body: JSON.stringify({
            submission_id: submissionId
        })

    })

    .then(async (response) => {

        console.log("Status :", response.status);

        if (!response.ok) {

            const text = await response.text();

            console.log(text);

            alert("Laravel Error. Check Console.");

            return null;
        }

        return response.json();

    })

    .then(data => {

        if (!data) return;

        console.log(data);

        if (!data.success) {

            alert(data.message ?? "Unable to create payment.");

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | PAYPAL
        |--------------------------------------------------------------------------
        */

        if (paymentMethod === "paypal") {

            window.location.href = data.approve_url;

            return;

        }

        /*
        |--------------------------------------------------------------------------
        | RAZORPAY
        |--------------------------------------------------------------------------
        */

        var options = {

            key: data.key,

            amount: data.amount,

            currency: "INR",

            name: "Deities Design Awards",

            description: "Entry Fee",

            order_id: data.razorpay_order_id,

            handler: function (response) {

                fetch("{{ route('dda.razorpay.callback') }}", {

                    method: "POST",

                    headers: {

                        "Content-Type": "application/json",

                        "Accept": "application/json",

                        "X-CSRF-TOKEN": "{{ csrf_token() }}"

                    },

                    body: JSON.stringify({

                        transaction_id: data.transaction_id,

                        razorpay_payment_id: response.razorpay_payment_id,

                        razorpay_order_id: response.razorpay_order_id,

                        razorpay_signature: response.razorpay_signature

                    })

                })

                .then(res => res.json())

                .then(result => {

                    if (result.success) {

                        window.location.href =
                            "/deitiesdesignawards/payment-success";

                    } else {

                        window.location.href =
                            "/deitiesdesignawards/payment-failed";

                    }

                })

                .catch(err => {

                    console.log(err);

                    alert("Payment verification failed.");

                });

            },

            prefill: {

                name: "{{ $submission->first_name }} {{ $submission->last_name }}",

                email: "{{ $submission->email }}",

                contact: "{{ $submission->phone }}"

            },

            theme: {

                color: "#C59A2E"

            }

        };

        var rzp = new Razorpay(options);

        rzp.open();

    })

    .catch(error => {

        console.log(error);

        alert("Something went wrong.");

    });

});

</script>
</body>

</html>