<?php

namespace App\Http\Controllers;

use App\CategoryPosts;
use App\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(CategoryPosts $categoryPosts)
    {
        $post = Post::where('post_id',$categoryPosts->id)->paginate(3);

        return view('post.show',compact('post','categoryPost'));
    }
}
