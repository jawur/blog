<?php

namespace Tests\Unit;

use App\Comment;
use App\User;
use App\Post;
use Tests\TestCase;

class CommentTest extends TestCase
{
    public function test_a_comment_can_have_post()
    {
        $post = factory(Post::class)->create();

        $comment = factory(Comment::class)->create([
            'post_id' => $post->id,
        ]);

        $comment = Post::find($post->id)->comments->find($comment->id)->get();

        $this->assertEquals($comment->first()->post_id, $post->id);
    }

    public function test_a_comment_can_have_a_user()
    {
        $user = factory(User::class)->create();

        $comment = factory(Comment::class)->create([
            'user_id' => $user->id,
        ]);

        $comment = User::find($user->id)->comments->find($comment->id)->get();

        $this->assertEquals($comment->first()->user_id, $user->id);
    }
}
