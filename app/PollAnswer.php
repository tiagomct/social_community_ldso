<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollAnswer extends Model
{

    protected $fillable = ['description'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isMine()
    {
        return $this->user_id == auth()->user()->id;
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function hasMyVote()
    {
        return $this->votes->contains('user_id', auth()->user()->id);
    }

}
