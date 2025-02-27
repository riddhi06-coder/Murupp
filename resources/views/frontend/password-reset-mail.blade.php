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
    <p>We received a request to reset your password. If you made this request, please click the button below to set a new password:</p><br>
    <div style="text-align: center;">
        <a href="{{ route('user.resetpassword', ['token' => $token]) }}" style="text-decoration: none;">
            <button class="tf-btn btn-fill reset-btn" style="background-color: #000; color: #fff; padding: 12px 24px; border-radius: 30px; font-size: 16px; border: none; cursor: pointer;">
                Reset Your Password
            </button>
        </a>
    </div>


    <p>If you didn’t request a password reset, please ignore this email. Your account is still secure.</p>

    <p>For any assistance, feel free to contact our support team.</p><br>

    <p>Best regards,<br> Murupp Team</p>


    <br>
    <hr>
    <!-- Footer Section -->
    <div class="footer">
        <div class="copyright">© {{ date('Y') }} Murupp. All rights reserved.</div>
    </div>
</body>
</html>
