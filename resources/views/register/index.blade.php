@extends('layouts.main')

@section('extended_header')
    <!-- Custom styles for this template -->
    <link href="css/sign-up.css" rel="stylesheet">
@endsection


@section('container')
    <main class="form-signin col-lg-4 col-md-8 m-auto">
        @if (session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Sorry, <strong>{{ session('loginError') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1 class="h3 mb-3 fw-normal text-center">Join Us!</h1>
        <form action="/signup" method="post">
            @csrf
            <div class="form-floating">
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                    id="username-form" placeholder="Username" required>
                <label for="username-form">Username</label>
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating">
                <input type="text" name="display_name" class="form-control @error('display_name') is-invalid @enderror"
                    id="display-name-form" placeholder="Display name" required>
                <label for="display-name-form">Display name</label>
                @error('display-name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    id="email-form" placeholder="name@example.com" required>
                <label for="email-form">Email address</label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="password-form" placeholder="Password"
                    minlength="8" maxlength="32" required>
                <label for="password-form">Password</label>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating">
                <input type="password" name="confirm-password" class="form-control" id="confirm-passoword-form"
                    placeholder="Confirm password" minlength="8" maxlength="32" required>
                <label for="confirm-password-form">Confirm Password</label>
                @error('confirm-password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button class="w-100 btn btn-md btn-primary" type="submit">Sign Up</button>
            <p class="text-center mt-2"><small>Already have account? <a href="/signin">Sign In!</a></small></p>
        </form>
    </main>
@endsection
