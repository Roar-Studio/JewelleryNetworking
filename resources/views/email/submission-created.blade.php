<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deities Design Awards Submission</title>
</head>

<body style="margin:0;padding:0;background:#f5f5f5;font-family:Arial,Helvetica,sans-serif;color:#2A3646;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:40px 20px;">
        <tr>
            <td align="center">

                <table width="650" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:8px;overflow:hidden;border:1px solid #e5e5e5;">

                    <!-- Header -->
                    <tr>
                        <td style="padding:30px;text-align:center;border-bottom:1px solid #eeeeee;">

                            <img src="{{ asset('new_ui/assets/images/jn-logo.webp') }}" alt="Jewellery Networking"
                                style="height:80px;margin-bottom:15px;">

                            <h2 style="margin:0;font-size:28px;color:#2A3646;">
                                Deities Design Awards
                            </h2>

                            <p style="margin:10px 0 0;color:#666;">
                                Submission Acknowledgement
                            </p>

                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:35px;line-height:1.8;">

                            <p>
                                Dear <strong>{{ $submission->first_name }} {{ $submission->last_name }}</strong>,
                            </p>

                            <p>
                                Thank you for submitting your entry to the
                                <strong>Deities Design Awards</strong>.
                                We have successfully received your submission.
                            </p>

                            <table width="100%" cellpadding="8" cellspacing="0"
                                style="margin:25px 0;border-collapse:collapse;border:1px solid #e5e5e5;">

                                <tr>
                                    <td style="background:#f8f8f8;font-weight:bold;width:180px;">
                                        Entry ID
                                    </td>
                                    <td>
                                        {{ $submission->entry_id }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="background:#f8f8f8;font-weight:bold;">
                                        Participant
                                    </td>
                                    <td>
                                        {{ $submission->first_name }} {{ $submission->last_name }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="background:#f8f8f8;font-weight:bold;">
                                        Email
                                    </td>
                                    <td>
                                        {{ $submission->email }}
                                    </td>
                                </tr>

                            </table>

                            <p>
                                To review your submission details and complete the payment process, please click the
                                button below.
                            </p>

                            <div style="text-align:center;margin:35px 0;">

                                <a href="{{ route('dda.order.summary', $submission->id) }}"
                                    style="background:#1a73e8;color:#ffffff;text-decoration:none;padding:14px 28px;border-radius:6px;font-weight:bold;display:inline-block;">
                                    View Order Summary
                                </a>

                            </div>

                            <p>
                                If the button above does not work, copy and paste the following link into your browser:
                            </p>

                            <p style="word-break:break-all;color:#1a73e8;">
                                {{ route('dda.order.summary', $submission->id) }}
                            </p>

                            <p>
                                If you have already completed your payment, you may safely ignore this email.
                            </p>

                            <p style="margin-top:35px;">
                                Regards,<br>
                                <strong>Jewellery Networking Team</strong>
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="padding:20px;text-align:center;background:#fafafa;border-top:1px solid #eeeeee;font-size:13px;color:#777;">

                            © {{ date('Y') }} Jewellery Networking. All Rights Reserved.

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
