<?php

namespace App;

use App\Traits\Followable;
use App\Traits\Flagable;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Commentable;
use App\Traits\Likeable;

abstract class Thread extends Model implements IsThread
{
    use Commentable, Likeable, Flagable, Followable;

    public function isMine()
    {
        return $this->user_id == auth()->user()->id;
    }
}
