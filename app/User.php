<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Cog\Laravel\Love\Liker\Models\Traits\Liker;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cog\Contracts\Love\Liker\Models\Liker as LikerContrat;

class User extends Authenticatable implements LikerContrat
{
    use Notifiable, Liker;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
        protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->Profile()->create();
        });
    }

    public function Post()
    {
        return $this->hasMany(Post::class);
    }
    public function Profile()
    {
        return $this->hasOne(Profile::class);
    }

}
