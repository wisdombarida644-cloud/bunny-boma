@extends('layouts.admin')

@section('page_title', 'Gift Registry Manager')

@section('admin_content')
<h1 style="font-family:var(--serif);font-size:28px">Gift Registry</h1>

<div class="card" style="margin-top:20px">
  <div class="card_head"><h3>Add New Gift Item</h3></div>
  <div class="card_body">
    <form action="{{ route('admin.gifts.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="grid2">
        <div class="field"><label>Item Name</label><input name="name" required placeholder="e.g. Cookware Set"></div>
        <div class="field">
          <label>Category</label>
          <select name="category">
            <option>HOME</option>
            <option>TRAVEL</option>
            <option>EXPERIENCE</option>
            <option>PERSONAL</option>
          </select>
        </div>
        <div class="field"><label>Price (Formatted)</label><input name="price" required placeholder="₦250,000"></div>
        <div class="field">
          <label>Status</label>
          <select name="status">
            <option value="AVAILABLE">AVAILABLE</option>
            <option value="FULLY GIFTED">FULLY GIFTED</option>
          </select>
        </div>
        <div class="field" style="grid-column:1/-1"><label>Description</label><textarea name="description" rows="2" placeholder="Item description..."></textarea></div>
        <div class="field" style="grid-column:1/-1"><label>Picture</label><input type="file" name="image" accept="image/*"></div>
      </div>
      <button class="btn btn_primary" type="submit">Add Gift Item</button>
    </form>
  </div>
</div>

<div class="card">
  <div class="card_head"><h3>Gift Registry Items ({{ $gifts->count() }})</h3></div>
  <div class="card_body">
    <table class="table">
      <thead>
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Category</th>
          <th>Price</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($gifts as $g)
        <tr>
          <td><img src="{{ $g->image_path }}" style="width:48px;height:36px;object-fit:cover;border-radius:4px"></td>
          <td><strong>{{ $g->name }}</strong></td>
          <td><span class="badge">{{ $g->category }}</span></td>
          <td>{{ $g->price }}</td>
          <td><span class="badge">{{ $g->status }}</span></td>
          <td>
            <form action="{{ route('admin.gifts.destroy', $g) }}" method="POST" onsubmit="return confirm('Delete this gift?')">
              @csrf @method('DELETE')
              <button class="btn btn_danger" style="padding:4px 8px;font-size:11px" type="submit">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
