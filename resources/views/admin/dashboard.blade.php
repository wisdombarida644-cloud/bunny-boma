@extends('layouts.admin')

@section('page_title', 'Dashboard Overview')

@section('admin_content')
<div style="display:flex;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:24px">
  <div>
    <h1 style="font-family:var(--serif);font-size:32px;line-height:1">Good evening, {{ $setting->partner_one }} & {{ $setting->partner_two }}</h1>
    <p style="font-size:12px;opacity:.6;margin-top:6px">Here is what is happening with your wedding website.</p>
  </div>
  <div>
    <a class="btn btn_primary" href="{{ route('admin.settings.edit') }}">Edit Wedding Settings</a>
  </div>
</div>

<div class="grid4">
  <div class="stat">
    <span class="stat_label">Wedding Countdown</span>
    <span class="stat_value" id="dashDays">— Days</span>
    <span style="font-size:11px;opacity:.6">{{ \Carbon\Carbon::parse($setting->wedding_date)->format('M j, Y') }} — {{ $setting->wedding_time }}</span>
  </div>
  <div class="stat">
    <span class="stat_label">Photos</span>
    <span class="stat_value">{{ $photoCount }}</span>
    <span style="font-size:11px;opacity:.6">Memories and gallery photos</span>
  </div>
  <div class="stat">
    <span class="stat_label">Cash Gift Account</span>
    <span class="stat_value" style="font-size:20px">{{ $cashGiftConfigured ? 'Configured' : 'Not set' }}</span>
    <span style="font-size:11px;opacity:.6">Update in wedding settings</span>
  </div>
  <div class="stat">
    <span class="stat_label">RSVPs</span>
    <span class="stat_value">{{ $rsvpCount }}</span>
    <span style="font-size:11px;opacity:.6">{{ $attendingCount }} guests confirmed</span>
  </div>
</div>

<div class="grid2" style="margin-top:20px">
  <div class="card">
    <div class="card_head"><h3>Wedding Details Summary</h3><span class="badge">Live</span></div>
    <div class="card_body">
      <div style="font-size:14px;line-height:1.8">
        <strong>Venue:</strong> {{ $setting->venue_name }}<br>
        <strong>Address:</strong> {{ $setting->address }}<br>
        @if($setting->arrival_time)<strong>Guest Arrival:</strong> {{ $setting->arrival_time }}<br>@endif
        <strong>Ceremony Start:</strong> {{ $setting->ceremony_time }}<br>
        <strong>Reception Start:</strong> {{ $setting->reception_time }}<br>
        <strong>Hashtag:</strong> {{ $setting->hashtag }}
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card_head"><h3>Recent Guestbook Entries</h3><a href="{{ route('admin.guestbook.index') }}">{{ $pendingGuestbookCount }} pending →</a></div>
    <div class="card_body">
      @foreach($recentGuestbooks as $gb)
        <div style="padding:10px 0;border-bottom:1px solid var(--line2)">
          <div style="font-style:italic;font-size:13px">"{{ $gb->message }}"</div>
          <div style="font-size:10px;letter-spacing:.14em;text-transform:uppercase;opacity:.6;margin-top:4px">— {{ $gb->name }}</div>
        </div>
      @endforeach
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", ()=>{
  const target = new Date("{{ $setting->wedding_date }}T{{ $setting->wedding_time }}:00");
  function tick(){
    const diff = target - new Date();
    if(diff<=0) return;
    const d=Math.floor(diff/86400000);
    document.getElementById("dashDays").textContent = d + " Days";
  }
  tick(); setInterval(tick, 1000);
});
</script>
@endsection
