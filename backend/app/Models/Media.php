<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';
    protected $fillable = ['url', 'type'];

    public function mediable()
    {
        return $this->morphTo();
    }
}
