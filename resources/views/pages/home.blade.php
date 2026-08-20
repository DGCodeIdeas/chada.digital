@extends('layouts.app')

@section('content')
    @include('partials.hero')
    @include('partials.trust-bar')   {{-- guarded, renders nothing until logos exist --}}
    @include('partials.stats')       {{-- NEW: big-number proof bar --}}
    @include('partials.manifesto')   {{-- NEW: accountability principles --}}
    @include('partials.process')     {{-- id="process" --}}
    @include('partials.about')
    @include('partials.services')
    @include('partials.case-studies')
    @include('partials.founder')     {{-- NEW: founder personal-brand block --}}
    @include('partials.testimonials') {{-- NEW: client reviews --}}
    @include('partials.martech')     {{-- NEW: tech stack grid --}}
    @include('partials.products')
    @include('partials.contact')
@endsection
