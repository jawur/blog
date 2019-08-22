<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taggable extends Model
{
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
