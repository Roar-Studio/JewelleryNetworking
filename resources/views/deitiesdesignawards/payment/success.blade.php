<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Payment Successful</title>

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

            display:flex;
            justify-content:center;
            align-items:center;

            min-height:100vh;
            padding:30px;

        }

        .card{

            max-width:700px;
            width:100%;

            background:#fff;

            border-radius:18px;

            padding:50px;

            text-align:center;

            box-shadow:0 12px 40px rgba(0,0,0,.08);

        }

        h1{

            font-family:"Cormorant Garamond",serif;

            color:#2E7D32;

            font-size:46px;

            margin-bottom:15px;

        }

        p{

            color:#666;

            line-height:28px;

            margin-bottom:15px;

            font-size:17px;

        }

        .entry{

            margin:35px 0;

            padding:20px;

            background:#faf7f1;

            border-radius:12px;

        }

        .entry h3{

            color:#b78a2c;

            margin-bottom:10px;

        }

        .entry strong{

            font-size:28px;

            color:#222;

        }

        .btn{

            display:inline-block;

            margin-top:30px;

            padding:15px 35px;

            background:#b78a2c;

            color:#fff;

            text-decoration:none;

            border-radius:8px;

            font-weight:600;

        }

    </style>

</head>

<body>

<div class="card">

    <h1>Payment Successful</h1>

    <p>

        Thank you for participating in the
        <strong>Deities Design Awards.</strong>

    </p>

    <p>

        Your payment has been received successfully.

    </p>

    <div class="entry">

    <h3>Payment Status</h3>

    <strong>Completed Successfully</strong>

</div>

<p>

    Your submission has been received successfully.

</p>

<p>

    A confirmation email will be sent to your registered email address.

</p>

    <a href="{{ url('/deitiesdesignawards') }}" class="btn">

        Back to Home

    </a>

</div>

</body>

</html>