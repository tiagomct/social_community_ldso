<?php

use Illuminate\Database\Seeder;

class TestingSeeder extends Seeder
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

        factory(App\User::class, 5)->create();
        factory(App\User::class, 1)->create([
            'role_id' => 2,
        ]);
        factory(App\Referendum::class, 2)->create([
            'approved' => true,
        ]);
        factory(App\Referendum::class, 2)->create([
            'approved' => false,
        ]);
        factory(App\ReferendumAnswer::class, 6)->create();
        factory(App\Vote::class, 4)->create();
    }
}
