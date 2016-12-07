<?php namespace App\Traits;

use App\Flag;

trait Flaggable
{
    public function flags()
    {
        return $this->morphMany(Flag::class, 'flagable');
    }
}