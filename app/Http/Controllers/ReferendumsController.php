<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReferendumCommentRequest;
use App\Http\Requests\ReferendumRequest;
use App\PollAnswer;
use App\Referendum;
use App\ReferendumAnswer;
use App\ReferendumComment;
use Illuminate\Support\Facades\Auth;
use App\Vote;
use Illuminate\Support\Facades\DB;

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
     * @param Referendum        $referendum
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReferendumRequest $request, Referendum $referendum)
    {
        DB::transaction(function () use ($request, $referendum) {
            $referendum->fill($request->all());
            $referendum->approved = false;
            $referendum->author()->associate(auth()->user());
            $referendum->save();

            $pollAnswers = [];
            foreach ($request->get('answers', []) as $answer) {
                $answer = new PollAnswer(['description' => $answer]);
                $answer->author()->associate(auth()->user());
                $pollAnswers[] = $answer;
            }
            $referendum->pollAnswers()->saveMany($pollAnswers);
        });

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
    public function show($referendum_id)
    {
        $referendum = Referendum::with('pollAnswers.likes', 'likes')
            ->where('id', $referendum_id)->where('approved', true)
            ->first();

        if (!$referendum) {
            return redirect()->back();
        }

        $comments = $referendum->comments()->with('likes')->latest()->paginate(self::DEFAULT_PAGINATION);

        $answersTotalVotes = $referendum->pollAnswers->sum(function ($_answer) {
            return $_answer->likes->count();
        });

        return view('referendums.show', compact('referendum', 'answersTotalVotes', 'comments'));
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

}
