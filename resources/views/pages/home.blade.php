@extends('layouts.app')

@section('content')
    @include('partials.hero')
    @include('partials.trust-bar')        {{-- guarded, renders nothing until logos exist --}}
    @include('partials.goal-picker')      {{-- id="goals" — built in Phase 2 --}}
    @include('partials.assessment-cta')   {{-- built in Phase 2 --}}
    @include('partials.testimonials')     {{-- built in Phase 2 --}}
    @include('partials.services-checklist') {{-- built in Phase 3 --}}
    @include('partials.founder-bio')      {{-- built in Phase 2 --}}
    @include('partials.exclusivity-cta')  {{-- built in Phase 2 --}}
    @include('partials.contact')
@endsection
