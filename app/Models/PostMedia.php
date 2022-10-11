<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMedia extends Model
{
    use HasFactory;
    protected $fillable = ['media','post_id'];

    //////////////////////////////////////////////////////////////////
    // RELATIONSHIPS
    //////////////////////////////////////////////////////////////////
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
