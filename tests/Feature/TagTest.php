<?php

namespace Tests\Feature;

use App\Tag;
use App\Taggable;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tag_can_have_taggables()
    {

        $taggable = factory(Taggable::class)->create();

        $tag = Tag::where('id', $taggable->tag_id)->first()->id;

        $this->assertTrue( $tag ? true : false );

    }
}
