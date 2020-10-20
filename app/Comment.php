<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Comment extends Model
{

    protected $fillable = ['user_id', 'post_id', 'parent_id', 'body'];

  public function Post()
  {
    //relationship, comment belongs to a post
    return $this->belongsTo(Post::class);
  }

  public function User()
  {
      //relationship, a comment belongs to a user
    return $this->belongsTo(User::class);
  }


}
