<?php

namespace App;

use App\Traits\Likeable;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class NewsEntry extends Model
{

    use Likeable, Eloquence;

    protected $searchableColumns = [
        'title',
        'description'
    ];

    public function isMine()
    {
        return $this->user_id == auth()->user()->id;
    }
}
