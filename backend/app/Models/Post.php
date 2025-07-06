<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['caption', 'user_id'];
    protected $with = ['user', 'media', 'likes', 'comments'];


    public static function booted()
    {
        static::creating(function ($post) {
            $post->user_id = auth('api')->user()->id;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function media()
    {
        return $this->morphMany(Media::class, 'mediaable');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
