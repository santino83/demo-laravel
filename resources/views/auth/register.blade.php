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

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <h1 class="h3 mb-3 font-weight-normal">Registration Form</h1>

            <div class="form-floating">
                <input type="text" id="register_email" class="form-control @error('email') is-invalid @enderror"
                       required autofocus autocomplete="email" name="email" value="{{ old('email') }}"
                       placeholder="Email"/>
                <label for="register_email" class="required">Email</label>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating">
                <input type="password" id="register_password"
                       class="form-control @error('password') is-invalid @enderror" required
                       autocomplete="current-password" placeholder="Password" name="password"/>
                <label for="register_password" class="required">Password</label>
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating">
                <input type="text" id="register_firstname" name="firstname"
                       class="form-control @error('firstname') is-invalid @enderror" required autocomplete="given-name"
                       value="{{ old('firstname') }}"
                       placeholder="First Name"/>
                <label for="register_firstname" class="required">First Name</label>
                @error('firstname')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="text" id="register_lastname" name="lastname"
                       class="form-control @error('lastname') is-invalid @enderror" required autocomplete="family-name"
                       value="{{ old('lastname') }}"
                       placeholder="Last Name"/>
                <label for="register_lastname" class="required">Last Name</label>
                @error('lastname')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="registration_form_agreeTerms" class="required">Agree terms</label>
                <input type="checkbox" id="registration_form_agreeTerms" name="agree_terms" required="required"
                       value="1">
            </div>

            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">
                Register
            </button>

            <a href="{{ route('homepage') }}" class="btn" style="font-size: 14px">Back to homepage</a>

        </form>

    </div>

@stop
