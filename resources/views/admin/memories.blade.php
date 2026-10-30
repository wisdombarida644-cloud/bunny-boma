@extends('layouts.admin')

@section('page_title', 'Memories')

@section('admin_content')
<div style="display:flex;justify-content:space-between;align-items:end;gap:16px;flex-wrap:wrap;margin-bottom:20px">
  <div>
    <h1 style="font-family:var(--serif);font-size:28px">Memories</h1>
    <p style="font-size:12px;opacity:.6;margin-top:4px">Manage the photos and captions in the public Memories carousel.</p>
  </div>
</div>

<div class="card">
  <div class="card_head"><h3>Add a memory photo</h3></div>
  <div class="card_body">
    <form action="{{ route('admin.memories.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="grid2">
        <div class="field"><label>Photo</label><input type="file" name="image" accept="image/jpeg,image/png,image/webp" required></div>
        <div class="field"><label>Title</label><input name="title" maxlength="255" placeholder="A moment to remember"></div>
        <div class="field"><label>Photo credit</label><input name="credit_name" maxlength="255" placeholder="Photographer or family"></div>
        <div class="field"><label>Display order</label><input type="number" name="sort_order" min="0" placeholder="Added last by default"></div>
        <div class="field" style="grid-column:1/-1"><label>Caption</label><textarea name="caption" rows="3" maxlength="2000" placeholder="Add a short memory or caption"></textarea></div>
      </div>
      <button class="btn btn_primary" type="submit">Add memory</button>
    </form>
  </div>
</div>

<div class="card">
  <div class="card_head"><h3>Memory photos ({{ $moments->count() }})</h3></div>
  <div class="card_body">
    @if($moments->isEmpty())
      <p style="opacity:.6">No memory photos have been added yet.</p>
    @else
      <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:18px">
        @foreach($moments as $moment)
        <article style="border:1px solid var(--line);border-radius:8px;overflow:hidden;background:var(--warm)">
          <img src="{{ $moment->image_path }}" alt="{{ $moment->title ?: 'Memory photo' }}" style="width:100%;aspect-ratio:4/3;object-fit:cover">
          <div style="padding:14px">
            <form action="{{ route('admin.memories.update', $moment) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="field"><label>Replace photo (optional)</label><input type="file" name="image" accept="image/jpeg,image/png,image/webp"></div>
              <div class="field"><label>Title</label><input name="title" value="{{ $moment->title }}" maxlength="255"></div>
              <div class="field"><label>Caption</label><textarea name="caption" rows="3" maxlength="2000">{{ $moment->caption }}</textarea></div>
              <div class="grid2">
                <div class="field"><label>Photo credit</label><input name="credit_name" value="{{ $moment->credit_name }}" maxlength="255"></div>
                <div class="field"><label>Display order</label><input type="number" name="sort_order" value="{{ $moment->sort_order }}" min="0" required></div>
              </div>
              <div class="field">
                <label style="display:flex;align-items:center;gap:8px;letter-spacing:0;text-transform:none">
                  <input type="hidden" name="is_active" value="0">
                  <input type="checkbox" name="is_active" value="1" @checked($moment->is_active)>
                  Show in the public Memories carousel
                </label>
              </div>
              <button class="btn btn_primary" type="submit">Save memory</button>
            </form>
            <form action="{{ route('admin.memories.destroy', $moment) }}" method="POST" style="margin-top:8px" onsubmit="return confirm('Delete this memory photo?')">
              @csrf
              @method('DELETE')
              <button class="btn btn_danger" type="submit">Delete photo</button>
            </form>
          </div>
        </article>
        @endforeach
      </div>
    @endif
  </div>
</div>
@endsection
