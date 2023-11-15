
<div class="comments">
    @foreach ($comments as $comment)
        <div class="comment mb-3 ml-3">
            <p>{{ $comment['content'] }}</p>
            @if (auth()->id() == $comment['user_id'])
                <small>{{ \Carbon\Carbon::parse($comment['created_at'])->format('D M j H:i:s') }} | <a class="link-danger" href="/user/delete-comment/{{ $comment['id'] }}"><strong>Delete comment</strong></a></small>
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
                <div class="replies ml-3">
                    @include('comments', ['comments' => $comment['replies']])
                </div>
            @endif
        </div>
    @endforeach
</div>