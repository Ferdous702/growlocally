<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>New Booking — {{ $booking->name }}</title>
  <style>
    body { margin: 0; padding: 0; background: #f4f4f5; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
    .wrap { max-width: 560px; margin: 40px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
    .header { background: #0f172a; padding: 28px 40px; }
    .header h1 { margin: 0; color: #ffffff; font-size: 18px; font-weight: 700; }
    .header p { margin: 4px 0 0; color: #94a3b8; font-size: 13px; }
    .badge { display: inline-block; background: #dcfce7; color: #166534; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; padding: 3px 10px; border-radius: 9999px; margin-top: 10px; }
    .body { padding: 32px 40px; }
    .detail-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px 24px; margin: 20px 0; }
    .detail-row { display: flex; gap: 12px; padding: 8px 0; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
    .detail-row:last-child { border-bottom: none; }
    .detail-label { color: #6b7280; font-weight: 600; width: 140px; flex-shrink: 0; }
    .detail-value { color: #111827; }
    .actions { margin-top: 24px; display: flex; gap: 12px; }
    .btn { display: inline-block; text-decoration: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 14px; }
    .btn-primary { background: #0f172a; color: #ffffff; }
    .btn-secondary { background: #f1f5f9; color: #334155; border: 1px solid #e2e8f0; }
    .footer { border-top: 1px solid #e2e8f0; padding: 20px 40px; text-align: center; font-size: 12px; color: #9ca3af; }
  </style>
</head>
<body>
<div class="wrap">
  <div class="header">
    <h1>New Booking Request</h1>
    <p>Received {{ $booking->created_at->format('j F Y \a\t g:i A') }}</p>
    <div class="badge">Action required</div>
  </div>

  <div class="body">
    <p style="color:#374151;font-size:15px;margin:0 0 4px;">
      A new free strategy call has been requested. Here are the details:
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
        <span class="detail-label">Email</span>
        <span class="detail-value"><a href="mailto:{{ $booking->email }}" style="color:#1A5C3A;">{{ $booking->email }}</a></span>
      </div>
      @if ($booking->phone)
      <div class="detail-row">
        <span class="detail-label">Phone</span>
        <span class="detail-value">{{ $booking->phone }}</span>
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
        <span class="detail-label">Message</span>
        <span class="detail-value">{{ $booking->description }}</span>
      </div>
      @endif
    </div>

    <div class="actions">
      <a href="{{ route('admin.bookings') }}" class="btn btn-primary">View in Admin Panel</a>
      <a href="mailto:{{ $booking->email }}" class="btn btn-secondary">Reply to {{ $booking->name }}</a>
    </div>
  </div>

  <div class="footer">
    GrowLocally Admin — automated booking notification
  </div>
</div>
</body>
</html>
