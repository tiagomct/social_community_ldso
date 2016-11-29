<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pollAnswer()
    {
        return $this->belongsTo(PollAnswer::class, 'poll_answer_id');
    }

}
