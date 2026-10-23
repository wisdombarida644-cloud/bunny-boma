<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login — With the Gospels</title>
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:wght@500&family=Manrope:wght@300;400;500&display=swap" rel="stylesheet">
<style>
:root{--deep:#123C32;--warm:#FCFBF7;--char:#1D211E;--line:rgba(29,33,30,.12);--serif:"Bodoni Moda",serif;--sans:"Manrope",sans-serif}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:var(--sans);background:var(--warm);color:var(--char);display:flex;align-items:center;justify-content:center;min-height:100vh;padding:24px}
.login_box{width:100%;max-width:400px;background:var(--warm);border:1px solid var(--line);padding:40px;border-radius:12px;box-shadow:0 16px 48px rgba(0,0,0,.06)}
.logo{font-family:var(--serif);font-size:36px;text-align:center;margin-bottom:8px}
.sub{text-align:center;font-size:11px;letter-spacing:.18em;text-transform:uppercase;opacity:.6;margin-bottom:32px}
.field{display:flex;flex-direction:column;gap:6px;margin-bottom:20px}
.field label{font-size:10px;letter-spacing:.14em;text-transform:uppercase;opacity:.7}
.field input{border:1px solid var(--line);border-radius:6px;padding:12px;font-size:14px;outline:none}
.btn_submit{width:100%;background:var(--deep);color:white;border:none;padding:14px;border-radius:6px;font-size:11px;letter-spacing:.2em;text-transform:uppercase;cursor:pointer;margin-top:12px}
.error{color:#C62828;font-size:12px;margin-bottom:16px;text-align:center}
</style>
</head>
<body>
<div class="login_box">
  <div class="logo">THE GOSPELS</div>
  <div class="sub">Wedding CMS Login</div>

  @if($errors->any())
    <div class="error">{{ $errors->first() }}</div>
  @endif

  <form action="{{ route('login') }}" method="POST">
    @csrf
    <div class="field">
      <label>Email Address</label>
      <input type="email" name="email" required autocomplete="username" value="{{ old('email') }}">
    </div>
    <div class="field">
      <label>Password</label>
      <input type="password" name="password" required autocomplete="current-password">
    </div>
    <button class="btn_submit" type="submit">Sign In</button>
  </form>
</div>
</body>
</html>
