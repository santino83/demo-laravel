@extends('layouts.admin')

@section('title')
    Edit Carousel
@overwrite

@section('content')
    <h1>Edit Carousel</h1>

    @include('carousel._form', ['button_label' => 'Update'])

    <a class="btn btn-outline-primary px-2 py-0" href="{{ route('admin.carousel.index') }}"><i class="bi bi-arrow-left fs-4 me-2"></i> back to list</a>

@stop
