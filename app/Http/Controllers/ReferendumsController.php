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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ReferendumRequest $request)
    {
        DB::transaction(function () use ($request) {
            $referendum = new Referendum();
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
        $referendums = Referendum::approved()
            ->search(request()->query('search', null))
            ->paginate(self::DEFAULT_PAGINATION);

        return view('referendums.index', compact('referendums'));
    }

    /**
     * Show a selected referendum and current state of the votes
     * if user didn't vote voting is enabled
     * @param $referendum_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($referendum_id)
    {

        $referendum = Referendum::with('likes')
            ->where('id', $referendum_id)->where('approved', true)
            ->first();

        if (!$referendum) {
            return redirect()->back();
        }

        $poll = $referendum->pollData();

        $comments = $referendum->comments()->with('likes')->latest()->paginate(self::COMMENTS_DEFAULT_PAGINATION);

        return view('referendums.show', compact('referendum', 'poll', 'comments'));
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
        $referendum->closed_at = now()->addDays(30);
        $referendum->save();

        return redirect()->action('ReferendumsController@pendingList');
    }

}
