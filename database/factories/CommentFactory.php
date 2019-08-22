<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'content' => $faker->paragraph,
        'post_id' => factory(App\Post::class)->create(),
        'user_id' => factory(App\User::class)->create(),
    ];
});
