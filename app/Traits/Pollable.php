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

}