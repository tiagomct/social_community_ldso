<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReferendumModelTests extends TestCase
{

    /**
     *  Test scope approved
     * @test
     */
    public function tests_scope_approved()
    {


        $referendums = \App\Referendum::approved()->get();

        $this->assertCount(2, $referendums);
        foreach ($referendums as $referendum) {
            $this->assertEquals(true, $referendum->approved);
        }

    }

    /**
     * Test scope not approved
     * @test
     */
    public function tests_scope_notApproved()
    {
        $referendums = \App\Referendum::notApproved()->get();

        $this->assertCount(2, $referendums);
        foreach ($referendums as $referendum) {
            $this->assertEquals(false, $referendum->approved);
        }

    }

    /*
     * Tests relationship between answers and referendums
     * @test
     */

    public function tests_answers_relationship()
    {

        $referendum = \App\Referendum::first();


        $referendumAnswers = factory(App\ReferendumAnswer::class, 3)->create([
            'referendum_id' => $referendum->id,
        ]);

        $answer_ids = $referendum->referendumAnswer->pluck('id')->toArray();

        foreach ($referendumAnswers as $answer) {
            $this->assertEquals($answer->referendum->id, $referendum->id);
            $this->assertContains($answer->id, $answer_ids);
        }


    }


}
