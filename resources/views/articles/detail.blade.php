@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                    {{ $article->created_at->diffForHumans() }},
                    Category: <b>{{ $article->category->name }}</b>
                </div>
                <p class="card-text">{{ $article->body }}</p>
                @auth
                    <a href="{{ url("/articles/$article->id/edit") }}" class="btn btn-primary">Edit</a>
                    <form action="/articles/{{ $article->id }}" method="POST" class="float-right">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input type="submit" value="Delete" class="btn btn-warning">
                    </form>
                @endauth
            </div>
        </div>

        @if(session('delete'))
            <div class="alert alert-info">
                {{ session('delete') }}
            </div>
        @endif

        <div class="row mb-1">
            @foreach($article->galleries as $gallery)
                <div class="col-md-4 p-0">
                    <div class="card">
                        <div class="card-body p-0">
                            <img src="{{ asset('photo/'.$gallery->name) }}" class="img-fluid">
                            @auth
                                <a href="{{ url("/galleries/delete/$gallery->id") }}" class="close">&times;</a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($errors->any())
            <div class="alert alert-warning">
                <ol>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>  
                    @endforeach
                </ol>
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        @auth
            <form action="{{ url('/galleries/add') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <div class="form-group">
                    <label id="upload">Upload Photo</label>
                    <div class="custom-file">
                        <input type="file" name="name[]" multiple class="custom-file-input" for="upload">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
                <input type="submit" value="Upload" class="btn btn-primary">
            </form>
        @endauth

    </div>

@endsection
