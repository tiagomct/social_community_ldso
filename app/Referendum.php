<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Referendum extends Model
{
    protected $fillable =
        [
            'title',
            'description',
        ];

    /**
     * Counts number of votes with $decision - 'up' or 'down'
     * @param string $type
     * @return integer
     */
    public function countVotes(string $decision)
    {

        if ($decision == 'up') {
            $decisionValue = 1;
        } elseif ($decision == 'down') {
            $decisionValue = 0;
        } else {
            return null;
        }

        return $this->vote()->where('decision', $decisionValue)->count();
    }

    /**
     * Check if user voted already
     * @param User $user
     * @return bool
     */
    public function checkIfVoted(User $user)
    {
        $findVote = vote()->where('user_id', $user->id)
            ->where('referendum_id', $this->id)
            ->count();

        if ($findVote == 0) {
            return False;
        } else {
            return True;
        }
    }


    /**
     * Vote on referendum $decision = 'up' or 'down'
     * @param User $user
     * @param string $decision
     */
    public function userVote(string $decision)
    {
        if ($decision == 'up') {
            $value = 1;
        } elseif ($decision == 'down') {
            $value = 0;
        }

        $vote = $this->vote()->create(array(
            'referendum_id' => $this->id,
            'user_id' => Auth::user()->id,
            'decision' => $value
        ));

        $vote->save();
    }

    /**
     * Relationship with votes table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vote()
    {
        return $this->hasMany(Vote::class);
    }
}
