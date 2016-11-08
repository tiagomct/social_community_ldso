<?php

namespace App\Http\Controllers;

use App\Referendum;
use Auth;

class ReferendumController extends Controller
{

    public function show(Referendum $referendum)
    {
        $upVotes = $referendum->countVotes('up');
        $downVotes = $referendum->countVotes('down');

        $voted = $referendum->checkIfVoted(Auth::user());

        return view('referendum.show', compact('referendum', 'upVotes', 'downVotes', 'voted'));
    }

    public function voteUp(Referendum $referendum)
    {
        $referendum->userVote('up');
        return redirect()->action('ReferendumController@show', $referendum);

    }

    public function voteDown(Referendum $referendum)
    {
        $referendum->userVote('down');
        return redirect()->action('ReferendumController@show', $referendum);
    }

}
