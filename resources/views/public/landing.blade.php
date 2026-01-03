@extends('layouts.app')

@section('content')
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">

    {{-- Background image --}}
    <div class="absolute inset-0">
        <img
            src="{{ asset('images/landing/age.png') }}"
            alt="Philippine Endemic Mammals"
            class="w-full h-full object-cover"
        />

        {{-- Dark green overlay for readability --}}
        <div class="absolute inset-0 bg-gradient-to-b from-green-950/90 via-green-900/80 to-green-950/95"></div>
    </div>

    {{-- Hero content --}}
    <div class="relative z-10 max-w-5xl text-center px-6">
        <h1 class="text-4xl md:text-6xl font-extrabold text-green-100 leading-tight">
            The Emergency Ward of <br class="hidden md:block">
            Philippine Biodiversity
        </h1>

        <p class="mt-6 text-lg md:text-xl text-green-200/90 leading-relaxed">
            Tracking the "Emergency Ward" of the Nations’ Biodiversity
        </p>

        <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
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

{{-- About section --}}
<section id="about" class="relative py-24 bg-gradient-to-b from-green-950 to-green-900">
    <div class="max-w-5xl mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-green-100">
            Why These Five?
        </h2>

        <p class="mt-6 text-green-200/90 leading-relaxed">
            In this educational blog, the researchers have chosen these mammals native to the Philippines, specifically: Bubalus mindorensis (Tamaraw), Rusa alfredi (Philippine Spotted Deer), Sus cebifrons (Visayan Warty Pig), Carlito syrichta (Philippine Tarsier), and Manis culionensis (Palawan Pangolin). The group selected these five organisms because they represent the most globally threatened mammals in the archipelago. Based on research, they share key biological features, including low reproductive rates, specialized adaptations, and dependence on forests. They play a vital ecological role as herbivores, omnivores, insectivores, ecosystem engineers, and seed dispersers, contributing to the maintenance of forest biodiversity and ecosystem equilibrium. Many also exhibit distinctive evolutionary characteristics. Notably, they hold economic and cultural significance, but anthropogenic activities put them at high risk of extinction today.
        </p>

        <p class="mt-4 text-green-200/80 leading-relaxed">
            This website documents their biology, ecology, and conservation status —
            not as statistics, but as living organisms fighting for survival.
        </p>
    </div>
</section>
@endsection
