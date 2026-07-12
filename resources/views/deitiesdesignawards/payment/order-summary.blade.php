<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Order Summary</title>

<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{

background:#f7f5f2;
font-family:Inter,sans-serif;
color:#333;

display:flex;
justify-content:center;
align-items:center;

min-height:100vh;

padding:30px;

}

.card{

width:100%;
max-width:760px;

background:#fff;

border-radius:18px;

padding:45px;

box-shadow:
0 12px 40px rgba(0,0,0,.08);

}

.logo{

text-align:center;
margin-bottom:25px;

}

.logo img{

height:80px;

}

.title{

font-family:"Cormorant Garamond",serif;

font-size:44px;

text-align:center;

color:#b78a2c;

margin-bottom:10px;

}

.subtitle{

text-align:center;

color:#777;

margin-bottom:35px;

}

.summary{

border:1px solid #ececec;

border-radius:12px;

overflow:hidden;

}

.row{

display:flex;

justify-content:space-between;

padding:18px 22px;

border-bottom:1px solid #ececec;

}

.row:last-child{

border-bottom:none;

}

.label{

font-weight:600;

color:#666;

}

.value{

font-weight:500;

color:#222;

text-align:right;

}

.total{

background:#faf7f1;

}

.total .label{

font-size:20px;

font-weight:700;

color:#b78a2c;

}

.total .value{

font-size:28px;

font-weight:700;

color:#b78a2c;

}

.note{

margin-top:25px;

font-size:14px;

line-height:24px;

color:#777;

text-align:center;

}

.pay-btn{

width:100%;

margin-top:35px;

padding:18px;

font-size:18px;

font-weight:600;

border:none;

border-radius:10px;

background:#b78a2c;

color:#fff;

cursor:pointer;

transition:.3s;

}

.pay-btn:hover{

background:#9f7320;

transform:translateY(-2px);

}

@media(max-width:600px){

.card{

padding:25px;

}

.title{

font-size:34px;

}

.row{

flex-direction:column;

gap:8px;

}

.value{

text-align:left;

}

.total .value{

font-size:24px;

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
Participant
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
Award Category
</div>

<div class="value">
{{ ucfirst($submission->award_category) }}
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

<button
    id="pay-btn"
    data-submission="{{ $submission->id }}"
    class="btn">
    Proceed to Payment
</button>

</div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

document.getElementById("pay-btn").addEventListener("click", function () {

    let submissionId = this.dataset.submission;

    fetch("{{ route('dda.create.order') }}", {

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

            console.log("Laravel Error:");
            console.log(text);

            alert("Laravel returned an error. Check Console.");

            return null;
        }

        return response.json();

    })

    .then(data => {

        if (!data) return;

        console.log("Response :", data);

        if (!data.success) {

            alert("Unable to create order");

            return;
        }

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

            "Content-Type":"application/json",

            "Accept":"application/json",

            "X-CSRF-TOKEN":"{{ csrf_token() }}"

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

        console.log(result);

        if(result.success){

            window.location.href="{{ route('dda.payment.success') }}";

        }else{

            alert(result.message);

        }

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

        console.error("Fetch Error:", error);

        alert("Something went wrong.");

    });

});

</script>
</body>

</html>