<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferendumAnswer extends Model
{

    protected $fillable = [
        'referendum_id',
        'description',
    ];

    /**
     * Relationship to referendums table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referendum()
    {
        return $this->belongsTo(Referendum::class);
    }
}
