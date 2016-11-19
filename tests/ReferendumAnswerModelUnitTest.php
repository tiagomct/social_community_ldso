<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReferendumAnswerModelTest extends TestCase
{

    use DatabaseTransactions;


    /**
     * Test for relationship between answers and refernedum in ReferendumModelTest
     */



    /*
     * Tests relationship between answers and votes
     * @test
     */
    public function tests_votes_relationship()
    {

        $referendum = \App\Referendum::first();

        $referendumAnswer = factory(App\ReferendumAnswer::class, 1)->create([
            'referendum_id' => $referendum->id,
        ]);


        $votes = factory(App\Vote::class, 3)->create([
            'referendum_answer_id' => $referendumAnswer->id,
        ]);

        $vote_ids = $referendumAnswer->votes->pluck('id')->toArray();
        foreach ($votes as $vote)
        {
            $this->assertEquals($vote->referendumAnswer->id,$referendumAnswer->id);
            $this->assertContains($vote->id, $vote_ids);
        }


    }
}
