<?php

namespace Tests\Unit;

use App\Tag;
use App\Taggable;
use Tests\TestCase;

class TagTest extends TestCase
{
    public function test_tag_can_have_taggables()
    {
        $numberOfTaggables = 5;

        $tag = factory(Tag::class)->create();

        factory(Taggable::class, $numberOfTaggables)->create([
            'tag_id' => $tag->id,
        ]);

        $taggables = Taggable::where('tag_id', $tag->id)->get();

        $this->assertEquals($numberOfTaggables, $taggables->count());
    }
}
