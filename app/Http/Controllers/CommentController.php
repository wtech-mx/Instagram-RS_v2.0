<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        //request for comment validation
    	$request->validate([
            'body'=>'required',
        ]);
        $input = $request->all();

        //validation if the authenticated user is the same as that of the riches
        $input['user_id'] = auth()->user()->id;

        //save data to db
        Comment::create($input);

        //redirect to route indicates
        return redirect()->route('inicio.index');
    }
}
