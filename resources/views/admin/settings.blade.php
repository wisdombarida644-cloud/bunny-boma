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
    </div>
  </div>

  <div class="card">
    <div class="card_head"><h3>Date, Time & Venue</h3></div>
    <div class="card_body grid2">
      <div class="field"><label>Wedding Date</label><input type="date" name="wedding_date" value="{{ old('wedding_date', $setting->wedding_date) }}" required></div>
      <div class="field"><label>Wedding Time</label><input type="time" name="wedding_time" value="{{ old('wedding_time', $setting->wedding_time) }}" required></div>
      <div class="field"><label>Arrival Time</label><input name="arrival_time" value="{{ old('arrival_time', $setting->arrival_time) }}"></div>
      <div class="field"><label>Ceremony Time</label><input name="ceremony_time" value="{{ old('ceremony_time', $setting->ceremony_time) }}"></div>
      <div class="field"><label>Reception Time</label><input name="reception_time" value="{{ old('reception_time', $setting->reception_time) }}"></div>
      <div class="field"><label>Venue Name</label><input name="venue_name" value="{{ old('venue_name', $setting->venue_name) }}" required></div>
      <div class="field" style="grid-column:1/-1"><label>Address</label><textarea name="address" rows="2">{{ old('address', $setting->address) }}</textarea></div>
      <div class="field" style="grid-column:1/-1"><label>Google Maps Link</label><input name="maps_url" value="{{ old('maps_url', $setting->maps_url) }}"></div>
    </div>
  </div>

  <div class="card">
    <div class="card_head"><h3>Podcast & Order of Service</h3></div>
    <div class="card_body grid2">
      <div class="field"><label>Podcast YouTube Embed URL</label><input name="podcast_youtube_url" value="{{ old('podcast_youtube_url', $setting->podcast_youtube_url) }}"></div>
      <div class="field"><label>Podcast Description</label><input name="podcast_desc" value="{{ old('podcast_desc', $setting->podcast_desc) }}"></div>
      <div class="field" style="grid-column:1/-1">
        <label>Upload Order of Service (PDF)</label>
        <input type="file" name="order_pdf" accept="application/pdf">
        @if($setting->order_pdf_path)
          <div style="font-size:11px;opacity:.6;margin-top:4px">Current PDF: <a href="{{ $setting->order_pdf_path }}" target="_blank">View File</a></div>
        @endif
      </div>
    </div>
  </div>

  <button class="btn btn_primary" type="submit" style="padding:14px 28px;font-size:13px">Save Changes</button>
</form>
@endsection
