@extends('layouts.app')

@section('content')
    @include('partials.hero')
    @include('partials.trust-bar')   {{-- guarded, renders nothing until logos exist --}}
    @include('partials.process')     {{-- id="process" --}}
    @include('partials.about')
    @include('partials.services')
    @include('partials.case-studies')
    @include('partials.products')
    @include('partials.contact')
@endsection
