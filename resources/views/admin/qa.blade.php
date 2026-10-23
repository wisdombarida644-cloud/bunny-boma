@extends('layouts.admin')

@section('page_title', 'Q&A Manager')

@section('admin_content')
<h1 style="font-family:var(--serif);font-size:28px">Questions & Answers</h1>

<div class="card" style="margin-top:20px">
  <div class="card_head"><h3>Add New Question</h3></div>
  <div class="card_body">
    <form action="{{ route('admin.qa.store') }}" method="POST">
      @csrf
      <div class="field"><label>Question</label><input name="question" required placeholder="e.g. Are children invited?"></div>
      <div class="field"><label>Answer</label><textarea name="answer" rows="3" required placeholder="Provide clear details..."></textarea></div>
      <button class="btn btn_primary" type="submit">Add Question</button>
    </form>
  </div>
</div>

<div class="card">
  <div class="card_head"><h3>Existing Q&A Items ({{ $qas->count() }})</h3></div>
  <div class="card_body">
    <table class="table">
      <thead>
        <tr>
          <th>Question</th>
          <th>Answer</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($qas as $q)
        <tr>
          <td><strong>{{ $q->question }}</strong></td>
          <td>{{ $q->answer }}</td>
          <td>
            <form action="{{ route('admin.qa.destroy', $q) }}" method="POST" onsubmit="return confirm('Delete this question?')">
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
