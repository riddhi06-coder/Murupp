<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <style>
        .header {
            text-align: center; /* Centers inline elements like img */
            margin-bottom: 20px;
        }

        .logo {
            width: 50%;
            max-width: 200px;
            height: auto;
            display: block;
            margin: 0 auto; /* Centers the image */
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

    <p>Contact Form submission <span style="font-size: 1.1em; font-weight: bold;">{{ $emailData['name'] ?? 'name' }}</span></p><br>
    <p><strong>Name:</strong> {{ $emailData['name'] }}</p>
    <p><strong>Email:</strong> {{ $emailData['email'] }}</p>
    <p><strong>Message:</strong> {{ nl2br(e($emailData['message'])) }}</p>
    <br>
    <hr>
    <!-- Footer Section -->
    <div class="footer">
        <div class="copyright">© {{ date('Y') }} Murupp. All rights reserved.</div>
    </div>
</body>
</html>
