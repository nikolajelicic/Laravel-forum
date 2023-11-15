<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface CommentInterface {
    
    public function replyToComment(Request $request);

    public function deleteComment(Request $request, $id);
}