<?php

namespace Tests\Unit;

use App\Author;
use App\Comment;
use App\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_user_can_have_comments()
    {
        $numberOfComments = 5;

        $user = factory(User::class)->create();

        factory(Comment::class, 5)->create([
            'user_id' => $user->id,
        ]);

        $comments = Comment::where('user_id', $user->id)->get();

        $this->assertEquals($comments->count(), $numberOfComments);
    }

    public function test_a_user_can_have_an_author()
    {
        $user = factory(User::class)->create();

        factory(Author::class)->create([
            'user_id' => $user->id,
        ]);

        $author = Author::where('user_id', $user->id)->get();

        $this->assertEquals($author->first()->user_id, $user->id);
    }
}
