<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    protected $fillable = ['user_id', 'post_id', 'liked'];


    public static function boot()
    {
        parent::boot();
        static::creating(function ($like) {
            $like->user_id = auth('api')->user()->id;
        });
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
