<?php

namespace App;

class NewsEntry extends Thread
{
    protected $fillable = [
        'title',
        'description',
        'img_name',
        'archived',
        'category'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
