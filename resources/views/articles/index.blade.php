@extends('layouts.app')

@section('content')
    
    <div class="container">
        @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
        @if(session('add'))
            <div class="alert alert-info">
                {{ session('add') }}
            </div>
        @endif
        @if(session('update'))
            <div class="alert alert-info">
                {{ session('update') }}
            </div>
        @endif
        <div class="row">
                @foreach($articles as $article)
                    <div class="card col-md-4 p-0">
                        <img class="card-img-top" src="{{ asset('upload/'. $article->cover_image) }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <a class="card-link" href="{{ url("/articles/$article->id") }}">View Detail &raquo;</a>
                        </div>
                        <div class="card-footer">
                            <div class="card-subtitle mb-2 text-muted small">
                                {{ $article->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>

@endsection
