<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ApplicationForm;
use App\Post;
use Faker\Generator as Faker;

$factory->define(ApplicationForm::class, function (Faker $faker) {
    return [
        'information' => $faker->realText(),
        'post_id' => factory(Post::class)->create()->id,
    ];
});
