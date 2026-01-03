<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\Species;

class PublicSiteController extends Controller
{
    public function home()
    {
        $settings = SiteSetting::query()->first();

        $species = Species::query()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->get();

        return view('public.home', compact('settings', 'species'));
    }

    public function species(string $slug)
    {
        $settings = SiteSetting::query()->first();

        $species = Species::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->with([
                'sections' => fn ($q) => $q
    ->where('is_enabled', true)
    ->where('key', '!=', 'taxonomy') // ✅ exclude old taxonomy section
    ->orderBy('sort_order'),
                'images' => fn ($q) => $q->orderBy('sort_order'),
                'references' => fn ($q) => $q->orderBy('sort_order'),
            ])
            ->firstOrFail();

        return view('public.species', compact('settings', 'species'));
    }

    public function references()
    {
        $settings = SiteSetting::query()->first();

        $species = Species::query()
            ->where('is_published', true)
            ->with(['references' => fn ($q) => $q->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->get();

        return view('public.references', compact('settings', 'species'));
    }
}
