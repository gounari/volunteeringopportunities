<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\Organization;
use Faker\Generator as Faker;


$factory->define(Post::class, function (Faker $faker) {
    $startDate = $faker->dateTimeBetween('+0 days', '+2 years');
    $endDate = $faker->dateTimeBetween($startDate->format('Y-m-d'), '+2 years');
    return [
        'title' => $faker->text,
        'country' => $faker->country,
        'start_date' => $startDate,
        'end_date' => $endDate,
        'description' => $faker->realText(),
        'image' => $faker->image(public_path('images'),640,480, 'nature', false),
        'application_url' => $faker->unique()->url,
        'organization_id' => Organization::inRandomOrder()->first(),
    ];
});
