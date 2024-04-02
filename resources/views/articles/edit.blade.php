@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="" method="post">
            @csrf
            <div class="mb-3">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" value="{{$article->title}}">
            </div>
            <div class="mb-3">
                <label for="">Body</label>
                <textarea name="body" id="" cols="" rows="" class="form-control">{{$article->body}}</textarea>
            </div>
            <div class="mb-3">
                <label for="">Category</label>
                <select name="category_id" id="" class="form-select">
                    @foreach ($categories as $category)
                        <option value="{{ $category['id']}}">
                            {{ $category['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="Update Article" class="btn btn-primary">
            <a class="btn btn-info" href="{{ url("/articles")}}"> &larr; Back</a>

        </form>
    </div>
@endsection
