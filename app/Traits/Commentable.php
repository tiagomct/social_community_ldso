<?php namespace App\Traits;

use App\Comment;

trait Commentable
{

    /**
     * @return mixed
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

}