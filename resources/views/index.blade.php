@extends('layouts.app')

@section('content')
<nav class="nav" id="nav">
  <a href="#home" class="nav_logo">{{ substr($setting->partner_one ?? 'B', 0, 1) }}&{{ substr($setting->partner_two ?? 'B', 0, 1) }}</a>
  <div class="nav_links" id="navLinks">
    <a href="#home">Home</a>
    <a href="#story">Our Story</a>
    <a href="#wedding">Our Wedding</a>
    <a href="#memories">Memories</a>
    <a href="#qa">Q&A</a>
    <a href="#cash-gift">Cash Gift</a>
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
    <a href="#memories" data-close><span>04</span>Memories</a>
    <a href="#qa" data-close><span>05</span>Q&A</a>
    <a href="#cash-gift" data-close><span>06</span>Cash Gift</a>
    <a href="#rsvp" data-close><span>07</span>RSVP</a>
  </div>
  <div class="mobile_menu_foot">
    <span>{{ $setting->hashtag ?? '#THEGOSPELS26' }}</span>
    <span>{{ \Carbon\Carbon::parse($setting->wedding_date ?? '2026-11-21')->format('M j, Y') }}</span>
  </div>
</div>

<header class="hero" id="home">
  <div class="hero_slides" id="heroSlides">
    <img class="hero_slide active" src="https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=2000&auto=format&fit=crop" alt="Wedding celebration">
    <img class="hero_slide" src="https://images.unsplash.com/photo-1520854221256-17451ccdf07b?q=80&w=2000&auto=format&fit=crop" alt="Wedding celebration">
    <img class="hero_slide" src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=2000&auto=format&fit=crop" alt="Wedding celebration">
    <img class="hero_slide" src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=2000&auto=format&fit=crop" alt="Wedding celebration">
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

@if(filled($setting->family_one) || filled($setting->family_two))
<section class="families_bar" aria-label="Families">
  <div class="families_inner">
    <div class="eyebrow">Together with their families</div>
    <div class="families_grid">
      @if(filled($setting->family_one))<p>{{ $setting->family_one }}</p>@endif
      @if(filled($setting->family_two))<p>{{ $setting->family_two }}</p>@endif
    </div>
  </div>
</section>
@endif

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
        {{ $setting->ceremony_time ?? '11:00 AM' }} prompt<br>
        {{ $setting->venue_name ?? 'ATWIL EVENT CENTER' }} • {{ $setting->city ?? 'Port Harcourt, Rivers State' }}
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
      <div class="gospels_hash reveal">{{ $setting->hashtag ?? '#THEGOSPELS26' }}</div>
      <div class="gospels_quote reveal">One celebration.<br>Two families.<br>A new chapter.</div>
      <p class="body gospels_text reveal">With gratitude to God and the love of their families, Chiamaka and Gospel invite you to celebrate their wedding ceremony.</p>
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
        @if(is_array($setting->story_content) && count($setting->story_content))
          @foreach($setting->story_content as $p)
            <p>{{ $p }}</p>
          @endforeach
        @else
          <p>Chiamaka Boma Ibekwe and Gospel Abina-Aziba MacBenneth Isikpi invite you to celebrate their wedding with their families on Saturday, November 21, 2026.</p>
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
      <div class="video_poster" id="videoPoster" @if($weddingData['podcastUrl']) role="button" tabindex="0" aria-label="Play the couple’s story video" @else aria-disabled="true" tabindex="-1" @endif>
        <img src="https://images.unsplash.com/photo-1529634597503-139d3726fed5?q=80&w=1200&auto=format&fit=crop" alt="How we met poster">
        @if($weddingData['podcastUrl'])
          <div class="video_play"><svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5.14v14l11-7-11-7z"/></svg></div>
        @endif
      </div>
    </div>
    <div class="how_text reveal">
      <div class="eyebrow">Our story, in our own words</div>
      <h3 style="margin-top:16px">THE MOMENT<br><em>it all began</em></h3>
      <p class="body">{{ $setting->podcast_desc ?? 'The families of Chiamaka and Gospel invite you to celebrate their wedding ceremony.' }}</p>
      @if($weddingData['podcastUrl'])
        <p class="body" style="opacity:.7;font-size:13px">The podcast will try to start automatically with sound muted. If your browser blocks autoplay, press play in the YouTube player and unmute there.</p>
        <div class="how_label">Our story, in our own words</div>
      @else
        <p class="body" style="opacity:.7;font-size:13px">The couple’s YouTube podcast will appear here once it is added in wedding settings.</p>
      @endif
    </div>
  </div>
</section>

<section class="moments_cine" id="memories" aria-label="Memories">
  <div class="moments_bg" id="momentsBg"></div>
  <div class="moments_title"><div class="eyebrow">Our memories</div><h2>Little moments, held forever</h2></div>
  @if($moments->isNotEmpty())
  <div class="moments_card_wrap">
    <div class="moments_card" id="momentsCard">
      <img id="momentsImg" src="{{ $moments->first()->image_path }}" alt="{{ $moments->first()->title ?: 'Wedding memory' }}">
      <div class="moments_card_caption">
        <h4 id="momentsTitle">{{ $moments->first()->title }}</h4>
        <p id="momentsCaption">{{ $moments->first()->caption }}</p>
        <div class="moments_card_name" id="momentsName">{{ $moments->first()->credit_name }}</div>
      </div>
    </div>
  </div>
  <div class="moments_nav"><button id="momPrev" type="button" aria-label="Previous memory">←</button><button id="momNext" type="button" aria-label="Next memory">→</button></div>
  <div class="moments_counter"><span id="momCounter">01 / {{ str_pad((string) $moments->count(), 2, '0', STR_PAD_LEFT) }}</span><div class="moments_dots" id="momDots" role="group" aria-label="Choose a memory"></div></div>
  @else
  <div class="memories_empty" role="status">
    <p>Our memory album is taking shape.</p>
    <a href="#gallery">Visit the photo journal</a>
  </div>
  @endif
</section>

<section class="gallery_mason" id="gallery">
  <div class="gallery_head">
    <div><div class="eyebrow">Photo journal</div><h2 class="h2" style="margin-top:12px">A love letter<br><i>in photographs</i></h2></div>
    <div class="body" style="max-width:22em;opacity:.7">A photo journal of the moments Chiamaka and Gospel choose to share with family and friends.</div>
  </div>
  @if($galleries->isNotEmpty())
    <div class="gallery_grid" id="galleryGrid">
      @foreach($galleries as $index => $g)
      <div class="gallery_item" data-i="{{ $index }}">
        <img src="{{ $g->image_path }}" loading="lazy" alt="{{ $g->caption }}">
        <div class="gallery_item_meta"><span>{{ $g->category }} — {{ $g->caption }}</span></div>
      </div>
      @endforeach
    </div>
  @else
    <div class="gallery_empty" role="status">Photos will be added to the journal as they are shared.</div>
  @endif
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
      <p class="body" style="margin-top:20px;opacity:.7">Chiamaka and Gospel would be honoured by your presence as they celebrate with their families.</p>
      @if($setting->order_pdf_path)
        <a class="btn_line" href="{{ $setting->order_pdf_path }}" target="_blank" rel="noopener">Download Order of Service</a>
      @endif
    </div>
    <div class="reveal">
      <div class="wedding_timeline">
        <div class="wt_row">
          <div class="wt_time">{{ $setting->ceremony_time ?: '11:00 AM' }}<div class="wt_label">Ceremony</div></div>
          <div><div class="wt_title">Wedding ceremony</div><div class="wt_desc">Saturday, November 21, 2026 — beginning promptly.</div></div>
        </div>
        <div class="wt_row">
          <div class="wt_time">{{ $setting->reception_time ?: 'To follow' }}<div class="wt_label">Reception</div></div>
          <div><div class="wt_title">Reception</div><div class="wt_desc">Reception to follow the ceremony.</div></div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="venue" id="venue">
  <div class="venue_inner reveal">
    <div class="venue_map">
      <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?q=80&w=1200&auto=format&fit=crop" alt="Decorative map illustration; use the location link for directions">
      <div class="venue_map_overlay"></div>
      <div style="position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);background:var(--warm);padding:12px 16px;border:1px solid var(--line);font-size:10px;letter-spacing:.18em;text-transform:uppercase">
        {{ $setting->venue_name }} • {{ $setting->city }}
      </div>
    </div>
    <div class="venue_info">
      <div class="eyebrow">Venue</div>
      <div class="venue_name">{{ $setting->venue_name }}</div>
      <div class="venue_addr">{!! nl2br(e($weddingData['address'])) !!}<br>{{ $weddingData['city'] }}<br><br>{{ \Carbon\Carbon::parse($setting->wedding_date)->format('F j, Y') }} • {{ $setting->ceremony_time ?: '11:00 AM' }} prompt</div>
      <div class="venue_actions">
        <a class="btn_line" href="{{ $weddingData['mapsUrl'] }}" target="_blank" rel="noopener noreferrer">View location</a>
        <button class="btn_line" id="copyAddrBtn">Copy address</button>
      </div>
    </div>
  </div>
</section>

<section class="dress" id="dresscode">
  <div class="dress_inner">
    <div class="reveal">
      <div class="eyebrow">Dress code</div>
      <h2 class="h2" style="margin-top:12px">{{ $setting->dress_title ?? 'Formal Attire' }}</h2>
      <p class="body" style="margin-top:16px">We invite you to dress in a way that makes you feel your most beautiful. Think timeless, refined, celebratory.</p>
      <div class="dress_note">{{ $setting->dress_note ?: 'Emerald green, beige, gold, and white.' }}</div>
    </div>
    <div class="reveal">
      <div style="font-size:10px;letter-spacing:.22em;text-transform:uppercase;opacity:.6">Suggested palette</div>
      <div class="dress_swatches">
        @foreach($weddingData['dressColors'] as $color)
          <div class="swatch"><div class="swatch_circle" style="background:{{ $color['hex'] }}"></div><span class="swatch_label">{{ $color['name'] }}</span></div>
        @endforeach
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

<section class="cash_gift" id="cash-gift">
  <div class="cash_gift_inner">
    <div class="cash_gift_intro">
      <div>
        <div class="eyebrow">Cash gifts</div>
        <h2 class="h2" style="margin-top:12px">Your presence is<br><i>the greatest gift.</i></h2>
      </div>
      <p class="body">We are grateful to celebrate with you. If you would also like to give a cash gift, you may use the bank details below. There is no obligation.</p>
    </div>
    @if(filled($setting->bank_name) && filled($setting->account_name) && filled($setting->account_number))
      <div class="cash_gift_details" aria-label="Cash gift bank transfer details">
        <div class="cash_gift_item"><span>Bank</span><strong>{{ $setting->bank_name }}</strong></div>
        <div class="cash_gift_item"><span>Account name</span><strong>{{ $setting->account_name }}</strong></div>
        <div class="cash_gift_item"><span>Account number</span><strong id="cashGiftAccount">{{ $setting->account_number }}</strong></div>
      </div>
      <button class="btn_line" type="button" id="copyAccountBtn" data-account="{{ $setting->account_number }}">Copy account number</button>
      @if(filled($setting->cash_gift_note))
        <p class="cash_gift_note">{{ $setting->cash_gift_note }}</p>
      @endif
    @else
      <p class="cash_gift_note" role="status">Bank transfer details will be shared here by the couple.</p>
    @endif
    <p class="cash_gift_disclaimer">Please verify the account name and number before making a transfer. This website does not collect or process payments.</p>
  </div>
</section>

<section class="rsvp" id="rsvp">
  <div class="rsvp_inner">
    <div class="eyebrow" style="color:rgba(252,251,247,.6)">RSVP</div>
    <h2 class="h2" style="color:var(--warm);margin-top:12px">Will you celebrate<br><i>with us?</i></h2>
    <p class="body" style="margin:16px auto 0;opacity:.7;color:var(--ivory)">Kindly respond by {{ $weddingData['rsvpDeadline'] ?? 'November 7, 2026' }}.</p>
    <form class="rsvp_form" id="rsvpForm" action="{{ route('rsvp.store') }}" method="POST">
      @csrf
      <div class="rsvp_field"><label for="rsvpName">Full name</label><input id="rsvpName" required name="name" value="{{ old('name') }}" placeholder="Your full name" autocomplete="name" maxlength="255"></div>
      <div class="rsvp_field"><label for="rsvpPhone">Phone number</label><input id="rsvpPhone" required type="tel" name="phone" value="{{ old('phone') }}" placeholder="+234..." autocomplete="tel" inputmode="tel" maxlength="50"></div>
      <button class="rsvp_submit" type="submit">Confirm my RSVP</button>
    </form>
    @if($weddingData['whatsappUrl'])
      <a class="rsvp_whatsapp" href="{{ $weddingData['whatsappUrl'] }}" target="_blank" rel="noopener noreferrer">Prefer WhatsApp? Message {{ $weddingData['whatsappPhone'] }}</a>
    @endif
  </div>
</section>

<section class="guestbook" id="guestbook">
  <div class="gb_inner">
    <div><div class="eyebrow">Guestbook</div><h2 class="h2" style="margin-top:12px;font-size:36px">Leave us<br><i>a note</i></h2></div>
    <div>
      <div class="gb_list" id="gbList">
        @forelse($guestbooks as $gb)
        <div class="gb_card"><div class="gb_msg">"{{ $gb->message }}"</div><div class="gb_name">— {{ $gb->name }}</div></div>
        @empty
        <p class="gb_empty" role="status">Be the first to leave a message. Notes appear here after approval.</p>
        @endforelse
      </div>
      <form class="gb_form" id="gbForm" action="{{ route('guestbook.store') }}" method="POST">
        @csrf
        <h4>Write a message</h4>
        <div class="rsvp_field" style="margin-top:16px"><label>Your name</label><input name="name" value="{{ old('name') }}" required maxlength="255" placeholder="Name" autocomplete="name"></div>
        <div class="rsvp_field" style="margin-top:12px"><label>Message</label><textarea name="message" rows="3" maxlength="2000" required placeholder="May your home always be...">{{ old('message') }}</textarea></div>
        <button class="btn_line" style="width:100%;margin-top:16px;justify-content:center" type="submit">Post note</button>
      </form>
    </div>
  </div>
</section>

<footer class="footer">
  <div class="footer_inner">
    <div class="footer_top">
      <div class="footer_brand">THE<br>GOSPELS</div>
      <div>
        <div style="font-size:10px;letter-spacing:.22em;text-transform:uppercase;opacity:.6;margin-bottom:16px">{{ $setting->hashtag }} — {{ \Carbon\Carbon::parse($setting->wedding_date)->format('F j, Y') }}</div>
        <div class="footer_nav">
          <a href="#story">Our story</a><a href="#wedding">Our wedding</a><a href="#memories">Memories</a><a href="#qa">Q&A</a><a href="#cash-gift">Cash gift</a><a href="{{ route('admin.dashboard') }}">Admin</a>
        </div>
      </div>
    </div>
    <div class="footer_bottom"><span>With love, {{ $setting->partner_one }} & {{ $setting->partner_two }}</span><span>{{ $weddingData['city'] }} • Crafted with care</span></div>
  </div>
</footer>

@if($setting->background_music_enabled && $setting->background_music_path)
<div class="music_player" id="musicPlayer">
  <audio id="backgroundMusic" src="{{ $setting->background_music_path }}" autoplay loop preload="auto" aria-label="Wedding background music"></audio>
  <button class="music_toggle" id="musicToggle" type="button" aria-pressed="false" aria-label="Play background music">
    <span class="music_icon" aria-hidden="true">♫</span><span id="musicButtonText">Play Music</span>
  </button>
  <span class="music_status" id="musicStatus" role="status" aria-live="polite">Trying autoplay. If blocked, tap Play Music.</span>
</div>
@endif

<script>
const weddingData = @js($weddingData);

document.addEventListener("DOMContentLoaded", () => {
  const nav = document.getElementById("nav");
  const burger = document.getElementById("burger");
  const menu = document.getElementById("mobileMenu");
  const closeMenu = document.getElementById("closeMenu");
  const progress = document.getElementById("scrollProg");

  const closeMobileMenu = () => menu?.classList.remove("open");
  const updateScroll = () => {
    nav?.classList.toggle("scrolled", window.scrollY > 60);
    const scrollable = document.documentElement.scrollHeight - window.innerHeight;
    if (progress) progress.style.width = `${scrollable > 0 ? (window.scrollY / scrollable) * 100 : 0}%`;
  };
  window.addEventListener("scroll", updateScroll, { passive: true });
  updateScroll();
  burger?.addEventListener("click", () => menu?.classList.add("open"));
  closeMenu?.addEventListener("click", closeMobileMenu);
  document.querySelectorAll("[data-close]").forEach(link => link.addEventListener("click", closeMobileMenu));

  // Hero slideshow.
  const heroSlides = [...document.querySelectorAll(".hero_slide")];
  const heroDots = [...document.querySelectorAll("#heroDots button")];
  let heroIndex = 0;
  if (heroSlides.length > 1) {
    const changeHeroSlide = index => {
      heroSlides[heroIndex]?.classList.remove("active");
      heroDots[heroIndex]?.classList.remove("active");
      heroIndex = (index + heroSlides.length) % heroSlides.length;
      heroSlides[heroIndex].classList.add("active");
      heroDots[heroIndex]?.classList.add("active");
    };
    heroDots.forEach((button, index) => button.addEventListener("click", () => changeHeroSlide(index)));
    window.setInterval(() => changeHeroSlide(heroIndex + 1), 5000);
  }

  // Event countdown uses the wedding's configured timezone, not the visitor's local timezone.
  const countdown = document.getElementById("countGrid");
  const target = new Date(weddingData.dateTime);
  const tick = () => {
    if (!Number.isFinite(target.getTime())) {
      if (countdown) countdown.textContent = "Event date to be confirmed.";
      return false;
    }

    const difference = target.getTime() - Date.now();
    if (difference <= 0) {
      if (countdown) countdown.innerHTML = '<div class="count_past">The celebration has taken place.<br>Thank you for being part of our story.</div>';
      return false;
    }

    const values = {
      cDays: Math.floor(difference / 86400000),
      cHours: Math.floor((difference % 86400000) / 3600000),
      cMins: Math.floor((difference % 3600000) / 60000),
      cSecs: Math.floor((difference % 60000) / 1000),
    };
    Object.entries(values).forEach(([id, value]) => {
      const element = document.getElementById(id);
      if (element) element.textContent = String(value).padStart(2, "0");
    });
    return true;
  };
  if (tick()) {
    const timer = window.setInterval(() => {
      if (!tick()) window.clearInterval(timer);
    }, 1000);
  }

  // Moments carousel and dot navigation.
  const moments = Array.isArray(weddingData.moments) ? weddingData.moments : [];
  if (moments.length) {
    const bg = document.getElementById("momentsBg");
    const image = document.getElementById("momentsImg");
    const title = document.getElementById("momentsTitle");
    const caption = document.getElementById("momentsCaption");
    const credit = document.getElementById("momentsName");
    const counter = document.getElementById("momCounter");
    const dots = document.getElementById("momDots");
    let index = 0;

    bg.innerHTML = moments.map((moment, i) => `<img src="${moment.image_path}" alt="" class="${i === 0 ? "active" : ""}">`).join("");
    const backgroundImages = [...bg.children];
    const renderMoment = () => {
      const moment = moments[index];
      image.src = moment.image_path;
      image.alt = moment.title || "Wedding moment";
      title.textContent = moment.title || "";
      caption.textContent = moment.caption || "";
      credit.textContent = moment.credit_name || "";
      counter.textContent = `${String(index + 1).padStart(2, "0")} / ${String(moments.length).padStart(2, "0")}`;
      backgroundImages.forEach((item, i) => item.classList.toggle("active", i === index));
      dots.innerHTML = moments.map((_, i) => `<button type="button" class="${i === index ? "active" : ""}" data-index="${i}" aria-label="Show moment ${i + 1}"></button>`).join("");
    };

    document.getElementById("momNext")?.addEventListener("click", () => {
      index = (index + 1) % moments.length;
      renderMoment();
    });
    document.getElementById("momPrev")?.addEventListener("click", () => {
      index = (index - 1 + moments.length) % moments.length;
      renderMoment();
    });
    dots.addEventListener("click", event => {
      const button = event.target.closest("button[data-index]");
      if (!button) return;
      index = Number(button.dataset.index);
      renderMoment();
    });
    renderMoment();
  }

  // Accessible gallery lightbox with previous/next, keyboard, and backdrop support.
  const gallery = Array.isArray(weddingData.gallery) ? weddingData.gallery : [];
  const lightbox = document.getElementById("lightbox");
  const lightboxImage = document.getElementById("lbImg");
  const lightboxCounter = document.getElementById("lbCounter");
  let galleryIndex = 0;
  const renderGalleryImage = () => {
    const item = gallery[galleryIndex];
    if (!item) return;
    lightboxImage.src = item.image_path;
    lightboxImage.alt = item.caption || "Wedding gallery photo";
    lightboxCounter.textContent = `${galleryIndex + 1} / ${gallery.length}`;
  };
  const openLightbox = index => {
    if (!gallery.length) return;
    galleryIndex = (index + gallery.length) % gallery.length;
    renderGalleryImage();
    lightbox.classList.add("open");
    document.body.style.overflow = "hidden";
  };
  const closeLightbox = () => {
    lightbox.classList.remove("open");
    document.body.style.overflow = "";
  };
  const moveLightbox = direction => {
    if (!gallery.length) return;
    galleryIndex = (galleryIndex + direction + gallery.length) % gallery.length;
    renderGalleryImage();
  };
  document.querySelectorAll(".gallery_item").forEach(item => {
    item.addEventListener("click", () => openLightbox(Number(item.dataset.i)));
  });
  document.getElementById("lbClose")?.addEventListener("click", closeLightbox);
  document.getElementById("lbPrev")?.addEventListener("click", () => moveLightbox(-1));
  document.getElementById("lbNext")?.addEventListener("click", () => moveLightbox(1));
  lightbox.addEventListener("click", event => {
    if (event.target === lightbox) closeLightbox();
  });

  // Background music attempts autoplay, with a prominent manual control when blocked.
  const backgroundMusic = document.getElementById("backgroundMusic");
  const musicToggle = document.getElementById("musicToggle");
  const musicButtonText = document.getElementById("musicButtonText");
  const musicStatus = document.getElementById("musicStatus");
  let musicPauseReason = null;
  const updateMusicState = () => {
    if (!backgroundMusic || !musicToggle) return;
    const isPlaying = !backgroundMusic.paused;
    musicToggle.setAttribute("aria-pressed", String(isPlaying));
    musicToggle.setAttribute("aria-label", isPlaying ? "Pause background music" : "Play background music");
    musicButtonText.textContent = isPlaying ? "Pause Music" : "Play Music";
    musicStatus.textContent = isPlaying ? "Background music is playing." : (musicPauseReason || "Background music is paused.");
  };
  const pauseMusicForPodcast = () => {
    if (!backgroundMusic) return;
    musicPauseReason = "Background music paused while the podcast starts.";
    backgroundMusic.pause();
    musicStatus.textContent = musicPauseReason;
  };
  if (backgroundMusic && musicToggle) {
    backgroundMusic.volume = 0.35;
    backgroundMusic.addEventListener("play", updateMusicState);
    backgroundMusic.addEventListener("pause", updateMusicState);
    backgroundMusic.addEventListener("error", () => {
      musicStatus.textContent = "The background music file could not be loaded.";
      musicToggle.disabled = true;
    });
    backgroundMusic.play().catch(() => {
      musicStatus.textContent = "Autoplay was blocked. Tap Play Music to start.";
    });
    musicToggle.addEventListener("click", async () => {
      musicPauseReason = null;
      if (!backgroundMusic.paused) {
        backgroundMusic.pause();
        return;
      }
      try {
        await backgroundMusic.play();
      } catch {
        musicStatus.textContent = "Music could not start. Please check your browser's media settings.";
      }
    });
  }

  // YouTube attempts muted autoplay; browser policy or visitor settings may still require a manual tap.
  const videoPoster = document.getElementById("videoPoster");
  if (videoPoster && weddingData.podcastUrl) {
    const iframe = document.createElement("iframe");
    iframe.src = `${weddingData.podcastUrl}?autoplay=1&mute=1&playsinline=1&controls=1&rel=0`;
    iframe.title = `How ${weddingData.partnerOne} and ${weddingData.partnerTwo} met`;
    iframe.allow = "autoplay; encrypted-media; picture-in-picture; web-share";
    iframe.allowFullscreen = true;
    iframe.referrerPolicy = "strict-origin-when-cross-origin";
    pauseMusicForPodcast();
    iframe.addEventListener("load", pauseMusicForPodcast, { once: true });
    videoPoster.replaceWith(iframe);
  } else if (videoPoster) {
    videoPoster.setAttribute("aria-disabled", "true");
    videoPoster.querySelector(".video_play")?.remove();
  }

  // Q&A accordion.
  document.getElementById("qaList")?.addEventListener("click", event => {
    const button = event.target.closest(".qa_q");
    if (button) button.parentElement.classList.toggle("open");
  });

  // Copy bank transfer details without sending payment information anywhere.
  const copyAccountButton = document.getElementById("copyAccountBtn");
  copyAccountButton?.addEventListener("click", async () => {
    try {
      await copyText(copyAccountButton.dataset.account || "");
      showTemporaryLabel(copyAccountButton, "Copied!");
    } catch {
      showTemporaryLabel(copyAccountButton, "Copy unavailable");
    }
  });

  // Copy, share, calendar download, and venue address helpers.
  const copyText = async text => {
    if (navigator.clipboard && window.isSecureContext) {
      await navigator.clipboard.writeText(text);
      return;
    }
    const input = document.createElement("textarea");
    input.value = text;
    input.setAttribute("readonly", "");
    input.style.position = "fixed";
    input.style.opacity = "0";
    document.body.appendChild(input);
    input.select();
    const copied = document.execCommand("copy");
    input.remove();
    if (!copied) throw new Error("Clipboard access is unavailable.");
  };
  const showTemporaryLabel = (button, label) => {
    if (!button) return;
    const original = button.textContent;
    button.textContent = label;
    window.setTimeout(() => { button.textContent = original; }, 2000);
  };
  const copyLinkButton = document.getElementById("copyLinkBtn");
  copyLinkButton?.addEventListener("click", async () => {
    try {
      await copyText(window.location.href);
      showTemporaryLabel(copyLinkButton, "Copied!");
    } catch {
      showTemporaryLabel(copyLinkButton, "Copy unavailable");
    }
  });
  const shareButton = document.getElementById("shareBtn");
  shareButton?.addEventListener("click", async () => {
    const shareData = {
      title: `${weddingData.partnerOne} & ${weddingData.partnerTwo} | ${weddingData.hashtag}`,
      text: `Join us on ${weddingData.date}`,
      url: window.location.href,
    };
    try {
      if (navigator.share) await navigator.share(shareData);
      else {
        await copyText(shareData.url);
        showTemporaryLabel(shareButton, "Link copied");
      }
    } catch {
      showTemporaryLabel(shareButton, "Share unavailable");
    }
  });
  const calendarButton = document.getElementById("addCalBtn");
  calendarButton?.addEventListener("click", () => {
    const start = new Date(weddingData.dateTime);
    if (!Number.isFinite(start.getTime())) return;
    const end = new Date(start.getTime() + 6 * 60 * 60 * 1000);
    const formatIcsDate = date => date.toISOString().replace(/[-:]/g, "").replace(/\.\d{3}Z$/, "Z");
    const escapeIcs = value => String(value || "").replace(/\\/g, "\\\\").replace(/\r?\n/g, "\\n").replace(/,/g, "\\,").replace(/;/g, "\\;");
    const ics = [
      "BEGIN:VCALENDAR",
      "VERSION:2.0",
      "PRODID:-//With the Gospels//Wedding//EN",
      "CALSCALE:GREGORIAN",
      "BEGIN:VEVENT",
      `DTSTAMP:${formatIcsDate(new Date())}`,
      `DTSTART:${formatIcsDate(start)}`,
      `DTEND:${formatIcsDate(end)}`,
      `SUMMARY:${escapeIcs(`${weddingData.partnerOne} & ${weddingData.partnerTwo} Wedding`)}`,
      `LOCATION:${escapeIcs([weddingData.venue, weddingData.address, weddingData.city].filter(Boolean).join(", "))}`,
      `DESCRIPTION:${escapeIcs(weddingData.hashtag)}`,
      "END:VEVENT",
      "END:VCALENDAR",
      "",
    ].join("\r\n");
    const objectUrl = URL.createObjectURL(new Blob([ics], { type: "text/calendar;charset=utf-8" }));
    const link = document.createElement("a");
    link.href = objectUrl;
    link.download = "wedding.ics";
    link.click();
    window.setTimeout(() => URL.revokeObjectURL(objectUrl), 1000);
  });
  const addressButton = document.getElementById("copyAddrBtn");
  addressButton?.addEventListener("click", async () => {
    const address = [weddingData.venue, weddingData.address, weddingData.city].filter(Boolean).join(", ");
    try {
      await copyText(address);
      showTemporaryLabel(addressButton, "Copied!");
    } catch {
      showTemporaryLabel(addressButton, "Copy unavailable");
    }
  });

  document.addEventListener("keydown", event => {
    if (event.key === "Escape") {
      closeMobileMenu();
      if (lightbox.classList.contains("open")) closeLightbox();
    }
    if (lightbox.classList.contains("open") && event.key === "ArrowRight") moveLightbox(1);
    if (lightbox.classList.contains("open") && event.key === "ArrowLeft") moveLightbox(-1);
  });

  // Scroll reveals, with a no-JS fallback in CSS.
  if ("IntersectionObserver" in window) {
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("in");
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });
    document.querySelectorAll(".reveal").forEach(element => observer.observe(element));
  } else {
    document.querySelectorAll(".reveal").forEach(element => element.classList.add("in"));
  }
});
</script>
@endsection
