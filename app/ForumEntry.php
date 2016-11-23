<?php

namespace App;

use App\Traits\Commentable;
use App\Traits\Likeable;
use Illuminate\Database\Eloquent\Model;

class ForumEntry extends Thread
{

    use Commentable, Likeable;

    protected $fillable = [
        'title',
        'description',
    ];

    public function forumLikes()
    {
        return $this->hasMany(ForumLike::class);
    }
}
