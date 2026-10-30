@extends('layouts.admin')

@section('page_title', 'Gallery Photo Manager')

@section('admin_content')
<div style="display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap;margin-bottom:20px">
  <div>
    <h1 style="font-family:var(--serif);font-size:28px">Gallery Photos</h1>
    <p style="font-size:12px;opacity:.65;margin-top:6px">The first active photo anchors the center portrait; up to two active photos frame the desktop hero. Mobile shows one photo at a time, and the full active set appears in the photo journal.</p>
  </div>
</div>

<div class="card">
  <div class="card_head"><h3>Upload New Photos</h3></div>
  <div class="card_body">
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" data-gallery-upload-form>
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
          <input type="file" name="photos[]" multiple accept="image/*" required data-gallery-upload-files>
          <small>The browser saves a maximum 1920-pixel WebP version when it is smaller than the original.</small>
        </div>
      </div>
      <button class="btn btn_primary" type="submit">Upload Photos</button>
      <p data-gallery-upload-status role="status" aria-live="polite" style="margin-top:10px;font-size:12px"></p>
    </form>
  </div>
</div>

<div class="card">
  <div class="card_head">
    <h3>Gallery Photos ({{ $galleries->count() }})</h3>
    <button class="btn" type="button" data-optimize-gallery-photos>Optimize existing photos</button>
  </div>
  <div class="card_body">
    <p style="font-size:12px;opacity:.7;margin-bottom:12px">One-time cleanup for older large uploads. Original files are left untouched in storage.</p>
    <p data-gallery-optimization-status role="status" aria-live="polite" style="margin-bottom:14px;font-size:12px"></p>
    <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(220px, 1fr));gap:16px">
      @foreach($galleries as $g)
      <div style="border:1px solid var(--line);border-radius:8px;overflow:hidden;background:var(--warm)" @if((str_starts_with((string) $g->image_path, '/media/gallery/') || str_starts_with((string) $g->image_path, '/storage/gallery/')) && !str_contains((string) $g->image_path, '/optimized/')) data-gallery-optimize-url="{{ route('admin.gallery.optimize', $g) }}" @endif>
        <img src="{{ $g->image_path }}" alt="{{ $g->caption ?: 'Uploaded gallery photo' }}" loading="lazy" decoding="async" data-gallery-photo-image style="width:100%;aspect-ratio:4/3;object-fit:cover">
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

<script>
(() => {
  const form = document.querySelector('[data-gallery-upload-form]');
  const input = form?.querySelector('[data-gallery-upload-files]');
  const status = form?.querySelector('[data-gallery-upload-status]');
  const submit = form?.querySelector('button[type="submit"]');
  if (!form || !input || typeof window.createImageBitmap !== 'function' || typeof DataTransfer === 'undefined') return;

  const resizeAndCompress = async file => {
    if (!file.type.startsWith('image/')) return file;
    const bitmap = await window.createImageBitmap(file);
    const scale = Math.min(1, 1920 / Math.max(bitmap.width, bitmap.height));
    const width = Math.max(1, Math.round(bitmap.width * scale));
    const height = Math.max(1, Math.round(bitmap.height * scale));
    const canvas = document.createElement('canvas');
    canvas.width = width;
    canvas.height = height;
    const context = canvas.getContext('2d');
    if (!context) {
      bitmap.close?.();
      return file;
    }
    context.drawImage(bitmap, 0, 0, width, height);
    bitmap.close?.();
    const blob = await new Promise(resolve => canvas.toBlob(resolve, 'image/webp', .82));
    if (!blob || blob.size >= file.size) return file;
    const basename = file.name.replace(/\.[^.]+$/, '');
    return new File([blob], `${basename}.webp`, { type: 'image/webp', lastModified: file.lastModified });
  };

  form.addEventListener('submit', async event => {
    if (form.dataset.imagesPrepared === 'true' || !input.files?.length) return;
    event.preventDefault();
    if (submit) submit.disabled = true;
    if (status) status.textContent = 'Optimizing photos for faster loading…';

    try {
      const files = Array.from(input.files);
      const optimizedFiles = new DataTransfer();
      for (const file of files) optimizedFiles.items.add(await resizeAndCompress(file));
      input.files = optimizedFiles.files;
      if (status) status.textContent = 'Uploading optimized photos…';
    } catch (_) {
      if (status) status.textContent = 'Using the original photos for this upload…';
    }

    form.dataset.imagesPrepared = 'true';
    if (submit) submit.disabled = false;
    if (typeof form.requestSubmit === 'function') {
      submit ? form.requestSubmit(submit) : form.requestSubmit();
    } else {
      form.submit();
    }
  });
})();

(() => {
  const button = document.querySelector('[data-optimize-gallery-photos]');
  const status = document.querySelector('[data-gallery-optimization-status]');
  const token = document.querySelector('[data-gallery-upload-form] input[name="_token"]')?.value;
  if (!button || !status) return;

  const photos = Array.from(document.querySelectorAll('[data-gallery-optimize-url]'));
  if (!photos.length) {
    button.disabled = true;
    status.textContent = 'No older server-hosted photos need optimization.';
    return;
  }
  if (!token || typeof window.createImageBitmap !== 'function') {
    button.disabled = true;
    status.textContent = 'This browser cannot optimize the existing photos. Try a recent version of Chrome, Edge, Firefox, or Safari.';
    return;
  }

  const optimizePhoto = async row => {
    const image = row.querySelector('[data-gallery-photo-image]');
    const sourceResponse = await fetch(image.currentSrc || image.src, { credentials: 'same-origin' });
    if (!sourceResponse.ok) throw new Error('Could not read the original photo.');
    const sourceBlob = await sourceResponse.blob();
    const bitmap = await window.createImageBitmap(sourceBlob);
    const scale = Math.min(1, 1920 / Math.max(bitmap.width, bitmap.height));
    const width = Math.max(1, Math.round(bitmap.width * scale));
    const height = Math.max(1, Math.round(bitmap.height * scale));
    const canvas = document.createElement('canvas');
    canvas.width = width;
    canvas.height = height;
    const context = canvas.getContext('2d');
    if (!context) {
      bitmap.close?.();
      throw new Error('Could not prepare the photo.');
    }
    context.drawImage(bitmap, 0, 0, width, height);
    bitmap.close?.();
    const optimizedBlob = await new Promise(resolve => canvas.toBlob(resolve, 'image/webp', .82));
    if (!optimizedBlob || optimizedBlob.type !== 'image/webp' || optimizedBlob.size >= sourceBlob.size) {
      row.removeAttribute('data-gallery-optimize-url');
      return false;
    }

    const payload = new FormData();
    payload.append('image', new File([optimizedBlob], `gallery-${Date.now()}.webp`, { type: 'image/webp' }));
    const uploadResponse = await fetch(row.dataset.galleryOptimizeUrl, {
      method: 'POST',
      credentials: 'same-origin',
      headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json' },
      body: payload,
    });
    const result = await uploadResponse.json().catch(() => ({}));
    if (!uploadResponse.ok || !result.image_path) throw new Error(result.message || 'The optimized photo could not be saved.');

    image.src = result.image_path;
    image.removeAttribute('srcset');
    row.removeAttribute('data-gallery-optimize-url');
    return true;
  };

  button.addEventListener('click', async () => {
    const pendingPhotos = Array.from(document.querySelectorAll('[data-gallery-optimize-url]'));
    if (!pendingPhotos.length) {
      button.disabled = true;
      status.textContent = 'No older server-hosted photos need optimization.';
      return;
    }

    button.disabled = true;
    const originalLabel = button.textContent;
    button.textContent = 'Optimizing…';
    let optimized = 0;
    let skipped = 0;
    let failed = 0;

    for (let index = 0; index < pendingPhotos.length; index++) {
      status.textContent = `Optimizing photo ${index + 1} of ${pendingPhotos.length}…`;
      try {
        if (await optimizePhoto(pendingPhotos[index])) optimized++;
        else skipped++;
      } catch (error) {
        failed++;
        console.error('Photo optimization failed:', error);
      }
    }

    button.textContent = originalLabel;
    button.disabled = !document.querySelector('[data-gallery-optimize-url]');
    status.textContent = `Finished: ${optimized} optimized, ${skipped} already small, ${failed} failed. Source files were not deleted.`;
  });
})();
</script>
@endsection
