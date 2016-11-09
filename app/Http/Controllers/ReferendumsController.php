<?php

namespace App\Http\Controllers;

use App\Referendum;
use App\ReferendumAnswer;
use Request;
use App\Vote;
use Auth;

class ReferendumsController extends Controller
{

    public function show(Referendum $referendum)
    {
        $answers = $referendum->referendumAnswer()->get();

        $userAnswerId = Vote::referendumAnswersAre($answers)
                        ->userIs(Auth::user())
                        ->value('referendum_answer_id');

        return view('referendums.show', compact('referendum' ,'answers', 'userAnswerId'));
    }

    public function submitVote(Referendum $referendum, ReferendumAnswer $referendumAnswer)
    {
        $vote = new Vote();

        $vote->user()->associate(Auth::user());
        $vote->referendumAnswer()->associate($referendumAnswer);
        $vote->save();

        $referendumAnswer->number_of_votes++;
        $referendumAnswer->save();

        return redirect()->action('ReferendumsController@show', $referendum);

    }

}
