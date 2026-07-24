<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
</head>

<body style="margin:0; padding:0; background-color:#f7f5f2; font-family: Arial, Helvetica, sans-serif;">

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f7f5f2; padding:30px 0;">
        <tr>
            <td align="center">

                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px; background-color:#ffffff; border-radius:14px; overflow:hidden; box-shadow:0 8px 30px rgba(0,0,0,.06);">

                    <!-- Header / Logo -->
                    <tr>
                        <td align="center" style="background-color:#0d0d0d; padding:35px 20px;">
                            <img src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards" height="46" style="display:block;">
                        </td>
                    </tr>

                    <!-- Status Strip -->
                    <tr>
                        <td align="center" style="background-color:#b78a2c; padding:10px;">
                            <p style="margin:0; font-size:12px; letter-spacing:2px; text-transform:uppercase; color:#ffffff; font-weight:bold;">
                                Payment Not Verified
                            </p>
                        </td>
                    </tr>

                    <!-- Heading -->
                    <tr>
                        <td align="center" style="padding:40px 40px 10px 40px;">
                            <h1 style="margin:0; font-family: Georgia, 'Times New Roman', serif; font-size:32px; color:#0d0d0d;">
                                Payment Failed
                            </h1>
                        </td>
                    </tr>

                    <!-- Greeting / Message -->
                    <tr>
                        <td style="padding:10px 40px 0 40px;">
                            <p style="margin:0 0 14px 0; font-size:16px; color:#333333; line-height:24px;">
                                Dear {{ $submission->first_name }},
                            </p>
                            <p style="margin:0 0 14px 0; font-size:15px; color:#555555; line-height:24px;">
                                Unfortunately, we were unable to verify your payment.
                            </p>
                            <p style="margin:0 0 14px 0; font-size:15px; color:#555555; line-height:24px;">
                                <strong style="color:#0d0d0d;">Do not worry.</strong> Your submission has <strong style="color:#0d0d0d;">NOT</strong> been deleted.
                            </p>
                        </td>
                    </tr>

                    <!-- Submission Details -->
                    <tr>
                        <td style="padding:20px 40px 0 40px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #ececec; border-radius:12px; overflow:hidden;">
                                <tr>
                                    <td colspan="2" style="background-color:#faf7f1; padding:12px 18px;">
                                        <p style="margin:0; font-size:13px; letter-spacing:1px; text-transform:uppercase; color:#b78a2c; font-weight:bold;">
                                            Submission Details
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 18px; border-bottom:1px solid #ececec; font-size:14px; color:#666666; font-weight:600;">
                                        Submission ID
                                    </td>
                                    <td style="padding:14px 18px; border-bottom:1px solid #ececec; font-size:14px; color:#222222; text-align:right; font-weight:500;">
                                        {{ $submission->entry_id }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 18px; border-bottom:1px solid #ececec; font-size:14px; color:#666666; font-weight:600;">
                                        Participant
                                    </td>
                                    <td style="padding:14px 18px; border-bottom:1px solid #ececec; font-size:14px; color:#222222; text-align:right; font-weight:500;">
                                        {{ $submission->first_name }} {{ $submission->last_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 18px; font-size:14px; color:#666666; font-weight:600;">
                                        Email
                                    </td>
                                    <td style="padding:14px 18px; font-size:14px; color:#222222; text-align:right; font-weight:500;">
                                        {{ $submission->email }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Payment Details -->
                    <tr>
                        <td style="padding:20px 40px 0 40px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #ececec; border-radius:12px; overflow:hidden;">
                                <tr>
                                    <td colspan="2" style="background-color:#faf7f1; padding:12px 18px;">
                                        <p style="margin:0; font-size:13px; letter-spacing:1px; text-transform:uppercase; color:#b78a2c; font-weight:bold;">
                                            Payment Details
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 18px; border-bottom:1px solid #ececec; font-size:14px; color:#666666; font-weight:600;">
                                        Transaction ID
                                    </td>
                                    <td style="padding:14px 18px; border-bottom:1px solid #ececec; font-size:14px; color:#222222; text-align:right; font-weight:500;">
                                        {{ $transaction->transaction_no }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 18px; border-bottom:1px solid #ececec; font-size:14px; color:#666666; font-weight:600;">
                                        Gateway
                                    </td>
                                    <td style="padding:14px 18px; border-bottom:1px solid #ececec; font-size:14px; color:#222222; text-align:right; font-weight:500;">
                                        {{ ucfirst($transaction->gateway) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 18px; border-bottom:1px solid #ececec; font-size:14px; color:#666666; font-weight:600;">
                                        Amount
                                    </td>
                                    <td style="padding:14px 18px; border-bottom:1px solid #ececec; font-size:14px; color:#222222; text-align:right; font-weight:500;">
                                        Rs. {{ number_format($transaction->amount, 2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 18px; font-size:14px; color:#666666; font-weight:600;">
                                        Status
                                    </td>
                                    <td style="padding:14px 18px; text-align:right;">
                                        <span style="display:inline-block; background-color:#fbeaea; color:#b71c1c; font-size:12px; font-weight:bold; padding:4px 12px; border-radius:20px;">
                                            Failed
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Next Steps -->
                    <tr>
                        <td style="padding:30px 40px 0 40px;">
                            <p style="margin:0 0 6px 0; font-size:15px; color:#0d0d0d; font-weight:bold;">
                                Next Steps
                            </p>
                            <p style="margin:0 0 10px 0; font-size:14px; color:#555555; line-height:23px;">
                                Please try completing your payment again.
                            </p>
                            <p style="margin:0; font-size:14px; color:#555555; line-height:23px;">
                                If money has been deducted from your account but this email was received, kindly contact our support team.
                            </p>
                        </td>
                    </tr>

                    <!-- Retry Button -->
                    <tr>
                        <td align="center" style="padding:30px 40px 10px 40px;">
                            <a href="{{ url('/') }}"
                                style="display:inline-block; background-color:#b78a2c; color:#ffffff; text-decoration:none; font-size:16px; font-weight:600; padding:16px 40px; border-radius:10px;">
                                Retry Payment
                            </a>
                        </td>
                    </tr>

                    <!-- Support -->
                    <tr>
                        <td align="center" style="padding:20px 40px 40px 40px;">
                            <p style="margin:0 0 4px 0; font-size:13px; color:#888888;">
                                Need help? Contact us at
                                <a href="mailto:info@deitiesdesignawards.com" style="color:#b78a2c; text-decoration:none;">info@deitiesdesignawards.com</a>
                            </p>
                            <p style="margin:0; font-size:13px; color:#888888;">
                                <a href="https://www.deitiesdesignawards.com" style="color:#b78a2c; text-decoration:none;">www.deitiesdesignawards.com</a>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="background-color:#0d0d0d; padding:20px;">
                            <p style="margin:0; font-size:12px; color:#a49685;">
                                &copy; {{ date('Y') }} Deities Design Awards
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>