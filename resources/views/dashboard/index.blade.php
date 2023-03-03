@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.admin')

@section('content')

    <div class="text-center">
        @if(Auth::user())
            <h1>Hello {{ Auth::user()->firstname.' '.Auth::user()->lastname }}!</h1>
        @else
            <h1>Hello anonymous</h1>
        @endif

        Here is your WebSite Admin Panel
    </div>

@stop
