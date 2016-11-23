<?php namespace App\Traits;

use App\EntryReport;

trait Reportable
{

    public function entryReports()
    {
        return $this->morphMany(EntryReport::class, 'entry_reportable');
    }

}