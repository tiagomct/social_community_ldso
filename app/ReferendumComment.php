<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferendumComment extends Model
{
    // just to be sure
    protected $table = 'referendum_comments';

    protected $fillable =
        [
            'content',
            'referendum_id',
            'user_id',
        ];

    /**
     * Defines relationship to users table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Defines relationship to referendums table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referendum()
    {
        return $this->belongsTo(Referendum::class);
    }
}
