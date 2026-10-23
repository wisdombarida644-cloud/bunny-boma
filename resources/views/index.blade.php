@extends('layouts.app')

@section('content')
<nav class="nav" id="nav">
  <a href="#home" class="nav_logo">{{ substr($setting->partner_one ?? 'B', 0, 1) }}&{{ substr($setting->partner_two ?? 'B', 0, 1) }}</a>
  <div class="nav_links" id="navLinks">
    <a href="#home">Home</a>
    <a href="#story">Our Story</a>
    <a href="#wedding">Our Wedding</a>
    <a href="#moments">Moments</a>
    <a href="#qa">Q&A</a>
    <a href="#gifts">Gift Registry</a>
  </div>
  <div class="nav_right">
    <a href="#rsvp" class="nav_cta">RSVP</a>
    <button class="nav_burger" id="burger" aria-label="Menu"><span></span><span></span><span></span></button>
  </div>
</nav>

<div class="mobile_menu" id="mobileMenu">
  <div class="mobile_menu_top">
    <div class="nav_logo">{{ substr($setting->partner_one ?? 'B', 0, 1) }}&{{ substr($setting->partner_two ?? 'B', 0, 1) }}</div>
    <button id="closeMenu" aria-label="Close">✕</button>
  </div>
  <div class="mobile_menu_links">
    <a href="#home" data-close><span>01</span>Home</a>
    <a href="#story" data-close><span>02</span>Our Story</a>
    <a href="#wedding" data-close><span>03</span>Our Wedding</a>
    <a href="#moments" data-close><span>04</span>Moments</a>
    <a href="#qa" data-close><span>05</span>Q&A</a>
    <a href="#gifts" data-close><span>06</span>Gift Registry</a>
    <a href="#rsvp" data-close><span>07</span>RSVP</a>
  </div>
  <div class="mobile_menu_foot">
    <span>{{ $setting->hashtag ?? '#TheGospels26' }}</span>
    <span>{{ \Carbon\Carbon::parse($setting->wedding_date ?? '2026-09-26')->format('M j, Y') }}</span>
  </div>
</div>

<header class="hero" id="home">
  <div class="hero_slides" id="heroSlides">
    <img class="hero_slide active" src="https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=2000&auto=format&fit=crop" alt="{{ $setting->partner_one }} & {{ $setting->partner_two }}">
    <img class="hero_slide" src="https://images.unsplash.com/photo-1520854221256-17451ccdf07b?q=80&w=2000&auto=format&fit=crop" alt="Benny & Boma Prewedding">
    <img class="hero_slide" src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=2000&auto=format&fit=crop" alt="Benny & Boma Moments">
    <img class="hero_slide" src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=2000&auto=format&fit=crop" alt="Benny & Boma Celebration">
  </div>
  <div class="hero_overlay"></div>
  <div class="hero_content">
    <div class="hero_badge">
      <span class="hero_badge_dot"></span>
      The Beginning of Forever
    </div>
    <h1 class="hero_title">{{ $setting->partner_one }} <em>&</em> {{ $setting->partner_two }}</h1>
    <div class="hero_meta">
      <div class="hero_date">
        {{ \Carbon\Carbon::parse($setting->wedding_date)->format('F j, Y') }}<br>
        {{ $setting->venue_name }} • {{ $setting->city }}
      </div>
      <div class="hero_hash">{{ $setting->hashtag }}</div>
    </div>
  </div>
  <div class="hero_controls">
    <div class="hero_dots" id="heroDots">
      <button class="active" aria-label="Slide 1"></button>
      <button aria-label="Slide 2"></button>
      <button aria-label="Slide 3"></button>
      <button aria-label="Slide 4"></button>
    </div>
    <div class="hero_scroll">Scroll — Discover Our Story</div>
  </div>
</header>

<section class="countdown_sec" id="countdownSec">
  <div class="count_wrap">
    <div>
      <div class="eyebrow">Save the date</div>
      <h2 class="count_big reveal"><span>THE DAY WE</span><span>SAY <em>I DO</em></span></h2>
      <p class="body count_desc reveal">Two families, one celebration. Surrounded by the people who have shaped us, we will make promises that last a lifetime.</p>
      <div class="count_note reveal">Until we begin this beautiful chapter</div>
      <div class="count_grid reveal" id="countGrid">
        <div class="count_item"><span class="count_num" id="cDays">—</span><span class="count_lab">Days</span></div>
        <div class="count_item"><span class="count_num" id="cHours">—</span><span class="count_lab">Hours</span></div>
        <div class="count_item"><span class="count_num" id="cMins">—</span><span class="count_lab">Minutes</span></div>
        <div class="count_item"><span class="count_num" id="cSecs">—</span><span class="count_lab">Seconds</span></div>
      </div>
      <button class="add_cal" id="addCalBtn">Add to calendar</button>
    </div>
    <div class="reveal" style="border-left:1px solid var(--line);padding-left:48px">
      <div style="font-family:var(--serif);font-size:88px;line-height:.9;letter-spacing:-.04em">
        <div>{{ \Carbon\Carbon::parse($setting->wedding_date)->format('d') }}</div>
        <div style="opacity:.3">{{ \Carbon\Carbon::parse($setting->wedding_date)->format('m') }}</div>
        <div style="opacity:.6">{{ \Carbon\Carbon::parse($setting->wedding_date)->format('Y') }}</div>
      </div>
      <div style="margin-top:24px;font-size:10px;letter-spacing:.22em;text-transform:uppercase;opacity:.6;line-height:1.8">
        {{ \Carbon\Carbon::parse($setting->wedding_date)->format('l') }}<br>
        {{ $setting->arrival_time ?? 'Four in the afternoon' }}<br>
        {{ $setting->venue_name ?? 'Harbour Point, Lagos' }}
      </div>
      <div style="margin-top:32px;display:flex;gap:12px">
        <button class="btn_line" id="copyLinkBtn" style="margin-top:0">Copy Link</button>
        <button class="btn_line" id="shareBtn" style="margin-top:0">Share</button>
      </div>
    </div>
  </div>
</section>

<section class="gospels" id="gospels">
  <div class="gospels_inner">
    <div>
      <div class="eyebrow">The Gospel</div>
      <div class="gospels_hash reveal">#The<br>Gospels26</div>
      <div class="gospels_quote reveal">One story.<br>Two hearts.<br>A lifetime ahead.</div>
      <p class="body gospels_text reveal">We chose {{ $setting->hashtag }} because our story has always felt like good news worth telling — ordinary moments made sacred, laughter that lingered, and a love that kept choosing. This is our testimony.</p>
    </div>
    <div class="gospels_img_wrap reveal">
      <div class="gospels_behind"></div>
      <img src="https://images.unsplash.com/photo-1520854221256-17451ccdf07b?q=80&w=1000&auto=format&fit=crop" alt="Editorial" loading="lazy">
    </div>
  </div>
</section>

<section class="story" id="story">
  <div class="story_inner">
    <div class="story_top">
      <div>
        <div class="eyebrow">Our love story</div>
        <h2 class="h2 reveal" style="margin-top:16px">{!! str_replace('. ', '.<br>', e($setting->story_title ?? 'Some stories are written. Ours was lived.')) !!}</h2>
      </div>
      <div class="story_copy reveal" id="storyCopy">
        @if(is_array($setting->story_content))
          @foreach($setting->story_content as $p)
            <p>{{ $p }}</p>
          @endforeach
        @endif
      </div>
    </div>
    <div class="story_image reveal">
      <div class="story_image_main"><img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=1600&auto=format&fit=crop" alt="Love story main" loading="lazy"></div>
      <div class="story_image_side"><img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=800&auto=format&fit=crop" alt="Love story side" loading="lazy"></div>
    </div>
    <div class="timeline" id="timeline">
      @foreach($timelines as $t)
      <div class="tl_item">
        <div class="tl_date">{{ $t->date_label }}</div>
        <div class="tl_title">{{ $t->title }}</div>
        <div style="font-size:12px;opacity:.6;margin-top:4px">{{ $t->desc }}</div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<section class="how" id="howWeMet">
  <div class="how_inner">
    <div class="video_frame reveal" id="videoFrame">
      <div class="video_poster" id="videoPoster">
        <img src="https://images.unsplash.com/photo-1529634597503-139d3726fed5?q=80&w=1200&auto=format&fit=crop" alt="How we met poster">
        <div class="video_play"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5.14v14l11-7-11-7z"/></svg></div>
      </div>
    </div>
    <div class="how_text reveal">
      <div class="eyebrow">Our story, in our own words</div>
      <h3 style="margin-top:16px">THE MOMENT<br><em>it all began</em></h3>
      <p class="body">{{ $setting->podcast_desc ?? 'Listen as we tell the story of the first conversation that never really ended.' }}</p>
      <p class="body" style="opacity:.7;font-size:13px">Filmed in Lagos, with all the nervous laughter intact. Tap to play video.</p>
      <div class="how_label">Play film — 3:42</div>
    </div>
  </div>
</section>

<section class="moments_cine" id="moments">
  <div class="moments_bg" id="momentsBg"></div>
  <div class="moments_title"><div class="eyebrow">Through their eyes</div><h2>Every moment, preserved</h2></div>
  <div class="moments_card_wrap">
    <div class="moments_card" id="momentsCard">
      <img id="momentsImg" alt="">
      <div class="moments_card_caption">
        <h4 id="momentsTitle"></h4>
        <p id="momentsCaption"></p>
        <div class="moments_card_name" id="momentsName"></div>
      </div>
    </div>
  </div>
  <div class="moments_nav"><button id="momPrev" aria-label="Previous">←</button><button id="momNext" aria-label="Next">→</button></div>
  <div class="moments_counter"><span id="momCounter">01 / 06</span><div class="moments_dots" id="momDots"></div></div>
</section>

<section class="gallery_mason" id="gallery">
  <div class="gallery_head">
    <div><div class="eyebrow">Photo journal</div><h2 class="h2" style="margin-top:12px">A love letter<br><i>in photographs</i></h2></div>
    <div class="body" style="max-width:22em;opacity:.7">An editorial selection from our engagement, pre-wedding and quiet in-betweens. Click to view full screen.</div>
  </div>
  <div class="gallery_grid" id="galleryGrid">
    @foreach($galleries as $index => $g)
    <div class="gallery_item" data-i="{{ $index }}">
      <img src="{{ $g->image_path }}" loading="lazy" alt="{{ $g->caption }}">
      <div class="gallery_item_meta"><span>{{ $g->category }} — {{ $g->caption }}</span></div>
    </div>
    @endforeach
  </div>
</section>

<div class="lightbox" id="lightbox">
  <img class="lightbox_img" id="lbImg" alt="">
  <div class="lightbox_ui">
    <button class="lb_close" id="lbClose">✕</button>
    <button class="lb_prev" id="lbPrev">‹</button>
    <button class="lb_next" id="lbNext">›</button>
    <div class="lb_counter" id="lbCounter"></div>
  </div>
</div>

<section class="wedding" id="wedding">
  <div class="wedding_inner">
    <div class="wedding_side reveal">
      <div class="eyebrow">Our wedding</div>
      <h2 class="h2" style="margin-top:12px">Come<br>celebrate<br><i>with us.</i></h2>
      <p class="body" style="margin-top:20px;opacity:.7">We would be honoured by your presence as we begin this chapter. Dress beautifully, arrive early, stay late.</p>
      @if($setting->order_pdf_path)
        <a class="btn_line" href="{{ $setting->order_pdf_path }}" target="_blank">Download Order of Service</a>
      @else
        <button class="btn_line" onclick="alert('Order of Service PDF will be uploaded by couple.')">Download Order of Service</button>
      @endif
    </div>
    <div class="reveal">
      <div class="wedding_timeline">
        <div class="wt_row">
          <div class="wt_time">{{ $setting->arrival_time }}<div class="wt_label">Arrival</div></div>
          <div><div class="wt_title">Guests arrive & settle</div><div class="wt_desc">Harbour Point opens, welcome drinks</div></div>
        </div>
        <div class="wt_row">
          <div class="wt_time">{{ $setting->ceremony_time }}<div class="wt_label">Ceremony</div></div>
          <div><div class="wt_title">The vows</div><div class="wt_desc">Unplugged, intimate, full of promise</div></div>
        </div>
        <div class="wt_row">
          <div class="wt_time">{{ $setting->reception_time }}<div class="wt_label">Reception</div></div>
          <div><div class="wt_title">Dinner, toasts & dancing</div><div class="wt_desc">Celebration into the night</div></div>
        </div>
        <div class="wt_row">
          <div class="wt_time">09:00 PM<div class="wt_label">Closing</div></div>
          <div><div class="wt_title">Last dance</div><div class="wt_desc">Thank you for being here</div></div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="venue" id="venue">
  <div class="venue_inner reveal">
    <div class="venue_map">
      <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?q=80&w=1200&auto=format&fit=crop" alt="Venue map">
      <div class="venue_map_overlay"></div>
      <div style="position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);background:var(--warm);padding:12px 16px;border:1px solid var(--line);font-size:10px;letter-spacing:.18em;text-transform:uppercase">
        {{ $setting->venue_name }} • {{ $setting->city }}
      </div>
    </div>
    <div class="venue_info">
      <div class="eyebrow">Venue</div>
      <div class="venue_name">{{ $setting->venue_name }}</div>
      <div class="venue_addr">{!! nl2br(e($setting->address)) !!}<br>{{ $setting->city }}<br><br>{{ \Carbon\Carbon::parse($setting->wedding_date)->format('F j, Y') }} • {{ $setting->wedding_time }}</div>
      <div class="venue_actions">
        <a class="btn_line" href="{{ $setting->maps_url }}" target="_blank">View location</a>
        <button class="btn_line" id="copyAddrBtn">Copy address</button>
      </div>
    </div>
  </div>
</section>

<section class="dress" id="dresscode">
  <div class="dress_inner">
    <div class="reveal">
      <div class="eyebrow">Dress code</div>
      <h2 class="h2" style="margin-top:12px">Formal<br><i>attire</i></h2>
      <p class="body" style="margin-top:16px">We invite you to dress in a way that makes you feel your most beautiful. Think timeless, refined, celebratory.</p>
      <div class="dress_note">{{ $setting->dress_note }}</div>
    </div>
    <div class="reveal">
      <div style="font-size:10px;letter-spacing:.22em;text-transform:uppercase;opacity:.6">Suggested palette</div>
      <div class="dress_swatches">
        @if(is_array($setting->dress_colors))
          @foreach($setting->dress_colors as $color)
            <div class="swatch"><div class="swatch_circle" style="background:{{ $color['hex'] }}"></div><span class="swatch_label">{{ $color['name'] }}</span></div>
          @endforeach
        @endif
      </div>
    </div>
  </div>
</section>

@if($mc)
<section class="mc" id="mc">
  <div class="mc_inner">
    <div class="mc_img reveal"><img src="{{ $mc->image_path }}" alt="{{ $mc->name }}"></div>
    <div class="reveal">
      <div class="mc_role">{{ $mc->role }}</div>
      <div class="mc_name">{{ $mc->name }}</div>
      <div class="mc_bio body">{{ $mc->bio }}</div>
      <div class="mc_social">
        @if($mc->instagram_url)<a href="{{ $mc->instagram_url }}" target="_blank">Instagram</a>@endif
        @if($mc->x_url)<a href="{{ $mc->x_url }}" target="_blank">X</a>@endif
        @if($mc->website_url)<a href="{{ $mc->website_url }}" target="_blank">Website</a>@endif
      </div>
    </div>
  </div>
</section>
@endif

<section class="info_qa">
  <div class="info_col reveal">
    <div class="eyebrow">Good to know</div>
    <h2 class="h2" style="margin-top:12px;font-size:40px">Important<br>information</h2>
    <div class="info_list">
      @foreach($infos as $inf)
        <div class="info_item"><h4>{{ $inf->title }}</h4><p>{{ $inf->text }}</p></div>
      @endforeach
    </div>
  </div>
  <div class="info_col reveal" id="qa">
    <div class="eyebrow">Questions & answers</div>
    <h2 class="h2" style="margin-top:12px;font-size:40px">A few things<br><i>worth knowing</i></h2>
    <div class="qa_list" id="qaList">
      @foreach($qas as $index => $qa)
        <div class="qa_item {{ $index === 0 ? 'open' : '' }}">
          <button class="qa_q"><span>{{ $qa->question }}</span><span>+</span></button>
          <div class="qa_a"><p>{{ $qa->answer }}</p></div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section class="gifts" id="gifts">
  <div class="gifts_inner">
    <div style="display:flex;justify-content:space-between;gap:24px;flex-wrap:wrap;align-items:end">
      <div><div class="eyebrow">Gift registry</div><h2 class="h2" style="margin-top:12px">Your presence is<br><i>the greatest gift.</i></h2></div>
      <div class="body" style="max-width:26em;opacity:.7">We are incredibly grateful to celebrate this day with you. For those who wish to bless us with a gift, we have put together a registry.</div>
    </div>
    <div class="gifts_filters" id="giftFilters">
      <button class="gf_btn active" data-f="ALL">ALL</button>
      <button class="gf_btn" data-f="HOME">HOME</button>
      <button class="gf_btn" data-f="TRAVEL">TRAVEL</button>
      <button class="gf_btn" data-f="EXPERIENCE">EXPERIENCE</button>
      <button class="gf_btn" data-f="PERSONAL">PERSONAL</button>
    </div>
    <div class="gifts_grid" id="giftsGrid">
      @foreach($gifts as $gift)
      <div class="gift_card" data-cat="{{ $gift->category }}" data-status="{{ $gift->status }}">
        <div class="gift_img"><img src="{{ $gift->image_path }}" loading="lazy" alt="{{ $gift->name }}"></div>
        <div class="gift_body">
          <div class="gift_cat">{{ $gift->category }}</div>
          <div class="gift_name">{{ $gift->name }}</div>
          <div class="gift_desc">{{ $gift->description }}</div>
          <div class="gift_price">{{ $gift->price }}</div>
          <div class="gift_status {{ $gift->status !== 'AVAILABLE' ? 'gifted' : '' }}">{{ $gift->status }}</div>
          <button class="gift_btn" data-id="{{ $gift->id }}" data-name="{{ $gift->name }}" data-price="{{ $gift->price }}" data-cat="{{ $gift->category }}" data-desc="{{ $gift->description }}" data-img="{{ $gift->image_path }}" {{ $gift->status !== 'AVAILABLE' ? 'disabled style="opacity:.4"' : '' }}>
            {{ $gift->status === 'AVAILABLE' ? 'Give this gift' : 'Fully gifted' }}
          </button>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<section class="rsvp" id="rsvp">
  <div class="rsvp_inner">
    <div class="eyebrow" style="color:rgba(252,251,247,.6)">RSVP</div>
    <h2 class="h2" style="color:var(--warm);margin-top:12px">Will you celebrate<br><i>with us?</i></h2>
    <p class="body" style="margin:16px auto 0;opacity:.7;color:var(--ivory)">Kindly respond by August 26, 2026. We have reserved seats with love.</p>
    <form class="rsvp_form" id="rsvpForm" action="{{ route('rsvp.store') }}" method="POST">
      @csrf
      <div class="rsvp_field"><label>Full name</label><input required name="name" placeholder="Your full name"></div>
      <div class="rsvp_field"><label>Email</label><input required type="email" name="email" placeholder="you@email.com"></div>
      <div class="rsvp_field"><label>Phone</label><input name="phone" placeholder="+234..."></div>
      <div class="rsvp_field"><label>Number attending</label><select name="guests_count"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></div>
      <div class="rsvp_field full">
        <label>Will you be there?</label>
        <div class="rsvp_radio">
          <label class="active"><input type="radio" name="attendance" value="yes" checked hidden> Yes, I'll be there</label>
          <label><input type="radio" name="attendance" value="no" hidden> Sorry, I can't make it</label>
        </div>
      </div>
      <div class="rsvp_field full"><label>Message to couple (optional)</label><textarea name="message" rows="3" placeholder="Leave a note..."></textarea></div>
      <button class="rsvp_submit" type="submit">Send RSVP</button>
    </form>
  </div>
</section>

<section class="guestbook" id="guestbook">
  <div class="gb_inner">
    <div><div class="eyebrow">Guestbook</div><h2 class="h2" style="margin-top:12px;font-size:36px">Leave us<br><i>a note</i></h2></div>
    <div>
      <div class="gb_list" id="gbList">
        @foreach($guestbooks as $gb)
        <div class="gb_card"><div class="gb_msg">"{{ $gb->message }}"</div><div class="gb_name">— {{ $gb->name }}</div></div>
        @endforeach
      </div>
      <form class="gb_form" id="gbForm" action="{{ route('guestbook.store') }}" method="POST">
        @csrf
        <h4>Write a message</h4>
        <div class="rsvp_field" style="margin-top:16px"><label>Your name</label><input name="name" required placeholder="Name"></div>
        <div class="rsvp_field" style="margin-top:12px"><label>Message</label><textarea name="message" rows="3" required placeholder="May your home always be..."></textarea></div>
        <button class="btn_line" style="width:100%;margin-top:16px;justify-content:center" type="submit">Post note</button>
      </form>
    </div>
  </div>
</section>

<footer class="footer">
  <div class="footer_inner">
    <div class="footer_top">
      <div class="footer_brand">{{ strtoupper($setting->partner_one) }} &<br>{{ strtoupper($setting->partner_two) }}</div>
      <div>
        <div style="font-size:10px;letter-spacing:.22em;text-transform:uppercase;opacity:.6;margin-bottom:16px">{{ $setting->hashtag }} — {{ \Carbon\Carbon::parse($setting->wedding_date)->format('F j, Y') }}</div>
        <div class="footer_nav">
          <a href="#story">Our story</a><a href="#wedding">Our wedding</a><a href="#moments">Moments</a><a href="#qa">Q&A</a><a href="#gifts">Gift registry</a><a href="{{ route('admin.dashboard') }}">Admin</a>
        </div>
      </div>
    </div>
    <div class="footer_bottom"><span>With love, {{ $setting->partner_one }} & {{ $setting->partner_two }}</span><span>Lagos, Nigeria • Crafted with care</span></div>
  </div>
</footer>

<!-- Gift Modal -->
<div class="modal" id="giftModal">
  <div class="modal_box">
    <button class="modal_close" id="giftModalClose">✕</button>
    <div class="modal_img"><img id="giftModalImg" alt=""></div>
    <div class="modal_content">
      <div class="eyebrow" id="giftModalCat"></div>
      <h3 style="font-family:var(--serif);font-size:28px;margin-top:8px" id="giftModalName"></h3>
      <div style="margin-top:8px;font-family:var(--serif);font-size:20px" id="giftModalPrice"></div>
      <p class="body" style="margin-top:12px" id="giftModalDesc"></p>
      <div class="rsvp_field" style="margin-top:20px"><label>Note to couple</label><textarea rows="3" placeholder="Add a personal note..."></textarea></div>
      <button class="rsvp_submit" style="width:100%;margin-top:16px;background:var(--deep)" id="giftConfirm">Confirm gift — Thank you</button>
    </div>
  </div>
</div>

<script>
const weddingData = {
  date: "{{ $setting->wedding_date }}",
  time: "{{ $setting->wedding_time }}",
  moments: {!! json_encode($moments) !!},
  gallery: {!! json_encode($galleries) !!}
};

document.addEventListener("DOMContentLoaded", ()=>{
  // Navigation
  const nav=document.getElementById("nav"), burger=document.getElementById("burger"), menu=document.getElementById("mobileMenu"), close=document.getElementById("closeMenu"), prog=document.getElementById("scrollProg");
  window.addEventListener("scroll", ()=>{
    nav.classList.toggle("scrolled", window.scrollY>60);
    prog.style.width = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)*100)+"%";
  });
  burger.addEventListener("click", ()=>menu.classList.add("open"));
  close.addEventListener("click", ()=>menu.classList.remove("open"));
  document.querySelectorAll("[data-close]").forEach(a=>a.addEventListener("click", ()=>menu.classList.remove("open")));

  // Hero Background Slideshow Loop
  const hSlides = [...document.querySelectorAll(".hero_slide")];
  const hDots = [...document.querySelectorAll("#heroDots button")];
  let hIdx = 0;
  if(hSlides.length > 0) {
    function changeHeroSlide(newIdx){
      hSlides[hIdx].classList.remove("active");
      if(hDots[hIdx]) hDots[hIdx].classList.remove("active");
      hIdx = (newIdx + hSlides.length) % hSlides.length;
      hSlides[hIdx].classList.add("active");
      if(hDots[hIdx]) hDots[hIdx].classList.add("active");
    }
    hDots.forEach((btn, i) => btn.addEventListener("click", () => changeHeroSlide(i)));
    setInterval(() => changeHeroSlide(hIdx + 1), 5000);
  }

  // Countdown
  const target = new Date(weddingData.date+"T"+weddingData.time+":00");
  const cD=document.getElementById("cDays"), cH=document.getElementById("cHours"), cM=document.getElementById("cMins"), cS=document.getElementById("cSecs");
  function tick(){
    const diff=target - new Date();
    if(diff<=0) return;
    const d=Math.floor(diff/86400000), h=Math.floor(diff%86400000/3600000), m=Math.floor(diff%3600000/60000), s=Math.floor(diff%60000/1000);
    cD.textContent=String(d).padStart(2,"0"); cH.textContent=String(h).padStart(2,"0"); cM.textContent=String(m).padStart(2,"0"); cS.textContent=String(s).padStart(2,"0");
  }
  tick(); setInterval(tick, 1000);

  // Moments Slider
  const moments = weddingData.moments;
  if(moments.length > 0) {
    const bg=document.getElementById("momentsBg"), img=document.getElementById("momentsImg"), title=document.getElementById("momentsTitle"), cap=document.getElementById("momentsCaption"), name=document.getElementById("momentsName"), counter=document.getElementById("momCounter"), dots=document.getElementById("momDots");
    let idx=0;
    bg.innerHTML=moments.map((m,i)=>`<img src="${m.image_path}" alt="" class="${i===0?'active':''}">`).join("");
    const bgImgs=[...bg.children];
    function renderMom(){
      const m=moments[idx];
      img.src=m.image_path; title.textContent=m.title||''; cap.textContent=m.caption||''; name.textContent=m.credit_name||''; counter.textContent=`${String(idx+1).padStart(2,"0")} / ${String(moments.length).padStart(2,"0")}`;
      bgImgs.forEach((im,i)=>im.classList.toggle("active", i===idx));
      dots.innerHTML=moments.map((_,i)=>`<span class="${i===idx?'active':''}"></span>`).join("");
    }
    document.getElementById("momNext").addEventListener("click", ()=>{idx=(idx+1)%moments.length; renderMom();});
    document.getElementById("momPrev").addEventListener("click", ()=>{idx=(idx-1+moments.length)%moments.length; renderMom();});
    renderMom();
  }

  // Lightbox
  const gallery = weddingData.gallery;
  const lb=document.getElementById("lightbox"), lbImg=document.getElementById("lbImg"), lbCounter=document.getElementById("lbCounter");
  let curG=0;
  document.querySelectorAll(".gallery_item").forEach(el=>{
    el.addEventListener("click", ()=>{
      curG = parseInt(el.dataset.i);
      lbImg.src = gallery[curG].image_path;
      lbCounter.textContent = `${curG+1} / ${gallery.length}`;
      lb.classList.add("open");
    });
  });
  document.getElementById("lbClose").addEventListener("click", ()=>lb.classList.remove("open"));

  // Q&A Accordion
  document.getElementById("qaList").addEventListener("click", e=>{
    const btn=e.target.closest(".qa_q"); if(!btn) return;
    btn.parentElement.classList.toggle("open");
  });

  // Gift Registry Filters & Modal
  const gBtns=document.querySelectorAll(".gf_btn");
  gBtns.forEach(b=>{
    b.addEventListener("click", ()=>{
      gBtns.forEach(x=>x.classList.remove("active")); b.classList.add("active");
      const f=b.dataset.f;
      document.querySelectorAll(".gift_card").forEach(c=>{
        c.style.display = (f==="ALL" || c.dataset.cat===f) ? "block" : "none";
      });
    });
  });

  const gModal=document.getElementById("giftModal");
  document.querySelectorAll(".gift_btn").forEach(b=>{
    b.addEventListener("click", ()=>{
      document.getElementById("giftModalImg").src=b.dataset.img;
      document.getElementById("giftModalCat").textContent=b.dataset.cat;
      document.getElementById("giftModalName").textContent=b.dataset.name;
      document.getElementById("giftModalPrice").textContent=b.dataset.price;
      document.getElementById("giftModalDesc").textContent=b.dataset.desc;
      gModal.classList.add("open");
    });
  });
  document.getElementById("giftModalClose").addEventListener("click", ()=>gModal.classList.remove("open"));
  document.getElementById("giftConfirm").addEventListener("click", ()=>{
    alert("Thank you for your generosity!");
    gModal.classList.remove("open");
  });

  // Reveal Animations
  const io=new IntersectionObserver(es=>{es.forEach(e=>{if(e.isIntersecting) e.target.classList.add("in");});},{threshold:.12});
  document.querySelectorAll(".reveal").forEach(el=>io.observe(el));
});
</script>
@endsection
