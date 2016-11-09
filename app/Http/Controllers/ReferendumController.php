<?php

namespace App\Http\Controllers;

use App\Referendum;
use App\ReferendumAnswer;
use Request;
use App\Vote;
use Auth;

class ReferendumController extends Controller
{

    public function show(Referendum $referendum)
    {
        $answers = $referendum->referendum_answer;
        $number_of_answers = count($answers);

        $voted = False;
        for($i = 0; $i < $number_of_answers; $i++)
        {
            $voteCount[$i] = $answers[$i]->CountVotes();

            if(Vote::referendumAnswerIdIs($answers[$i]->id)->userIdIs(Auth::user()->id)->count()){
                $voted = True;
            }
        }

        return view('referendum.show', compact('referendum', 'number_of_answers' ,'answers', 'voteCount', 'voted'));
    }

    public function submitVote(Referendum $referendum, ReferendumAnswer $referendumAnswer)
    {
        Vote::create([
            'referendum_answer_id' => $referendumAnswer->id,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->action('ReferendumController@show', $referendum);

    }

}
