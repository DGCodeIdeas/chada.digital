@extends('layouts.app')

@section('content')
    @include('partials.hero')               {{-- 1. hero (upgraded, dual CTA) --}}
    @include('partials.stats-bar', ['variant' => 'home_top'])  {{-- 2. NEW — guarded while stats are null --}}
    @include('partials.trust-bar')          {{-- 3. guarded until logos exist --}}
    @include('partials.goal-picker')        {{-- 4. upgraded — Pricing block --}}
    @include('partials.audit-cta')          {{-- 5. renamed + reframed from the old assessment CTA --}}
    @include('partials.working-together')   {{-- 6. NEW — transition band --}}
    @include('partials.services-checklist') {{-- 7. upgraded — 12-item checklist --}}
    @include('partials.webinar-optin')      {{-- 8. NEW — renders nothing while disabled --}}
    @include('partials.founder-bio')        {{-- 9. kept --}}
    {{-- Redesign(7) inserts: @include('partials.demo-lab') and Redesign(4) inserts: @include('partials.workflow-system') here --}}
    @include('partials.case-studies')                     {{-- 12. results grid (renders when studies are published) --}}
    @include('partials.stats-bar', ['variant' => 'home_bottom'])  {{-- 13. stats repeat (guarded) --}}
    @include('partials.testimonials')       {{-- 14. upgraded — standards band above --}}
    {{-- Redesign(7) inserts: @include('partials.martech') here --}}
    @include('partials.exclusivity-cta')    {{-- 16. kept --}}
    @include('partials.contact')            {{-- 17. untouched --}}
@endsection