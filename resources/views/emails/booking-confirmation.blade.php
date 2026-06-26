<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>You're booked! Your free strategy call with Grow Locally</title>
  <style>
    body { margin: 0; padding: 0; background: #f4f4f5; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
    .wrap { max-width: 560px; margin: 40px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
    .header { background: #1A5C3A; padding: 32px 40px; text-align: center; }
    .header h1 { margin: 0; color: #ffffff; font-size: 22px; font-weight: 700; letter-spacing: -.3px; }
    .header p { margin: 6px 0 0; color: #a7d4ba; font-size: 14px; }
    .body { padding: 36px 40px; }
    .greeting { font-size: 16px; color: #111827; margin: 0 0 20px; }
    .body-copy { color:#374151;font-size:15px;line-height:1.7;margin:0 0 18px; }
    .next-steps-title { color:#111827;font-size:15px;font-weight:700;margin:24px 0 10px; }
    .next-steps { color:#374151;font-size:15px;line-height:1.7;margin:0 0 22px;padding-left:20px; }
    .next-steps li { margin: 0 0 8px; }
    .footer { border-top: 1px solid #e2e8f0; padding: 20px 40px; text-align: center; font-size: 12px; color: #9ca3af; }
    .footer a { color: #1A5C3A; text-decoration: none; }
  </style>
</head>
<body>
<div class="wrap">
  <div class="header">
    <h1>GrowLocally</h1>
    <p>UK Local Digital Marketing Agency</p>
  </div>

  <div class="body">
    <p class="greeting">Hi {{ $booking->name }},</p>

    <p class="body-copy">
      Thanks for booking a free strategy call with Grow Locally. We're excited to dig into {{ $booking->business_name ?: 'your business' }}'s growth opportunities with you!
    </p>

    <p class="next-steps-title">What happens next:</p>

    <ul class="next-steps">
      <li>Our team will confirm your slot within 24 hours and send a calendar invite with the call link.</li>
      <li>We'll take a quick look at your business beforehand so the call is focused and useful, no generic pitch, just real opportunities specific to you.</li>
      <li>On the call, we'll walk through where you're losing the most potential customers and what a fix could look like.</li>
    </ul>

    <p class="body-copy">
      If you need to change your preferred time, reply to this email@if ($booking->phone) or call us at {{ $booking->phone }}@endif.
    </p>

    <p class="body-copy" style="margin-bottom:0;">
      Talk soon,<br><br>
      Grow Locally Team<br>
      <a href="{{ url('/') }}" style="color:#1A5C3A;">growlocally.co.uk</a>
    </p>
  </div>

  <div class="footer">
    &copy; {{ date('Y') }} Grow Locally Ltd - <a href="{{ url('/') }}">growlocally.co.uk</a>
  </div>
</div>
</body>
</html>
