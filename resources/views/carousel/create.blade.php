@extends('layouts.admin')

@section('title')
    New Carousel
@overwrite

@section('content')
    <h1>Create New Carousel</h1>

    @include('carousel._form')

    <a class="btn btn-outline-primary px-2 py-0" href="{{ route('admin.carousel.index') }}"><i class="bi bi-arrow-left fs-4 me-2"></i> back to list</a>

@stop
