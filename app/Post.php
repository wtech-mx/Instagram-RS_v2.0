<?php

namespace App;

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
}
