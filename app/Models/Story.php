<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'media'];

    //////////////////////////////////////////////////////////////////
    // RELATIONSHIPS
    //////////////////////////////////////////////////////////////////
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userView()
    {
        return $this->belongsToMany(User::class, 'views');
    }
}
