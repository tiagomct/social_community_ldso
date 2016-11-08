<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

class Referendum extends Model
{
    protected $fillable=
        [
            'title',
            'description',
        ];

    /**
     * Coutn number of votes of $decision - 'up' or 'down'
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

        return DB::table('votes')->where([
            ['referendum_id', '=', $this->id],
            ['decision', '=', $decisionValue],
        ])->count();
    }

    /**
     * Check if user voted already
     * @param User $user
     * @return bool
     */
    public function checkIfVoted(User $user)
    {
        $findVote =
            DB::table('votes')->where([
                ['user_id', '=', $user->id],
                ['referendum_id', '=', $this->id]
            ])->count();

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
    public  function vote(User $user, string $decision)
    {
        if($decision=='up')
        {
            $value=1;
        }elseif ($decision=='down')
        {
            $value=0;
        }
        DB::table('votes')->insert(
            ['referendum_id' => $this->id,
                'user_id' => $user->id,
                'created_at' => Carbon::now(),
                'decision' => $value,
            ]
        );
    }

}
