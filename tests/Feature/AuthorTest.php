<?php

namespace Tests\Feature;

use App\Author;
use App\Post;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Database\Eloquent\SoftDeletes;
//use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthorTest extends TestCase
{

    public function test_an_author_can_have_posts()
    {

        $post = factory(Post::class)->create();

        $author = Author::where('id', $post->author_id)->first()->id;

        $this->assertTrue( $author ? true : false );

    }

    public function test_an_author_can_have_a_user()
    {

        $author = factory(Author::class)->create();

        $user = User::where('id', $author->user_id)->first()->id;

        $this->assertTrue( $user ? true : false );

    }

}
