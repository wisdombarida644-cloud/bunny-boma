<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@include('layouts.partials.brand-icons')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
try {
  if (localStorage.getItem('the-gospels-theme') === 'dark') {
    document.documentElement.setAttribute('data-theme', 'dark');
  }
} catch (_) {}
</script>
<title>{{ $setting->partner_one ?? 'Chiamaka Boma Ibekwe' }} & {{ $setting->partner_two ?? 'Gospel Abina-Aziba MacBenneth Isikpi' }} | {{ $setting->hashtag ?? '#THEGOSPELS26' }}</title>
<meta name="description" content="{{ $setting->partner_one ?? 'Chiamaka Boma Ibekwe' }} and {{ $setting->partner_two ?? 'Gospel Abina-Aziba MacBenneth Isikpi' }} celebrate on {{ \Carbon\Carbon::parse($setting->wedding_date ?? '2026-11-21')->format('F j, Y') }} at {{ $setting->venue_name ?? 'ATWIL EVENT CENTER' }}, {{ $setting->city ?? 'Port Harcourt, Rivers State' }}. {{ $setting->hashtag ?? '#THEGOSPELS26' }}">
<meta property="og:title" content="{{ $setting->partner_one ?? 'Chiamaka Boma Ibekwe' }} & {{ $setting->partner_two ?? 'Gospel Abina-Aziba MacBenneth Isikpi' }} | {{ $setting->hashtag ?? '#THEGOSPELS26' }}">
<meta property="og:description" content="{{ \Carbon\Carbon::parse($setting->wedding_date ?? '2026-11-21')->format('l, F j, Y') }} at {{ $setting->ceremony_time ?? '11:00 AM' }} prompt. {{ $setting->venue_name ?? 'ATWIL EVENT CENTER' }}, {{ $setting->address ?? 'Akpajo' }}, {{ $setting->city ?? 'Port Harcourt, Rivers State' }}.">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ rtrim(config('app.url'), '/') }}">
<meta property="og:image" content="{{ $ogImageUrl ?? asset('images/og-wedding-couple.jpg') }}">
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{{ ($setting->partner_one ?? 'The couple').' and '.($setting->partner_two ?? '') }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="{{ $ogImageUrl ?? asset('images/og-wedding-couple.jpg') }}">
<link rel="canonical" href="{{ rtrim(config('app.url'), '/') }}">

<link rel="preload" href="{{ asset('fonts/alex-brush-400.woff2') }}" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="{{ asset('fonts/alice-400.woff2') }}" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="{{ asset('fonts/fahkwang-400.woff2') }}" as="font" type="font/woff2" crossorigin>

<style>
@font-face{font-family:"Alex Brush";src:url("{{ asset('fonts/alex-brush-400.woff2') }}") format("woff2");font-style:normal;font-weight:400;font-display:swap}
@font-face{font-family:"Alice";src:url("{{ asset('fonts/alice-400.woff2') }}") format("woff2");font-style:normal;font-weight:400;font-display:swap}
@font-face{font-family:"Catchy Mager";src:url("{{ asset('fonts/catchy-mager-subset.ttf') }}") format("truetype");font-style:normal;font-weight:400;font-display:swap}
@font-face{font-family:"Fahkwang";src:url("{{ asset('fonts/fahkwang-300.woff2') }}") format("woff2");font-style:normal;font-weight:300;font-display:swap}
@font-face{font-family:"Fahkwang";src:url("{{ asset('fonts/fahkwang-400.woff2') }}") format("woff2");font-style:normal;font-weight:400;font-display:swap}
@font-face{font-family:"Fahkwang";src:url("{{ asset('fonts/fahkwang-500.woff2') }}") format("woff2");font-style:normal;font-weight:500;font-display:swap}
@font-face{font-family:"Fahkwang";src:url("{{ asset('fonts/fahkwang-600.woff2') }}") format("woff2");font-style:normal;font-weight:600;font-display:swap}
@font-face{font-family:"Fahkwang";src:url("{{ asset('fonts/fahkwang-700.woff2') }}") format("woff2");font-style:normal;font-weight:700;font-display:swap}

:root{
--deep:#1B4033;
--deep2:#557562;
--beige:#E5D9C4;
--ivory:#F1EBDD;
--warm:#FAF7F0;
--char:#2B3E32;
--taupe:#7C8C7D;
--champ:#C59A4E;
--line:rgba(43,62,50,.14);
--line2:rgba(43,62,50,.08);
--serif:"Alice", Georgia, serif;
--serif2:"Catchy Mager", "Alice", Georgia, serif;
--script:"Alex Brush", cursive;
--sans:"Fahkwang", sans-serif;
--ease:cubic-bezier(.25,.1,.25,1);
--ease2:cubic-bezier(.77,0,.175,1);
color-scheme:light;
}
:root[data-theme="dark"]{
  color-scheme:dark;
  --warm:#141A16;
  --char:#F5F1E8;
  --taupe:#BDB4A6;
  --line:rgba(247,244,238,.18);
  --line2:rgba(247,244,238,.1);
}
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth;scroll-padding-top:84px}
body{background:var(--warm);color:var(--char);font-family:var(--sans);font-weight:300;line-height:1.7;-webkit-font-smoothing:antialiased;overflow-x:hidden}
body.menu-open{overflow:hidden}
img{display:block;max-width:100%}
a{color:inherit;text-decoration:none}
button{font-family:inherit;background:none;border:none;cursor:pointer}
::selection{background:var(--deep);color:var(--ivory)}

/* NAV */
.nav{position:fixed;inset:0 0 auto 0;height:72px;display:flex;align-items:center;justify-content:space-between;padding:0 32px;z-index:50;color:var(--char);transition:background .6s var(--ease), border-color .6s var(--ease),color .3s ease}
.nav:not(.scrolled){color:var(--char);text-shadow:none}
.nav.scrolled{background:rgba(252,251,247,.97);backdrop-filter:blur(16px);border-bottom:1px solid var(--line);text-shadow:none}
.nav:not(.scrolled) .nav_links a:after{background:var(--char)}
.nav_logo{width:42px;height:42px;flex:none;display:inline-flex;align-items:center;justify-content:center;overflow:hidden;border-radius:50%}
.nav_logo img{width:100%;height:100%;object-fit:cover;border-radius:50%}
.nav_links{display:flex;gap:32px;align-items:center}
.nav_links a{font-size:10px;letter-spacing:.18em;text-transform:uppercase;font-weight:500;opacity:.85;position:relative;padding:4px 0}
.nav_links a:after{content:"";position:absolute;left:0;bottom:0;width:0;height:1px;background:var(--char);transition:width .4s var(--ease)}
.nav_links a:hover:after{width:100%}
.nav_right{display:flex;gap:14px;align-items:center}
.theme_toggle{width:40px;height:40px;display:inline-flex;align-items:center;justify-content:center;border:1px solid var(--line);border-radius:50%;color:currentColor;transition:background .25s ease,color .25s ease,border-color .25s ease}
.theme_toggle:hover{background:var(--deep);color:var(--ivory);border-color:var(--deep)}
.theme_toggle:focus-visible{outline:2px solid var(--champ);outline-offset:3px}
.theme_toggle svg{width:18px;height:18px;fill:none;stroke:currentColor;stroke-width:1.6;stroke-linecap:round;stroke-linejoin:round}
.theme_toggle .theme_icon_sun{display:none}
:root[data-theme="dark"] .theme_toggle .theme_icon_sun{display:block}
:root[data-theme="dark"] .theme_toggle .theme_icon_moon{display:none}
.nav_cta{font-size:10px;letter-spacing:.18em;text-transform:uppercase;border:1px solid var(--line);padding:10px 18px;transition:all .4s}
.nav:not(.scrolled) .nav_cta{border-color:var(--line);color:var(--char)}
.nav_cta:hover{background:var(--char);color:var(--warm);border-color:var(--char)}
.nav_burger{display:none;width:44px;height:44px;align-items:center;flex-direction:column;justify-content:center;gap:5px;cursor:pointer;border:1px solid transparent;border-radius:5px}
.nav_burger span{display:block;width:22px;height:2px;background:var(--char);transition:all .4s var(--ease);border-radius:2px}
.nav:not(.scrolled) .nav_burger{border-color:var(--line);background:rgba(252,251,247,.5)}
.nav:not(.scrolled) .nav_burger span{background:var(--char)}
.nav.scrolled .nav_burger span{background:var(--char)}

@media(max-width:960px){
  .nav{padding:0 20px;height:64px}
  .nav_links{display:none!important}
  .nav_burger{display:flex!important}
  .nav_cta{padding:8px 14px;font-size:9px}
}

/* MOBILE MENU */
.mobile_menu{position:fixed;inset:0;z-index:60;background:var(--warm);transform:translateY(-100%);transition:transform .8s var(--ease2);display:flex;flex-direction:column}
.mobile_menu.open{transform:translateY(0)}
.mobile_menu_top{height:72px;display:flex;align-items:center;justify-content:space-between;padding:0 24px;border-bottom:1px solid var(--line)}
.mobile_menu_links{flex:1;display:flex;flex-direction:column;justify-content:center;padding:40px 28px;gap:6px}
.mobile_menu_links a{font-family:var(--serif);font-size:42px;line-height:1.1;font-weight:300;letter-spacing:-.02em}
.mobile_menu_links a span{font-size:10px;font-family:var(--sans);letter-spacing:.2em;text-transform:uppercase;opacity:.5;margin-right:16px;vertical-align:middle}
.mobile_menu_foot{padding:24px 28px;border-top:1px solid var(--line);display:flex;justify-content:space-between;font-size:10px;letter-spacing:.18em;text-transform:uppercase;opacity:.6}

/* HERO — an editorial portrait stack with a still centre frame and drifting side photographs */
.hero{position:relative;isolation:isolate;min-height:740px;height:min(100svh,980px);overflow:hidden;background:var(--warm)}
.hero_backdrop{position:absolute;inset:0;z-index:0;overflow:hidden;pointer-events:none;background:var(--warm)}
.hero_backdrop_image{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center 38%;filter:saturate(.9) blur(3px);opacity:0;transform:scale(1.035);transition:opacity 1.8s var(--ease),transform 8s var(--ease);will-change:opacity,transform}
.hero_backdrop_image.is-active{opacity:1;transform:scale(1.12) translate3d(-.8%,-.4%,0)}
.hero_backdrop:after{content:"";position:absolute;inset:0;background:linear-gradient(90deg,rgba(252,251,247,.62) 0%,rgba(252,251,247,.49) 38%,rgba(252,251,247,.27) 70%,rgba(252,251,247,.14) 100%),linear-gradient(0deg,rgba(252,251,247,.18),rgba(252,251,247,.18))}
@media(prefers-reduced-motion:reduce){.hero_backdrop_image,.hero_backdrop_image.is-active{transition:none;transform:none}}
.hero:before{content:"";position:absolute;inset:0;z-index:1;pointer-events:none;background:radial-gradient(ellipse at 80% 8%,rgba(212,175,55,.11),transparent 31%),radial-gradient(ellipse at 15% 92%,rgba(18,60,50,.08),transparent 36%)}
.hero:after{content:"";position:absolute;right:0;top:0;width:30%;height:100%;z-index:1;pointer-events:none;opacity:.22;background-image:radial-gradient(var(--deep2) .7px,transparent .7px);background-size:14px 14px;mask-image:linear-gradient(90deg,transparent,black)}
.hero_inner{position:relative;z-index:2;width:min(1440px,100%);height:100%;min-height:inherit;margin:0 auto;padding:112px clamp(28px,6vw,92px) 72px;display:grid;grid-template-columns:minmax(300px,.9fr) minmax(450px,1.1fr);gap:clamp(28px,4.5vw,76px);align-items:center}
.hero_content{position:relative;z-index:5;display:flex;flex-direction:column;align-items:flex-start;justify-content:center;height:auto;padding:0;color:var(--char)}
.hero_badge{display:inline-flex;align-items:center;gap:10px;padding:8px 14px;background:rgba(18,60,50,.07);border:1px solid rgba(18,60,50,.17);border-radius:30px;font-size:9px;letter-spacing:.2em;text-transform:uppercase;margin-bottom:26px;width:fit-content;color:var(--deep)}
.hero_badge_dot{width:7px;height:7px;border-radius:50%;background:#A78A37;box-shadow:0 0 0 4px rgba(212,175,55,.14)}
.hero_kicker{margin-bottom:12px;font-size:10px;letter-spacing:.24em;text-transform:uppercase;color:var(--taupe);font-weight:500}
.hero_title{max-width:7.5em;font-family:var(--serif);font-size:clamp(42px,5.2vw,74px);line-height:.95;letter-spacing:-.045em;font-weight:400;overflow-wrap:anywhere}
.hero_title .hero_name{display:block}
.hero_title em{display:block;margin:5px 0 7px 5px;font-family:var(--serif2);font-size:.55em;line-height:.9;font-style:italic;letter-spacing:0;font-weight:300;color:var(--deep2)}
.hero_intro{max-width:30em;margin-top:22px;font-size:13px;line-height:1.8;color:var(--taupe)}
.hero_meta{display:flex;gap:24px;margin-top:26px;align-items:flex-start;flex-wrap:wrap}
.hero_date{padding-left:13px;border-left:2px solid var(--champ);font-size:10px;letter-spacing:.16em;text-transform:uppercase;line-height:1.7;color:var(--char)}
.hero_hash{font-family:var(--serif);font-size:18px;letter-spacing:.04em;color:var(--deep2)}
.hero_story_link{display:inline-flex;align-items:center;gap:18px;margin-top:28px;padding:12px 0;border-bottom:1px solid var(--deep2);font-size:9px;letter-spacing:.18em;text-transform:uppercase;color:var(--deep);transition:gap .25s ease}
.hero_story_link:hover{gap:25px}
.hero_story_link span{font-size:17px;line-height:1}
.hero_visual{position:relative;width:100%;height:min(74vh,700px);min-height:560px;isolation:isolate}
.hero_visual:before{content:"";position:absolute;left:50%;top:50%;width:78%;aspect-ratio:1;transform:translate(-50%,-50%);border:1px solid rgba(18,60,50,.14);border-radius:50%;z-index:-1}
.hero_visual:after{content:"";position:absolute;right:8%;top:9%;width:11px;height:11px;border-radius:50%;background:var(--champ);box-shadow:0 0 0 10px rgba(212,175,55,.1)}
.hero_photo{position:absolute;display:flex;flex-direction:column;margin:0;padding:10px 10px 0;overflow:hidden;background:var(--warm);border:1px solid var(--line);box-shadow:0 26px 64px rgba(20,31,25,.2),0 3px 12px rgba(20,31,25,.08)}
.hero_photo img{width:100%;height:calc(100% - 44px);object-fit:cover;background:var(--ivory)}
.hero_photo figcaption{min-height:44px;display:flex;align-items:center;justify-content:space-between;gap:8px;padding:0 5px;font-size:8px;letter-spacing:.12em;text-transform:uppercase;color:var(--char)}
.hero_photo figcaption span{overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.hero_photo figcaption small{flex:none;font-size:8px;opacity:.55}
.hero_photo--left{left:3%;top:17%;width:31%;height:53%;z-index:2;transform:rotate(-7deg);animation:heroLift 7.5s ease-in-out infinite}
.hero_photo--center{left:29%;top:6%;width:46%;height:83%;z-index:4}
.hero_photo--right{right:0;bottom:5%;width:31%;height:48%;z-index:5;transform:rotate(6deg);animation:heroDip 8.5s ease-in-out infinite}
@keyframes heroLift{0%,100%{transform:rotate(-7deg) translateY(0)}50%{transform:rotate(-7deg) translateY(-17px)}}
@keyframes heroDip{0%,100%{transform:rotate(6deg) translateY(0)}50%{transform:rotate(6deg) translateY(16px)}}
.hero_photo--placeholder{justify-content:center;align-items:center;text-align:center;padding:24px;background:linear-gradient(145deg,var(--ivory),var(--warm));border:1px solid var(--line)}
.hero_placeholder_art{width:100%;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:18px;border:1px solid rgba(212,175,55,.42);background:radial-gradient(circle at center,rgba(212,175,55,.1),transparent 55%)}
.hero_placeholder_monogram{font-family:var(--serif);font-size:clamp(42px,6vw,80px);line-height:1;color:var(--deep)}
.hero_placeholder_label{font-size:8px;letter-spacing:.2em;text-transform:uppercase;color:var(--taupe)}
.hero_date_stamp{position:absolute;left:3%;bottom:5%;z-index:7;width:122px;height:122px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:4px;padding:12px;border-radius:50%;background:var(--deep);color:var(--ivory);border:1px solid rgba(212,175,55,.7);box-shadow:0 14px 38px rgba(18,60,50,.24);text-align:center;transform:rotate(-9deg)}
.hero_date_stamp span{font-family:var(--serif);font-size:16px;line-height:1.05}
.hero_date_stamp small{font-size:7px;letter-spacing:.18em;text-transform:uppercase;opacity:.76}
.hero_visual_note{position:absolute;right:1%;top:18%;z-index:1;writing-mode:vertical-rl;font-size:8px;letter-spacing:.28em;text-transform:uppercase;color:var(--taupe)}
.hero_scroll{position:absolute;z-index:2;left:clamp(28px,6vw,92px);bottom:24px;display:flex;align-items:center;gap:12px;font-size:8px;letter-spacing:.2em;text-transform:uppercase;color:var(--taupe)}
.hero_scroll:after{content:"";width:42px;height:1px;background:currentColor;opacity:.55}
@media(max-width:1080px){
  .hero_inner{grid-template-columns:minmax(280px,.88fr) minmax(390px,1.12fr);gap:24px;padding-left:32px;padding-right:32px}
  .hero_title{font-size:clamp(40px,5.3vw,62px)}
  .hero_visual{min-height:520px}
  .hero_date_stamp{width:106px;height:106px}
}
@media(max-width:820px){
  .hero{height:auto;min-height:0}
  .hero_inner{height:auto;min-height:0;grid-template-columns:1fr;gap:8px;padding:104px 24px 62px}
  .hero_content{max-width:620px;width:100%;margin:0 auto}
  .hero_title{font-size:clamp(44px,8vw,66px);max-width:8em}
  .hero_visual{width:min(640px,100%);height:520px;min-height:520px;margin:0 auto}
  .hero_scroll{left:24px;bottom:18px}
}
@media(max-width:520px){
  .hero_inner{padding:96px 20px 64px}
  .hero_badge{margin-bottom:20px;font-size:8px}
  .hero_title{font-size:clamp(38px,10vw,54px);max-width:8em}
  .hero_intro{font-size:12px;margin-top:16px}
  .hero_meta{gap:16px;margin-top:20px}
  .hero_visual{height:405px;min-height:405px;width:100%}
  .hero_photo{padding:7px 7px 0}
  .hero_photo figcaption{min-height:36px;font-size:7px}
  .hero_photo figcaption small{font-size:7px}
  .hero_photo--left{left:0;top:18%;width:33%;height:50%}
  .hero_photo--center{left:25%;top:8%;width:50%;height:78%}
  .hero_photo--right{right:0;bottom:4%;width:32%;height:45%}
  .hero_date_stamp{left:0;bottom:4%;width:84px;height:84px;padding:8px}
  .hero_date_stamp span{font-size:12px}
  .hero_date_stamp small{font-size:6px}
  .hero_visual_note{right:0;top:12%;font-size:6px}
  .hero_scroll{left:20px;font-size:7px}
}

/* FAMILIES */
.families_bar{padding:34px 0;background:var(--deep);color:var(--ivory)}
.families_inner{max-width:1280px;margin:0 auto;padding:0 48px}
.families_bar .eyebrow{color:rgba(252,251,247,.68)}
.families_grid{display:grid;grid-template-columns:1fr 1fr;gap:32px;margin-top:20px}
.families_grid p{padding-left:16px;border-left:1px solid var(--beige);font-family:var(--serif2);font-size:clamp(16px,2vw,22px);line-height:1.35;overflow-wrap:anywhere}
@media(max-width:700px){.families_inner{padding:0 24px}.families_grid{grid-template-columns:1fr;gap:16px}}

/* SECTIONS */
section{position:relative}
.eyebrow{font-size:10px;letter-spacing:.26em;text-transform:uppercase;color:var(--taupe);font-weight:500;display:inline-flex;align-items:center;gap:10px}
.eyebrow:before{content:"";width:24px;height:1px;background:currentColor}
.h2{font-family:var(--serif);font-size:clamp(32px,5vw,64px);line-height:.95;letter-spacing:-.02em;font-weight:400}
.h2 i{font-family:var(--serif2);font-style:italic;font-weight:300}
.body{font-size:15px;line-height:1.9;max-width:36em}
.reveal{opacity:0;transform:translateY(24px);transition:opacity .9s var(--ease), transform .9s var(--ease)}
@media(prefers-reduced-motion:reduce){html{scroll-behavior:auto}*,*:before,*:after{animation-duration:.01ms!important;animation-iteration-count:1!important;scroll-behavior:auto!important;transition-duration:.01ms!important}.reveal{opacity:1;transform:none}}
.reveal.in{opacity:1;transform:translateY(0)}

/* COUNTDOWN */
.countdown_sec{padding:120px 0 80px;background:var(--ivory);border-top:1px solid var(--line2);border-bottom:1px solid var(--line2)}
.count_wrap{max-width:1280px;margin:0 auto;padding:0 48px;display:grid;grid-template-columns:1.1fr .9fr;gap:80px;align-items:start}
.count_big{font-family:var(--serif);font-size:clamp(48px,7vw,92px);line-height:.9;letter-spacing:-.03em}
.count_big span{display:block}
.count_big em{font-style:italic;font-weight:300;color:var(--deep2)}
.count_desc{margin-top:24px}
.count_grid{margin-top:48px;display:grid;grid-template-columns:repeat(4,1fr);border-top:1px solid var(--char);border-bottom:1px solid var(--char)}
.count_item{padding:24px 12px;text-align:center;border-right:1px solid var(--line)}
.count_item:last-child{border-right:none}
.count_num{font-family:var(--serif);font-size:clamp(28px,4vw,56px);line-height:1;display:block;font-weight:300}
.count_lab{font-size:10px;letter-spacing:.22em;text-transform:uppercase;margin-top:8px;display:block;opacity:.6}
.count_note{margin-top:24px;font-size:12px;letter-spacing:.12em;text-transform:uppercase;opacity:.6}
@media(max-width:900px){.count_wrap{grid-template-columns:1fr;padding:0 24px;gap:48px}.countdown_sec{padding:80px 0 60px}}

/* GOSPELS */
.gospels{padding:140px 0;background:var(--warm);overflow:hidden}
.gospels_inner{max-width:1280px;margin:0 auto;padding:0 48px;display:grid;grid-template-columns:1.15fr .85fr;gap:80px;align-items:center}
.gospels_hash{font-family:var(--serif);font-size:clamp(38px,8vw,96px);line-height:.9;letter-spacing:-.03em;overflow-wrap:anywhere}
.gospels_quote{font-family:var(--serif2);font-size:clamp(22px,3vw,34px);line-height:1.15;font-style:italic;font-weight:300;margin-top:32px;max-width:12em}
.gospels_text{margin-top:20px;opacity:.8}
.gospels_img_wrap{position:relative;aspect-ratio:4/5;background:var(--beige);overflow:hidden}
.gospels_img_wrap img{width:100%;height:100%;object-fit:cover;transition:transform 1.2s var(--ease)}
.gospels_img_wrap:hover img{transform:scale(1.04)}
.photo_placeholder{display:flex;align-items:center;justify-content:center;width:100%;height:100%;min-height:220px;padding:28px;text-align:center;color:var(--deep);background:radial-gradient(ellipse at 70% 20%,rgba(212,175,55,.14),transparent 42%),linear-gradient(135deg,#e8ddcc,#f7f4ee);border:1px solid rgba(18,60,50,.12)}
.photo_placeholder span{max-width:22em;font-size:10px;line-height:1.8;letter-spacing:.18em;text-transform:uppercase}
.gospels_img_wrap>.photo_placeholder{position:absolute;inset:0}
.gospels_behind{position:absolute;left:-24px;top:-24px;width:100%;height:100%;border:1px solid var(--line);pointer-events:none}
@media(max-width:900px){.gospels{padding:80px 0}.gospels_inner{grid-template-columns:1fr;padding:0 24px;gap:40px}.gospels_img_wrap{aspect-ratio:16/12}}

/* STORY */
.story{padding:120px 0;background:var(--ivory);border-top:1px solid var(--line2)}
.story_inner{max-width:1280px;margin:0 auto;padding:0 48px}
.story_top{display:grid;grid-template-columns:.9fr 1.1fr;gap:80px;align-items:start}
.story_copy{columns:1;max-width:none}
.story_copy p{margin-bottom:1.6em;font-size:16px;line-height:1.95;opacity:.9}
.story_image{margin-top:80px;display:grid;grid-template-columns:1.6fr .8fr;gap:24px;align-items:end}
.story_image_main{aspect-ratio:16/10;overflow:hidden;background:var(--beige)}
.story_image_main img{width:100%;height:100%;object-fit:cover}
.story_image_main .photo_placeholder{min-height:0;height:100%}
.story_image_side{aspect-ratio:3/4;overflow:hidden;background:var(--beige);margin-bottom:40px}
.story_image_side img{width:100%;height:100%;object-fit:cover}
.story_image_side .photo_placeholder{min-height:0;height:100%;padding:18px}
.timeline{margin-top:80px;border-top:1px solid var(--char);display:grid;grid-template-columns:repeat(5,1fr)}
.tl_item{padding:20px 16px 0;border-right:1px solid var(--line)}
.tl_item:last-child{border-right:none}
.tl_date{font-size:10px;letter-spacing:.2em;text-transform:uppercase;opacity:.5}
.tl_title{font-family:var(--serif);font-size:16px;margin-top:10px;letter-spacing:.02em}
@media(max-width:900px){.story_inner{padding:0 24px}.story_top{grid-template-columns:1fr;gap:32px}.story_image{grid-template-columns:1fr}.story_image_side{display:none}.timeline{grid-template-columns:1fr}.tl_item{border-right:none;border-bottom:1px solid var(--line);padding:16px 0}}

/* HOW WE MET */
.how{padding:120px 0;background:var(--warm)}
.how_inner{max-width:1280px;margin:0 auto;padding:0 48px;display:grid;grid-template-columns:1.1fr .9fr;gap:64px;align-items:center}
.video_frame{position:relative;aspect-ratio:16/11;background:var(--char);overflow:hidden}
.video_frame video,.video_frame iframe{width:100%;height:100%;object-fit:cover;border:none}
.video_poster{position:absolute;inset:0;cursor:pointer}
.video_poster img,.video_poster .photo_placeholder{width:100%;height:100%;object-fit:cover;min-height:0}
.video_play{position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);width:64px;height:64px;border-radius:50%;background:var(--warm);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 32px rgba(0,0,0,.18);transition:transform .4s var(--ease)}
.video_poster:hover .video_play{transform:translate(-50%,-50%) scale(1.08)}
.how_text h3{font-family:var(--serif);font-size:clamp(28px,4vw,52px);line-height:.95}
.how_text h3 em{font-family:var(--serif2);font-style:italic;font-weight:300}
.how_text p{margin-top:20px}
.how_label{margin-top:28px;display:flex;gap:12px;align-items:center;font-size:10px;letter-spacing:.2em;text-transform:uppercase;opacity:.6}
.how_label:before{content:"";width:28px;height:1px;background:var(--char)}
@media(max-width:900px){.how{padding:80px 0}.how_inner{grid-template-columns:1fr;padding:0 24px}.how_inner .video_frame{order:2}.how_inner .how_text{order:1}}

/* MOMENTS CINEMATIC */
.moments_cine{position:relative;height:92vh;min-height:640px;background:#0f1512;overflow:hidden;display:flex;align-items:center;justify-content:center}
.moments_bg{position:absolute;inset:0;overflow:hidden}
.moments_bg img{width:100%;height:100%;object-fit:cover;filter:blur(18px) brightness(.55) saturate(.8);transform:scale(1.08);transition:opacity 1s var(--ease), transform 1.2s var(--ease);opacity:0;position:absolute;inset:0}
.moments_bg img.active{opacity:1}
.moments_card_wrap{position:relative;z-index:2;width:min(440px,86vw);transform:rotate(-1deg)}
.moments_card{position:relative;background:var(--warm);padding:10px 10px 0;box-shadow:0 24px 64px rgba(0,0,0,.35), 0 2px 0 rgba(0,0,0,.06) inset;transition:transform .8s var(--ease)}
.moments_card img{width:100%;aspect-ratio:4/5;object-fit:cover;display:block}
.moments_card_caption{padding:18px 14px 20px;background:var(--warm)}
.moments_card_caption h4{font-family:var(--serif);font-size:18px;line-height:1.1;letter-spacing:.02em}
.moments_card_caption p{font-size:12px;line-height:1.6;margin-top:8px;opacity:.7}
.moments_card_name{margin-top:12px;font-size:10px;letter-spacing:.18em;text-transform:uppercase;opacity:.8;font-weight:600}
.moments_nav{position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);width:min(680px,94vw);display:flex;justify-content:space-between;pointer-events:none;z-index:3}
.moments_nav button{pointer-events:auto;width:44px;height:44px;border-radius:50%;background:var(--warm);border:1px solid var(--line);display:flex;align-items:center;justify-content:center;transition:all .3s}
.moments_nav button:hover{background:var(--char);color:var(--warm)}
.moments_counter{position:absolute;left:50%;bottom:28px;transform:translateX(-50%);z-index:3;color:var(--warm);font-size:11px;letter-spacing:.2em;display:flex;align-items:center;gap:16px;opacity:.9}
.moments_dots{display:flex;gap:6px}
.moments_dots button{width:24px;height:3px;padding:0;border:0;background:rgba(252,251,247,.3);transition:background .4s;cursor:pointer}
.moments_dots button.active{background:var(--warm)}
.moments_dots button:focus-visible,.moments_nav button:focus-visible{outline:2px solid var(--warm);outline-offset:4px}
.memories_empty{position:relative;z-index:2;width:min(440px,86vw);padding:36px 32px;background:var(--warm);text-align:center;box-shadow:0 24px 64px rgba(0,0,0,.3)}
.memories_empty p{font-family:var(--serif);font-size:22px}
.memories_empty a{display:inline-block;margin-top:14px;font-size:10px;letter-spacing:.16em;text-transform:uppercase;border-bottom:1px solid currentColor;padding-bottom:4px}
.moments_title{position:absolute;top:32px;left:50%;transform:translateX(-50%);z-index:3;color:var(--warm);text-align:center}
.moments_title .eyebrow{color:rgba(252,251,247,.7)}
.moments_title .eyebrow:before{background:rgba(252,251,247,.7)}
.moments_title h2{font-family:var(--serif);font-size:28px;letter-spacing:.02em;margin-top:8px;font-weight:400}
@media(max-width:700px){.moments_cine{height:86vh}.moments_nav{width:92vw}.moments_card_wrap{width:78vw}}

/* GALLERY MASONRY */
.gallery_mason{padding:120px 0;background:var(--ivory)}
.gallery_head{max-width:1280px;margin:0 auto;padding:0 48px;display:flex;justify-content:space-between;align-items:end;gap:24px;flex-wrap:wrap}
.gallery_grid{max-width:1280px;margin:48px auto 0;padding:0 24px;columns:3;column-gap:24px}
.gallery_item{break-inside:avoid;margin-bottom:24px;position:relative;overflow:hidden;background:var(--beige);cursor:pointer}
.gallery_item img{width:100%;height:auto;display:block;transition:transform 1s var(--ease), filter .6s}
.gallery_item:hover img{transform:scale(1.04)}
.gallery_item_meta{position:absolute;left:0;right:0;bottom:0;padding:14px 16px;background:linear-gradient(0deg, rgba(0,0,0,.45), transparent);color:white;opacity:0;transition:opacity .4s}
.gallery_item:hover .gallery_item_meta{opacity:1}
.gallery_item_meta span{font-size:10px;letter-spacing:.18em;text-transform:uppercase}
.gallery_empty{max-width:1280px;margin:48px auto 0;padding:0 48px;font-family:var(--serif2);font-size:22px;opacity:.65}
@media(max-width:640px){.gallery_empty{padding:0 24px}}
@media(max-width:1000px){.gallery_grid{columns:2}}
@media(max-width:640px){.gallery_grid{columns:1;padding:0 16px}.gallery_head{padding:0 24px}}

/* LIGHTBOX */
.lightbox{position:fixed;inset:0;z-index:80;background:rgba(18,24,20,.96);display:none;align-items:center;justify-content:center;padding:24px}
.lightbox.open{display:flex}
.lightbox_img{max-width:92vw;max-height:82vh;object-fit:contain;box-shadow:0 24px 80px rgba(0,0,0,.5)}
.lightbox_ui{position:absolute;inset:0;pointer-events:none}
.lightbox_ui button{pointer-events:auto}
.lb_close{position:absolute;top:20px;right:20px;width:44px;height:44px;border:1px solid rgba(255,255,255,.2);border-radius:50%;color:white;display:flex;align-items:center;justify-content:center}
.lb_prev,.lb_next{position:absolute;top:50%;transform:translateY(-50%);width:44px;height:44px;border-radius:50%;background:rgba(252,251,247,.12);border:1px solid rgba(252,251,247,.2);color:white;display:flex;align-items:center;justify-content:center;backdrop-filter:blur(8px)}
.lb_prev{left:20px}.lb_next{right:20px}
.lb_counter{position:absolute;bottom:20px;left:50%;transform:translateX(-50%);color:white;font-size:11px;letter-spacing:.2em;opacity:.7}

/* WEDDING */
.wedding{padding:140px 0;background:var(--warm);border-top:1px solid var(--line2)}
.wedding_inner{max-width:1280px;margin:0 auto;padding:0 48px;display:grid;grid-template-columns:.9fr 1.1fr;gap:80px}
.wedding_side{position:sticky;top:120px;align-self:start}
.wedding_timeline{border-top:1px solid var(--char);margin-top:32px}
.wt_row{display:grid;grid-template-columns:120px 1fr;gap:24px;padding:22px 0;border-bottom:1px solid var(--line);align-items:baseline}
.wt_time{font-family:var(--serif);font-size:20px;letter-spacing:.02em}
.wt_label{font-size:10px;letter-spacing:.2em;text-transform:uppercase;opacity:.6;margin-bottom:4px}
.wt_title{font-family:var(--serif);font-size:20px;line-height:1.2}
.wt_desc{font-size:13px;opacity:.7;margin-top:6px}
.btn_line{margin-top:32px;display:inline-flex;align-items:center;gap:12px;border:1px solid var(--char);padding:14px 22px;font-size:10px;letter-spacing:.22em;text-transform:uppercase;font-weight:500;transition:all .4s}
.btn_line:hover{background:var(--char);color:var(--warm)}
@media(max-width:900px){.wedding{padding:80px 0}.wedding_inner{grid-template-columns:1fr;padding:0 24px}.wedding_side{position:static}}

/* VENUE */
.venue{padding:100px 0;background:var(--ivory)}
.venue_inner{max-width:1280px;margin:0 auto;padding:0 48px;display:grid;grid-template-columns:1.1fr .9fr;gap:0;align-items:stretch;border:1px solid var(--line)}
.venue_map{position:relative;background:#e8ddcc;min-height:520px;overflow:hidden}
.venue_map_pattern{position:absolute;inset:0;opacity:.62;background-color:#e8ddcc;background-image:linear-gradient(27deg,transparent 46%,rgba(18,60,50,.18) 47%,rgba(18,60,50,.18) 49%,transparent 50%),linear-gradient(152deg,transparent 43%,rgba(18,60,50,.14) 44%,rgba(18,60,50,.14) 46%,transparent 47%),repeating-linear-gradient(0deg,transparent 0 54px,rgba(18,60,50,.08) 55px 57px),repeating-linear-gradient(90deg,transparent 0 72px,rgba(18,60,50,.08) 73px 75px)}
.venue_map_label{position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);max-width:calc(100% - 32px);padding:14px 18px;background:var(--warm);border:1px solid var(--line);box-shadow:0 8px 24px rgba(0,0,0,.12);text-align:center;font-size:10px;letter-spacing:.14em;text-transform:uppercase}
.venue_info{padding:48px;background:var(--warm);display:flex;flex-direction:column;justify-content:center}
.venue_name{font-family:var(--serif);font-size:36px;line-height:.95;margin-top:12px}
.venue_addr{margin-top:16px;font-size:14px;line-height:1.8;opacity:.8}
.venue_actions{display:flex;gap:12px;margin-top:28px;flex-wrap:wrap}
@media(max-width:900px){.venue_inner{grid-template-columns:1fr;padding:0 24px;border:none;gap:24px}.venue_map{min-height:380px}.venue_info{padding:0;background:transparent}}

/* DRESSCODE */
.dress{padding:120px 0;background:var(--warm)}
.dress_inner{max-width:1280px;margin:0 auto;padding:0 48px;display:grid;grid-template-columns:.9fr 1.1fr;gap:80px;align-items:start}
.dress_swatches{margin-top:32px;display:flex;gap:18px;flex-wrap:wrap}
.swatch{width:92px;text-align:center}
.swatch_circle{width:64px;height:64px;border-radius:50%;margin:0 auto;border:1px solid var(--line);position:relative;overflow:hidden}
.swatch_label{font-size:9px;letter-spacing:.18em;text-transform:uppercase;margin-top:10px;display:block;opacity:.8}
.dress_note{margin-top:32px;padding:20px;border-left:1px solid var(--char);font-family:var(--serif2);font-style:italic;font-size:18px;line-height:1.4;opacity:.85}
@media(max-width:900px){.dress{padding:80px 0}.dress_inner{grid-template-columns:1fr;padding:0 24px;gap:40px}}

/* MC */
.mc{padding:120px 0;background:var(--deep);color:var(--ivory)}
.mc_inner{max-width:1280px;margin:0 auto;padding:0 48px;display:grid;grid-template-columns:.9fr 1.1fr;gap:80px;align-items:center}
.mc_img{aspect-ratio:4/5;overflow:hidden;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.08)}
.mc_img img{width:100%;height:100%;object-fit:cover}
.mc_role{font-size:10px;letter-spacing:.26em;text-transform:uppercase;opacity:.6}
.mc_name{font-family:var(--serif);font-size:clamp(28px,4vw,48px);line-height:.95;margin-top:12px}
.mc_bio{margin-top:20px;opacity:.8;line-height:1.9}
.mc_social{display:flex;gap:16px;margin-top:28px}
.mc_social a{font-size:10px;letter-spacing:.18em;text-transform:uppercase;opacity:.7;border-bottom:1px solid rgba(252,251,247,.2);padding-bottom:4px}
.mc_social a:hover{opacity:1}
@media(max-width:900px){.mc{padding:80px 0}.mc_inner{grid-template-columns:1fr;padding:0 24px}}

/* INFO + QA */
.info_qa{padding:120px 0;background:var(--ivory);display:grid;grid-template-columns:1fr 1fr}
.info_col{padding:0 48px}
.info_col:first-child{border-right:1px solid var(--line)}
.info_list{margin-top:32px;display:grid;gap:32px}
.info_item h4{font-size:10px;letter-spacing:.22em;text-transform:uppercase;margin-bottom:8px}
.info_item p{font-size:14px;line-height:1.8;opacity:.8}
.qa_list{margin-top:32px;border-top:1px solid var(--char)}
.qa_item{border-bottom:1px solid var(--line)}
.qa_q{width:100%;display:flex;justify-content:space-between;align-items:center;padding:20px 0;text-align:left;font-family:var(--serif);font-size:18px;line-height:1.3}
.qa_q span:last-child{font-family:var(--sans);font-size:14px;transition:transform .4s}
.qa_item.open .qa_q span:last-child{transform:rotate(45deg)}
.qa_a{max-height:0;overflow:hidden;transition:max-height .5s var(--ease), opacity .4s;opacity:0}
.qa_item.open .qa_a{max-height:300px;opacity:.8;padding-bottom:20px}
.qa_a p{font-size:14px;line-height:1.8}
@media(max-width:900px){.info_qa{grid-template-columns:1fr}.info_col{padding:32px 24px}.info_col:first-child{border-right:none;border-bottom:1px solid var(--line)}}

/* CASH GIFTS */
.cash_gift{padding:120px 0;background:var(--warm)}
.cash_gift_inner{max-width:1100px;margin:0 auto;padding:0 48px}
.cash_gift_intro{display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:end}
.cash_gift_intro .body{opacity:.72}
.cash_gift_details{display:grid;grid-template-columns:repeat(3,1fr);margin-top:40px;border-top:1px solid var(--line);border-bottom:1px solid var(--line)}
.cash_gift_item{display:flex;flex-direction:column;gap:10px;padding:22px 24px;border-right:1px solid var(--line);min-width:0}
.cash_gift_item:first-child{padding-left:0}
.cash_gift_item:last-child{border-right:0}
.cash_gift_item span{font-size:9px;letter-spacing:.2em;text-transform:uppercase;opacity:.55}
.cash_gift_item strong{font-family:var(--serif);font-size:clamp(16px,2vw,22px);font-weight:400;overflow-wrap:anywhere}
.cash_gift_inner>.btn_line{margin-top:22px}
.cash_gift_note{margin-top:22px;max-width:52em;line-height:1.8;white-space:pre-line}
.cash_gift_disclaimer{margin-top:24px;font-size:11px;line-height:1.7;opacity:.58}
@media(max-width:700px){.cash_gift{padding:80px 0}.cash_gift_inner{padding:0 24px}.cash_gift_intro{grid-template-columns:1fr;gap:24px}.cash_gift_details{grid-template-columns:1fr}.cash_gift_item,.cash_gift_item:first-child{padding:16px 0;border-right:0;border-bottom:1px solid var(--line)}.cash_gift_item:last-child{border-bottom:0}}

/* RSVP */
.rsvp{padding:120px 0;background:var(--deep);color:var(--ivory)}
.rsvp_inner{max-width:960px;margin:0 auto;padding:0 48px;text-align:center}
.rsvp_confirmation{max-width:640px;margin:20px auto 0;padding:14px 18px;background:#E8F5E9;color:#245B2A;text-align:center;border:1px solid #A5D6A7;font-size:13px}
.rsvp_form{margin-top:48px;text-align:left;display:grid;grid-template-columns:1fr 1fr;gap:20px;background:var(--warm);color:var(--char);padding:32px;border:1px solid rgba(255,255,255,.08)}
.rsvp_field{display:flex;flex-direction:column;gap:8px}
.rsvp_field_error{font-size:11px;line-height:1.45;color:#9B1C1C}
.rsvp_field input[aria-invalid="true"]{border-color:#9B1C1C}
.rsvp_submit:disabled{opacity:.6;cursor:wait}
.rsvp_field.full{grid-column:1/-1}
.rsvp_field label{font-size:10px;letter-spacing:.18em;text-transform:uppercase;opacity:.7}
.rsvp_field input,.rsvp_field select,.rsvp_field textarea{border:none;border-bottom:1px solid var(--line);padding:12px 0;font-family:var(--sans);font-size:14px;background:transparent;outline:none;transition:border-color .3s}
.rsvp_field input:focus,.rsvp_field textarea:focus{border-color:var(--char)}
.rsvp_radio{display:flex;gap:16px;margin-top:6px}
.rsvp_radio label{display:flex;align-items:center;gap:8px;font-size:12px;letter-spacing:.06em;text-transform:uppercase;border:1px solid var(--line);padding:10px 14px;cursor:pointer;transition:all .3s}
.rsvp_radio label.active{background:var(--char);color:var(--warm);border-color:var(--char)}
.rsvp_submit{grid-column:1/-1;margin-top:12px;background:var(--char);color:var(--warm);padding:16px;font-size:11px;letter-spacing:.22em;text-transform:uppercase;transition:opacity .3s}
.rsvp_submit:hover{opacity:.9}
.rsvp_whatsapp{display:inline-flex;align-items:center;justify-content:center;margin-top:24px;padding:13px 18px;border:1px solid rgba(252,251,247,.65);color:var(--warm);font-size:10px;letter-spacing:.14em;text-transform:uppercase;transition:background .3s,color .3s}
.rsvp_whatsapp:hover{background:var(--warm);color:var(--deep)}
.rsvp_whatsapp:focus-visible{outline:2px solid var(--beige);outline-offset:4px}
@media(max-width:700px){.rsvp_inner{padding:0 24px}.rsvp_form{grid-template-columns:1fr;padding:24px 20px}}

/* GUESTBOOK */
.guestbook{padding:100px 0;background:var(--ivory);border-top:1px solid var(--line2)}
.gb_inner{max-width:1280px;margin:0 auto;padding:0 48px;display:grid;grid-template-columns:.8fr 1.2fr;gap:64px}
.gb_list{display:grid;gap:24px;margin-top:24px}
.gb_card{border-bottom:1px solid var(--line);padding-bottom:20px}
.gb_msg{font-family:var(--serif2);font-style:italic;font-size:18px;line-height:1.5}
.gb_empty{padding:18px;border:1px dashed var(--line);font-size:13px;opacity:.65}
.gb_name{font-size:10px;letter-spacing:.18em;text-transform:uppercase;margin-top:10px;opacity:.6}
.gb_intro{max-width:28em;margin-top:22px;font-size:13px;line-height:1.8;opacity:.72}
.gb_form{border:1px solid var(--line);padding:24px;background:var(--warm);align-self:start}
.gb_form h4{font-family:var(--serif);font-size:20px}
.gb_form textarea{resize:vertical;min-height:92px;color:var(--char)}
.gb_form input{color:var(--char)}
.gb_form input[aria-invalid="true"],.gb_form textarea[aria-invalid="true"]{border-color:#9B1C1C}
.gb_error{font-size:11px;line-height:1.45;color:#9B1C1C}
.gb_submit{margin-top:16px}
:root[data-theme="dark"] .gb_form input[aria-invalid="true"],
:root[data-theme="dark"] .gb_form textarea[aria-invalid="true"]{border-color:#FF9F9F}
@media(max-width:900px){.gb_inner{grid-template-columns:1fr;padding:0 24px}}

/* CLOSING */
.closing{position:relative;height:92vh;min-height:600px;background:linear-gradient(135deg,#103b32 0%,#1b5547 52%,#0b2c25 100%);overflow:hidden;display:flex;align-items:center;justify-content:center;text-align:center;color:var(--warm)}
.closing_overlay{position:absolute;inset:0;background:radial-gradient(ellipse at 50% 0%,rgba(232,221,204,.1),transparent 60%)}
.closing_content{position:relative;z-index:2;padding:0 24px;max-width:720px}
.closing_content h2{font-family:var(--serif);font-size:clamp(32px,5vw,64px);line-height:.9;letter-spacing:-.02em;font-weight:300}
.closing_content h2 em{font-family:var(--serif2);font-style:italic}
.closing_hash{margin-top:24px;font-family:var(--serif);font-size:18px;letter-spacing:.06em}
.closing_thanks{margin-top:16px;font-size:12px;letter-spacing:.14em;text-transform:uppercase;opacity:.8}

/* FOOTER */
.footer{background:var(--deep);color:var(--ivory);padding:80px 0 32px}
.footer_inner{max-width:1280px;margin:0 auto;padding:0 48px}
.footer_top{display:flex;justify-content:space-between;gap:40px;flex-wrap:wrap;border-bottom:1px solid rgba(252,251,247,.12);padding-bottom:40px}
.footer_brand{display:flex;align-items:center;gap:18px}
.footer_brand img{width:76px;height:76px;flex:none;border-radius:50%}
.footer_brand span{font-family:var(--serif);font-size:48px;line-height:.9;letter-spacing:-.02em}
.footer_nav{display:flex;gap:24px;flex-wrap:wrap;font-size:10px;letter-spacing:.2em;text-transform:uppercase;opacity:.7}
.footer_bottom{margin-top:32px;display:flex;justify-content:space-between;gap:20px;flex-wrap:wrap;font-size:10px;letter-spacing:.14em;text-transform:uppercase;opacity:.5}
@media(max-width:700px){.footer_inner{padding:0 24px}.footer_brand span{font-size:36px}.footer_brand img{width:64px;height:64px}}

/* OPTIONAL BACKGROUND MUSIC */
.music_player{position:fixed;right:22px;bottom:22px;z-index:45;display:flex;align-items:center;gap:12px;max-width:min(440px,calc(100vw - 32px));padding:10px 14px;background:var(--deep);color:var(--warm);border:1px solid rgba(252,251,247,.22);box-shadow:0 8px 28px rgba(0,0,0,.2)}
.music_player audio{display:none}
.music_toggle{display:flex;align-items:center;gap:8px;flex:none;padding:10px 14px;border:1px solid var(--beige);background:var(--warm);color:var(--deep);font-size:11px;font-weight:600;letter-spacing:.1em;text-transform:uppercase}
.music_toggle:hover{background:var(--beige)}
.music_toggle:focus-visible{outline:2px solid var(--warm);outline-offset:4px}
.music_toggle:disabled{opacity:.55;cursor:not-allowed}
.music_icon{font-size:17px}
.music_status{max-width:240px;font-size:10px;line-height:1.4;opacity:.72}
@media(max-width:640px){.music_player{right:12px;bottom:12px;left:12px;max-width:none;justify-content:space-between;gap:8px}.music_status{max-width:55%;font-size:9px}}

.scroll_prog{position:fixed;top:0;left:0;height:2px;background:var(--deep);width:0;z-index:100;transition:width .1s linear}
.add_cal{font-size:10px;letter-spacing:.18em;text-transform:uppercase;border-bottom:1px solid var(--char);padding-bottom:4px;margin-top:12px;display:inline-block}
.form_flash{position:fixed;top:88px;left:50%;transform:translateX(-50%);width:min(680px,calc(100vw - 32px));padding:14px 18px;z-index:110;box-shadow:0 12px 36px rgba(0,0,0,.14);font-size:13px}
.form_flash.success{background:#E8F5E9;color:#245B2A;border:1px solid #A5D6A7}
.form_flash.error{background:#FFEBEE;color:#8E1B1B;border:1px solid #EF9A9A}
.form_flash ul{padding-left:18px}
.count_past{grid-column:1/-1;padding:24px;text-align:center;font-family:var(--serif);font-size:clamp(20px,3vw,30px);line-height:1.3}

/* DARK MODE: keep the forest-green brand sections, deepen the paper surfaces, and preserve readable contrast. */
:root[data-theme="dark"] .nav.scrolled{background:rgba(20,26,22,.96);border-color:var(--line);color:var(--char)}
:root[data-theme="dark"] .nav:not(.scrolled) .nav_burger{background:rgba(20,26,22,.58)}
:root[data-theme="dark"] .countdown_sec,
:root[data-theme="dark"] .story,
:root[data-theme="dark"] .gallery_mason,
:root[data-theme="dark"] .venue,
:root[data-theme="dark"] .info_qa,
:root[data-theme="dark"] .guestbook{background:#202823}
:root[data-theme="dark"] .hero_backdrop_image{filter:saturate(.7) brightness(.74) blur(3px)}
:root[data-theme="dark"] .hero_backdrop:after{background:linear-gradient(90deg,rgba(20,26,22,.64) 0%,rgba(20,26,22,.52) 38%,rgba(20,26,22,.36) 70%,rgba(20,26,22,.24) 100%),linear-gradient(0deg,rgba(20,26,22,.18),rgba(20,26,22,.18))}
:root[data-theme="dark"] .hero_visual_note{color:var(--beige)}
:root[data-theme="dark"] .hero_badge{background:rgba(212,175,55,.1);border-color:rgba(212,175,55,.34);color:var(--beige)}
:root[data-theme="dark"] .hero_title em,
:root[data-theme="dark"] .hero_hash,
:root[data-theme="dark"] .hero_story_link{color:var(--beige)}
:root[data-theme="dark"] .hero_story_link{border-color:var(--champ)}
:root[data-theme="dark"] .hero_placeholder_monogram{color:var(--beige)}
:root[data-theme="dark"] .hero_photo--placeholder{background:var(--warm)}
:root[data-theme="dark"] .count_big em{color:var(--beige)}
:root[data-theme="dark"] .moments_counter,
:root[data-theme="dark"] .moments_title{color:var(--ivory)}
:root[data-theme="dark"] .moments_dots button.active{background:var(--ivory)}
:root[data-theme="dark"] .moments_dots button:focus-visible,
:root[data-theme="dark"] .moments_nav button:focus-visible{outline-color:var(--ivory)}
:root[data-theme="dark"] .rsvp h2{color:var(--ivory)!important}
:root[data-theme="dark"] .rsvp .rsvp_whatsapp,
:root[data-theme="dark"] .closing,
:root[data-theme="dark"] .music_player{color:var(--ivory)}
:root[data-theme="dark"] .rsvp .rsvp_whatsapp{border-color:rgba(252,251,247,.55)}
:root[data-theme="dark"] .music_toggle{background:var(--ivory);color:var(--deep)}
:root[data-theme="dark"] .music_toggle:focus-visible{outline-color:var(--beige)}
</style>
<link rel="stylesheet" href="{{ asset('css/invitation-theme.css') }}">
</head>
<body>
<div class="scroll_prog" id="scrollProg"></div>
<noscript><style>.reveal{opacity:1!important;transform:none!important}</style></noscript>

@if(session('success'))
  <div class="form_flash success" role="status" aria-live="polite">{{ session('success') }}</div>
@endif
@if($errors->any())
  <div class="form_flash error" role="alert">
    <strong>We couldn’t submit your response:</strong>
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@yield('content')

</body>
</html>
