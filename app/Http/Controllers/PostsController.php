<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNewPostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Services\PostService;


class PostsController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function createNewPost(CreateNewPostRequest $request)
    {
       $this->postService->createNewPost($request);
        return redirect('/');
    }

    public function allMyPost()
    { 
        $posts = $this->postService->allMyPost();

        return view('allPosts',['posts' => $posts]);
    }

    public function deletePost(Request $request, $id)
    { 
        $postToDelete = $this->postService->deletePost($request, $id);
        
        if ($postToDelete) {
            return Redirect::back()->with('message', 'Post successfully deleted');
        } else {
            abort(404);
        }
    }

    public function getPostBySlug(Request $request, $slug) 
    {
        $data = $this->postService->getPostBySlug($request,$slug);
        return view('singlePost', ['data' => $data]);
    }

    public function editPost(Request $request, $id) 
    {   
        $this->postService->editPost($request,$id);
    
        return redirect()->back();
    }

    public function getPostsByCategory(Request $request, $id) 
    {
        $data = $this->postService->getPostsByCategory($request,$id);

        return view('home',['data' => $data]);
    }

    public function getPostsByText(Request $request) 
    {
        $data = $this->postService->getPostsByText($request);

        return view('home',['data' => $data]);
    }
}
