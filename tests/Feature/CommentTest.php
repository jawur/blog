<?php

namespace Tests\Feature;

use App\Comment;
use App\User;
use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_a_comment_can_have_post()
    {

        $comment = factory(Comment::class)->create();

        $post = Post::where('id', $comment->post_id)->first()->id;

        $this->assertTrue( $post ? true : false );

    }

    public function test_a_comment_can_have_a_user()
    {

        $comment = factory(Comment::class)->create();

        $user = User::where('id', $comment->user_id)->first()->id;

        $this->assertTrue( $user ? true : false );

    }
}
