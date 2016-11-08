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


$factory->define(App\VotingLocation::class, function (Faker\Generator $faker) {
    return [
        'district' => $faker->city,
        'county' => $faker->city,
        'parish' => $faker->city,
    ];
});
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'id_card' => $faker->randomNumber(9),
        'birth_date' => $faker->date(),
        'password' => $password ?: $password = bcrypt('secret'),
        'description' => $faker->paragraph,
        'politics'  => $faker->text,
        'interests' => implode($faker->sentences),
        'remember_token' => str_random(10),
        'voting_location_id' => 1
    ];
});
$factory->define(App\Referendum::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'description' => implode($faker->sentences),
    ];
});