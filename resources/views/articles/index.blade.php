@extends('layouts.app')
@section('content')
    <div class="container" style="max-width: 800px">
        {{ $articles->links() }}


        {{-- post success flash message --}}
        @if (session('create_post'))
            <div class="alert alert-success">
                {{ session('create_post') }}
            </div>
        @endif

        {{-- delete flash message --}}
        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        {{-- update flash message --}}
        @if (session('update_post'))
            <div class="alert alert-success">
                {{ session('update_post') }}
            </div>
        @endif

        @foreach ($articles as $article)
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">

                        {{ $article->title }}
                    </h5>
                    <div class="card-subtitle mb-2 text-muted small">
                        <b>{{$article->user->name}}</b>,
                        <small>
                            Category: <b>{{ optional($article->category)->name }}</b>,
                            {{ $article->created_at->diffForHumans() }}, 
                            Comments ({{ count($article->comments) }}),
                        </small>
                    </div>
                    <p class="card-text">{{ $article->body }}</p>
                    <a class="card-link text-decoration-none" href="{{ url("/articles/detail/$article->id") }}">
                        View Detail &raquo;
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
