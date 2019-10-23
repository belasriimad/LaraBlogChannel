<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->sentence(rand(5, 10));
    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'body' => $faker->paragraph(rand(200,500)),
        'user_id' => $faker->randomDigit(1,10),
        'category_id' => $faker->randomDigit(1, 10)
    ];
});
