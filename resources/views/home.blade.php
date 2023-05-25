@extends('layouts.main')

@section('body_header')
    @include('partials.navbar')
@endsection

@section('container')
    <main class="col-lg-5 col-md-8 m-auto">
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
                    <p class="card-text">{{ $post->post }}</p>
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
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </main>
@endsection

@section('body_footer')
    <script src="js/home.js"></script>
@endsection
