<?php

namespace App;

use App\Traits\Commentable;
use App\Traits\Likeable;
use App\Traits\Pollable;

class IdeaEntry extends Thread implements isPoll
{
    use Pollable;

    protected $fillable = [
        'title',
        'description',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
