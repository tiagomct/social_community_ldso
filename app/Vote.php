<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'referendum_answer_id',
        'user_id',
    ];


    public function scopeReferendumAnswersAre($query, $referendum_answers)
    {
        return $query->whereIn('referendum_answer_id', $referendum_answers->pluck('id')->toArray());
    }

    public function scopeReferendumAnswerIs($query, $referendum_answer)
    {
        return $query->where('referendum_answer_id', $referendum_answer->id);
    }

    public function scopeUserIs($query, $user)
    {
        return $query->where('user_id', $user->id);
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
