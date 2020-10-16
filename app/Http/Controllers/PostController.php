<?php

namespace App\Http\Controllers;

use App\Post;
use App\CategoryPosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
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
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'img' => 'required|image',
            'post_id' => 'required',
        ]);

    	if ($data['img']) {
    		$file=$request->file('img');
    		$location = $file->move(public_path().'/upload-img',time().".".$file->getClientOriginalExtension());
    		$imgname =  $data['img']=time().".".$file->getClientOriginalExtension();
    	}

        auth()->user()->Post()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'img' => $imgname,
            'post_id' => $data['post_id'],
        ]);

        return redirect()->action('HomeController@index');

    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

       public function edit(Post $post)
    {
        $this->authorize('view',$post);
        $category = CategoryPosts::all(['id','name']);

        return view('post.edit',compact('category','post'));
    }

    public function update(Request $request, Post $post)
    {

        $data = $request->validate([
            'title' => 'required|min:6',
            'description' => 'required',
            'post_id' => 'required',
        ]);


        if (request('img')){
    		$file=$request->file('img');

    		$location = $file->move(public_path().'/upload-img',time().".".$file->getClientOriginalExtension());
    		$imgname =  $data['img']=time().".".$file->getClientOriginalExtension();
    		$post->img = $imgname;
    	}

        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->post_id = $data['post_id'];
        $post->save();

         return redirect()->action('HomeController@index');
    }

    public function destroy(Post $post)
    {
        //ejecutar el policy
        $this->authorize('delete',$post);

        $post->delete();

        return Redirect::back();
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $posts = Post::where('title','like','%'. $search. '%')->paginate(1);
        $posts->appends(['search' => $search]);
        $posts2 = Post::where('title','like','%'. $search. '%')->paginate(1);
        $posts2->appends(['search' => $search]);

        return view('search.show',compact('posts','posts2','search'));

    }

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

    public function dislike(Post $post)
    {
        $post->dislikeBy();
        return back();
    }

    public function undislike(Post $post)
    {
        $post->undislikeBy();
        return back();
    }
}
