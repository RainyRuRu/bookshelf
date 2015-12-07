<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function ($faker) {
    return [
        'username' => $faker->username,
        'email' => $faker->username . '@kkbox.com',
        'password' => bcrypt('password'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Book::class, function ($faker) {
    return [
        'name' =>  $faker->sentence(6),
        'available' => $faker->randomElement($array = array (true, false)),
    ];
});

$factory->define(App\CheckoutHistory::class, function ($faker) {
    return [
        'book_id' => 'factory:App\Book',
        'user_id' => 'factory:App\User',
        'returned' => false,
    ];
});
