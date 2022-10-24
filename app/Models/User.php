<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'nick_name',
        'date_of_birth',
        'phone',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //////////////////////////////////////////////////////////////////
    // RELATIONSHIPS
    //////////////////////////////////////////////////////////////////

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function postlikes()
    {
        return $this->belongsToMany(Post::class, 'likes');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_followers', 'user_id', 'follower_id', 'id', 'id');
    }

    public function follow()
    {
        return $this->belongsToMany(User::class, 'user_followers', 'follower_id', 'user_id', 'id', 'id');
    }

    public function stories()
    {
        return $this->hasMany(Story::class);
    }

    public function reels()
    {
        return $this->hasMany(Reels::class);
    }

    public function storyView()
    {
        return $this->belongsToMany(Story::class, 'views');
    }
}
