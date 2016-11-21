<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReferendumCommentTest extends TestCase
{
    /*
     * Testing user relationship
     */
    public function tests_user_relationship()
    {

        $user = \App\User::first();

        $comment = factory(App\ReferendumComment::class, 1)->create([
            'user_id' => $user->id,
        ]);

        $this->assertEquals($comment->user->id, $user->id);

    }

    /*
     * Testing  relationship
     */
    public function tests_referendum_relationship()
    {

        $referendum = \App\Referendum::approved()->first();

        $comment = factory(App\ReferendumComment::class, 1)->create([
            'referendum_id' => $referendum->id,
        ]);

        $this->assertEquals($comment->referendum->id, $referendum->id);

    }
}
