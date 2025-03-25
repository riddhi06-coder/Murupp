<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
</head>
<body>
    <p>Dear {{ $order->customer_name }},</p>
    <p>Thank you for your order. Please find your invoice attached.</p>
    <p>Invoice Number: {{ $order->invoice_id }}</p>
</body>
</html>
