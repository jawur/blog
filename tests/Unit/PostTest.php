<?php

namespace Tests\Unit;

use App\Comment;
use App\Post;
use App\Author;
use Tests\TestCase;

class PostTest extends TestCase
{
    public function test_post_can_have_comments()
    {
        $numberOfComments = 5;

        $post = factory(Post::class)->create();

        factory(Comment::class, $numberOfComments)->create([
            'post_id' => $post->id,
        ]);

        $comments = Comment::where('post_id', $post->id)->get();

        $this->assertEquals($numberOfComments, $comments->count());
    }

    public function test_post_can_have_an_author()
    {
        $author = factory(Author::class)->create();

        factory(Post::class)->create([
            'author_id' => $author->id,
        ]);

        $post = Post::where('author_id', $author->id)->get();

        $this->assertEquals($post->first()->author_id, $author->id);
    }
}
