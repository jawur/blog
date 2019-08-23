<?php

namespace Tests\Feature;

use App\Comment;
use App\User;
use App\Post;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_a_comment_can_have_post()
    {
        $post = factory(Post::class)->create();

        $comment = factory(Comment::class)->create([

            'post_id' => $post->id,

        ]);

        $this->assertEquals($comment->post_id, $post->id);
    }

    public function test_a_comment_can_have_a_user()
    {
        $user = factory(User::class)->create();

        $comment = factory(Comment::class)->create([

            'user_id' => $user->id,

        ]);

        $this->assertEquals($comment->user_id, $user->id);
    }
}
