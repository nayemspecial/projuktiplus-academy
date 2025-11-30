@extends('frontend.layouts.master') 

@section('title', 'হোম')

@section('content')
    @include('frontend.partials.hero')
    @include('frontend.partials.tech-stack')
    @include('frontend.partials.courses-list')
    @include('frontend.partials.testimonials')
    <!-- @include('frontend.partials.learning-path') -->
    <!-- @include('frontend.partials.instructor-showcase') -->
@endsection