<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Taggable;
use Faker\Generator as Faker;

$factory->define(Taggable::class, function (Faker $faker) {

    $taggables = [
        App\Post::class,
        App\User::class,
    ];

    //getting random tagged table
    $taggableType = $faker->randomElement($taggables);
    $taggable = factory($taggableType)->create();

    return [
        'tag_id' => function() {
            return factory('App\Tag')->create()->id;
        },
        'taggable_type' => $taggableType,
        'taggable_id' => $taggable->id,
    ];
});

