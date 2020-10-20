<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\CategoryPosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{

    public function __construct()
    {
        //Authentication is required to enter the methods
        $this->middleware('auth');
    }

    public function index()
    {
        //get all post logs
        $posts = Post::all();

        //authenticated user data
        $user = auth()->user();

        return view('posts.index', compact('posts','user'));
    }

    public function create()
    {

        $post = CategoryPosts::all(['id','name']);
        return view('posts.create',compact('post'));
    }

     public function store(Request $request)
    {
        //data validation for the post
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'img' => 'required|image',
            'post_id' => 'required',
        ]);

    	if ($data['img']) {

    	    //image validation and map folder
    		$file=$request->file('img');
    		$location = $file->move(public_path().'/upload-img',time().".".$file->getClientOriginalExtension());
    		$imgname =  $data['img']=time().".".$file->getClientOriginalExtension();
    	}

    	//create post with the validation data according to logged user data
        auth()->user()->Post()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'img' => $imgname,
            'post_id' => $data['post_id'],
        ]);

        return redirect()->action('HomeController@index');

    }

    public function show($id)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        //Users logged in and their id corresponds
        $this->authorize('view',$post);

        //calling a category record
        $category = CategoryPosts::all(['id','name']);

        //returning records to view
        return view('posts.edit',compact('category','post'));
    }

    public function update(Request $request, Post $post)
    {
        //data validation
        $data = $request->validate([
            'title' => 'required|min:6',
            'description' => 'required',
            'post_id' => 'required',
        ]);

         //image validation and map folder
        if (request('img')){
    		$file=$request->file('img');
    		$location = $file->move(public_path().'/upload-img',time().".".$file->getClientOriginalExtension());
    		$imgname =  $data['img']=time().".".$file->getClientOriginalExtension();
    		$post->img = $imgname;
    	}
        //updating data
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->post_id = $data['post_id'];
        $post->save();

         return redirect()->action('HomeController@index');
    }

    public function destroy(Post $post)
    {
        //run el policy
        $this->authorize('delete',$post);

        //removing all the records from the post
        $post->delete();

        return Redirect::back();
    }

    public function search(Request $request)
    {
        //request is compared to logs from db
        $search = $request->get('search');
        $posts = Post::where('title','like','%'. $search. '%')->paginate(1);
        $posts->appends(['search' => $search]);
        $posts2 = Post::where('title','like','%'. $search. '%')->paginate(1);
        $posts2->appends(['search' => $search]);

        return view('search.show',compact('posts','posts2','search'));

    }

    //dependency methods for working likes
    public function like(Post $post)
    {
        $post->likeBy();
        return back();
    }

    public function unlike(Post $post)
    {
        $post->unlikeBy();
        return back();
    }

}
