@extends('layouts.app')

@section('content')
  <header class="mb-8">
    <h1 class="text-4xl font-bold tracking-tight">{{ $site['title'] }}</h1>
    <p class="mt-3 max-w-2xl text-slate-200/80">{{ $site['subtitle'] }}</p>
  </header>

  <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
    @foreach($site['sections'] as $key => $sec)
      <a href="{{ route('section', $key) }}"
         class="rounded-2xl border border-white/10 bg-white/5 p-5 shadow-xl shadow-black/30
                transition hover:-translate-y-1 hover:border-indigo-400/60">
        <h2 class="text-lg font-semibold">{{ $sec['title'] }}</h2>
        <p class="mt-2 text-sm text-slate-200/70">Open section →</p>
      </a>
    @endforeach
  </div>
@endsection
