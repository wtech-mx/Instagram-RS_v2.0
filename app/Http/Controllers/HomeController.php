<?php

namespace App\Http\Controllers;

use App\CategoryPosts;
use App\Comment;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //access without authentication to the index
        $this->middleware('auth',['except' => 'index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //calling all records post
        $posts = Post::get();
        $posts2 = Post::get();

        //calling all records CategoryPosts
        $category = CategoryPosts::get();

        //calling all records CategoryPosts
        $users = User::get();

        //calling all records Comment
        $comments = Comment::get();


        $post= [];

        foreach($category as $category) {
            $post[ Str::slug( $category->name ) ][] = Post::where('post_id', $category->id )->take(3)->get();
        }

        //return db record to view
        return view('home', compact('post','users','posts','posts2','comments'));
    }
}
