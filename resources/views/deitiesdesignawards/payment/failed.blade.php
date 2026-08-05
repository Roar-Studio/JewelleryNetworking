<!DOCTYPE html>
<html>

<head>

    <title>Payment Failed</title>

    <style>
        body {

            font-family: Arial;
            background: #f7f5f2;

            display: flex;

            justify-content: center;

            align-items: center;

            height: 100vh;

        }

        .card {

            background: white;

            width: 600px;

            padding: 50px;

            border-radius: 15px;

            text-align: center;

            box-shadow: 0 10px 30px rgba(0, 0, 0, .1);

        }

        h1 {

            color: #d32f2f;

        }

        a {

            display: inline-block;

            margin-top: 30px;

            padding: 15px 30px;

            background: #C59A2E;

            color: white;

            text-decoration: none;

            border-radius: 8px;

        }
    </style>

</head>

<body>

    <div class="card">

        <h1>Payment Failed</h1>

        <p>

            Unfortunately your payment could not be completed.

        </p>

        <p>

            Please try again.

        </p>

        <a href="/deitiesdesignawards/order-summary/{{ request()->query('entry_id') }}">

            Try Again

        </a>

    </div>

</body>

</html>
