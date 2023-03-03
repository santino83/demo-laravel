@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Support\Str;
@endphp

@extends('layouts.base')

@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('styles/admin.css') }}">
@append

@section('javascripts')
    @parent
    <script src="{{ asset('js/admin.js') }}"></script>
@append

@section('body')

    <main>


        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <i class="bi-building-lock me-2 fs-4"></i>
                <span class="fs-4">Admin</span>
            </a>
            <hr>

            <ul class="nav nav-pills flex-column mb-auto">

                @php($route_name = Route::currentRouteName())

                <li>
                    <a href="{{ route('admin.dashboard.index') }}"
                       class="nav-link {{ Str::startsWith($route_name, 'admin.dashboard.') ? 'active' : '' }} text-white">
                        <i class="bi bi-speedometer2 me-2"></i>
                        Dashboard
                    </a>
                </li>

              <li>
                  <a href="{{ route('admin.carousel.index') }}" class="nav-link {{ Str::startsWith($route_name, 'admin.carousel.') ? 'active' : '' }} text-white">
                      <i class="bi bi-file-earmark-slides me-2"></i>
                      Carousels
                  </a>
              </li>

              <li>
                  <a href="{{ route('admin.thematic.index') }}" class="nav-link {{ Str::startsWith($route_name, 'admin.thematic.') ? 'active' : '' }} text-white">
                      <i class="bi-grid me-2"></i>
                      Thematics
                  </a>
              </li>

            </ul>
            <hr>
            <div class="dropup dropup-center">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                   id="authUserMenu" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle fs-3"></i>
                    <span class="ps-1 small">{{ Auth::user()->email }}</span>
                </a>
                <ul class="dropdown-menu text-small dropdown-menu-ri" data-bs-theme="dark"
                    aria-labelledby="authUserMenu" style="">
                    <li><a class="dropdown-item" href="{{ route('logout') }}">Sign out</a></li>
                </ul>
            </div>
        </div>
        <div class="sidebar-divider"></div>

        <div class="w-100 px-3 py-2 overflow-y-auto">
            @yield('content')
        </div>
    </main>

@endsection
