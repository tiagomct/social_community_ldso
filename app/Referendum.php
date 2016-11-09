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
     * Relationship to referendum_answers table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referendum_answer()
    {
        return $this->hasMany(ReferendumAnswer::class);
    }
}
