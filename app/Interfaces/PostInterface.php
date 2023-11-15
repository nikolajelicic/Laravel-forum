<?php

namespace App\Interfaces;

use App\Http\Requests\CreateNewPostRequest;
use Illuminate\Http\Request;

interface PostInterface {
    
    public function createNewPost(CreateNewPostRequest $request);

    public function allMyPost();

    public function deletePost(Request $request, $id);

    public function buildTree($parentId);

    public function getPostBySlug(Request $request, $slug);

    public function editPost(Request $request, $id);

    public function getPostsByCategory(Request $request, $id);

    public function getPostsByText(Request $request);
}