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

/*              Role factory                    */
$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'title' => "User",
    ];
});

/*              Voting location factory          */
$factory->define(App\VotingLocation::class, function (Faker\Generator $faker) {
    return [
        'district' => $faker->city,
        'county' => $faker->city,
        'parish' => $faker->city,
    ];
});

/*              Municipality factory            */
$factory->define(App\Municipality::class, function (Faker\Generator $faker){
    return [
        'name' => $faker->city,
    ];
});

/*              User factory                    */
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
        'voting_location_id' => $faker->randomElement(App\VotingLocation::all()->pluck('id')->toArray()),
        'role_id' => $faker->randomElement(App\Role::where('title', 'User')->pluck('id')->toArray()),
    ];
});

/*              Referendum factory              */
$factory->define(App\Referendum::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'description' => implode($faker->sentences),
        'approved' => $faker->boolean,
    ];
});

/*              Referendums Answer factory      */
$factory->define(App\ReferendumAnswer::class, function (Faker\Generator $faker) {
    return [
        'referendum_id' => $faker->randomElement(App\Referendum::all()->pluck('id')->toArray()),
        'description' => implode($faker->sentences),

    ];
});

/*              Vote factory                    */
$factory->define(App\Vote::class, function (Faker\Generator $faker) {
    return [
        'referendum_answer_id' => $faker->randomElement(App\ReferendumAnswer::all()->pluck('id')->toArray()),
        'user_id' => $faker->randomElement(App\User::all()->pluck('id')->toArray()),

    ];
});

/*              Forum factory                   */
$factory->define(App\Forum::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'description' => implode($faker->sentences),
    ];
});

/*              Forum entry factory             */
$factory->define(App\ForumEntry::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->sentence,
        'forum_id' => $faker->randomElement(App\Forum::all()->pluck('id')->toArray()),
        'user_id' => $faker->randomElement(App\User::all()->pluck('id')->toArray()),
    ];
});