<?php

namespace App;

use App\Traits\Commentable;
use App\Traits\Likeable;

class ForumEntry extends Thread
{

    use Commentable, Likeable;

    protected $fillable = [
        'title',
        'description',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
