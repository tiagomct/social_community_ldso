<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VoteModelTest extends TestCase
{

    /*
     * Testing referendum answer relationship done in ReferendumAnswerModelTest
     */


    /**
     * Testing userIs scope
     */
    public function tests_user_is()
    {
        $user = factory(App\User::class)->create();

        $vote = factory(App\Vote::class, 1)->create([
            'user_id' => $user->id,
        ]);

        $vote = \App\Vote::userIs($user)->first();

        $this->assertEquals($vote->user_id, $user->id);
    }

    /**
     * Testing referendumAnswerIs scope
     */
    public function tests_referendumAnswer_is()
    {
        $referendumAnswer = factory(App\ReferendumAnswer::class)->create();

        $vote = factory(App\Vote::class, 1)->create([
            'referendum_answer_id' => $referendumAnswer->id,
        ]);

        $vote = \App\Vote::referendumAnswerIs($referendumAnswer)->first();

        $this->assertEquals($vote->referendum_answer_id, $referendumAnswer->id);
    }

    /**
     * Testing referendumAnswersAre scope
     */
    public function tests_referendumAnswers_are()
    {
        $referendumAnswers = factory(App\ReferendumAnswer::class, 3)->create();

        foreach ($referendumAnswers as $referendumAnswer) {
            $vote = factory(App\Vote::class, 1)->create([
                'referendum_answer_id' => $referendumAnswer->id,
            ]);
        }

        $vote_ids = \App\Vote::referendumAnswersAre($referendumAnswers)->pluck('referendum_answer_id');
        $referendumAnswers_ids = $referendumAnswers->pluck('id');

        $this->assertEquals($vote_ids, $referendumAnswers_ids);
    }


    /*
     * Testing user relationship
     */
    public function tests_user_relationship()
    {

        $user = \App\User::first();

        $vote = factory(App\Vote::class, 1)->create([
            'user_id' => $user->id,
        ]);

        $this->assertEquals($vote->user->id, $user->id);

    }
}
