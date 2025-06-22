@extends('layouts.app')

@section('content')
    @include('components.navbar')
    @include('components.hero')
    @include('components.features')
    @include('components.create-message')
    @include('components.testimonials')
    @include('components.faq')
    @include('components.cta')
    @include('components.footer')
@endsection
