@extends('layouts.main')

@section('extended_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('body_header')
    @include('partials.navbar')
@endsection

@section('container')
    <main class="col-lg-5 col-md-8 m-auto">
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
                    {{ $post->post }}
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
                </div>
                <div class="w-100">
                    <hr>
                    <p class="text-muted">comments</p>
                    <div class="card">
                        <div class="card-header">
                            {{ auth()->user()->display_name }}
                            <small class="text-muted">
                                - <a href="/profile/{{auth()->user()->id}}"
                                    class="text-decoration-none text-muted">{{ '@' . auth()->user()->username }}</a>
                            </small>
                        </div>
                        <div class="card-body">
                            <div class="mb-1">
                                <form action="/post" method="post">
                                    @csrf
                                    <input type="hidden" name="parent" value="{{ $post->id }}">
                                    <textarea class="form-control" id="post" name="post" rows="3" placeholder="Type something..."
                                        maxlength="255" required></textarea>
                                    <input type="submit" class="btn btn-primary mt-2" value="Post">
                                </form>
                            </div>
                        </div>
                    </div>
                    @foreach ($comments as $comment)
                        <div class="card text-start my-1">
                            <div class="card-header">
                                {{ $comment->user->display_name }}
                                <small class="text-muted">
                                    - <a href="/profile/{{$comment->user->id}}"
                                        class="text-decoration-none text-muted">{{ '@' . $comment->user->username }}</a> ·
                                    {{ $comment->created_at->diffForHumans() }}
                                </small>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    {{ $comment->post }}
                                </p>
                                <div class="w-100">
                                    <button class="border border-0 bg-transparent text-body-tertiary like-button"
                                        data-id-user="{{ auth()->user()->id }}" data-id-post='{{ $comment->id }}'>
                                        @if ($comment->liked == true)
                                            <i class="bi bi-suit-heart-fill"></i>
                                        @else
                                            <i class="bi bi-suit-heart"></i>
                                        @endif
                                        <span class="like-count">{{ $comment->likes->count() }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection

@section('body_footer')
    <script src="../js/sidebars.js"></script>
    <script src="../js/likes.js"></script>
@endsection
