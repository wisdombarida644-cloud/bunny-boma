@extends('layouts.app')

@section('content')
<nav class="nav" id="nav">
  <a href="#home" class="nav_logo" aria-label="With the Gospels home"><img src="{{ asset('favicon.svg') }}" alt="" width="512" height="512" fetchpriority="high"></a>
  <div class="nav_links" id="navLinks">
    <a href="#howWeMet">Our Story</a>
    <a href="#gallery">Gallery</a>
    <a href="#memories">Memories</a>
    <a href="#wedding">The Day</a>
    <a href="#cash-gift">Registry</a>
    <a href="#qa">Q&A</a>
    <a href="#wishes">Wishes</a>
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
    <div class="nav_logo"><img src="{{ asset('favicon.svg') }}" alt="The Gospels logo" width="512" height="512"></div>
    <button id="closeMenu" aria-label="Close">✕</button>
  </div>
  <div class="mobile_menu_links">
    <a href="#howWeMet" data-close><span>01</span>Our Story</a>
    <a href="#gallery" data-close><span>02</span>Gallery</a>
    <a href="#memories" data-close><span>03</span>Memories</a>
    <a href="#wedding" data-close><span>04</span>The Day</a>
    <a href="#cash-gift" data-close><span>05</span>Registry</a>
    <a href="#qa" data-close><span>06</span>Q&A</a>
    <a href="#wishes" data-close><span>07</span>Wishes</a>
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
                <img class="hero_photo_tile" src="{{ $photo->image_path }}" alt="" decoding="async" loading="lazy" fetchpriority="auto">
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
                <img class="hero_photo_tile" src="{{ $photo->image_path }}" alt="" decoding="async" loading="lazy" fetchpriority="auto">
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
      <p class="hero_kicker">WE ARE GETTING MARRIED</p>
      <h1 class="hero_title" aria-label="{{ $partnerOneFirst }} and {{ $partnerTwoFirst }}">
        <span class="hero_name">{{ $partnerOneFirst }}</span>
        <em class="hero_ampersand" aria-hidden="true">&amp;</em>
        <span class="hero_name">{{ $partnerTwoFirst }}</span>
      </h1>
      <div class="hero_meta">
        <time datetime="{{ \Carbon\Carbon::parse($setting->wedding_date)->toDateString() }}">{{ \Carbon\Carbon::parse($setting->wedding_date)->format('d · m · Y') }}</time>
        <span class="hero_meta_dot" aria-hidden="true">•</span>
        <span class="hero_meta_city">{{ $setting->city ?? 'Port Harcourt' }}</span>
      </div>
    </div>
  </div>
  <a class="hero_scroll" href="#countdownSec"><span>Scroll to discover</span></a>
</header>

<section class="countdown_sec countdown_strip" id="countdownSec" aria-label="Wedding countdown">
  <div class="countdown_strip_inner">
    <div class="count_grid reveal" id="countGrid">
      <div class="count_item"><span class="count_num" id="cDays">—</span><span class="count_lab">Days</span></div>
      <div class="count_item"><span class="count_num" id="cHours">—</span><span class="count_lab">Hours</span></div>
      <div class="count_item"><span class="count_num" id="cMins">—</span><span class="count_lab">Minutes</span></div>
      <div class="count_item"><span class="count_num" id="cSecs">—</span><span class="count_lab">Seconds</span></div>
    </div>
    <div class="countdown_hash">{{ $setting->hashtag ?? '#THEGOSPELS26' }}</div>
  </div>
</section>

<section class="how story_feature" id="howWeMet" aria-labelledby="storyHeadline">
  <div class="story_feature_inner">
    <div class="story_feature_header">
      <div>
        <div class="eyebrow">Our story</div>
        <h2 class="story_feature_title" id="storyHeadline">Two sides,<br><i>one story.</i></h2>
      </div>
      <div class="story_couple_pill" aria-label="Our story: {{ $partnerOneFirst }} and {{ $partnerTwoFirst }}">
        <span class="story_couple_pill_primary">{{ $partnerOneFirst }}</span>
        <span class="story_couple_pill_join" aria-hidden="true">&amp;</span>
        <span class="story_couple_pill_secondary">{{ $partnerTwoFirst }}</span>
      </div>
    </div>

    <div class="story_feature_grid">
      <figure class="story_photo reveal">
        <div class="story_photo_frame">
          @if($galleries->isNotEmpty())
            @php($storyPhoto = $galleries->get(2) ?? $galleries->first())
            <img src="{{ $storyPhoto->image_path }}" alt="{{ $storyPhoto->caption ?: 'A photograph shared by the couple' }}" loading="lazy" decoding="async">
          @else
            <div class="photo_placeholder"><span>A photograph will appear here when shared.</span></div>
          @endif
        </div>
        <figcaption class="story_photo_credit">As told by {{ $partnerOneFirst }} &amp; {{ $partnerTwoFirst }}</figcaption>
      </figure>

      <article class="story_narrative reveal">
        <h3>Our Story</h3>
        @if(filled($setting->story_intro))
          <blockquote class="story_pullquote">{{ $setting->story_intro }}</blockquote>
        @endif
        <div class="story_copy">
          @if(is_array($setting->story_content) && count($setting->story_content))
            @foreach($setting->story_content as $paragraph)
              <p>{{ $paragraph }}</p>
            @endforeach
          @elseif(filled($setting->podcast_desc))
            <p>{{ $setting->podcast_desc }}</p>
          @else
            <p>The couple’s story will appear here when shared.</p>
          @endif
        </div>
        <a class="story_keep_reading" href="{{ $timelines->isNotEmpty() ? '#storyTimeline' : '#gallery' }}">Keep reading <span aria-hidden="true">→</span></a>
      </article>
    </div>

    @if($timelines->isNotEmpty())
      <div class="story_timeline" id="storyTimeline" aria-label="Our story timeline">
        @foreach($timelines as $timeline)
          <article class="story_timeline_item">
            <span class="story_timeline_date">{{ $timeline->date_label }}</span>
            <h4>{{ $timeline->title }}</h4>
            @if(filled($timeline->desc))<p>{{ $timeline->desc }}</p>@endif
          </article>
        @endforeach
      </div>
    @endif
  </div>
</section>

<section class="gallery_mason" id="gallery" aria-labelledby="galleryHeading">
  <div class="gallery_head">
    <div><div class="eyebrow">Gallery</div><h2 class="h2" id="galleryHeading" style="margin-top:12px">Moments <i>in bloom</i></h2></div>
    <div class="gallery_hint"><span>Scroll or swipe</span><span aria-hidden="true">← &nbsp; →</span></div>
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

<div class="lightbox" id="lightbox">
  <img class="lightbox_img" id="lbImg" alt="">
  <div class="lightbox_ui">
    <button class="lb_close" id="lbClose">✕</button>
    <button class="lb_prev" id="lbPrev">‹</button>
    <button class="lb_next" id="lbNext">›</button>
    <div class="lb_counter" id="lbCounter"></div>
  </div>
</div>

<section class="wedding day_section" id="wedding" aria-labelledby="dayHeading">
  <div class="day_inner">
    <div class="day_display reveal">
      <div class="eyebrow">The day</div>
      <h2 class="day_date_big" id="dayHeading">
        <span>{{ \Carbon\Carbon::parse($setting->wedding_date)->format('d') }}<i>.</i>{{ \Carbon\Carbon::parse($setting->wedding_date)->format('m') }}</span>
        <em>{{ \Carbon\Carbon::parse($setting->wedding_date)->format('Y') }}</em>
      </h2>
      @if($setting->order_pdf_path)
        <a class="btn_line day_order" href="{{ $setting->order_pdf_path }}" target="_blank" rel="noopener">Download Order of Service <span aria-hidden="true">↗</span></a>
      @endif
    </div>

    <div class="day_panel reveal">
      <div class="day_facts">
        <div class="day_fact"><span>Date</span><strong>{{ \Carbon\Carbon::parse($setting->wedding_date)->format('l, j F Y') }}</strong></div>
        <div class="day_fact"><span>Time</span><strong>{{ $setting->ceremony_time ?: '11:00 AM' }}</strong></div>
        <div class="day_fact"><span>City</span><strong>{{ $weddingData['city'] }}</strong></div>
      </div>

      <div class="day_venue" id="venue">
        <div class="eyebrow">Venue</div>
        <h3>{{ $setting->venue_name }}</h3>
        <p class="day_address">{!! nl2br(e($weddingData['address'])) !!}<br>{{ $weddingData['city'] }}</p>
        <div class="venue_actions">
          <a class="btn_line" href="{{ $weddingData['mapsUrl'] }}" target="_blank" rel="noopener noreferrer">View location <span aria-hidden="true">↗</span></a>
          <button class="btn_line" id="copyAddrBtn" type="button">Copy address</button>
        </div>
      </div>

      <div class="day_schedule">
        <div class="eyebrow">Order of the day</div>
        <div class="wedding_timeline">
          <div class="wt_row">
            <div class="wt_time">{{ $setting->ceremony_time ?: '11:00 AM' }}<div class="wt_label">Ceremony</div></div>
            <div><div class="wt_title">Wedding ceremony</div>@if(filled($setting->arrival_time))<div class="wt_desc">Guest arrival from {{ $setting->arrival_time }}.</div>@endif</div>
          </div>
          <div class="wt_row">
            <div class="wt_time">{{ $setting->reception_time ?: 'To follow' }}<div class="wt_label">Reception</div></div>
            <div><div class="wt_title">Reception</div></div>
          </div>
        </div>
      </div>

      <div class="day_dress" id="dresscode">
        <div>
          <div class="eyebrow">Dress code</div>
          <h3>{{ $setting->dress_title ?? 'Formal Attire' }}</h3>
          @if(filled($setting->dress_note))<p>{{ $setting->dress_note }}</p>@endif
        </div>
        <div class="dress_swatches" aria-label="Suggested dress-code colors">
          @foreach($weddingData['dressColors'] as $color)
            <div class="swatch"><div class="swatch_circle" style="background:{{ $color['hex'] }}"></div><span class="swatch_label">{{ $color['name'] }}</span></div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

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

<section class="cash_gift registry_section" id="cash-gift" aria-labelledby="registryHeading">
  <div class="cash_gift_inner">
    <div class="cash_gift_intro">
      <div class="eyebrow">Registry</div>
      <h2 class="h2" id="registryHeading" style="margin-top:16px">Prefer to send<br><i>a cash gift?</i></h2>
      <p class="body">We are grateful to celebrate with you. If you would also like to give a cash gift, you may use the bank details below. There is no obligation.</p>
    </div>
    <div class="cash_gift_transfer">
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

<section class="guestbook wishes_section" id="wishes" aria-labelledby="wishesHeading">
  <div class="gb_inner">
    <div class="gb_heading">
      <div class="eyebrow">Wishes from our people</div>
      <h2 class="h2" id="wishesHeading">Leave us<br><i>a wish.</i></h2>
      <p class="gb_intro">Leave a blessing, a memory, or a few kind words for the couple.</p>
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
    <div class="gb_wishes">
      <div class="eyebrow">Shared with love</div>
      <div class="gb_list" id="wishesList">
        @forelse($guestbooks as $gb)
          <article class="gb_card"><div class="gb_msg">“{{ $gb->message }}”</div><div class="gb_name">— {{ $gb->name }}</div></article>
        @empty
          <p class="gb_empty" role="status">Be the first to send a wish. Approved wishes will appear here.</p>
        @endforelse
      </div>
    </div>
  </div>
</section>

<footer class="footer closing_footer">
  <div class="footer_inner">
    <a class="footer_mark" href="#home" aria-label="Back to the top">
      <img src="{{ asset('favicon.svg') }}" alt="The Gospels brand mark" width="512" height="512" loading="lazy" decoding="async">
    </a>
    <div class="footer_couple">{{ $partnerOneFirst }} <i>&amp;</i> {{ $partnerTwoFirst }}</div>
    <div class="footer_hashtag">{{ $setting->hashtag ?? '#THEGOSPELS26' }} <span aria-hidden="true">·</span> {{ \Carbon\Carbon::parse($setting->wedding_date)->format('F j, Y') }}</div>
    <nav class="footer_nav" aria-label="Footer navigation">
      <a href="#howWeMet">Our story</a>
      <a href="#gallery">Gallery</a>
      <a href="#memories">Memories</a>
      <a href="#wedding">The day</a>
      <a href="#cash-gift">Registry</a>
      <a href="#wishes">Wishes</a>
      <a href="#rsvp">RSVP</a>
    </nav>
    <div class="footer_bottom"><span>With love, {{ $setting->partner_one }} &amp; {{ $setting->partner_two }}</span><span>{{ $weddingData['city'] }}</span><a href="{{ route('admin.dashboard') }}">Admin</a></div>
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
  let requestHeroSlide = null;
  const showHeroFallback = () => {
    const failedSlide = heroCenterSlides[0];
    if (failedSlide) {
      failedSlide.dataset.heroFailed = "true";
      failedSlide.remove();
    }
    heroImageFallback?.removeAttribute("hidden");
    const backupIndex = heroCenterSlides.findIndex((slide, index) => index > 0 && slide.dataset.heroFailed !== "true");
    if (backupIndex >= 0) requestHeroSlide?.(backupIndex);
  };
  heroCenterSlides[0]?.addEventListener("error", showHeroFallback, { once: true });
  if (heroCenterSlides[0]?.complete && !heroCenterSlides[0].naturalWidth) showHeroFallback();
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
      const activeSlide = heroCenterSlides[activeHeroSlide];
      if (!activeSlide?.isConnected || activeSlide.dataset.heroFailed === "true") {
        const backupIndex = heroCenterSlides.findIndex((slide, index) => index > 0 && slide.dataset.heroFailed !== "true");
        if (backupIndex >= 0) requestHeroSlide?.(backupIndex);
      }
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
  requestHeroSlide = showHeroSlide;
  if (heroCenterSlides[0]?.dataset.heroFailed === "true") {
    const backupIndex = heroCenterSlides.findIndex((slide, index) => index > 0 && slide.dataset.heroFailed !== "true");
    if (backupIndex >= 0) showHeroSlide(backupIndex);
  }
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

  // Clipboard helpers shared by account and venue address actions.
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
