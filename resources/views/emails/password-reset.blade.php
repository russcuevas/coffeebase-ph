<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f7f6f2; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #292524;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f7f6f2; padding: 40px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" style="max-width: 600px; background-color: #ffffff; border-radius: 16px; border: 1px solid #e7e5e4; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05);" cellspacing="0" cellpadding="0">
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #1a2f23; padding: 36px 36px; text-align: center;">
                            <span style="font-size: 11px; letter-spacing: 0.25em; text-transform: uppercase; color: #dcb35c; font-weight: bold; display: block; margin-bottom: 6px;">珈琲・抹茶基地</span>
                            <h1 style="margin: 0; font-size: 22px; font-weight: 700; color: #ffffff; letter-spacing: -0.02em;">COFFEE BASE PHILIPPINES</h1>
                            <p style="margin: 6px 0 0; font-size: 12px; color: #d6e2d9; text-transform: uppercase; letter-spacing: 0.15em;">Password Reset Request</p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 36px 36px 28px;">
                            <h2 style="margin: 0 0 16px; font-size: 18px; font-weight: 700; color: #1c1917;">Hello {{ $userName ?? 'Customer' }},</h2>
                            <p style="margin: 0 0 16px; font-size: 14px; line-height: 1.7; color: #44403c;">
                                You recently requested to reset the password for your account at <strong>COFFEE BASE Philippines</strong>. Click the button below to choose a new password:
                            </p>

                            <div style="text-align: center; padding: 20px 0;">
                                <a href="{{ $resetUrl }}" style="display: inline-block; background-color: #274b37; color: #ffffff; text-decoration: none; padding: 14px 36px; border-radius: 10px; font-size: 13px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.15em; box-shadow: 0 3px 8px rgba(39, 75, 55, 0.25);">Reset Password</a>
                            </div>

                            <p style="margin: 0 0 12px; font-size: 12px; line-height: 1.6; color: #78716c;">
                                This password reset link will expire in <strong>60 minutes</strong>.
                            </p>
                            <p style="margin: 0 0 20px; font-size: 12px; line-height: 1.6; color: #78716c;">
                                If you did not request a password reset, please ignore this email or contact support if you have concerns. Your password will remain unchanged.
                            </p>

                            <div style="border-top: 1px solid #edebe8; padding-top: 20px; margin-top: 24px;">
                                <p style="margin: 0; font-size: 11px; color: #a8a29e; word-break: break-all;">
                                    If the button doesn't work, copy and paste this URL into your browser:<br>
                                    <a href="{{ $resetUrl }}" style="color: #274b37;">{{ $resetUrl }}</a>
                                </p>
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f5f5f4; border-top: 1px solid #e7e5e4; padding: 20px 36px; text-align: center; font-size: 11px; color: #a8a29e;">
                            &copy; {{ date('Y') }} COFFEE BASE Philippines &bull; Authentic Japanese Matcha &bull; <a href="https://coffeebaseph.com" style="color: #78716c; text-decoration: none;">coffeebaseph.com</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
