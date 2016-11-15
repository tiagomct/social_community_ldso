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
     * Relationship to referendum_answers table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referendumAnswer()
    {
        return $this->hasMany(ReferendumAnswer::class);
    }
}
