@php
  $settings = \App\Models\SiteSetting::first();
  $navSpecies = \App\Models\Species::where('is_published', true)
      ->orderBy('sort_order')
      ->get();
@endphp

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>{{ $settings?->site_title ?? 'Organism Exhibit' }}</title>
  

  {{-- Tailwind CDN --}}
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    /* page transitions */
    .page-enter { animation: enter .45s ease both; }
    @keyframes enter {
      from { opacity:0; transform: translateY(10px) }
      to   { opacity:1; transform:none }
    }

    body.is-leaving main { animation: exit .18s ease both; }
    @keyframes exit {
      to { opacity:0; transform: translateY(-6px); }
    }

    /* underline hover */
    .u::after{
      content:"";
      position:absolute;
      left:0;
      bottom:-6px;
      height:2px;
      width:0;
      background:currentColor;
      transition:width .25s ease
    }
    .u:hover::after{ width:100% }
    /* nature theme helpers */
.card {
  border: 1px solid rgba(34, 197, 94, .18);  /* green-ish border */
  background: rgba(6, 78, 59, .28);          /* emerald-ish panel */
  backdrop-filter: blur(6px);
}

.pill {
  border: 1px solid rgba(34, 197, 94, .25);
  background: rgba(6, 78, 59, .35);
}

.pill:hover {
  background: rgba(22, 163, 74, .35);
}
/* Track positioning (your exact dimensions) */
#image-track{
  display: flex;
  gap: 4vmin;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(0%, -50%);
  will-change: transform;
}

#image-track .image{
  width: 30vmin;
  height: 46vmin;
  object-fit: cover;
  object-position: 100% 50%;
  user-select: none;
  -webkit-user-drag: none;
  pointer-events: none; /* click is on <a>, not image */
}

.track-link{
  position: relative;
  display: block;
  text-decoration: none;
}

.track-label{
  position: absolute;
  left: 12px;
  bottom: 12px;
  padding: 8px 10px;
  border-radius: 12px;
  background: rgba(0,0,0,0.55);
  color: rgba(240,253,244,0.95);
  font-weight: 800;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  font-size: 12px;
  border: 1px solid rgba(34,197,94,0.25);
}

/* Prevent blue selection while dragging */
#image-track, #image-track *{
  user-select: none;
  -webkit-user-select: none;
  -ms-user-select: none;
}
body{ overflow-x: hidden; }

/* Expand overlay */
.expand-overlay{
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.82);
  backdrop-filter: blur(8px);
  display: none;
  z-index: 999999;
}

.expand-overlay.is-open{ display: block; }

.expand-close{
  position: absolute;
  top: 18px;
  right: 18px;
  width: 44px;
  height: 44px;
  border-radius: 14px;
  border: 1px solid rgba(34,197,94,0.25);
  background: rgba(16,24,16,0.85);
  color: rgba(240,253,244,0.9);
  font-weight: 900;
  cursor: pointer;
}

.expand-panel{
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  width: min(1100px, calc(100vw - 40px));
  height: min(78vh, 700px);
  border-radius: 22px;
  overflow: hidden;
  border: 1px solid rgba(34,197,94,0.18);
  background: rgba(10,16,10,0.85);
  display: grid;
  grid-template-columns: 1fr 1.2fr;
}

.expand-image{
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.expand-content{
  padding: 28px;
  overflow: auto;
}

.expand-title{
  margin: 0;
  color: rgba(240,253,244,0.95);
  font-size: 28px;
  font-weight: 900;
}

.expand-body{
  margin-top: 16px;
  color: rgba(187,247,208,0.82);
  line-height: 1.75;
  font-weight: 600;
}

/* Mobile: stack */
@media (max-width: 900px){
  .expand-panel{
    grid-template-columns: 1fr;
    height: min(84vh, 900px);
  }
  .expand-image{ height: 240px; }
}

  </style>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-green-950 via-emerald-950 to-green-950 text-green-50">

  {{-- NAVBAR --}}
  <nav class="sticky top-0 z-10
              border-b border-green-400/10
              bg-green-950/60 backdrop-blur
              px-6 py-4">

    <div class="mx-auto flex max-w-5xl items-center justify-between gap-4">

      {{-- Logo / Title → LANDING PAGE --}}
      <a class="font-semibold tracking-tight text-green-100 hover:text-white transition"
         href="{{ route('landing') }}">
        {{ $settings?->site_title ?? 'Organism Exhibit' }}
      </a>

      {{-- Desktop Nav --}}
      <div class="hidden md:flex flex-wrap gap-5 text-green-200/90">

        {{-- Enter Site --}}
        <a class="relative u font-medium"
           href="{{ route('home') }}">
          Explore Species
        </a>


        {{-- References --}}
        <a class="relative u"
           href="{{ route('references') }}">
          References
        </a>
      </div>
    </div>
  </nav>

  {{-- PAGE CONTENT --}}
  <main class="page-enter mx-auto max-w-5xl px-6 py-10">
    @yield('content')
  </main>

<script>
  // Smooth page-exit transitions when navigating
  document.addEventListener("click", (e) => {
    const a = e.target.closest("a");
    if (!a) return;

    const url = a.getAttribute("href");
    if (!url) return;

    // Ignore anchor links, new tabs, downloads, modified clicks
    if (
      url.startsWith("#") ||
      a.target === "_blank" ||
      a.hasAttribute("download") ||
      e.metaKey || e.ctrlKey || e.shiftKey || e.altKey
    ) return;

    // Ignore non-GET actions and javascript pseudo-links
    if (url.startsWith("javascript:")) return;

    // If same page hash navigation, let it happen normally
    const current = window.location.href.split("#")[0];
    const target = new URL(url, window.location.href).href.split("#")[0];
    if (current === target && url.includes("#")) return;

    e.preventDefault();
    document.body.classList.add("is-leaving");

    setTimeout(() => {
      window.location.href = url;
    }, 160);
  });

  // ✅ Fix blank page on browser back/forward (bfcache restore)
  window.addEventListener("pageshow", (event) => {
    // pageshow fires on normal load AND bfcache restore
    // Always remove is-leaving so main isn't stuck faded out
    document.body.classList.remove("is-leaving");
  });
</script>


</body>
</html>
