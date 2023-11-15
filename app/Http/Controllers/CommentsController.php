<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewPostRequest;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    private $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

   public function replyToComment(Request $request)
   { 
        $this->commentService->replyToComment($request);
        return redirect()->back()->with('message', 'Success!');
    }

    public function deleteComment(Request $request, $id)
    { 
        $this->commentService->deleteComment($request, $id);
        return redirect()->back();
    }
}
