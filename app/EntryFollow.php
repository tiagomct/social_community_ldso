<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntryFollow extends Model
{

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function scopeMine($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    public function entry()
    {
        return $this->morphTo('entry', 'entry_followable_type', 'entry_followable_id');
    }
}
