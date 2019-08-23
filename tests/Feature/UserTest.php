<?php

namespace Tests\Feature;

use App\Author;
use App\Comment;
use App\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_have_comments()
    {
        $user = factory(User::class)->create();

        $comment = factory(Comment::class)->create([

            'user_id' => $user->id,

        ]);

        $this->assertEquals($comment->user_id, $user->id);
    }

    public function test_a_user_can_have_an_author()
    {
        $user = factory(User::class)->create();

        $author = factory(Author::class)->create([

            'user_id' => $user->id,

        ]);

        $this->assertEquals($author->user_id, $user->id);
    }
}
