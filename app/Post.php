<?php

namespace App;

use Egulias\EmailValidator\Warning\Comment;
use Illuminate\Database\Eloquent\Model;
use Cog\Laravel\Love\Likeable\Models\Traits\Likeable;
use Cog\Contracts\Love\Likeable\Models\Likeable as LikeableContract;

class Post extends Model implements LikeableContract
{
    protected $fillable = [
        'title', 'description','img','post_id',
    ];

    use Likeable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Post()
    {
        return $this->belongsTo(CategoryPosts::class);
    }

    public function Comments()
    {
        return $this->hasMany(Comment::class,'post_id');
    }
}
