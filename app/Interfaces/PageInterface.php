<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface PageInterface {
    
    public function showHomePage();

    public function showNewPostPage();

    public function showEditPostPage(Request $request,  $id);
}