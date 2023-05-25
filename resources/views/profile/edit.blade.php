@extends('layouts.main')

@section('extended_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('body_header')
    @include('partials.navbar')
@endsection

@section('container')
    <main class="col-lg-5 col-md-8 m-auto">
        <div class="card">
            <div class="card-body">
                <form action="/profile" method="post">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="form-display-name" class="form-label">Display name</label>
                        <input type="text" name="display_name" class="form-control" id="form-display-name"
                            placeholder="Display Name" value="{{ $user->display_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="form-username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="form-username" placeholder="username"
                            value="{{ $user->username }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="form-email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="form-email"
                            placeholder="name@example.com" value="{{ $user->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="form-bio" class="form-label">Bio</label>
                        <textarea name="bio" class="form-control" id="form-bio" maxlength="255" rows="3">{{ $user->bio }}</textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary mb-3">Save Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

@section('body_footer')
    <script src="../js/sidebars.js"></script>
    <script src="../js/likes.js"></script>
@endsection
