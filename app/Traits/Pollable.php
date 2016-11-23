<?php namespace App\Traits;


use App\Poll;

trait Pollable
{
    public function comments()
    {
        return $this->morphMany(Poll::class, 'pollable');
    }

}