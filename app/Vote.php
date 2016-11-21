<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'referendum_answer_id',
        'user_id',
    ];


    /**
     * Scope for filtering submitted votes based on referendum answers
     * @param $query
     * @param $referendum_answers
     * @return mixed
     */
    public function scopeReferendumAnswersAre($query, $referendum_answers)
    {
        return $query->whereIn('referendum_answer_id', $referendum_answers->pluck('id')->toArray());
    }

    /**
     * Scope for finding all submitted votes of referendum answer
     * @param $query
     * @param $referendum_answer
     * @return mixed
     */
    public function scopeReferendumAnswerIs($query, $referendum_answer)
    {
        return $query->where('referendum_answer_id', $referendum_answer->id);
    }


    /**
     * Scope for filtering votes submitted user
     * @param $query
     * @param $user
     * @return mixed
     */
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
    public function referendumAnswer()
    {
        return $this->belongsTo(ReferendumAnswer::class);
    }

}
