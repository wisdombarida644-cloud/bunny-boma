@extends('layouts.admin')

@section('page_title', 'Wedding Settings')

@section('admin_content')
<h1 style="font-family:var(--serif);font-size:28px">Wedding Settings</h1>
<p style="font-size:12px;opacity:.6;margin-top:4px">Configure core wedding details. This directly updates the live homepage.</p>

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="card" style="margin-top:20px">
    <div class="card_head"><h3>Couple & Hashtag</h3></div>
    <div class="card_body grid2">
      <div class="field"><label>Partner One</label><input name="partner_one" value="{{ old('partner_one', $setting->partner_one) }}" required></div>
      <div class="field"><label>Partner Two</label><input name="partner_two" value="{{ old('partner_two', $setting->partner_two) }}" required></div>
      <div class="field"><label>Hashtag</label><input name="hashtag" value="{{ old('hashtag', $setting->hashtag) }}" required></div>
      <div class="field"><label>City</label><input name="city" value="{{ old('city', $setting->city) }}"></div>
      <div class="field"><label>Family One</label><input name="family_one" value="{{ old('family_one', $setting->family_one) }}" maxlength="255" required></div>
      <div class="field"><label>Family Two</label><input name="family_two" value="{{ old('family_two', $setting->family_two) }}" maxlength="255" required></div>
    </div>
  </div>

  <div class="card">
    <div class="card_head"><h3>Date, Time & Venue</h3></div>
    <div class="card_body grid2">
      <div class="field"><label>Wedding Date</label><input type="date" name="wedding_date" value="{{ old('wedding_date', $setting->wedding_date) }}" required></div>
      <div class="field"><label>Wedding Time</label><input type="time" name="wedding_time" value="{{ old('wedding_time', $setting->wedding_time) }}" required></div>
      <div class="field"><label>Timezone (IANA)</label><input name="timezone" value="{{ old('timezone', $setting->timezone ?? 'Africa/Lagos') }}" placeholder="Africa/Lagos" required></div>
      <div class="field"><label>Guest Arrival Time (optional, if different)</label><input name="arrival_time" value="{{ old('arrival_time', $setting->arrival_time) }}"></div>
      <div class="field"><label>Ceremony Time</label><input name="ceremony_time" value="{{ old('ceremony_time', $setting->ceremony_time) }}"></div>
      <div class="field"><label>Reception Time</label><input name="reception_time" value="{{ old('reception_time', $setting->reception_time) }}"></div>
      <div class="field"><label>Venue Name</label><input name="venue_name" value="{{ old('venue_name', $setting->venue_name) }}" required></div>
      <div class="field" style="grid-column:1/-1"><label>Address</label><textarea name="address" rows="2">{{ old('address', $setting->address) }}</textarea></div>
      <div class="field" style="grid-column:1/-1"><label>Google Maps Link</label><input name="maps_url" value="{{ old('maps_url', $setting->maps_url) }}"></div>
      <div class="field"><label>RSVP Deadline</label><input type="date" name="rsvp_deadline" value="{{ old('rsvp_deadline', $setting->rsvp_deadline?->format('Y-m-d') ?? $setting->rsvp_deadline) }}" required></div>
      <div class="field"><label>WhatsApp RSVP Number</label><input type="tel" name="whatsapp_phone" value="{{ old('whatsapp_phone', $setting->whatsapp_phone) }}" maxlength="50" placeholder="08123456789" required></div>
    </div>
  </div>

  <div class="card">
    <div class="card_head"><h3>Podcast, Background Music & Order of Service</h3></div>
    <div class="card_body grid2">
      <div class="field"><label>Podcast YouTube Embed URL</label><input name="podcast_youtube_url" value="{{ old('podcast_youtube_url', $setting->podcast_youtube_url) }}" placeholder="https://www.youtube.com/embed/VIDEO_ID"></div>
      <div class="field"><label>Podcast Description</label><input name="podcast_desc" value="{{ old('podcast_desc', $setting->podcast_desc) }}"></div>
      <div class="field" style="grid-column:1/-1">
        <label>Background Music (MP3, WAV, OGG, M4A or AAC; max 20 MB)</label>
        <input type="file" name="background_music_file" accept="audio/mpeg,audio/wav,audio/ogg,audio/mp4,audio/aac,.mp3,.wav,.ogg,.m4a,.aac">
        @if($setting->background_music_path)
          <div style="font-size:11px;opacity:.7;margin-top:6px">Current track: <a href="{{ $setting->background_music_path }}" target="_blank" rel="noopener">Open audio file</a></div>
          <audio controls preload="metadata" src="{{ $setting->background_music_path }}" style="display:block;width:min(100%,480px);margin-top:10px">Your browser cannot preview this audio file.</audio>
          <label style="display:flex;align-items:center;gap:8px;margin-top:10px;text-transform:none;letter-spacing:0"><input type="checkbox" name="remove_background_music" value="1"> Remove current background music</label>
        @endif
      </div>
      <div class="field" style="grid-column:1/-1">
        <label style="display:flex;align-items:center;gap:8px;text-transform:none;letter-spacing:0"><input type="checkbox" name="background_music_enabled" value="1" @checked(old('background_music_enabled', $setting->background_music_enabled))> Enable best-effort background music autoplay on the public site</label>
        <small style="opacity:.65">Browsers may block automatic playback. Visitors will have a visible play/pause control.</small>
      </div>
      <div class="field" style="grid-column:1/-1">
        <label>Upload Order of Service (PDF)</label>
        <input type="file" name="order_pdf" accept="application/pdf">
        @if($setting->order_pdf_path)
          <div style="font-size:11px;opacity:.6;margin-top:4px">Current PDF: <a href="{{ $setting->order_pdf_path }}" target="_blank" rel="noopener">View File</a></div>
        @endif
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card_head"><h3>Cash Gift Bank Transfer Details</h3></div>
    <div class="card_body grid2">
      <div class="field"><label>Bank Name</label><input name="bank_name" value="{{ old('bank_name', $setting->bank_name) }}" maxlength="255"></div>
      <div class="field"><label>Account Name</label><input name="account_name" value="{{ old('account_name', $setting->account_name) }}" maxlength="255"></div>
      <div class="field"><label>Account Number</label><input name="account_number" value="{{ old('account_number', $setting->account_number) }}" maxlength="64" inputmode="numeric" autocomplete="off"></div>
      <div class="field" style="grid-column:1/-1"><label>Cash Gift Note (optional)</label><textarea name="cash_gift_note" rows="3" maxlength="2000">{{ old('cash_gift_note', $setting->cash_gift_note) }}</textarea></div>
      <p style="grid-column:1/-1;font-size:11px;opacity:.65">These details are shown publicly on the wedding website. Add or update them here; the site does not process or verify transfers.</p>
    </div>
  </div>

  <button class="btn btn_primary" type="submit" style="padding:14px 28px;font-size:13px">Save Changes</button>
</form>
@endsection
