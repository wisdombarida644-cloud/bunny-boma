<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $setting->partner_one ?? 'Chiamaka Boma Ibekwe' }} & {{ $setting->partner_two ?? 'Gospel Abina-Aziba MacBenneth Isikpi' }} | {{ $setting->hashtag ?? '#THEGOSPELS26' }}</title>
<meta name="description" content="{{ $setting->partner_one ?? 'Chiamaka Boma Ibekwe' }} and {{ $setting->partner_two ?? 'Gospel Abina-Aziba MacBenneth Isikpi' }} celebrate on {{ \Carbon\Carbon::parse($setting->wedding_date ?? '2026-11-21')->format('F j, Y') }} at {{ $setting->venue_name ?? 'ATWIL EVENT CENTER' }}, {{ $setting->city ?? 'Port Harcourt, Rivers State' }}. {{ $setting->hashtag ?? '#THEGOSPELS26' }}">
<meta property="og:title" content="{{ $setting->partner_one ?? 'Chiamaka Boma Ibekwe' }} & {{ $setting->partner_two ?? 'Gospel Abina-Aziba MacBenneth Isikpi' }} | {{ $setting->hashtag ?? '#THEGOSPELS26' }}">
<meta property="og:description" content="{{ \Carbon\Carbon::parse($setting->wedding_date ?? '2026-11-21')->format('l, F j, Y') }} at {{ $setting->ceremony_time ?? '11:00 AM' }} prompt. {{ $setting->venue_name ?? 'ATWIL EVENT CENTER' }}, {{ $setting->address ?? 'Akpajo' }}, {{ $setting->city ?? 'Port Harcourt, Rivers State' }}.">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ rtrim(config('app.url'), '/') }}">
<link rel="canonical" href="{{ rtrim(config('app.url'), '/') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda:opsz,ital,wght@6..96,0..1,400;6..96,0..1,500;6..96,1,400;6..96,0,600&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Manrope:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
:root{
--deep:#123C32;
--deep2:#1B5547;
--beige:#E8DDCC;
--ivory:#F7F4EE;
--warm:#FCFBF7;
--char:#1D211E;
--taupe:#A89D8C;
--champ:#D4AF37;
--line:rgba(29,33,30,.12);
--line2:rgba(29,33,30,.08);
--serif:"Bodoni Moda", "Cormorant Garamond", serif;
--serif2:"Cormorant Garamond", serif;
--sans:"Manrope", sans-serif;
--ease:cubic-bezier(.25,.1,.25,1);
--ease2:cubic-bezier(.77,0,.175,1);
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
.nav:not(.scrolled){color:var(--warm);text-shadow:0 1px 8px rgba(0,0,0,.55)}
.nav.scrolled{background:rgba(252,251,247,.97);backdrop-filter:blur(16px);border-bottom:1px solid var(--line);text-shadow:none}
.nav:not(.scrolled) .nav_links a:after{background:var(--warm)}
.nav_logo{font-family:var(--serif);font-size:24px;letter-spacing:.08em;font-weight:600;line-height:1}
.nav_links{display:flex;gap:32px;align-items:center}
.nav_links a{font-size:10px;letter-spacing:.18em;text-transform:uppercase;font-weight:500;opacity:.85;position:relative;padding:4px 0}
.nav_links a:after{content:"";position:absolute;left:0;bottom:0;width:0;height:1px;background:var(--char);transition:width .4s var(--ease)}
.nav_links a:hover:after{width:100%}
.nav_right{display:flex;gap:18px;align-items:center}
.nav_cta{font-size:10px;letter-spacing:.18em;text-transform:uppercase;border:1px solid var(--line);padding:10px 18px;transition:all .4s}
.nav:not(.scrolled) .nav_cta{border-color:rgba(252,251,247,.72);color:var(--warm)}
.nav_cta:hover{background:var(--char);color:var(--warm);border-color:var(--char)}
.nav_burger{display:none;width:44px;height:44px;align-items:center;flex-direction:column;justify-content:center;gap:5px;cursor:pointer;border:1px solid transparent;border-radius:5px}
.nav_burger span{display:block;width:22px;height:2px;background:var(--char);transition:all .4s var(--ease);border-radius:2px}
.nav:not(.scrolled) .nav_burger{border-color:rgba(252,251,247,.65);background:rgba(18,60,50,.48)}
.nav:not(.scrolled) .nav_burger span{background:var(--warm)}
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

/* HERO */
.hero{position:relative;height:100vh;min-height:700px;overflow:hidden;background:linear-gradient(135deg,#103b32 0%,#1b5547 52%,#0b2c25 100%)}
.hero_slides{position:absolute;inset:0;width:100%;height:100%;background:linear-gradient(135deg,#103b32 0%,#1b5547 52%,#0b2c25 100%)}
.hero_empty{position:absolute;inset:0;background:radial-gradient(ellipse at 76% 24%,rgba(232,221,204,.12),transparent 35%),linear-gradient(135deg,#103b32 0%,#1b5547 52%,#0b2c25 100%)}
.hero_slide{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:0;transition:opacity 1.5s cubic-bezier(.25,.1,.25,1), transform 12s linear;transform:scale(1.02)}
.hero_slide.active{opacity:1;transform:scale(1.1)}
.hero_overlay{position:absolute;inset:0;background:linear-gradient(180deg, rgba(18,60,50,.4) 0%, rgba(18,60,50,.18) 35%, rgba(18,24,20,.85) 100%)}

.hero_content{position:relative;z-index:2;height:100%;display:flex;flex-direction:column;justify-content:flex-end;padding:0 48px 64px;color:var(--warm)}
.hero_badge{display:inline-flex;align-items:center;gap:10px;padding:8px 16px;background:rgba(252,251,247,.12);backdrop-filter:blur(12px);border:1px solid rgba(252,251,247,.25);border-radius:30px;font-size:10px;letter-spacing:.22em;text-transform:uppercase;margin-bottom:20px;width:fit-content}
.hero_badge_dot{width:6px;height:6px;border-radius:50%;background:#4CAF50;box-shadow:0 0 8px #4CAF50;animation:pulseDot 2s infinite}
@keyframes pulseDot{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.4;transform:scale(1.4)}}

.hero_title{font-family:var(--serif);font-size:clamp(34px,6.8vw,92px);line-height:.94;letter-spacing:-.04em;font-weight:400;max-width:12em;overflow-wrap:break-word;text-shadow:0 4px 24px rgba(0,0,0,.3)}
.hero_title em{font-family:var(--serif2);font-style:italic;text-transform:none;font-weight:300;display:block;font-size:.6em;letter-spacing:-.02em;margin:4px 0 4px 6px;color:var(--beige)}

.hero_meta{display:flex;gap:36px;margin-top:28px;align-items:flex-end;flex-wrap:wrap}
.hero_date{font-size:11px;letter-spacing:.22em;text-transform:uppercase;line-height:1.6;opacity:.95;border-left:2px solid var(--beige);padding-left:14px}
.hero_hash{font-family:var(--serif);font-size:20px;letter-spacing:.06em;color:var(--beige)}

/* Hero Controls & Indicators */
.hero_controls{position:absolute;right:48px;bottom:64px;z-index:3;display:flex;flex-direction:column;align-items:flex-end;gap:20px}
.hero_dots{display:flex;gap:8px}
.hero_dots button{width:28px;height:3px;background:rgba(255,255,255,.3);border-radius:2px;transition:all .4s var(--ease)}
.hero_dots button.active{background:var(--warm);width:44px}
.hero_scroll{writing-mode:vertical-rl;font-size:10px;letter-spacing:.3em;text-transform:uppercase;opacity:.8;display:flex;align-items:center;gap:16px;color:var(--warm)}
.hero_scroll:after{content:"";width:1px;height:44px;background:currentColor;opacity:.5}

@media(max-width:960px){
  .hero_content{padding:0 24px 48px}
  .hero_controls{right:20px;bottom:32px}
  .hero_scroll{display:none}
  .hero_title{font-size:clamp(28px,8.5vw,50px);max-width:10em}
  .hero_meta{gap:20px;margin-top:20px}
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
.rsvp_form{margin-top:48px;text-align:left;display:grid;grid-template-columns:1fr 1fr;gap:20px;background:var(--warm);color:var(--char);padding:32px;border:1px solid rgba(255,255,255,.08)}
.rsvp_field{display:flex;flex-direction:column;gap:8px}
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
.gb_form{border:1px solid var(--line);padding:24px;background:var(--warm);align-self:start}
.gb_form h4{font-family:var(--serif);font-size:20px}
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
.footer_brand{font-family:var(--serif);font-size:48px;line-height:.9;letter-spacing:-.02em}
.footer_nav{display:flex;gap:24px;flex-wrap:wrap;font-size:10px;letter-spacing:.2em;text-transform:uppercase;opacity:.7}
.footer_bottom{margin-top:32px;display:flex;justify-content:space-between;gap:20px;flex-wrap:wrap;font-size:10px;letter-spacing:.14em;text-transform:uppercase;opacity:.5}
@media(max-width:700px){.footer_inner{padding:0 24px}.footer_brand{font-size:36px}}

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
</style>
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
