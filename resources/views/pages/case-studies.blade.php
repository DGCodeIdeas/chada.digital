@extends('layouts.app')

@section('content')

<section style="background: linear-gradient(135deg, #f8f6f3 0%, #f0ede8 100%); padding: 5rem 0 3rem;">
    <div class="container">
        <div class="text-center mb-5">
            <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em;">Portfolio</p>
            <h1 class="display-5 fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface);">Case Studies</h1>
            <p class="mx-auto" style="max-width: 600px; color: var(--md-sys-color-on-surface-variant); font-size: 1.125rem;">
                Real projects. Real metrics. Real businesses. Every case study includes the full workflow, tech stack, and business outcome.
            </p>
        </div>

        <!-- Category Filters -->
        <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
            @foreach($categories as $slug => $label)
            <a href="{{ route('case-studies.index', ['category' => $slug]) }}"
               class="btn {{ $category === $slug ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill px-4"
               style="{{ $category === $slug ? 'background: var(--md-sys-color-primary); border-color: var(--md-sys-color-primary); color: var(--md-sys-color-on-primary);' : 'border-color: var(--md-sys-color-outline); color: var(--md-sys-color-on-surface-variant);' }} font-weight: 500; font-size: 0.875rem;">
                {{ $label }}
            </a>
            @endforeach
        </div>
    </div>
</section>

<section style="background: var(--md-sys-color-surface); padding: 3rem 0 5rem;">
    <div class="container">
        <div class="row g-4">
            @forelse($studies as $study)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0" style="background: var(--md-sys-color-surface-container-low); border-radius: 16px; transition: transform 0.2s ease, box-shadow 0.2s ease;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 12px 24px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge rounded-pill" style="background: var(--md-sys-color-primary-container); color: var(--md-sys-color-on-primary-container); font-weight: 500; font-size: 0.75rem;">{{ $study['industry'] }}</span>
                            <span class="badge rounded-pill" style="background: var(--md-sys-color-secondary-container); color: var(--md-sys-color-on-secondary-container); font-weight: 500; font-size: 0.75rem;">{{ $categories[$study['category']] ?? $study['category'] }}</span>
                        </div>
                        <p class="fw-bold mb-2" style="font-family: 'Outfit', sans-serif; font-size: 2rem; color: var(--md-sys-color-primary);">{{ $study['metric'] }}</p>
                        <h5 class="fw-semibold mb-2" style="color: var(--md-sys-color-on-surface);">{{ $study['client'] }}</h5>
                        <p class="mb-3" style="font-size: 0.9375rem; color: var(--md-sys-color-on-surface-variant); line-height: 1.6;">{{ $study['excerpt'] }}</p>
                        <div class="d-flex flex-wrap gap-1 mb-3">
                            @foreach(array_slice($study['tech_stack'], 0, 4) as $tool)
                            <span class="badge" style="background: var(--md-sys-color-surface-container-highest); color: var(--md-sys-color-on-surface-variant); font-weight: 400; font-size: 0.75rem;">{{ $tool }}</span>
                            @endforeach
                        </div>
                        <a href="{{ route('case-study.show', $study['slug']) }}" class="text-decoration-none fw-medium" style="color: var(--md-sys-color-primary); font-size: 0.9375rem;">
                            Read Story →
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No case studies found in this category.</p>
                <a href="{{ route('case-studies.index') }}" class="btn btn-outline-primary rounded-pill">View All</a>
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
