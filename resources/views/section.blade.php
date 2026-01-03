@extends('layouts.app')

@section('content')
  <div class="mb-6">
    <a class="text-indigo-200/90 hover:text-indigo-200" href="{{ route('home') }}">← Back</a>
  </div>

  <article class="rounded-2xl border border-white/10 bg-white/5 p-6 shadow-xl shadow-black/30">
    <h1 class="text-3xl font-bold tracking-tight">{{ $section['title'] }}</h1>
    <p class="mt-4 whitespace-pre-line text-slate-200/80">{{ $section['body'] }}</p>
  </article>
@endsection
