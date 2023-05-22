@extends('layouts.main')

@section('extended_header')
    <!-- Custom styles for this template -->
    <link href="css/sign-in.css" rel="stylesheet">
@endsection


@section('container')
    <main class="form-signin col-lg-4 col-md-8 m-auto">
        <form method="post">
            <h1 class="h3 mb-3 fw-normal text-center">Please sign in</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="email-form" placeholder="name@example.com">
                <label for="email-form">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password-form" placeholder="Password">
                <label for="password-form">Password</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="w-100 btn btn-md btn-primary" type="submit">Sign in</button>
        </form>
    </main>
@endsection
