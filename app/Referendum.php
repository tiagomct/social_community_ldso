<?php

namespace App;

use App\Traits\Pollable;

class Referendum extends Thread implements isPoll
{
    use Pollable;

    protected $fillable = [
        'title',
        'description',
    ];

    /**
     * Overriding default function of pollable trait
     * to avoid abuse of voting on not yet approved referendums
     * @return mixed
     */
    public function votingEnabled()
    {
        return $this->approved;
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * Scope for filtering approved requests
     * @param $query
     * @return mixed
     */
    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }

    /**
     * Scope for filtering not approved requests
     * @param $query
     * @return mixed
     */
    public function scopeNotApproved($query)
    {
        return $query->where('approved', false);
    }
}
