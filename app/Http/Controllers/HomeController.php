<?php

namespace App\Http\Controllers;

use App\CategoryPosts;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $new = Post::latest()->get();
        $new2 = Post::latest()->get();

        $posts = Post::all();

        $posts2 = Post::all();

        $category = CategoryPosts::all();

        $users = User::latest()->get();

        $post= [];

        foreach($category as $category) {
            $post[ Str::slug( $category->name ) ][] = Post::where('post_id', $category->id )->take(3)->get();
        }

        return view('home', compact('new','new2' ,'post','users','posts','posts2'));
    }
}
