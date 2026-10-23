@extends('layouts.admin')

@section('page_title', 'RSVP Submissions')

@section('admin_content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
  <h1 style="font-family:var(--serif);font-size:28px">Guest RSVPs</h1>
  <a class="btn btn_primary" href="{{ route('admin.rsvps.export') }}">Export CSV</a>
</div>

<div class="grid4" style="margin-bottom:20px">
  <div class="stat"><span class="stat_label">Total Submissions</span><span class="stat_value">{{ $rsvps->count() }}</span></div>
  <div class="stat"><span class="stat_label">Attending Guests</span><span class="stat_value">{{ $totalAttending }}</span></div>
  <div class="stat"><span class="stat_label">Declined</span><span class="stat_value">{{ $totalDeclined }}</span></div>
</div>

<div class="card">
  <div class="card_head"><h3>RSVP List</h3></div>
  <div class="card_body">
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Guests</th>
          <th>Attendance</th>
          <th>Message</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        @forelse($rsvps as $r)
        <tr>
          <td><strong>{{ $r->name }}</strong></td>
          <td>{{ $r->email }}</td>
          <td>{{ $r->phone ?? '—' }}</td>
          <td>{{ $r->guests_count }}</td>
          <td>
            <span class="badge" style="background: {{ $r->attendance === 'yes' ? '#E8F5E9' : '#FFEBEE' }}">
              {{ strtoupper($r->attendance) }}
            </span>
          </td>
          <td>{{ $r->message ?? '—' }}</td>
          <td>{{ $r->created_at->format('M j, Y H:i') }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="7" style="text-align:center;padding:24px;opacity:.6">No RSVPs submitted yet.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
