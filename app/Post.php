<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function author()
    {
        return $this->hasOne(Author::class);
    }
}
