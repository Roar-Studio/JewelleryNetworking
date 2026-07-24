<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment Confirmation – Deities Design Awards</title>
</head>
<body style="margin:0; padding:0; background-color:#FAF7F2; font-family: Georgia, 'Times New Roman', serif;">

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#FAF7F2; padding:40px 0;">
        <tr>
            <td align="center">

                <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="background-color:#FFFFFF; border-radius:12px; overflow:hidden; box-shadow:0 10px 40px rgba(30,30,30,0.08); border:1px solid #EFE7D6;">

                    <!-- Logo -->
                    <tr>
                        <td align="center" style="background-color:#1E1E1E; padding:36px 30px;">
                            <img src="{{ asset('dda-assets/images/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards" width="180" style="display:block; height:auto; max-width:180px;">
                        </td>
                    </tr>

                    <!-- Gold Divider -->
                    <tr>
                        <td style="background-color:#C6B682; height:4px; line-height:4px; font-size:0;">&nbsp;</td>
                    </tr>

                    <!-- Heading -->
                    <tr>
                        <td align="center" style="padding:40px 40px 10px 40px;">
                            <p style="margin:0; font-size:12px; letter-spacing:3px; text-transform:uppercase; color:#C6B682; font-weight:bold; font-family: Arial, Helvetica, sans-serif;">Deities Design Awards</p>
                            <h1 style="margin:14px 0 0 0; font-size:26px; color:#1E1E1E; font-weight:normal; letter-spacing:0.5px;">Payment Successful</h1>
                        </td>
                    </tr>

                    <!-- Greeting -->
                    <tr>
                        <td style="padding:20px 40px 0 40px; font-family: Arial, Helvetica, sans-serif;">
                            <p style="margin:0 0 16px 0; font-size:15px; color:#1E1E1E; line-height:1.6;">Dear {{ $submission->first_name }},</p>
                            <p style="margin:0 0 16px 0; font-size:15px; color:#6F6F6F; line-height:1.7;">
                                Thank you for participating in the Deities Design Awards. Your payment has been successfully received.
                            </p>
                        </td>
                    </tr>

                    <!-- Submission Details -->
                    <tr>
                        <td style="padding:20px 40px 0 40px; font-family: Arial, Helvetica, sans-serif;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #EFE7D6; border-radius:8px; overflow:hidden;">
                                <tr>
                                    <td colspan="2" style="background-color:#FAF7F2; padding:14px 20px; border-bottom:1px solid #EFE7D6;">
                                        <p style="margin:0; font-size:13px; letter-spacing:1.5px; text-transform:uppercase; color:#1E1E1E; font-weight:bold;">Submission Details</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 20px 6px 20px; font-size:13px; color:#6F6F6F; width:45%;">Submission ID</td>
                                    <td style="padding:14px 20px 6px 20px; font-size:14px; color:#1E1E1E; font-weight:bold; text-align:right;">{{ $submission->entry_id }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:6px 20px; font-size:13px; color:#6F6F6F;">Participant</td>
                                    <td style="padding:6px 20px; font-size:14px; color:#1E1E1E; font-weight:bold; text-align:right;">{{ $submission->first_name }} {{ $submission->last_name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:6px 20px 16px 20px; font-size:13px; color:#6F6F6F;">Email</td>
                                    <td style="padding:6px 20px 16px 20px; font-size:14px; color:#1E1E1E; font-weight:bold; text-align:right;">{{ $submission->email }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Payment Details -->
                    <tr>
                        <td style="padding:24px 40px 0 40px; font-family: Arial, Helvetica, sans-serif;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #EFE7D6; border-radius:8px; overflow:hidden;">
                                <tr>
                                    <td colspan="2" style="background-color:#FAF7F2; padding:14px 20px; border-bottom:1px solid #EFE7D6;">
                                        <p style="margin:0; font-size:13px; letter-spacing:1.5px; text-transform:uppercase; color:#1E1E1E; font-weight:bold;">Payment Details</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 20px 6px 20px; font-size:13px; color:#6F6F6F; width:45%;">Transaction ID</td>
                                    <td style="padding:14px 20px 6px 20px; font-size:14px; color:#1E1E1E; font-weight:bold; text-align:right;">{{ $transaction->transaction_no }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:6px 20px; font-size:13px; color:#6F6F6F;">Gateway</td>
                                    <td style="padding:6px 20px; font-size:14px; color:#1E1E1E; font-weight:bold; text-align:right;">{{ ucfirst($transaction->gateway) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:6px 20px; font-size:13px; color:#6F6F6F;">Amount</td>
                                    <td style="padding:6px 20px; font-size:14px; color:#1E1E1E; font-weight:bold; text-align:right;">Rs. {{ number_format($transaction->amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:6px 20px; font-size:13px; color:#6F6F6F;">Payment Date</td>
                                    <td style="padding:6px 20px; font-size:14px; color:#1E1E1E; font-weight:bold; text-align:right;">{{ $transaction->created_at }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:6px 20px 16px 20px; font-size:13px; color:#6F6F6F;">Status</td>
                                    <td style="padding:6px 20px 16px 20px; text-align:right;">
                                        <span style="display:inline-block; background-color:#1E1E1E; color:#C6B682; font-size:12px; font-weight:bold; letter-spacing:0.5px; padding:5px 14px; border-radius:20px;">Completed</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Next Steps -->
                    <tr>
                        <td style="padding:32px 40px 0 40px; font-family: Arial, Helvetica, sans-serif;">
                            <p style="margin:0 0 10px 0; font-size:13px; letter-spacing:1.5px; text-transform:uppercase; color:#1E1E1E; font-weight:bold;">Next Steps</p>
                            <p style="margin:0 0 10px 0; font-size:14px; color:#6F6F6F; line-height:1.7;">Our jury will review your submission.</p>
                            <p style="margin:0 0 10px 0; font-size:14px; color:#6F6F6F; line-height:1.7;">Please keep your Submission ID safe.</p>
                            <p style="margin:0; font-size:14px; color:#6F6F6F; line-height:1.7;">You will receive future communication on this email.</p>
                        </td>
                    </tr>

                    <!-- Divider -->
                    <tr>
                        <td style="padding:32px 40px 0 40px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="border-top:1px solid #EFE7D6; font-size:0; line-height:0;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Support -->
                    <tr>
                        <td align="center" style="padding:28px 40px 40px 40px; font-family: Arial, Helvetica, sans-serif;">
                            <p style="margin:0 0 6px 0; font-size:13px; letter-spacing:1.5px; text-transform:uppercase; color:#1E1E1E; font-weight:bold;">Support</p>
                            <p style="margin:0 0 4px 0; font-size:14px;">
                                <a href="mailto:info@deitiesdesignawards.com" style="color:#C6B682; text-decoration:none;">info@deitiesdesignawards.com</a>
                            </p>
                            <p style="margin:0; font-size:14px;">
                                <a href="https://www.deitiesdesignawards.com" style="color:#C6B682; text-decoration:none;">www.deitiesdesignawards.com</a>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="background-color:#1E1E1E; padding:20px 40px;">
                            <p style="margin:0; font-size:11px; color:#A9A9A9; font-family: Arial, Helvetica, sans-serif; letter-spacing:0.5px;">
                                &copy; {{ date('Y') }} Deities Design Awards. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>