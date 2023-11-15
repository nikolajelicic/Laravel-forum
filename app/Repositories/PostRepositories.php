<?php 

namespace App\Repositories;

use App\Http\Requests\CreateNewPostRequest;
use App\Interfaces\PostInterface;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostRepositories implements PostInterface {


    public function createNewPost(CreateNewPostRequest $request)
    {
        $user = Auth::user();

        $title = $request->title;
        $content = $request->content;
        $category_id = $request->categories;
        $user_id =  $user->id;
        $slug = Str::slug($request->title, '-');
        $created_at = now();
        
        $post = new Post();

        $post->title = $title;
        $post->content = $content;
        $post->category_id = $category_id;
        $post->user_id = $user_id;
        $post->slug = $slug;
        $post->created_at = $created_at;

        $post->save();
    }

    public function allMyPost()
    {
        $user = Auth::user();

        $posts = Post::where('user_id', $user->id)->get();

        return $posts;
    }

    public function deletePost(Request $request, $id)
    {
        $postToDelete = Post::where('id',$id)->firstOrFail();
        if($postToDelete){
            $postToDelete->delete();
        }
    }

    public function buildTree($parentId)
    {
        $comments = Comment::where('parent_id', $parentId)->get();

        $tree = [];

        foreach ($comments as $comment) {
            $commentData = [
                'id' => $comment->id,
                'content' => $comment->content,
                'user_id' => $comment->user_id,
                'created_at' => $comment->created_at,
                //other data from comments
                'replies' => $this->buildTree($comment->id), // recursive calling for subcomments
            ];

            $tree[] = $commentData;
        }

        return $tree;
    }

    public function getPostBySlug(Request $request, $slug)
    {
        $post = Post::with('user','category')->where('slug',$slug)->firstOrFail();
        $comments = Comment::where('post_id', $post->id)
            ->where('parent_id', null) // main comment only (without parents)
            ->get();
    
        $commentTree = [];
        foreach ($comments as $comment) {
            $commentData = $comment->toArray();
            $commentData['replies'] = $this->buildTree($comment->id);
            $commentTree[] = $commentData;
        }

        return ['post' => $post, 'comments' => $commentTree];
    }

    public function editPost(Request $request, $id)
    {   
        $post = Post::with('user','category')->findOrFail($id);

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'category_id' => $request->input('categories'),
            'updated_at' => now()
        ]);
    }

    public function getPostsByCategory(Request $request, $id)
    {
        $posts = Post::where('category_id', $id)->paginate(10);
        $categories = Category::all();
        return ['posts' => $posts,'categories'=>$categories];

    }

    public function getPostsByText(Request $request)
    {
        $request->validate([
            'keyword' => 'required|min:5',
            'searchBy' => ['required', 'in:title,content']
        ]);

        $keyword = $request->input('keyword');
        $searchBy = $request->input('searchBy', 'title'); //default value
    
        $posts = Post::when($searchBy === 'content', function ($query) use ($keyword) {
                return $query->where('content', 'like', "%{$keyword}%");
            }, function ($query) use ($keyword) {
                return $query->where('title', 'like', "%{$keyword}%");
            })
            ->paginate(10);
        
        
        $categories = Category::all();
        return ['posts' => $posts,'categories'=>$categories];
    }
}
