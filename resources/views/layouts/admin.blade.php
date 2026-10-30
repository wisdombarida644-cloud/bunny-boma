<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@include('layouts.partials.brand-icons')
<title>Wedding CMS — {{ $setting->partner_one ?? 'Chiamaka Boma Ibekwe' }} & {{ $setting->partner_two ?? 'Gospel Abina-Aziba MacBenneth Isikpi' }}</title>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600&family=Bodoni+Moda:opsz,wght@6..96,500&display=swap" rel="stylesheet">
<style>
:root{--deep:#123C32;--deep2:#1B5547;--beige:#E8DDCC;--ivory:#F7F4EE;--warm:#FCFBF7;--char:#1D211E;--taupe:#A89D8C;--line:rgba(29,33,30,.12);--line2:rgba(29,33,30,.08);--serif:"Bodoni Moda",serif;--sans:"Manrope",sans-serif}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:var(--sans);background:var(--ivory);color:var(--char);display:flex;min-height:100vh;overflow-x:hidden}
a{color:inherit;text-decoration:none}
button{font-family:inherit;cursor:pointer;background:none;border:none}
input,textarea,select{font-family:inherit}

/* SIDEBAR */
.sidebar{flex:0 0 260px;width:260px;background:var(--warm);border-right:1px solid var(--line);display:flex;flex-direction:column;position:sticky;top:0;height:100vh;overflow:auto;overscroll-behavior:contain;z-index:30}
.sb_top{padding:24px 20px;border-bottom:1px solid var(--line);display:flex;align-items:center;gap:12px}
.sb_logo{width:40px;height:40px;flex:none;border-radius:50%;overflow:hidden}
.sb_logo img{width:100%;height:100%;object-fit:cover}
.sb_title{line-height:1.1;flex:1;min-width:0}
.sb_title b{display:block;font-size:13px;letter-spacing:.02em;overflow-wrap:anywhere}
.sb_title span{font-size:10px;letter-spacing:.18em;text-transform:uppercase;opacity:.6}
.sidebar_close,.admin_menu_toggle{width:42px;height:42px;align-items:center;justify-content:center;border:1px solid var(--line);border-radius:6px;color:var(--char);flex:none}
.sidebar_close{display:none;font-size:22px;line-height:1}
.admin_menu_toggle{display:none;flex-direction:column;gap:5px}
.admin_menu_toggle span{display:block;width:18px;height:2px;background:currentColor;border-radius:2px}
.sidebar_close:focus-visible,.admin_menu_toggle:focus-visible{outline:2px solid var(--deep);outline-offset:2px}
.sb_nav{padding:16px 12px;flex:1}
.sb_section{font-size:9px;letter-spacing:.2em;text-transform:uppercase;opacity:.5;margin:18px 8px 8px}
.sb_link{width:100%;display:flex;align-items:center;gap:10px;padding:10px 10px;border-radius:6px;font-size:13px;opacity:.8;transition:all .2s;text-align:left;color:inherit}
.sb_link:hover{background:var(--ivory);opacity:1}
.sb_link.active{background:var(--char);color:var(--warm);opacity:1}
.sb_foot{padding:16px 12px;border-top:1px solid var(--line);display:flex;flex-direction:column;gap:8px}
.sidebar_backdrop{display:none}
.btn{border:1px solid var(--line);padding:10px 14px;border-radius:6px;font-size:12px;letter-spacing:.06em;font-weight:500;transition:all .2s;display:inline-flex;align-items:center;justify-content:center;gap:8px;cursor:pointer}
.btn_primary{background:var(--deep);color:var(--warm);border-color:var(--deep)}
.btn_primary:hover{background:var(--deep2)}
.btn_danger{background:#C62828;color:white;border-color:#C62828}

/* MAIN */
.main{flex:1;min-width:0;display:flex;flex-direction:column}
.topbar{height:64px;flex:0 0 64px;background:var(--warm);border-bottom:1px solid var(--line);display:flex;align-items:center;justify-content:space-between;padding:0 28px;position:sticky;top:0;z-index:15}
.top_left{display:flex;align-items:center;gap:16px;min-width:0}
.top_title{font-size:14px;font-weight:600;letter-spacing:.02em;overflow-wrap:anywhere}
.top_right{display:flex;align-items:center;gap:12px;flex:none}
.top_status{font-size:11px;opacity:.6;white-space:nowrap}
.avatar{width:32px;height:32px;border-radius:50%;background:var(--beige);display:flex;align-items:center;justify-content:center;flex:none;overflow:hidden}
.avatar img{width:100%;height:100%;object-fit:cover}
.content{padding:32px 28px;max-width:1240px;width:100%;min-width:0}
.content h1{overflow-wrap:anywhere}
.card{background:var(--warm);border:1px solid var(--line);border-radius:8px;overflow:hidden;margin-bottom:20px;min-width:0}
.card_head{padding:16px 20px;border-bottom:1px solid var(--line2);display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap}
.card_head h3{font-size:13px;letter-spacing:.04em;font-weight:600}
.card_body{padding:20px;min-width:0;overflow-x:auto}
.grid2{display:grid;grid-template-columns:1fr 1fr;gap:16px;min-width:0}
.grid4{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:16px;min-width:0}
.stat{display:flex;flex-direction:column;gap:6px;padding:16px;border:1px solid var(--line2);border-radius:8px;background:var(--warm)}
.stat_label{font-size:9px;letter-spacing:.18em;text-transform:uppercase;opacity:.6}
.stat_value{font-family:var(--serif);font-size:28px;line-height:1}
.field{display:flex;flex-direction:column;gap:6px;margin-bottom:14px;min-width:0}
.field label{font-size:10px;letter-spacing:.14em;text-transform:uppercase;opacity:.7;font-weight:600}
.field input,.field textarea,.field select{width:100%;min-width:0;max-width:100%;border:1px solid var(--line);border-radius:6px;padding:11px 12px;font-size:13px;background:var(--warm);outline:none}
.field textarea{resize:vertical;max-width:100%}
.field input[type="checkbox"]{width:16px;height:16px;padding:0;flex:none;accent-color:var(--deep)}
.field input:focus,.field textarea:focus,.field select:focus{border-color:var(--char)}
.table{width:100%;min-width:620px;border-collapse:collapse;font-size:13px}
.table th{font-size:10px;letter-spacing:.16em;text-transform:uppercase;opacity:.6;text-align:left;padding:10px 12px;border-bottom:1px solid var(--line)}
.table td{padding:12px;border-bottom:1px solid var(--line2)}
.badge{font-size:9px;letter-spacing:.14em;text-transform:uppercase;border:1px solid var(--line);padding:4px 8px;border-radius:20px}
.alert_success{background:#E8F5E9;color:#2E7D32;border:1px solid #A5D6A7;padding:12px 16px;border-radius:6px;margin-bottom:20px;font-size:13px}
.alert_error{background:#FFEBEE;color:#9B1C1C;border:1px solid #EF9A9A;padding:12px 16px;border-radius:6px;margin-bottom:20px;font-size:13px}
@media(max-width:900px){
  body{display:block}
  .sidebar{position:fixed;top:0;left:0;bottom:0;width:min(300px,86vw);height:100vh;height:100dvh;flex:none;transform:translateX(-105%);visibility:hidden;transition:transform .25s ease,visibility .25s ease;box-shadow:12px 0 36px rgba(0,0,0,.16)}
  .sidebar.open{transform:translateX(0);visibility:visible}
  .sidebar_close,.admin_menu_toggle{display:inline-flex}
  .admin_menu_toggle{flex-direction:column}
  .sidebar_backdrop{display:block;position:fixed;inset:0;z-index:20;width:100%;height:100%;background:rgba(15,20,17,.48);opacity:0;visibility:hidden;pointer-events:none;transition:opacity .25s ease,visibility .25s ease}
  body.admin_nav_open{overflow:hidden}
  body.admin_nav_open .sidebar_backdrop{opacity:1;visibility:visible;pointer-events:auto}
  .main{width:100%;min-height:100vh}
  .topbar{height:60px;flex-basis:60px;padding:0 16px;gap:12px}
  .top_left{gap:12px}
  .top_right{gap:8px}
  .grid2{grid-template-columns:minmax(0,1fr)}
  .grid4{grid-template-columns:repeat(2,minmax(0,1fr))}
  .content{padding:22px 18px}
  .card_body{padding:16px}
}
@media(max-width:560px){
  .topbar{padding:0 12px}
  .top_title{font-size:13px}
  .top_status{display:none}
  .content{padding:18px 12px}
  .content h1{font-size:24px!important;line-height:1.12!important}
  .card_head{padding:14px}
  .card_body{padding:14px}
  .grid4 .stat{padding:12px}
  .stat_value{font-size:24px}
  .field input:not([type="checkbox"]),.field textarea,.field select{font-size:16px;min-height:44px}
  .btn{min-height:42px}
}
@media(max-width:380px){.grid4{grid-template-columns:1fr}}
</style>
</head>
<body>
<aside class="sidebar" id="adminSidebar" aria-label="Admin navigation">
  <div class="sb_top"><div class="sb_logo"><img src="{{ asset('favicon.svg') }}" alt=""></div><div class="sb_title"><b>{{ $setting->partner_one ?? 'Chiamaka Boma Ibekwe' }} & {{ $setting->partner_two ?? 'Gospel Abina-Aziba MacBenneth Isikpi' }}</b><span>Wedding CMS</span></div><button class="sidebar_close" id="sidebarClose" type="button" aria-label="Close navigation">×</button></div>
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
<button class="sidebar_backdrop" id="sidebarBackdrop" type="button" aria-label="Close navigation menu" aria-hidden="true" tabindex="-1"></button>

<main class="main">
  <div class="topbar">
    <div class="top_left">
      <button class="admin_menu_toggle" id="adminMenuToggle" type="button" aria-label="Open navigation" aria-controls="adminSidebar" aria-expanded="false"><span></span><span></span><span></span></button>
      <div class="top_title">@yield('page_title', 'Wedding Dashboard')</div>
    </div>
    <div class="top_right"><div class="top_status">Published • {{ $setting->hashtag ?? '#THEGOSPELS26' }}</div><div class="avatar" aria-hidden="true"><img src="{{ asset('favicon.svg') }}" alt=""></div></div>
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
<script>
document.addEventListener("DOMContentLoaded", () => {
  const sidebar = document.getElementById("adminSidebar");
  const toggle = document.getElementById("adminMenuToggle");
  const closeButton = document.getElementById("sidebarClose");
  const backdrop = document.getElementById("sidebarBackdrop");
  const setOpen = (isOpen, restoreFocus = false) => {
    sidebar?.classList.toggle("open", isOpen);
    document.body.classList.toggle("admin_nav_open", isOpen);
    toggle?.setAttribute("aria-expanded", String(isOpen));
    toggle?.setAttribute("aria-label", isOpen ? "Close navigation" : "Open navigation");
    backdrop?.setAttribute("aria-hidden", String(!isOpen));
    if (backdrop) backdrop.tabIndex = isOpen ? 0 : -1;
    if (isOpen) closeButton?.focus();
    else if (restoreFocus) toggle?.focus();
  };

  toggle?.addEventListener("click", () => setOpen(!sidebar?.classList.contains("open")));
  closeButton?.addEventListener("click", () => setOpen(false, true));
  backdrop?.addEventListener("click", () => setOpen(false, true));
  sidebar?.querySelectorAll("a").forEach(link => link.addEventListener("click", () => setOpen(false)));
  document.addEventListener("keydown", event => {
    if (event.key === "Escape" && sidebar?.classList.contains("open")) setOpen(false, true);
  });
  window.matchMedia?.("(min-width: 901px)").addEventListener?.("change", event => {
    if (event.matches) setOpen(false);
  });
});
</script>
</body>
</html>
