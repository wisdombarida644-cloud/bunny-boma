@extends('layouts.admin')

@section('page_title', 'RSVP Submissions')

@section('admin_content')
<div style="display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap;margin-bottom:20px">
  <div>
    <h1 style="font-family:var(--serif);font-size:28px">Guest RSVPs</h1>
    <p style="font-size:12px;opacity:.6;margin-top:4px">{{ $rsvps->count() }} submissions with the guest's name and phone number.</p>
  </div>
  <a class="btn btn_primary" href="{{ route('admin.rsvps.export') }}">Export CSV</a>
</div>

<div class="card">
  <div class="card_head"><h3>RSVP List</h3></div>
  <div class="card_body">
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Phone</th>
          <th>Date received</th>
        </tr>
      </thead>
      <tbody>
        @forelse($rsvps as $r)
        <tr>
          <td><strong>{{ $r->name }}</strong></td>
          <td>
            @if($r->phone)
              <a href="tel:{{ preg_replace('/[^0-9+]/', '', $r->phone) }}">{{ $r->phone }}</a>
            @else
              —
            @endif
          </td>
          <td>{{ $r->created_at?->format('M j, Y H:i') ?? '—' }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="3" style="text-align:center;padding:24px;opacity:.6">No RSVPs submitted yet.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
