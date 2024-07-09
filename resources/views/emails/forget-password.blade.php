<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            line-height: 1.6;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
        }

        a {
            color: #0073aa;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h2>Reset Your Account Password</h2>
        <p>We have received a request to reset your password for your Jordan Insight account.</p>
        <p>If you made this request, please click the link below to reset your password:</p>
        <p><a href="{{ route('resetPasswordForm', $token) }}">Reset Password</a></p>
        <p>For security reasons, this link will expire in 24 hours. If you did not request a password reset, please
            disregard this email or contact our support team immediately at jordaninsight69@gmail.com.</p>
        <p>For your security, please ensure that your new password is unique and not used elsewhere.</p>
        <p>Best Regards,<br>Jordan Insight Support<br><a
                href="mailto:jordaninsight69@gmail.com">jordaninsight69@gmail.com</a></p>
    </div>
</body>

</html>
