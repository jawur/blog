<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Author extends Model
{

    protected $fillable = ['user_id'];

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
