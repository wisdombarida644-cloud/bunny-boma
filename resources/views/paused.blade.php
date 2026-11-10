<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <meta name="theme-color" content="#173f34">
  <meta name="description" content="A note from Benny and Chiamaka. Their wedding website is temporarily paused; thank you for your understanding.">
  <meta property="og:type" content="website">
  <meta property="og:title" content="A Note from Benny &amp; Chiamaka | #THEGOSPELS26">
  <meta property="og:description" content="Their wedding website is temporarily paused. Thank you for your patience and understanding.">
  <meta property="og:url" content="https://withthegospels.name.ng/">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="A Note from Benny &amp; Chiamaka | #THEGOSPELS26">
  <meta name="twitter:description" content="Their wedding website is temporarily paused. Thank you for your patience and understanding.">
  <title>A Note from Benny &amp; Chiamaka | #THEGOSPELS26</title>
  <style>
    :root {
      color-scheme: light;
      --forest: #173f34;
      --forest-soft: #38594d;
      --gold: #b99b5d;
      --paper: #f7f5ef;
      --white: #fffefa;
      --line: rgba(23, 63, 52, .16);
    }

    *, *::before, *::after { box-sizing: border-box; }

    html { min-height: 100%; background: var(--paper); }

    body {
      min-height: 100vh;
      min-height: 100svh;
      margin: 0;
      padding: clamp(14px, 3vw, 34px);
      display: grid;
      place-items: center;
      background: var(--paper);
      color: var(--forest);
      font-family: "Segoe UI", Arial, sans-serif;
      -webkit-font-smoothing: antialiased;
    }

    .page {
      position: relative;
      isolation: isolate;
      width: min(100%, 1000px);
      min-height: min(720px, calc(100svh - 28px));
      padding: clamp(26px, 5vw, 58px);
      display: grid;
      grid-template-rows: auto 1fr auto;
      border: 1px solid var(--line);
      background: var(--white);
    }

    .page::before {
      position: absolute;
      z-index: -1;
      inset: 10px;
      border: 1px solid rgba(185, 155, 93, .38);
      content: "";
      pointer-events: none;
    }

    .masthead,
    .footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 18px;
      font-size: 10px;
      font-weight: 600;
      letter-spacing: .17em;
      line-height: 1.5;
      text-transform: uppercase;
    }

    .masthead { min-height: 24px; }
    .brand { white-space: nowrap; }
    .edition { color: var(--forest-soft); text-align: right; }

    .note {
      width: min(100%, 670px);
      margin: auto;
      padding: 72px 20px 78px;
      text-align: center;
    }

    .eyebrow {
      margin: 0 0 24px;
      color: var(--forest-soft);
      font-size: 10px;
      font-weight: 600;
      letter-spacing: .24em;
      line-height: 1.7;
      text-transform: uppercase;
    }

    h1 {
      margin: 0;
      font-family: Georgia, "Times New Roman", serif;
      font-size: clamp(44px, 7vw, 78px);
      font-weight: 400;
      letter-spacing: -.045em;
      line-height: 1.04;
    }

    .divider {
      width: 74px;
      height: 1px;
      margin: 32px auto;
      background: var(--gold);
    }

    .message {
      max-width: 48ch;
      margin: 0 auto;
      color: #4e5d53;
      font-size: clamp(16px, 2vw, 18px);
      line-height: 1.9;
    }

    .thanks {
      margin: 12px auto 0;
      color: #657168;
      font-size: 14px;
      line-height: 1.8;
    }

    .signature {
      margin: 30px 0 0;
      font-family: Georgia, "Times New Roman", serif;
      font-size: clamp(23px, 3vw, 29px);
      font-style: italic;
      line-height: 1.3;
    }

    .footer {
      color: var(--forest-soft);
      font-size: 9px;
      letter-spacing: .15em;
    }

    .footer-note { text-align: right; }

    @media (max-width: 560px) {
      .page {
        min-height: calc(100svh - 28px);
        padding: 30px 24px;
      }

      .page::before { inset: 7px; }
      .masthead { align-items: flex-start; font-size: 8px; letter-spacing: .12em; }
      .note { padding: 55px 8px; }
      .eyebrow { font-size: 9px; letter-spacing: .18em; }
      .divider { margin: 26px auto; }
      .message { font-size: 16px; line-height: 1.8; }
      .thanks { font-size: 13px; }
      .footer { align-items: flex-end; font-size: 8px; letter-spacing: .1em; }
    }

    @media (max-height: 620px) and (min-width: 561px) {
      .page { min-height: calc(100svh - 28px); }
      .note { padding-block: 36px; }
      .divider { margin-block: 22px; }
      .signature { margin-top: 20px; }
    }
  </style>
</head>
<body>
  <main class="page">
    <header class="masthead">
      <span class="brand">#THEGOSPELS26</span>
      <span class="edition">A note from Benny &amp; Chiamaka</span>
    </header>

    <section class="note" aria-labelledby="page-title">
      <p class="eyebrow">With love and gratitude</p>
      <h1 id="page-title">A quiet pause.</h1>
      <div class="divider" aria-hidden="true"></div>
      <p class="message">Our wedding website is temporarily paused while we review a few things.</p>
      <p class="thanks">Thank you for your patience and understanding. Please check back later.</p>
      <p class="signature">Benny &amp; Chiamaka</p>
    </section>

    <footer class="footer">
      <span>Thank you for understanding</span>
      <span class="footer-note">#THEGOSPELS26</span>
    </footer>
  </main>
</body>
</html>
