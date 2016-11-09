<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferendumAnswer extends Model
{
    // just to be sure
    protected $table = 'referendum_answers';

    protected $fillable = [
        'referendum_id',
        'description',
    ];


    public function CountVotes()
    {
        return Vote::referendumAnswerIs($this)->count();
    }

    /**
     *
     * Select answers based on referendum id($id)
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeReferendumIs($query, $referendum)
    {
        return $query->where('referendum_id', $referendum->id);
    }

    /**
     * Relationship to votes table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vote()
    {
        return $this->hasMany(Vote::class);
    }

    /**
     * Relationship to referendums table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referendum()
    {
        return $this->belongsTo(Referendum::class);
    }
}
