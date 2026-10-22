<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Customer Inquiry</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f7f6f2; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #292524;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f7f6f2; padding: 40px 15px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" style="max-width: 600px; background-color: #ffffff; border-radius: 16px; border: 1px solid #e7e5e4; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05);" cellspacing="0" cellpadding="0">
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #1a2f23; padding: 32px 36px; text-align: center;">
                            <span style="font-size: 11px; letter-spacing: 0.25em; text-transform: uppercase; color: #dcb35c; font-weight: bold; display: block; margin-bottom: 6px;">珈琲・抹茶基地</span>
                            <h1 style="margin: 0; font-size: 22px; font-weight: 700; color: #ffffff; letter-spacing: -0.02em;">COFFEE BASE PHILIPPINES</h1>
                            <p style="margin: 6px 0 0; font-size: 12px; color: #d6e2d9; text-transform: uppercase; letter-spacing: 0.15em;">New Customer Inquiry Received</p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 36px 36px 28px;">
                            <p style="margin: 0 0 20px; font-size: 14px; line-height: 1.6; color: #44403c;">
                                You have received a new contact inquiry submitted through the store website:
                            </p>

                            <table role="presentation" width="100%" style="background-color: #fbfaf6; border-radius: 12px; border: 1px solid #e7e5e4; margin-bottom: 24px;" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td style="padding: 16px 20px; border-bottom: 1px solid #edebe8; width: 130px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: #78716c;">
                                        Sender Name
                                    </td>
                                    <td style="padding: 16px 20px; border-bottom: 1px solid #edebe8; font-size: 13px; font-weight: 600; color: #1c1917;">
                                        {{ $contact['name'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 16px 20px; border-bottom: 1px solid #edebe8; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: #78716c;">
                                        Email Address
                                    </td>
                                    <td style="padding: 16px 20px; border-bottom: 1px solid #edebe8; font-size: 13px; color: #1c1917;">
                                        <a href="mailto:{{ $contact['email'] }}" style="color: #274b37; text-decoration: none; font-weight: 600;">{{ $contact['email'] }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 16px 20px; border-bottom: 1px solid #edebe8; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: #78716c;">
                                        Phone Number
                                    </td>
                                    <td style="padding: 16px 20px; border-bottom: 1px solid #edebe8; font-size: 13px; color: #1c1917;">
                                        {{ !empty($contact['phone']) ? $contact['phone'] : 'Not provided' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 16px 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: #78716c;">
                                        Date &amp; Time
                                    </td>
                                    <td style="padding: 16px 20px; font-size: 13px; color: #1c1917;">
                                        {{ now()->setTimezone('Asia/Manila')->format('F d, Y - h:i A') }} (PHT)
                                    </td>
                                </tr>
                            </table>

                            <div style="margin-bottom: 24px;">
                                <span style="display: block; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; color: #78716c; margin-bottom: 8px;">Customer Message:</span>
                                <div style="background-color: #f5f5f4; border-left: 4px solid #274b37; padding: 16px 20px; border-radius: 8px; font-size: 13px; line-height: 1.7; color: #1c1917; white-space: pre-wrap;">{{ $contact['comment'] }}</div>
                            </div>

                            <div style="text-align: center; padding-top: 10px;">
                                <a href="mailto:{{ $contact['email'] }}?subject=Re:%20Inquiry%20to%20Coffee%20Base%20Philippines" style="display: inline-block; background-color: #274b37; color: #ffffff; text-decoration: none; padding: 12px 28px; border-radius: 8px; font-size: 12px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.15em;">Reply Directly to Customer</a>
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
