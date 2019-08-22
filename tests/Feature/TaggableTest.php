<?php

namespace Tests\Feature;

use App\Taggable;
use App\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaggableTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_taggable_can_have_tags()
    {

        $taggable = factory(Taggable::class)->create();

        $tag = Tag::where('id', $taggable->tag_id)->first()->id;

        $this->assertTrue( $tag ? true : false );

    }
}
