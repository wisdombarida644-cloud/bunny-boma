<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Wedding CMS — {{ $setting->partner_one ?? 'Chiamaka Boma Ibekwe' }} & {{ $setting->partner_two ?? 'Gospel Abina-Aziba MacBenneth Isikpi' }}</title>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600&family=Bodoni+Moda:opsz,wght@6..96,500&display=swap" rel="stylesheet">
<style>
:root{--deep:#123C32;--deep2:#1B5547;--beige:#E8DDCC;--ivory:#F7F4EE;--warm:#FCFBF7;--char:#1D211E;--taupe:#A89D8C;--line:rgba(29,33,30,.12);--line2:rgba(29,33,30,.08);--serif:"Bodoni Moda",serif;--sans:"Manrope",sans-serif}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:var(--sans);background:var(--ivory);color:var(--char);display:flex;min-height:100vh}
a{color:inherit;text-decoration:none}
button{font-family:inherit;cursor:pointer;background:none;border:none}
input,textarea,select{font-family:inherit}

/* SIDEBAR */
.sidebar{width:260px;background:var(--warm);border-right:1px solid var(--line);display:flex;flex-direction:column;position:sticky;top:0;height:100vh;overflow:auto}
.sb_top{padding:24px 20px;border-bottom:1px solid var(--line);display:flex;align-items:center;gap:12px}
.sb_logo{width:36px;height:36px;background:var(--deep);color:var(--warm);display:flex;align-items:center;justify-content:center;font-family:var(--serif);font-size:16px;letter-spacing:.08em;border-radius:6px}
.sb_title{line-height:1.1}
.sb_title b{display:block;font-size:13px;letter-spacing:.02em}
.sb_title span{font-size:10px;letter-spacing:.18em;text-transform:uppercase;opacity:.6}
.sb_nav{padding:16px 12px;flex:1}
.sb_section{font-size:9px;letter-spacing:.2em;text-transform:uppercase;opacity:.5;margin:18px 8px 8px}
.sb_link{width:100%;display:flex;align-items:center;gap:10px;padding:10px 10px;border-radius:6px;font-size:13px;opacity:.8;transition:all .2s;text-align:left;color:inherit}
.sb_link:hover{background:var(--ivory);opacity:1}
.sb_link.active{background:var(--char);color:var(--warm);opacity:1}
.sb_foot{padding:16px 12px;border-top:1px solid var(--line);display:flex;flex-direction:column;gap:8px}
.btn{border:1px solid var(--line);padding:10px 14px;border-radius:6px;font-size:12px;letter-spacing:.06em;font-weight:500;transition:all .2s;display:inline-flex;align-items:center;justify-content:center;gap:8px;cursor:pointer}
.btn_primary{background:var(--deep);color:var(--warm);border-color:var(--deep)}
.btn_primary:hover{background:var(--deep2)}
.btn_danger{background:#C62828;color:white;border-color:#C62828}

/* MAIN */
.main{flex:1;min-width:0;display:flex;flex-direction:column}
.topbar{height:64px;background:var(--warm);border-bottom:1px solid var(--line);display:flex;align-items:center;justify-content:space-between;padding:0 28px;position:sticky;top:0;z-index:5}
.top_left{display:flex;align-items:center;gap:16px}
.top_title{font-size:14px;font-weight:600;letter-spacing:.02em}
.top_right{display:flex;align-items:center;gap:12px}
.avatar{width:32px;height:32px;border-radius:50%;background:var(--beige);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:600}
.content{padding:32px 28px;max-width:1240px;width:100%}
.card{background:var(--warm);border:1px solid var(--line);border-radius:8px;overflow:hidden;margin-bottom:20px}
.card_head{padding:16px 20px;border-bottom:1px solid var(--line2);display:flex;justify-content:space-between;align-items:center}
.card_head h3{font-size:13px;letter-spacing:.04em;font-weight:600}
.card_body{padding:20px}
.grid2{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.grid4{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
.stat{display:flex;flex-direction:column;gap:6px;padding:16px;border:1px solid var(--line2);border-radius:8px;background:var(--warm)}
.stat_label{font-size:9px;letter-spacing:.18em;text-transform:uppercase;opacity:.6}
.stat_value{font-family:var(--serif);font-size:28px;line-height:1}
.field{display:flex;flex-direction:column;gap:6px;margin-bottom:14px}
.field label{font-size:10px;letter-spacing:.14em;text-transform:uppercase;opacity:.7;font-weight:600}
.field input,.field textarea,.field select{border:1px solid var(--line);border-radius:6px;padding:11px 12px;font-size:13px;background:var(--warm);outline:none}
.field input[type="checkbox"]{width:16px;height:16px;padding:0;flex:none;accent-color:var(--deep)}
.field input:focus,.field textarea:focus,.field select:focus{border-color:var(--char)}
.table{width:100%;border-collapse:collapse;font-size:13px}
.table th{font-size:10px;letter-spacing:.16em;text-transform:uppercase;opacity:.6;text-align:left;padding:10px 12px;border-bottom:1px solid var(--line)}
.table td{padding:12px;border-bottom:1px solid var(--line2)}
.badge{font-size:9px;letter-spacing:.14em;text-transform:uppercase;border:1px solid var(--line);padding:4px 8px;border-radius:20px}
.alert_success{background:#E8F5E9;color:#2E7D32;border:1px solid #A5D6A7;padding:12px 16px;border-radius:6px;margin-bottom:20px;font-size:13px}
.alert_error{background:#FFEBEE;color:#9B1C1C;border:1px solid #EF9A9A;padding:12px 16px;border-radius:6px;margin-bottom:20px;font-size:13px}
@media(max-width:900px){.grid2,.grid4{grid-template-columns:1fr}}
</style>
</head>
<body>
<aside class="sidebar">
  <div class="sb_top"><div class="sb_logo">TG</div><div class="sb_title"><b>{{ $setting->partner_one ?? 'Chiamaka Boma Ibekwe' }} & {{ $setting->partner_two ?? 'Gospel Abina-Aziba MacBenneth Isikpi' }}</b><span>Wedding CMS</span></div></div>
  <nav class="sb_nav">
    <div class="sb_section">Overview</div>
    <a class="sb_link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">● Dashboard</a>
    <div class="sb_section">Content</div>
    <a class="sb_link {{ request()->routeIs('admin.settings.edit') ? 'active' : '' }}" href="{{ route('admin.settings.edit') }}">Wedding Settings</a>
    <a class="sb_link {{ request()->routeIs('admin.gallery.index') ? 'active' : '' }}" href="{{ route('admin.gallery.index') }}">Gallery Photos</a>
    <a class="sb_link {{ request()->routeIs('admin.memories.*') ? 'active' : '' }}" href="{{ route('admin.memories.index') }}">Memories</a>
    <a class="sb_link {{ request()->routeIs('admin.mc.edit') ? 'active' : '' }}" href="{{ route('admin.mc.edit') }}">Our MC</a>
    <a class="sb_link {{ request()->routeIs('admin.qa.index') ? 'active' : '' }}" href="{{ route('admin.qa.index') }}">Q&A</a>
    <a class="sb_link {{ request()->routeIs('admin.guestbook.*') ? 'active' : '' }}" href="{{ route('admin.guestbook.index') }}">Guestbook</a>
    <a class="sb_link {{ request()->routeIs('admin.rsvps.index') ? 'active' : '' }}" href="{{ route('admin.rsvps.index') }}">RSVP List</a>
  </nav>
  <div class="sb_foot">
    <a class="btn" href="{{ route('home') }}" target="_blank">Preview Website ↗</a>
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button class="btn btn_danger" style="width:100%" type="submit">Logout</button>
    </form>
  </div>
</aside>

<main class="main">
  <div class="topbar">
    <div class="top_left"><div class="top_title">@yield('page_title', 'Wedding Dashboard')</div></div>
    <div class="top_right"><div style="font-size:11px;opacity:.6">Published • {{ $setting->hashtag ?? '#THEGOSPELS26' }}</div><div class="avatar">TG</div></div>
  </div>
  <div class="content">
    @if(session('success'))
      <div class="alert_success" role="status">{{ session('success') }}</div>
    @endif

    @if($errors->any())
      <div class="alert_error" role="alert">
        <strong>Please review the following:</strong>
        <ul style="margin:8px 0 0 18px">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @yield('admin_content')
  </div>
</main>
</body>
</html>
