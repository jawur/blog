<?php

namespace Tests\Feature;

use App\Author;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use WithFaker;

    public function test_can_list_posts()
    {
        factory(Post::class, 2)->create();

        $this->get(route('posts.index'))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [['id', 'title', 'content', 'author_id', 'created_at', 'updated_at', 'comments']],
            ]);
    }

    public function test_can_create_post()
    {
        $user = factory(User::class)->create();

        factory(Author::class)->create([
            'user_id' => $user->id,
        ]);

        $user = Passport::actingAs($user);

        $data = [
            'title' => $this->faker->title,
            'content' => $this->faker->paragraph,
        ];

        $this->actingAs($user)
            ->post(route('posts.store'), $data)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => ['id', 'title', 'content', 'author_id', 'created_at', 'updated_at'],
            ]);
    }

    public function test_can_show_post()
    {
        $post = factory(Post::class)->create();

        $this->get(route('posts.show', $post->id))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'content',
                    'author_id',
                    'created_at',
                    'updated_at',
                    'comments',
                ],
            ]);
    }

    public function test_can_update_post()
    {
        $user = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $author = factory(Author::class)->create([
            'user_id' => $user->id,
        ]);

        $post = factory(Post::class)->create([
            'author_id' => $author->id,
        ]);

        $data = [
            'title' => $this->faker->title,
            'content' => $this->faker->paragraph,
        ];

        $user = Passport::actingAs($user);

        $this->actingAs($user)
            ->patch(route('posts.update', $post->id), $data)
            ->assertStatus(200);

        $this->actingAs($user2)
            ->patch(route('posts.update', $post->id), $data)
            ->assertStatus(403);
    }

    public function test_can_delete_post()
    {
        $user = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $author = factory(Author::class)->create([
            'user_id' => $user->id,
        ]);

        $post = factory(Post::class)->create([
            'author_id' => $author->id,
        ]);

        $user = Passport::actingAs($user);

        $this->actingAs($user2)
            ->delete(route('posts.destroy', $post->id))
            ->assertStatus(403);

        $this->actingAs($user)
            ->delete(route('posts.destroy', $post->id))
            ->assertStatus(204);
    }
}
