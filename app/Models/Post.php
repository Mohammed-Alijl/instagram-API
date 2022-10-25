<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $fillable = ['user_id', 'caption'];


    //////////////////////////////////////////////////////////////////
    // RELATIONSHIPS
    //////////////////////////////////////////////////////////////////

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->hasMany(PostMedia::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function userlikes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function userSave()
    {
        return $this->belongsToMany(User::class, 'post_saves');
    }
}
