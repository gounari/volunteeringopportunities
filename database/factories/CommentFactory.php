<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'comment_text' => $faker->realText(),
        'post_id' => function() {
            return App\Post::inRandomOrder()->first();
        },
        'user_id' => function() {
            return App\User::inRandomOrder()->first();
        },
    ];
});
