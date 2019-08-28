<?php

namespace Tests\Unit;

use App\Comment;
use App\Post;
use App\Author;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_can_have_comments()
    {
        $post = factory(Post::class)->create();

        $comment = factory(Comment::class)->create([

            'post_id' => $post->id,

        ]);

        $this->assertEquals($comment->post_id, $post->id);
    }

    public function test_post_can_have_an_author()
    {
        $author = factory(Author::class)->create();

        $post = factory(Post::class)->create([

            'author_id' => $author->id,

        ]);

        $this->assertEquals($author->id, $post->author_id);
    }
}
