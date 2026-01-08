@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="mb-10">
    <h1
        data-portal
        class="reveal-portal text-3xl font-bold"
        style="--reveal-delay: 0ms"
    >
        <span>{{ $settings?->site_title ?? 'Organism Exhibit' }}</span>
    </h1>

    @if($settings?->site_subtitle)
        <p
            data-reveal
            class="reveal-pop text-lg muted mt-2"
            style="--reveal-delay: 120ms"
        >
            {{ $settings->site_subtitle }}
        </p>
    @endif

    @if($heroSrc ?? false)
        <div
            data-reveal
            class="reveal-pop mt-6 rounded-xl overflow-hidden border"
            style="--reveal-delay: 220ms"
        >
            <img src="{{ $heroSrc }}" alt="Hero" class="w-full h-64 object-cover">
        </div>
    @endif

    @if($settings?->overview_text)
        <div
            data-reveal
            class="reveal-pop mt-6 text-green-50/90 leading-relaxed"
            style="--reveal-delay: 320ms"
        >
            {!! nl2br(e($settings->overview_text)) !!}
        </div>
    @endif
</div>


    <h2 data-portal class="reveal-portal text-xl font-semibold mb-4" style="--reveal-delay: 0ms">
    <span>Species</span>
</h2>


    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($species as $sp)
            <a
    data-reveal
    href="{{ route('species.show', $sp->slug) }}"
    class="reveal-pop block card rounded-2xl overflow-hidden hover:shadow-lg transition"
>

                @if($sp->hero_image)
    @php
        $rawHero = $sp->hero_image;
        $heroPath = null;

        if (is_array($rawHero)) {
            $heroPath = collect($rawHero)->values()->first();
        } elseif (is_string($rawHero)) {
            $decoded = json_decode($rawHero, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $heroPath = collect($decoded)->first();
            } else {
                $heroPath = $rawHero;
            }
        }

        $heroPath = $heroPath ? ltrim($heroPath, '/') : null;

        $heroSrc = null;
        if ($heroPath) {
            if (str_starts_with($heroPath, 'http://') || str_starts_with($heroPath, 'https://')) {
                $heroSrc = $heroPath;
            } elseif (str_starts_with($heroPath, 'uploads/') || str_starts_with($heroPath, 'storage/')) {
                $heroSrc = asset($heroPath);
            } else {
                $heroSrc = asset('storage/' . $heroPath);
            }
        }
    @endphp

    @if($heroSrc)
        <img src="{{ $heroSrc }}" class="w-full h-40 object-cover" alt="{{ $sp->common_name }}">
    @endif
@endif


                <div class="p-4">
                    <div class="font-semibold">{{ $sp->common_name }}</div>
                    @if($sp->scientific_name)
                        <div class="text-sm muted italic">{{ $sp->scientific_name }}</div>
                    @endif
                    @if($sp->short_intro)
                        <p class="text-sm text-green-50/80 mt-2">{{ $sp->short_intro }}</p>
                    @endif
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
