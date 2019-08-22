<?php

namespace Tests\Feature;

use App\Comment;
use App\Post;
use App\Author;
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

        $comments = Post::where('id',$post->id)->first()->comments;

        $this->assertTrue( $comments->count() ? true : false );
        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'content' => $comment->content,
        ]);

    }

    public function test_post_can_have_an_author()
    {

        $post = factory(Post::class)->create();

        $author = Author::where('id' , $post->id)->first()->id;

        $this->assertTrue( $author ? true : false );

    }
}
