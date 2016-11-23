<?php namespace App\Traits;

use App\PollAnswer;

trait Pollable
{

    public function pollAnswers()
    {
        return $this->morphMany(PollAnswer::class, 'pollable');
    }

}