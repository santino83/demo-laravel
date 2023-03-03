@extends('layouts.base')

@section('stylesheets')
    @parent

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@uvarov.frontend/vanilla-calendar@2.4.0/build/vanilla-calendar.min.css"
      crossorigin="anonymous">

<link rel="stylesheet" href="{{ asset('styles/public.css') }}">
@append

@section('javascripts')
    @parent

<script src="https://cdn.jsdelivr.net/npm/@uvarov.frontend/vanilla-calendar@2.4.0/build/vanilla-calendar.min.js"
        crossorigin="anonymous"></script>

<script src="{{ asset('js/public.js') }}"></script>
@append

@section('body')
<main>

    @include('components.navbar')

    @yield('content')

</main>
@stop
