@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-start mb-2">
            <a href="{{url('/')}}" class="btn btn-primary">All Posts</a>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <h1 class="card-title">{{ $post->title }}</h1>
                <p class="card-text">
                    {!! $post->content !!}
                </p>
            </div>

        </div>
    </div>
@endsection
