<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subscriptable()
    {
        return $this->morphTo();
    }
}
