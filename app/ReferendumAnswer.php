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

    /**
     * Relationship to votes table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes()
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
