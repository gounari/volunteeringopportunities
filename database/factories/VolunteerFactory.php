<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Volunteer;
use Faker\Generator as Faker;

$factory->define(Volunteer::class, function (Faker $faker) {
    return [
        'last_name' => $faker->lastName,
        'about_me' => $faker->realText(),
        'languages' => json_encode($faker->shuffle(['English', 'Spanish', 'Greek'])),
        'occupation' => $faker->jobTitle,
        'facebook_url' => $faker->unique()->url,
        'instagram_url' => $faker->unique()->url,
        'twitter_url' => $faker->unique()->url,
    ];
});
