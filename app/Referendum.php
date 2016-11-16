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
            'approved',
        ];

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
        return $query->where('approved',false);
    }

    /**
     * Relationship to referendum_answers table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referendumAnswer()
    {
        return $this->hasMany(ReferendumAnswer::class);
    }
}
