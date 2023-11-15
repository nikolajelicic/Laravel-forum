
@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-xl-6 mb-5 mx-auto">
                <h1 class="h1">All posts</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 mx-auto">
                @forelse($data['posts'] as $post)
                <div class="row mt-4">
                    <div class="col-xl-8">
                        <a class="link-primary" href="/view-post/{{ $post->slug }}">{{ $post->title }}</a>
                    </div>
                    <div class="col-xl-4">
                        <button class="btn btn-primary">
                            <a href="/view-post/{{ $post->slug }}">View post</a>
                        </button>
                    </div>
                </div>
                @empty
                    <div class="alert alert-danger">No posts found</div>
                @endforelse
            </div>
            <div class="col-xl-4">
                <h2 class="h2"> Search by category </h2>
                <ul>
                    @foreach ($data['categories'] as $category)
                        <li><a class="link-primary" href="/category/{{ $category->id }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
                <form class="mt-5 text-center" action="/searchBy" method="POST">
                    @csrf
                    <h2 class="h2">Search by keyword</h2>
                    <input type="text" class="form-control mb-2" name="keyword" id="keyword">
                    @error('keyword')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <select class="form-control" name="searchBy">
                        <option value="title" selected>Title</option>
                        <option value="content">Content</option>
                    </select>
                    @error('searchBy')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-success mt-3">Search</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 fixed-bottom mb-5">
                {{ $data['posts']->links() }}
            </div>
        </div>
    </div>
@endsection