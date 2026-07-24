<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Invoice – {{ $transaction->invoice_number }}</title>
<style>
    @page {
        margin: 0px;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: 'Helvetica', Arial, sans-serif;
        color: #1E1E1E;
        background-color: #FFFFFF;
        font-size: 12px;
    }

    .page-wrapper {
        padding: 50px 50px 30px 50px;
    }

    /* ==========================================================
       Header
    ========================================================== */
    .header-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
    }

    .header-table td {
        vertical-align: middle;
        padding: 0;
    }

    .logo-cell img {
        height: 44px;
        width: auto;
    }

    .invoice-title-cell {
        text-align: right;
    }

    .invoice-title-cell h1 {
        margin: 0;
        font-size: 30px;
        font-weight: normal;
        letter-spacing: 3px;
        color: #1E1E1E;
        text-transform: uppercase;
    }

    .invoice-title-cell p {
        margin: 4px 0 0 0;
        font-size: 11px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #C6B682;
        font-weight: bold;
    }

    .gold-rule {
        height: 3px;
        background-color: #C6B682;
        margin: 20px 0 30px 0;
        font-size: 0;
        line-height: 0;
    }

    /* ==========================================================
       Meta / Info blocks
    ========================================================== */
    .info-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
    }

    .info-table td {
        vertical-align: top;
        padding: 0;
        width: 50%;
    }

    .info-block-label {
        font-size: 10px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #C6B682;
        font-weight: bold;
        margin: 0 0 10px 0;
    }

    .info-row {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 6px;
    }

    .info-row td {
        width: auto;
        padding: 3px 0;
        font-size: 12px;
    }

    .info-row .label {
        color: #6F6F6F;
        width: 45%;
    }

    .info-row .value {
        color: #1E1E1E;
        font-weight: bold;
        text-align: left;
    }

    /* ==========================================================
       Invoice Number Box
    ========================================================== */
    .invoice-number-box {
        border: 1px solid #EFE7D6;
        background-color: #FAF7F2;
        border-radius: 6px;
        padding: 14px 18px;
        margin-bottom: 30px;
        width: 100%;
    }

    .invoice-number-box table {
        width: 100%;
        border-collapse: collapse;
    }

    .invoice-number-box .label {
        font-size: 10px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #6F6F6F;
        margin: 0 0 4px 0;
    }

    .invoice-number-box .value {
        font-size: 15px;
        font-weight: bold;
        color: #1E1E1E;
        margin: 0;
    }

    /* ==========================================================
       Payment Details Table
    ========================================================== */
    .section-heading {
        font-size: 11px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #1E1E1E;
        font-weight: bold;
        border-bottom: 1px solid #EFE7D6;
        padding-bottom: 8px;
        margin-bottom: 0;
    }

    .payment-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .payment-table td {
        padding: 10px 0;
        font-size: 12px;
        border-bottom: 1px solid #F3EEE3;
    }

    .payment-table .label {
        color: #6F6F6F;
        width: 55%;
    }

    .payment-table .value {
        color: #1E1E1E;
        font-weight: bold;
        text-align: right;
    }

    .status-badge {
        display: inline;
        background-color: #1E1E1E;
        color: #C6B682;
        font-size: 10px;
        font-weight: bold;
        letter-spacing: 0.5px;
        padding: 4px 12px;
        border-radius: 10px;
    }

    /* ==========================================================
       Amount Highlight
    ========================================================== */
    .amount-box {
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .amount-box td {
        background-color: #1E1E1E;
        border-radius: 6px;
        padding: 18px 24px;
    }

    .amount-box .amount-label {
        color: #C6B682;
        font-size: 11px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin: 0 0 6px 0;
    }

    .amount-box .amount-value {
        color: #FFFFFF;
        font-size: 22px;
        font-weight: bold;
        margin: 0;
        text-align: right;
    }

    /* ==========================================================
       Footer
    ========================================================== */
    .footer-rule {
        border-top: 1px solid #EFE7D6;
        margin-top: 20px;
        margin-bottom: 20px;
        font-size: 0;
        line-height: 0;
        height: 1px;
    }

    .footer-table {
        width: 100%;
        border-collapse: collapse;
    }

    .footer-table td {
        text-align: center;
        padding: 2px 0;
    }

    .footer-brand {
        font-size: 13px;
        font-weight: bold;
        letter-spacing: 1px;
        color: #1E1E1E;
        margin: 0 0 6px 0;
    }

    .footer-contact {
        font-size: 11px;
        color: #6F6F6F;
        margin: 0;
    }

    .footer-contact a {
        color: #C6B682;
        text-decoration: none;
    }

    .footer-note {
        font-size: 9px;
        color: #A9A9A9;
        margin-top: 14px;
    }
</style>
</head>
<body>

    <div class="page-wrapper">

        <!-- ============================================================
             HEADER
        ============================================================ -->
        <table class="header-table">
            <tr>
                <td class="logo-cell" style="width:50%;">
                    <img src="{{ public_path('dda-assets/images/Logo_1_horizontal_color.svg') }}" alt="Deities Design Awards">
                </td>
                <td class="invoice-title-cell" style="width:50%;">
                    <h1>Invoice</h1>
                    <p>Deities Design Awards</p>
                </td>
            </tr>
        </table>

        <div class="gold-rule">&nbsp;</div>

        <!-- ============================================================
             INVOICE NUMBER
        ============================================================ -->
        <div class="invoice-number-box">
            <table>
                <tr>
                    <td style="width:60%;">
                        <p class="label">Invoice Number</p>
                        <p class="value">{{ $transaction->invoice_number }}</p>
                    </td>
                    <td style="width:40%; text-align:right;">
                        <p class="label">Submission ID</p>
                        <p class="value">{{ $submission->entry_id }}</p>
                    </td>
                </tr>
            </table>
        </div>

        <!-- ============================================================
             PARTICIPANT INFO
        ============================================================ -->
        <table class="info-table">
            <tr>
                <td>
                    <p class="info-block-label">Billed To</p>
                    <table class="info-row">
                        <tr>
                            <td class="label">Participant</td>
                            <td class="value">{{ $submission->first_name }} {{ $submission->last_name }}</td>
                        </tr>
                    </table>
                    <table class="info-row">
                        <tr>
                            <td class="label">Email</td>
                            <td class="value">{{ $submission->email }}</td>
                        </tr>
                    </table>
                    <table class="info-row">
                        <tr>
                            <td class="label">Country</td>
                            <td class="value">{{ $submission->country }}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <p class="info-block-label">Submission</p>
                    <table class="info-row">
                        <tr>
                            <td class="label">Submission ID</td>
                            <td class="value">{{ $submission->entry_id }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- ============================================================
             PAYMENT DETAILS
        ============================================================ -->
        <p class="section-heading">Payment Details</p>
        <table class="payment-table">
            <tr>
                <td class="label">Transaction ID</td>
                <td class="value">{{ $transaction->transaction_no }}</td>
            </tr>
            <tr>
                <td class="label">Gateway</td>
                <td class="value">{{ ucfirst($transaction->gateway) }}</td>
            </tr>
            <tr>
                <td class="label">Payment Status</td>
                <td class="value" style="text-align:right;">
                    <span class="status-badge">Completed</span>
                </td>
            </tr>
            <tr>
                <td class="label" style="border-bottom:none;">Payment Date</td>
                <td class="value" style="border-bottom:none;">{{ $transaction->created_at }}</td>
            </tr>
        </table>

        <!-- ============================================================
             AMOUNT HIGHLIGHT
        ============================================================ -->
        <table class="amount-box">
            <tr>
                <td>
                    <table style="width:100%; border-collapse:collapse;">
                        <tr>
                            <td style="width:50%;">
                                <p class="amount-label">Total Amount Paid</p>
                            </td>
                            <td style="width:50%;">
                                <p class="amount-value">Rs. {{ number_format($transaction->amount, 2) }}</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- ============================================================
             FOOTER
        ============================================================ -->
        <div class="footer-rule">&nbsp;</div>

        <table class="footer-table">
            <tr>
                <td>
                    <p class="footer-brand">Deities Design Awards</p>
                    <p class="footer-contact">
                        <a href="mailto:info@deitiesdesignawards.com">info@deitiesdesignawards.com</a>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                        <a href="https://www.deitiesdesignawards.com">www.deitiesdesignawards.com</a>
                    </p>
                    <p class="footer-note">This is a system-generated invoice and does not require a signature.</p>
                </td>
            </tr>
        </table>

    </div>

</body>
</html>