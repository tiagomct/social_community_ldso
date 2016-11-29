<?php namespace App\Traits;

use App\PollAnswer;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Pollable
{

    /**
     * @return HasMany
     */
    public function pollAnswers()
    {
        return $this->morphMany(PollAnswer::class, 'poll_answerable');
    }


    /**
     * Return everything needed for poll displaying in view
     * MUST use partial view _poll.view.php
     * @return array
     */
    public function preparePollForView()
    {
        $answers = $this->pollAnswers()->get();

        $totalVotes = 0;
        $userAnswerId = null;
        foreach ($answers as $answer) {
            if ($answer->hasMyVote()) {
                $userAnswerId = $answer->id;
            }
            $totalVotes += $answer->votes->count();
        }

        return [
            'answers' => $answers,
            'totalVotes' => $totalVotes,
            'userAnswerId' => $userAnswerId,
        ];
    }


    /**
     * Get total number of votes on all answers related
     * @return mixed
     */
    public function answersTotalVotes()
    {
        return $this->pollAnswers
            ->sum(function ($_answer) {
                return $_answer->votes->count();
            });
    }


    /**
     * Find out if authenticated user already voted on a pollable model
     * @return bool
     */
    public function userVoted()
    {
        foreach ($this->pollAnswers as $answer) {
            if ($answer->hasMyVote()) {
                return true;
            }
        }

        return false;
    }
}