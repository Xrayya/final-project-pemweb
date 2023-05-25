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
            <div class="card-header text-center">
                <h5 class="card-title">{{ $user->display_name }}</h5>
                <small class="text-muted">
                    {{ '@' . $user->username }}
                </small>
            </div>
            <div class="card-body">
                <p class="card-text">{{ $user->bio }}</p>
                @if ($user->id != auth()->user()->id)
                    <form action="/toggle-follow" method="post">
                        @csrf
                        <input type="hidden" name="followed" value="{{ $user->id }}">
                        <input type="submit" class="btn {{ $isFollowed ? 'btn-outline-primary' : 'btn-primary' }} w-100"
                            value="{{ $isFollowed ? 'Unfollow' : 'Follow' }}">
                    </form>
                @else
                    <a href="/profile/{{ $user->id }}/edit" class="btn btn-outline-primary w-100">Edit Profile</a>
                @endif
                <hr>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-around">
                        <button type="button" class="btn" data-bs-toggle="modal"
                            data-bs-target="#followerModal">{{ $user->follower->count() }} follower</button>
                        <button type="button" class="btn" data-bs-toggle="modal"
                            data-bs-target="#followingModal">{{ $user->following->count() }} following</button>
                    </li>
                </ul>
            </div>
        </div>
        <hr>
        @foreach ($posts as $post)
            <div class="card text-start my-1">
                <div class="card-header">
                    {{ $post->user->display_name }}
                    <small class="text-muted">
                        - <a href="#" class="text-decoration-none text-muted">{{ '@' . $post->user->username }}</a> ·
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
                            data-id-user="{{ $user->id }}" data-id-post='{{ $post->id }}'>
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

    <div class="modal fade" id="followerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Follower</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @foreach ($followers as $follower)
                        <a href="/profile/{{ $follower->follower_user->id }}" class="text-decoration-none text-muted">
                            {{ $follower->follower_user->display_name }}
                            <small class="text-muted">
                                - {{ '@' . $follower->follower_user->username }}
                            </small>
                        </a>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="followingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Following</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @foreach ($followings as $following)
                        <a href="/profile/{{ $following->followed_user->id }}" class="text-decoration-none text-muted">
                            {{ $following->followed_user->display_name }}
                            <small class="text-muted">
                                - {{ '@' . $following->followed_user->username }}
                            </small>
                        </a>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body_footer')
    <script src="../js/sidebars.js"></script>
    <script src="../js/likes.js"></script>
@endsection
