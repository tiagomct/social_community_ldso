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
     * If necessary override this function based on model parameters
     * eg. voting on referendum is enabled only when it is approved
     * @return bool
     */
    public function votingEnabled()
    {
        return true;
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


    /**
     * Packs up all data for poll into an array and returns it
     * for easier usage with partial view _poll.blade.php
     * @return array
     */
    public function pollData()
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

}