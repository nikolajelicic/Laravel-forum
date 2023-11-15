<?php

namespace App\Services;

use App\Http\Requests\CreateNewPostRequest;
use App\Repositories\PostRepositories;
use Illuminate\Http\Request;

class PostService {
    private $postRepositories;

    public function __construct(PostRepositories $postRepositories)
    {
        return $this->postRepositories = $postRepositories;
    }

    public function createNewPost(CreateNewPostRequest $request)
    {
        return $this->postRepositories->createNewPost($request);
    }

    public function allMyPost()
    {
       return $this->postRepositories->allMyPost();
    }

    public function deletePost(Request $request,$id)
    {
        return $this->postRepositories->deletePost($request,$id);
    }

    public function getPostBySlug(Request $request,$slug)
    {
        return $this->postRepositories->getPostBySlug($request,$slug);
    }

    public function editPost(Request $request, $id)
    {
        $this->postRepositories->editPost($request,$id);
    }

    public function getPostsByCategory(Request $request, $id)
    {
        return $this->postRepositories->getPostsByCategory($request, $id);
    }

    public function getPostsByText(Request $request)
    {
        return $this->postRepositories->getPostsByText($request);
    }
}