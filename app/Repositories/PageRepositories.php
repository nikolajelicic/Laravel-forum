<?php 

namespace App\Repositories;

use App\Interfaces\PageInterface;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PageRepositories implements PageInterface {


    public function showHomePage(){
        $posts = Post::with('user','category')->paginate(10);
        $categories = Category::all();
        return ['posts' => $posts,'categories' => $categories];
    }

    public function showNewPostPage(){
        $categories = Category::all();

        return ['categories' => $categories];
    }

    public function showEditPostPage(Request $request,  $id){
        $post = Post::with('user','category')->where('id',$id)->firstOrFail();

        $categories = Category::all();

        return ['post' => $post , 'categories' => $categories];
    }
}
