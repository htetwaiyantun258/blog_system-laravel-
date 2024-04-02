@extends('layouts.app')

@section('content')
    <div class="container">

        @if ($errors->any())
            @foreach ($errors->all() as $error)
              <div class="alert alert-danger">
                {{ $error }}
              </div>
            @endforeach
        @endif
        <form action="" method="post">
            @csrf
            <div class="mb-3">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Body</label>
                <textarea name="body" id="" cols="" rows="" class="form-control"></textarea>
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
            <input type="submit" value="Add Article" class="btn btn-primary">
        </form>
    </div>
@endsection
