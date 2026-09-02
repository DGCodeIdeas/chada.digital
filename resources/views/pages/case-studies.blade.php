@extends('layouts.app')

@section('content')

<section style="background: linear-gradient(135deg, #f8f6f3 0%, #f0ede8 100%); padding: 4rem 0 3rem;">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <p class="fw-semibold mb-2" style="color: var(--md-sys-color-primary); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.08em;">Portfolio</p>
                <h1 class="display-6 fw-bold mb-3" style="font-family: 'Outfit', sans-serif; color: var(--md-sys-color-on-surface); font-size: 2.25rem;">Case Studies Coming Soon</h1>
                <p class="mb-4" style="color: var(--md-sys-color-on-surface-variant); font-size: 0.9375rem; line-height: 1.65; max-width: 540px; margin-left: auto; margin-right: auto;">
                    We are working on detailed case studies for each of our demo projects. Each one will include the full workflow, tech stack, and verified business outcomes. In the meantime, you can explore the live frontend of each project below.
                </p>
                <div class="d-flex flex-wrap gap-2 justify-content-center">
                    <a href="{{ route('demos') }}" class="btn btn-primary rounded-pill" style="background: var(--md-sys-color-primary); border-color: var(--md-sys-color-primary); color: var(--md-sys-color-on-primary); font-weight: 500; font-size: 0.8125rem; padding: 0.5rem 1rem;">
                        See the Frontend
                    </a>
                    <a href="{{ route('services') }}" class="btn btn-outline-primary rounded-pill" style="border-color: var(--md-sys-color-primary); color: var(--md-sys-color-primary); font-weight: 500; font-size: 0.8125rem; padding: 0.5rem 1rem;">
                        View Services & Pricing
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-primary rounded-pill" style="border-color: var(--md-sys-color-primary); color: var(--md-sys-color-primary); font-weight: 500; font-size: 0.8125rem; padding: 0.5rem 1rem;">
                        Start a Project
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="background: var(--md-sys-color-surface); padding: 3rem 0;">
    <div class="container">
        <div class="row g-3 justify-content-center">
            @php
            $demos = [
                ['name' => 'Sterling & Vale', 'category' => 'Corporate Website'],
                ['name' => 'ApexFlow', 'category' => 'SaaS Onboarding'],
                ['name' => 'ELYSIAN', 'category' => 'Hotel Booking Engine'],
                ['name' => 'HIREBASE', 'category' => 'Job Matching Platform'],
                ['name' => 'NOIR', 'category' => 'Fashion E-Commerce'],
                ['name' => 'TimberMill', 'category' => 'Artisan Catalogue'],
            ];
            @endphp
            @foreach($demos as $demo)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100" style="background: var(--md-sys-color-surface-container-low); border-radius: 12px; opacity: 0.6;">
                    <div class="card-body p-3">
                        <span class="badge rounded-pill mb-2" style="background: var(--md-sys-color-surface-container-highest); color: var(--md-sys-color-on-surface-variant); font-weight: 500; font-size: 0.6875rem;">{{ $demo['category'] }}</span>
                        <h6 class="fw-semibold mb-0" style="color: var(--md-sys-color-on-surface); font-size: 0.9375rem;">{{ $demo['name'] }}</h6>
                        <p class="mt-2 mb-0" style="font-size: 0.75rem; color: var(--md-sys-color-on-surface-variant); font-style: italic;">Case study in progress</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
