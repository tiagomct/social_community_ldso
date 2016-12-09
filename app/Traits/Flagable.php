<?php namespace App\Traits;

use App\Flag;

trait Flagable
{
    public function flags()
    {
        return $this->morphMany(Flag::class, 'flagable');
    }
    
    public function hasMyReport()
    {
        return $this->flags->contains('user_id', auth()->user()->id);
    }
}