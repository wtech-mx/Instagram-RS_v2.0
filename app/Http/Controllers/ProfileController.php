<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except' => 'show']);
    }

    public function show(Profile $profile)
    {

        $post = Post::where('user_id', $profile->user_id)->paginate(3);


        $post2 = Post::where('user_id', $profile->user_id)->paginate(3);

        return view('profile.show',compact('profile','post','post2'));
    }

    public function edit(Profile $profile)
    {
        $this->authorize('update',$profile);

        return view('profile.edit',compact('profile'));
    }

    public function update(Request $request ,Profile $profile)
    {
        $this->authorize('update',$profile);

        $data = $request->validate([
            'name' => 'required',
            'biography' => 'required',
        ]);

        if (request('img')){
    		$file=$request->file('img');

    		$location = $file->move(public_path().'/upload-img',time().".".$file->getClientOriginalExtension());
    		$imgname =  $data['img']=time().".".$file->getClientOriginalExtension();

    		$img = ['img' => $imgname];
    	}

         auth()->user()->name =  $data['name'];
         auth()->user()->save();

        unset($data['name']);

        auth()->user()->Profile()->update( array_merge(
            $data ,
            $img ?? []
        ));


       return redirect()->action('HomeController@index');
    }
}
