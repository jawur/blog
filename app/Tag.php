<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'posts');
    }

    public function authors()
    {
        return $this->morphedByMany(Author::class, 'authors');
    }

    public function taggable()
    {
        return $this->hasOne(Taggable::class);
    }
}
