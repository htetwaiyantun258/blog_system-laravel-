@extends('layouts.app')

@section("content")
    <div class="container">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
              <div class="alert alert-danger">
                {{$error}}
              </div>
            @endforeach
        @endif

        @if (session('error_comment'))
        <div class="alert alert-warning">
            {{ session('error_comment') }}
        </div>
        @endif

        @if (session('unauthorize_delete_article'))
        <div class="alert alert-warning">
            {{ session('unauthorize_delete_article') }}
        </div>
        @endif

        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">
                    {{ $article->title }}
                </h5>
                <div class="card-subtitle mb-2 text-muted small">
                    {{ $article->created_at->diffForHumans() }},
                                <b>{{$article->User->name}}</b>,
                    Category : <b>{{$article->Category->name}}</b>

                </div>
                <p class="card-text">{{ $article->body }}</p>
                @auth
                @can("delete-article",$article)
                <a class="btn btn-danger text-decoration-none" href="{{ url("/articles/delete/$article->id") }}">
                   Delete
                </a>
                <a class="btn btn-primary" href="{{ url("/articles/edit/{$article->id}")}}"> Edit</a>
                @endcan
                @endauth
                <a class="btn btn-info" href="{{ url("/articles")}}"> &larr; Back</a>
            </div>
        </div>

      
        <ul class="list-group">
            <li class="list-group-item active mb-2">
                <b>Comments {{count($article->comments)}} </b>
            </li>
            @auth
            @foreach($article->comments as $comment)
            <li class="list-group-item mb-2">
                @auth
                    @can("delete-comment",$comment)
                        <a href="{{url("/comments/delete/$comment->id")}}" class="btn btn-close float-end"></a>
                    @endcan
                @endauth
                <small>
                    <p style="color: green;">({{$comment->user->name}}) {{$article->created_at->diffForHumans()}} </p>
                </small>
                {{$comment->content}}
            </li>
            @endforeach
            @endauth
        </ul>
        @auth
        <form action="{{url("/comments/add")}}" method="post">
            @csrf
            <input type="hidden" name="article_id" value="{{$article->id}}">
            <input type="hidden" name="article_id" value="{{$article->user_id}}">
            <textarea name="content" id="" cols="" rows="" placeholder="New Comment" class="form-control mb-2"></textarea>
            <input type="submit" value="Add Comment" class="btn btn-secondary">
        </form>
        @endauth
    </div>
@endsection