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

use App\User;

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'title' => "User",
    ];
});

$factory->define(App\VotingLocation::class, function (Faker\Generator $faker) {
    return [
        'district' => $faker->city,
        'county'   => $faker->city,
        'parish'   => $faker->city,
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'               => $faker->name,
        'email'              => $faker->unique()->safeEmail,
        'id_card'            => $faker->randomNumber(9),
        'birth_date'         => $faker->date(),
        'password'           => $password ?: $password = bcrypt('secret'),
        'img_name'           => 'default.jpg',
        'description'        => $faker->paragraph,
        'politics'           => $faker->text,
        'interests'          => implode($faker->sentences),
        'remember_token'     => str_random(10),
        'voting_location_id' => $faker->randomElement(App\VotingLocation::all()->pluck('id')->toArray()),
        'role_id'            => $faker->randomElement(App\Role::where('title', 'User')->pluck('id')->toArray()),
    ];
});

$factory->define(App\Referendum::class, function (Faker\Generator $faker) {
    return [
        'user_id'     => User::inRandomOrder()->first()->id,
        'title'       => $faker->sentence,
        'description' => $faker->paragraphs(3, true),
        'approved'    => $faker->boolean,
    ];
});

$factory->define(App\IdeaEntry::class, function (Faker\Generator $faker) {
    return [
        'user_id'     => User::inRandomOrder()->first()->id,
        'title'       => $faker->sentence,
        'description' => $faker->paragraphs(3, true)
    ];
});

$factory->define(App\ForumEntry::class, function (Faker\Generator $faker) {
    return [
        'user_id'     => User::inRandomOrder()->first()->id,
        'title'       => $faker->sentence,
        'description' => $faker->paragraphs(3, true)
    ];
});

$factory->define(App\NewsEntry::class, function (Faker\Generator $faker) {
    return [
        'user_id'     => User::inRandomOrder()->first()->id,
        'title'       => $faker->sentence,
        'description' => $faker->paragraphs(3, true)
    ];
});

$factory->define(App\MalfunctionEntry::class, function (Faker\Generator $faker) {
    return [
        'user_id'     => User::inRandomOrder()->first()->id,
        'title'       => $faker->sentence,
        'description' => $faker->paragraphs(3, true),
        'status'      => 'pending',
        'report'      => '',
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'user_id'     => User::inRandomOrder()->first()->id,
        'description' => $faker->paragraph
    ];
});

$factory->define(App\Like::class, function (Faker\Generator $faker) {
    return [
        'user_id' => User::inRandomOrder()->first()->id
    ];
});

$factory->define(App\PollAnswer::class, function (Faker\Generator $faker) {
    return [
        'user_id'     => User::inRandomOrder()->first()->id,
        'description' => $faker->paragraph
    ];
});

$factory->define(App\Flag::class, function (Faker\Generator $faker) {
    return [
        'user_id' => User::inRandomOrder()->first()->id
    ];
});

$factory->define(App\EntryFollow::class, function (Faker\Generator $faker) {
    return [
        'user_id' => User::inRandomOrder()->first()->id
    ];
});