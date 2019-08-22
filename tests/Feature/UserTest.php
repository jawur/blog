<?php

namespace Tests\Feature;

use App\Author;
use App\Comment;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_have_comments()
    {

        $comment = factory(Comment::class)->create();

        $user = User::where('id', $comment->user_id)->first()->id;

        $this->assertTrue( $user ? true : false );

    }

    public function test_a_user_can_have_an_author()
    {
        $user = factory(User::class)->create();

        factory(Author::class)->create([
            'user_id' => $user->id,
        ]);

        $author = User::where('id', $user->id)->first()->author;

        $this->assertTrue( $author->count() ? true : false );

    }
}
