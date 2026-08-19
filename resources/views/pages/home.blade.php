@extends('layouts.app')

@section('content')
    @include('partials.hero')
    @include('partials.trust-bar')   {{-- guarded, renders nothing until logos exist --}}
    @include('partials.process')     {{-- id="process" --}}
    @include('partials.about')
    @include('partials.services')
    @include('partials.portfolio')   {{-- becomes case-studies in Phase 3 --}}
    @include('partials.products')
    @include('partials.contact')
@endsection
