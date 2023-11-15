@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-xl-8 offset-xl-2">
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                   {{ session('message') }}
                </div>
            @endif
            <ul class="list-group">
                @foreach ($posts as $post)
                    <li class="list-group-item">
                        {{ $post->title }}
                        <div class="float-end">
                            <button class="btn btn-primary"><a href="/user/view-post/{{ $post->slug }}">View post</a></button>
                            <button class="btn btn-secondary"><a href="/user/edit/{{ $post->id }}">Edit</a></button>
                            <button class="btn btn-danger"><a href="/user/delete/{{ $post->id }}">Delete</a></button>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection