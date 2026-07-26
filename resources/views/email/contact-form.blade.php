<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Form Enquiry</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; color:#333;">

<h2>New Contact Form Submission</h2>

<table cellpadding="8" cellspacing="0" border="1" style="border-collapse:collapse; width:100%;">
    <tr>
        <th align="left" width="180">Name</th>
        <td>{{ $data['name'] }}</td>
    </tr>

    <tr>
        <th align="left">Email</th>
        <td>{{ $data['email'] }}</td>
    </tr>

    <tr>
        <th align="left">Subject</th>
        <td>{{ $data['subject'] }}</td>
    </tr>

    <tr>
        <th align="left">Message</th>
        <td>{!! nl2br(e($data['message'])) !!}</td>
    </tr>
</table>

<br>

<p>
Submitted at:
<strong>{{ now()->format('d M Y h:i A') }}</strong>
</p>

</body>
</html>