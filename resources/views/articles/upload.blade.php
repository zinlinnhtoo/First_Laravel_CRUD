@extends('layouts.app')

@section('content')
    
    <div class="container">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="image" class="custom-file-input">
                <label class="custom-file-label">Choose file</label>
              </div>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Upload</button>
              </div>
            </div>
        </form>

        <div class="row">
            @foreach($galleries as $gallery)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <img class="img-fluid" src="{{ asset('upload/'. $gallery->name) }}">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
