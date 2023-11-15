<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Services\PageService;

class PagesController extends Controller
{
    private $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function showHomePage()
    {
        $data = $this->pageService->showHomePage();
        return view('home',['data'=>$data]);
    }

    public function showNewPostPage()
    {
        $data = $this->pageService->showNewPostPage();
        return view('newPost',['data'=>$data]);
    }

    public function showEditPostPage(Request $request,  $id)
    {
        $data = $this->pageService->showEditPostPage($request, $id);
        return view('editPost',['data'=>$data]);
    }
}
