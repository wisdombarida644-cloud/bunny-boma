@extends('layouts.app')

@section('content')
<nav class="nav" id="nav">
  <a href="#home" class="nav_logo" aria-label="With the Gospels home"><img src="{{ asset('images/thegospels-wordmark.jpg') }}" alt="" width="900" height="251" fetchpriority="high"></a>
  <div class="nav_links" id="navLinks">
    <a href="#home">Home</a>
    <a href="#story">Our Story</a>
    <a href="#wedding">Our Wedding</a>
    <a href="#memories">Memories</a>
    <a href="#qa">Q&A</a>
    <a href="#wishes">Wishes</a>
    <a href="#cash-gift">Cash Gift</a>
  </div>
  <div class="nav_right">
    <button class="theme_toggle" id="themeToggle" type="button" aria-label="Switch to dark mode" aria-pressed="false" title="Switch to dark mode">
      <svg class="theme_icon_moon" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 14.1A8.7 8.7 0 0 1 9.9 3.2a8.8 8.8 0 1 0 10.9 10.9Z"/></svg>
      <svg class="theme_icon_sun" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2m0 16v2M4.93 4.93l1.42 1.42m11.3 11.3 1.42 1.42M2 12h2m16 0h2M4.93 19.07l1.42-1.42m11.3-11.3 1.42-1.42"/></svg>
    </button>
    <a href="#rsvp" class="nav_cta">RSVP</a>
    <button class="nav_burger" id="burger" type="button" aria-label="Open menu" aria-controls="mobileMenu" aria-expanded="false"><span></span><span></span><span></span></button>
  </div>
</nav>

<div class="mobile_menu" id="mobileMenu">
  <div class="mobile_menu_top">
    <div class="nav_logo"><img src="{{ asset('images/thegospels-wordmark.jpg') }}" alt="The Gospels logo" width="900" height="251"></div>
    <button id="closeMenu" aria-label="Close">✕</button>
  </div>
  <div class="mobile_menu_links">
    <a href="#home" data-close><span>01</span>Home</a>
    <a href="#story" data-close><span>02</span>Our Story</a>
    <a href="#wedding" data-close><span>03</span>Our Wedding</a>
    <a href="#memories" data-close><span>04</span>Memories</a>
    <a href="#qa" data-close><span>05</span>Q&A</a>
    <a href="#wishes" data-close><span>06</span>Wishes</a>
    <a href="#cash-gift" data-close><span>07</span>Cash Gift</a>
    <a href="#rsvp" data-close><span>08</span>RSVP</a>
  </div>
  <div class="mobile_menu_foot">
    <span>{{ $setting->hashtag ?? '#THEGOSPELS26' }}</span>
    <span>{{ \Carbon\Carbon::parse($setting->wedding_date ?? '2026-11-21')->format('M j, Y') }}</span>
  </div>
</div>

@php
  $heroPhotos = $heroBackgroundPhotos->take(8)->values();
  $heroSidePhotos = $heroPhotos->take(2)->values();
  $heroSidePhotosReversed = $heroSidePhotos->reverse()->values();
  $partnerOneParts = preg_split('/\s+/u', trim((string) ($setting->partner_one ?? '')), -1, PREG_SPLIT_NO_EMPTY) ?: [];
  $partnerTwoParts = preg_split('/\s+/u', trim((string) ($setting->partner_two ?? '')), -1, PREG_SPLIT_NO_EMPTY) ?: [];
  $partnerOneFirst = array_shift($partnerOneParts) ?: ($setting->partner_one ?? '');
  $partnerTwoFirst = array_shift($partnerTwoParts) ?: ($setting->partner_two ?? '');
@endphp
<header class="hero" id="home">
  <div class="hero_triptych" aria-hidden="true">
    <div class="hero_panel hero_panel--left">
      @if($heroSidePhotos->isNotEmpty())
        <div class="hero_track hero_track--up" style="--hero-photo-count:{{ $heroSidePhotos->count() }}">
          @for($repeat = 0; $repeat < 2; $repeat++)
            <div class="hero_track_group">
              @foreach($heroSidePhotos as $photo)
                <img class="hero_photo_tile" src="{{ $photo->image_path }}" alt="" decoding="async" loading="lazy" fetchpriority="low">
              @endforeach
            </div>
          @endfor
        </div>
      @endif
    </div>
    <div class="hero_panel hero_panel--center">
      @if($heroPhotos->isNotEmpty())
        <div class="hero_center_stack">
          @foreach($heroPhotos as $photo)
            <img class="hero_center_image {{ $loop->first ? 'is-active' : '' }}" data-hero-center-slide @if($loop->first) src="{{ $photo->image_path }}" fetchpriority="high" loading="eager" @else data-hero-src="{{ $photo->image_path }}" fetchpriority="low" loading="lazy" @endif alt="" decoding="async">
          @endforeach
          <div class="hero_center_empty" data-hero-image-fallback hidden>
            <span class="hero_empty_monogram">{{ substr($setting->partner_one ?? 'C', 0, 1) }}<i>&amp;</i>{{ substr($setting->partner_two ?? 'G', 0, 1) }}</span>
            <span class="hero_empty_label">Our story begins here</span>
          </div>
        </div>
      @else
        <div class="hero_center_empty">
          <span class="hero_empty_monogram">{{ substr($setting->partner_one ?? 'C', 0, 1) }}<i>&amp;</i>{{ substr($setting->partner_two ?? 'G', 0, 1) }}</span>
          <span class="hero_empty_label">Our story begins here</span>
        </div>
      @endif
    </div>
    <div class="hero_panel hero_panel--right">
      @if($heroSidePhotosReversed->isNotEmpty())
        <div class="hero_track hero_track--down" style="--hero-photo-count:{{ $heroSidePhotosReversed->count() }}">
          @for($repeat = 0; $repeat < 2; $repeat++)
            <div class="hero_track_group">
              @foreach($heroSidePhotosReversed as $photo)
                <img class="hero_photo_tile" src="{{ $photo->image_path }}" alt="" decoding="async" loading="lazy" fetchpriority="low">
              @endforeach
            </div>
          @endfor
        </div>
      @endif
    </div>
  </div>
  <div class="hero_atmosphere" aria-hidden="true"></div>

  <div class="hero_inner">
    <div class="hero_content">
      <p class="hero_kicker">A celebration of love &amp; family</p>
      <h1 class="hero_title">
        <span class="hero_name hero_name--one">
          <span class="hero_first_name">{{ $partnerOneFirst }}</span>
          @if(count($partnerOneParts))<span class="hero_remainder">{{ implode(' ', $partnerOneParts) }}</span>@endif
        </span>
        <em class="hero_ampersand" aria-label="and">&amp;</em>
        <span class="hero_name hero_name--two">
          <span class="hero_first_name">{{ $partnerTwoFirst }}</span>
          @if(count($partnerTwoParts))<span class="hero_remainder">{{ implode(' ', $partnerTwoParts) }}</span>@endif
        </span>
      </h1>
      <p class="hero_intro">Two lives, one beautiful story. Join us as we celebrate the start of forever.</p>
      <div class="hero_meta">
        <span class="hero_date">{{ \Carbon\Carbon::parse($setting->wedding_date)->format('l') }}</span>
        <span class="hero_meta_dot" aria-hidden="true">·</span>
        <span class="hero_date">{{ \Carbon\Carbon::parse($setting->wedding_date)->format('F j, Y') }}</span>
      </div>
      <p class="hero_venue_line">{{ $setting->venue_name }} <span aria-hidden="true">·</span> {{ $setting->city }}</p>
      <div class="hero_footer_line">
        <span class="hero_hash">{{ $setting->hashtag }}</span>
        <a class="hero_story_link" href="#story">Discover our story <span aria-hidden="true">↘</span></a>
      </div>
    </div>
  </div>
  <a class="hero_scroll" href="#story"><span>Scroll to discover</span></a>
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
      @if($galleries->isNotEmpty())
        <img src="{{ $galleries->first()->image_path }}" alt="{{ $galleries->first()->caption ?: 'Wedding photo shared by the couple' }}" loading="lazy">
      @else
        <div class="photo_placeholder"><span>Couple’s photos will appear here after upload.</span></div>
      @endif
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
      <div class="story_image_main">
        @if($galleries->isNotEmpty())
          <img src="{{ $galleries->first()->image_path }}" alt="{{ $galleries->first()->caption ?: 'Wedding photo shared by the couple' }}" loading="lazy">
        @else
          <div class="photo_placeholder"><span>Wedding photos will be shared here by the couple.</span></div>
        @endif
      </div>
      <div class="story_image_side">
        @if($galleries->count() > 1)
          <img src="{{ $galleries->get(1)->image_path }}" alt="{{ $galleries->get(1)->caption ?: 'Wedding photo shared by the couple' }}" loading="lazy">
        @else
          <div class="photo_placeholder"><span>More photos will appear here.</span></div>
        @endif
      </div>
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
        @if($galleries->isNotEmpty())
          @php($storyPoster = $galleries->get(2) ?? $galleries->first())
          <img src="{{ $storyPoster->image_path }}" alt="{{ $storyPoster->caption ?: 'Photo shared by the couple' }}" loading="lazy">
        @else
          <div class="photo_placeholder"><span>The couple’s story will appear here when added.</span></div>
        @endif
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
      <img id="momentsImg" src="{{ $moments->first()->image_path }}" alt="{{ $moments->first()->title ?: 'Wedding memory' }}" loading="lazy" decoding="async">
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
    <div class="venue_map" role="img" aria-label="Venue location card; use View location for directions">
      <div class="venue_map_pattern" aria-hidden="true"></div>
      <div class="venue_map_label">{{ $setting->venue_name }} • {{ $setting->city }}</div>
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
    <div class="mc_img reveal"><img src="{{ $mc->image_path }}" alt="{{ $mc->name }}" loading="lazy" decoding="async"></div>
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
    @if(session('rsvp_success'))
      <p class="rsvp_confirmation" role="status" aria-live="polite">{{ session('rsvp_success') }}</p>
    @endif
    <p class="body" style="margin:16px auto 0;opacity:.7;color:var(--ivory)">Kindly respond by {{ $weddingData['rsvpDeadline'] ?? 'November 7, 2026' }}.</p>
    <form class="rsvp_form" id="rsvpForm" action="{{ route('rsvp.store') }}" method="POST">
      @csrf
      <div class="rsvp_field">
        <label for="rsvpName">Full name</label>
        <input id="rsvpName" required name="name" value="{{ $errors->hasBag('rsvp') ? old('name') : '' }}" placeholder="Your full name" autocomplete="name" maxlength="255" aria-invalid="{{ $errors->hasBag('rsvp') && $errors->getBag('rsvp')->has('name') ? 'true' : 'false' }}" @if($errors->hasBag('rsvp') && $errors->getBag('rsvp')->has('name')) aria-describedby="rsvpNameError" @endif>
        @error('name', 'rsvp')<small class="rsvp_field_error" id="rsvpNameError">{{ $message }}</small>@enderror
      </div>
      <div class="rsvp_field">
        <label for="rsvpPhone">Phone number</label>
        <input id="rsvpPhone" required type="tel" name="phone" value="{{ $errors->hasBag('rsvp') ? old('phone') : '' }}" placeholder="+234..." autocomplete="tel" inputmode="tel" maxlength="50" aria-invalid="{{ $errors->hasBag('rsvp') && $errors->getBag('rsvp')->has('phone') ? 'true' : 'false' }}" @if($errors->hasBag('rsvp') && $errors->getBag('rsvp')->has('phone')) aria-describedby="rsvpPhoneError" @endif>
        @error('phone', 'rsvp')<small class="rsvp_field_error" id="rsvpPhoneError">{{ $message }}</small>@enderror
      </div>
      <button class="rsvp_submit" type="submit">Confirm my RSVP</button>
    </form>
    @if($weddingData['whatsappUrl'])
      <a class="rsvp_whatsapp" href="{{ $weddingData['whatsappUrl'] }}" target="_blank" rel="noopener noreferrer">Prefer WhatsApp? Message {{ $weddingData['whatsappPhone'] }}</a>
    @endif
  </div>
</section>

<section class="guestbook" id="wishes" aria-labelledby="wishesHeading">
  <div class="gb_inner">
    <div>
      <div class="eyebrow">Wishes from our people</div>
      <h2 class="h2" id="wishesHeading" style="margin-top:12px;font-size:36px">Send us<br><i>your wishes</i></h2>
      <p class="gb_intro">Leave a blessing, a memory, or a few kind words for the couple.</p>
    </div>
    <div>
      <div class="gb_list" id="wishesList">
        @forelse($guestbooks as $gb)
        <article class="gb_card"><div class="gb_msg">“{{ $gb->message }}”</div><div class="gb_name">— {{ $gb->name }}</div></article>
        @empty
        <p class="gb_empty" role="status">Be the first to send a wish. Approved wishes will appear here.</p>
        @endforelse
      </div>
      <form class="gb_form" id="wishForm" action="{{ route('guestbook.store') }}" method="POST">
        @csrf
        <h4>Leave a wish for the couple</h4>
        <div class="rsvp_field" style="margin-top:16px">
          <label for="wishName">Your name</label>
          <input id="wishName" name="name" value="{{ $errors->hasBag('wishes') ? old('name') : '' }}" required maxlength="255" placeholder="Name" autocomplete="name" aria-invalid="{{ $errors->hasBag('wishes') && $errors->getBag('wishes')->has('name') ? 'true' : 'false' }}" @if($errors->hasBag('wishes') && $errors->getBag('wishes')->has('name')) aria-describedby="wishNameError" @endif>
          @error('name', 'wishes')<small class="gb_error" id="wishNameError">{{ $message }}</small>@enderror
        </div>
        <div class="rsvp_field" style="margin-top:12px">
          <label for="wishMessage">Your wish</label>
          <textarea id="wishMessage" name="message" rows="3" maxlength="2000" required placeholder="May your home always be..." aria-invalid="{{ $errors->hasBag('wishes') && $errors->getBag('wishes')->has('message') ? 'true' : 'false' }}" @if($errors->hasBag('wishes') && $errors->getBag('wishes')->has('message')) aria-describedby="wishMessageError" @endif>{{ $errors->hasBag('wishes') ? old('message') : '' }}</textarea>
          @error('message', 'wishes')<small class="gb_error" id="wishMessageError">{{ $message }}</small>@enderror
        </div>
        <button class="btn_line gb_submit" style="width:100%;margin-top:16px;justify-content:center" type="submit">Send your wish</button>
      </form>
    </div>
  </div>
</section>

<footer class="footer">
  <div class="footer_inner">
    <div class="footer_top">
      <div class="footer_brand"><img src="{{ asset('images/thegospels-wordmark.jpg') }}" alt="The Gospels logo" width="900" height="251" loading="lazy" decoding="async"></div>
      <div>
        <div style="font-size:10px;letter-spacing:.22em;text-transform:uppercase;opacity:.6;margin-bottom:16px">{{ $setting->hashtag }} — {{ \Carbon\Carbon::parse($setting->wedding_date)->format('F j, Y') }}</div>
        <div class="footer_nav">
          <a href="#story">Our story</a><a href="#wedding">Our wedding</a><a href="#memories">Memories</a><a href="#qa">Q&A</a><a href="#wishes">Wishes</a><a href="#cash-gift">Cash gift</a><a href="{{ route('admin.dashboard') }}">Admin</a>
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
  const themeToggle = document.getElementById("themeToggle");
  const setTheme = theme => {
    document.documentElement.dataset.theme = theme;
    const isDark = theme === "dark";
    themeToggle?.setAttribute("aria-pressed", String(isDark));
    themeToggle?.setAttribute("aria-label", isDark ? "Switch to light mode" : "Switch to dark mode");
    themeToggle?.setAttribute("title", isDark ? "Switch to light mode" : "Switch to dark mode");
  };
  let savedTheme = "light";
  try {
    savedTheme = localStorage.getItem("the-gospels-theme") === "dark" ? "dark" : "light";
  } catch (_) {}
  setTheme(savedTheme);
  themeToggle?.addEventListener("click", () => {
    const nextTheme = document.documentElement.dataset.theme === "dark" ? "light" : "dark";
    setTheme(nextTheme);
    try { localStorage.setItem("the-gospels-theme", nextTheme); } catch (_) {}
  });

  const setMobileMenuOpen = isOpen => {
    menu?.classList.toggle("open", isOpen);
    burger?.setAttribute("aria-expanded", String(isOpen));
    burger?.setAttribute("aria-label", isOpen ? "Close menu" : "Open menu");
    document.body.classList.toggle("menu-open", isOpen);
  };
  const closeMobileMenu = () => setMobileMenuOpen(false);
  const updateScroll = () => {
    nav?.classList.toggle("scrolled", window.scrollY > 60);
    const scrollable = document.documentElement.scrollHeight - window.innerHeight;
    if (progress) progress.style.width = `${scrollable > 0 ? (window.scrollY / scrollable) * 100 : 0}%`;
  };
  window.addEventListener("scroll", updateScroll, { passive: true });
  updateScroll();
  burger?.addEventListener("click", () => setMobileMenuOpen(!menu?.classList.contains("open")));
  closeMenu?.addEventListener("click", closeMobileMenu);
  document.querySelectorAll("[data-close]").forEach(link => link.addEventListener("click", closeMobileMenu));

  const rsvpForm = document.getElementById("rsvpForm");
  const rsvpSubmit = rsvpForm?.querySelector("button[type=submit]");
  rsvpForm?.addEventListener("submit", event => {
    if (!rsvpForm.checkValidity() || !rsvpSubmit) return;
    if (rsvpSubmit.disabled) {
      event.preventDefault();
      return;
    }
    rsvpSubmit.disabled = true;
    rsvpSubmit.textContent = "Submitting…";
  });

  // The desktop hero keeps its triptych; center slides load only as the carousel advances.
  const reduceMotion = window.matchMedia ? window.matchMedia("(prefers-reduced-motion: reduce)").matches : false;
  const heroCenterSlides = Array.from(document.querySelectorAll("[data-hero-center-slide]"));
  const heroImageFallback = document.querySelector("[data-hero-image-fallback]");
  let activeHeroSlide = Math.max(heroCenterSlides.findIndex(slide => slide.classList.contains("is-active")), 0);
  heroCenterSlides.forEach((slide, index) => slide.classList.toggle("is-active", index === activeHeroSlide));
  let heroSlideLoading = false;
  heroCenterSlides[0]?.addEventListener("error", () => {
    heroCenterSlides[0].remove();
    heroImageFallback?.removeAttribute("hidden");
  }, { once: true });
  const showHeroSlide = nextIndex => {
    const nextSlide = heroCenterSlides[nextIndex];
    if (!nextSlide || nextSlide.dataset.heroFailed === "true" || heroSlideLoading || nextIndex === activeHeroSlide) return;
    const activate = () => {
      heroCenterSlides[activeHeroSlide]?.classList.remove("is-active");
      nextSlide.classList.add("is-active");
      heroImageFallback?.setAttribute("hidden", "");
      activeHeroSlide = nextIndex;
      heroSlideLoading = false;
    };
    const fail = () => {
      nextSlide.dataset.heroFailed = "true";
      heroSlideLoading = false;
    };
    if (nextSlide.complete && nextSlide.naturalWidth) {
      activate();
      return;
    }
    heroSlideLoading = true;
    nextSlide.addEventListener("load", activate, { once: true });
    nextSlide.addEventListener("error", fail, { once: true });
    if (!nextSlide.hasAttribute("src") && nextSlide.dataset.heroSrc) {
      nextSlide.src = nextSlide.dataset.heroSrc;
      delete nextSlide.dataset.heroSrc;
    }
  };
  if (heroCenterSlides.length > 1 && !reduceMotion) {
    window.setInterval(() => {
      if (document.hidden || heroSlideLoading) return;
      for (let step = 1; step < heroCenterSlides.length; step++) {
        const nextHeroSlide = (activeHeroSlide + step) % heroCenterSlides.length;
        if (heroCenterSlides[nextHeroSlide].dataset.heroFailed !== "true") {
          showHeroSlide(nextHeroSlide);
          break;
        }
      }
    }, 5600);
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

    bg.replaceChildren();
    const backgroundImages = [document.createElement("img"), document.createElement("img")];
    backgroundImages.forEach(backgroundImage => {
      backgroundImage.alt = "";
      backgroundImage.loading = "lazy";
      backgroundImage.decoding = "async";
      backgroundImage.setAttribute("fetchpriority", "low");
      bg.appendChild(backgroundImage);
    });
    let activeBackgroundIndex = -1;
    let backgroundRequest = 0;
    let backgroundStarted = false;
    const showMomentBackground = () => {
      if (!backgroundStarted) return;
      const imagePath = moments[index].image_path;
      const activeImage = activeBackgroundIndex >= 0 ? backgroundImages[activeBackgroundIndex] : null;
      if (activeImage?.getAttribute("src") === imagePath) return;
      const targetIndex = activeBackgroundIndex === 0 ? 1 : 0;
      const target = backgroundImages[targetIndex];
      const requestId = ++backgroundRequest;
      target.classList.remove("active");
      target.onload = () => {
        if (requestId !== backgroundRequest) return;
        target.classList.add("active");
        if (activeBackgroundIndex >= 0) backgroundImages[activeBackgroundIndex].classList.remove("active");
        activeBackgroundIndex = targetIndex;
      };
      target.onerror = () => {
        if (requestId === backgroundRequest) target.classList.remove("active");
      };
      target.src = imagePath;
      if (target.complete && target.naturalWidth) target.onload();
    };
    const startMomentBackground = () => {
      if (backgroundStarted) return;
      backgroundStarted = true;
      showMomentBackground();
    };
    const renderMoment = () => {
      const moment = moments[index];
      image.src = moment.image_path;
      image.alt = moment.title || "Wedding moment";
      title.textContent = moment.title || "";
      caption.textContent = moment.caption || "";
      credit.textContent = moment.credit_name || "";
      counter.textContent = `${String(index + 1).padStart(2, "0")} / ${String(moments.length).padStart(2, "0")}`;
      showMomentBackground();
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
    if ("IntersectionObserver" in window) {
      const momentsBackgroundObserver = new IntersectionObserver(entries => {
        if (!entries.some(entry => entry.isIntersecting)) return;
        startMomentBackground();
        momentsBackgroundObserver.disconnect();
      }, { rootMargin: "400px 0px" });
      momentsBackgroundObserver.observe(bg);
    } else {
      startMomentBackground();
    }
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
      musicStatus.textContent = "The uploaded track could not be reached. Please verify it in Wedding Settings.";
    });
    backgroundMusic.play().catch(() => {
      if (!backgroundMusic.error) musicStatus.textContent = "Autoplay was blocked. Tap Play Music to start.";
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
        musicStatus.textContent = backgroundMusic.error
          ? "The uploaded track could not be reached. Please verify it in Wedding Settings."
          : "Music could not start. Please check your browser's media settings.";
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
