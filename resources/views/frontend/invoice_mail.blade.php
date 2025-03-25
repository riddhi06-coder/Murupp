<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .header {
            font-size: 24px;
            font-weight: bold;
            color: #444;
            margin-bottom: 20px;
        }
        .invoice-details {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
            text-align: left;
            margin-bottom: 20px;
        }
       
        .footer {
            font-size: 14px;
            color: #777;
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">Invoice Details</div>
        <p>Dear <strong>{{ $order->customer_name }}</strong>,</p>
        <p>Thank you for your order! Please find your invoice details below:</p><br>

        <div class="invoice-details">
            <p><strong>Invoice Number:</strong> {{ $order->invoice_id }}</p>
            <p><strong>Order Date:</strong> {{ date('d M Y', strtotime($order->order_date ?? now())) }}</p>
            <p><strong>Total Amount:</strong> ₹{{ number_format($order->total_price, 2) }}</p>
        </div>

        <div class="footer">
            If you have any questions, feel free to contact us.<br>
            <p>Murupp Team</p><br>
            <b>© {{ date('Y') }} Murupp. All rights reserved. </b>
        </div>
    </div>
</body>
</html>
