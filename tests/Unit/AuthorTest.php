<?php

namespace Tests\Unit;

use App\Author;
use App\Post;
use App\User;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    public function test_an_author_can_have_posts()
    {
        $numberOfPosts = 5;

        $author = factory(Author::class)->create();

        factory(Post::class, $numberOfPosts)->create([
            'author_id' => $author->id,
        ]);

        $posts = Post::where('author_id', $author->id)->get();

        $this->assertEquals($numberOfPosts, $posts->count());
    }

    public function test_an_author_can_have_a_user()
    {
        $user = factory(User::class)->create();

        factory(Author::class)->create([
            'user_id' => $user->id,
        ]);

        $author = Author::where('user_id', $user->id)->get();

        $this->assertEquals($author->first()->user_id, $user->id);
    }
}
