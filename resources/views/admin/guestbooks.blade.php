@extends('layouts.admin')

@section('page_title', 'Guestbook Moderation')

@section('admin_content')
<div style="display:flex;justify-content:space-between;align-items:end;gap:16px;flex-wrap:wrap;margin-bottom:20px">
  <div>
    <h1 style="font-family:var(--serif);font-size:28px">Guestbook</h1>
    <p style="font-size:12px;opacity:.6;margin-top:4px">{{ $pendingCount }} note{{ $pendingCount === 1 ? '' : 's' }} awaiting approval.</p>
  </div>
</div>

<div class="card">
  <div class="card_body" style="overflow-x:auto">
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Message</th>
          <th>Status</th>
          <th>Received</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($guestbooks as $entry)
        <tr>
          <td>{{ $entry->name }}</td>
          <td style="min-width:240px;max-width:480px;white-space:normal">{{ $entry->message }}</td>
          <td><span class="badge">{{ $entry->is_approved ? 'Published' : 'Pending' }}</span></td>
          <td>{{ $entry->created_at->format('M j, Y H:i') }}</td>
          <td style="white-space:nowrap">
            <form action="{{ route('admin.guestbook.update', $entry) }}" method="POST" style="display:inline">
              @csrf
              @method('PATCH')
              <input type="hidden" name="is_approved" value="{{ $entry->is_approved ? '0' : '1' }}">
              <button class="btn" type="submit" style="padding:6px 10px;font-size:11px">{{ $entry->is_approved ? 'Hide' : 'Approve' }}</button>
            </form>
            <form action="{{ route('admin.guestbook.destroy', $entry) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this note permanently?')">
              @csrf
              @method('DELETE')
              <button class="btn btn_danger" type="submit" style="padding:6px 10px;font-size:11px">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center;padding:24px;opacity:.6">No guestbook notes yet.</td></tr>
        @endforelse
      </tbody>
    </table>
    <div style="margin-top:16px">{{ $guestbooks->links() }}</div>
  </div>
</div>
@endsection
