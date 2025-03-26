<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
 
</head>
 
<style>
    @font-face {
        font-family: 'DejaVu Sans';
        font-style: normal;
        font-weight: normal;
        src: url("{{ storage_path('fonts/DejaVuSans.ttf') }}") format('truetype');
    }
 
    body {
        font-family: 'DejaVu Sans', sans-serif;
        font-size: 14px;
        line-height: 1.6;
        color: #333;
    }
 
    h2 {
        margin-bottom: 5px !important;
    }
 
    p {
        margin-top: 0;
        margin-bottom: 10px;
    }
 
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
 
    .table th, .table td {
        border: 1px solid #0a0a0a;
        padding: 8px;
        text-align: left;
    }
 
    .table th {
        background-color: #f4f4f4;
        font-weight: bold;
    }
 
    .table td {
        font-size: 14px;
    }
 
    .totals {
        text-align: right;
        margin-top: 20px;
    }
 
    .totals p {
        margin: 4px 0;
        font-size: 14px;
    }
 
    .totals p:last-child {
        font-weight: bold;
    }
 
    .footer {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: #000000;
        padding: 10px;
        margin-top: 20px;
        text-align: center;
        font-size: 15px;
        color: #fff;
    }
 
    @media only screen and (max-width: 600px) {
        @font-face {
        font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            src: url("{{ storage_path('fonts/DejaVuSans.ttf') }}") format('truetype');
        }
 
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
        }
 
        h2 {
            margin-bottom: 15px !important;
        }
 
        p {
            margin-top: 0;
            margin-bottom: 10px;
        }
 
        table {
            width: 100%;
        }
 
        .table th, .table td {
            font-size: 12px;
            padding: 6px;
        }
 
        td, th {
            display: block;
            width: 100%;
        }
 
        .table thead {
            display: none; /* Hide table header */
        }
 
        .table tr {
            display: block;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            padding: 8px;
        }
 
        .table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: right;
            font-size: 12px;
        }
 
        .table td::before {
            content: attr(data-label);
            font-weight: bold;
            text-align: left;
            flex: 1;
        }
 
        .totals {
            text-align: center;
        }
 
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color:rgb(95, 92, 92);
            padding: 10px;
            margin-top: 20px;
            text-align: center;
            font-size: 15px;
            color: #fff;
        }
    }
</style>
 
<body>
    <table width="100%">
        <tr>
            <td width="80%" style="text-align: left;">
                <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('/frontend/assets/images/logo/logo.webp'))) }}" alt="Logo" style="width: 250px;">
            </td>
            <td width="50%" style="text-align: right;">
                <h3 style="margin-bottom: 0;">INVOICE</h3>
                <p style="margin-top: 0;"># {{ data_get($order, 'invoice_id', '-') }}</p>
            </td>

        </tr>
    </table>
 
    <table width="100%">
        <tr>
            <!-- Left Column: Bill To -->
            <td width="50%" style="vertical-align: top;">
                <h2>Billing Address :</h2>
                <p>
                    @foreach(explode(',', data_get($order, 'billing_address', '-')) as $part)
                        {{ trim($part) }}<br>
                    @endforeach
                </p>
            </td>
 
            <!-- Right Column: From -->
            <td width="50%" style="vertical-align: top; text-align: right;">
                <h2>Shipping Address :</h2>
                <p>
                    @foreach(explode(',', data_get($order, 'shipping_address', '-')) as $part)
                        {{ trim($part) }}<br>
                    @endforeach
                </p>
            </td>
        </tr>
    </table>
 
    <table width="100%">
        <tr>
            <!-- Left Column: Bill To -->
            <td width="50%" style="vertical-align: top;">
                <h2>Customer Details :</h2>
                <p>
                    Customer Name: {{ data_get($order, 'customer_name', '-') }}<br>
                    Email: {{ data_get($order, 'customer_email', '-') }}<br>
                    Phone: +91 {{ data_get($order, 'customer_phone', '-') }}<br>
                </p>
            </td>
        </tr>
    </table><br>
 
    {{-- Table --}}
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Qty</th>
                <th>Size</th>
                <th>Print</th>
                <th>Rate</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @php
                $items = json_decode(data_get($order, 'product_names', '[]'), true);
                $quantities = json_decode(data_get($order, 'quantities', '[]'), true);
                $prices = json_decode(data_get($order, 'prices', '[]'), true);
                $prints = json_decode(data_get($order, 'prints', '[]'), true);
                $sizes = json_decode(data_get($order, 'sizes', '[]'), true);
            @endphp
            @foreach($items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item }}</td>
                    <td>{{ $quantities[$index] ?? '-' }}</td>
                    <td>{{ $sizes[$index] ?? '-' }}</td>
                    <td>{{ !empty($prints[$index]) ? $prints[$index] : '-' }}</td>
                    <td>₹ {{ number_format($prices[$index] ?? 0, 2) }}</td>
                    <td>₹ {{ number_format(($prices[$index] ?? 0) * ($quantities[$index] ?? 1)) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" style="text-align: right;"><b>Sub Total</b></td>
                <td>₹ {{ number_format(data_get($order, 'total_price', 0)) }}</td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: right;"><b>Total (including Taxes)</b></td>
                <td>₹ {{ number_format(data_get($order, 'total_price', 0)) }}</td>
            </tr>
        </tfoot>
    </table>

 
    {{-- Footer --}}
    <div class="footer">
        <b>© {{ date('Y') }} Murupp. All rights reserved. </b>
    </div>
</body>
 
</html>