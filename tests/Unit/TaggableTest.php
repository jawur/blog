<?php

namespace Tests\Unit;

use App\Taggable;
use App\Tag;
use Tests\TestCase;

class TaggableTest extends TestCase
{
    public function test_taggable_can_have_tags()
    {
        $tag = factory(Tag::class)->create();

        factory(Taggable::class)->create([
            'tag_id' => $tag->id,
        ]);

        $taggable = Taggable::where('tag_id', $tag->id)->get();

        $this->assertEquals($taggable->first()->tag_id, $tag->id);
    }
}
