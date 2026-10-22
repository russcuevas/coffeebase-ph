<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We have received your message</title>
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
                            <p style="margin: 6px 0 0; font-size: 12px; color: #d6e2d9; text-transform: uppercase; letter-spacing: 0.15em;">Thank You for Contacting Us</p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 36px 36px 28px;">
                            <h2 style="margin: 0 0 16px; font-size: 18px; font-weight: 700; color: #1c1917;">Arigatou gozaimasu, {{ $contact['name'] }}!</h2>
                            <p style="margin: 0 0 20px; font-size: 14px; line-height: 1.7; color: #44403c;">
                                We have received your inquiry. Our matcha team is reviewing your message and will respond directly to this email (<strong style="color: #1c1917;">{{ $contact['email'] }}</strong>) as soon as possible.
                            </p>

                            <div style="background-color: #fbfaf6; border-radius: 12px; border: 1px solid #e7e5e4; padding: 20px; margin-bottom: 24px;">
                                <span style="display: block; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; color: #78716c; margin-bottom: 8px;">A copy of your message:</span>
                                <div style="font-size: 13px; line-height: 1.6; color: #292524; font-style: italic; white-space: pre-wrap;">"{{ $contact['comment'] }}"</div>
                            </div>

                            <p style="margin: 0 0 24px; font-size: 13px; line-height: 1.6; color: #57534e;">
                                If you have urgent questions regarding existing orders or wholesale partner accounts, you may also connect directly with us through our official social media channels:
                            </p>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-bottom: 12px;">
                                <tr>
                                    <td align="center">
                                        <a href="https://www.facebook.com/coffeebasephilippines" target="_blank" style="display: inline-block; background-color: #1a2f23; color: #ffffff; text-decoration: none; padding: 10px 20px; border-radius: 8px; font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.15em; margin-right: 8px;">Facebook</a>
                                        <a href="https://www.instagram.com/coffeebase.ph" target="_blank" style="display: inline-block; background-color: #1a2f23; color: #ffffff; text-decoration: none; padding: 10px 20px; border-radius: 8px; font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.15em;">Instagram</a>
                                    </td>
                                </tr>
                            </table>
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
