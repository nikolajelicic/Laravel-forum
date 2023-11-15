<?php 

namespace App\Repositories;

use App\Interfaces\CommentInterface;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentRepositories implements CommentInterface {


    public function replyToComment(Request $request)
    {
        $user = Auth::user();

        $comment = new Comment([
            'post_id' => $request->input('postId'),
            'user_id' => $user->id,
            'parent_id' => $request->input('commentId'),
            'content' => $request->input('reply'),
            'created_at' => now()
        ]);

        $comment->save();
    }

    public function deleteComment(Request $request, $id)
    {
        $user = Auth::user();

        $comment = Comment::where('user_id',$user->id)->where('id',$id);
        $comment->delete();
    }
}