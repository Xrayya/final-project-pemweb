@extends('layouts.main')

@section('body_header')
    @include('partials.navbar')
@endsection

@section('container')
    <main class="col-lg-5 col-md-8 m-auto">
        <form action="/logout" method="post">
            @csrf
            <button type="submit">Logout</button>
        </form>
        @foreach ($posts as $post)
            <div class="card text-start">
                <div class="card-header">
                    {{ $post->user->display_name }} - {{ $post->user->username }} - {{ $post->created_at->diffForHumans() }}
                </div>
                <div class="card-body">
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    //buat like, comment, subrek
                </div>
            </div>
        @endforeach
    </main>
@endsection
