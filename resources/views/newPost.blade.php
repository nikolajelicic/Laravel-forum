
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-6 mx-auto">
                <form method="POST" action="/user/save-post">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Post title</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Post content</label>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here"  id="content" name="content" style="height: 100px"></textarea>
                        </div>
                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <div class="form-floating">
                            <select class="form-select" id="categories" name="categories" aria-label="Floating label select example">
                                <option selected>Select one of this</option>
                                @foreach ($data['categories'] as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelect">Select category</label>
                            @error('categories')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>                          
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </div>
@endsection