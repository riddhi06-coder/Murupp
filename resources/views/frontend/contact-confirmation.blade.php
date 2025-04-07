<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            max-width: 200px;
            display: block;
            margin: 0 auto;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('frontend/assets/images/logo/logo.webp') }}" alt="Murupp" class="logo">
    </div>

    <p>Hello {{ $emailData['name'] ?? 'there' }},</p>

    <p>Thank you for reaching out to us. Your enquiry has been received successfully. <br> We will get back to you shortly.</p><br>

    <p>Warm regards,<br><br> <strong>Murupp Team </strong></p>

    <hr>

    <div class="footer">
        © {{ date('Y') }} Murupp. All rights reserved.
    </div>
</body>
</html>
