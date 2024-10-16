@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-end mb-2">
                <a href="{{route('post.create')}}" class="btn btn-primary">Add new Post</a>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $post->title }}</td>
                                <td><button class="btn btn-warning">{{ $post->status }} </button></td>
                                <td>
                                    @if ($post->status == 'pending')
                                        <form action="{{ route('admin.approve', $post) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success">Approve</button>
                                        </form>
                                    @endif
                                    <a href="{{ route('post.edit', $post) }}" class="btn btn-secondary">Edit</a>
                                    <form action="{{ route('post.delete', $post) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @php
                                $no = $no+1;
                            @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
