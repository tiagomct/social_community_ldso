<?php namespace App\Traits;

use App\EntryReport;

trait Reportable
{
    public function reports()
    {
        return $this->morphMany(EntryReport::class, 'entry_reportable');
    }
}