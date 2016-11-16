<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    //
    protected $fillable =
        [
            'title',
            'description',
        ];

    public function forumEntries()
    {
        return $this->hasMany(ForumEntry::class);
    }
}
