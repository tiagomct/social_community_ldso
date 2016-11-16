<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Role::class)->create([
            'title' => 'User'
        ]);
        factory(App\Role::class)->create([
            'title' => 'Moderator'
        ]);
        factory(App\Role::class)->create([
            'title' => 'Administrator'
        ]);

        factory(App\VotingLocation::class)->create([
            'district' => 'Porto',
            'county' => 'Porto',
            'parish' => 'Paranhos'
        ]);

        factory(App\User::class, 20)->create();
        factory(App\Referendum::class, 10)->create();
        factory(App\ReferendumAnswer::class,30)->create();
        factory(App\Forum::class, 20)->create();
        factory(App\ForumEntry::class, 50)->create();
    }
}
