@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <a href="{{ route('home') }}" class="text-sm link">← Back to Home</a>

    <header class="mt-4">
        <h1 class="text-3xl font-bold">{{ $species->common_name }}</h1>

        @if($species->scientific_name)
            <p class="text-lg muted italic">{{ $species->scientific_name }}</p>
        @endif

                @if($species->hero_image)
            @php
                $rawHero = $species->hero_image;
                $heroPath = null;

                // If already an array, grab the first value
                if (is_array($rawHero)) {
                    $heroPath = collect($rawHero)->first();
                }
                // If it's a JSON string, decode it then grab first value
                elseif (is_string($rawHero)) {
                    $decoded = json_decode($rawHero, true);

                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                        $heroPath = collect($decoded)->first();
                    } else {
                        // fallback: treat as normal string path
                        $heroPath = $rawHero;
                    }
                }

                $heroPath = $heroPath ? ltrim($heroPath, '/') : null;

                // Build final URL:
                // - If it's already "uploads/..." or "storage/...", just asset() it
                // - Else assume it's a storage public disk path and prefix "storage/"
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
                <div class="mt-6 rounded-xl overflow-hidden border border-green-400/10">
                    <img
                        src="{{ $heroSrc }}"
                        alt="{{ $species->common_name }}"
                        class="w-full h-72 object-cover"
                    />
                </div>
            @endif
        @endif

@php
    $italicizeScientificName = function (?string $text) use ($species): string {
        if ($text === null || $text === '') return '';

        $sci = trim((string) ($species->scientific_name ?? ''));
        // Always escape the full text first (prevents HTML injection)
        $escapedText = e($text);

        if ($sci === '') {
            return $escapedText;
        }

        $escapedSci = e($sci);

        // Replace the *escaped* scientific name with an italic HTML tag
        // so only that exact name becomes italic, everything else stays normal.
        return str_replace($escapedSci, '<em>' . $escapedSci . '</em>', $escapedText);
    };
@endphp

        @if($species->short_intro)
            <p class="mt-6 text-green-50/90 leading-relaxed">{{ $species->short_intro }}</p>
        @endif
    </header>


    @php
        // Exclude old taxonomy section if it exists in sections table
        $sections = $species->sections->where('key', '!=', 'taxonomy');

        // Taxonomy JSON (new system)
        $hasTaxonomy = !empty($species->taxonomy) && is_array($species->taxonomy);

        // Group images by placement (section_key). Null defaults to 'gallery'
        $imagesBySection = $species->images->groupBy(function ($img) {
            return $img->section_key ?: 'gallery';
        });

        // Images that should show in the bottom gallery
        $galleryImages = $imagesBySection['gallery'] ?? collect();

        // Helper to build image src (URL / public/ path / storage path)
        $resolveImageSrc = function ($path) {
            $path = $path ?? '';
            if ($path === '') return '';

            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                return $path; // direct URL
            }

            // if you store paths like images/... in public/
            if (str_starts_with($path, 'images/') || str_starts_with($path, 'maps/')) {
                return asset($path);
            }

            // default storage/app/public
            return asset('storage/' . ltrim($path, '/'));
        };
    @endphp

    {{-- Quick jump links --}}
    @if($sections->count() || $hasTaxonomy)
        <nav class="mt-8 p-5 card rounded-2xl">
            <div class="font-semibold mb-2 text-green-100">On this page</div>

            <div class="flex flex-wrap gap-2 text-sm">
                {{-- Taxonomy pill --}}
                @if($hasTaxonomy)
                    <a class="px-3 py-1 rounded-full pill text-green-100 transition" href="#taxonomy">
                        Taxonomic Classification
                    </a>
                @endif

                {{-- Section pills --}}
                @foreach($sections as $section)
                    <a class="px-3 py-1 rounded-full pill text-green-100 transition" href="#section-{{ $section->key }}">
                        {{ $section->title }}
                    </a>
                @endforeach

                <a class="px-3 py-1 rounded-full pill text-green-100 transition" href="#images">Images</a>
                <a class="px-3 py-1 rounded-full pill text-green-100 transition" href="#refs">References</a>
            </div>
        </nav>
    @endif

    <div class="mt-10 space-y-10">

        {{-- Taxonomy (new system, not stored as a section) --}}
        @if($hasTaxonomy)
            @php
                $tax = $species->taxonomy;
                $rows = [
                    'Kingdom' => 'kingdom',
                    'Phylum' => 'phylum',
                    'Subphylum' => 'subphylum',
                    'Class' => 'class',
                    'Order' => 'order',
                    'Family' => 'family',
                    'Genus' => 'genus',
                    'Species' => 'species',
                ];
            @endphp

            <section id="taxonomy" class="scroll-mt-24">
                <h2 class="text-2xl font-semibold mb-3 text-green-100">Taxonomic Classification</h2>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr>
                                <th class="border border-green-400/15 p-2 bg-green-950/40">Rank</th>
                                <th class="border border-green-400/15 p-2 bg-green-950/40">Scientific Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $label => $key)
                                <tr class="hover:bg-green-900/20 transition">
                                    <td class="border border-green-400/15 p-2 font-medium">{{ $label }}</td>
                                    <td class="border border-green-400/15 p-2">
    @if(in_array($label, ['Genus', 'Species'], true))
        <em>{{ $tax[$key] ?? '—' }}</em>
    @else
        {{ $tax[$key] ?? '—' }}
    @endif
</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        @endif

        {{-- Sections --}}
        @foreach($sections as $section)
            <section id="section-{{ $section->key }}" class="scroll-mt-24">
                <h2 class="text-2xl font-semibold mb-3 text-green-100">{{ $section->title }}</h2>

                @if($section->content)
                    <div class="prose prose-invert max-w-none text-green-50/90 leading-relaxed">
                        {!! nl2br($italicizeScientificName($section->content)) !!}
                    </div>
                @else
                    <p class="muted italic">No content yet.</p>
                @endif

                {{-- ✅ Section-specific images (client request) --}}
                @php
                    $inlineImages = $imagesBySection[$section->key] ?? collect();
                @endphp

                @if($inlineImages->count())
                    <div class="mt-6 grid sm:grid-cols-2 gap-4">
                        @foreach($inlineImages as $img)
                            @php
                                $src = $resolveImageSrc($img->image_path ?? '');
                            @endphp

                            <figure class="rounded-2xl overflow-hidden border border-green-400/10 bg-green-950/25">
                                @if($src)
                                    <img
    src="{{ str_starts_with($img->image_path ?? '', 'http')
        ? ($img->image_path ?? '')
        : asset('storage/' . ltrim(($img->image_path ?? ''), '/')) }}"
    alt="{{ $img->caption ?? 'Species image' }}"
    class="w-full h-56 object-cover"
    loading="lazy"
/>

                                @endif

                                @if($img->caption || $img->credit)
                                    <figcaption class="p-3 text-sm">
                                        @if($img->caption)
                                            <div class="font-semibold text-green-100">{!! $italicizeScientificName($img->caption) !!}</div>
                                        @endif
                                        @if($img->credit)
                                            <div class="muted mt-1">{{ $img->credit }}</div>
                                        @endif
                                    </figcaption>
                                @endif
                            </figure>
                        @endforeach
                    </div>
                @endif
            </section>
        @endforeach

        {{-- Images gallery (separate section) --}}
        <section id="images" class="scroll-mt-24">
            <h2 class="text-2xl font-semibold mb-3 text-green-100">Images / Illustrations / Diagrams</h2>

            @if($galleryImages->count())
                <div class="grid sm:grid-cols-2 gap-4">
                    @foreach($galleryImages as $img)
                        @php
                            $src = $resolveImageSrc($img->image_path ?? '');
                        @endphp

                        <figure class="rounded-2xl overflow-hidden border border-green-400/10 bg-green-950/25">
                            @if($src)
                                <img
    src="{{ str_starts_with($img->image_path ?? '', 'http')
        ? ($img->image_path ?? '')
        : asset('storage/' . ltrim(($img->image_path ?? ''), '/')) }}"
    alt="{{ $img->caption ?? 'Species image' }}"
    class="w-full h-56 object-cover"
    loading="lazy"
/>

                            @endif

                            @if($img->caption || $img->credit)
                                <figcaption class="p-3 text-sm">
                                    @if($img->caption)
                                        <div class="font-semibold text-green-100">{!! $italicizeScientificName($img->caption) !!}</div>
                                    @endif
                                    @if($img->credit)
                                        <div class="muted mt-1">{{ $img->credit }}</div>
                                    @endif
                                </figcaption>
                            @endif
                        </figure>
                    @endforeach
                </div>
            @else
                <p class="muted italic">No images yet.</p>
            @endif
        </section>

        {{-- References --}}
        <section id="refs" class="scroll-mt-24">
            <h2 class="text-2xl font-semibold mb-3 text-green-100">References</h2>

            @if($species->references->count())
                <ol class="list-decimal pl-6 space-y-2 text-green-50/90">
                    @foreach($species->references as $ref)
    <li class="leading-relaxed">
        <span>{!! $italicizeScientificName($ref->citation) !!}</span>

        @if(!empty($ref->link))
            <a
                href="{{ $ref->link }}"
                target="_blank"
                rel="noreferrer"
                class="ml-2 text-blue-400 hover:text-blue-300 underline text-sm"
            >
                View Source
            </a>
        @endif
    </li>
@endforeach

                </ol>
            @else
                <p class="muted italic">No references yet.</p>
            @endif
        </section>

    </div>
</div>
@endsection
