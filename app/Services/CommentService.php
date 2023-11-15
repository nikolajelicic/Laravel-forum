<?php

namespace App\Services;

use App\Repositories\CommentRepositories;
use Illuminate\Http\Request;

class CommentService {
    private $commentRepositories;

    public function __construct(CommentRepositories $commentRepositories)
    {
        $this->commentRepositories = $commentRepositories;
    }

    public function replyToComment(Request $request)
    {
        $comments = $this->commentRepositories->replyToComment($request);
        return $comments;
    }

    public function deleteComment(Request $request,$id)
    {
        $this->commentRepositories->deleteComment($request,$id);
    }
}