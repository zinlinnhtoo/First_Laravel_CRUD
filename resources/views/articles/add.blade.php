@extends('layouts.app')

@section('content')

<div class="container">
    @if($errors->any())
        <div class="alert alert-warning">
            <ol>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>  
                @endforeach
            </ol>
        </div>
    @endif
    <form method="POST" action="/articles" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label>Body</label>
            <textarea name="body" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Category</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category['id'] }}">
                        {{ $category['name'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Cover Image</label>
            <div class="custom-file">
                <input type="file" name="cover_image" class="custom-file-input">
                <label class="custom-file-label">Choose file</label>
            </div>
        </div>
        <input type="submit" value="Add Article" class="btn btn-primary">
    </form>
</div>


@endsection    
