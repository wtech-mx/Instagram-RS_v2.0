<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Profile;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{

    public function __construct()
    {
        //Authentication is required to enter the methods
        $this->middleware('auth',['except' => 'show']);
    }

    public function show(Profile $profile)
    {
        //get the user's profile posts
        $posts = Post::where('user_id', $profile->user_id)->get();
        $posts2 = Post::where('user_id', $profile->user_id)->get();

        //condition if the user is logged in
        if (Auth::check() == true){
            //access the profile view
            return view('profile.show',compact('profile','posts','posts2'));
        } else{
            //redirect to login
            return redirect('/login');
        }

    }

    public function edit(Profile $profile)
    {
        //run el policy
        $this->authorize('update',$profile);

        return view('profile.edit',compact('profile'));
    }

    public function update(Request $request ,Profile $profile)
    {
        //run el policy
        $this->authorize('update',$profile);

        //profile data validation
        $data = $request->validate([
            'name' => 'required',
            'biography' => 'required',
        ]);

        //check if an image was uploaded and save it in folder and path in db
        if (request('img')){
    		$file=$request->file('img');
    		$location = $file->move(public_path().'/upload-img',time().".".$file->getClientOriginalExtension());
    		$imgname =  $data['img']=time().".".$file->getClientOriginalExtension();

    		$img = ['img' => $imgname];
    	}

         //current name of the user by the request
         auth()->user()->name =  $data['name'];
        //save db
         auth()->user()->save();

         //clean data name
        unset($data['name']);

        //update the information brought from the data
        auth()->user()->Profile()->update( array_merge(
            $data ,
            $img ?? []
        ));

       return redirect()->action('HomeController@index');
    }
}
