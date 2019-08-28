<?php

namespace Tests\Unit;

use App\Tag;
use App\Taggable;
use Tests\TestCase;

class TagTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tag_can_have_taggables()
    {
        $tag = factory(Tag::class)->create();

        $taggable = factory(Taggable::class)->create([

            'tag_id' => $tag->id,

        ]);

        $this->assertEquals($tag->id, $taggable->tag_id);
    }
}
