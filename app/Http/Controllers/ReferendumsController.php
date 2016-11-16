<?php

namespace App\Http\Controllers;

use App\Referendum;
use App\ReferendumAnswer;
use Illuminate\Support\Facades\Auth;
use App\Vote;

class ReferendumsController extends Controller
{
    public function index()
    {
        $referendums = Referendum::orderBy('created_at', 'desc')->paginate(self::DEFAULT_PAGINATION);

        return view('referendums.index', compact('referendums'));
    }

    public function show(Referendum $referendum)
    {
        $answers = $referendum->referendumAnswer()->get();

        $userAnswerId = Vote::referendumAnswersAre($answers)
                        ->userIs(Auth::user())
                        ->value('referendum_answer_id');

        $totalVotes = $this->totalVotesOfAnswers($answers);

        return view('referendums.show', compact('referendum' ,'answers', 'userAnswerId', 'totalVotes'));
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

    private function totalVotesOfAnswers($answers) {
        $total = 0;

        foreach ($answers as $answer) {
            $total += $answer->number_of_votes;
        }

        return $total;
    }
}
