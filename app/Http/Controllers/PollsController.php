<?php

namespace App\Http\Controllers;

use App\IdeaEntry;
use App\PollAnswer;
use App\Referendum;
use App\Vote;

class PollsController extends Controller
{

    protected $pollableModels = [
        'idea' => IdeaEntry::class,
        'referendum' => Referendum::class,
    ];


    public function submitVote($pollableType, $pollableId, PollAnswer $pollAnswer)
    {
        if (!array_has($this->pollableModels, $pollableType)) {
            return redirect()->back();
        }

        $pollableModel = $this->pollableModels[$pollableType];
        $pollableItem = $pollableModel::find($pollableId);


        if ($pollableItem->userVoted() | !($pollableItem->votingEnabled())) {
            return redirect()->back();
        }

        $vote = new Vote();
        $vote->user()->associate(auth()->user());
        $vote->pollAnswer()->associate($pollAnswer);
        $vote->save();

        return redirect()->back();
    }
}
