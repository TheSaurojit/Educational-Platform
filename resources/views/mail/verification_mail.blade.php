<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Maths-matchmaker Account</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.5;
            color: #333;
            background-color: #f0f2f5;
        }

        * {
            box-sizing: border-box;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(67, 97, 238, 0.12);
        }

        .email-header {
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
            padding: 40px 20px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .header-logo {
            display: inline-block;
            margin-bottom: 20px;
        }

        .email-title {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
            padding: 0;
        }

        .math-symbol {
            position: absolute;
            color: rgba(255, 255, 255, 0.15);
            font-size: 40px;
            font-weight: bold;
        }

        .symbol-1 {
            top: 20px;
            left: 20px;
        }

        .symbol-2 {
            bottom: 20px;
            right: 20px;
        }

        .email-content {
            padding: 40px 30px;
            text-align: center;
        }

        .welcome-text {
            font-size: 18px;
            margin-bottom: 25px;
            color: #333;
        }

        .instruction-text {
            font-size: 16px;
            margin-bottom: 30px;
            color: #666;
        }

        .verify-button {
            display: inline-block;
            background: linear-gradient(135deg, #4361ee, #3a0ca3);
            color: white;
            font-weight: 600;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.25);
        }

        .alternative-link {
            margin-bottom: 30px;
            padding: 0 10px;
        }

        .verification-link {
            color: #4361ee;
            word-break: break-all;
            font-size: 14px;
        }

        .expiration-notice {
            font-size: 14px;
            color: #888;
            margin-bottom: 25px;
        }

        .email-footer {
            background-color: #f5f8ff;
            padding: 25px 20px;
            text-align: center;
            border-top: 1px solid #e1e4e8;
        }

        .footer-text {
            font-size: 13px;
            color: #666;
            margin-bottom: 15px;
        }

        .social-links {
            margin-bottom: 15px;
        }

        .social-icon {
            display: inline-block;
            width: 32px;
            height: 32px;
            background-color: #4361ee;
            border-radius: 50%;
            color: white;
            line-height: 32px;
            font-size: 16px;
            margin: 0 5px;
            text-decoration: none;
        }

        .unsubscribe {
            font-size: 12px;
            color: #888;
        }

        .unsubscribe a {
            color: #666;
            text-decoration: underline;
        }


        .spacer-20 {
            height: 20px;
        }
    </style>
</head>

<body>
    <div style="padding: 20px;">
        <div class="email-container">
            <!-- Email Header -->
            <div class="email-header">
                <div class="math-symbol symbol-1">∑</div>
                <div class="math-symbol symbol-2">π</div>
                <div class="header-logo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24"
                        fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        <path d="M8 7h8"></path>
                        <path d="M8 12h8"></path>
                        <path d="M8 17h8"></path>
                    </svg>
                </div>
                <h1 class="email-title">Verify Your Email Address</h1>
            </div>

            <!-- Email Content -->
            <div class="email-content">
                <p class="welcome-text">Hi {{ $name }}</p>

                <p class="instruction-text">Thank you for registering with Maths-matchmaker! Please click the button
                    below to verify your email address and activate your account.</p>

                <a href="{{ $link }}">
                    <p  class="verify-button">
                        Verify My Email
                    </p>
                </a>

                <div class="alternative-link">
                    <p style="margin-bottom: 5px; color: #666;">If the button above doesn't work, please copy and paste
                        this link into your browser:</p>
                    <a href="{{ $link }}" class="verification-link">{{ $link }}</a>
                </div>

                <div class="spacer-20"></div>

                <p style="margin-bottom: 0; color: #333;">Happy problem-solving!</p>
                <p style="margin-top: 5px; font-weight: 600; color: #333;">The Maths-matchmaker Team</p>
            </div>

            <!-- Email Footer -->
            <div class="email-footer">


                <p class="unsubscribe">
                    You received this email because you signed up for Maths-matchmaker.<br>
                    If you didn't request this email, you can safely ignore it.<br>

                </p>

                <div class="spacer-20"></div>

                <p style="margin: 0; font-size: 12px; color: #888;">© 2025 Maths-matchmaker. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>

</html>
