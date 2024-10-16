@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Blog Posts</h1>

        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('post.show', $post) }}" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
