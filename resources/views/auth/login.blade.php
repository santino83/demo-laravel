@extends('layouts.base')

@section('title')
    Register
@endsection

@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('styles/login.css') }}">
@append

@section('body')

    <div class="form-signin text-center">

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

            <div class="form-floating">
                <input type="text" id="login_email" class="form-control @error('email') is-invalid @enderror"
                       required autofocus autocomplete="email" name="email" value="{{ old('email') }}"
                       placeholder="Email"/>
                <label for="login_email" class="required">Email</label>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating">
                <input type="password" id="login_password"
                       class="form-control @error('password') is-invalid @enderror" required
                       autocomplete="current-password" placeholder="Password" name="password"/>
                <label for="login_password" class="required">Password</label>
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">
                Sign in
            </button>

            <a href="{{ route('register') }}" class="btn" style="font-size: 14px">No account? Register now</a>

        </form>

    </div>

@stop
