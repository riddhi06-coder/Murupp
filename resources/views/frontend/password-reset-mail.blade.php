<!DOCTYPE html>
<html>
<head>
    <title>Reset Your Password</title>
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
        .reset-btn {
            background-color: black;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 30px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            display: inline-block;
            text-align: center ;
        }

        .reset-btn:hover {
            background-color: #333; /* Slightly lighter black on hover */
        }

    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('frontend/assets/images/logo/logo.webp') }}" alt="Murupp" class="logo">
    </div>

    <p>Hello,</p>
    <p>You requested to reset your password. Click the link below:</p><br>
    <div style="text-align: center;">
        <form action="{{ url('/reset-password/' . $token) }}" method="GET">
            <button class="tf-btn btn-fill reset-btn">
                Reset Password
            </button>
        </form>
    </div><br>

    <p>If you did not request this, please ignore this email.</p><br>

    <br>
    <hr>
    <!-- Footer Section -->
    <div class="footer">
        <div class="copyright">© {{ date('Y') }} Murupp. All rights reserved.</div>
    </div>
</body>
</html>
