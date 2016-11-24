<?php namespace App\Traits;

use App\Like;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Likeable
{
    
    /**
     * @return HasMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function hasMyLike()
    {
        return $this->likes->contains('user_id', auth()->user()->id);
    }
}