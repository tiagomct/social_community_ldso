<?php

use App\Referendum;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;

class ReferendumTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();

        $this->bootstrapDatabase();
    }

    /** @Test */
    public function it_lists_referendums_test()
    {
        /*$referendum = Referendum::orderBy('created_at', 'desc')->first();
        $this->get('ReferendumsController@index')
            ->see($referendum->title);*/

        $user = App\User::first();x
        $this->get('UsersController@index')
            ->see($user->name);
    }

    private function bootstrapDatabase()
    {
        factory(App\User::class)->make();
    }
}
