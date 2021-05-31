<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        // テストでいれたいデータの定義
        'body' => $faker->realText,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});