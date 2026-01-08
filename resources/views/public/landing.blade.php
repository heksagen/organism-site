@extends('layouts.app')

@section('content')
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">

    {{-- Background image --}}
    <div class="absolute inset-0">
        <img
            id="heroParallax"
            src="{{ asset('images/landing/age.png') }}"
            alt="Philippine Endemic Mammals"
            class="w-full h-full object-cover will-change-transform scale-110"
        />

        {{-- Dark green overlay for readability --}}
        <div class="absolute inset-0 bg-gradient-to-b from-green-950/90 via-green-900/80 to-green-950/95"></div>
    </div>

    {{-- Hero content --}}
    <div class="relative z-10 max-w-5xl text-center px-6">

        {{-- Title (simple portal reveal, no line splitting) --}}
        <h1
            data-portal
            class="reveal-portal text-4xl md:text-6xl font-extrabold text-green-100 leading-tight"
            style="--reveal-delay: 0ms"
        >
            <span>
                The Emergency Ward of <br class="hidden md:block">
                Philippine Biodiversity
            </span>
        </h1>

        {{-- Subtitle (simple pop reveal) --}}
        <p
            data-reveal
            class="reveal-pop mt-6 text-lg md:text-xl text-green-200/90 leading-relaxed"
            style="--reveal-delay: 200ms"
        >
            Tracking the "Emergency Ward" of the Nations’ Biodiversity
        </p>

        {{-- Buttons --}}
        <div
            data-reveal
            class="reveal-pop mt-10 flex flex-col sm:flex-row gap-4 justify-center"
            style="--reveal-delay: 350ms"
        >
            <a href="{{ route('home') }}"
               class="px-6 py-3 rounded-xl
                      bg-green-600 hover:bg-green-500
                      text-green-950 font-semibold
                      transition shadow-lg">
                Enter the Site
            </a>

            <a href="#about"
               class="px-6 py-3 rounded-xl
                      border border-green-400
                      text-green-100 hover:bg-green-800/60
                      transition">
                Why These Five?
            </a>
        </div>

    </div>
</section>


<div class="bg-gradient-to-b from-green-950 via-green-900 to-green-800">

{{-- About section --}}
{{-- About section --}}
<section id="about" class="relative py-24">
    <div class="max-w-5xl mx-auto px-6 text-center">

        {{-- H2 (FORCED to its own line) --}}
        <h2
            data-portal
            class="portal-lines block w-full text-3xl md:text-4xl font-bold text-green-100"
        >
            <span class="portal-line" style="--reveal-delay: 0ms">
                <span>Why These Five?</span>
            </span>
        </h2>

        {{-- H3 (FORCED below H2, each line stacked) --}}
        <h3
            data-portal
            class="portal-lines block w-full mt-2 text-lg font-semibold text-green-200/90"
        >
            <span class="portal-line" style="--reveal-delay: 120ms">
                <span>Short Description</span>
            </span>
            <span class="portal-line" style="--reveal-delay: 240ms">
                <span>Overview</span>
            </span>
        </h3>

        {{-- Paragraph 1 --}}
        <p
            data-portal
            class="reveal-portal mt-6 text-green-200/90 leading-relaxed"
            style="--reveal-delay: 360ms"
        >
            <span>
                In this educational blog, the researchers have chosen these mammals native to the Philippines, specifically:
                <em>Bubalus mindorensis</em> (Tamaraw),
                <em>Rusa alfredi</em> (Philippine Spotted Deer),
                <em>Sus cebifrons</em> (Visayan Warty Pig),
                <em>Carlito syrichta</em> (Philippine Tarsier),
                and <em>Manis culionensis</em> (Palawan Pangolin).
                The group selected these five organisms because they represent the most globally threatened mammals in the archipelago.
                Based on research, they share key biological features, including low reproductive rates, specialized adaptations, and dependence on forests.
                They play a vital ecological role as herbivores, omnivores, insectivores, ecosystem engineers, and seed dispersers, contributing to the maintenance of forest biodiversity and ecosystem equilibrium.
                Many also exhibit distinctive evolutionary characteristics.
                Notably, they hold economic and cultural significance, but anthropogenic activities put them at high risk of extinction today.
            </span>
        </p>

        {{-- Paragraph 2 --}}
        <p
            data-portal
            class="reveal-portal mt-4 text-green-200/80 leading-relaxed"
            style="--reveal-delay: 480ms"
        >
            <span>
                This website documents their biology, ecology, and conservation status —
                not as statistics, but as living organisms fighting for survival.
            </span>
        </p>

    </div>
</section>


{{-- =========================
MISSION + VISION (PORTAL REVEAL STYLE)
========================= --}}
<section class="w-full py-20">
    <div class="max-w-7xl mx-auto px-6 space-y-24">

        {{-- MISSION: image LEFT, text RIGHT --}}
        <div class="grid lg:grid-cols-2 gap-12 items-center">

            {{-- Image --}}
            <div class="bg-black/20 p-4">
                <img
                    src="{{ asset('images/landing/2.png') }}"
                    alt="Mission image"
                    class="w-full h-[420px] object-cover"
                >
            </div>

            {{-- Text --}}
            <div>
                <h2
                    data-portal
                    class="portal-lines block w-full text-4xl font-semibold tracking-wide"
                >
                    <span class="portal-line" style="--reveal-delay: 0ms">
                        <span class="text-green-400/80">OUR</span>
                    </span>
                    <span class="portal-line" style="--reveal-delay: 120ms">
                        <span class="text-green-400 font-bold">MISSION</span>
                    </span>
                </h2>

                <p
                    data-portal
                    class="reveal-portal mt-6 text-gray-300 leading-relaxed font-semibold"
                    style="--reveal-delay: 260ms"
                >
                    <span>
                        The developers aim to help enhance awareness about the most globally threatened mammals in the archipelago.
                        The Eco Website, titled “Emergency Ward of Philippine Biodiversity,” seeks to educate the public by providing
                        a comprehensive yet accessible information of the country’s endangered endemic mammal species through detailed,
                        structured, and science-based content. The platform covers key aspects, including geography and distribution,
                        taxonomic classification, morphology, ecology, reproduction, cultural and economic importance, and conservation status.
                        By integrating reliable insights, engaging facts, and visually appealing images, it promotes increasing environmental
                        knowledge and supports evidence-based conservation initiatives.
                    </span>
                </p>
            </div>
        </div>

        {{-- VISION: text LEFT, image RIGHT --}}
        <div class="grid lg:grid-cols-2 gap-12 items-center">

            {{-- Text --}}
            <div>
                <h2
                    data-portal
                    class="portal-lines block w-full text-4xl font-semibold tracking-wide"
                >
                    <span class="portal-line" style="--reveal-delay: 0ms">
                        <span class="text-green-400/80">OUR</span>
                    </span>
                    <span class="portal-line" style="--reveal-delay: 120ms">
                        <span class="text-green-400 font-bold">VISION</span>
                    </span>
                </h2>

                <p
                    data-portal
                    class="reveal-portal mt-6 text-gray-300 leading-relaxed font-semibold"
                    style="--reveal-delay: 260ms"
                >
                    <span>
                        To contribute to improving ecological cognizance and public appreciation of Philippine biodiversity, fostering a
                        society that truly values and actively participates in the protection and conservation of endemic wildlife. Furthermore,
                        to envision a future where people utilize scientific understanding to inspire a culture of accountability and awareness
                        of the impact of their actions, as well as contribute to initiatives that prevent species extinction while ensuring the
                        long-term sustainability of the nation’s ecosystems.
                    </span>
                </p>
            </div>

            {{-- Image --}}
            <div class="bg-black/20 p-4">
                <img
                    src="{{ asset('images/landing/3.png') }}"
                    alt="Vision image"
                    class="w-full h-[420px] object-cover"
                >
            </div>
        </div>

    </div>
</section>



{{-- =========================
THE PEOPLE BEHIND THIS PROJECT (6 PEOPLE, NO LOGO) — PORTAL REVEAL
========================= --}}
<section class="w-full py-20">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Title (portal lines) --}}
        <h2
            data-portal
            class="portal-lines block w-full text-center text-5xl font-semibold tracking-widest"
        >
            <span class="portal-line" style="--reveal-delay: 0ms">
                <span class="text-green-400/80">THE</span>
            </span>

            <span class="portal-line" style="--reveal-delay: 120ms">
                <span class="text-green-400 font-bold">PEOPLE</span>
            </span>

            <span class="portal-line" style="--reveal-delay: 240ms">
                <span class="text-green-400/80">BEHIND THIS PROJECT</span>
            </span>
        </h2>

        {{-- People grid --}}
        <div class="mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12 items-start">

            {{-- Person 1 --}}
            <div data-portal class="reveal-portal text-center" style="--reveal-delay: 0ms">
                <span>
                    <div class="w-36 h-36 mx-auto rounded-full bg-white overflow-hidden">
                        <img src="{{ asset('images/team/dev1.jpg') }}" class="w-full h-full object-cover" alt="Dev 1">
                    </div>
                    <p class="mt-5 text-gray-200 font-bold tracking-wide uppercase">Almadin</p>
                    <p class="mt-2 text-gray-300 font-semibold">Sophia P.</p>
                </span>
            </div>

            {{-- Person 2 --}}
            <div data-portal class="reveal-portal text-center" style="--reveal-delay: 120ms">
                <span>
                    <div class="w-36 h-36 mx-auto rounded-full bg-white overflow-hidden">
                        <img src="{{ asset('images/team/dev2.png') }}" class="w-full h-full object-cover" alt="Dev 2">
                    </div>
                    <p class="mt-5 text-gray-200 font-bold tracking-wide uppercase">De Guzman</p>
                    <p class="mt-2 text-gray-300 font-semibold">Jovilyn M.</p>
                </span>
            </div>

            {{-- Person 3 --}}
            <div data-portal class="reveal-portal text-center" style="--reveal-delay: 240ms">
                <span>
                    <div class="w-36 h-36 mx-auto rounded-full bg-white overflow-hidden">
                        <img src="{{ asset('images/team/dev3.png') }}" class="w-full h-full object-cover" alt="Dev 3">
                    </div>
                    <p class="mt-5 text-gray-200 font-bold tracking-wide uppercase">Maglanque</p>
                    <p class="mt-2 text-gray-300 font-semibold">Reema S.</p>
                </span>
            </div>

            {{-- Person 4 --}}
            <div data-portal class="reveal-portal text-center" style="--reveal-delay: 360ms">
                <span>
                    <div class="w-36 h-36 mx-auto rounded-full bg-white overflow-hidden">
                        <img src="{{ asset('images/team/dev4.png') }}" class="w-full h-full object-cover" alt="Dev 4">
                    </div>
                    <p class="mt-5 text-gray-200 font-bold tracking-wide uppercase">Nicdao</p>
                    <p class="mt-2 text-gray-300 font-semibold">Kier R.</p>
                </span>
            </div>

            {{-- Person 5 --}}
            <div data-portal class="reveal-portal text-center" style="--reveal-delay: 480ms">
                <span>
                    <div class="w-36 h-36 mx-auto rounded-full bg-white overflow-hidden">
                        <img src="{{ asset('images/team/dev5.png') }}" class="w-full h-full object-cover" alt="Dev 5">
                    </div>
                    <p class="mt-5 text-gray-200 font-bold tracking-wide uppercase">Pantela</p>
                    <p class="mt-2 text-gray-300 font-semibold">Albert Dane R.</p>
                </span>
            </div>

            {{-- Person 6 --}}
            <div data-portal class="reveal-portal text-center" style="--reveal-delay: 600ms">
                <span>
                    <div class="w-36 h-36 mx-auto rounded-full bg-white overflow-hidden">
                        <img src="{{ asset('images/team/dev6.png') }}" class="w-full h-full object-cover" alt="Dev 6">
                    </div>
                    <p class="mt-5 text-gray-200 font-bold tracking-wide uppercase">Tamayo</p>
                    <p class="mt-2 text-gray-300 font-semibold">Annaly M.</p>
                </span>
            </div>

        </div>

        {{-- Contact details --}}
        <div
            data-portal
            class="reveal-portal mt-16 text-center text-gray-300 font-semibold"
            style="--reveal-delay: 720ms"
        >
            <span>
                <p>
                    Email:
                    <a href="mailto:dhvsu.envisoc@gmail.com" class="text-green-300 hover:underline">
                        dhvsu.envisoc@gmail.com
                    </a>
                </p>
            </span>
        </div>

    </div>
</section>

</div>
<script>
  (function () {
    const img = document.getElementById('heroParallax');
    if (!img) return;

    // Respect accessibility setting
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    if (reduceMotion.matches) return;

    let ticking = false;

    function update() {
      const y = window.scrollY || 0;
      // Adjust 0.25 for stronger/weaker effect (0.15 subtle, 0.35 strong)
      img.style.transform = `translateY(${y * 0.25}px) scale(1.10)`;
      ticking = false;
    }

    window.addEventListener('scroll', () => {
      if (!ticking) {
        window.requestAnimationFrame(update);
        ticking = true;
      }
    }, { passive: true });

    update();
  })();
</script>

@endsection
