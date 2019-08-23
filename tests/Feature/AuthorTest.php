<?php

namespace Tests\Feature;

use App\Author;
use App\Post;
use App\User;
use Tests\TestCase;

class AuthorTest extends TestCase
{

    public function test_an_author_can_have_posts()
    {
        $author = factory(Author::class)->create();

        $post = factory(Post::class)->create([

            'author_id' => $author->id,

        ]);

        $this->assertEquals($author->id, $post->author_id);
    }

    public function test_an_author_can_have_a_user()
    {
        $user = factory(User::class)->create();

        $author = factory(Author::class)->create([

            'user_id' => $user->id,

        ]);

        $this->assertEquals($author->user_id, $user->id);
    }

}
