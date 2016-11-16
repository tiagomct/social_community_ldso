<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReferendumRequest;
use App\Referendum;
use App\ReferendumAnswer;
use Illuminate\Support\Facades\Auth;
use App\Vote;

class ReferendumsController extends Controller
{
    /**
     * Directs the user to create referendum page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('referendums.create');
    }

    /**
     * Handles POST request submitted by create referendum page
     * @param ReferendumRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReferendumRequest $request)
    {
        $referendum = new Referendum();
        $referendum->title = $request->title;
        $referendum->description = $request->description;
        $referendum->approved = false;
        $referendum->save();

        foreach ($request->answers as $answer) {
            $referendumAnswer = new ReferendumAnswer();
            $referendumAnswer->referendum()->associate($referendum);
            $referendumAnswer->description = $answer;
            $referendumAnswer->save();
        }
        //TODO possibly flash a message or sth like it
        return redirect()->action('ReferendumsController@index');
    }


    /**
     * Directs to the view with all approved referendum requests
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $referendums = Referendum::approved()->paginate(self::DEFAULT_PAGINATION);

        return view('referendums.index', compact('referendums'));
    }

    /**
     * Show a selected referendum and current state of the votes
     * if user didn't vote voting is enabled
     * @param Referendum $referendum
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show(Referendum $referendum)
    {
        if ($referendum->approved == false) {
            return redirect()->back();
        }

        $answers = $referendum->referendumAnswer()->get();

        $userAnswerId = Vote::referendumAnswersAre($answers)
            ->userIs(Auth::user())
            ->value('referendum_answer_id');

        $totalVotes = $this->totalVotesOfAnswers($answers);

        return view('referendums.show', compact('referendum', 'answers', 'userAnswerId', 'totalVotes'));
    }


    /**
     *
     * Creates a new votes table entry based on selection of user
     * @param Referendum $referendum
     * @param ReferendumAnswer $referendumAnswer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitVote(Referendum $referendum, ReferendumAnswer $referendumAnswer)
    {
        if ($referendum->approved == false) {
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


    /**
     * Returns view of referendums to approve for moderators
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pendingList()
    {

        $referendums = Referendum::notApproved()->paginate(self::DEFAULT_PAGINATION);

        return view('referendums.moderatorIndex', compact('referendums'));
    }


    /**
     * Returns show view for moderators to approve referendum
     * @param Referendum $referendum
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pendingShow(Referendum $referendum)
    {
        $answers = $referendum->referendumAnswer()->get();
        return view('referendums.moderatorShow', compact('referendum', 'answers'));
    }


    /**
     * Approves referendum
     * @param Referendum $referendum
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(Referendum $referendum)
    {
        $referendum->approved = true;
        $referendum->save();
        return redirect()->action('ReferendumsController@pendingList');
    }


    /**
     * Returns accumulated number of votes for all referendum answers
     * @param $answers
     * @return int
     */
    private
    function totalVotesOfAnswers($answers)
    {
        $total = 0;

        foreach ($answers as $answer) {
            $total += $answer->number_of_votes;
        }

        return $total;
    }
}
