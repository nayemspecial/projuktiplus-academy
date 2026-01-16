@extends('frontend.layouts.master') 

@section('title', 'হোম')

@section('content')
    @include('frontend.partials.hero')
    @include('frontend.partials.features')
    {{-- @include('frontend.partials.instructor') --}}
    @include('frontend.partials.curriculum')
    @include('frontend.partials.community')
    @include('frontend.partials.faq')
    @include('frontend.partials.courses-list')
    @include('frontend.partials.tech-stack')
    <!-- @include('frontend.partials.testimonials') -->
    <!-- @include('frontend.partials.learning-path') -->
@endsection