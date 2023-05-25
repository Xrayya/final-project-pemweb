@extends('layouts.main')

@section('extended_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('body_header')
    @include('partials.navbar')
@endsection

@section('container')
    <main class="col-lg-5 col-md-8 m-auto">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Hooray, <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                {{ auth()->user()->display_name }}
                <small class="text-muted">
                    - <a href="/profile/{{ auth()->user()->id }}"
                        class="text-decoration-none text-muted">{{ '@' . auth()->user()->username }}</a>
                </small>
            </div>
            <div class="card-body">
                <div class="mb-1">
                    <form action="/post" method="post">
                        @csrf
                        <textarea class="form-control" id="post" name="post" rows="3" placeholder="Type something..."
                            maxlength="255"></textarea>
                        <input type="submit" class="btn btn-primary mt-2" value="Post">
                    </form>
                </div>
            </div>
        </div>
        <hr>
        @foreach ($posts as $post)
            <div class="card text-start my-1">
                <div class="card-header">
                    {{ $post->user->display_name }}
                    <small class="text-muted">
                        - <a href="/profile/{{ $post->user->id }}"
                            class="text-decoration-none text-muted">{{ '@' . $post->user->username }}</a> ·
                        {{ $post->created_at->diffForHumans() }}
                    </small>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <a href="/post/{{ $post->id }}" class="text-decoration-none text-black d-block">
                            {{ $post->post }}
                        </a>
                    </p>
                    <div class="w-100">
                        <button class="border border-0 bg-transparent text-body-tertiary like-button"
                            data-id-user="{{ auth()->user()->id }}" data-id-post='{{ $post->id }}'>
                            @if ($post->liked == true)
                                <i class="bi bi-suit-heart-fill"></i>
                            @else
                                <i class="bi bi-suit-heart"></i>
                            @endif
                            <span class="like-count">{{ $post->likes->count() }}</span>
                        </button>
                        <button class="border border-0 bg-transparent text-body-tertiary comment-button">
                            <i class="bi bi-chat-dots"></i>
                            <span class="comment-count">{{ $post->children->count() }}</span>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </main>
@endsection

@section('body_footer')
    <script src="js/sidebars.js"></script>
    <script src="js/likes.js"></script>
@endsection
