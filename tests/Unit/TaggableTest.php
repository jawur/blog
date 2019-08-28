<?php

namespace Tests\Unit;

use App\Taggable;
use App\Tag;
use Tests\TestCase;

class TaggableTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_taggable_can_have_tags()
    {
        $tag = factory(Tag::class)->create();

        $taggable = factory(Taggable::class)->create([

            'tag_id' => $tag->id,

        ]);

        $this->assertEquals($tag->id, $taggable->tag_id);
    }
}
