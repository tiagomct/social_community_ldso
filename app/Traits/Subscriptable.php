<?php namespace App\Traits;

use App\Subscription;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Subscriptable
{
    
    /**
     * @return HasMany
     */
    public function subscriptions()
    {
        return $this->morphMany(Subscription::class, 'subscriptable');
    }

    public function hasMySubscription()
    {
        return $this->subscriptions->contains('user_id', auth()->user()->id);
    }
}