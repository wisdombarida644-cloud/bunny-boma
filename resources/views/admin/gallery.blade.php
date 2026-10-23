@extends('layouts.admin')

@section('page_title', 'Gallery Photo Manager')

@section('admin_content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
  <h1 style="font-family:var(--serif);font-size:28px">Gallery Photos</h1>
</div>

<div class="card">
  <div class="card_head"><h3>Upload New Photos</h3></div>
  <div class="card_body">
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="grid2">
        <div class="field">
          <label>Category</label>
          <select name="category">
            <option>Engagement</option>
            <option>Pre-Wedding</option>
            <option>Love Story</option>
            <option>Wedding</option>
            <option>Proposal</option>
            <option>Family</option>
          </select>
        </div>
        <div class="field">
          <label>Choose Photos</label>
          <input type="file" name="photos[]" multiple accept="image/*" required>
        </div>
      </div>
      <button class="btn btn_primary" type="submit">Upload Photos</button>
    </form>
  </div>
</div>

<div class="card">
  <div class="card_head"><h3>Active Photos ({{ $galleries->count() }})</h3></div>
  <div class="card_body">
    <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(220px, 1fr));gap:16px">
      @foreach($galleries as $g)
      <div style="border:1px solid var(--line);border-radius:8px;overflow:hidden;background:var(--warm)">
        <img src="{{ $g->image_path }}" style="width:100%;aspect-ratio:4/3;object-fit:cover">
        <div style="padding:12px">
          <form action="{{ route('admin.gallery.update', $g) }}" method="POST">
            @csrf @method('PUT')
            <div class="field">
              <label>Category</label>
              <input name="category" value="{{ $g->category }}" style="padding:6px 8px;font-size:12px">
            </div>
            <div class="field">
              <label>Caption</label>
              <input name="caption" value="{{ $g->caption }}" style="padding:6px 8px;font-size:12px">
            </div>
            <div class="field" style="margin-bottom:8px">
              <label style="display:flex;align-items:center;gap:8px;letter-spacing:0;text-transform:none">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" @checked($g->is_active)>
                Show on public gallery
              </label>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:10px">
              <button class="btn" type="submit" style="padding:6px 10px;font-size:11px">Save</button>
            </form>
            <form action="{{ route('admin.gallery.destroy', $g) }}" method="POST" onsubmit="return confirm('Delete photo?')">
              @csrf @method('DELETE')
              <button class="btn btn_danger" type="submit" style="padding:6px 10px;font-size:11px">Remove</button>
            </form>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
