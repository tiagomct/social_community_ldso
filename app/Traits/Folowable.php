<?php namespace App\Traits;

use App\EntryFollow;

trait Followable
{

    public function follows()
    {
        return $this->morphMany(EntryFollow::class, 'entry_followable');
    }

}