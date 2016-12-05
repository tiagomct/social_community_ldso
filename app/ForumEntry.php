<?php

namespace App;

use App\Traits\Commentable;
use App\Traits\Likeable;
use App\Traits\Subscriptable;

class ForumEntry extends Thread
{

    use Commentable, Likeable, Subscriptable;

    protected $fillable = [
        'title',
        'description',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
