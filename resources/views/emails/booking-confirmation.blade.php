<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Your free strategy call is booked</title>
  <style>
    body { margin: 0; padding: 0; background: #f4f4f5; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
    .wrap { max-width: 560px; margin: 40px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
    .header { background: #1A5C3A; padding: 32px 40px; text-align: center; }
    .header h1 { margin: 0; color: #ffffff; font-size: 22px; font-weight: 700; letter-spacing: -.3px; }
    .header p { margin: 6px 0 0; color: #a7d4ba; font-size: 14px; }
    .body { padding: 36px 40px; }
    .greeting { font-size: 16px; color: #111827; margin: 0 0 20px; }
    .detail-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px 24px; margin: 24px 0; }
    .detail-row { display: flex; gap: 12px; padding: 8px 0; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
    .detail-row:last-child { border-bottom: none; }
    .detail-label { color: #6b7280; font-weight: 600; width: 130px; flex-shrink: 0; }
    .detail-value { color: #111827; }
    .cta { text-align: center; margin: 28px 0 0; }
    .btn { display: inline-block; background: #1A5C3A; color: #ffffff; text-decoration: none; padding: 12px 28px; border-radius: 8px; font-weight: 600; font-size: 15px; }
    .note { font-size: 13px; color: #6b7280; margin-top: 24px; line-height: 1.6; }
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

    <p style="color:#374151;font-size:15px;line-height:1.7;margin:0 0 8px;">
      Thanks for requesting a free strategy call — we've got your booking and a member of the team will be in touch <strong>within one working day</strong> to confirm the details.
    </p>

    <div class="detail-box">
      <div class="detail-row">
        <span class="detail-label">Name</span>
        <span class="detail-value">{{ $booking->name }}</span>
      </div>
      @if ($booking->business_name)
      <div class="detail-row">
        <span class="detail-label">Business</span>
        <span class="detail-value">{{ $booking->business_name }}</span>
      </div>
      @endif
      <div class="detail-row">
        <span class="detail-label">Service</span>
        <span class="detail-value">{{ $booking->service }}</span>
      </div>
      @if ($booking->preferred_date)
      <div class="detail-row">
        <span class="detail-label">Preferred date</span>
        <span class="detail-value">{{ $booking->preferred_date->format('l, j F Y') }}</span>
      </div>
      @endif
      @if ($booking->preferred_time)
      <div class="detail-row">
        <span class="detail-label">Preferred time</span>
        <span class="detail-value">{{ ucfirst($booking->preferred_time) }}</span>
      </div>
      @endif
      @if ($booking->description)
      <div class="detail-row">
        <span class="detail-label">Your message</span>
        <span class="detail-value">{{ $booking->description }}</span>
      </div>
      @endif
    </div>

    <p class="note">
      If anything changes or you have questions in the meantime, reply to this email or reach us at
      <a href="mailto:{{ config('mail.from.address') }}" style="color:#1A5C3A;">{{ config('mail.from.address') }}</a>.
      No obligation, no hard sell — just an honest look at where your biggest opportunities are.
    </p>
  </div>

  <div class="footer">
    &copy; {{ date('Y') }} GrowLocally Ltd &mdash; <a href="{{ url('/') }}">growlocally.co.uk</a>
  </div>
</div>
</body>
</html>
