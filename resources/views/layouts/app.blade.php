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

  </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-green-950 via-emerald-950 to-green-900 text-green-50">

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
