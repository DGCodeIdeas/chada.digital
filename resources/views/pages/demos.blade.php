@extends('layouts.app')

@section('content')

<section style="background: linear-gradient(135deg, #f8f6f3 0%, #f0ede8 100%); padding: 4rem 0 3rem;">
    <div class="container text-center">
        <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.08em;">Frontend</p>
        <h1 class="display-6 fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface); font-size: 2.25rem;">See Our Work</h1>
        <p class="mx-auto" style="max-width: 540px; color: var(--md-sys-color-on-surface-variant); font-size: 0.9375rem; line-height: 1.65;">
            Eighteen clickable sites, grouped the way we actually get hired: shops, clinics, schools, and the rest. Open one and poke around.
        </p>
    </div>
</section>

<section style="background: var(--md-sys-color-surface); padding: 3rem 0;">
    <div class="container">
        @php
        // Group demos by category, preserving order
        $grouped = [];
        foreach ($demos as $demo) {
            $cat = $demo['category'] ?? 'Other';
            $grouped[$cat][] = $demo;
        }
        @endphp
        @foreach($grouped as $categoryName => $categoryDemos)
        <div class="mb-5">
            <h2 class="fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface); font-size: 1.25rem;">{{ $categoryName }}</h2>
            <div class="row g-3">
                @foreach($categoryDemos as $demo)
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('preview.show', $demo['slug']) }}" class="text-decoration-none">
                        <div class="card h-100 overflow-hidden" style="background: var(--md-sys-color-surface-container-low); border-radius: 12px; box-shadow: var(--md-sys-elevation-1, 0 1px 2px 0 rgba(0,0,0,0.03)); transition: box-shadow 0.2s ease, transform 0.2s ease;" onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow='var(--md-sys-elevation-1, 0 1px 2px 0 rgba(0,0,0,0.03))'; this.style.transform=''">
                            @if(isset($demo['thumbnail']) && $demo['thumbnail'])
                            <div class="ratio ratio-16x9" style="background: var(--md-sys-color-surface-container-highest);">
                                <img src="{{ asset($demo['thumbnail']) }}" alt="{{ $demo['title'] }} preview" style="object-fit: cover;" loading="lazy">
                            </div>
                            @endif
                            <div class="card-body p-3">
                                <h6 class="fw-semibold mb-1" style="color: var(--md-sys-color-on-surface); font-size: 0.9375rem;">{{ $demo['title'] }}</h6>
                                <p class="mb-0" style="font-size: 0.75rem; color: var(--md-sys-color-primary);">View frontend →</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection
