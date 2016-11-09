<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'referendum_answer_id',
        'user_id',
    ];




    public function scopeReferendumAnswerIdIs($query, $id)
    {
        return $query->where('referendum_answer_id', $id);
    }

    public function scopeUserIdIs($query, $id)
    {
        return $query->where('user_id', $id);
    }

    /**
     * Relationship with users table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with referendum_answers table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referendum_answer()
    {
        return $this->belongsTo(ReferendumAnswer::class);
    }

}
