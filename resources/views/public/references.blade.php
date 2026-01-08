@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <h1 data-portal class="reveal-portal text-3xl font-bold" style="--reveal-delay: 0ms">
    <span>References</span>
</h1>

<p data-reveal class="reveal-pop muted mt-2" style="--reveal-delay: 120ms">
    Grouped by species.
</p>


    <div class="mt-10 space-y-10">
        @foreach($species as $sp)
            <section data-reveal class="reveal-pop card rounded-2xl p-5">
                <h2 class="text-xl font-semibold">
                    <a href="{{ route('species.show', $sp->slug) }}" class="hover:underline">
                        {{ $sp->common_name }}
                    </a>
                    @if($sp->scientific_name)
                        <span class="muted italic font-normal">— {{ $sp->scientific_name }}</span>
                    @endif
                </h2>

                @if($sp->references->count())
                    <ol class="list-decimal pl-6 mt-4 space-y-2 text-green-50/90">
                        @foreach($sp->references as $ref)
                            <li>
                                {{ $ref->citation }}
                                @if($ref->link)
                                    <a href="{{ $ref->link }}" class="text-blue-600 hover:underline" target="_blank" rel="noreferrer">Link</a>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                @else
                    <p class="text-gray-500 italic mt-3">No references yet.</p>
                @endif
            </section>
        @endforeach
    </div>
</div>
@endsection
