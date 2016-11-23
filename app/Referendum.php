<?php

namespace App;

use App\Traits\Commentable;
use App\Traits\Likeable;
use App\Traits\Pollable;
use Illuminate\Database\Eloquent\Model;

class Referendum extends Model
{

    use Commentable, Likeable, Pollable;

    protected $fillable = [
        'title',
        'description',
        'approved',
    ];

    /**
     * Scope for filtering approved requests
     * @param $query
     * @return mixed
     */
    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }

    /**
     * Scope for filtering not approved requests
     * @param $query
     * @return mixed
     */
    public function scopeNotApproved($query)
    {
        return $query->where('approved', false);
    }
}
