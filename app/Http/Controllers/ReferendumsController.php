<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReferendumRequest;
use App\Referendum;
use App\ReferendumAnswer;
use Illuminate\Support\Facades\Auth;
use App\Vote;

class ReferendumsController extends Controller
{

    public function new()
    {
        return view('referendums.create');
    }

    public function create(ReferendumRequest $request)
    {

        $referendum = new Referendum();
        $referendum->title = $request->title;
        $referendum->description = $request->description;
        $referendum->approved = false;
        $referendum->save();

        foreach ($request->answers as $answer)
        {
            $referendumAnswer = new ReferendumAnswer();
            $referendumAnswer->referendum()->associate($referendum);
            $referendumAnswer->description = $answer;
            $referendumAnswer->save();
        }
        //TODO possibly flash a message or sth like it
        return redirect()->action('ReferendumsController@index');
    }


    public function index()
    {
        $referendums = Referendum::where('approved', '=', true )->paginate(self::DEFAULT_PAGINATION);

        return view('referendums.index', compact('referendums'));
    }

    public function show(Referendum $referendum)
    {
        if($referendum->approved==false)
        {
            return redirect()->back();
        }

        $answers = $referendum->referendumAnswer()->get();

        $userAnswerId = Vote::referendumAnswersAre($answers)
                        ->userIs(Auth::user())
                        ->value('referendum_answer_id');

        $totalVotes = $this->totalVotesOfAnswers($answers);

        return view('referendums.show', compact('referendum' ,'answers', 'userAnswerId', 'totalVotes'));
    }

    public function submitVote(Referendum $referendum, ReferendumAnswer $referendumAnswer)
    {
        if($referendum->approved==false)
        {
            return redirect()->back();
        }

        $vote = new Vote();

        $vote->user()->associate(Auth::user());
        $vote->referendumAnswer()->associate($referendumAnswer);
        $vote->save();

        $referendumAnswer->number_of_votes++;
        $referendumAnswer->save();

        return redirect()->action('ReferendumsController@show', $referendum);

    }

    public function approve()
    {
        $this->attributes['approved'] = true;
    }

    private function totalVotesOfAnswers($answers) {
        $total = 0;

        foreach ($answers as $answer) {
            $total += $answer->number_of_votes;
        }

        return $total;
    }
}
