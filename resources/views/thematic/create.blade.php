@extends('layouts.admin')

@section('title')
    New Thematic
@overwrite

@section('content')
    <h1>Create New Thematic</h1>

    @include('thematic._form')

    <a class="btn btn-outline-primary px-2 py-0" href="{{ route('admin.thematic.index') }}"><i class="bi bi-arrow-left fs-4 me-2"></i> back to list</a>

@stop
