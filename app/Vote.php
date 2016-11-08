<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'referendum_id',
        'user_id',
        'decision',
    ];


    /**
     * Relationship with users table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with referendums table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referendum()
    {
        return $this->belongsTo(Referendum::class);
    }

}
