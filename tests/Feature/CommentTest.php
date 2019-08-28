<?php

namespace Tests\Feature;

use App\Author;
use App\Comment;
use App\Post;
use App\User;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use WithFaker;

    public function test_can_list_comments()
    {
        factory(Comment::class, 2)->create();

        $this->get(route('comments.index'))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'data' => ['id', 'title', 'content', 'user_id', 'post_id'],
                        'meta',
                    ]
                ],
            ]);
    }

    public function test_can_create_comment()
    {
        $user = factory(User::class)->create();

        $author = factory(Author::class)->create([
            'user_id' => $user->id,
        ]);

        $post = factory(Post::class)->create([
            'author_id' => $author->id,
        ]);

        $user = Passport::actingAs($user);

        $data = [
            'title' => $this->faker->title,
            'content' => $this->faker->paragraph,
            'post_id' => $post->id,
        ];

        $this->actingAs($user)
            ->post(route('comments.store'), $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'data' => ['id', 'title', 'content', 'user_id', 'post_id'],
                    'meta',
                ],
            ]);
    }

    public function test_can_show_comment()
    {
        $comment = factory(Comment::class)->create();

        $this->get(route('comments.show', $comment->id))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'data' => ['id', 'title', 'content', 'user_id', 'post_id'],
                    'meta',
                ],
            ]);
    }

    public function test_can_update_comment()
    {
        $user = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $author = factory(Author::class)->create([
            'user_id' => $user->id,
        ]);

        $post = factory(Post::class)->create([
            'author_id' => $author->id,
        ]);

        $comment = factory(Comment::class)->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $data = [
            'title' => $this->faker->title,
            'content' => $this->faker->paragraph,
        ];

        $user = Passport::actingAs($user);

        $this->actingAs($user)
            ->patch(route('comments.update', $comment->id), $data)
            ->assertStatus(200);

        $this->actingAs($user2)
            ->patch(route('comments.update', $comment->id), $data)
            ->assertStatus(403);
    }

    public function test_can_delete_comment()
    {
        $user = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $author = factory(Author::class)->create([
            'user_id' => $user->id,
        ]);

        $post = factory(Post::class)->create([
            'author_id' => $author->id,
        ]);

        $comment = factory(Comment::class)->create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $user = Passport::actingAs($user);

        $this->actingAs($user2)
            ->delete(route('comments.destroy', $comment->id))
            ->assertStatus(403);

        $this->actingAs($user)
            ->delete(route('comments.destroy', $comment->id))
            ->assertStatus(204);
    }
}
