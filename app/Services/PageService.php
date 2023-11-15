<?php

namespace App\Services;

use App\Repositories\PageRepositories;
use Illuminate\Http\Request;

class PageService {
    private $pageRepositories;

    public function __construct(PageRepositories $pageRepositories)
    {
        return $this->pageRepositories = $pageRepositories;
    }

    public function showHomePage()
    {
        return $this->pageRepositories->showHomePage();
    }

    public function showNewPostPage()
    {
        return $this->pageRepositories->showNewPostPage();
    }

    public function showEditPostPage(Request $request,  $id)
    {
        return $this->pageRepositories->showEditPostPage($request,$id);
    }
}