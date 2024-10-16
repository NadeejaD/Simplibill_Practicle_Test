@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ isset($post) ? 'Edit' : 'Create' }} Post</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($post)? route('post.update',$post->id):route('post.store') }}" method="POST">
            @csrf
            @if (isset($post))
                @method('PATCH')
            @endif            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{isset($post) ? $post['title']:old('title')}}">
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control" rows="5">
                    {{isset($post) ? $post['content']:old('content')}}
                </textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Submit Post</button>
        </form>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#content').summernote();
        });
        //CKEDITOR.replace( 'description' );
    </script>
@endsection
