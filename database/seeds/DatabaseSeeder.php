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
        factory(App\User::class, 5)->create();
        factory(App\Referendum::class, 2)->create([
            'approved' => true,
        ]);
        factory(App\Referendum::class, 2)->create([
            'approved' => false,
        ]);
        factory(App\ReferendumAnswer::class, 8)->create();
        factory(App\ReferendumComment::class,10)->create();
        factory(App\ForumEntry::class, 2)->create();
        factory(App\ForumEntry::class, 5)->create();
    }
}
