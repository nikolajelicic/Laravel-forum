@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-6 mx-auto">
                <h1 class="h1">{{ $data['post']->title }}</h1>
                <p>{{ $data['post']->content }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 mx-auto bg-light mt-5">
                <div class="comments">
                    @foreach ($data['comments'] as $comment)
                        <div class="comment mb-3">
                            <p>{{ $comment['content'] }}</p>
                            @if (auth()->id() == $comment['user_id'])
                                <small>{{ \Carbon\Carbon::parse($comment['created_at'])->format('D M j H:i:s') }} | <button class="replayButton"><strong>Reply to a comment</strong></button> | | <a href="/user/delete-comment/{{ $comment['id'] }}">Delete comment</a></small>
                            @else
                                <small>{{ \Carbon\Carbon::parse($comment['created_at'])->format('D M j H:i:s') }}</small>
                            @endif
                            <form action="/user/commentReplay" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6 pr-0">
                                        <input type="text" class="form-control" placeholder="Unesite tekst" aria-label="Unesite tekst" name="reply">
                                        <input type="hidden" name="commentId" value="{{ $comment['id'] }}">
                                        <input type="hidden" name="postId" value="{{ $data['post']->id }}">
                                    </div>
                                    <div class="col-xl-1 pl-0">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-outline-secondary" type="button">Send</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @if (!empty($comment['replies']))
                                <div class="replies mt-2">
                                    @include('comments', ['comments' => $comment['replies']])
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

