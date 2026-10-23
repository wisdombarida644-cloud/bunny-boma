@extends('layouts.admin')

@section('page_title', 'MC Settings')

@section('admin_content')
<h1 style="font-family:var(--serif);font-size:28px">Our MC</h1>

<div class="card" style="margin-top:20px">
  <div class="card_head"><h3>MC Details</h3></div>
  <div class="card_body">
    <form action="{{ route('admin.mc.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="grid2">
        <div class="field"><label>MC Full Name</label><input name="name" value="{{ old('name', $mc->name) }}" required></div>
        <div class="field"><label>Role / Section Eyebrow</label><input name="role" value="{{ old('role', $mc->role) }}"></div>
        <div class="field" style="grid-column:1/-1"><label>Biography</label><textarea name="bio" rows="4">{{ old('bio', $mc->bio) }}</textarea></div>
        <div class="field"><label>Instagram Link</label><input name="instagram_url" value="{{ old('instagram_url', $mc->instagram_url) }}"></div>
        <div class="field"><label>X (Twitter) Link</label><input name="x_url" value="{{ old('x_url', $mc->x_url) }}"></div>
        <div class="field"><label>Website Link</label><input name="website_url" value="{{ old('website_url', $mc->website_url) }}"></div>
        <div class="field">
          <label>Photo</label>
          <input type="file" name="image" accept="image/jpeg,image/png,image/webp">
          @if($mc->image_path)
            <img src="{{ $mc->image_path }}" alt="Current MC portrait" style="width:80px;height:100px;object-fit:cover;margin-top:8px;border-radius:4px">
          @endif
        </div>
        <div class="field" style="grid-column:1/-1">
          <label style="display:flex;align-items:center;gap:8px;letter-spacing:0;text-transform:none">
            <input type="hidden" name="is_visible" value="0">
            <input type="checkbox" name="is_visible" value="1" @checked($mc->is_visible)>
            Show MC section on the public website
          </label>
        </div>
      </div>
      <button class="btn btn_primary" type="submit" style="margin-top:16px">Save MC Details</button>
    </form>
  </div>
</div>
@endsection
