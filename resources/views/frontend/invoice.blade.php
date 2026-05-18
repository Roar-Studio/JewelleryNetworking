<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $invoice_no }}</title>
    <style>
        @page {
            margin: 5mm 5mm 5mm 5mm;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 15px;
            margin: 0;
            color: #2A3646;
            padding: 0;
        }

        .header tr td {
            width: 33.33%;
            vertical-align: top;
        }

        h2 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }

        h3 {
            margin: 0 0 6px 0;
            font-size: 16px;
            font-weight: 700;
        }

        p {
            margin: 0;
        }

        /* 🔹 Added consistent spacing for both From & Bill To sections */
        .bill-to p,
        .from p {
            line-height: 1.8;  /* equal spacing between lines */
        }

        /* 🔹 Styling for right side invoice details */
        .invoice-info {
            line-height: 1.8;
        }

        .invoice-info strong {
            font-weight: 700;
        }

        .invoice-no {
            font-size: 16px;
            font-weight: 700;
        }

        .invoice-details {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .invoice-details th, .invoice-details td {
            padding: 8px;
            text-align: left;
            text-transform: capitalize;
            border-bottom: 1px solid #ddd;
        }

        .invoice-details tr td:last-child,
        .invoice-details tr th:last-child {
            text-align: right;
        }

        .invoice-details th {
            font-weight: bold;
        }

        .total th, .total td {
            border-top: 2px solid #000;
        }

        .extra-space {
            border: unset !important;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>

</head>
<body>
    <div class="container">
        <table class="header">
            <tr>
                <td>
                    <h2>Invoice</h2>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('new_ui/assets/images/jn-logo.webp'))) }}" alt="Logo" height="100"/>
                </td>
                <td></td>
                <td class="from">
                    <h3>From</h3>
                    <p style="font-transform: capitalize;">{{ $from['company'] }}<br>
                        {{ $from['address'] }}<br>
                        Tax Id: {{ $from['tax_id'] }}</p>

                </td>
            </tr>
            <tr>
                <td class="bill-to">
                    <h3>Bill To</h3>
                    <p style="text-transform: capitalize; line-height: 1.6;">
                        {{ $bill_to['company'] ?? '' }}<br>
                        {{ $bill_to['name'] ?? '' }}<br>
                        {{ $bill_to['address'] ?? '' }}<br>
                        Email: {{ $bill_to['email'] ?? '' }}<br>
                        Phone: {{ $bill_to['phone'] ?? '' }}<br/>
                        Tax Id: {{ $bill_to['trn_no'] ?? 'N/A' }}
                    </p>
                </td>
                <td></td>
                <td class="invoice-info">
                    <br/>
                    <p><span class="invoice-no"><strong>Invoice No:</strong>{{ $invoice_no }}</span></p>
                    <p><strong>Order Date:</strong> {{ \Carbon\Carbon::parse($order_date)->format('m-d-Y') }}</p>
                    <p><strong>Payment Method:</strong> {{ $payment_method }}</p>
                </td>
            </tr>
        </table>
        <table class="invoice-details">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item['product'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $currency_type }} {{ number_format($item['unit_price'], 2) }}</td>
                        <td>{{ $currency_type }} {{ number_format($item['total_price'], 2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td class="extra-space" colspan="3"></td>
                    <th>Subtotal:</th>
                    <td>{{ $currency_type }} {{ number_format($subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td class="extra-space" colspan="3"></td>
                    <th>Tax:</th>
                    <td>{{ $currency_type }} {{ number_format($tax, 2) }}</td>
                </tr>
                <tr>
                    <td class="extra-space" colspan="3"></td>
                    <th>Discount:</th>
                    <td>{{ $currency_type }} -{{ number_format($discount, 2) }}</td>
                </tr>
                <tr>
                    <td class="extra-space" colspan="3"></td>
                    <th>Total:</th>
                    <td>{{ $currency_type }} {{ number_format($total, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Thank you for your business!</p>
        </div>
    </div>
</body>
</html>
