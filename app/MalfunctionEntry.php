<?php

namespace App;

use App\Traits\Commentable;
use App\Traits\Likeable;
use App\Traits\Pollable;

class MalfunctionEntry extends Thread
{
    use Commentable, Likeable;

    protected $fillable = [
        'title',
        'description',
        'status',
        'report',
        'image'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
